<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Attachment;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Contracts\Queue\ShouldQueue;

class Orders extends Mailable
{
    use Queueable, SerializesModels;


    public $data;
    /**
     * Create a new message instance.
     *
     * @return void
     */

   


    public function __construct($request)
    {
        $this->data=$request;
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
            subject: $this->data->subject,
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
        view: 'mails.ordersdata',with:['name'=>$this->data->name,'body'=>$this->data->body,],
    );
}
    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        foreach($this->data->myfiles as $file){
        $Attachment[]=Attachment::fromPath($file->path())
        ->as($file->getClientOriginalName())
        ->withMime($file->getClientMimeType());
        }
        
        return $Attachment;
    }
}

           
// return [
//     Attachment::fromPath($this->data->myfiles->path())
//     ->as($this->data->myfiles->getClientOriginalName())
//     ->withMime($this->data->myfiles->getClientMimeType()),
// ];