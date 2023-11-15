<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class WelcomeNoti extends Notification implements ShouldQueue
{
    use Queueable;
public $data;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($notiData)
    {
        $this->data=$notiData;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    
    public function toMail($notifiable)
    {      
       
        $mailMessage = new MailMessage;

        foreach ($this->data['myfiles'] as $file) {
            $attachmentPath = storage_path('app/public/' . $file);
            $mailMessage->attach($attachmentPath);
        }
        
        return $mailMessage
        ->greeting($this->data['name'])
        ->line($this->data['url'])
        ->action('Click here', url('/'))
        ->line($this->data['body']);


        // $attachmentPath = public_path('images/' . $this->data['myfiles']);

        //              return (new MailMessage)
        //             ->greeting($this->data['name'])
        //             ->line($this->data['url'])
                  
        //             ->action('click here',url('/'),$this->data['url'])
        //             ->line($this->data['body'])
        //             ->line($this->data['regards'])
        //             ->attach(public_path('osama.jpeg'), [
        //                 'as' => 'osama.jpeg', // Specify the file name seen by the user
        //             ]);

    }


    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
