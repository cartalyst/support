<?php namespace Cartalyst\Support\Traits;
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

use Illuminate\Support\Fluent;
use Illuminate\Support\Facades\Validator;

trait ValidatorTrait {

	/**
	 * The registered scenario.
	 *
	 * @var array
	 */
	protected $scenario = [];

	/**
	 * The registered bindings
	 *
	 * @var array
	 */
	protected $bindings = [];

	/**
	 * Create a scope scenario.
	 *
	 * @param  string  $scenario
	 * @param  array  $arguments
	 * @return $this
	 */
	public function onScenario($scenario, array $arguments = [])
	{
		$method = 'on'.ucfirst($scenario);

		$this->scenario = [
			'on'        => method_exists($this, $method) ? $method : null,
			'arguments' => $arguments,
		];

		return $this;
	}

	/**
	 * Register the bindings.
	 *
	 * @param  array  $bindings
	 * @return $this
	 */
	public function registerBindings(array $bindings)
	{
		$this->bindings = array_merge($this->bindings, $bindings);

		return $this;
	}

	/**
	 * Executes the data validation against the service rules.
	 *
	 * @param  array  $data
	 * @return \Illuminate\Validation\Validator
	 */
	public function executeValidation(array $data)
	{
		if (is_null($this->scenario))
		{
			$this->onScenario('any');
		}

		if ($method = array_get($this->scenario, 'on', null))
		{
			call_user_func_array([$this, $method], $this->scenario['arguments']);
		}

		$rules = (new Fluent($this->getBindedRules()))->getAttributes();

		return Validator::make($data, $rules);
	}

	/**
	 * Returns the validation rules.
	 *
	 * @return array
	 */
	public function getRules()
	{
		return [];
	}

	/**
	 * Returns the rules already binded.
	 *
	 * @return array
	 */
	protected function getBindedRules()
	{
		$rules = $this->getRules();

		foreach ($rules as $key => $value)
		{
			if ($binding = array_get($this->bindings, $key, null))
			{
				$rules[$key] = str_replace('{'.$key.'}', $binding, $value);
			}
		}

		return $rules;
	}

}
