<?php namespace Cartalyst\Support;
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
 * @version    1.0.0
 * @author     Cartalyst LLC
 * @license    Cartalyst PSL
 * @copyright  (c) 2011-2014, Cartalyst LLC
 * @link       http://cartalyst.com
 */

use Cartalyst\Support\Traits\ValidatorTrait;
use Cartalyst\Support\Contracts\ValidatorInterface;

abstract class Validator implements ValidatorInterface {

	use ValidatorTrait;

	/**
	 * The validation rules.
	 *
	 * @var array
	 */
	protected $rules = [];

	/**
	 * {@inheritDoc}
	 */
	public function on($scenario, array $arguments = [])
	{
		return $this->onScenario($scenario, $arguments);
	}

	/**
	 * {@inheritDoc}
	 */
	public function bind(array $bindings)
	{
		return $this->registerBindings($bindings);
	}

	/**
	 * {@inheritDoc}
	 */
	public function validate(array $data)
	{
		return $this->executeValidation($data);
	}

	/**
	 * {@inheritDoc}
	 */
	public function getRules()
	{
		return $this->rules;
	}

}
