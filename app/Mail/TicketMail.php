<?php

namespace App\Mail;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Event;
use App\Models\OrderDetail;
use App\Models\Venue;

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

    public function __construct($order_id)
    {
        $this->order = Order::where(["id" => $order_id])->first();
        $this->order_details = OrderDetail::where(["order_details.order_id" => $this->order->id])
            ->leftJoin("event_tickets", 'event_tickets.id', '=', 'order_details.event_ticket_id')
            //->groupBy("order_details.id")
            ->select(
                "order_details.*",
                "event_tickets.name as event_ticket_name",
                "event_tickets.persons as event_ticket_persons",
                "event_tickets.start_datetime as event_ticket_start_datetime",
                "event_tickets.end_datetime as event_ticket_end_datetime"
            )
            ->get();
        $this->event = Event::where(["id" => $this->order->id])->first();
        $this->venue = Venue::where(["id" => $this->event->venue])->first();
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.ticket')
            //->text('mail.ticket.plain')
            ->subject("Please collect your ticket.")
            ->with([
                "order" => $this->order,
                "event" => $this->event,
                "order_details" => $this->order_details,
                "venue" => $this->order_details,
            ]);
    }
}
