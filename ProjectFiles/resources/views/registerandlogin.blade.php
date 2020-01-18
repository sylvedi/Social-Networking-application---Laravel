<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Untitled</title>
    <link rel="stylesheet" href="{{ asset('/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700">
    <link rel="stylesheet" href="{{ asset('/fonts/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/Header-Blue.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/Login-Form-Clean.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/Registration-Form-with-Photo.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/styles.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/Team-Grid.css') }}">
    
    <script>
    function toggleRegistration(){
		var l = document.getElementById("loginForm");
		var r = document.getElementById("registerForm"); 
		if(l.style.display === "none"){ // if we are on register
			l.style.display = "block";
			r.style.display = "none";
		} else {
			l.style.display = "none";
			r.style.display = "block";
		}
    }
    </script>
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
            <div class="container hero">
                <div class="row" style="width: 564px; padding: 0px;padding-top: -49px;height: 744px;margin: 0px;margin-left: 0px;margin-right: 0px;padding-right: 0px;padding-left: 0px;">
                    <div id="loginForm" class="col" style="height: 439px;background-color: rgba(9,22,34,0.75);width: 563px;padding: 0px;padding-right: 13px;padding-left: 0px;margin-left: 0px;">
                        <form method="post" action="{{ route('login') }}" style="margin: 117px;padding: -2px;padding-top: 10px;height: 390px;margin-top: 36px;color: rgb(246,246,247);">
                        	{{ csrf_field() }}
                            <h2 class="sr-only">Login Form</h2>
                            <h2 class="text-center" style="margin-top: 3px;height: 62px;"><strong>Sign-in</strong>
                            </h2>
                            <div class="illustration"></div>
                            <div class="form-group"><input class="form-control" type="text" name="username" placeholder="Username">
                            </div>
                            <div class="form-group"><input class="form-control" type="password" name="password" placeholder="Password">
                            </div>
                            <div class="form-group"><button class="btn btn-primary btn-block" type="submit" style="margin: 0px;width: 151px;margin-right: 0px;margin-left: 67px;background-color: rgb(16,70,128);">Log In</button>
                            </div><a class="forgot" href="#" style="padding-left: 51px;">Forgot your email or password?</a>
                            <a onclick="toggleRegistration()" class="forgot" href="#" style="padding-left: 51px;">Sign up for an account</a>
                        </form>
                    </div>
                    <div id="registerForm" class="col" style="display:none; width: 563px;height: 675px;margin: 0px;padding: 0px;padding-top: 1px;color: rgba(9,22,34,0.75);background-color: #39587b;margin-top: 0px;margin-right: 0px;margin-left: 0px;">
                        <form method="post" action="{{ route('register') }}" style="width: 341px;height: 315px;margin-left: 110px;padding-right: 0px;">
                        	{{ csrf_field() }}
                            <h2 class="text-center" style="padding-bottom: 31px;color: rgb(246,246,247);padding-left: 0px;margin-top: 40px;">
                                <strong>Create</strong>&nbsp;account.</h2>
                            <div class="form-group">
                                <input class="form-control" type="username" name="username" placeholder="Username" style="padding-left: 7px;">
                            </div>
                            <div class="form-group" style="padding-left: -25px;">
                                <input class="form-control" type="email" name="email" placeholder="Email">
                                <input class="form-control" type="password" name="password" placeholder="Password" style="margin-top: 16px;margin-left: 0px;padding-left: 11px;padding-right: 12px;">
                                <input
                                    class="form-control" type="firstname" name="firstname" placeholder="First name" style="margin-top: 16px;">
                                    <input class="form-control" type="lastname" name="lastname" placeholder="Last name" style="margin-top: 16px;">
                                    <input class="form-control" type="city" name="city" placeholder="City" style="margin-top: 17px;">
                                </div>
                            <div class="form-group"><input class="form-control" type="state" name="state" placeholder="State">
                            </div>
                    <div class="form-group">
                        <div class="form-check">
                            <label class="form-check-label">
                                <input class="form-check-input" required type="checkbox">I agree to the license terms.</label>
                            </div>
                    </div>
                    <div class="form-group"><button class="btn btn-primary btn-block" type="submit" style="width: 155px;margin-left: 104px;background-color: rgb(16,70,128);">Sign Up</button>
                    </div>
                    <a onclick="toggleRegistration()" class="already" href="#" style="padding-left: 43px;">You already have an account? Login here.</a>
                </form>
                </div>
            </div>
        </div>
    </div>
    </div>
    <section style="width: 1262px;margin: 127px;padding: 0px;height: 0px;"></section>
</head>

</html>