<?php namespace Cartalyst\Support\Traits;
/**
 * Part of the Support package.
 *
 * NOTICE OF LICENSE
 *
 * Licensed under the Cartalyst PSL License.
 *
 * This source file is subject to the Cartalyst PSL License that is
 * bundled with this package in the license.txt file.
 *
 * @package    Support
 * @version    1.0.0
 * @author     Cartalyst LLC
 * @license    Cartalyst PSL
 * @copyright  (c) 2011-2014, Cartalyst LLC
 * @link       http://cartalyst.com
 */

use Cartalyst\Support\Mailer;

trait MailerTrait {

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
	 * @param  \Cartalyst\Support\Mailer  $mailer
	 * @return $this
	 */
	public function setMailer(Mailer $mailer)
	{
		$this->mailer = $mailer;

		return $this;
	}

}
