<?php
/**
 * Created by PhpStorm.
 * User: christian
 * Date: 18/04/16
 * Time: 08:31
 */

namespace Helper;


use Veloci\Core\Helper\ClassHelper;
use Veloci\Core\Helper\Validation\Rule\IntegerRule;

class ClassHelperTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function shouldReturnsClassName()
    {
        $class     = new IntegerRule();
        $classType = get_class($class);

        \PHPUnit_Framework_Assert::assertEquals($classType, ClassHelper::getClassName($class));
        \PHPUnit_Framework_Assert::assertEquals($classType, ClassHelper::getClassName($classType));  }
}
