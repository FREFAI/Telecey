@extends('layouts.frontend_layouts.frontend')
@section('title', 'Cookie Policy')
@section('content')
<style type="text/css">
	.review-container {
	    margin-top:10px;
	    margin-bottom:10px;
	}

</style>
	<!-- Content Start Here -->
		<div class="inner-page start-page" style="background: url({{URL::asset('frontend/assets/img/bg-1.jpeg')}});">
		    <div class="container-fluid">
		       
		    </div>
        </div>
        <section class="container review-container">
            {!!$settings->cookie_policy!!}
        </section>
		

@endsection