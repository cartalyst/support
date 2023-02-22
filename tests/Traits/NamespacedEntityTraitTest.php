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

use Cartalyst\Support\Contracts\NamespacedEntityInterface;
use PHPUnit\Framework\TestCase;
use Cartalyst\Support\Traits\NamespacedEntityTrait;

class NamespacedEntityTraitTest extends TestCase
{
    /** @test */
    public function it_can_get_and_set_the_entity_namespace()
    {
        $entity = new NamespacedEntityTraitStub();

        $this->assertSame('Cartalyst\Support\Tests\Traits\NamespacedEntityTraitStub', $entity->getEntityNamespace());

        $entity->setEntityNamespace('Foo\Bar');

        $this->assertSame('Foo\Bar', $entity->getEntityNamespace());
    }
}

class NamespacedEntityTraitStub implements NamespacedEntityInterface
{
    use NamespacedEntityTrait;

    protected static $entityNamespace;
}
