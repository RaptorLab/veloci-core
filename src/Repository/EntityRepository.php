<?php
/**
 * Created by PhpStorm.
 * User: christian
 * Date: 1/4/17
 * Time: 2:17 AM
 */

namespace Veloci\Core\Repository;


use Doctrine\Common\Collections\Criteria;
use Iterator;
use Veloci\Core\Entity;
use Veloci\Core\EntityIndex;

/**
 * Interface EntityRepository
 *
 * @package Veloci\Core\Repository
 */
interface EntityRepository
{
    /**
     * @param EntityIndex $id
     *
     * @return Entity
     */
    public function get (EntityIndex $id):?Entity;

    /**
     * @param Criteria $criteria
     *
     * @return Iterator
     */
    public function getBy (Criteria $criteria):Iterator;

    /**
     * @return Iterator
     */
    public function getAll():Iterator;

    /**
     * @param Entity $entity
     *
     */
    public function save (Entity $entity);

    /**
     * @param Entity $entity
     *
     */
    public function delete (Entity $entity);

    /**
     * @param Entity $entity
     *
     * @return bool
     */
    public function exists (Entity $entity):bool;
}