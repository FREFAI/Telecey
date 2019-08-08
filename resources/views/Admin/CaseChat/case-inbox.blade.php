	@extends('layouts.admin_layouts.admin_dashboard')
@section('title', 'Admin | Cases list')
@section('content')

<!-- Main content -->
<div class="main-content">
  @include('layouts.admin_layouts.top_navbar')
 <!-- Header -->
  <div class="header bg-gradient-primary pb-1 pt-5 pt-md-8">
    <div class="container-fluid">
      <div class="header-body">
        <!-- Card stats -->
        <div class="row">
        </div>
      </div>
    </div>
  </div>
  <!-- Page content -->
  	<div class="container-fluid mt--5">
	    <div class="row">
	    	<div class="col-xl-12 mb-5 mb-xl-0">
		        <div class="card shadow">
		          	<div class="card-header bg-transparent">
				    	<div class="row">
				            <!-- <div class="col-md-12">
				               <h5 class="heading-small text-muted mb-4">{{$case->subject}}</h5>
				         	</div> -->
				  			<div class="col-lg-12">
           	    	        	<div class="mesgs">
           	    	        		<div class="heading_case pt-2">
           		    	        		<h4><i class="fas fa-comment"></i> {{$case->subject}}</h4>
           		    	        		<div class="close_btn">
           			    	        		<a href="{{url('/admin/messages')}}" class="float-right"><i class="fa fa-times"></i></a>
           			    	        	</div>
           		    	        	</div>
           	        	          	<div class="msg_history pt-3">
           	        	          		@foreach($caseMessages as $chat)
           		        	          		@if($chat->receiver_id == 0)
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
           		        	            	<form id="chatForm" action="{{url('/admin/sendMessage')}}" method="post">
           		        	            		@csrf
           			        	              	<input name="message" type="text" class="write_msg" placeholder="Type a message" required="" />
           			        	              	<input name="case_id" type="hidden" value="{{base64_encode($case->id)}}" />
           			        	              	<input name="user_id" type="hidden" value="{{base64_encode($case->user_id)}}" />
           				        	            <button class="msg_send_btn" type="submit"><i class="ni ni-send" aria-hidden="true"></i></button>
           			        	            </form>
           		        	            </div>
           	        	          	</div>
                                  @endif
           	        	        </div>
				            </div>
				    	</div>
			    	</div>
				</div>
			    <!-- Footer Section Include -->
			        @include('layouts.admin_layouts.footer')
			    <!-- End Footer Section Include -->
		  	</div>
		</div>
	</div>
</div>
<script src="{{URL::asset('admin/assets/vendor/jquery/dist/jquery.min.js')}}"></script>
<script type="text/javascript">
	$('.msg_history').scrollTop($('.msg_history')[0].scrollHeight);
</script>
@endsection