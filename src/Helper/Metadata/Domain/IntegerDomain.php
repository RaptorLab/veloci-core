<?php
/**
 * Created by PhpStorm.
 * User: christian
 * Date: 25/03/16
 * Time: 13:15
 */

namespace Veloci\Core\Helper\Metadata\Domain;


class IntegerDomain extends AbstractDomain
{
    /**
     * @var null|int
     */
    private $min;

    /**
     * @var null|int
     */
    private $max;

    public function __construct($min = null, $max = null)
    {
        $this->min = $min;
        $this->max = $max;
    }

    /**
     * @param $value
     * @return bool
     */
    public function validate($value):bool
    {
        return is_int($value) && ($this->min === null || $this->min <= $value) && ($this->max === null || $this->max >= $value);
    }

    public function getType():string
    {
        return sprintf('int [%d, %d]', $this->min, $this->max);
    }

    public static function create(string $init = null):Domain
    {
        if (!empty($init)) {
            $result = explode(',', trim($init));

            if (count($result) === 2) {
                $min = empty($result[0]) ? null : (int)$result[0];
                $max = empty($result[1]) ? null : (int)$result[1];

                if ($min > $max && $min !== null && $max !== null) {
                    $tmp = $max;
                    $max = $min;
                    $min = $tmp;
                }

                return new static ($min, $max);
            }
        }

        return parent::create($init);
    }

    /**
     * @return null|int
     */
    public function getMin()
    {
        return $this->min;
    }

    /**
     * @return null|int
     */
    public function getMax()
    {
        return $this->max;
    }
}