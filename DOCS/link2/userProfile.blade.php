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
    
    <div class="text-center profile-card" style="margin:15px;background-color:#ffffff;">
        <div class="profile-card-img" style="background-image:url(&quot;iceland.jpg&quot;);height:150px;background-size:cover;"><button class="btn btn-primary" type="button" style="margin-top: 62px;margin-right: -260px;background-color: transparent;width: 43px;height: 43px;"><i class="fa fa-pencil" style="color: rgb(0,0,0);width: 46px;height: 39px;font-size: 25px;margin-top: 2px;margin-right: 1px;margin-left: -12px;"></i></button></div>
        <div><img class="rounded-circle" style="margin-top:-70px;" src="assets/img/avatar-dhg.png" height="150px">
            <h3>{{ $user->getFirstname() }}{{ $user->getLastname() }}</h3>
            <p style="padding:20px;padding-bottom:0;padding-top:5px;">{{ $user->getTagline() }}</p>
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
                <p class="text-left">{{ $user->getBirthday() }}</p>
                <p class="text-left">{{ $user->getCity() }}</p>
                <p class="text-left">A{{ $user->getState() }}</p>
            </div>
        </div>
    </div>

@endsection