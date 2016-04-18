<?php
/**
 * Created by PhpStorm.
 * User: christian
 * Date: 18/04/16
 * Time: 08:22
 */

namespace Helper\Validation\Rule;


use Veloci\Core\Helper\Validation\Rule\RequiredRule;
use Veloci\Core\Helper\Validation\Rule\ValidationRules;

class RequiredRuleTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function shouldValidate() {
        $rule = new RequiredRule();

        \PHPUnit_Framework_Assert::assertTrue($rule->validate(10));
        \PHPUnit_Framework_Assert::assertTrue($rule->validate(0));
        \PHPUnit_Framework_Assert::assertTrue($rule->validate('random string'));
        \PHPUnit_Framework_Assert::assertFalse($rule->validate(null));
    }

    /**
     * @test
     */
    public function shouldGetType() {
        $rule = new RequiredRule();

        \PHPUnit_Framework_Assert::assertEquals(ValidationRules::REQUIRED, $rule->getType());
    }

    /**
     * @test
     */
    public function shouldGetMessage() {
        $rule = new RequiredRule();

        \PHPUnit_Framework_Assert::assertEquals('The field aField is required', $rule->getMessage('aField'));
    }
}
