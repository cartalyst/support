<?php

/**
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
 * @version    2.0.3
 * @author     Cartalyst LLC
 * @license    BSD License (3-clause)
 * @copyright  (c) 2011-2019, Cartalyst LLC
 * @link       https://cartalyst.com
 */

namespace Cartalyst\Support\Traits;

use Illuminate\Support\Str;

trait ModelTrait
{

    /**
     * Dynamically pass missing methods to the model.
     *
     * @param  string $method
     * @param  array $parameters
     * @return mixed
     */
    public function __call($method, $parameters)
    {
        if (Str::startsWith($method, "get")) {
            $attribute = substr($method, 3);
            return $this->{Str::snake($attribute)};
        }

        if (Str::startsWith($method, "set")) {
            $attribute = substr($method, 3);
            $this->{Str::snake($attribute)} = $parameters[0];
            return $this;
        }
        return parent::__call($method, $parameters);
    }
}
