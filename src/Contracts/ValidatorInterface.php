<?php namespace Cartalyst\Support\Contracts;
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

interface ValidatorInterface {

	/**
	 * Returns the validation rules.
	 *
	 * @return array
	 */
	public function getRules();

	/**
	 * Sets the validation rules.
	 *
	 * @param  array  $rules
	 * @return $this
	 */
	public function setRules(array $rules);

	/**
	 * Create a scope scenario.
	 *
	 * @param  string  $scenario
	 * @param  array  $arguments
	 * @return \Cartalyst\Support\Validator
	 */
	public function on($scenario, array $arguments = []);

	/**
	 * Create a scope scenario.
	 *
	 * @param  string  $scenario
	 * @param  array  $arguments
	 * @return $this
	 */
	public function onScenario($scenario, array $arguments = []);

	/**
	 * Register bindings to the scenario.
	 *
	 * @param  array  $bindings
	 * @return \Illuminate\Validation\Validator
	 */
	public function bind(array $bindings);

	/**
	 * Register the bindings.
	 *
	 * @param  array  $bindings
	 * @return $this
	 */
	public function registerBindings(array $bindings);

	/**
	 * Execute validation service.
	 *
	 * @param  array  $data
	 * @return \Illuminate\Validation\Validator
	 */
	public function validate(array $data);

}
