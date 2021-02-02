@extends('layouts.admin_layouts.admin_dashboard')
@section('title', 'Admin | Feedback Question list')
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
		    	<div class="row align-items-center">
                    <div class="col-md-6">
                    <h5 class="heading-small text-muted mb-4">Feedback Question List</h5>
                    </div>
                    <div class="col-md-6 text-right  mb-4"> 
                        <a href="{{url('admin/feedbackQuestion/add')}}" class="btn  btn-primary btn-sm"><i class="ni ni-fat-add"></i> &nbsp;Add question</a>
                    </div>
                    <div class="col-lg-12">
                        @include('flash-message')
                    <div class="table-responsive">
                        <table class="table align-items-center">
                        <thead class="thead-light">
                            <tr>
                            <th scope="col" style="width: 10px;">Sr.No</th>
                            <th scope="col">Question</th>
                            <th scope="col" style="width: 10px;">Type</th>
                            <th scope="col" >Created At</th>
                            <th scope="col" class="text-center">Deleted At</th>
                            <th scope="col" class="text-right">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(count($questions)>0)
                            @php
                                $i = ($questions->currentpage()-1)* $questions->perpage() + 1;
                            @endphp
                            @foreach($questions as $question)
                                <tr>
                                    <td class="text-center" style="max-width: 10px;">
                                    {{$i++}}
                                    </td>
                                    <td class="text-left">
                                        <div class="media-body">
                                            <span class="mb-0 text-sm">{{$question->question_name}}</span>
                                        </div>
                                    </td>
                                    <td>
                                    @if($question->type == 1)
                                        Start
                                    @else
                                        Text
                                    @endif
                                    </td>
                                    <td>
                                    {{ date("m/d/Y", strtotime($question->created_at)) }}
                                    </td>
                                    <td class="text-center deleted_at">
                                    {{ $question->deleted_at ? date("m/d/Y", strtotime($question->deleted_at)) : "-"}} 
                                    </td>
                                    <td class="text-right">
                                        @if($question->deleted_at == null)
                                        <button class="btn btn-icon btn-2 btn-danger btn-sm delete_feedbackquestion" type="button" data-question_id="{{base64_encode($question->id)}}" data-toggle="tooltip" data-placement="top" title="Delete">
                                            <span class="btn-inner--icon"><i class="fas fa-trash"></i></span>
                                        </button>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            @else
                            <tr>
                                <th colspan="6">
                                <div class="media-body text-center">
                                    <span class="mb-0 text-sm">No data found.</span>
                                </div>
                                </th>
                            </tr>
                            @endif
                        </tbody>
                        </table>
                    </div>
                    <div class="ads_pagination mt-3 mb-0">
                        {{$questions->appends(request()->except('page'))->links()}}
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
@endsection
@section('pageScript')
  <script>
   $('.delete_feedbackquestion').on('click',function(){
        var question_id = $(this).attr('data-question_id');
        var delete_row = $(this);
        if(window.location.protocol == "http:"){
            resuesturl = "{{url('/admin/feedbackQuestion/delete')}}"
        }else if(window.location.protocol == "https:"){
            resuesturl = "{{secure_url('/admin/feedbackQuestion/delete')}}"
        }
        swal("Are you sure you want to delete this question?", {
            buttons: ["No", "Yes"],
        })
        .then(function(name) {
            if(name){
                $.ajax({
                    type: "post",
                    url: resuesturl,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    dataType:'json',
                    data: {
                        'id':question_id
                    },
                    success: function (data) {
                        if(data.success){
                            delete_row.closest('td').prev(".deleted_at").text(data.deleted_at);
                            toastr.success('Success', data.message , {displayDuration:3000,position: 'top-right'});
                            delete_row.remove();
                        }else{
                            toastr.error('Error', data.message , {displayDuration:3000,position: 'top-right'});
                        }
                    }         
                });
            }
        });
    });   
  </script>
@endsection