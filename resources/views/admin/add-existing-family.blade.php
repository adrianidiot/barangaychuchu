@extends('layouts.app')

@section('title', 'Exist Family Residents')

@section('admin-style')
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">
<link href="{{asset('plugins/bootstrap/css/bootstrap.css')}}" rel="stylesheet">
<link href="{{asset('/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css')}}" rel="stylesheet">
<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
<link href="{{asset('plugins/node-waves/waves.css')}}" rel="stylesheet" />
<link href="{{asset('plugins/animate-css/animate.css')}}" rel="stylesheet" />
<link href="{{asset('css/style.css')}}" rel="stylesheet">
<link href="{{asset('css/themes/all-themes.css')}}" rel="stylesheet" />
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
                <a class="navbar-brand" href="index.html">Barangay Lucbuban</a>
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
            @if(session()->has('message'))
                <div class="alert alert-success alert-dismissible show text-capitalize" role="alert">
                    {{ session()->get('message') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            <!-- RESIDENTS -->
            <div class="row clearfix">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="card rounded">
                        <div class="header">
                            <h2>
                                Add Resident with existing family
                            </h2>
                        </div>
                        <div class="body">
                            <form method="POST" action="{{route('store.resident')}}">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>Family Code</label>
                                            <input type="number" name="code" class="form-control @error('code') is-invalid @enderror" placeholder="Family code (6 digits)"  onKeyDown="if(this.value.length==6) return false;">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>First Name</label>
                                            <input type="text" name="firstName" class="form-control @error('firstName') is-invalid @enderror" placeholder="First Name">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>Last Name</label>
                                            <input type="text" name="lastName" class="form-control @error('lastName') is-invalid @enderror" placeholder="Last Name">
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label>Middle Name</label>
                                            <input type="text" name="middleName" class="form-control @error('middleName') is-invalid @enderror" placeholder="Middle Name">
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label>Category Type</label>
                                            <div class="input-group mb-3">
                                                <select name="categoryType" class="form-control @error('category') is-invalid @enderror">
                                                  <option selected disabled>Choose...</option>
                                                  <option value="PWD">PWD'S</option>
                                                  <option value="SENIOR CITIZENS">SENIOR CITIZENS</option>
                                                  <option value="WORKING">WORKING</option>
                                                  <option value="NON-WORKING">NON-WORKING</option>
                                                  <option value="4PS">4PS</option>
                                                  <option value="MINOR">MINOR</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label>Sex</label>
                                            <div class="input-group mb-3">
                                                <select name="sex" class="form-control @error('sex') is-invalid @enderror">
                                                  <option selected disabled>Choose...</option>
                                                  <option value="Male">Male</option>
                                                  <option value="Female">Female</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label>Age</label>
                                            <input type="number" name="age" class="form-control @error('age') is-invalid @enderror" placeholder="Age">
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label>Birthdate</label>
                                            <input type="date" name="birthDate" class="form-control @error('birthDate') is-invalid @enderror" placeholder="Birthdate">
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label>Birth Place</label>
                                            <input type="text" name="birthPlace" class="form-control @error('birthPlace') is-invalid @enderror" placeholder="Birth Place">
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label>Civil Status</label>
                                            <div class="input-group mb-3">
                                                <select name="civilStatus" class="form-control @error('civilStatus') is-invalid @enderror">
                                                  <option selected disabled>Choose...</option>
                                                  <option value="Single">Single</option>
                                                  <option value="Maried">Maried</option>
                                                  <option value="Divorced">Divorced</option>
                                                  <option value="Widowed">Widowed</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label>Occupation</label>
                                            <input type="text" name="occupation" class="form-control @error('occupation') is-invalid @enderror" placeholder="Occupation">
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn mid-blue text-light rounded">Add</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# RESIDENTS -->
            
        </div>
    </section>
@endsection


@section('admin-scripts')
    <script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('plugins/bootstrap/js/bootstrap.js')}}"></script>
    <script src="{{asset('plugins/node-waves/waves.js')}}"></script>
    <script src="{{asset('plugins/jquery-datatable/jquery.dataTables.js')}}"></script>
    <script src="{{asset('plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js')}}"></script>
    <script src="{{asset('plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('plugins/jquery-datatable/extensions/export/buttons.flash.min.js')}}"></script>
    <script src="{{asset('plugins/jquery-datatable/extensions/export/jszip.min.js')}}"></script>
    <script src="{{asset('plugins/jquery-datatable/extensions/export/pdfmake.min.js')}}"></script>
    <script src="{{asset('plugins/jquery-datatable/extensions/export/vfs_fonts.js')}}"></script>
    <script src="{{asset('plugins/jquery-datatable/extensions/export/buttons.html5.min.js')}}"></script>
    <script src="{{asset('plugins/jquery-datatable/extensions/export/buttons.print.min.js')}}"></script>
    <script src="{{asset('js/pages/tables/jquery-datatable.js')}}"></script>
    <script src="{{asset('js/admin.js')}}"></script>
@endsection