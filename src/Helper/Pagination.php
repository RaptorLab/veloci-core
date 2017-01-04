<?php
/**
 * Created by PhpStorm.
 * User: christian
 * Date: 1/4/17
 * Time: 11:15 AM
 */

namespace Veloci\Core\Helper;

use DateTime;

interface Pagination
{
    public function getPage():int;

    public function getCount():int;

    public function getFromDate():DateTime;
}