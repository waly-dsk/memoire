@extends('layout.theme')
@section('title', 'Graphe Consultation Mémoires')
@section('content')
    <div class="page-header">
        <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary text-white mr-2">
                <i class="mdi mdi-chart-areaspline"></i>
            </span>
            Graphes
        </h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Consultation sur place</a></li>
                <li class="breadcrumb-item active" aria-current="page">Mémoires - Thèses</li>
            </ol>
        </nav>
    </div>
    <div class="row">
        <div class="col-lg-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Mois de Consultations</h4>
                    <p class="card-description">
                        Les <code> Mois de Consultations </code> du <code>Plus Récent au Plus Ancien</code>
                    </p>
                    <hr>
                    <form class="forms-sample">
                        <div class="form-group row mt-5">
                            <div class="col">
                                <select id="mois" class="form-control form-control-lg">
                                    @foreach ($mois as $moi)
                                        <option value="{{ $moi->mois_annee }}">
                                            @php
                                                setlocale(LC_TIME, 'fr_FR.UTF-8');
                                                $currentMonth = ucfirst(strftime('%B %Y', strtotime($moi->mois_annee)));
                                                echo $currentMonth;
                                            @endphp
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Bar chart</h4>
                    <canvas id="barChart" style="height:230px"></canvas>
                </div>
            </div>
        </div>
        <div class="col-lg-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Pie chart</h4>
                    <canvas id="pieChart" style="height:230px"></canvas>
                </div>
            </div>
        </div>
        <div class="col-lg-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Doughnut chart</h4>
                    <canvas id="doughnutChart" style="height:230px"></canvas>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(function() {
            load_charts($('#mois').val());
            $('#mois').on('change', function() {
                let mois = $(this).val();
                load_charts(mois);
            });

            function load_charts(mois) {
                let barChartCanvas = $("#barChart").get(0).getContext("2d"),
                    pieChartCanvas = $("#pieChart").get(0).getContext("2d"),
                    doughnutChartCanvas = $("#doughnutChart").get(0).getContext("2d"),
                    dataForBar, dataForPie, datum, labels, backgroundColors, borderColors;
                // Supposons que les données de la requête sont stockées dans la variable 'memos'
                $.get('{{ url('get_memos') }}/' + mois, function(items) {
                    labels = [];
                    datum = [];
                    backgroundColors = [];
                    borderColors = [];
                    items.forEach(item => {
                        labels.push(item.entite);
                        datum.push(item.total_consultations);
                        for (let i = 0; i < items.length; i++) {
                            backgroundColor = getColors()[0];
                            borderColor = getColors()[1];
                            backgroundColors.push(backgroundColor);
                            borderColors.push(borderColor);
                        }
                    });
                    dataForBar = {
                        labels: labels,
                        datasets: [{
                            data: datum,
                            backgroundColor: backgroundColors,
                            borderColor: borderColors,
                            borderWidth: 1,
                            fill: false
                        }],
                    };

                    dataForPie = {
                        datasets: [{
                            data: datum,
                            backgroundColor: backgroundColors,
                            borderColor: borderColors,
                        }],
                        labels: labels,
                    };

                    makeBarChart('bar', dataForBar, barChartCanvas);
                    makePieChart('pie', dataForPie, pieChartCanvas);
                    makePieChart('doughnut', dataForPie, doughnutChartCanvas);
                });
            }

            function makeBarChart(type, data, ctx) {
                return new Chart(ctx, {
                    type: type,
                    data: data,
                    options: {
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true
                                }
                            }]
                        },
                        legend: {
                            display: false
                        },
                        elements: {
                            point: {
                                radius: 0
                            }
                        },
                    },
                });
            }

            function makePieChart(type, data, ctx) {
                return new Chart(ctx, {
                    type: type,
                    data: data,
                    options: {
                        responsive: true,
                        animation: {
                            animateScale: true,
                            animateRotate: true
                        },
                    }
                });
            }


            function getColors() {
                let chartColors = [],
                    borderColors = [
                        'rgba(255,99,132,1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    backgroundColors = [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    index = Math.floor(7 * Math.random());
                backgroundColor = backgroundColors[index];
                borderColor = borderColors[index];
                chartColors.push(backgroundColor, borderColor);
                return chartColors;
            }
        });
    </script>
@endsection
