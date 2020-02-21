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
    <body style="background-image: url(&quot;none&quot;);background-color: #ecf0f1;">
    <nav class="navbar navbar-light navbar-expand-md" style="height: 61px;background-color: #0a3d62;">
        <div class="container-fluid">
            <div><a class="navbar-brand" href="#" style="color: rgb(236,240,241);">Connect</a><button data-toggle="collapse" class="navbar-toggler" data-target="#navcol-2"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button></div>
            <div
                class="collapse navbar-collapse" id="navcol-2" style="height: 48px;color: #ecf0f1;">
                <div class="search-container"></div>
                <ul class="nav navbar-nav ml-auto" id="desktop-toolbar">
                    <li class="nav-item" role="presentation"><a class="nav-link" href="#"></a></li>
                    <li class="nav-item dropdown"><a class="dropdown-toggle nav-link" data-toggle="dropdown" aria-expanded="false" href="#" style="color: rgb(236,240,241);"><img class="rounded-circle" src="assets/img/user-photo.jpg" width="25px" height="25px"> John <i class="fa fa-chevron-down fa-fw"></i></a>
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
    <div class="container profile profile-view" id="profile">
        <div class="row">
            <div class="col-md-12 alert-col relative">
                <div class="alert alert-info absolue center" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><span>Profile save with success</span></div>
            </div>
        </div>
        <form action="{{ route('updateUser')}}">
        {{ csrf_field() }}
            <div class="form-row profile-row">
                <div class="col-md-4 relative">
                    <div class="avatar">
                        <div class="avatar-bg center"></div>
                    </div><input type="file" class="form-control" name="avatar-file">
                    <div class="form-group" style="margin-top: 31px;height: 84px;"><label>Bio</label><input class="form-control" type="text" name="lastname" style="height: 275px;"></div>
                </div>
                <div class="col-md-8">
                    <h1>Profile </h1>
                    <hr>
                    <div class="form-row">
                        <div class="col-sm-12 col-md-6">
                            <div class="form-group"><label>Firstname </label><input class="form-control" type="text" name="firstname" value="{{$user->getFirstname()}}"></div>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <div class="form-group"><label>Lastname</label><input class="form-control" type="text" name="lastname" value="{{$user->getLastname()}}"></div>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <div class="form-group"><label>Username</label><input class="form-control" type="text" name="username" value="{{$user->getUsername()}}"></div>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <div class="form-group"><label>City</label><input class="form-control" type="text" name="city" value="{{$user->getCity()}}"></div>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <div class="form-group"><label>State</label><input class="form-control" type="text" name="state" value="{{$user->getState()}}"></div>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <div class="form-group"><label>Birthday</label></div><input class="form-control" type="date" value="{{$user->getDate()}}"style="margin-top: -17px;"></div>
                    </div>
                    <div class="form-group"><label>Email </label><input class="form-control" type="email" autocomplete="off" required="" name="email" value="{{$user->getEmail()}}"></div>
                    <div class="form-row">
                        <div class="col-sm-12 col-md-6">
                            <div class="form-group"><label>Password </label><input class="form-control" type="password" name="password" autocomplete="off" required="" value="{{$user->getPassword()}}"></div>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <div class="form-group"><label>Confirm Password</label><input class="form-control" type="password" name="confirmpass" autocomplete="off" required=""></div>
                        </div>
                    </div>
                    <hr>
                    <div class="form-row">
                        <div class="col-md-12 content-right"><button class="btn btn-primary form-btn" type="submit">SAVE </button></div>
                    </div>
                </div>
            </div>
        </form>
    </div>
   
</body>
@endsection