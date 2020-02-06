@extends('layouts.app')

@section('styles')

<style>p{ color: gray; }</style>

@endsection

@section('content')

<div class="text-center profile-card"
	style="margin: 15px; background-color: #ffffff;">
	<div class="profile-card-img"
		style="background-image: url(&amp;quot;iceland.jpg&amp;quot;); height: 150px; background-size: cover;">
		<a href="{{ route('editprofile', ['id'=>$user->getId()]) }}" class="btn btn-primary" type="button"
			style="margin-top: 62px; margin-right: -260px; background-color: transparent; width: 43px; height: 43px;">
			<i class="fa fa-pencil"
				style="color: rgb(0, 0, 0); width: 46px; height: 39px; font-size: 25px; margin-top: 2px; margin-right: 1px; margin-left: -12px;"></i>
		</a>
	</div>
	<div>
		<img class="rounded-circle" style="margin-top: -70px;"
			src="assets/img/avatar-dhg.png" height="150px">
		<h3 style="color:#555;">{{ $user->getFirstname() }} {{ $user->getLastname() }}</h3>
		<p style="padding: 20px; padding-bottom: 0; padding-top: 5px;">{{
			$user->getTagline() }}</p>
	</div>
	<div class="row"
		style="padding: 0; padding-bottom: 10px; padding-top: 20px;">
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
			<p class="text-left">{{ $user->getState() }}</p>
		</div>
	</div>
</div>

@endsection
