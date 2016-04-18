<?php
/**
 * Created by PhpStorm.
 * User: christian
 * Date: 18/04/16
 * Time: 05:52
 */

namespace Configuration;


use Veloci\Core\Configuration\DatabaseConfigurationDefault;

class DatabaseConfigurationDefaultTest extends \PHPUnit_Framework_TestCase
{
    public function testGettersAndSetters()
    {
        $databaseType = 'mongodb';

        $databaseConfiguration = new DatabaseConfigurationDefault($databaseType);

        \PHPUnit_Framework_Assert::assertEquals($databaseType, $databaseConfiguration->getType());
    }
}
