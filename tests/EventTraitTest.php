<?php namespace Cartalyst\Support\Tests;
/**
 * Part of the Support package.
 *
 * NOTICE OF LICENSE
 *
 * Licensed under the 3-clause BSD License.
 *
 * This source file is subject to the 3-clause BSD License that is
 * bundled with this package in the LICENSE file.
 *
 * @package    Support
 * @version    1.0.0
 * @author     Cartalyst LLC
 * @license    BSD License (3-clause)
 * @copyright  (c) 2011-2015, Cartalyst LLC
 * @link       http://cartalyst.com
 */

use Cartalyst\Support\Traits\EventTrait;
use Mockery as m;
use PHPUnit_Framework_TestCase;

class EventTraitTest extends PHPUnit_Framework_TestCase {

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
	public function it_can_set_and_retrieve_the_dispatchcer()
	{
		$foo = new EventTraitStub;

		$dispatcher = m::mock('Illuminate\Events\Dispatcher');

		$foo->setDispatcher($dispatcher);

		$this->assertSame($foo->getDispatcher(), $dispatcher);
	}

	/** @test **/
	public function it_can_set_and_retrieve_the_dispatcher_status()
	{
		$foo = new EventTraitStub;

		$dispatcher = m::mock('Illuminate\Events\Dispatcher');

		$dispatcher->shouldReceive('fire')->once();

		$foo->setDispatcher($dispatcher);

		$foo->disableDispatcher();

		$this->assertFalse($foo->getDispatcherStatus());

		$foo->testEvent();

		$foo->enableDispatcher();

		$this->assertTrue($foo->getDispatcherStatus());

		$foo->testEvent();
	}

	/** @test **/
	public function it_can_chain_methods()
	{
		$foo = new EventTraitStub;

		$dispatcher = m::mock('Illuminate\Events\Dispatcher');

		$this->assertInstanceOf('Cartalyst\Support\Tests\EventTraitStub', $foo->setDispatcher($dispatcher));
		$this->assertInstanceOf('Cartalyst\Support\Tests\EventTraitStub', $foo->setDispatcherStatus(false));
		$this->assertInstanceOf('Cartalyst\Support\Tests\EventTraitStub', $foo->enableDispatcher());
		$this->assertInstanceOf('Cartalyst\Support\Tests\EventTraitStub', $foo->disableDispatcher());
	}

}

class EventTraitStub {

	use EventTrait;

	public function testEvent()
	{
		$this->fireEvent('test');
	}

}
