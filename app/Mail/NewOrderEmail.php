<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Contracts\Queue\ShouldQueue;

class NewOrderEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $order;
    public $attachmentPath;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($order, $attachmentPath)
    {
        $this->order = $order;
        $this->attachmentPath = $attachmentPath;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'New Order Email',
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        return new Content(
            markdown: 'emails.new_order_email',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
{
    return [

        Attachment::fromPath($this->attachmentPath)
                    ->as('attachment.pdf')
                    ->withMime('application/pdf'),
        // [
        //     'path' => $this->attachmentPath,

        //     'name' => 'attachment.pdf',
        // ],
    ];
}
}
