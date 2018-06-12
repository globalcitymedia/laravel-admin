<?php

namespace App\Notifications;

use App\Contact;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class ManagePreference extends Notification
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
        $url = url('/manage-preference/'.encrypt($this->contact->verification_key));
        $unsubscribe_url = url('/unsubscribe/'.encrypt($this->contact->verification_key));
        $name = $this->contact->first_name;
        return (new MailMessage)
            ->subject('We would like to stay in touch')
            ->markdown('mail.contacts.manage_preference', ['url' => $url,'unsubscribe_url'=>$unsubscribe_url, 'name'=>$name]);
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
