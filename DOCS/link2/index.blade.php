<?php
?>

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
    <body style="background: linear-gradient(rgba(47, 23, 15, 0.65), rgba(47, 23, 15, 0.65)), url('assets/img/bg.jpg');background-image: url(&quot;none&quot;);background-color: #ecf0f1;color: rgb(230,230,230);">
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
                <div class="dropdown-menu" role="menu"><a class="dropdown-item" role="presentation" href="fundraising.html"><i class="fa fa-star fa-fw"></i> Link Item</a><a class="dropdown-item" role="presentation" href="donations.html"><i class="fa fa-star fa-fw"></i> Link Item</a><a class="dropdown-item"
                        role="presentation" href="events-listing.html"><i class="fa fa-star fa-fw"></i> Link Item</a></div>
            </li>
        </ul>
        </div>
        </div>
    </nav>
    <div class="text-center border rounded-0 shadow-sm profile-box" style="width: 200px;height: 300px;background-color: #ffffff;margin: 5px;margin-top: 70px;margin-left: 26px;">
        <div style="height: 50px;background-image: url(&quot;assets/img/bg-pattern.png&quot;);background-color: rgba(54,162,177,0);"></div>
        <div><img class="rounded-circle" src="assets/img/bg-cta.jpg" width="60px" height="60px" style="background-color: rgb(255,255,255);padding: 2px;"></div>
        <div style="height: 80px;">
            <h4>{{ $user->getFirstname() }} {{ $user->getLastname() }}</h4>
            <p style="font-size: 12px;">{{ $user->getBio() }}</p>
        </div>
    </div>

</body>
@endsection