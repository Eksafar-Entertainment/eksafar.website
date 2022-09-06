<?php

namespace App\Mails;

use Illuminate\Mail\Mailable;

class TicketMail extends Mailable
{
    public $order;

    public function __construct($order)
    {
        $this->order = $order;
    }
    public function build()
    {
        return $this
            ->subject('Thank you for subscribing to our newsletter')
            ->markdown('emails.ticket');
    }
}
