<?php
/**
 * Created by PhpStorm.
 * User: christian
 * Date: 18/04/16
 * Time: 08:16
 */

namespace Helper\Validation\Rule;


use Veloci\Core\Helper\Validation\Rule\IntegerRule;
use Veloci\Core\Helper\Validation\Rule\ValidationRules;

class IntegerRuleTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function shouldValidate() {
        $rule = new IntegerRule();

        \PHPUnit_Framework_Assert::assertTrue($rule->validate(10));
        \PHPUnit_Framework_Assert::assertFalse($rule->validate('not an integer'));
        \PHPUnit_Framework_Assert::assertFalse($rule->validate('10'));
    }

    /**
     * @test
     */
    public function shouldGetType() {
        $rule = new IntegerRule();

        \PHPUnit_Framework_Assert::assertEquals(ValidationRules::INTEGER, $rule->getType());
    }

    /**
     * @test
     */
    public function shouldGetMessage() {
        $rule = new IntegerRule();

        \PHPUnit_Framework_Assert::assertEquals('The field aField must be an integer', $rule->getMessage('aField'));
    }
}
