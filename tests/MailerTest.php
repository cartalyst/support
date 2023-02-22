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

namespace Cartalyst\Support\Tests;

use Mockery as m;
use Cartalyst\Support\Mailer;
use PHPUnit\Framework\TestCase;

class MailerTest extends TestCase
{
    /**
     * The Mailer instance.
     *
     * @var \Cartalyst\Support\Mailer
     */
    protected $mailer;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        $this->mailer = new Mailer(
            m::mock(\Illuminate\Contracts\Mail\Mailer::class),
            m::mock(\Illuminate\Config\Repository::class)
        );
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown(): void
    {
        m::close();
    }

    /** @test */
    public function it_can_be_instantiated()
    {
        $mailer = new Mailer(
            m::mock(\Illuminate\Contracts\Mail\Mailer::class),
            m::mock(\Illuminate\Config\Repository::class)
        );

        $this->assertInstanceOf(Mailer::class, $mailer);
    }

    /** @test */
    public function it_can_get_the_illuminate_mailer_instance()
    {
        $this->assertInstanceOf(\Illuminate\Contracts\Mail\Mailer::class, $this->mailer->getMailer());
    }

    /** @test */
    public function it_can_set_the_illuminate_mailer_instance()
    {
        $this->mailer->setMailer(m::mock(\Illuminate\Contracts\Mail\Mailer::class));

        $this->assertInstanceOf(\Illuminate\Contracts\Mail\Mailer::class, $this->mailer->getMailer());
    }

    /** @test */
    public function it_can_get_the_illuminate_config_repository_instance()
    {
        $this->assertInstanceOf(\Illuminate\Config\Repository::class, $this->mailer->getConfig());
    }

    /** @test */
    public function it_can_set_the_illuminate_config_repository_instance()
    {
        $this->mailer->setConfig(m::mock(\Illuminate\Config\Repository::class));

        $this->assertInstanceOf(\Illuminate\Config\Repository::class, $this->mailer->getConfig());
    }

    /** @test */
    public function it_can_get_the_from_name()
    {
        $this->assertNull($this->mailer->getFromName());
    }

    /** @test */
    public function it_can_set_the_from_name()
    {
        $this->mailer->setFromName('John Doe');

        $this->assertSame('John Doe', $this->mailer->getFromName());
    }

    /** @test */
    public function it_can_get_the_from_address()
    {
        $this->assertNull($this->mailer->getFromAddress());
    }

    /** @test */
    public function it_can_set_the_from_address()
    {
        $this->mailer->setFromAddress('foo@bar.baz');

        $this->assertSame('foo@bar.baz', $this->mailer->getFromAddress());
    }

    /** @test */
    public function it_can_get_the_subject()
    {
        $this->assertNull($this->mailer->getSubject());
    }

    /** @test */
    public function it_can_set_the_subject()
    {
        $this->mailer->setSubject('Example Subject');

        $this->assertSame('Example Subject', $this->mailer->getSubject());
    }

    /** @test */
    public function it_can_get_all_the_recipients()
    {
        $this->assertEmpty($this->mailer->getRecipients());
    }

    /** @test */
    public function it_can_set_multiple_recipients_at_once()
    {
        $this->mailer->setRecipients('to', [
            [
                'email' => 'foo@bar.baz',
                'name'  => 'Foo Bar',
            ],
            [
                'email' => 'foo@bar.baz',
                'name'  => 'Foo Bar',
            ],
        ]);

        $recipients = $this->mailer->getRecipients('to');

        $this->assertCount(1, $recipients);
        $this->assertSame([
            'foo@bar.baz' => [
                'email' => 'foo@bar.baz',
                'name'  => 'Foo Bar',
            ],
        ], $recipients);

        $this->mailer->setRecipients('to', [
            [
                'email' => 'foo@bar.baz',
                'name'  => 'Foo Bar',
            ],
            [
                'email' => 'john@doe.com',
                'name'  => 'John Doe',
            ],
        ]);

        $recipients = $this->mailer->getRecipients('to');

        $this->assertCount(2, $recipients);
        $this->assertSame([
            'foo@bar.baz' => [
                'email' => 'foo@bar.baz',
                'name'  => 'Foo Bar',
            ],
            'john@doe.com' => [
                'email' => 'john@doe.com',
                'name'  => 'John Doe',
            ],
        ], $recipients);

        $recipients = $this->mailer->getRecipients();

        $this->assertCount(2, $recipients['to']);
        $this->assertSame([
            'to' => [
                'foo@bar.baz' => [
                    'email' => 'foo@bar.baz',
                    'name'  => 'Foo Bar',
                ],
                'john@doe.com' => [
                    'email' => 'john@doe.com',
                    'name'  => 'John Doe',
                ],
            ],
        ], $recipients);
    }

    /** @test */
    public function it_can_set_a_single_to_recipient()
    {
        $this->mailer->addTo('foo@bar.baz', 'Foo Bar');

        $this->assertCount(1, $this->mailer->getRecipients('to'));
        $this->assertNull($this->mailer->getRecipients('from'));
    }

    /** @test */
    public function it_can_set_multiple_to_recipients()
    {
        $this->mailer->setTo([
            'foo@bar.baz' => [
                'email' => 'foo@bar.baz',
                'name'  => 'Foo Bar',
            ],
            'john@doe.com' => [
                'email' => 'john@doe.com',
                'name'  => 'John Doe',
            ],
        ]);

        $this->assertCount(2, $this->mailer->getRecipients('to'));
        $this->assertNull($this->mailer->getRecipients('from'));
    }

    /** @test */
    public function it_can_set_a_single_cc_recipient()
    {
        $this->mailer->addCc('foo@bar.baz', 'Foo Bar');

        $this->assertCount(1, $this->mailer->getRecipients('cc'));
        $this->assertNull($this->mailer->getRecipients('from'));
    }

    /** @test */
    public function it_can_set_multiple_cc_recipients()
    {
        $this->mailer->setCc([
            'foo@bar.baz' => [
                'email' => 'foo@bar.baz',
                'name'  => 'Foo Bar',
            ],
            'john@doe.com' => [
                'email' => 'john@doe.com',
                'name'  => 'John Doe',
            ],
        ]);

        $this->assertCount(2, $this->mailer->getRecipients('cc'));
        $this->assertNull($this->mailer->getRecipients('from'));
    }

    /** @test */
    public function it_can_set_a_single_bcc_recipient()
    {
        $this->mailer->addBcc('foo@bar.baz', 'Foo Bar');

        $this->assertCount(1, $this->mailer->getRecipients('bcc'));
        $this->assertNull($this->mailer->getRecipients('from'));
    }

    /** @test */
    public function it_can_set_multiple_bcc_recipients()
    {
        $this->mailer->setBcc([
            'foo@bar.baz' => [
                'email' => 'foo@bar.baz',
                'name'  => 'Foo Bar',
            ],
            'john@doe.com' => [
                'email' => 'john@doe.com',
                'name'  => 'John Doe',
            ],
        ]);

        $this->assertCount(2, $this->mailer->getRecipients('bcc'));
        $this->assertNull($this->mailer->getRecipients('from'));
    }

    /** @test */
    public function it_can_set_a_single_reply_to_recipient()
    {
        $this->mailer->addReplyTo('foo@bar.baz', 'Foo Bar');

        $this->assertCount(1, $this->mailer->getRecipients('replyTo'));
        $this->assertNull($this->mailer->getRecipients('from'));
    }

    /** @test */
    public function it_can_set_multiple_reply_to_recipients()
    {
        $this->mailer->setReplyTo([
            'foo@bar.baz' => [
                'email' => 'foo@bar.baz',
                'name'  => 'Foo Bar',
            ],
            'john@doe.com' => [
                'email' => 'john@doe.com',
                'name'  => 'John Doe',
            ],
        ]);

        $this->assertCount(2, $this->mailer->getRecipients('replyTo'));
        $this->assertNull($this->mailer->getRecipients('from'));
    }

    /** @test */
    public function it_can_set_the_email_view_and_data()
    {
        $this->mailer->setView('foo.bar', ['foo' => 'bar']);

        $this->assertSame('foo.bar', $this->mailer->getView());
    }

    /** @test */
    public function it_can_set_a_single_attachment()
    {
        $this->mailer->addAttachment('/foo/bar.baz');

        $this->assertCount(1, $this->mailer->getAttachments());
    }

    /** @test */
    public function it_can_set_multiple_attachments()
    {
        $this->mailer->setAttachments([
            '/foo/bar.baz',
            '/foo.bar',
        ]);

        $this->assertCount(2, $this->mailer->getAttachments());
    }

    /** @test */
    public function it_can_set_a_single_data_attachment()
    {
        $this->mailer->addDataAttachment('/foo/bar.baz');

        $this->assertCount(1, $this->mailer->getDataAttachments());
    }

    /** @test */
    public function it_can_set_multiple_data_attachments()
    {
        $this->mailer->setDataAttachments([
            '/foo/bar.baz',
            '/foo.bar',
        ]);

        $this->assertCount(2, $this->mailer->getDataAttachments());
    }

    /** @test */
    public function it_can_send_emails()
    {
        $baseMailer = m::mock(\Illuminate\Contracts\Mail\Mailer::class);
        $baseMailer->shouldReceive('send')->once()->andReturn(1);

        $this->mailer->setMailer($baseMailer);

        $status = $this->mailer->send();

        $this->assertSame(1, $status);
    }

    /** @test */
    public function it_can_queue_emails()
    {
        $baseMailer = m::mock(\Illuminate\Contracts\Mail\Mailer::class);
        $baseMailer->shouldReceive('queue')->once()->andReturn(1);

        $this->mailer->setMailer($baseMailer);

        $status = $this->mailer->queue();

        $this->assertSame(1, $status);
    }

    /** @test */
    public function it_can_queue_emails_on_a_specific_queue()
    {
        $baseMailer = m::mock(\Illuminate\Contracts\Mail\Mailer::class);
        $baseMailer->shouldReceive('queueOn')->once()->with('foo', null, [], m::any())->andReturn(1);

        $this->mailer->setMailer($baseMailer);

        $status = $this->mailer->queueOn('foo');

        $this->assertSame(1, $status);
    }

    /** @test */
    public function it_can_queue_a_delayed_email()
    {
        $baseMailer = m::mock(\Illuminate\Contracts\Mail\Mailer::class);
        $baseMailer->shouldReceive('later')->once()->with(20, null, [], m::any())->andReturn(1);

        $this->mailer->setMailer($baseMailer);

        $status = $this->mailer->later(20);

        $this->assertSame(1, $status);
    }

    /** @test */
    public function it_can_prepare_the_callback()
    {
        $baseMailer = m::mock(\Illuminate\Contracts\Mail\Mailer::class);
        $config     = m::mock(\Illuminate\Config\Repository::class);

        $mailerStub = new MailerStub($baseMailer, $config);

        $config->shouldReceive('get')->twice();

        $mailerStub->testCallback();

        $this->assertCount(1, $mailerStub->getRecipients());
    }
}

class MailerStub extends Mailer
{
    public function testCallback()
    {
        $this->recipients = [
            'to' => [
                'foo@bar.baz' => [
                    'email' => 'foo@bar.baz',
                    'name'  => 'foo bar',
                ],
            ],
        ];

        $this->attachments = [
            'foo',
            'bar' => [
                'baz',
                [],
            ],
        ];

        $this->dataAttachments = [
            'data' => [
                'foobar',
                [],
            ],
        ];

        $message = m::mock('Illuminate\Mail\Message');
        $message->shouldReceive('subject')->once();
        $message->shouldReceive('from')->once();
        $message->shouldReceive('to')->once()->with('foo@bar.baz', 'foo bar');
        $message->shouldReceive('attach')->once()->with('foo', []);
        $message->shouldReceive('attach')->once()->with('baz', []);
        $message->shouldReceive('attachData')->once()->with('foobar', 'data', []);

        $callback = $this->prepareCallback();

        $callback($message);
    }
}
