 @extends('layouts.app') @section('styles')
<link rel="stylesheet" href="{{ asset('/css/Login-Form-Clean.css') }}">
<link rel="stylesheet"
	href="{{ asset('/css/Registration-Form-with-Photo.css') }}">
@endsection @section('scripts')
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
@endsection @section('content')
<div class="container">
	<div class="row" style="margin-top: 67px;">
		<div id="registerForm" class="col"
			style="width: 563px; height: 675px; margin: 0px; padding: 0px; padding-top: 1px; color: rgba(9, 22, 34, 0.75); background-color: #0a3d62; margin-top: 0px; margin-right: 86px; margin-left: 208px;">

			<form method="post" action="{{ route('register')}}"
				style="display: block; width: 80%; height: 315px; margin-left: 22px; padding-right: 0px;">
				{{ csrf_field() }}
				<h2 class="text-center"
					style="padding-bottom: 31px; color: rgb(246, 246, 247); padding-left: 0px; margin-top: 40px;">
					<strong>Create</strong>&nbsp;account.
				</h2>
				<div class="form-group">
					<input class="form-control" type="username" name="username"
						placeholder="Username" style="padding-left: 7px;">
				</div>
				<div class="form-group" style="padding-left: -25px;">
					<input class="form-control" type="email" name="email"
						placeholder="Email"> <input class="form-control" type="password"
						name="password" placeholder="Password"
						style="margin-top: 16px; margin-left: 0px; padding-left: 11px; padding-right: 12px;">
					<input class="form-control" type="firstname" name="firstname"
						placeholder="Firstname" style="margin-top: 16px;"> <input
						class="form-control" type="lastname" name="lastname"
						placeholder="Lastname" style="margin-top: 16px;"> <input
						class="form-control" type="city" name="city" placeholder="City"
						style="margin-top: 17px;">
				</div>
				<div class="form-group">
					<input class="form-control" type="state" name="state"
						placeholder="state">
				</div>
				<div class="form-group">
					<div class="form-check">
						<label class="form-check-label"><input class="form-check-input"
							type="checkbox">I agree to the license terms.</label>
					</div>
				</div>
				<div class="form-group">
					<button class="btn btn-primary btn-block" type="submit"
						style="width: 155px; margin-left: 42px; background-color: rgb(16, 70, 128);">Sign
						Up</button>
				</div>
				<a class="already" onClick="toggleRegistration()" href="#"
					style="padding: 0px; padding-left: 43px; font-size: 9px; margin-left: -15px;">You
					already have an account? Login here.</a>
			</form>

		</div>
		<div id="loginForm" class="col"
			style="display: none; height: 439px; background-color: rgb(10, 61, 98); width: 0px; padding: 0px; padding-right: 13px; padding-left: 0px; margin-left: 59px; margin-right: 221px;">

			<form method="post" action="{{ route('login')}}"
				style="margin: 117px; padding: 0px; padding-top: 10px; height: 390px; margin-top: 36px; color: rgb(246, 246, 247); width: 80%; margin-left: 30px; margin-right: 28px;">
				{{ csrf_field() }}
				<h2 class="sr-only">Login Form</h2>
				<h2 class="text-center" style="margin-top: 3px; height: 62px;">
					<strong>Sign-in</strong>
				</h2>
				<div class="illustration"></div>
				<div class="form-group">
					<input class="form-control" type="text" name="username"
						placeholder="Email">
				</div>
				<div class="form-group">
					<input class="form-control" type="password" name="password"
						placeholder="Password">
				</div>
				<div class="form-group">
					<button class="btn btn-primary btn-block" type="submit"
						style="margin: 0px; width: 151px; margin-right: 0px; margin-left: 37px; background-color: rgb(16, 70, 128);">Log
						In</button>
				</div>
				<a class="forgot" href="#"
					style="padding-left: 51px; font-size: 11px; margin-left: -13px;">Forgot
					your email or password?</a><br> <a class="already"
					onClick="toggleRegistration()" href="#"
					style="padding: 0px; padding-left: 43px; font-size: 9px; margin-left: -15px;">Sign
					up for an account.</a>
			</form>
		</div>
	</div>
</div>

@endsection
