<?php

namespace App\View\Components\Front;

use App\Models\Event;
use App\Models\Venue;
use Carbon\Carbon;
use Illuminate\View\Component;

class BookingForm extends Component
{
    public $event, $venue, $event_tickets, $tickets, $dates;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(Event $event, Venue $venue, $tickets=[])
    {
        $this->event = $event;
        $this->venue = $venue;
        $this->event_tickets = $tickets;
        $dates = [];
        $ticketss = [];
        foreach($tickets as $ticket){
            $dates[] = Carbon::parse($ticket->start_datetime)->format("Y-m-d H:i").":00";
            $ticketss[Carbon::parse($ticket->start_datetime)->format("Y-m-d H:i").":00"][] = $ticket;
        }
        $this->dates = array_unique($dates);
        $this->tickets = $ticketss;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.front.booking-form');
    }
}
