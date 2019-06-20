<?php

namespace App\Mail;

use App\Outbox;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendNewsletter extends Mailable
{
    use Queueable, SerializesModels;

    public $item;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Outbox $item)
    {
        $this->item = $item;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('admin.email.newsletter')
//            ->cc('benmartin@globalcitymedia.com')
            ->subject($this->item->subject);
    }
}
