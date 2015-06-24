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
 * @version    1.0.1
 * @author     Cartalyst LLC
 * @license    BSD License (3-clause)
 * @copyright  (c) 2011-2015, Cartalyst LLC
 * @link       http://cartalyst.com
 */

use Cartalyst\Support\Traits\RepositoryTrait;
use Mockery as m;
use PHPUnit_Framework_TestCase;

class RepositoryTraitTest extends PHPUnit_Framework_TestCase {

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
	public function it_can_set_and_retrieve_the_model()
	{
		$foo = new RepositoryTraitStub;

		$foo->setModel('Foo');

		$this->assertEquals('Foo', $foo->getModel());
	}

	/** @test **/
	public function it_can_create_a_model()
	{
		$foo = new RepositoryTraitStub;

		$foo->setModel('StdClass');

		$this->assertInstanceOf('StdClass', $foo->createModel());
	}

}

class RepositoryTraitStub {

	use RepositoryTrait;

}
