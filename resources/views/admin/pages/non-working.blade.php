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
                <a href="{{route('dashboard')}}" class="btn btn-lg mid-blue text-light rounded">
                    Back to Dashboard
                </a>
            </div>
            <!-- RESIDENTS -->
            <div class="row clearfix">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="card rounded">
                        <div class="header">
                            <h2 class="d-flex justify-content-between align-items-center">
                                <span>NON WORKING RESIDENTS</span> <span class="badge mid-blue text-white">{{$residents->count()}}</span>
                            </h2>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                    <thead>
                                        <tr>
                                            <th>Last</th>
                                            <th>First</th>
                                            <th>Middle</th>
                                            <th>Sex</th>
                                            <th>Age</th>
                                            <th>Birth Date</th>
                                            <th>Birth Place</th>
                                            <th>Civil Status</th>
                                            <th>Occupation</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if($residents->count() > 0)
                                            @foreach($residents as $resident)
                                                <tr>
                                                    <td>{{$resident->first_name}}</td>
                                                    <td>{{$resident->last_name}}</td>
                                                    <td>{{$resident->middle_name}}</td>
                                                    <td>{{$resident->sex}}</td>
                                                    <td>{{$resident->age}}</td>
                                                    <td>{{$resident->birth_date}}</td>
                                                    <td>{{$resident->birth_place}}</td>
                                                    <td>{{$resident->civil_status}}</td>
                                                    <td>{{$resident->occupation}}</td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# RESIDENTS -->
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
    <script src="js/admin.js"></script>
@endsection