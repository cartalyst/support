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
			$this->getRealValidator()
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
			$this->getRealValidator()
		);

		$this->assertInstanceOf('Cartalyst\Support\Validator', $validator);
	}

	/** @test */
	public function it_can_get_and_set_the_rules()
	{
		$this->assertCount(1, $this->validator->getRules());

		$this->validator->setRules([]);
		$this->assertCount(0, $this->validator->getRules());

		$this->validator->setRules([
			'name'  => 'required',
			'email' => 'required',
		]);
		$this->assertCount(2, $this->validator->getRules());
	}

	/** @test */
	public function it_can_define_scenarios()
	{
		$scenario = $this->validator->on('update', [ 'foo' ]);

		$this->assertInstanceOf('Cartalyst\Support\Validator', $scenario);
	}

	/** @test */
	public function it_can_register_bindings()
	{
		$this->validator->bind([ 'foo' => 'bar' ]);
	}




	/** @test */
	public function it_can_validate()
	{
		$messages = $this->validator->validate([]);

		$this->assertCount(1, $messages);

		$messages = $this->validator->on('update')->bind([ 'email' => 'popop@asdad.com' ])->validate([
			'email' => 'john@doe.com'
		]);

		$this->assertTrue($messages->isEmpty());
	}

	protected function getRealValidator()
	{
		$trans = new \Symfony\Component\Translation\Translator('en', new \Symfony\Component\Translation\MessageSelector);
		$trans->addLoader('array', new \Symfony\Component\Translation\Loader\ArrayLoader);

		return new IlluminateValidator($trans);
	}

}

class ValidatorStub extends Validator {

	protected $rules = [
		'email' => 'required|email',
	];

	public function onUpdate()
	{

	}

}
