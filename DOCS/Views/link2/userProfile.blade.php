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
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/LinkedIn-like-Profile-Box.css">
    <link rel="stylesheet" href="assets/css/Navbar---App-Toolbar--LG--MD---Mobile-Nav--SM--XS-1.css">
    <link rel="stylesheet" href="assets/css/Navbar---App-Toolbar--LG--MD---Mobile-Nav--SM--XS.css">
    <link rel="stylesheet" href="assets/css/Profile-Card.css">
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
    <body style="background-image: url(&quot;none&quot;);background-color: #ffffff;">
    <nav class="navbar navbar-light navbar-expand-md" style="height: 61px;background-color: #0a3d62;">
        <div class="container-fluid">
            <div><a class="navbar-brand" href="#" style="color: rgb(236,240,241);">Connect</a><button data-toggle="collapse" class="navbar-toggler" data-target="#navcol-2"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button></div>
            <div
                class="collapse navbar-collapse" id="navcol-2" style="height: 48px;color: #ecf0f1;">
                <div class="search-container"></div>
                <ul class="nav navbar-nav ml-auto" id="desktop-toolbar">
                    <li class="nav-item" role="presentation"><a class="nav-link" href="#"></a></li>
                    <li class="nav-item dropdown"><a class="dropdown-toggle nav-link" data-toggle="dropdown" aria-expanded="false" href="#" style="color: rgb(236,240,241);"><img class="rounded-circle" src="assets/img/user-photo.jpg" width="25px" height="25px" style="margin-top: -6px;"> John <i class="fa fa-chevron-down fa-fw"></i></a>
                        <div
                            class="dropdown-menu" role="menu"><a class="dropdown-item" role="presentation" href="#"><i class="fa fa-user fa-fw"></i> Profile </a><a class="dropdown-item" role="presentation" href="#"><i class="fa fa-power-off fa-fw"></i>Logout </a></div>
        </li>
        </ul>
        <ul class="nav navbar-nav" id="mobile-nav">
            <li class="nav-item" role="presentation"><a class="nav-link" href="index.html" style="color: rgb(236,240,241);"><i class="fa fa-home fa-fw"></i> Home</a></li>
            <li class="nav-item" role="presentation"><a class="nav-link" href="index.html" style="color: rgb(236,240,241);"><i class="fa fa-star fa-fw"></i> Nav Item</a></li>
            <li class="nav-item dropdown"><a class="dropdown-toggle nav-link" data-toggle="dropdown" aria-expanded="false" href="#" style="color: rgb(236,240,241);"><i class="fa fa-star fa-fw"></i> Dropdown </a>
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
    <div class="text-center profile-card" style="margin:15px;background-color:#ffffff;">
        <div class="profile-card-img" style="background-image:url(&quot;iceland.jpg&quot;);height:150px;background-size:cover;"><button class="btn btn-primary" type="button" style="margin-top: 62px;margin-right: -260px;background-color: transparent;width: 43px;height: 43px;"><i class="fa fa-pencil" style="color: rgb(0,0,0);width: 46px;height: 39px;font-size: 25px;margin-top: 2px;margin-right: 1px;margin-left: -12px;"></i></button></div>
        <div><img class="rounded-circle" style="margin-top:-70px;" src="assets/img/avatar-dhg.png" height="150px">
            <h3>{{ $user->getFirstname() }}{{ $user->getLastname() }}</h3>
            <p style="padding:20px;padding-bottom:0;padding-top:5px;">{{ $user->getBio() }}</p>
        </div>
        <div class="row" style="padding:0;padding-bottom:10px;padding-top:20px;">
            <div class="col-md-6">
                <p class="text-nowrap text-right">Username :</p>
                <p class="text-nowrap text-right">Email :</p>
                <p class="text-nowrap text-right">Birthday :</p>
                <p class="text-nowrap text-right">City :</p>
                <p class="text-nowrap text-right">State :</p>
            </div>
            <div class="col-md-6">
                <p class="text-left">{{ $user->getUsername() }}</p>
                <p class="text-left">{{ $user->getEmail() }}</p>
                <p class="text-left">{{ $user->getDate() }}</p>
                <p class="text-left">{{ $user->getCIty() }}</p>
                <p class="text-left">A{{ $user->getState() }}</p>
            </div>
        </div>
    </div>
  
</body>
@endsection