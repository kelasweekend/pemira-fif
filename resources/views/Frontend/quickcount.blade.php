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
                    <canvas id="canvas"></canvas>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('js-tambahan')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        var year = {{ $year }}
        var user = {{ $user }}
        const data = {
            labels: year,
            datasets: [{
                label: 'My First Dataset',
                data: user,
                backgroundColor: [
                    'rgb(255, 99, 132)',
                    'rgb(54, 162, 235)',
                    'rgb(255, 205, 86)'
                ],
                hoverOffset: 4
            }]
        };
        const config = {
            type: 'doughnut',
            data: data,
        };
        var myChart = new Chart(
            document.getElementById('canvas'),
            config
        );
    </script>

    <script type="text/javascript">
        let pemilih = {{ $total_pemilih }}
        let suara = {{ $suara_masuk }}
        let golput = {{ $golput }}
        const datasheet = {
            labels: [
                'Total Suara',
                'Suara Masuk',
                'Golput'
            ],
            datasets: [{
                label: 'Realtime Quick Count',
                data: [pemilih, suara, golput],
                backgroundColor: [
                    'rgb(255, 99, 132)',
                    'rgb(75, 192, 192)',
                    'rgb(201, 203, 207)',
                ]
            }]
        };
        const configurasi = {
            type: 'polarArea',
            data: datasheet,
            options: {}
        };
        var myChart = new Chart(
            document.getElementById('myChart'),
            configurasi
        );
    </script>
@endsection