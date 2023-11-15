<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class Orders extends Mailable
{
    use Queueable, SerializesModels;
    public $mymessage;
    public $name;

    
    /**
     * Create a new message instance.
     *
     * @return void
     */

    public function __construct($name,$mymessage)
    {
        $this->name=$name;
        $this->mymessage=$mymessage;
    }



    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            
            from: new Address('osamajanab9999@gmail.com','osamajanab'),
            subject: 'Orders Confirmed',
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
            view: 'mails.orders',
            with:[
'name'=>$this->name,
'mymessage'=>$this->mymessage,
            ],
        );
    }


    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [];
    }
}
