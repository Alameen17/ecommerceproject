@extends('layouts.app')

@section('content')

 @foreach($posts as $row)
<div class="single_post">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 offset-lg-2">
					<div class="single_post_title">
						{{ $row->post_title }}
					 </div>

					<div class="single_post_text">
						<p>{!! $row->details !!}</p>
					</div>
				</div>
			</div>
		</div>
	</div>

	@endforeach




@endsection