@php
$active = Route::currentRouteName();
@endphp
<div class="sub-nav">
    <div class="container-lg px-0">
        <ul class="nav">
            @if(Auth::user()->can('event:dashboard'))
            <li class="nav-item">
                <a class="nav-link {{$active == "admin:event:dashboard"? "active":""}}" href="{{url('/admin/event/'.$event->id."/dashboard")}}">Dashboard</a>
            </li>
            @endif
            @if(Auth::user()->can('event:tickets'))
            <li class="nav-item">
                <a class="nav-link {{$active == "admin:event:tickets"? "active":""}}" href="{{url('/admin/event/'.$event->id."/tickets")}}">Tickets</a>
            </li>
            @endif
            @if(Auth::user()->can('event:orders'))
            <li class="nav-item">
                <a class="nav-link {{$active == "admin:event:orders"? "active":""}}" href="{{url('/admin/event/'.$event->id."/orders")}}">Orders</a>
            </li>
            @endif
            @if(Auth::user()->can('event:customize'))
            <li class="nav-item">
                <a class="nav-link {{$active == "admin:event:customize"? "active":""}}" href="{{url('/admin/event/'.$event->id."/customize")}}">Customize</a>
            </li>
            @endif
            @if(Auth::user()->can('event:check-in'))
            <li class="nav-item">
                <a class="nav-link {{$active == "admin:event:check-in"? "active":""}}" href="{{url('/admin/event/'.$event->id."/check-in")}}">Check-In</a>
            </li>
            @endif
        </ul>
    </div>
</div>