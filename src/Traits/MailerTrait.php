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
 * @version    5.1.2
 * @author     Cartalyst LLC
 * @license    BSD License (3-clause)
 * @copyright  (c) 2011-2021, Cartalyst LLC
 * @link       https://cartalyst.com
 */

namespace Cartalyst\Support\Traits;

use Cartalyst\Support\Mailer;

trait MailerTrait
{
    /**
     * The Mailer instance.
     *
     * @var \Cartalyst\Support\Mailer
     */
    protected $mailer;

    /**
     * Returns the Mailer instance.
     *
     * @return \Cartalyst\Support\Mailer
     */
    public function getMailer()
    {
        return $this->mailer;
    }

    /**
     * Sets the Mailer instance.
     *
     * @param \Cartalyst\Support\Mailer $mailer
     *
     * @return $this
     */
    public function setMailer(Mailer $mailer)
    {
        $this->mailer = $mailer;

        return $this;
    }
}
