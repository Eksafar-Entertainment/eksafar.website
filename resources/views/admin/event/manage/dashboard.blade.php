@extends('admin.layouts.admin')
@section('subnav')
@include('admin.event.partials.subnav')
@endsection
@section('content')
<div>
    <h4>Event Dashboard</h4>
    <div class="row mt-4">
        <div class="col-md-3 col-sm-6 col-6 mb-4">
            <div class="card card-body text-center">
                <h3 class="fw-light text-primary">
                    @money($revenue)
                </h3>
                <small>REVENUE</small>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 col-6 mb-4">
            <div class="card card-body text-center">
                <h3 class="fw-light text-primary">{{ $total_orders }}</h3>
                <small>ORDERS</small>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 col-6 mb-4">
            <div class="card card-body text-center">
                <h3 class="fw-light text-primary">{{ $total_ticket_sold }}</h3>
                <small>TICKETS SOLD</small>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 col-6 mb-4">
            <div class="card card-body text-center">
                <h3 class="fw-light text-primary">{{ $event_views_chart['total'] }}</h3>
                <small>EVENT VIEWS</small>
            </div>
        </div>

    </div>
    <div class="row">
        <div class="col-md-9">
            <div class="row">

                <div class="col-12 col-md-6 mb-4">
                    <div class="card card-body">
                        <div class="d-flex align-items-center mb-2">
                            <h6 class="flex-grow-1 fw-bold">Tickets Sold</h6>
                            <span class="text-success">{{ $tickets_sold_chart['total'] }} total</span>
                        </div>
                        <canvas id="ordersChart" style="width: 100%; height: 220px;"></canvas>
                    </div>
                </div>
                <div class="col-12 col-md-6 mb-4">
                    <div class="card card-body">
                        <div class="d-flex align-items-center mb-2">
                            <h6 class="flex-grow-1 fw-bold">Tickets Sales Volume</h6>
                            <span class="text-success">
                                @money($tickets_sales_volume_chart['total'])
                                total
                            </span>
                        </div>
                        <canvas id="amountChart" style="width: 100%; height: 220px;"></canvas>
                    </div>
                </div>

                <div class="col-12 col-md-6 mb-4">
                    <div class="card card-body">
                        <div class="d-flex align-items-center mb-2">
                            <h6 class="flex-grow-1 fw-bold">Event Views</h6>
                            <span class="text-success">{{$event_views_chart['total']}} total</span>
                        </div>
                        <canvas id="eventViewsChart" style="width: 100%; height: 220px;"></canvas>
                    </div>
                </div>

                <div class="col-12 col-md-6 mb-4">
                    <div class="card card-body">
                        <div class="d-flex align-items-center mb-2">
                            <h6 class="flex-grow-1 fw-bold">Tickets Sales Details</h6>
                            <span class="text-success">{{ $total_ticket_sold }} total</span>
                        </div>
                        <canvas id="ticketDetailsChart" style="width: 100%; height: 220px;"></canvas>
                    </div>
                </div>
            </div>

        </div>

        <div class="col-md-3">
            <div class="card mb-4">
                <div class="card-header bg-primary text-light"><i class="fa-solid fa-link"></i> Event Url</div>
                <div class="card-body">
                    <input class="form-control" type="text" readonly value="{{url('/event-'.$event->slug)}}" style="cursor:pointer" onclick="event.target.select();document.execCommand('copy')" />
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header bg-primary text-light"><i class="fa-solid fa-share-from-square"></i> Share Event</div>
                <div class="card-body">
                    <a class="btn btn-sm btn-primary" style="display: inline-block !important;" target="blank" href="https://www.facebook.com/sharer/sharer.php?u={{url('/event-'.$event->slug)}}?utm_source=fb">
                        <i class="fab fa-facebook"></i>
                    </a>

                    <a class="btn btn-sm btn-primary" style="display: inline-block !important;" target="blank" href="http://www.linkedin.com/shareArticle?mini=true&url={{url('/event-'.$event->slug)}}?utm_source=linkedin&title=Disco+Dandia+Night&summary=Description">
                        <i class="fab fa-linkedin"></i>
                    </a>

                    <a class="btn btn-sm btn-primary" style="display: inline-block !important;" target="blank" href="http://twitter.com/intent/tweet?text=Check%20out:%20{{url('/event-'.$event->slug)}}?utm_source=twitter%20Description">
                        <i class="fab fa-twitter"></i>
                    </a>

                    <a class="btn btn-sm btn-primary" style="display: inline-block !important;" target="blank" href="mailto:?subject=Check This Out&body={{url('/event-'.$event->slug)}}?utm_source=email">
                        <i class="fa-solid fa-envelope"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(() => {
            const options = {
                plugins: {
                    legend: {
                        display: false,
                        labels: {
                            usePointStyle: true,
                        },
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1,
                            callback: function(label, index, labels) {
                                return label;
                            }
                        },
                    },
                }
            };
            const ctx = document.getElementById('ordersChart').getContext('2d');
            const myChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: JSON.parse(`{!! json_encode($tickets_sold_chart['labels']) !!}`),
                    datasets: [{
                        data: JSON.parse(`{!! json_encode($tickets_sold_chart['data']) !!}`),
                        fill: false,
                        borderColor: '#006699',
                        backgroundColor: "#006699",
                        tension: 0,
                        pointStyle: 'circle',
                        pointRadius: 5,
                        pointBorderColor: '#006699'
                    }],

                },
                options: options

            });

            const ctx2 = document.getElementById('amountChart').getContext('2d');
            const myChart2 = new Chart(ctx2, {
                type: 'line',
                data: {
                    labels: JSON.parse(`{!! json_encode($tickets_sales_volume_chart['labels']) !!}`),
                    datasets: [{
                        data: JSON.parse(`{!! json_encode($tickets_sales_volume_chart['data']) !!}`),
                        fill: false,
                        borderColor: '#006699',
                        backgroundColor: "#006699",
                        tension: 0,
                        pointStyle: 'circle',
                        pointRadius: 5,
                        pointBorderColor: '#006699'
                    }]
                },
                options: {
                    ...options,
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                stepSize: 50,
                                callback: function(label, index, labels) {
                                    return money(label);

                                }
                            },
                        },
                    }
                }
            });

            const ctx3 = document.getElementById('eventViewsChart').getContext('2d');
            const myChart3 = new Chart(ctx3, {
                type: 'line',
                data: {
                    labels: JSON.parse(`{!! json_encode($event_views_chart['labels']) !!}`),
                    datasets: [{
                        data: JSON.parse(`{!! json_encode($event_views_chart['data']) !!}`),
                        fill: false,
                        borderColor: '#006699',
                        backgroundColor: "#006699",
                        tension: 0,
                        pointStyle: 'circle',
                        pointRadius: 5,
                        pointBorderColor: '#006699'
                    }],

                },
                options: options

            });


            const ctx4 = document.getElementById('ticketDetailsChart').getContext('2d');
            const myChart4 = new Chart(ctx4, {
                type: 'line',
                data: JSON.parse('{!! json_encode($tickets_sold_details_chart) !!}'),
                options: {
                    ...options,
                    plugins: {
                        legend: {
                            display: true,
                            labels: {
                                usePointStyle: true,
                            },
                        }
                    },
                }
            });

        });
    </script>
</div>
@endsection