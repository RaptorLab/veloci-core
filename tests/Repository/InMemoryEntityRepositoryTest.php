<?php
/**
 * Created by PhpStorm.
 * User: christian
 * Date: 1/4/17
 * Time: 11:40 AM
 */

namespace Core\Repository;


use DateTime;
use Doctrine\Common\Collections\Criteria;
use PHPUnit_Framework_Assert as phpunit;
use Traversable;
use Veloci\Core\Entity;
use Veloci\Core\EntityIndex;
use Veloci\Core\Model\DummyEntity;
use Veloci\Core\Model\IntegerIndex;
use Veloci\Core\Repository\EntityRepository;
use Veloci\Core\Repository\InMemoryEntityRepository;

class InMemoryEntityRepositoryTest extends \PHPUnit_Framework_TestCase
{
    protected const DATE_TIME_FORMAT = 'Y-m-d H:i:s';

    /**
     * @var EntityRepository
     */
    private $repository;

    public function setUp()
    {
        $this->repository = new InMemoryEntityRepository();
    }

    /**
     * @test
     */
    public function shouldBeEmpty()
    {
        $collection = $this->repository->getAll();

        phpunit::assertEquals(0, $this->countTraversable($collection));
    }

    /**
     * @test
     */
    public function shouldSaveAndGetOneTime()
    {
        $entity = $this->createEntity(['id' => 1, 'value' => 'test1']);

        $this->repository->save($entity);

        $collection = $this->repository->getAll();

        phpunit::assertEquals(1, $this->countTraversable($collection));
        phpunit::assertEquals($entity, $this->repository->get($entity->getId()));
    }

    /**
     * @test
     */
    public function shouldGetAll()
    {
        $entity1 = $this->createEntity(['id' => 1, 'value' => 'test1']);
        $entity2 = $this->createEntity(['id' => 2, 'value' => 'test2']);
        $entity3 = $this->createEntity(['id' => 3, 'value' => 'test3']);

        $this->repository->save($entity1);
        $this->repository->save($entity2);
        $this->repository->save($entity3);

        $collection = $this->repository->getAll();

        $result = $this->collectionToArray($collection);

        phpunit::assertEquals(3, count($result));
        phpunit::assertEquals([$entity1, $entity2, $entity3], $result);

    }

    /**
     * @test
     */
    public function shouldGetBy()
    {
        $entity1 = $this->createEntity(['id' => 1, 'value' => 'test']);
        $entity2 = $this->createEntity(['id' => 2, 'value' => 'test']);
        $entity3 = $this->createEntity(['id' => 3, 'value' => 'other']);

        $this->repository->save($entity1);
        $this->repository->save($entity2);
        $this->repository->save($entity3);

        $criteria = Criteria::create();

        $expression = Criteria::expr()->eq('value', 'test');

        $criteria->where($expression);

        $collection = $this->repository->getBy($criteria);

        $result = $this->collectionToArray($collection);

        phpunit::assertEquals(2, count($result));
        phpunit::assertEquals([$entity1, $entity2], $result);
    }

    /**
     * @test
     */
    public function shouldDelete()
    {
        $entity1 = $this->createEntity(['id' => 1, 'value' => 'test']);
        $entity2 = $this->createEntity(['id' => 2, 'value' => 'test']);
        $entity3 = $this->createEntity(['id' => 3, 'value' => 'other']);

        $this->repository->save($entity1);
        $this->repository->save($entity2);
        $this->repository->save($entity3);

        $this->repository->delete($entity2);

        $collection = $this->repository->getAll();

        $result = $this->collectionToArray($collection);

        phpunit::assertEquals(2, count($result));
        phpunit::assertEquals([$entity1, $entity3], $result);
    }

    /**
     * @test
     */
    public function shouldExists() {
        $entity1 = $this->createEntity(['id' => 1, 'value' => 'test']);
        $entity2 = $this->createEntity(['id' => 2, 'value' => 'test']);
        $entity3 = $this->createEntity(['id' => 3, 'value' => 'other']);

        $this->repository->save($entity1);
        $this->repository->save($entity3);

        phpunit::assertTrue($this->repository->exists($entity1));
        phpunit::assertTrue($this->repository->exists($entity3));
        phpunit::assertFalse($this->repository->exists($entity2));
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

        $value = array_key_exists('value', $data)
            ? $data['value']
            : 'test';

        $entity->setId($id);
        $entity->setCreatedAt($createdAt);
        $entity->setUpdatedAt($updatedAt);
        $entity->setExternalIndex($externalIndex);
        $entity->setValue($value);

        return $entity;
    }

    private function collectionToArray(Traversable $collection)
    {
        $result = [];

        foreach ($collection as $item) {
            $result[] = $item;
        }

        return $result;
    }
}


class A
{

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
    public function __construct(int $id, string $value)
    {

        $this->id    = new IntegerIndex($id);
        $this->value = $value;
    }

    public function getId(): IntegerIndex
    {
        return $this->id;
    }

    /**
     * @param IntegerIndex $id
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