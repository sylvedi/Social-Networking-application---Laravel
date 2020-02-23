@extends('layouts.app') @section('styles')

<style>
p {
	color: gray;
}

.editlink {
	display: none;
}

.editable:hover .editlink {
	display: inline;
}
</style>

@endsection @section('content')

<div class="text-center profile-card"
	style="margin: 15px; background-color: #ffffff;">
	<div class="profile-card-img"
		style="background-image: url(&amp;quot;iceland.jpg&amp;quot;); height: 150px; background-size: cover;">

		@if(session('LoggedIn')) @if(session('UserID') == $user->getId()) <a
			href="{{ route('editprofile', ['id'=>$user->getId()]) }}"
			class="btn btn-primary" type="button"
			style="margin-top: 62px; margin-right: -260px; background-color: transparent; width: 43px; height: 43px;">
			<i class="fa fa-pencil"
			style="color: rgb(0, 0, 0); width: 46px; height: 39px; font-size: 25px; margin-top: 2px; margin-right: 1px; margin-left: -12px;">
		</i>
		</a> @endif @endif

	</div>
	<div>
		<!-- <img class="rounded-circle" style="margin-top:-70px;" src="assets/img/avatar-dhg.png" height="150px">  -->
		<h3 style="color: #555;">{{ $user->getFirstname() }} {{
			$user->getLastname() }}</h3>
		<p style="padding: 20px; padding-bottom: 0; padding-top: 5px;">{{
			$user->getTagline() }}</p>

		@if(session('LoggedIn'))
			@if(session('UserID') == $user->getId())
				<div>
					<a class="btn btn-primary" href="{{ route('addprofileeducation', ['id'=>$user->getId()]) }}">Add Education</a>
					<a class="btn btn-primary" href="{{ route('addprofileskill', ['id'=>$user->getId()]) }}">Add Skill</a>
					<a class="btn btn-primary" href="{{ route('addprofileexperience', ['id'=>$user->getId()]) }}">Add Experience</a>
				</div>
			@endif
		@endif

		<div class="row">
			<div class="col">
				@foreach ($education as $e)
				<p style="font-size: 26px;" class="editable">
					{{ $e->getDescription() }} <span
						style="color: gray; font-size: 12pt;">{{ $e->getSchool() }}</span>
					@if(session('LoggedIn')) @if(session('UserID') == $user->getId()) <span
						class="editlink"> <a class="btn btn-primary"
						href="{{ route('editprofileeducation', ['id'=>$e->getId()]) }}">Edit</a>
						<a class="btn btn-primary"
						href="{{ route('deleteEducation', ['id'=>$e->getId()]) }}">Delete</a>
					</span> @endif @endif
				</p>
				@endforeach

				<!-- 
                    <div class="btn-group" style="width: 1109px;">
                    <button class="btn btn-primary" type="button" style="margin-left: 989px;margin-top: -53px;margin-bottom: 48px;background-color: rgb(33,58,123);">More...</button>
                    <button class="btn btn-primary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-expanded="false" type="button" style="margin-top: -53px;margin-bottom: 48px;background-color: rgb(33,58,123);">
                    </button>
                        <div class="dropdown-menu" role="menu"><a class="dropdown-item" role="presentation" href="#">First Item</a>
                        <a class="dropdown-item" role="presentation" href="#">Second Item</a><a class="dropdown-item" role="presentation" href="#">Third Item</a>
                        </div>
                    </div>
                     -->

				@foreach ($skills as $s)
				<p style="font-size: 19px;" class="editable">
					{{ $s->getDescription() }} <span
						style="color: gray; font-size: 12pt;">({{ $s->getYears() }} Years)</span>
					@if(session('LoggedIn')) @if(session('UserID') == $user->getId()) <span
						class="editlink"> <a class="btn btn-primary"
						href="{{ route('editprofileskill', ['id'=>$s->getId()]) }}">Edit</a>
						<a class="btn btn-primary"
						href="{{ route('deleteSkill', ['id'=>$s->getId()]) }}">Delete</a>
					</span> @endif @endif
				</p>

				@endforeach


			</div>
		</div>
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
			<p class="text-left">{{ ($user->getBirthday() != null ?
				$user->getBirthday() : "N/A") }}</p>
			<p class="text-left">{{ $user->getCity() }}</p>
			<p class="text-left">{{ $user->getState() }}</p>
		</div>
	</div>

	<div style="width: 128px; background-color: #213a7b; height: 32px;">
		<h1
			style="margin-left: 0; font-size: 22px; font-family: ABeeZee, sans-serif; color: rgb(251, 251, 251); background-color: rgb(33, 58, 123);">Experience</h1>

		@foreach ($experience as $e)
		<div class="row"
			style="background-color: #e1e1e4; width: 676px; margin-right: 0px; margin-top: 22px; height: 109px; margin-bottom: 27px; margin-left: -2px;">
			<div class="col-10 editable" style="height: 111px;">
				<p
					style="font-size: 31px; width: 687px; margin-top: 1px; margin-left: -56px;">{{
					$e->getJobtitle() }}&nbsp;</p>
				<p style="margin-top: -23px; margin-left: 32px;">
					{{ $e->getCompany() }}<br>
				</p>
				<p style="margin-top: -18px; margin-left: 32px;">{{
					$e->getStartdate() }} - {{ ($e->getCurrentjob() || $e->getEnddate()
					== null) ? "Present" : $e->getEnddate() }}</p>
					<p style="margin-top: -18px; margin-left: 32px;">{{
					$e->getDescription() }}</p>
					
					@if(session('LoggedIn')) @if(session('UserID') == $user->getId()) <span
						class="editlink" style="float:right; margin-top:-20px;"> <a class="btn btn-primary"
						href="{{ route('editprofileexperience', ['id'=>$e->getId()]) }}">Edit</a>
						<a class="btn btn-primary"
						href="{{ route('deleteExperience', ['id'=>$e->getId()]) }}">Delete</a>
					</span> @endif @endif
			</div>
		</div>
		@endforeach

	</div>

</div>

@endsection
