<?php
/**
 * Created by PhpStorm.
 * User: christian
 * Date: 1/4/17
 * Time: 4:13 AM
 */

namespace Veloci\Core;


/**
 * Interface EntityIndex
 *
 * @package Veloci\Core
 */
interface EntityIndex
{
    /**
     * @return mixed
     */
    public function getValue();

    /**
     * @return string
     */
    public function __toString():string;
}