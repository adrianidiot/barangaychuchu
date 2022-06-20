@extends('layouts.app')

@section('title', 'Dashboard')

@section('admin-style')
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">
<link href="plugins/bootstrap/css/bootstrap.css" rel="stylesheet">
<link href="/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">
<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
<link href="plugins/node-waves/waves.css" rel="stylesheet" />
<link href="plugins/animate-css/animate.css" rel="stylesheet" />
<link href="css/style.css" rel="stylesheet">
<link href="css/themes/all-themes.css" rel="stylesheet" />
@endsection

@section('content')
<body class="theme-red">
    <!-- Page Loader -->
    <div class="page-loader-wrapper">
        <div class="loader">
            <div class="preloader">
                <div class="spinner-layer pl-red">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
            </div>
            <p>Please wait...</p>
        </div>
    </div>
    <!-- #END# Page Loader -->
    <!-- Overlay For Sidebars -->
    <div class="overlay"></div>
    <!-- #END# Overlay For Sidebars -->
    <!-- Top Bar -->
    <nav class="navbar mid-blue">
        <div class="container-fluid">
            <div class="navbar-header">
                <a href="javascript:void(0);" class="bars"></a>
                <a class="navbar-brand" href="{{route('dashboard')}}">BARANGAY LUCBUBAM</a>
            </div>
        </div>
    </nav>
    <!-- #Top Bar -->
    <section>
        <!-- Left Sidebar -->
        <aside id="leftsidebar" class="sidebar">
            <!-- User Info -->
            <div class="user-info">
                <div class="image">
                    <img src="images/user.png" width="48" height="48" alt="User" />
                </div>
                <div class="info-container">
                    <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{Auth::user()->name}}</div>
                    <div class="email">{{Auth::user()->email}}</div>
                    <div class="btn-group user-helper-dropdown">
                        <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
                        <ul class="dropdown-menu pull-right">
                            <li>
                                <a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i class="material-icons">input</i>
                                    {{ __('Sign Out') }}
                                </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- #User Info -->
            <!-- Menu -->
            <div class="menu">
                <ul class="list">
                    <li class="header">MAIN NAVIGATION</li>
                    <li>
                        <a href="{{route('show.all-residents')}}" class="menu-toggle">
                            <i class="material-icons">view_list</i>
                            <span>ALL RESIDENTS</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('show.pwd')}}" class="menu-toggle">
                            <i class="material-icons">view_list</i>
                            <span>PWD'S</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('show.senior-citizen')}}" href="senior_citizens.php" class="menu-toggle">
                            <i class="material-icons">assignment</i>
                            <span>SENIOR CITIZENS</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('show.working')}}" class="menu-toggle">
                            <i class="material-icons">view_list</i>
                            <span>WORKING</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('show.nonWorking')}}" class="menu-toggle">
                            <i class="material-icons">view_list</i>
                            <span>NON WORKING</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('show.4pis')}}"  class="menu-toggle">
                            <i class="material-icons">view_list</i>
                            <span>4Ps</span>
                        </a>
                    <li>
                        <a href="{{route('show.minors')}}" class="menu-toggle">
                            <i class="material-icons">view_list</i>
                            <span>MINOR</span>
                        </a>
                    </li>
                </ul>
            </div>
            <!-- #Menu -->
        </aside>
        <!-- #END# Left Sidebar -->
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="block-header d-flex justify-content-between">
                <h2>DASHBOARD</h2>
                <div>
                    <a href="add-family/{{$generatedFamilyId}}" class="btn btn-lg mid-blue text-light rounded">
                        <i class="material-icons">group_add</i> <span>Add Residents by Family</span>
                    </a>
                    <a href="{{route('add.existing.resident')}}" class="btn btn-lg mid-blue text-light rounded">
                        <i class="material-icons">group</i> <span>Add Residents with Existing Family</span>
                    </a>
                    <a href="{{route('add.new.resident')}}" class="btn btn-lg mid-blue text-light rounded">
                        <i class="material-icons">person_add</i> <span>Add New Residents</span>
                    </a>
                </div>
            </div>

            <!-- Widgets -->
            <div class="row clearfix">
                <div class="col-lg-2 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box mid-blue hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">playlist_add_check</i>
                        </div>
                        <div class="content">
                            <div class="text">PWD'S</div>
                            <div class="number">{{$pwds}}</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box mid-blue hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">playlist_add_check</i>
                        </div>
                        <div class="content">
                            <div class="text">SENIOR'S</div>
                            <div class="number">{{$seniorCitizens}}</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box mid-blue hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">playlist_add_check</i>
                        </div>
                        <div class="content">
                            <div class="text">WORKING</div>
                            <div class="number">{{$working}}</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box mid-blue hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">playlist_add_check</i>
                        </div>
                        <div class="content">
                            <div class="text">NON-WORKING</div>
                            <div class="number">{{$nonWorking}}</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box mid-blue hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">playlist_add_check</i>
                        </div>
                        <div class="content">
                            <div class="text">4PIS</div>
                            <div class="number">{{$fourPs}}</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box mid-blue hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">playlist_add_check</i>
                        </div>
                        <div class="content">
                            <div class="text">MINORS</div>
                            <div class="number">{{$minors}}</div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Widgets -->

            <div class="row clearfix">
                <!-- Chart -->
                <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
                    <div class="card rounded">
                        <div class="header">
                            <h2>Residents Breakdown {{date('Y')}}</h2>
                        </div>
                        <div class="body">
                            <div id="container"></div>
                        </div>
                    </div>
                </div>
                <!-- #END# Chart -->
                <!-- Browser Usage -->
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                    <div class="card rounded">
                        <div class="body">
                            <div class="wrapper">
                                <header><i class='bx bx-left-arrow-alt'></i>Weather</header>
                                <section class="input-part">
                                  <p class="info-txt"></p>
                                  <div class="content">
                                    <input type="text" spellcheck="false" placeholder="Enter city name" required>
                                    <div class="separator"></div>
                                    <button>Get Device Location</button>
                                  </div>
                                </section>
                                <section class="weather-part">
                                  <img src="" alt="Weather Icon">
                                  <div class="temp">
                                    <span class="numb">_</span>
                                    <span class="deg">°</span>C
                                  </div>
                                  <div class="weather">_ _</div>
                                  <div class="location">
                                    <i class='bx bx-map'></i>
                                    <span>_, _</span>
                                  </div>
                                  <div class="bottom-details">
                                    <div class="column feels">
                                      <i class='bx bxs-thermometer'></i>
                                      <div class="details">
                                        <div class="temp">
                                          <span class="numb-2">_</span>
                                          <span class="deg">°</span>C
                                        </div>
                                        <p>Feels like</p>
                                      </div>
                                    </div>
                                    <div class="column humidity">
                                      <i class='bx bxs-droplet-half'></i>
                                      <div class="details">
                                        <span>_</span>
                                        <p>Humidity</p>
                                      </div>
                                    </div>
                                  </div>
                                </section>
                              </div>
                        </div>
                    </div>
                </div>
                <!-- #END# Browser Usage -->
            </div>
        </div>
    </section>
@endsection


@section('admin-scripts')
    <script src="plugins/jquery/jquery.min.js"></script>
    <script src="plugins/bootstrap/js/bootstrap.js"></script>
    <script src="plugins/node-waves/waves.js"></script>
    <script src="plugins/jquery-datatable/jquery.dataTables.js"></script>
    <script src="plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
    <script src="plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js"></script>
    <script src="plugins/jquery-datatable/extensions/export/buttons.flash.min.js"></script>
    <script src="plugins/jquery-datatable/extensions/export/jszip.min.js"></script>
    <script src="plugins/jquery-datatable/extensions/export/pdfmake.min.js"></script>
    <script src="plugins/jquery-datatable/extensions/export/vfs_fonts.js"></script>
    <script src="plugins/jquery-datatable/extensions/export/buttons.html5.min.js"></script>
    <script src="plugins/jquery-datatable/extensions/export/buttons.print.min.js"></script>
    <script src="js/pages/tables/jquery-datatable.js"></script>
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="js/admin.js"></script>
    <script type="text/javascript">
        Highcharts.chart('container', {
            title: {
                text: ''
            },
            xAxis: {
                categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep',
                    'Octo', 'Nov', 'Dec'
                ]
            },
            yAxis: {
                title: {
                    text: 'Number of New Residents'
                }
            },
            legend: {
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'middle'
            },
            plotOptions: {
                series: {
                    allowPointSelect: true
                }
            },
            series: [{
                name: 'New Residents',
                data: [{{$userArr[1]}}, {{$userArr[2]}}, {{$userArr[3]}}, {{$userArr[4]}}, {{$userArr[5]}}, {{$userArr[6]}}, {{$userArr[7]}}, {{$userArr[8]}}, {{$userArr[9]}}, {{$userArr[10]}}, {{$userArr[11]}}, {{$userArr[12]}}]
            }],
            responsive: {
                rules: [{
                    condition: {
                        maxWidth: 500
                    },
                    chartOptions: {
                        legend: {
                            layout: 'horizontal',
                            align: 'center',
                            verticalAlign: 'bottom'
                        }
                    }
                }]
            }
        });
    </script>
@endsection