<div class="article-list">
	<div class="container" style="margin-top: 2px;">
		<div class="intro">
			<h2 class="text-center" style="padding: 40px;">JOBS</h2>
		</div>
		<div class="row articles"
			style="margin-top: -29px; width: 961px; margin-left: 85px; height: 444px;">

    		@foreach($jobs as $job)
    			<div class="col-sm-6 col-md-4 item" style="margin-left: -4px;">
    				<div class="zoomin frame" style="width: 62%; height: 162px;">
    					<img style="width: 100%; height: 160px;" src="assets/img/desk.jpg">
    				</div>
    				<h3 class="name" style="margin-left: -137px;">{{ $job->getTitle() }}</h3>
    				<p class="description" style="width: 245px;">{{ $job->getDescription() }}</p>
    				<a class="action" href="#"><i class="fa fa-arrow-circle-right"
    					style="margin-left: -137px;"></i></a>
    			</div>
    		@endforeach
    		
		</div>
	</div>
</div>
