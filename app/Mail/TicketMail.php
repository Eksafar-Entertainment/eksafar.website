<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TicketMail extends Mailable
{
    use Queueable, SerializesModels;
    public $order;
    public $order_details;
    public $event;
    public $venue;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    public function __construct($event, $order, $order_details, $venue)
    {
        $this->order = $order;
        $this->event = $event;
        $this->order_details = $order_details;
        $this->venue = $venue;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // return $this
        //     ->subject('Please collect your ticket.')
        //     ->markdown('mail.ticket');
        return $this->view('mail.ticket')
            //->text('mail.ticket.plain')
            ->subject("Please collect your ticket.")
            ->with([
                "order"=>$this->order,
                "event"=>$this->event,
                "order_details"=> $this->order_details,
                "venue"=> $this->order_details,
            ]);
    }
}
