<?php
/**
 * Created by PhpStorm.
 * User: christian
 * Date: 1/14/17
 * Time: 10:35 AM
 */
namespace Veloci\Core\Model;

use DateTime;
use Veloci\Core\Entity;
use Veloci\Core\EntityIndex;


/**
 * Class DummyEntity
 *
 * @package Veloci\Core\Helper
 */
interface DummyEntity extends Entity
{
    /**
     * @return EntityIndex
     */
    public function getId() : EntityIndex;

    /**
     * @return DateTime
     */
    public function getCreatedAt() : DateTime;

    /**
     * @return DateTime
     */
    public function getUpdatedAt() : DateTime;

    /**
     * @return EntityIndex
     */
    public function getExternalIndex() : EntityIndex;

    /**
     * @return mixed
     */
    public function getValue();
}