<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lora:400,400i,700,700i">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=ABeeZee">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Catamaran:100,200,300,400,500,600,700,800,900">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Muli">
    <link rel="stylesheet" href="{{ asset('fonts/fontawesome-all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('fonts/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('fonts/fontawesome5-overrides.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/LinkedIn-like-Profile-Box.css') }}">
    <link rel="stylesheet" href="{{ asset('css/Navbar---App-Toolbar--LG--MD---Mobile-Nav--SM--XS-1.css') }}">
    <link rel="stylesheet" href="{{ asset('css/Navbar---App-Toolbar--LG--MD---Mobile-Nav--SM--XS.css') }}">
    <link rel="stylesheet" href="{{ asset('css/Profile-Edit-Form-1.css') }}">
    <link rel="stylesheet" href="{{ asset('css/Profile-Edit-Form.css') }}">
    <link rel="stylesheet" href="{{ asset('css/Search-Field-With-Icon.css') }}">
    
    @yield('styles')
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/current-day.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.js"></script>
    <script src="{{ asset('js/Profile-Edit-Form.js') }}"></script>
    <script src="{{ asset('js/theme.js') }}"></script>
    
    <script>
    $(document).ready(function(){
        $("#toastClose").click(function(){
            $("#alertToast").fadeOut();
        });
        setTimeout(function() {
            $('#toastClose').click();
        }, 3000);
    });
    </script>
    
    @yield('scripts')
</head>

<body style="background: linear-gradient(rgba(47, 23, 15, 0.65), rgba(47, 23, 15, 0.65)), url('img/bg.jpg');background-image: url(&quot;none&quot;);background-color: #ecf0f1;color: rgb(230,230,230);">
	
	@include('layouts.navbar')
	
	@isset($message)
	<div class="alert" id="alertToast" style="display: block; z-index: 3; padding: 20px; background-color: #f44336; color: white; margin-left: 30%; width: 40%;">
      <span class="closebtn" id="toastClose" style="cursor: pointer; margin-left: 15px; color: white; font-weight: bold; float: right; font-size: 22px; line-height: 20px; cursor: pointer; transition: 0.3s;">&times;</span>
      {{ $message }}
    </div>
	@endisset

	@yield('content')

</body>

</html>