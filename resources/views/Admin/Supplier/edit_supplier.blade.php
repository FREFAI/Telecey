@extends('layouts.admin_layouts.admin_dashboard')
@section('title', 'Admin | Edit Supplier')
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
               <h5 class="heading-small text-muted mb-4">Edit Supplier</h5>
             </div>
             <div class="col-md-6 text-right">
               <a href="{{ url('/admin/suppliers') }}" class="btn btn-sm btn-primary"><i class="ni ni-bold-left"></i> &nbsp;Back</a>
             </div>
            
            <div class="col-lg-12">
            @include('flash-message')
              @if($supplier)
                <form action="{{ url('/admin/editsupplier') }}" method="post" enctype="multipart/form-data">
                  @csrf
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <input type="hidden" name="id" value="{{base64_encode($supplier->id)}}">
                        <input type="text" maxlength="50" class="form-control" id="exampleFormControlInput1" placeholder="Supplier name" name="supplier_name" value="{{$supplier->supplier_name}}">
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="form-group">
                          <select class="form-control select2" name="country">
                            @if($countries)
                              <option value="">Select Country</option>
                              @foreach($countries as $country)
                                <option value="{{$country->name}}" @if($supplier->country == $country->name) selected @endif>{{$country->name}}</option>
                              @endforeach
                            @else
                              <option value="">Countries not found</option>
                            @endif
                          </select>
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="form-group">
                        <button class="btn btn-primary" type="submit">Update</button>
                      </div>
                    </div>
                  </div>
                </form>
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