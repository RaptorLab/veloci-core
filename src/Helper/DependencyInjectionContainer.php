<?php
/**
 * Created by PhpStorm.
 * User: christian
 * Date: 1/14/17
 * Time: 1:50 AM
 */

namespace Veloci\Core\Helper;


interface DependencyInjectionContainer
{
    public function bind(string $interface, string $implementation);

    public function singleton(string $interface, string $implementation);

    public function bindWithClosure(string $interface, callable $closure);

    public function singletonWithClosure(string $interface, callable $closure);

    public function getImplementationClass(string $interface):?string;

    public function create(string $interface):?mixed;
}