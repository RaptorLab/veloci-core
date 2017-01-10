<?php
/**
 * Created by PhpStorm.
 * User: christian
 * Date: 1/4/17
 * Time: 2:26 AM
 */

namespace Veloci\Core\Helper\Serializer;


use Traversable;
use Veloci\Core\Entity;

/**
 * Class EntitySerializator
 *
 * @package Veloci\Core\Helper
 */
interface EntitySerializer
{
    /**
     * @param array  $data
     * @param string $class
     *
     * @return Entity
     */
    public function arrayToEntity(array $data, string $class):Entity;

    /**
     * @param Entity $entity
     *
     * @return array
     */
    public function entityToArray(Entity $entity):array;

    /**
     * @param array  $data
     * @param string $class
     *
     * @return Traversable
     */
    public function arrayToCollection(array $data, string $class):Traversable;

    /**
     * @param Entity[] $collection
     *
     * @return array
     *
     */
    public function collectionToArray(Traversable $collection):array;
}