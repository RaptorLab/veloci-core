<?php
/**
 * Created by PhpStorm.
 * User: christian
 * Date: 1/4/17
 * Time: 11:13 AM
 */

namespace DataView;


use Iterator;
use Veloci\Core\Entity;
use Veloci\Core\Helper\Pagination;

/**
 * Interface DataView
 *
 * @package DataView
 */
interface DataView
{
    /**
     * @param $id
     *
     * @return Entity
     */
    public function getById($id):Entity;

    /**
     * @param Pagination $pagination
     *
     * @return Iterator
     */
    public function getAll(Pagination $pagination):Iterator;
}