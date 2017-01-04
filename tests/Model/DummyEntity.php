<?php
/**
 * Created by PhpStorm.
 * User: christian
 * Date: 1/4/17
 * Time: 11:26 AM
 */

namespace Veloci\Core\Model;

use DateTime;
use Veloci\Core\EntityIndex;


/**
 * Class DummyEntity
 *
 * @package Veloci\Core\Helper
 */
class DummyEntity extends AbstractEntity
{

    /**
     * @var IntegerIndex
     */
    protected $externalIndex;

    /**
     * @param EntityIndex $id
     */
    public function setId(EntityIndex $id)
    {
        $this->id = $id;
    }

    /**
     * @param DateTime $createdAt
     */
    public function setCreatedAt(DateTime $createdAt)
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @param DateTime $updatedAt
     */
    public function setUpdatedAt(DateTime $updatedAt)
    {
        $this->updatedAt = $updatedAt;
    }

    /**
     * @return EntityIndex
     */
    public function getExternalIndex(): EntityIndex
    {
        return $this->externalIndex;
    }

    /**
     * @param IntegerIndex $externalIndex
     */
    public function setExternalIndex(IntegerIndex $externalIndex)
    {
        $this->externalIndex = $externalIndex;
    }
}