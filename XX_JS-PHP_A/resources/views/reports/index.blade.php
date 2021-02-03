@extends('layouts.app')

@section('main')
    <div class="border-bottom mb-3 pt-3 pb-2">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center">
            <h1 class="h2">{{$event->name}}</h1>
        </div>
        <span class="h6">{{$event->date}}</span>
    </div>

    <div class="mb-3 pt-3 pb-2">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center">
            <h2 class="h4">Room Capacity</h2>
        </div>
    </div>

    <!-- TODO create chart here -->
    <canvas id="myChart"></canvas>

    <script src="{{asset('public/Chart.js-2.8.0/dist/Chart.js')}}"></script>
    <script>
        var data = @json($data);
        var attendees = [];
        var colors = [];
        var capacities = [];
        var labels = [];

        data.forEach(item => {
            attendees.push(item.attendee);
            capacities.push(item.capacity);
            labels.push(item.session);
            if (item.attendee > item.capacity) {
                colors.push('rgba(255, 99, 132, 1)');
            } else {
                colors.push('rgba(75, 192, 192, 1)');
            }
        });

        var ctx = document.getElementById('myChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Attendees',
                    data: attendees,
                    backgroundColor: colors
                },{
                    label: 'Capacity',
                    data: capacities,
                    backgroundColor: 'rgba(54, 162, 235, 1)'
                },]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
    </script>
@endsection
