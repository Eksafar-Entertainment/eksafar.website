@extends('admin.layouts.admin')

@section('content')

<h3>Welcome to admin</h3>
<div class="row">
    <div class="col col-sm-6"><canvas id="ordersChart" width="400" height="150"></canvas></div>
    <div class="col col-sm-6"><canvas id="amountChart" width="400" height="150"></canvas></div>
</div>


<script>
    const ctx = document.getElementById('ordersChart').getContext('2d');
    const myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: JSON.parse('{!! json_encode($labels) !!}'),
            datasets: [{
                label: 'Orders by count',
                data: JSON.parse('{!! json_encode($data) !!}'),
                backgroundColor: JSON.parse('{!! json_encode($backgroundColors) !!}'),
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    const ctx2 = document.getElementById('amountChart').getContext('2d');
    const myChart2 = new Chart(ctx2, {
        type: 'bar',
        data: {
            labels: JSON.parse('{!! json_encode($labels) !!}'),
            datasets: [{
                label: 'Orders by amount',
                data: JSON.parse('{!! json_encode($amounts) !!}'),
                backgroundColor: JSON.parse('{!! json_encode($backgroundColors) !!}'),
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>
@endsection