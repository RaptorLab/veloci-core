<?php
/**
 * Created by PhpStorm.
 * User: christian
 * Date: 18/04/16
 * Time: 06:20
 */

namespace Model;


use DateTime;
use PHPUnit_Framework_Assert;
use Veloci\Core\Model\DateableModel;

class DateableModelTest extends \PHPUnit_Framework_TestCase
{
    public function testGettersAndSetters()
    {
        $trait = $this->getObject();

        $updateTime = $trait->getUpdatedAt();

        PHPUnit_Framework_Assert::assertInstanceOf(DateTime::class, $trait->getCreatedAt());
        PHPUnit_Framework_Assert::assertInstanceOf(DateTime::class, $updateTime);
        PHPUnit_Framework_Assert::assertNull($trait->getDeletedAt());

        $trait->delete();
        $trait->update();

        PHPUnit_Framework_Assert::assertInstanceOf(DateTime::class, $trait->getDeletedAt());
    }

    /**
     * @return DateableModel
     */
    private function getObject()
    {
        return new class {
            use DateableModel;

            public function __construct()
            {
                $now = new DateTime();

                $this->createdAt = $now;
                $this->updatedAt = $now;
            }
        };
    }
}
