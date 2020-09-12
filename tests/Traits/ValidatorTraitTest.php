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
 * @version    5.0.0
 * @author     Cartalyst LLC
 * @license    BSD License (3-clause)
 * @copyright  (c) 2011-2020, Cartalyst LLC
 * @link       https://cartalyst.com
 */

namespace Cartalyst\Support\Tests\Traits;

use Mockery as m;
use PHPUnit\Framework\TestCase;
use Cartalyst\Support\Traits\ValidatorTrait;

class ValidatorTraitTest extends TestCase
{
    /**
     * {@inheritdoc}
     */
    protected function tearDown(): void
    {
        m::close();
    }

    /** @test */
    public function it_can_set_and_retrieve_the_validator_instance()
    {
        $validator = new ValidatorTraitStub();

        $mailer = m::mock('Cartalyst\Support\Validator');

        $validator->setValidator($mailer);

        $this->assertSame($validator->getValidator(), $mailer);
    }
}

class ValidatorTraitStub
{
    use ValidatorTrait;
}
