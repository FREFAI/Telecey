@extends('layouts.frontend_layouts.frontend')
@section('title', 'Edit Blog')
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
            <div class="row second-step align-items-center text-center">
                <div class="col-lg-12">
                    <div class="add-blog-title">
                        <h1>Edit Blog</h1>
                        <hr>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    @if($blog)
                        @include('flash-message')
                        <form class="" action="{{url('/edit-blog')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row mt-1">
                                <div class="col-lg-6 ">
                                    <h5>Title</h5>
                                    <div class="form-group">
                                        <input value="{{$blog->title}}" type="text" class="form-control input-css" name="title" placeholder="Title" required id="title">    
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <h5>Category</h5>
                                    <div class="form-group">
                                        <select required="" name="category_id" class="form-control input-css" value="{{old('category_id')}}">
                                            @if($categories)
                                                @foreach($categories as $category)
                                                <option value="{{$category->id}}" @if($category->id == $blog->category_id) selected @endif>{{$category->category_name}}</option>
                                                @endforeach
                                            @else
                                            <option value="" disabled>Not found</option>
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <textarea class="from-control text_editor" id="first-test" name="blog_content">{{$blog->blog_content}}</textarea>
                                    </div>
                                </div>
                                <div class="col-lg-12 mb-4">
                                    <div class="blog_image">
                                        <div class="avatar-upload">
                                            <div class="avatar-edit">
                                                <input type='file' id="imageUpload" accept=".png, .jpg, .jpeg" name="blog_picture" data-size="{{$setting ? number_format($setting->blog_image_limit) : 10}}"/>
                                                <label for="imageUpload"><i class="fas fa-edit"></i></label>
                                            </div>
                                            <div class="avatar-preview">
                                                @if($blog->blog_picture_original != "")
                                                <div class="mb-2" id="imagePreview" style="background-image: url({{URL::asset('blogs/blog_original')}}/{{$blog->blog_picture_original}});">
                                                </div>
                                                @else
                                                <div class="mb-2" id="imagePreview" style="background-image: url({{URL::asset('admin/assets/img/thumbnail-default_2.jpg')}});">
                                                </div>
                                                @endif
                                                <small><strong>Max. size {{$setting ? number_format($setting->blog_image_limit) : 10}}MB</strong></small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 text-right">
                                    <div class="form-group">
                                    <input type="hidden" name="id" value="{{base64_encode($blog->id)}}">
                                    <button class="btn btn-primary" type="submit">Update</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    @endif
                </div>
            </div>
        </section>
		

@endsection