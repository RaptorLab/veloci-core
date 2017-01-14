<?php
/**
 * Created by PhpStorm.
 * User: christian
 * Date: 1/14/17
 * Time: 1:47 AM
 */

namespace Veloci\Core\Factory;

use Veloci\Core\Entity;

interface EntityFactory
{
    public function createInstance(string $class, array $data = []):?Entity;
}