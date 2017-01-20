<?php
/**
 * Created by PhpStorm.
 * User: christian
 * Date: 1/4/17
 * Time: 2:30 AM
 */

namespace Veloci\Core\Helper\Serializer;


use Veloci\Core\Contract\POJO;
use Doctrine\Common\Collections\ArrayCollection;
use Iterator;
use Symfony\Component\Serializer\Serializer;

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
     * @return POJO
     */
    public function arrayToObject(array $data, string $class):POJO
    {
        return $this->serializer->denormalize($data, $class);
    }

    /**
     * @param POJO $entity
     *
     * @return array
     */
    public function objectToArray(POJO $entity):array
    {
        return $this->serializer->normalize($entity, 'json');
    }

    /**
     * @param array  $data
     * @param string $class
     *
     * @return Iterator
     */
    public function arrayToCollection(array $data, string $class):Iterator
    {
        $result = new ArrayCollection();

        foreach ($data as $item) {
            $result->add($this->arrayToObject($item, $class));
        }

        return $result->getIterator();
    }

    /**
     * @param Iterator $collection
     *
     * @return array
     */
    public function collectionToArray(Iterator $collection):array
    {
        $result = [];

        foreach($collection as $entity) {
            $result[] = $this->objectToArray($entity);
        }

        return $result;
    }
}