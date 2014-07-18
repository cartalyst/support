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

use Illuminate\Events\Dispatcher;

trait EventTrait {

	/**
	 * The event dispatcher instance.
	 *
	 * @var \Illuminate\Events\Dispatcher
	 */
	protected $dispatcher;

	/**
	 * Returns the event dispatcher.
	 *
	 * @return string
	 */
	public function getDispatcher()
	{
		return $this->dispatcher;
	}

	/**
	 * Sets the event dispatcher instance.
	 *
	 * @param  string  $dispatcher
	 * @return mixed
	 */
	public function setDispatcher(Dispatcher $dispatcher)
	{
		$this->dispatcher = $dispatcher;

		return $this;
	}

	/**
	 * Fire a Sentinel event.
	 *
	 * @param  string  $event
	 * @param  mixed  $payload
	 * @param  bool  $halt
	 * @return mixed
	 */
	protected function fireEvent($event, $payload = [], $halt = false)
	{
		if ( ! $dispatcher = $this->dispatcher) return;

		$method = $halt ? 'until' : 'fire';

		return $dispatcher->{$method}($event, $payload);
	}

}
