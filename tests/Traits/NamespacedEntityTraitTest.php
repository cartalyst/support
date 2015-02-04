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

namespace Cartalyst\Support\Tests\Traits;

use PHPUnit_Framework_TestCase;
use Cartalyst\Support\Traits\NamespacedEntityTrait;

class NamespacedEntityTraitTest extends PHPUnit_Framework_TestCase
{
    /** @test **/
    public function it_can_get_and_set_the_entity_namespace()
    {
        $entity = new NamespacedEntityTraitStub;

        $this->assertSame('Cartalyst\Support\Tests\Traits\NamespacedEntityTraitStub', $entity->getEntityNamespace());

        $entity->setEntityNamespace('Foo\Bar');

        $this->assertSame('Foo\Bar', $entity->getEntityNamespace());
    }
}

class NamespacedEntityTraitStub
{
    use NamespacedEntityTrait;

    protected static $entityNamespace;
}
