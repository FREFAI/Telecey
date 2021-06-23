@extends('layouts.frontend_layouts.frontend')
@section('title', 'Blogs')
@section('content')
@php
    if(!array_key_exists('search',$params)){
        $params['search'] = "";
    }
@endphp
	<!-- Content Start Here -->
		<div id="content" class="section-padding blog">
	        <div class="container mt-5">
                        <div class="row mt-4">
                            <div class="col-lg-6 col-md-6 col-4">
                                <h5>{{ __('blog.list_title') }}</h5>
                            </div>
                            <div class="col-lg-6 col-md-6 col-8">
                                <form class="form-inline float-right blog-search-form">
                                        <input value="{{$params['search']}}" name="search" type="text" placeholder="{{ __('blog.search_input') }}" class="form-control input-css">
                                        <button type="submit" class="common-btn"> {{ __('blog.search_btn') }}</button>
                                </form>
                            </div>
                        </div>
	            	@if(count($blogs) > 0)
                        @foreach($blogs as $blog)
                            <div class="row mt-4 border blog-border">
                                <div class="col-lg-6">
                                    <a @if($blog->image_link != '') target="_blank" href="{{$blog->image_link}}" @endif>
                                        <div class="blog-banner">
                                            @if($blog->blog_picture != "")
                                            <img alt="{{$blog->blog_picture}}" src="{{URL::asset('blogs/resized')}}/{{$blog->blog_picture}}" class="img-fluid">
                                            @else
                                            <img alt="{{$blog->blog_picture}}" src="{{URL::asset('admin/assets/img/thumbnail-default_2.jpg')}}" class="img-fluid">
                                            @endif
                                        </div>
                                    </a>
                                </div>
                                <div class="col-lg-6 p-4">
                                    <div class="blog-title">
                                        <h5 class="post-title"><a href="{{url('/single-blog')}}/{{base64_encode($blog->id)}}" class="text-blue">{{$blog->title}}</a></h5>
                                        <small class="meta-part"><i class="lni-alarm-clock text-blue"></i> <u>{{date("M d, Y", strtotime($blog->created_at))}}</u></small>
                                    </div>
                                    <div class="blog-discription">
                                        <p>
                                            @if(strlen(html_entity_decode(strip_tags($blog->blog_content))) > 300) 
                                                {{substr(html_entity_decode(strip_tags($blog->blog_content)),0,300)}}...
                                            @else
                                                {{substr(html_entity_decode(strip_tags($blog->blog_content)),0,300)}}
                                            @endif
                                        </p>
                                    </div>
                                    <div class="blog-button mt-3">
                                        <p>
                                            <a href="{{url('/single-blog')}}/{{base64_encode($blog->id)}}" class="searchnow-button">{{ __('blog.read_more') }}</a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
	                @else
                    <div class="row mt-5">
	                	<div class="col-12">
	                		<div class="blog-post py-3">
		                		<div class="not_found">
		                			<h2 class="text-center">{{ __('blog.not_found') }}</h2>
		                		</div>
		                	</div>
	                	</div>
                    </div>
	                @endif
	                
	            <div class="row">
	                <div class="pagination-bar">
	                    <nav>
                        {{$blogs->appends(request()->except('page'))->links()}}
	                    </nav>
	                </div>
	            </div>
	        </div>
	    </div>
	<!-- Content End Here -->
<style type="text/css">
	.page-item.active .page-link{
		background-color: #96fdd4;
		border-color: #96fdd4;
		color: #999;
	}
</style>
@endsection