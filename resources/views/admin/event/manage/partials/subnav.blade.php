<div class="sub-nav">
    <div class="container-lg px-0">
        <ul class="nav">
            <li class="nav-item">
                <a class="nav-link {{$active == "dashboard"? "active":""}}" href="{{url('/admin/event/'.$event->id."/dashboard")}}">Dashboard</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{$active == "tickets"? "active":""}}" href="{{url('/admin/event/'.$event->id."/tickets")}}">Tickets</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{$active == "orders"? "active":""}}" href="{{url('/admin/event/'.$event->id."/orders")}}">Orders</a>
            </li>
           
            {{-- 
            <li class="nav-item">
                <a class="nav-link {{$active == "customize"? "active":""}}" href="{{url('/admin/event/'.$event->id."/customize")}}">Customize</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{$active == "check-in"? "active":""}}" href="{{url('/admin/event/'.$event->id."/check-in")}}">Check-In</a>
            </li> --}}
        </ul>
    </div>
</div>