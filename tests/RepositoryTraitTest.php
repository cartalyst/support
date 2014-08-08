<?php namespace Cartalyst\Support\Tests;
/**
 * Part of the Support package.
 *
 * NOTICE OF LICENSE
 *
 * Licensed under the Cartalyst PSL License.
 *
 * This source file is subject to the Cartalyst PSL License that is
 * bundled with this package in the license.txt file.
 *
 * @package    Support
 * @version    1.1.0
 * @author     Cartalyst LLC
 * @license    Cartalyst PSL
 * @copyright  (c) 2011-2014, Cartalyst LLC
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
