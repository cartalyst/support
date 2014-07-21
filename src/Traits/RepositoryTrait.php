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

use Cartalyst\Support\Contracts\ValidatorInterface;

trait RepositoryTrait {

	/**
	 * The model name.
	 *
	 * @var string
	 */
	protected $model;

	/**
	 * The validator instance.
	 *
	 * @var \Cartalyst\Support\Contracts\ValidatorInterface
	 */
	protected $validator;

	/**
	 * Create a new instance of the model.
	 *
	 * @param  array  $data
	 * @return mixed
	 */
	public function createModel(array $data = [])
	{
		$class = '\\'.ltrim($this->model, '\\');

		return new $class($data);
	}

	/**
	 * Returns the model.
	 *
	 * @return string
	 */
	public function getModel()
	{
		return $this->model;
	}

	/**
	 * Runtime override of the model.
	 *
	 * @param  string  $model
	 * @return mixed
	 */
	public function setModel($model)
	{
		$this->model = $model;

		return $this;
	}

	/**
	 * Returns the validator instance.
	 *
	 * @return \Cartalyst\Support\Contracts\ValidatorInterface
	 */
	public function getValidator()
	{
		return $this->validator;
	}

	/**
	 * Sets the validator instance.
	 *
	 * @param  \Cartalyst\Support\Contracts\ValidatorInterface  $validator
	 * @return mixed
	 */
	public function setValidator(ValidatorInterface $validator)
	{
		$this->validator = $validator;

		return $this;
	}

}
