<?php
/**
 * Created by PhpStorm.
 * User: christian
 * Date: 1/4/17
 * Time: 4:14 AM
 */

namespace Veloci\Core\Model;


use Veloci\Core\EntityIndex;

/**
 * Class IntegerIndex
 *
 * @package Veloci\Core\Model
 */
class IntegerIndex implements EntityIndex
{
    /**
     * @var int
     */
    private $value;

    /**
     * IntegerIndex constructor.
     *
     * @param int $value
     */
    public function __construct(int $value) {

        $this->value = $value;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @return string
     */
    public function __toString():string
    {
        return (string)$this->value;
    }
}