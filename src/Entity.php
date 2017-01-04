<?php
/**
 * Created by PhpStorm.
 * User: christian
 * Date: 1/4/17
 * Time: 2:11 AM
 */

namespace Veloci\Core;


use DateTime;

/**
 * Interface Entity
 *
 * @package Veloci\Core
 */
interface Entity
{
    /**
     * @return EntityIndex
     */
    public function getId():EntityIndex;

    /**
     * @return DateTime
     */
    public function getCreatedAt():DateTime;

    /**
     * @return DateTime
     */
    public function getUpdatedAt():DateTime;
}