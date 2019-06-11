@extends('layouts.frontend_layouts.frontend')
@section('content')

	<!-- Content Start Here -->
		<div id="content" class="section-padding blog">
	        <div class="container mt-5">
	            <div class="row mt-5">
	            	@if(count($blogs) > 0)
	            		@foreach($blogs as $blog)
			                <div class="col-lg-6">
			                    <div class="blog-post blog_page">
			                        <div class="post-thumb">
			                            <a href="#"><img class="img-fluid" src="{{URL::asset('blogs/resized')}}/{{$blog->blog_picture}}" alt=""></a>
			                            <div class="hover-wrap"></div>
			                        </div>
			                        <div class="post-content">
			                            <div class="meta">
			                                <!-- <span class="meta-part"><a href="#"><i class="lni-user"></i> Clasified</a></span> -->
			                                <span class="meta-part"><a href="#"><i class="lni-alarm-clock"></i> {{date("M d, Y", strtotime($blog->created_at))}}</a></span>
			                                <!-- <span class="meta-part"><a href="#"><i class="lni-folder"></i> Sticky</a></span> -->
			                                <!-- <span class="meta-part"><a href="#"><i class="lni-comments-alt"></i> 1 Comments</a></span> -->
			                            </div>
			                            <h2 class="post-title"><a href="single-post.html">{{$blog->title}}</a></h2>
			                            <div class="entry-summary">
			                                <p>{{substr(html_entity_decode(strip_tags($blog->blog_content)),0,500)}}</p>
			                            </div>
			                            <a href="javascript:void(0)" class="btn btn-common">Read More</a>
			                        </div>
			                    </div>
			                </div>
	                	@endforeach
	                @else
	                	<div class="col-12">
	                		<div class="blog-post py-3">
		                		<div class="not_found">
		                			<h2 class="text-center">There are no posts.</h2>
		                		</div>
		                	</div>
	                	</div>
	                @endif
	                
	            </div>
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