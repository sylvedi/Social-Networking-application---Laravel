@extends('layouts.app') @section('title', 'Admin Page')

@section('content')

<div id="wrapper" style="background-color: #ecf0f1;">
	<div class="d-flex flex-column" id="content-wrapper">
		<div id="content">
			<div class="container-fluid">
				<h3 class="text-dark mb-4">Admin</h3>

				<div class="card shadow">

					<div>
						<ul class="nav nav-tabs">
							<li class="nav-item active"><a data-toggle="tab" href="#users"
								class="nav-link">Users</a></li>
							<li class="nav-item"><a data-toggle="tab" href="#jobs"
								class="nav-link">Jobs</a></li>
						</ul>

					</div>

					<div class="tab-content">
						<div id="users" class="tab-pane fade in active">
							@include('usersList')
						</div>
						<div id="jobs" class="tab-pane fade">
							@include('jobPostList')
						</div>
					</div>
				</div>

			</div>
		</div>
	</div>
	<a class="border rounded d-inline scroll-to-top" href="#page-top"></a>
</div>

@endsection
