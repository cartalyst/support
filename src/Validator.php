<?php

/*
 * Part of the Support package.
 *
 * NOTICE OF LICENSE
 *
 * Licensed under the 3-clause BSD License.
 *
 * This source file is subject to the 3-clause BSD License that is
 * bundled with this package in the LICENSE file.
 *
 * @package    Support
 * @version    6.0.1
 * @author     Cartalyst LLC
 * @license    BSD License (3-clause)
 * @copyright  (c) 2011-2022, Cartalyst LLC
 * @link       https://cartalyst.com
 */

namespace Cartalyst\Support;

use Illuminate\Support\Arr;
use Illuminate\Validation\Factory;
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
     * The registered bindings.
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
     * The validation messages.
     *
     * @var array
     */
    protected $messages = [];

    /**
     * The validation customAttributes.
     *
     * @var array
     */
    protected $customAttributes = [];

    /**
     * Flag that indicates if we should bypass the validation.
     *
     * @var bool
     */
    protected $bypass = false;

    /**
     * Constructor.
     *
     * @param \Illuminate\Validation\Factory $factory
     *
     * @return void
     */
    public function __construct(Factory $factory)
    {
        $this->factory = $factory;
    }

    /**
     * {@inheritdoc}
     */
    public function getRules(): array
    {
        return $this->rules;
    }

    /**
     * {@inheritdoc}
     */
    public function setRules(array $rules): ValidatorInterface
    {
        $this->rules = $rules;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getMessages(): array
    {
        return $this->messages;
    }

    /**
     * {@inheritdoc}
     */
    public function setMessages(array $messages): ValidatorInterface
    {
        $this->messages = $messages;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getCustomAttributes(): array
    {
        return $this->customAttributes;
    }

    /**
     * {@inheritdoc}
     */
    public function setCustomAttributes(array $customAttributes): ValidatorInterface
    {
        $this->customAttributes = $customAttributes;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getBindings(): array
    {
        return $this->bindings;
    }

    /**
     * {@inheritdoc}
     */
    public function on(string $scenario, array $arguments = [])
    {
        return $this->onScenario($scenario, $arguments);
    }

    /**
     * {@inheritdoc}
     */
    public function onScenario(string $scenario, array $arguments = []): ValidatorInterface
    {
        $method = 'on'.ucfirst($scenario);

        $this->scenario = [
            'on'        => method_exists($this, $method) ? $method : null,
            'arguments' => $arguments,
        ];

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function bind(array $bindings)
    {
        return $this->registerBindings($bindings);
    }

    /**
     * {@inheritdoc}
     */
    public function registerBindings(array $bindings): ValidatorInterface
    {
        $this->bindings = array_merge($this->bindings, $bindings);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function validate(array $data)
    {
        return $this->executeValidation($data);
    }

    /**
     * {@inheritdoc}
     */
    public function bypass(bool $status = true): ValidatorInterface
    {
        $this->bypass = (bool) $status;

        return $this;
    }

    /**
     * Executes the data validation against the service rules.
     *
     * @param array $data
     *
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function executeValidation(array $data)
    {
        if ($method = Arr::get($this->scenario, 'on')) {
            call_user_func_array([$this, $method], $this->scenario['arguments']);
        }

        $rules = $this->getBoundRules();

        $messages = $this->getMessages();

        $customAttributes = $this->getCustomAttributes();

        $validator = $this->factory->make($data, $rules, $messages, $customAttributes);

        return $validator->errors();
    }

    /**
     * Returns the rules already binded.
     *
     * @return array
     */
    protected function getBoundRules(): array
    {
        if ($this->bypass === true) {
            return [];
        }

        $rules = $this->getRules();

        foreach ($rules as $key => $value) {
            if ($binding = Arr::get($this->bindings, $key)) {
                $rules[$key] = str_replace('{'.$key.'}', $binding, $value);
            }
        }

        return $rules;
    }
}
