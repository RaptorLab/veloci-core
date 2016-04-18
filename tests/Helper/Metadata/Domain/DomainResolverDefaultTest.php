<?php
/**
 * Created by PhpStorm.
 * User: christian
 * Date: 18/04/16
 * Time: 08:44
 */

namespace Helper\Metadata\Domain;


use Veloci\Core\Helper\Metadata\Domain\BooleanDomain;
use Veloci\Core\Helper\Metadata\Domain\DomainResolverDefault;
use Veloci\Core\Helper\Metadata\Domain\IntegerDomain;
use Veloci\Core\Helper\Metadata\Domain\StringDomain;
use Veloci\Core\Helper\Validation\Rule\IntegerRule;
use Veloci\Core\Repository\KeyValueStore;

class DomainResolverDefaultTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @test
     *
     * @expectedException \InvalidArgumentException
     */
    public function shouldResolveDomain()
    {
        $store = $this->mockStore();

        $store->shouldReceive('set')->with('int', IntegerDomain::class);
        $store->shouldReceive('set')->with('bool', BooleanDomain::class);
        $store->shouldReceive('set')->with('string', StringDomain::class);

        $domainResolver = new DomainResolverDefault($store);

//        $domainResolver->resolveDomain('int')

        $domainResolver->setDomain('wrong', IntegerRule::class);
    }

    /**
     * @return \Mockery\MockInterface|KeyValueStore
     */
    private function mockStore():KeyValueStore
    {
        return \Mockery::mock(KeyValueStore::class);
    }
}
