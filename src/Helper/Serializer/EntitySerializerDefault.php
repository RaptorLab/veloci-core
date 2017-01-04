<?php
/**
 * Created by PhpStorm.
 * User: christian
 * Date: 1/4/17
 * Time: 2:30 AM
 */

namespace Veloci\Core\Helper\Serializer;


use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Serializer;
use Traversable;
use Veloci\Core\Entity;

/**
 * Class EntitySerializerDefault
 *
 * @package Veloci\Core\Helper
 */
class EntitySerializerDefault  implements EntitySerializer
{

    /**
     * @var Serializer
     */
    private $serializer;

    /**
     * EntitySerializerDefault constructor.
     *
     * @param Serializer $serializer
     */
    public function __construct(Serializer $serializer) {

        $this->serializer = $serializer;
    }

    /**
     * @param array  $data
     * @param string $class
     *
     * @return Entity
     */
    public function arrayToEntity(array $data, string $class):Entity
    {
        return $this->serializer->denormalize($data, $class);
    }

    /**
     * @param Entity $entity
     *
     * @return array
     */
    public function entityToArray(Entity $entity):array
    {
        return $this->serializer->normalize($entity, 'json');
    }

    /**
     * @param array  $data
     * @param string $class
     *
     * @return Traversable
     */
    public function arrayToCollection(array $data, string $class):Traversable
    {
        $result = new ArrayCollection();

        foreach ($data as $item) {
            $result->add($this->arrayToEntity($item, $class));
        }

        return $result;
    }

    /**
     * @param Entity [] $collection
     *
     * @return array
     */
    public function collectionToArray(Traversable $collection):array
    {
        $result = [];

        foreach($collection as $entity) {
            $result[] = $this->entityToArray($entity);
        }

        return $result;
    }
}