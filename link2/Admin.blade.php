@extends('layouts.app')

@section('styles')
    <!-- <link> tags go here -->
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lora:400,400i,700,700i">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=ABeeZee">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Catamaran:100,200,300,400,500,600,700,800,900">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Muli">
    <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/fonts/fontawesome5-overrides.min.css">
    <link rel="stylesheet" href="assets/css/LinkedIn-like-Profile-Box.css">
    <link rel="stylesheet" href="assets/css/Navbar---App-Toolbar--LG--MD---Mobile-Nav--SM--XS-1.css">
    <link rel="stylesheet" href="assets/css/Navbar---App-Toolbar--LG--MD---Mobile-Nav--SM--XS.css">
    <link rel="stylesheet" href="assets/css/Profile-Edit-Form-1.css">
    <link rel="stylesheet" href="assets/css/Profile-Edit-Form.css">
    <link rel="stylesheet" href="assets/css/Search-Field-With-Icon.css">
@endsection

@section('scripts')
    <!-- <script> tags go here -->
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/current-day.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.js"></script>
    <script src="assets/js/Profile-Edit-Form.js"></script>
    <script src="assets/js/theme.js"></script>
@endsection

@section('content')
    <!-- body elements go here -->
    <body id="page-top" style="background-color: #ecf0f1;background-image: url(&quot;none&quot;);">
    <div id="wrapper" style="background-color: #ecf0f1;">
        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
                <div class="container-fluid">
                    <nav class="navbar navbar-light navbar-expand-md" style="height: 61px;background-color: #0a3d62;">
                        <div class="container-fluid">
                            <div><a class="navbar-brand" href="#" style="color: rgb(236,240,241);">Connect</a><button data-toggle="collapse" class="navbar-toggler" data-target="#navcol-2"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button></div>
                            <div
                                class="collapse navbar-collapse" id="navcol-2" style="height: 48px;color: #ecf0f1;">
                                <div class="search-container"></div>
                                <ul class="nav navbar-nav ml-auto" id="desktop-toolbar">
                                    <li class="nav-item" role="presentation"><a class="nav-link" href="#"></a></li>
                                    <li class="nav-item dropdown"><a class="dropdown-toggle nav-link" data-toggle="dropdown" aria-expanded="false" href="#" style="color: rgb(236,240,241);"><img class="rounded-circle" src="assets/img/user-photo.jpg" width="25px" height="25px" style="margin-top: -5px;"> John <i class="fa fa-chevron-down fa-fw"></i></a>
                                        <div
                                            class="dropdown-menu" role="menu"><a class="dropdown-item" role="presentation" href="#"><i class="fa fa-user fa-fw"></i> Profile </a><a class="dropdown-item" role="presentation" href="#"><i class="fa fa-power-off fa-fw"></i>Logout </a></div>
                        </li>
                        </ul>
                        <ul class="nav navbar-nav" id="mobile-nav">
                            <li class="nav-item" role="presentation"></li>
                            <li class="nav-item" role="presentation"><a class="nav-link" href="index.html" style="color: rgb(236,240,241);"> Nav Item</a></li>
                            <li class="nav-item dropdown"><a class="dropdown-toggle nav-link" data-toggle="dropdown" aria-expanded="false" href="#" style="color: rgb(236,240,241);"> Dropdown<i class="fa fa-chevron-down fa-fw"></i> </a>
                                <div class="dropdown-menu" role="menu"><a class="dropdown-item" role="presentation" href="#nogo"><i class="fa fa-star fa-fw"></i> Link Item</a><a class="dropdown-item" role="presentation" href="#nogo"><i class="fa fa-star fa-fw"></i> Link Item</a></div>
                            </li>
                            <li class="nav-item dropdown"><a class="dropdown-toggle nav-link" data-toggle="dropdown" aria-expanded="false" href="#" style="color: rgb(236,240,241);"><i class="fa fa-star fa-fw"></i> Dropdown </a>
                                <div class="dropdown-menu" role="menu"><a class="dropdown-item" role="presentation" href="fundraising.html"><i class="fa fa-star fa-fw"></i> Link Item</a><a class="dropdown-item" role="presentation" href="donations.html"><i class="fa fa-star fa-fw"></i> Link Item</a>
                                    <a
                                        class="dropdown-item" role="presentation" href="events-listing.html"><i class="fa fa-star fa-fw"></i> Link Item</a>
                                </div>
                            </li>
                        </ul>
                </div>
            </div>
            </nav>
            <h3 class="text-dark mb-4">Admin</h3>
            <div class="card shadow">
                <div class="card-header py-3">
                    <p class="text-primary m-0 font-weight-bold">Users Info</p>
                </div>
                <div class="card-body" style="width: 1177px;">
                    <div class="row">
                        <div class="col-md-6 text-nowrap">
                            <div id="dataTable_length" class="dataTables_length" aria-controls="dataTable"><label>Show&nbsp;<select class="form-control form-control-sm custom-select custom-select-sm"><option value="10" selected="">10</option><option value="25">25</option><option value="50">50</option><option value="100">100</option></select>&nbsp;</label></div>
                        </div>
                        <div class="col-md-6">
                            <div class="text-md-right dataTables_filter" id="dataTable_filter"><label><input type="search" class="form-control form-control-sm" aria-controls="dataTable" placeholder="Search"></label></div>
                        </div>
                    </div>
                    <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
                        <table class="table dataTable my-0" id="dataTable">
                            <thead>
                                <tr>
                                    <th style="width: 86px;">Username</th>
                                    <th style="width: 104px;">Firstname</th>
                                    <th style="width: 91px;">Lastname</th>
                                    <th style="width: 175px;">Email</th>
                                    <th style="width: 62px;">City</th>
                                    <th style="width: 10px;">State</th>
                                    <th style="width: 36px;"></th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($users as $user)
                                <tr></tr>
                                <tr></tr>
                                <tr>
                                    <td style="width: -4px;"><img class="rounded-circle mr-2" width="30" height="30" src="assets/img/avatars/avatar5.jpeg" style="margin-top: -2px;">Cedric Kelly</td>
                                    <td style="width: 76px;">Cedric{{ $user->getFirstname() }}</td>
                                    <td style="width: 69px;">{{ $user->getLastname() }}</td>
                                    <td style="width: 61px;">{{ $user->getEmail() }}</td>
                                    <td>{{ $user->getCity() }}</td>
                                    <td style="width: 15px;">{{ $user->getState() }}</td>
                                    <td style="width: 56px;"><button class="btn btn-primary" type="button" style="width: 36px;height: 37px;margin-right: 14px;background-color: rgb(192,57,43);"><i class="fa fa-trash-o" style="margin-top: -9px;margin-left: -2px;"></i></button>
                                        <button
                                            class="btn btn-primary" type="button" style="width: 36px;height: 37px;"><i class="fa fa-save" style="margin-top: -9px;margin-left: -2px;"></i></button><br></td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td><strong>Name</strong></td>
                                    <td><strong>Firstname</strong></td>
                                    <td><strong>Lastname</strong></td>
                                    <td><strong>Email</strong></td>
                                    <td><strong>City</strong></td>
                                    <td><strong>State</strong></td>
                                    <td><strong></strong></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-md-6 align-self-center">
                            <p id="dataTable_info" class="dataTables_info" role="status" aria-live="polite">Showing 1 to 10 of 27</p>
                        </div>
                        <div class="col-md-6">
                            <nav class="d-lg-flex justify-content-lg-end dataTables_paginate paging_simple_numbers">
                                <ul class="pagination">
                                    <li class="page-item disabled"><a class="page-link" href="#" aria-label="Previous"><span aria-hidden="true">«</span></a></li>
                                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                                    <li class="page-item"><a class="page-link" href="#" aria-label="Next"><span aria-hidden="true">»</span></a></li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div><a class="border rounded d-inline scroll-to-top" href="#page-top"></a></div>
  
</body>
@endsection