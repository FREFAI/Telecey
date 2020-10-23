@extends('layouts.admin_layouts.admin_dashboard')
@section('title', 'Admin | Add Color')
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
                <div class="col-md-6">
                   <h5 class="heading-small text-muted mb-4">Add Terms & Conditions</h5>
                 </div>
                 <div class="col-md-6 text-right">
                   <a href="{{ url()->previous() }}" class="btn btn-sm btn-primary"><i class="ni ni-bold-left"></i> &nbsp;Back</a>
                 </div>
                
                <div class="col-lg-12">
                @include('flash-message')
                  <form action="{{ url('/admin/terms-conditions') }}" method="post" enctype="multipart/form-data" id="termsCondition">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <textarea required="" class="from-control text_editor" id="first-test" name="terms_condition">{{$setting->terms_and_conditions}}</textarea>
                                <span class="error error-terms d-none">Terms and condition are mandatory.</span>
                            </div>
                        </div>  
                      <div class="col-md-12">
                        <div class="form-group">
                          <button class="btn btn-primary submitTerms" type="button">Save</button>
                        </div>
                      </div>
                    </div>
                  </form>
                </div>
    		    	</div>
		    </div>
		</div>
    <!-- Footer Section Include -->
        @include('layouts.admin_layouts.footer')
    <!-- End Footer Section Include -->
  </div>
</div>
@endsection
@section('pageStyle')
  <style>
    .error{
      color:#f00;
    }
  </style>
@endsection
@section('pageScript')
  <script>
    $(document).on('click','.submitTerms',function(e){
      e.preventDefault();
      if(tinymce.get('first-test').getContent() != ""){
        $('.error-terms').addClass('d-none');
        $("#termsCondition").submit();
      }else{
        $('.error-terms').removeClass('d-none');
      }
      
    });
  </script>
@endsection
