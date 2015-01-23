<?php

/**
 * Part of the Support package.
 *
 * NOTICE OF LICENSE
 *
 * Licensed under the Cartalyst PSL License.
 *
 * This source file is subject to the Cartalyst PSL License that is
 * bundled with this package in the LICENSE file.
 *
 * @package    Support
 * @version    1.1.0
 * @author     Cartalyst LLC
 * @license    Cartalyst PSL
 * @copyright  (c) 2011-2015, Cartalyst LLC
 * @link       http://cartalyst.com
 */

namespace Cartalyst\Support;

use Illuminate\Validation\Factory;
use Cartalyst\Support\Traits\ValidatorTrait;
use Cartalyst\Support\Contracts\ValidatorInterface;

abstract class Validator implements ValidatorInterface
{
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
     * The validation rules.
     *
     * @var array
     */
    protected $rules = [];

    /**
     * Flag that indicates if we should bypass the validation.
     *
     * @var bool
     */
    protected $bypass = false;

    /**
     * Constructor.
     *
     * @param  \Illuminate\Validation\Factory  $factory
     */
    public function __construct(Factory $factory)
    {
        $this->factory = $factory;
    }

    /**
     * {@inheritDoc}
     */
    public function getRules()
    {
        return $this->rules;
    }

    /**
     * {@inheritDoc}
     */
    public function setRules(array $rules)
    {
        $this->rules = $rules;

        return $this;
    }

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
     * {@inheritDoc}
     */
    public function bind(array $bindings)
    {
        return $this->registerBindings($bindings);
    }

    /**
     * {@inheritDoc}
     */
    public function registerBindings(array $bindings)
    {
        $this->bindings = array_merge($this->bindings, $bindings);

        return $this;
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
    public function bypass($status = true)
    {
        $this->bypass = (bool) $status;

        return $this;
    }

    /**
     * Executes the data validation against the service rules.
     *
     * @param  array  $data
     * @return \Illuminate\Validation\Validator
     */
    protected function executeValidation(array $data)
    {
        if ($method = array_get($this->scenario, 'on')) {
            call_user_func_array([$this, $method], $this->scenario['arguments']);
        }

        $rules = $this->getBoundRules();

        $validator = $this->factory->make($data, $rules);

        return $validator->errors();
    }

    /**
     * Returns the rules already binded.
     *
     * @return array
     */
    protected function getBoundRules()
    {
        if ($this->bypass === true) {
            return [];
        }

        $rules = $this->getRules();

        foreach ($rules as $key => $value) {
            if ($binding = array_get($this->bindings, $key)) {
                $rules[$key] = str_replace('{'.$key.'}', $binding, $value);
            }
        }

        return $rules;
    }
}
