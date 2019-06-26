@extends('layouts.admin_layouts.admin_dashboard')
@section('title', 'Admin | Edit rating questions')
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
               <h5 class="heading-small text-muted mb-4">Edit rating questions</h5>
             </div>
             <div class="col-md-6 text-right">
               <a href="{{ url()->previous() }}" class="btn btn-sm btn-primary"><i class="ni ni-bold-left"></i> &nbsp;Back</a>
             </div>
            
		  			<div class="col-lg-12">
            @include('flash-message')
            @if($question)
              <form action="{{ url('/admin/edit-question') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <input type="text" maxlength="100" class="form-control" id="exampleFormControlInput1" placeholder="Question" name="question" value="{{$question->question}}">
                    </div>
                  </div>

                  <div class="col-md-12">
                    <div class="form-group">
                      <select class="form-control" name="type">
                        <option>Select type</option>
                        <option value="1" @if($question->type == 1) selected @endif>Plan</option>
                        <option value="2" @if($question->type == 2) selected @endif>Device</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <input type="hidden" name="id" value="{{$question->id}}">
                    <div class="form-group">
                      <button class="btn btn-primary" type="submit">Save</button>
                    </div>
                  </div>
                </div>
              </form>
            @else
            <div class="col-lg-12">
              <h4 class="text-center">Data Not Found.</h4>
            </div>
            @endif
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