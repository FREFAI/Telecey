@extends('layouts.frontend_layouts.frontend')
@section('title', 'Our Blog List')
@section('content')
    <style>
        /*Image preview*/

        .blog_image .avatar-upload {
            position: relative;
            max-width: 205px;
        }
        .blog_image .avatar-upload .avatar-edit {
            position: absolute;
            right: 12px;
            z-index: 1;
            top: 0px;
        }
        .blog_image .avatar-upload .avatar-edit input {
            display: none;
        }
        .blog_image .avatar-upload .avatar-edit input + label {
            display: inline-block;
            width: 34px;
            height: 34px;
            margin-bottom: 0;
            background: #ffffff;
            border: 1px solid transparent;
            box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.12);
            cursor: pointer;
            font-weight: normal;
            transition: all 0.2s ease-in-out;
        }
        .blog_image .avatar-upload .avatar-edit input + label:hover {
            background: #f1f1f1;
            border-color: #d6d6d6;
        }
        .blog_image .avatar-upload .avatar-edit input + label i {
            
            color: #757575;
            position: absolute;
            top: 7px;
            left: 3px;
            right: 0;
            text-align: center;
            margin: auto;
        }
        .blog_image .avatar-upload .avatar-preview {
            width: 192px;
            height: 192px;
            position: relative;
            border: 6px solid #f8f8f8;
            box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.1);
        }
        .blog_image .avatar-upload .avatar-preview > div {
            width: 100%;
            height: 100%;
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
        }
    </style>
	<!-- Content Start Here -->
		<div class="inner-page start-page" style="background: url({{URL::asset('frontend/assets/img/bg-1.jpeg')}});">
		    <div class="container-fluid">
		       
		    </div>
        </div>
        <section class="container review-container">
            <div class="row second-step align-items-center">
                <div class="col-lg-6 col-6">
                    <div class="add-blog-title">
                        <h1>{{__('index.Blog List')}}</h1>
                    </div>
                </div>
                <div class="col-lg-6 col-6">
                    <div class="add-blog-title text-right">
                       <a href="{{url('/add-blog')}}" class="common-btn"><i class="fa fa-plus"></i> {{__('index.Add Blog')}}</a>
                    </div>
                </div>

                <hr>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    @include('flash-message')
                    <div class="table-responsive">
                        <table class="table align-items-center">
                            <thead class="thead-light">
                                <tr>
                                <th scope="col" style="width: 10px;">{{__('index.Sr.No')}}</th>
                                <th scope="col" class="text-center" style="width: 130px;"><i class="ni ni-image"></i></th>
                                <th scope="col" class="text-center">{{__('index.Title')}}</th>
                                <th scope="col" class="text-center">{{__('index.Date')}}</th>
                                <th scope="col" class="text-center">{{__('index.Status')}}</th>
                                <th scope="col" class="text-right" style="width: 200px;">{{__('index.Action')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(count($blogs) > 0)
                                @php
                                    $i = ($blogs->currentpage()-1)* $blogs->perpage() + 1;
                                @endphp
                                    @foreach($blogs as $blog)
                                    <tr>
                                        <td class="text-center" style="max-width: 10px;">
                                            {{$i++}}
                                        </td>
                                        <th scope="row" class="text-center">
                                                <div class="media align-items-center">
                                                    <a href="#" class="avatar rounded-circle mr-3">
                                                    @if($blog->blog_picture != "")
                                                    <img alt="{{$blog->blog_picture}}" src="{{URL::asset('blogs/resized')}}/{{$blog->blog_picture}}" >
                                                    @else
                                                    <img alt="{{$blog->blog_picture}}" src="{{URL::asset('admin/assets/img/thumbnail-default_2.jpg')}}" >
                                                    @endif
                                                    </a>
                                                </div>
                                            </th>
                                            <td class="text-center">
                                            <div class="media-body">
                                                <span class="mb-0 text-sm">{{$blog->title}}</span>
                                            </div>
                                            </td>
                                            <td class="text-center">
                                            <div class="media-body">
                                                <span class="mb-0 text-sm">{{date("M d, Y", strtotime($blog->created_at))}}</span>
                                            </div>
                                            </td>
                                            <td  class="text-center">
                                            <span class="badge badge-dot mr-4">
                                                @if($blog->status == 1)
                                                <span class="d-none not_ap_ms"><i class="bg-danger"></i> {{__('index.Not approved')}}</span>
                                                <span class="approved_ms"><i class="bg-success"></i> {{__('index.Approved')}}</span>
                                                @else
                                                <span class="not_ap_ms"><i class="bg-danger"></i> {{__('index.Not approved')}}</span>
                                                <span class="d-none approved_ms"><i class="bg-success"></i> {{__('index.Approved')}}</span>
                                                @endif
                                            </span>
                                            </td>
                                        <td class="text-right">
                                            <div class="action-btns">
                                                <a class="common-btn text-center mr-2" href="{{url('/single-blog')}}/{{base64_encode($blog->id)}}" data-toggle="tooltip" data-placement="top" title="{{__('index.View')}}">
                                                <i class="fas fa-eye"></i>
                                                </a>
                                                <a class="common-btn text-center mr-2" href="{{url('/edit-blog')}}/{{base64_encode($blog->id)}}" data-toggle="tooltip" data-placement="top" title="{{__('index.Edit')}}">
                                                <i class="fas fa-edit"></i>
                                                </a>
                                                <a href="javascript:void(0)" class="common-btn text-center delete_blog" type="button" data-blog_id="{{$blog->id}}" data-toggle="tooltip" data-placement="top" title="{{__('index.Delete')}}">
                                                <i class="fas fa-trash"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                @else
                                    <tr>
                                    <th colspan="5">
                                        <div class="media-body text-center">
                                            <span class="mb-0 text-sm">{{__('common.notfound')}}</span>
                                        </div>
                                    </th>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                    <div class="blog_pagination pb-3">
                        {{$blogs->appends(request()->except('page'))->links()}}
                    </div>
                </div>
            </div>
        </section>
		

@endsection