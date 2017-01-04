<?php
/**
 * Created by PhpStorm.
 * User: christian
 * Date: 1/4/17
 * Time: 11:19 AM
 */

namespace Veloci\Core\Repository;


use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Criteria;
use Traversable;
use Veloci\Core\Entity;
use Veloci\Core\EntityIndex;

class InMemoryEntityRepository implements EntityRepository
{

    /**
     * @var ArrayCollection
     */
    private $collection;

    public function __construct()
    {
        $this->collection = new ArrayCollection();
    }

    /**
     * @param EntityIndex $id
     *
     * @return Entity
     */
    public function get(EntityIndex $id):?Entity
    {
        return $this->collection->get((string)$id);
    }

    /**
     * @param Criteria $criteria
     *
     * @return Traversable
     */
    public function getBy(Criteria $criteria):Traversable
    {
        return $this->collection->matching($criteria);
    }

    /**
     * @param Entity $entity
     *
     */
    public function save(Entity $entity)
    {
        $this->collection->set((string)$entity->getId(), $entity);
    }

    /**
     * @param Entity $entity
     *
     */
    public function delete(Entity $entity)
    {
        $this->collection->remove((string)$entity->getId());
    }

    /**
     * @param Entity $entity
     *
     * @return bool
     */
    public function exists(Entity $entity):bool
    {
        return null !== $this->get($entity->getId());
    }
}