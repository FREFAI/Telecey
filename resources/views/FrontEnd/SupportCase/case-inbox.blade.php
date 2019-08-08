@extends('layouts.frontend_layouts.frontend')
@section('title', 'Case inbox')
@section('content')
<style type="text/css">
	.page-header:before {
	    background: #fff;
	}
	.contact-form .input-text {
	    height: 100%;
	}
	.page-header {
	    padding: 140px 0 25px;
	}

</style>
<!-- Content Start Here -->
	<div class="page-header inner-page h-100">
	    <div class="container">
	    	<div class="row align-items-center">
	    	    <div class="col-12">
    	        	<div class="mesgs">
    	        		<div class="heading_case pt-2">
	    	        		<h4><i class="fas fa-comment"></i> {{$case->subject}}</h4>
	    	        		<div class="close_btn">
		    	        		<a href="{{url('/contact-us')}}" class="float-right"><i class="fa fa-times"></i></a>
		    	        	</div>
	    	        	</div>
        	          	<div class="msg_history pt-3">
        	          		@foreach($caseMessages as $chat)
	        	          		@if($chat->sender_id == 0)
		        	            <div class="incoming_msg">
		        	              	<div class="received_msg">
			        	                <div class="received_withd_msg">
			        	                  <p>{{$chat->message}}</p>
			        	                  <span class="time_date"> {{ date('h:i A | M d',strtotime($chat->created_at)) }}</span>
			        	              	</div>
	        	              		</div>
		        	            </div>
		        	            @else
		        	            <div class="outgoing_msg">
		        	              <div class="sent_msg">
		        	                <p>{{$chat->message}}</p>
		        	                <span class="time_date"> {{ date('h:i A | M d',strtotime($chat->created_at)) }}</span> </div>
		        	            </div>
		        	            @endif
	        	            @endforeach
        	          	</div>
        	          	@if($case->status != 2)
        	          	<div class="type_msg">
	        	            <div class="input_msg_write">
	        	            	<form id="chatForm" action="{{url('/sendMessage')}}" method="post">
	        	            		@csrf
		        	              	<input name="message" type="text" class="write_msg" placeholder="Type a message" required="" />
		        	              	<input name="case_id" type="hidden" value="{{base64_encode($case->id)}}" />
			        	            <button class="msg_send_btn" type="submit"><i class="fa fa-paper-plane-o" aria-hidden="true"></i></button>
		        	            </form>
	        	            </div>
        	          	</div>
        	          	@endif
        	        </div>
	    	    </div>
	    	</div>
	    </div>
	</div>
<!-- Content End Here -->
<script src="{{URL::asset('admin/assets/vendor/jquery/dist/jquery.min.js')}}"></script>
<script type="text/javascript">
	$('.msg_history').scrollTop($('.msg_history')[0].scrollHeight);
</script>
@endsection