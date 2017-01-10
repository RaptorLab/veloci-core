<?php
/**
 * Created by PhpStorm.
 * User: christian
 * Date: 1/8/17
 * Time: 4:27 PM
 */

namespace Veloci\Core\Model;


class IntegerIndexTest extends \PHPUnit_Framework_TestCase
{
    public function test()
    {
        $value = 10;

        $index = new IntegerIndex($value);

        \PHPUnit_Framework_Assert::assertEquals($value, $index->getValue());
        \PHPUnit_Framework_Assert::assertEquals($index, $index);
        \PHPUnit_Framework_Assert::assertEquals(new IntegerIndex($value), $index);
        \PHPUnit_Framework_Assert::assertNotEquals(new IntegerIndex($value + 2), $index);
    }
}
