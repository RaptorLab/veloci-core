<?php
/**
 * Created by PhpStorm.
 * User: christian
 * Date: 25/03/16
 * Time: 14:09
 */

namespace Core\Helper\Metadata\Domain;


use Veloci\Core\Helper\Metadata\Domain\IntegerDomain;
use Veloci\Core\Helper\Validation\Rule\IntegerRule;

class IntegerDomainTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @test
     *
     * @dataProvider providerValidate
     * @param $value
     * @param $min
     * @param $max
     *
     * @param bool $expectedResult
     */
    public function shouldValidate($value, $min, $max, bool $expectedResult)
    {
        $domain = new IntegerDomain($min, $max);

        $result = $domain->validate($value);

        \PHPUnit_Framework_Assert::assertEquals($expectedResult, $result);
    }

    /**
     * @test
     *
     * @dataProvider providerCreate
     *
     *
     */
    public function shouldCreateFromString($string, $min, $max)
    {
        /** @var IntegerDomain $domain */
        $domain = IntegerDomain::create($string);

        \PHPUnit_Framework_Assert::assertEquals($min, $domain->getMin());
        \PHPUnit_Framework_Assert::assertEquals($max, $domain->getMax());
    }

    public function providerValidate()
    {
        return [
            [10, null, null, true],
            [-10, null, null, true],
            [null, null, null, false],
            ['not a number', null, null, false],
            ['10', null, null, false],
            [10, 5, null, true],
            [10, null, 5, false],
            [10, 5, 15, true],
            [-10, -15, -5, true],
            [10, 10, 10, true]
        ];
    }

    public function providerCreate()
    {
        return [
            ['', null, null],
            [null, null, null],
            ['1,', 1, null],
            [',3', null, 3],
            ['3,6', 3, 6],
            ['   3  ,  7  ', 3, 7],
            ['9, 3', 3, 9],
            [',', null, null],
            ['-9, -3', -9, -3],
        ];
    }
}
