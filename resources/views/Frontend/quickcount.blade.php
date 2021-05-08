@extends('layouts.Frontend.master')
@section('title')
    QuickCount Pemira 2021
@endsection

@section('content')
    <!-- section one -->
    <section class="one">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-4 col-12">
                    <canvas id="myChart" width="100px"></canvas>
                </div>
                <div class="col-md-4 col-12">
                    <canvas id="bagian_1" width="100px"></canvas>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('js-tambahan')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script type="text/javascript">
        const data = {
            labels: [
                'Budi',
                'Santoni',
                'Golput'
            ],
            datasets: [{
                label: 'Realtime Quick Count',
                data: [500, 910, 400],
                backgroundColor: [
                    'rgb(255, 99, 132)',
                    'rgb(75, 192, 192)',
                    'rgb(201, 203, 207)',
                ]
            }]
        };
        const config = {
            type: 'polarArea',
            data: data,
            options: {}
        };
        var myChart = new Chart(
            document.getElementById('myChart'),
            config
        );

    </script>
    <script type="text/javascript">
        const hasil = {
            labels: [
                'Budi',
                'Santoni',
            ],
            datasets: [{
                label: 'My First Dataset',
                data: [300, 50],
                backgroundColor: [
                    'rgb(255, 99, 132)',
                    'rgb(54, 162, 235)',
                ],
                hoverOffset: 4
            }]
        };
        const set = {
            type: 'doughnut',
            data: hasil,
        };
        var myChart = new Chart(
            document.getElementById('bagian_1'),
            set
        );

    </script>
@endsection
