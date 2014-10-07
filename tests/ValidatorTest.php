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

use Mockery as m;
use PHPUnit_Framework_TestCase;
use Cartalyst\Support\Validator;
use Illuminate\Validation\Factory as IlluminateValidator;

class ValidatorTest extends PHPUnit_Framework_TestCase {

	/**
	 * The Validator instance.
	 *
	 * @var \Cartalyst\Support\Validator
	 */
	protected $validator;

	/**
	 * Setup resources and dependencies
	 */
	public function setUp()
	{
		$this->validator = new ValidatorStub(
			m::mock('Illuminate\Validation\Factory')
		);
	}

	/**
	 * Close mockery.
	 *
	 * @return void
	 */
	public function tearDown()
	{
		m::close();
	}

	/** @test */
	public function it_can_be_instantiated()
	{
		$validator = new ValidatorStub(
			m::mock('Illuminate\Validation\Factory')
		);

		$this->assertInstanceOf('Cartalyst\Support\Validator', $validator);
	}

	/** @test */
	public function it_can_define_on_scenarios()
	{
		$validator = new ValidatorStub(
			m::mock('Illuminate\Validation\Factory')
		);

		$scenario = $validator->on('update', ['foo']);

		$this->assertInstanceOf('Cartalyst\Support\Validator', $scenario);
	}

}

class ValidatorStub extends Validator {

}
