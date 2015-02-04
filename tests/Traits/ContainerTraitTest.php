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

namespace Cartalyst\Support\Tests\Traits;

use Mockery as m;
use PHPUnit_Framework_TestCase;
use Cartalyst\Support\Traits\ContainerTrait;

class ContainerTraitTest extends PHPUnit_Framework_TestCase
{
    /**
     * Close mockery.
     *
     * @return void
     */
    public function tearDown()
    {
        m::close();
    }

    /** @test **/
    public function it_can_set_and_retrieve_the_container()
    {
        $containerTrait = new ContainerTraitStub;

        $container = m::mock('Illuminate\Container\Container');

        $containerTrait->setContainer($container);

        $this->assertSame($containerTrait->getContainer(), $container);
    }
}

class ContainerTraitStub
{
    use ContainerTrait;
}
