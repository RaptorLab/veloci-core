<?php
/**
 * Created by PhpStorm.
 * User: christian
 * Date: 1/4/17
 * Time: 2:34 AM
 */

namespace Veloci\Core\Model;


use DateTime;
use Veloci\Core\Entity;
use Veloci\Core\EntityIndex;

/**
 * Class AbstractEntity
 *
 * @package Veloci\Core\Model
 */
abstract class AbstractEntity implements Entity
{
    /**
     * @var EntityIndex
     */
    protected $id;

    /**
     * @var DateTime
     */
    protected $createdAt;

    /**
     * @var DateTime
     */
    protected $updatedAt;

    /**
     * @return EntityIndex
     */
    public function getId():EntityIndex
    {
        return $this->id;
    }

    /**
     * @return DateTime
     */
    public function getCreatedAt():DateTime
    {
        return $this->createdAt;
    }

    /**
     * @return DateTime
     */
    public function getUpdatedAt():DateTime
    {
        return $this->updatedAt;
    }
}