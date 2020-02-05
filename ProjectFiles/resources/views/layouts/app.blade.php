<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700">
    <link rel="stylesheet" href="{{ asset('/fonts/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/Header-Blue.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/styles.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/Team-Grid.css') }}">
    
    @yield('styles')
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    
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

<body style="width: 27;height: 708px;max-width: 100%;">

    <div style="width: 100%;">    
        <div class="header-blue" style="width: 100;height: 1247px;">
            <nav class="navbar navbar-light navbar-expand-md navigation-clean-search">
                <div class="container-fluid">
                    <a class="navbar-brand" href="#">Company Name</a>
                    <button data-toggle="collapse" class="navbar-toggler" data-target="#navcol-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="navbar-toggler-icon"></span>
                </button>
                    <div class="collapse navbar-collapse" id="navcol-1">
                        <ul class="nav navbar-nav">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" href="#">Link</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="dropdown-toggle nav-link" data-toggle="dropdown" aria-expanded="false" href="#">Dropdown </a>
                                <div class="dropdown-menu" role="menu"><a class="dropdown-item" role="presentation" href="#">First Item</a>
                                    <a class="dropdown-item" role="presentation" href="#">Second Item</a>
                                    <a class="dropdown-item" role="presentation" href="#">Third Item</a>
                                </div>
                            </li>
                        </ul>
                        <form class="form-inline mr-auto" target="_self">
                            <div class="form-group"><label for="search-field">
                                <i class="fa fa-search"></i>
                            </label>
                                <input class="form-control search-field" type="search" id="search-field" name="search">
                            </div>
                        </form><span class="navbar-text">
                             <a class="login" href="#">Log In</a></span>
                             <a class="btn btn-light action-button" role="button" href="#">Sign Up</a>
                            </div>
                </div>
            </nav>
            
			@isset($message)
			<div class="alert" id="alertToast" style="display: block; float: left; z-index: 3; padding: 20px; background-color: #f44336; color: white; margin-left: 30%; width: 40%;">
              <span class="closebtn" id="toastClose" style="cursor: pointer; margin-left: 15px; color: white; font-weight: bold; float: right; font-size: 22px; line-height: 20px; cursor: pointer; transition: 0.3s;">&times;</span>
              {{ $message }}
            </div>
			@endisset

    		@yield('content')
    	
    	</div>
    
    </div>
    <section style="width: 1262px;margin: 127px;padding: 0px;height: 0px;"></section>
</body>

</html>