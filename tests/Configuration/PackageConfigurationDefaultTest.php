<?php
/**
 * Created by PhpStorm.
 * User: christian
 * Date: 18/04/16
 * Time: 05:54
 */

namespace Configuration;


use Veloci\Core\Configuration\DatabaseConfigurationDefault;
use Veloci\Core\Configuration\PackageConfigurationDefault;

class PackageConfigurationDefaultTest extends \PHPUnit_Framework_TestCase
{
    public function testGettersAndSetters() {
        $configuration = new PackageConfigurationDefault();

        $databaseConfiguration = new DatabaseConfigurationDefault('test');

        $configuration->setDatabase($databaseConfiguration);

        \PHPUnit_Framework_Assert::assertEquals($databaseConfiguration, $configuration->getDatabase());   }
}
