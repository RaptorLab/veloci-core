<?php
/**
 * Created by PhpStorm.
 * User: christian
 * Date: 1/4/17
 * Time: 2:31 AM
 */

namespace Veloci\Core\Helper;


use Veloci\Core\Model\DummyEntityDefault;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\PropertyInfo\Extractor\PhpDocExtractor;
use Symfony\Component\PropertyInfo\Extractor\ReflectionExtractor;
use Symfony\Component\PropertyInfo\PropertyInfoExtractor;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\DateTimeNormalizer;
use Symfony\Component\Serializer\Normalizer\PropertyNormalizer;
use Symfony\Component\Serializer\Serializer as SymfonySerializer;
use Veloci\Core\Entity;
use Veloci\Core\Helper\Serializer\EntityIndexNormalizer;
use Veloci\Core\Helper\Serializer\EntitySerializer;
use Veloci\Core\Helper\Serializer\EntitySerializerDefault;
use Veloci\Core\Model\IntegerIndex;

/**
 * Class EntitySerializerDefaultTest
 *
 * @package Veloci\Core\Helper
 */
class EntitySerializerDefaultTest extends \PHPUnit_Framework_TestCase
{
    protected const DATE_TIME_FORMAT = 'Y-m-d H:i:s';
    /**
     * @var EntitySerializer
     */
    private $serializer;

    public function setUp()
    {
        // a full list of extractors is shown further below
        $phpDocExtractor     = new PhpDocExtractor();
        $reflectionExtractor = new ReflectionExtractor();

        // array of PropertyListExtractorInterface
        $listExtractors = [$reflectionExtractor];

        // array of PropertyTypeExtractorInterface
        $typeExtractors = [$phpDocExtractor, $reflectionExtractor];

        // array of PropertyDescriptionExtractorInterface
        $descriptionExtractors = [$phpDocExtractor];

        // array of PropertyAccessExtractorInterface
        $accessExtractors = [$reflectionExtractor];

        $propertyInfo = new PropertyInfoExtractor($listExtractors, $typeExtractors, $descriptionExtractors,
                                                  $accessExtractors
        );

        //        $classMetadataFactory = new ClassMetadataFactory(new AnnotationLoader(new AnnotationReader()));

        $propertyNormalizer = new PropertyNormalizer(null, null, $propertyInfo);
        //        $propertyNormalizer->setCallbacks([
        //                                              'id' => function ($id) {
        //                                                  return (string)$id;
        //                                              }
        //                                          ]
        //        );

        $normalizers = [
            new EntityIndexNormalizer(null, null, $propertyInfo),
            new DateTimeNormalizer(self::DATE_TIME_FORMAT),
            $propertyNormalizer
        ];

        $symfonySerializer = new SymfonySerializer($normalizers, [new JsonEncoder()]);

        $this->serializer = new EntitySerializerDefault($symfonySerializer);
    }

    public function testEntityToArray()
    {
        $expectedData = [
            'id'            => 1,
            'createdAt'     => '2017-01-04 23:13:59',
            'updatedAt'     => '2017-02-06 12:34:56',
            'externalIndex' => 346,
            'value'         => 'test'
        ];

        $entity = $this->createEntity($expectedData);

        $data = $this->serializer->entityToArray($entity);

        \PHPUnit_Framework_Assert::assertEquals($expectedData, $data);
    }

    public function testArrayToEntity()
    {
        $data = [
            'id'            => 1,
            'createdAt'     => '2017-01-04 23:13:59',
            'updatedAt'     => '2017-02-06 12:34:56',
            'externalIndex' => 346
        ];

        /** @var DummyEntityDefault $entity */
        $entity = $this->serializer->arrayToEntity($data, DummyEntityDefault::class);

        $this->checkEntity($data, $entity);
    }

    public function testArrayToCollection()
    {
        $data = [
            [
                'id'            => 1,
                'createdAt'     => '2017-01-04 23:13:59',
                'updatedAt'     => '2017-02-06 12:34:56',
                'externalIndex' => 111
            ],
            [
                'id'            => 2,
                'createdAt'     => '2017-01-04 23:13:59',
                'updatedAt'     => '2017-02-06 12:34:56',
                'externalIndex' => 222
            ],
            [
                'id'            => 3,
                'createdAt'     => '2017-01-04 23:13:59',
                'updatedAt'     => '2017-02-06 12:34:56',
                'externalIndex' => 333
            ]
        ];

        $collection = $this->serializer->arrayToCollection($data, DummyEntityDefault::class);

        $i = 0;

        foreach ($collection as $entity) {
            $this->checkEntity($data[$i], $entity);
            $i++;
        }

        $count = count($data);

        \PHPUnit_Framework_Assert::assertEquals($count, $i, "Collection should have {$count} elements, {$i} found");
    }

    public function testCollectionToArray()
    {
        $expectedData = [
            [
                'id'            => 1,
                'createdAt'     => '2017-01-04 23:13:59',
                'updatedAt'     => '2017-02-06 12:34:56',
                'externalIndex' => 111,
                'value'         => 'test1'
            ],
            [
                'id'            => 2,
                'createdAt'     => '2017-01-04 23:13:59',
                'updatedAt'     => '2017-02-06 12:34:56',
                'externalIndex' => 222,
                'value'         => 'test2'
            ],
            [
                'id'            => 3,
                'createdAt'     => '2017-01-04 23:13:59',
                'updatedAt'     => '2017-02-06 12:34:56',
                'externalIndex' => 333,
                'value'         => 'test3'
            ]
        ];

        $collection = new ArrayCollection();

        foreach ($expectedData as $item) {
            $collection->add($this->createEntity($item));
        }

        $data = $this->serializer->collectionToArray($collection);

        \PHPUnit_Framework_Assert::assertEquals($expectedData, $data);
    }

    /**
     * @param array              $data
     * @param DummyEntityDefault $entity
     */
    public function checkEntity(array $data, DummyEntityDefault $entity)
    {
        $createdAt = DateTime::createFromFormat(self::DATE_TIME_FORMAT, $data['createdAt']);
        $updatedAt = DateTime::createFromFormat(self::DATE_TIME_FORMAT, $data['updatedAt']);

        \PHPUnit_Framework_Assert::assertEquals(new IntegerIndex($data['id']), $entity->getId());
        \PHPUnit_Framework_Assert::assertEquals($createdAt, $entity->getCreatedAt(), '', 1);
        \PHPUnit_Framework_Assert::assertEquals($updatedAt, $entity->getUpdatedAt(), '', 1);
        \PHPUnit_Framework_Assert::assertEquals(new IntegerIndex($data['externalIndex']), $entity->getExternalIndex());
    }

    /**
     * @param array $data
     *
     * @return Entity
     */
    public function createEntity(array $data):Entity
    {
        $entity = new DummyEntityDefault();

        $entity->setId(new IntegerIndex($data['id']));
        $entity->setCreatedAt(DateTime::createFromFormat(self::DATE_TIME_FORMAT, $data['createdAt']));
        $entity->setUpdatedAt(DateTime::createFromFormat(self::DATE_TIME_FORMAT, $data['updatedAt']));
        $entity->setExternalIndex(new IntegerIndex($data['externalIndex']));
        $entity->setValue($data['value']);

        return $entity;
    }
}