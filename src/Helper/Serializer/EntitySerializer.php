<?php
/**
 * Created by PhpStorm.
 * User: christian
 * Date: 1/4/17
 * Time: 2:26 AM
 */

namespace Veloci\Core\Helper\Serializer;


use Veloci\Core\Contract\POJO;
use Iterator;

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
     * @return POJO
     */
    public function arrayToObject(array $data, string $class):POJO;

    /**
     * @param POJO $entity
     *
     * @return array
     */
    public function objectToArray(POJO $entity):array;

    /**
     * @param array  $data
     * @param string $class
     *
     * @return Iterator
     */
    public function arrayToCollection(array $data, string $class):Iterator;

    /**
     * @param Iterator $collection
     *
     * @return array
     *
     */
    public function collectionToArray(Iterator $collection):array;
}