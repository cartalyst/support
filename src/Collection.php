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

use Closure;
use Countable;
use ArrayAccess;

class Collection implements ArrayAccess, Countable {

	/**
	 * Holds all the collection attributes.
	 *
	 * @var array
	 */
	protected $attributes = [];

	/**
	 * Holds all the collection items.
	 *
	 * @var array
	 */
	protected $items = [];

	/**
	 * Constructor.
	 *
	 * @param  mixed  $id
	 * @param  \Closure  $callback
	 * @return void
	 */
	public function __construct($id, Closure $callback = null)
	{
		$this->id = $id;

		$this->executeCallback($callback);
	}

	/**
	 * Returns all of the items in the collection.
	 *
	 * @return array
	 */
	public function all()
	{
		return $this->items;
	}

	/**
	 * Counts the number of items in the collection.
	 *
	 * @return int
	 */
	public function count()
	{
		return count($this->items);
	}

	/**
	 * Executes the given callback.
	 *
	 * @param  \Closure  $callback
	 * @return void
	 */
	public function executeCallback(Closure $callback = null)
	{
		if ($callback instanceof Closure)
		{
			call_user_func($callback, $this);
		}
	}

	/**
	 * Determines if the given item exists in the collection.
	 *
	 * @param  string  $key
	 * @return bool
	 */
	public function exists($key)
	{
		return (bool) $this->offsetExists($key);
	}

	/**
	 * Returns the given item from the collection.
	 *
	 * @param  mixed  $key
	 * @return mixed
	 */
	public function find($key)
	{
		return $this->offsetGet($key);
	}

	/**
	 * Returns the first item from the collection.
	 *
	 * @return mixed|null
	 */
	public function first()
	{
		return count($this->items) > 0 ? reset($this->items) : null;
	}

	/**
	 * Get an attribute from the collection.
	 *
	 * @param  string  $key
	 * @param  mixed  $default
	 * @return mixed
	 */
	public function get($key, $default = null)
	{
		if (array_key_exists($key, $this->attributes))
		{
			return $this->attributes[$key];
		}

		return $default;
	}

	/**
	 * Get the attributes from the collection.
	 *
	 * @return array
	 */
	public function getAttributes()
	{
		return $this->attributes;
	}

	/**
	 * Determines if an item exists in the collection by key.
	 *
	 * @param  mixed  $key
	 * @return bool
	 */
	public function has($key)
	{
		return array_key_exists($key, $this->items);
	}

	/**
	 * Determines if the collection is empty or not.
	 *
	 * @return bool
	 */
	public function isEmpty()
	{
		return empty($this->items);
	}

	/**
	 * Returns the last item from the collection.
	 *
	 * @return mixed|null
	 */
	public function last()
	{
		return count($this->items) > 0 ? end($this->items) : null;
	}

	/**
	 * Determines if the given offset exists.
	 *
	 * @param  string  $key
	 * @return bool
	 */
	public function offsetExists($key)
	{
		$items = $this->items;

		if (isset($items[$key]))
		{
			return true;
		}

		foreach (explode('.', $key) as $part)
		{
			if ( ! isset($items[$part]))
			{
				return false;
			}

			$items = $items[$part];
		}

		return true;
	}

	/**
	 * Get the value for a given offset.
	 *
	 * @param  string  $key
	 * @return mixed
	 */
	public function offsetGet($key)
	{
		$items = $this->items;

		if (array_key_exists($key, $items))
		{
			return $items[$key];
		}

		foreach (explode('.', $key) as $part)
		{
			if ( ! isset($items[$part]))
			{
				return null;
			}

			$items = $items[$part];
		}

		return $items;
	}

	/**
	 * Set the value at the given offset.
	 *
	 * @param  string  $key
	 * @param  mixed  $value
	 * @return void
	 */
	public function offsetSet($key, $value)
	{
		$items =& $this->items;

		$parts = explode('.', $key);

		while (count($parts) > 1)
		{
			$part = array_shift($parts);

			if ( ! isset($items[$part]) || ! is_array($items[$part]))
			{
				$items[$part] = [];
			}

			$items =& $items[$part];
		}

		$items[array_shift($parts)] = $value;
	}

	/**
	 * Unset the value at the given offset.
	 *
	 * @param  string  $key
	 * @return void
	 */
	public function offsetUnset($key)
	{
		$items =& $this->items;

		$parts = explode('.', $key);

		while (count($parts) > 1)
		{
			$part = array_shift($parts);

			if (isset($items[$part]) && is_array($items[$part]))
			{
				$items =& $items[$part];
			}
		}

		unset($items[array_shift($parts)]);
	}

	/**
	 * Unset the value at the given offset.
	 *
	 * @param  string  $key
	 * @return void
	 */
	public function pull($key)
	{
		$this->offsetUnset($key);
	}

	/**
	 * Set the value at the given offset.
	 *
	 * @param  string  $key
	 * @param  mixed  $value
	 * @return void
	 */
	public function put($key, $value)
	{
		$this->offsetSet($key, $value);
	}

	/**
	 * Sort the collection using the given Closure.
	 *
	 * @param  \Closure|string  $callback
	 * @param  int  $options
	 * @param  bool  $descending
	 * @return $this
	 */
	public function sortBy($callback, $options = SORT_REGULAR, $descending = false)
	{
		$results = [];

		if (is_string($callback))
		{
			$callback = function($item) use ($callback)
			{
				if (is_null($callback)) return $item;

				foreach (explode('.', $callback) as $segment)
				{
					if (is_array($item))
					{
						if ( ! array_key_exists($segment, $item))
						{
							return null;
						}

						$item = $item[$segment];
					}
				}

				return $item;
			};
		}

		// First we will loop through the items and get the comparator from a callback
		// function which we were given. Then, we will sort the returned values and
		// and grab the corresponding values for the sorted keys from this array.
		foreach ($this->items as $key => $value)
		{
			$results[$key] = $callback($value);
		}

		$descending ? arsort($results, $options) : asort($results, $options);

		// Once we have sorted all of the keys in the array, we will loop through them
		// and grab the corresponding model so we can set the underlying items list
		// to the sorted version. Then we'll just return the collection instance.
		foreach (array_keys($results) as $key)
		{
			$results[$key] = $this->items[$key];
		}

		$this->items = $results;

		return $this;
	}

	/**
	 * Sort the collection in descending order using the given Closure.
	 *
	 * @param  \Closure|string  $callback
	 * @param  int  $options
	 * @return $this
	 */
	public function sortByDesc($callback, $options = SORT_REGULAR)
	{
		return $this->sortBy($callback, $options, true);
	}

	/**
	 * Returns the collection of items as a plain array.
	 *
	 * @return array
	 */
	public function toArray()
	{
		return array_map(function($value)
		{
			return $value;
		}, $this->items);
	}

	/**
	 * Handle dynamic calls to the collection to get and set attributes.
	 *
	 * @param  string  $method
	 * @param  array  $parameters
	 * @return $this
	 */
	public function __call($method, $parameters)
	{
		if (count($parameters) === 0)
		{
			return $this->get($method);
		}

		$this->attributes[$method] = $parameters[0];

		return $this;
	}

	/**
	 * Dynamically retrieve the value of an attribute.
	 *
	 * @param  string  $key
	 * @return mixed
	 */
	public function __get($key)
	{
		$value = $this->get($key);

		if (method_exists($this, $method = "{$key}Attribute"))
		{
			return $this->{$method}($value);
		}

		return $value;
	}

	/**
	 * Dynamically set the value of an attribute.
	 *
	 * @param  string  $key
	 * @param  mixed  $value
	 * @return void
	 */
	public function __set($key, $value)
	{
		$this->attributes[$key] = $value;
	}

	/**
	 * Dynamically check if an attribute is set.
	 *
	 * @param  string  $key
	 * @return void
	 */
	public function __isset($key)
	{
		return isset($this->attributes[$key]);
	}

	/**
	 * Dynamically unset an attribute.
	 *
	 * @param  string  $key
	 * @return void
	 */
	public function __unset($key)
	{
		unset($this->attributes[$key]);
	}

}
