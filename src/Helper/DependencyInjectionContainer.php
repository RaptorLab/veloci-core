<?php
/**
 * Created by PhpStorm.
 * User: christian
 * Date: 1/14/17
 * Time: 1:50 AM
 */

namespace Veloci\Core\Helper;


/**
 * Interface DependencyInjectionContainer
 *
 * @package Veloci\Core\Helper
 */
interface DependencyInjectionContainer
{
    /**
     * @param string $interface
     * @param string $implementation
     *
     * @return mixed
     */
    public function bind(string $interface, string $implementation);

    /**
     * @param string $interface
     * @param string $implementation
     *
     * @return mixed
     */
    public function singleton(string $interface, string $implementation);

    /**
     * @param string   $interface
     * @param callable $closure
     *
     * @return mixed
     */
    public function bindWithClosure(string $interface, callable $closure);

    /**
     * @param string   $interface
     * @param callable $closure
     *
     * @return mixed
     */
    public function singletonWithClosure(string $interface, callable $closure);

    /**
     * @param string $interface
     *
     * @return null|string
     */
    public function getImplementationClass(string $interface):?string;

    /**
     * @param string $interface
     *
     * @return mixed|null
     */
    public function create(string $interface):?mixed;
}