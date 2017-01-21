<?php
/**
 * Created by PhpStorm.
 * User: christian
 * Date: 1/14/17
 * Time: 2:04 AM
 */

namespace Veloci\Core\Factory;


use ReflectionClass;
use Veloci\Core\Helper\DependencyInjectionContainer;
use Veloci\Core\Entity;
use Veloci\Core\Helper\Serializer\EntitySerializer;

/**
 * Class ContainerAwareEntityFactory
 *
 * @package Veloci\Core\Factory
 */
class ContainerAwareEntityFactory implements EntityFactory
{
    /**
     * @var DependencyInjectionContainer
     */
    private $container;

    /**
     * @var EntitySerializer
     */
    private $entitySerializer;

    /**
     * ContainerAwareEntityFactory constructor.
     *
     * @param DependencyInjectionContainer $container
     * @param EntitySerializer             $entitySerializer
     */
    public function __construct(DependencyInjectionContainer $container, EntitySerializer $entitySerializer)
    {
        $this->container        = $container;
        $this->entitySerializer = $entitySerializer;
    }

    /**
     * @param string $class
     * @param array  $data
     *
     * @return null|Entity
     */
    public function createInstance(string $class, array $data = []):?Entity
    {
        $implementationClass = $this->getImplementationClass($class);

        if ($implementationClass) {
            /** @var Entity $instance */
            $this->entitySerializer->arrayToObject($data, $implementationClass);

            return $instance;
        }

        return null;
    }

    /**
     * @param string $class
     *
     * @return null|string
     */
    private function getImplementationClass(string $class):?string
    {
        $reflectionClass = new ReflectionClass($class);

        if ($reflectionClass->implementsInterface(Entity::class)) {
            return $reflectionClass->isInterface()
                ? $this->container->getImplementationClass($class)
                : $class;
        }

        return null;
    }
}