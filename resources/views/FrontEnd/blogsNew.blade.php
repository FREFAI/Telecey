@extends('layouts.frontend_layouts.frontend')
@section('title', 'Blogs')
@section('content')

	<!-- Content Start Here -->
		<div id="content" class="section-padding blog">
	        <div class="container mt-5">
                
	            	@if(count($blogs) > 0)
                        @foreach($blogs as $blog)
                            <div class="row mt-4 border">
                                <div class="col-6">
                                    <div class="blog-banner">
                                        @if($blog->blog_picture != "")
                                        <img alt="{{$blog->blog_picture}}" src="{{URL::asset('blogs/resized')}}/{{$blog->blog_picture}}" class="img-fluid">
                                        @else
                                        <img alt="{{$blog->blog_picture}}" src="{{URL::asset('admin/assets/img/thumbnail-default_2.jpg')}}" class="img-fluid">
                                        @endif
                                    </div>
                                </div>
                                <div class="col-6 p-4">
                                    <div class="blog-title">
                                        <h5 class="post-title"><a href="javascript:void(0);" class="text-blue">{{$blog->title}}</a></h5>
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
                                            <a href="javascript:void(0)" class="searchnow-button">Read More</a>
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
		                			<h2 class="text-center">There are no posts.</h2>
		                		</div>
		                	</div>
	                	</div>
                    </div>
	                @endif
	                
	            <div class="row">
	                <div class="pagination-bar">
	                    <nav>
	                    	{{$blogs->links()}}
	                        <!-- <ul class="pagination">
	                            <li class="page-item"><a class="page-link active" href="#">1</a></li>
	                            <li class="page-item"><a class="page-link" href="#">2</a></li>
	                            <li class="page-item"><a class="page-link" href="#">3</a></li>
	                            <li class="page-item"><a class="page-link" href="#">Next</a></li>
	                        </ul> -->
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