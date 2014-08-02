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
	 * The event dispatcher status.
	 *
	 * @var bool
	 */
	protected $dispatchingStatus = true;

	/**
	 * Returns the event dispatcher.
	 *
	 * @return \Illuminate\Events\Dispatcher
	 */
	public function getDispatcher()
	{
		return $this->dispatcher;
	}

	/**
	 * Sets the event dispatcher instance.
	 *
	 * @param  \Illuminate\Events\Dispatcher  $dispatcher
	 * @return $this
	 */
	public function setDispatcher(Dispatcher $dispatcher)
	{
		$this->dispatcher = $dispatcher;

		return $this;
	}

	/**
	 * Returns the event dispatcher status.
	 *
	 * @return mixed
	 */
	public function getDispatcherStatus()
	{
		return $this->dispatchingStatus;
	}

	/**
	 * Sets the event dispatcher status.
	 *
	 * @param  bool  $status
	 * @return $this
	 */
	public function setDispatcherStatus($status)
	{
		$this->dispatchingStatus = (bool) $status;

		return $this;
	}

	/**
	 * Enables the event dispatcher.
	 *
	 * @return $this
	 */
	public function enableDispatcher()
	{
		$this->dispatchingStatus = true;

		return $this;
	}

	/**
	 * Disables the event dispatcher.
	 *
	 * @return $this
	 */
	public function disableDispatcher()
	{
		$this->dispatchingStatus = false;

		return $this;
	}

	/**
	 * Fires an event.
	 *
	 * @param  string  $event
	 * @param  mixed  $payload
	 * @param  bool  $halt
	 * @return mixed
	 */
	protected function fireEvent($event, $payload = [], $halt = false)
	{
		$dispatcher = $this->dispatcher;

		$status = $this->dispatchingStatus;

		if ( ! $dispatcher || $status === false) return;

		$method = $halt ? 'until' : 'fire';

		return $dispatcher->{$method}($event, $payload);
	}

}
