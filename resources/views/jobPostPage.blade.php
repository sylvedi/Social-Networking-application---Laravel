<div class="article-list">
	<div class="container" style="margin-top: 2px;">
		<div class="intro">
			<h2 class="text-center" style="padding: 40px; color:slategrey">JOBS</h2>
		</div>
		<div class="row articles"
			style="margin-top: -29px; width: 961px; margin-left: 85px; height: 444px;">

			@foreach($jobs as $job)
			 <div class="col-sm-6">
			<div class="card">
				<div class="card-header">
					<h5 class="card-title" style="color:dimgrey">{{ $job->getTitle() }}</h5>
				</div>
				<div class="card-body">
					<p class="card-text" style="color:darkgray">{{ $job->getDescription() }}</p>
					<a href="#" class="btn btn-primary">-></a>
				</div>
			</div>
			</div>
			@endforeach
    		
		</div>
	</div>
</div>
