<?php
/**
 * Created by PhpStorm.
 * User: christian
 * Date: 1/4/17
 * Time: 11:40 AM
 */

namespace Core\Repository;


use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Criteria;
use Traversable;
use Veloci\Core\Entity;
use Veloci\Core\EntityIndex;
use Veloci\Core\Model\DummyEntity;
use Veloci\Core\Model\IntegerIndex;
use Veloci\Core\Repository\InMemoryEntityRepository;

class InMemoryEntityRepositoryTest extends \PHPUnit_Framework_TestCase
{
    protected const DATE_TIME_FORMAT = 'Y-m-d H:i:s';

    public function testRepository()
    {
        $repository = new InMemoryEntityRepository();

        $entity = $this->createEntity();

        $repository->save($entity);

        \PHPUnit_Framework_Assert::assertEquals($entity, $repository->get($entity->getId()));

        $repository->save($entity);

        //        $collection = $repository->getBy(new Criteria());

        $criteria = Criteria::create()->where(Criteria::expr()->eq('id', 1));

        $collection = $repository->getBy($criteria);

        \PHPUnit_Framework_Assert::assertEquals(1, $this->countTraversable($collection));

        $collection = $repository->getBy(Criteria::create()->where(Criteria::expr()->eq('id', new IntegerIndex(1))));

        \PHPUnit_Framework_Assert::assertEquals(0, $this->countTraversable($collection));
    }


    public function testCriteria()
    {
        $collection = new ArrayCollection([['id' => 1, 'value' => 10], ['id' => 2, 'value' => 20]]);

        $criteria = Criteria::create()->where(Criteria::expr()->eq('id', 2));

        $result = $collection->matching($criteria);

        echo json_encode($result->toArray(), JSON_PRETTY_PRINT);
    }

    public function testCriteria2()
    {
        $collection = new ArrayCollection([new A(1, '10'), new A(2, '20')]);

        $criteria = Criteria::create()->where(Criteria::expr()->eq('id',  new IntegerIndex(2)));

        $result = $collection->matching($criteria);

        var_dump($result->toArray());
    }

    /**
     * @param Traversable $collection
     *
     * @return int
     */
    private function countTraversable(Traversable $collection):int
    {
        $counter = 0;

        foreach ($collection as $item) {
            $counter++;
        }

        return $counter;
    }

    /**
     * @param array $data
     *
     * @return Entity
     */
    public function createEntity(array $data = []):Entity
    {
        $entity = new DummyEntity();

        $id = array_key_exists('id', $data)
            ? new IntegerIndex($data['id'])
            : new IntegerIndex(1);

        $createdAt = array_key_exists('createdAt', $data)
            ? DateTime::createFromFormat(self::DATE_TIME_FORMAT, $data['createdAt'])
            : new DateTime();

        $updatedAt = array_key_exists('updatedAt', $data)
            ? DateTime::createFromFormat(self::DATE_TIME_FORMAT, $data['updatedAt'])
            : new DateTime();

        $externalIndex = array_key_exists('externalIndex', $data)
            ? new IntegerIndex($data['externalIndex'])
            : new IntegerIndex(111);

        $entity->setId($id);
        $entity->setCreatedAt($createdAt);
        $entity->setUpdatedAt($updatedAt);
        $entity->setExternalIndex($externalIndex);

        return $entity;
    }
}



class A {

    /**
     * @var EntityIndex
     */
    protected $id;

    /**
     * @var string
     */
    protected $value;

    /**
     * A constructor.
     *
     * @param int    $id
     * @param string $value
     */
    public function __construct(int $id, string $value) {

        $this->id = new IntegerIndex($id);
        $this->value = $value;
    }

    public function getId(): IntegerIndex
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(IntegerIndex $id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getValue(): string
    {
        return $this->value;
    }

    /**
     * @param string $value
     */
    public function setValue(string $value)
    {
        $this->value = $value;
    }

    public function __toString():string
    {
        return "id:{$this->id} - value:{$this->value}";
    }

}