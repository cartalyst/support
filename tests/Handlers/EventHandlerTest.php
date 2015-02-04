<?php

/**
 * Part of the Support package.
 *
 * NOTICE OF LICENSE
 *
 * Licensed under the Cartalyst PSL License.
 *
 * This source file is subject to the Cartalyst PSL License that is
 * bundled with this package in the LICENSE file.
 *
 * @package    Support
 * @version    1.1.1
 * @author     Cartalyst LLC
 * @license    Cartalyst PSL
 * @copyright  (c) 2011-2015, Cartalyst LLC
 * @link       http://cartalyst.com
 */

namespace Cartalyst\Support\Tests\Handlers;

use PHPUnit_Framework_TestCase;
use Illuminate\Container\Container;
use Cartalyst\Support\Handlers\EventHandler;

class EventHandlerTest extends PHPUnit_Framework_TestCase
{
    /** @test **/
    public function it_can_be_instantiated()
    {
        new EventHandlerStub(new Container);
    }

    /** @test */
    public function it_can_retrieve_dynamic_objects_from_the_container()
    {
        $container = new Container;
        $container->bind('foo', function () { return 'bar'; });

        $handler = new EventHandlerStub($container);

        $this->assertSame('bar', $handler->foo);
    }
}

class EventHandlerStub extends EventHandler
{
}
