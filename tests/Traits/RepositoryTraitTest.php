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
 * @version    7.0.0
 * @author     Cartalyst LLC
 * @license    BSD License (3-clause)
 * @copyright  (c) 2011-2023, Cartalyst LLC
 * @link       https://cartalyst.com
 */

namespace Cartalyst\Support\Tests\Traits;

use PHPUnit\Framework\TestCase;
use Cartalyst\Support\Traits\RepositoryTrait;

class RepositoryTraitTest extends TestCase
{
    /** @test */
    public function it_can_set_and_retrieve_the_model()
    {
        $repository = new RepositoryTraitStub();

        $repository->setModel('FooModelStub');

        $this->assertSame('FooModelStub', $repository->getModel());
    }

    /** @test */
    public function it_can_create_a_model()
    {
        $repository = new RepositoryTraitStub();

        $repository->setModel('StdClass');

        $this->assertInstanceOf('StdClass', $repository->createModel());
    }

    /** @test */
    public function it_can_call_dynamic_methods()
    {
        $repository = new RepositoryTraitStub();

        $repository->setModel('Cartalyst\Support\Tests\Traits\FooModelStub');

        $this->assertSame('Cartalyst\Support\Tests\Traits\FooModelStub', $repository->getModel());

        $this->assertSame('bar', $repository->foo());
    }
}

class RepositoryTraitStub
{
    use RepositoryTrait;

    public $model;
}

class FooModelStub
{
    public function foo()
    {
        return 'bar';
    }
}
