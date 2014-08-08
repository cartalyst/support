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
 * @version    1.1.0
 * @author     Cartalyst LLC
 * @license    Cartalyst PSL
 * @copyright  (c) 2011-2014, Cartalyst LLC
 * @link       http://cartalyst.com
 */

use Cartalyst\Support\Validator;

trait ValidatorTrait {

	protected $validator;

	public function setValidator(Validator $validator)
	{
		$this->validator = $validator;

		return $this;
	}

	public function getValidator()
	{
		return $this->validator;
	}

}
