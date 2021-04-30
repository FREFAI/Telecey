@extends('layouts.frontend_layouts.frontend')
@section('title', 'Devices')
@section('content')
<style type="text/css">
	.page-header:before {
	    background: #fff;
	}
	.contact-form .input-text {
	    height: 100%;
	}
	.back-button{
		max-width: 800px;
    	margin: 10px auto;
	}
</style>
<!-- Content Start Here -->
	<div class="page-header inner-page h-100">
	    <div class="container">
	        <div class="row">
	            <div class="col-12 text-center">
	                <div class="support-case-form">
	                	<div class="step-section-one">
							<div class="back-button text-left mb-5" style="max-width: 800px; margin: 10px auto;">
								<a onclick="window.history.back()" type="button" href="javascript:void(0);" class="back-btn-device mt-3 common-btn"><i class="fas fa-angle-left"></i> {{__('index.Back')}}</a>
							</div>
	                	    <!-- <img src="assets/img/step-1.png">
	                	    <h2 class="pt-3 text-white">1</h2>
	                	    <h3 class="pt-3 custom-height-cl">PLEASE INTRODUCE YOUR SELF</h3> -->
							@include('flash-message')
	                	    <section class="get-in-touch">
	                	        <p class="title pt-3">{{__('contactus.title')}}</p>
	                	        <form id="caseGenerateForm" class="contact-form row" action="{{url('/generateCase')}}" method="post">
	                	        	@csrf
	                	            <div class="form-field col-lg-12">
	                	                <input id="subject" class="input-text js-input" type="text" required name="subject" placeholder="{{__('contactus.subject')}}">
	                	            </div>
	                	            <div class="form-field col-lg-12">
	                	                <textarea rows="4" id="message" class="input-text js-input" type="text" required name="message" placeholder="{{__('contactus.message')}}"></textarea>
	                	            </div>
	                	            
	                	            <div class="form-field col-lg-12">
	                	                <input class="submit-btn" type="submit" value="{{__('contactus.button')}}">
	                	            </div>
	                	        </form>
	                	    </section>
	                	</div>
	                </div>
	            </div>
	        </div>
	    </div>
	</div>
	<section>
		<div class="container">
	        <div class="row mb-5 mt-5">
	            <div class="col-md-12 text-center">
	                <div class="heading mb-0">
	                    <h1 class="">{{__('contactus.case_heading')}}</h1>
	                </div>
	            </div>
	        </div>
	        <div class="row">
	            <div class="col-12 text-center">
	                <div class="support-case-table table-responsive">
	                	<table class="table table-hover">
	                	    <thead>
	                	      <tr>
	                	      	<th>{{__('contactus.srno')}}</th>
	                	        <th class="text-left">{{__('contactus.subject')}}</th>
	                	        <th>{{__('contactus.status')}}</th>
	                	        <th>{{__('contactus.date')}}</th>
	                	      </tr>
	                	    </thead>
	                	    <tbody>
	                	    	@if(count($allCases)>0)
	                	    	@php
		                           $i = ($allCases->currentpage()-1)* $allCases->perpage() + 1;
		                       	@endphp
	                	    		@foreach($allCases as $case)
	                	      	<tr>
	                	      		<td>{{$i++}}</td>
	                	        	<td class="text-left"><a href="{{url('/inbox')}}/{{base64_encode($case->id)}}">{{$case->subject}}</a></td>
		                	        <td>
		                	        	@if($case->status == 0)
		                	        		Open
		                	        	@elseif($case->status == 1)
		                	        		Answered
		                	        	@else
		                	        		Closed
		                	        	@endif
		                	        </td>
		                	        <td>{{ date('d, M Y', strtotime($case->created_at)) }}</td>
	                	      	</tr>
	                	      		@endforeach
	                	      	@else
	                	      	<tr>
		                         	<th colspan="4">
			                           	<div class="media-body text-center">
			                               	<span class="mb-0 text-sm">{{__('common.notfound')}}.</span>
			                           	</div>
		                         	</th>
		                       	</tr>
	                	      	@endif
	                	    </tbody>
	            	  	</table>
	                </div>
	                <div class="ads_pagination mt-3 mb-0">
	                 {{$allCases->links()}}
	               </div>
	            </div>
	        </div>
	    </div>
	</section>
<!-- Content End Here -->

@endsection