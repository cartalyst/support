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
 * @version    1.1.0
 * @author     Cartalyst LLC
 * @license    Cartalyst PSL
 * @copyright  (c) 2011-2014, Cartalyst LLC
 * @link       http://cartalyst.com
 */

abstract class ServiceProvider extends \Illuminate\Support\ServiceProvider {

	/**
	 * Registers a binding if it hasn't already been registered.
	 *
	 * @param  string  $abstract
	 * @param  \Closure|string|null  $concrete
	 * @param  string  $interface
	 * @return void
	 */
	protected function bindIf($abstract, $concrete = null, $interface = null)
	{
		$concrete = $concrete ?: $abstract;

		$this->app->bindIf($abstract, $concrete);

		if ( ! $concrete instanceof \Closure)
		{
			$interface = $interface ?: "{$concrete}Interface";
		}

		if ($interface)
		{
			$this->app->alias($abstract, $interface);
		}
	}

}
