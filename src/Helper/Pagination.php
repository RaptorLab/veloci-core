<?php
/**
 * Created by PhpStorm.
 * User: christian
 * Date: 1/4/17
 * Time: 11:15 AM
 */

namespace Veloci\Core\Helper;

use DateTime;

/**
 * Interface Pagination
 *
 * @package Veloci\Core\Helper
 */
interface Pagination
{
    /**
     * @return int
     */
    public function getPage():int;

    /**
     * @return int
     */
    public function getCount():int;

    /**
     * @return DateTime
     */
    public function getFromDate():DateTime;
}