<?php

namespace App\Notifications;

use App\Contact;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class VerifyEmail extends Notification
{
    use Queueable;

    public $contact;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Contact $contact)
    {
        $this->contact = $contact;

    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
//    public function toMail($notifiable)
//    {
//        //dd($this->contact);
//        return (new MailMessage)
//            ->subject('Confirm Your Email Address')
//            ->line('Please verify your email to continue.')
//            ->action('Verify email', url('/verify/'.$this->contact->verification_key))
//            ->line('Thank you for using our application!');
//
//    }
    public function toMail($notifiable)
    {
        $url = url('/verify/'.$this->contact->verification_key);
        $name = $this->contact->first_name;
        return (new MailMessage)
            ->subject('Confirm Your Email Address')
            ->markdown('mail.contacts.verify_email', ['url' => $url, 'name'=>$name]);
    }
    /**
     * Get the array representation of the notification.
     *
     * @param  mixed $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
