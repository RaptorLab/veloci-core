<?php
/**
 * Created by PhpStorm.
 * User: christian
 * Date: 1/14/17
 * Time: 1:47 AM
 */

namespace Veloci\Core\Factory;

use Veloci\Core\Entity;

/**
 * Interface EntityFactory
 *
 * @package Veloci\Core\Factory
 */
interface EntityFactory
{
    /**
     * @param string $class
     * @param array  $data
     *
     * @return null|Entity
     */
    public function createInstance(string $class, array $data = []):?Entity;
}