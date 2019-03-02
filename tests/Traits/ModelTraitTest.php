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

namespace Cartalyst\Support\Tests\Traits;

use Cartalyst\Support\Traits\ModelTrait;
use PHPUnit_Framework_TestCase;
use Cartalyst\Support\Traits\RepositoryTrait;

class ModelTraitTest extends PHPUnit_Framework_TestCase
{
    /** @test * */
    public function it_can_set_value_normally()
    {
        $repository = new MyModel();
        $repository->a = 2;
        $this->assertEquals(2, $repository->a);
    }

    /** @test * */
    public function it_can_set_value_with_setter()
    {
        $repository = new MyModel();
        $repository->setA(2);
        $this->assertEquals(2, $repository->a);
    }

    /** @test * */
    public function it_can_get_value_with_getter()
    {
        $repository = new MyModel();
        $repository->setA(2);
        $this->assertEquals(2, $repository->getA());
    }

    /** @test * */
    public function it_can_override_setter()
    {
        $repository = new MyModelOverrideSetter();
        $firstVal = $repository->a;
        $repository->setA(2);
        $this->assertEquals($firstVal, $repository->getA());
    }

    /** @test * */
    public function it_can_override_getter()
    {
        $repository = new MyModelOverrideGetter();
        $firstVal = $repository->getA();
        $repository->setA(2);
        $this->assertEquals($firstVal, $repository->getA());
    }

}

class MyModel
{
    public $a;
    use ModelTrait;
}

class MyModelOverrideSetter extends MyModel
{
    use ModelTrait;

    /**
     * MyModelOverrideSetter constructor.
     */
    public function __construct()
    {
        $this->a = 1;
    }

    public function setA($val)
    {
    }
}


class MyModelOverrideGetter extends MyModel
{
    use ModelTrait;

    public function getA()
    {
        return 10;
    }
}

