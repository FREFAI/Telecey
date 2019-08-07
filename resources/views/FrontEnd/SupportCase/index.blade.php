@extends('layouts.frontend_layouts.frontend')
@section('title', 'Devices')
@section('content')
<style type="text/css">
	.page-header:before {
	    background: #fff;
	}
	.contact-form .input-text {
	    height: 100%;
	}
</style>
<!-- Content Start Here -->
	<div class="page-header inner-page h-100">
	    <div class="container">
	        <div class="row">
	            <div class="col-12 text-center">
	                <div class="support-case-form">
	                	<div class="step-section-one">
	                	    <!-- <img src="assets/img/step-1.png">
	                	    <h2 class="pt-3 text-white">1</h2>
	                	    <h3 class="pt-3 custom-height-cl">PLEASE INTRODUCE YOUR SELF</h3> -->
	                	    <section class="get-in-touch">
	                	        <p class="title pt-3">Support case</p>
	                	        <form class="contact-form row">
	                	            <div class="form-field col-lg-12">
	                	                <input id="firstname" class="input-text js-input" type="text" required name="firstname" placeholder="Subject">
	                	            </div>
	                	            <div class="form-field col-lg-12">
	                	                <textarea rows="4" id="lastname" class="input-text js-input" type="text" required name="lastname" placeholder="Message"></textarea>
	                	            </div>
	                	            
	                	            <div class="form-field col-lg-12">
	                	                <input class="submit-btn" type="submit" value="Submit">
	                	            </div>
	                	        </form>
	                	    </section>
	                	</div>
	                </div>
	            </div>
	        </div>
	    </div>
	</div>
	<section>
		<div class="container">
	        <div class="row mb-5 mt-5">
	            <div class="col-md-12 text-center">
	                <div class="heading mb-0">
	                    <h1 class="">Cases list</h1>
	                </div>
	            </div>
	        </div>
	        <div class="row">
	            <div class="col-12 text-center">
	                <div class="support-case-table">
	                	<table class="table table-hover">
	                	    <thead>
	                	      <tr>
	                	        <th class="text-left">Subject</th>
	                	        <th>Status</th>
	                	        <th>Date</th>
	                	      </tr>
	                	    </thead>
	                	    <tbody>
	                	      	<tr>
	                	        	<td class="text-left">At w3schools.com you will learn how to make a website.</td>
		                	        <td>Closed</td>
		                	        <td>5, July 2019</td>
	                	      	</tr>
	                	      	<tr>
	                	        	<td class="text-left">At w3schools.com you will learn how to make a website.</td>
		                	        <td>Closed</td>
		                	        <td>5, July 2019</td>
	                	      	</tr>
	                	      	<tr>
	                	        	<td class="text-left">At w3schools.com you will learn how to make a website.</td>
		                	        <td>Closed</td>
		                	        <td>5, July 2019</td>
	                	      	</tr>
	                	      	<tr>
	                	        	<td class="text-left">At w3schools.com you will learn how to make a website.</td>
		                	        <td>Closed</td>
		                	        <td>5, July 2019</td>
	                	      	</tr>
	                	      
	                	    </tbody>
	            	  	</table>
	                </div>
	            </div>
	        </div>
	    </div>
	</section>
<!-- Content End Here -->

@endsection