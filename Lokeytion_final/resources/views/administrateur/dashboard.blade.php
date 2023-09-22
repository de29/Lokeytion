@include('navbar')

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Tableau de bord</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="robots" content="noindex">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

    <!-- Google fonts - Poppins -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,700">
    <!-- Choices CSS-->
    <link rel="stylesheet"
        href="https://d19m59y37dris4.cloudfront.net/admin/2-1-0/vendor/choices.js/public/assets/styles/choices.min.css">
    <!-- theme stylesheet-->
    <link rel="stylesheet" href="https://d19m59y37dris4.cloudfront.net/admin/2-1-0/css/style.default.403dfb71.css"
        id="theme-stylesheet">
    <!-- Custom stylesheet - for your changes-->
    <link rel="stylesheet" href="https://d19m59y37dris4.cloudfront.net/admin/2-1-0/css/custom.0a822280.css">
    <!-- Favicon-->
    <link rel="shortcut icon" href="https://d19m59y37dris4.cloudfront.net/admin/2-1-0/img/favicon.3903ee9d.ico">
    <!-- Tweaks for older IEs-->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css"
        integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
</head>

<body>
    <div class="page">
        <div class="page-content d-flex align-items-stretch">
            <div class="content-inner w-100">
                <!-- Page Header-->
                <header class="bg-white shadow-sm px-4 py-3 z-index-20">
                    <div class="container-fluid px-0">
                        <h2 class="mb-0 p-1">Tableau de bord</h2>
                    </div>
                </header>
                <!-- Dashboard Counts Section-->
                <section class="pb-0">
                    <div class="container-fluid">
                        <div class="card mb-0">
                            <div class="card-body">
                                <div class="row gx-5 bg-white">
                                    <!-- Item -->
                                    <div class="col-xl-3 col-sm-6 py-4 border-lg-end border-gray-200">
                                        <div class="d-flex align-items-center">
                                            <div class="icon flex-shrink-0 bg-violet">
                                                <svg class="svg-icon svg-icon-sm svg-icon-heavy">
                                                    <use xlink:href="#user-1"> </use>
                                                </svg>
                                            </div>
                                            <div class="mx-3">
                                                <h6 class="h4 fw-light text-gray-600 mb-3">Nombres des<br>utilisateurs
                                                </h6>
                                                <div class="progress" style="height: 4px">
                                                    <div class="progress-bar bg-violet" role="progressbar"
                                                        style="width: {{ $totalUsers }}%; height: 4px;"
                                                        aria-valuenow="{{ $totalUsers }}" aria-valuemin="0"
                                                        aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                            <div class="number"><strong class="text-lg">{{ $totalUsers }}</strong>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Item -->
                                    <div class="col-xl-3 col-sm-6 py-4 border-lg-end border-gray-200">
                                        <div class="d-flex align-items-center">
                                            <div class="icon flex-shrink-0 bg-red">
                                                <svg class="svg-icon svg-icon-sm svg-icon-heavy">
                                                    <use xlink:href="#survey-1"> </use>
                                                </svg>
                                            </div>
                                            <div class="mx-3">
                                                <h6 class="h4 fw-light text-gray-600 mb-3">Nombres des<br>annonces</h6>
                                                <div class="progress" style="height: 4px">
                                                    <div class="progress-bar bg-red" role="progressbar"
                                                        style="width: {{ $totalAnnonces }}%; height: 4px;"
                                                        aria-valuenow="{{ $totalAnnonces }}" aria-valuemin="0"
                                                        aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                            <div class="number"><strong class="text-lg">{{ $totalAnnonces }}</strong>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Item -->
                                    <div class="col-xl-3 col-sm-6 py-4 border-lg-end border-gray-200">
                                        <div class="d-flex align-items-center">
                                            <div class="icon flex-shrink-0 bg-green">
                                                <svg class="svg-icon svg-icon-sm svg-icon-heavy">
                                                    <use xlink:href="#numbers-1"> </use>
                                                </svg>
                                            </div>
                                            <div class="mx-3">
                                                <h6 class="h4 fw-light text-gray-600 mb-3">Nombres des<br>objets</h6>
                                                <div class="progress" style="height: 4px">
                                                    <div class="progress-bar bg-green" role="progressbar"
                                                        style="width: {{ $totalObjets }}%; height: 4px;"
                                                        aria-valuenow="{{ $totalObjets }}" aria-valuemin="0"
                                                        aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                            <div class="number"><strong class="text-lg">{{ $totalObjets }}</strong>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Item -->
                                    <div class="col-xl-3 col-sm-6 py-4">
                                        <div class="d-flex align-items-center">
                                            <div class="icon flex-shrink-0 bg-orange">
                                                <svg class="svg-icon svg-icon-sm svg-icon-heavy">
                                                    <use xlink:href="#list-details-1"> </use>
                                                </svg>
                                            </div>
                                            <div class="mx-3">
                                                <h6 class="h4 fw-light text-gray-600 mb-3">Nombres des<br>demandes</h6>
                                                <div class="progress" style="height: 4px">
                                                    <div class="progress-bar bg-orange" role="progressbar"
                                                        style="width:{{ $totalDemandes }}%; height: 4px;"
                                                        aria-valuenow="{{ $totalDemandes }}" aria-valuemin="0"
                                                        aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                            <div class="number"><strong class="text-lg">{{ $totalDemandes }}</strong>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- Dashboard Header Section    -->
                <section class="pb-0">
                    <div class="container-fluid">
                        <div class="row align-items-stretch">
                            <!-- Statistics -->
                            <div class="col-lg-6 col-10">

                                <div class="card">
                                    <div class="card-body" >
                                        Nombre des utilisateurs par ville :<br><br>
                                        <canvas id="pieChart" style="max-width: 500px; max-height: 300px;"></canvas>

                                    </div>

                                </div>
                                @php
                                    $pieData = [];
                                    foreach ($usersByCity as $city) {
                                        $pieData[] = [
                                            'label' => $city->ville,
                                            'value' => $city->count,
                                        ];
                                    }
                                @endphp


                                <div class="card mb-0">
                                    <div class="card-body">
                                        Nombre des annonces disponibles par jour :<br><br>
                                        <!-- Créer un canvas pour afficher le graphique -->
                                        <canvas id="myChart1" style="max-width: 500px; max-height: 300px;"></canvas>
                                    </div>
                                </div>




                            </div>



                            <div class="col-lg-6 col-12">
                                <!-- Bar Chart   -->
                                <div class="card" >
                                    <div class="card-body">
                                        Nombre des objets per utilisateur :<br><br>
                                        <canvas id="barChartHome" style="max-width: 500px; max-height: 300px;"></canvas>
                                    </div>


                                </div>

                                <!-- Numbers-->
                                <div class="card mb-0">
                                    <div class="card-body" >
                                        Nombre des annonces par objet :<br><br>
                                        <canvas id="myChart"  style="max-width: 500px; max-height: 300px; "></canvas>
                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>


                </section>


                <!-- Projects Section-->
                <section class="pb-0">
                    <div class="container-fluid">
                        <!-- Project-->
                        @foreach ($annonces as $annonce)
                            <div class="card mb-3">
                                <div class="card-body p-3">
                                    <div class="row align-items-center gx-lg-5 gy-3">
                                        <div class="col-lg-6 border-lg-end">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <div class="d-flex align-items-center"><img
                                                        class="img-fluid shadow-sm"
                                                        src="../images/annonces/{{ $annonce->image1 }}"
                                                        alt="..." width="50">
                                                        <a href="{{ route('detail', ['id' => $annonce->id_annonce]) }}">
                                                    <div class="ms-3">
                                                        <h3 class="h4 text-gray-700 mb-0">{{ $annonce->titre }}</h3>
                                                        <small class="text-gray-500">{{ $annonce->nom }}
                                                            {{ $annonce->prenom }}</small>
                                                    </div>
                                </a>
                                                </div><span
                                                    class="text-sm text-gray-600 d-none d-sm-block">{{ $annonce->created_at }}</span>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="d-flex align-items-center">
                                                <p
                                                    class="d-flex mb-0 text-gray-600 text-sm d-flex align-items-center flex-shrink-0">
                                                    <i class="far fa-clock me-1"></i><?php
                                                    $heure = date('h:i', strtotime('now'));
                                                    $new_time = date('h:i', strtotime('+1 hour', strtotime($heure)));
                                                    echo $new_time;
                                                    ?> PM
                                                </p>
                                                <p
                                                    class="d-flex mb-0 mx-3 text-gray-600 text-sm d-flex align-items-center flex-shrink-0">
                                                    <i class="far fa-comment me-1"></i>{{ $annonce->comment_count }}
                                                </p>
                                                <div class="progress w-100" style="height: 5px; max-width: 15rem">
                                                    <div class="progress-bar bg-red" role="progressbar"
                                                        style="width: {{ $annonce->comment_count }}%; height: 6px;"
                                                        aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>


            </div>
        </div>
    </div>
    <script>
        //Nombre des utilisateurs par ville :
        var pieData = @json($pieData);

        var ctx = document.getElementById('pieChart').getContext('2d');
        var pieChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: pieData.map(data => data.label),
                datasets: [{
                    data: pieData.map(data => data.value),
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                }]
            },
            options: {}
        });


        //Nombre des annonces disponible par jour
        // Récupérer le tableau des jours et de leur occurrence
        var jours_counts = {!! json_encode($jours_counts) !!};

        // Créer un tableau pour stocker les jours et leur occurrence
        var labels = [];
        var data = [];

        // Remplir le tableau avec les données
        Object.keys(jours_counts).forEach(function(jour) {
            labels.push(jour);
            data.push(jours_counts[jour]);
        });

        // Créer le graphique à barres
        var ctx = document.getElementById('myChart1').getContext('2d');
        var myChart1 = new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Nombre des annonces disponible par jour',
                    data: data,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
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




        //nombre des annonces par objet
        var ctx = document.getElementById('barChartHome').getContext('2d');
        var barChartHome = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: [
                    @foreach ($objectsByUser as $object)
                        '{{ $object->nom }}',
                    @endforeach
                ],
                datasets: [{
                    label: 'Nombre des objets par utilisateur',
                    data: [
                        @foreach ($objectsByUser as $object)
                            '{{ $object->count }}',
                        @endforeach
                    ],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
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



        var data = <?php echo $annoncesParObjet; ?>;
        var labels = [];
        var values = [];
        for (var i = 0; i < data.length; i++) {
            labels.push(data[i].nom);
            values.push(data[i].total);
        }
        var ctx = document.getElementById('myChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: labels,
                datasets: [{
                    data: values,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false
            }
        });
    </script>
  @include('footer')

  <!-- Template Javascript -->
  <script src="{{url('js/main.js')}}"></script>
    <script src="{{url('js/zoom.js')}}"></script>

          <!-- JAVASCRIPT FILES -->
  <script src="{{url('js/swiper-bundle.min.js')}}"></script>
  <script src="{{url('js/script.js')}}"></script>

</body>

</html>


<style>

nav.navbar {
    background: #2e2e2e;
}

nav.navbar a {
    color: #fff;
}

.Reseaux {
    padding-left: 350%;
}
</style>