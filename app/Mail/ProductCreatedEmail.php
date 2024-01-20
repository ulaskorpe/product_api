<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ProductCreatedEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $user_name;
    public $product_name;
    public function __construct($user_name,$product_name)
    {
        $this->user_name = $user_name;
        $this->product_name = $product_name;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Product Created Email',
        );
    }

    public function build()
    {
        return $this->subject('Product Created')
                    ->view('emails.product_created')
                    ->with(['user_name'=>$this->user_name,'product_name'=>$this->product_name]);
    }

    /**
     * Get the message content definition.
     */
    // public function content(): Content
    // {
    //     return new Content(
    //         view: 'view.name',
    //     );
    // }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
