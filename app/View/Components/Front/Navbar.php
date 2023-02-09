<?php

namespace App\View\Components\Front;

use App\Models\Event;
use App\Models\Venue;
use Illuminate\View\Component;

class Navbar extends Component
{
    public $type;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(String $type)
    {
        $this->type = $type;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.front.navbar');
    }
}
