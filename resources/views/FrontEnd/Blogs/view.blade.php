@extends('layouts.frontend_layouts.frontend')
@section('title', 'View Blog')
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
            <div class="row">
                <div class="col-lg-12">
                    @if($blog)
                        <div class="card-custom my-3">
                            <div class="row">
                                <div class="col-lg-12">
                                    <small>{{$blog->category && $blog->category->category_name !='' ? $blog->category->category_name : "Uncategorized"}} - {{date("M d, Y", strtotime($blog->created_at))}}</small>
                                </div>
                                <div class="col-lg-12 mt-3">
                                    <h2><i>{{$blog->title}}</i></h2>
                                    <small>{{__('index.Updated')}}: {{date("M d, Y", strtotime($blog->updated_at))}}</small>
                                </div>
                                <div class="col-lg-12 mt-2">
                                <div class="post_image_single text-center">
                                    <a @if($blog->image_link != '') target="_blank" href="{{$blog->image_link}}" @endif>
                                        @if($blog->blog_picture != "")
                                        <img src="{{URL::asset('blogs/resized')}}/{{$blog->blog_picture}}">
                                        @else
                                        <img src="{{URL::asset('admin/assets/img/thumbnail-default_2.jpg')}}">
                                        @endif
                                    </a>
                                </div>
                                </div>
                                <div class="col-lg-12 mt-3">
                                    <div class="content-blog">
                                        {!!$blog->blog_content!!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </section>
		

@endsection