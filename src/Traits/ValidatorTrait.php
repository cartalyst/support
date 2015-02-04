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
 * @version    1.1.1
 * @author     Cartalyst LLC
 * @license    Cartalyst PSL
 * @copyright  (c) 2011-2015, Cartalyst LLC
 * @link       http://cartalyst.com
 */

namespace Cartalyst\Support\Traits;

use Cartalyst\Support\Validator;

trait ValidatorTrait
{
    /**
     * The Validator instance.
     *
     * @var \Cartalyst\Support\Validator
     */
    protected $validator;

    /**
     * Returns the Validator instance.
     *
     * @return \Cartalyst\Support\Validator
     */
    public function getValidator()
    {
        return $this->validator;
    }

    /**
     * Sets the Validator instance.
     *
     * @param  \Cartalyst\Support\Validator  $validator
     * @return $this
     */
    public function setValidator(Validator $validator)
    {
        $this->validator = $validator;

        return $this;
    }
}
