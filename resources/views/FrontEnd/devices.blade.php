@extends('layouts.frontend_layouts.frontend')
@section('content')

	<!-- Content Start Here -->
		<div class="page-header inner-page" style="background: url(assets/img/background-img.png);">
		    <div class="container">
		        <div class="row">
		            <div class="col-12 text-center mt-5">
		                <div class="heading find-div">
		                    <h1 class="section-title">Find a Device</h1>
		                    <h4 class="sub-title">Register and share your mobile or telecom experience to unlock Telco Tales</h4>
		                    <div class="search-bar">
		                        <div class="search-inner">
		                            <form class="search-form">
		                                    <div class="form-group inputwithicon">
		                                            <div class="select">
		                                                <select>
		                                                    <option value="none">Brand</option>
		                                                    <option value="none">I Phone</option>
		                                                    <option value="none">MI</option>
		                                                    <option value="none">Nokia</option>
		                                                    <option value="none">Samsung</option>
		                                                    <option value="none">Sony</option>
		                                                    <option value="none">Phoenix</option>
		                                                </select>
		                                            </div>
		                                            <i class="lni-chevron-down"></i>
		                                        </div>
		                                <div class="form-group inputwithicon">
		                                    <div class="select">
		                                        <select>
		                                            <option value="none">Model</option>
		                                            <option value="none">Lorem</option>
		                                            <option value="none">lorem</option>
		                                            <option value="none">Lorem</option>
		                                            <option value="none">Lorem</option>
		                                            <option value="none">Lorem</option>
		                                            <option value="none">Lorem</option>
		                                        </select>
		                                    </div>
		                                    <i class="lni-chevron-down"></i>
		                                </div>
		                                <div class="form-group inputwithicon">
		                                    <div class="select">
		                                        <select>
		                                            <option value="none">Storage</option>
		                                            <option value="none">Lorem</option>
		                                            <option value="none">Lorem</option>
		                                            <option value="none">Lorem</option>
		                                        </select>
		                                    </div>
		                                    <i class="lni-chevron-down"></i>
		                                </div>
		                                <button class="btn btn-common" type="button"><i class="lni-search"></i> Search Now</button>
		                            </form>
		                        </div>
		                    </div>
		                </div>
		            </div>
		        </div>
		        <div class="row mt-4">
		            <div class="col-md-4 col-sm-4">
		                <div class="service-post">
		                    <div class="service-content">
		                        <div class="service-icon">
		                            <i class="fa fa-search"></i>
		                        </div> <!-- service-icon -->
		                        <h3 class="service-title">Find the Right Telecom Device</h3>
		                        <p class="service-description">You are searching for, wither it’s a mobile phone, smart phone, Smart tables or even home modem</p>
		                    </div> <!-- service-content -->
		                    <div class="service-hover"></div>
		                </div>
		            </div>
		            <div class="col-md-4 col-sm-4">
		                <div class="service-post">
		                    <div class="service-content">
		                        <div class="service-icon">
		                                <i class="fa fa-dollar-sign"></i>
		                        </div> <!-- service-icon -->
		                        <h3 class="service-title">Compare Device Price</h3>
		                        <p class="service-description">Searching for wither it’s a mobile phone, smart phone, Smart tables or even home modem</p>
		                    </div> <!-- service-content -->
		                    <div class="service-hover"></div>
		                </div>
		            </div>
		            <div class="col-md-4 col-sm-4">
		                <div class="service-post">
		                    <div class="service-content">
		                        <div class="service-icon">
		                                <i class="fa fa-thumbs-up"></i>
		                        </div> <!-- service-icon -->
		                        <p class="service-description">Find the right telecom device you searching for wither it’s a mobile phone, smart phone, Smart tables or even home modem</p>
		                    </div> <!-- service-content -->
		                    <div class="service-hover"></div>
		                </div>
		            </div>
		        </div>
		        <div class="row">
		            <div class="col text-center">
		                    <a href="sign-in.html" class="btn btn-common btn-find plan mt-4">Register for Free</a>
		            </div>
		        </div>
		    </div>
		</div>
		<section class="plan-device-sec">
		    <div class="container">
		        <div class="row pt-5 pb-5">
		            <div class="col text-center">
		                <div class="heading">
		                    <h1>Top Rated Devices in your Area</h1>
		                </div>
		            </div>
		        </div>
		    </div>
		</section>
		<div class="row grid-container pt-5 pb-5">
		    <div class="col-lg-4 grid-x grid-margin-x small-up-1 medium-up-2 large-up-4 grid-x-wrapper">
		        <div class="product-box column">
		            <a href="#" class="product-item">
		                <div class="product-item-image">
		                    <img src="assets/img/airpod.png" alt="Stadium Full Exterior">
		                    <div class="product-item-image-hover">
		                    </div>
		                </div>
		                <div class="product-item-content">
		                    <div class="product-item-category">
		                         Airpod
		                    </div>
		                    <div class="product-item-title">
		                        By Fariscom
		                    </div>
		                    <div class="product-item-price">
		                            Save 25% with you first purchase
		                    </div>
		                    <div class="button-pill">
		                        <span>Shop Now</span>
		                    </div>
		                </div>
		            </a>
		        </div>
		    </div>
		    <div class="col-lg-4 grid-x grid-margin-x small-up-1 medium-up-2 large-up-4 grid-x-wrapper">
		            <div class="product-box column">
		                <a href="#" class="product-item">
		                    <div class="product-item-image">
		                            <img src="assets/img/phone-case.png" alt="Stadium Full Exterior">
		                        <div class="product-item-image-hover">
		                        </div>
		                    </div>
		                    <div class="product-item-content">
		                        <div class="product-item-category">
		                                i Phone Case
		                        </div>
		                        <div class="product-item-title">
		                                By Fariscom
		                        </div>
		                        <div class="product-item-price">
		                                Extra slim cover
		                        </div>
		                        <div class="button-pill">
		                            <span>Shop Now</span>
		                        </div>
		                    </div>
		                </a>
		            </div>
		    </div>
		    <div class="col-lg-4 grid-x grid-margin-x small-up-1 medium-up-2 large-up-4 grid-x-wrapper">
		        <div class="product-box column">
		            <a href="#" class="product-item">
		                <div class="product-item-image">
		                        <img src="assets/img/sony.png" alt="Stadium Full Exterior">
		                    <div class="product-item-image-hover">
		                    </div>
		                </div>
		                <div class="product-item-content">
		                    <div class="product-item-category">
		                            By Best Buy
		                    </div>
		                    <div class="product-item-title">
		                            Sony Wirless Headphones
		                    </div>
		                    <div class="product-item-price">
		                            Powerful Bluetooth headphones
		                    </div>
		                    <div class="button-pill">
		                        <span>Shop Now</span>
		                    </div>
		                </div>
		            </a>
		        </div>
		    </div>
		</div>
		<div class="main-container section-padding py-3">
		    <div class="container mt-0 mt-lg-5">
		        <div class="table-responsive">
		            <table class="at-intenet-package" id="pack">
		                <thead>
		                    <tr>
		                        <th class="at-int-intro">
		                            <h2>Iphone XS  <span class="span-text-col">black/512 GB</span> </h2></th>
		                        <th>1 movie (2GB) would take...</th>
		                        <th>50 photos (300MB) would take...</th>
		                        <th>1 album (60MB) would take...</th>
		                        <th></th>
		                    </tr>
		                </thead>
		                <tbody>
		                    <tr>
		                        <td class="at-int-speedname">
		                            <h2 class="at-IntHdr">Company Name</h2>
		                            <ul>
		                                <li><b>768Kbps</b> Download</li>
		                                <li><b>384Kbps</b> Upload</li>
		                            </ul>
		                        </td>
		                        <td class="at-int-dl1">
		                            <h2 class="at-IntHdr">6.2<span class="time-sep"> hrs</span></h2>
		                            <span class="todownload">to download*</span>
		                        </td>
		                        <td class="at-int-dl2">
		                            <h2 class="at-IntHdr">55<span class="time-sep"> min</span></h2>
		                            <span class="todownload">to download*</span>
		                        </td>
		                        <td class="at-int-dl3">
		                            <h2 class="at-IntHdr">11<span class="time-sep"> min</span></h2>
		                            <span class="todownload">to download*</span>
		                        </td>
		                        <td class="at-int-price">
		                            <h2 class="at-IntHdr">
		                                        <span>$</span>11.95<span class="per-month">/mo</span>
		                                    </h2>
		                            <span class="check-info">12 Month Pricing</span> No Contract Required
		                        </td>
		                        <td class="at-int-check"><a href="#" class="btn white">Check Availability</a></td>
		                    </tr>
		                    <tr>
		                        <td class="at-int-speedname">
		                            <h2 class="at-IntHdr">Company Name</h2>
		                            <ul>
		                                <li><b>768Kbps</b> Download</li>
		                                <li><b>384Kbps</b> Upload</li>
		                            </ul>
		                        </td>
		                        <td class="at-int-dl1">
		                            <h2 class="at-IntHdr">6.2<span class="time-sep"> hrs</span></h2>
		                            <span class="todownload">to download*</span>
		                        </td>
		                        <td class="at-int-dl2">
		                            <h2 class="at-IntHdr">55<span class="time-sep"> min</span></h2>
		                            <span class="todownload">to download*</span>
		                        </td>
		                        <td class="at-int-dl3">
		                            <h2 class="at-IntHdr">11<span class="time-sep"> min</span></h2>
		                            <span class="todownload">to download*</span>
		                        </td>
		                        <td class="at-int-price">
		                            <h2 class="at-IntHdr">
		                                        <span>$</span>11.95<span class="per-month">/mo</span>
		                                    </h2>
		                            <span class="check-info">12 Month Pricing</span> No Contract Required
		                        </td>
		                        <td class="at-int-check"><a href="#" class="btn white">Check Availability</a></td>
		                    </tr>
		                    <tr>
		                        <td class="at-int-speedname">
		                            <h2 class="at-IntHdr">Company Name</h2>
		                            <ul>
		                                <li><b>768Kbps</b> Download</li>
		                                <li><b>384Kbps</b> Upload</li>
		                            </ul>
		                        </td>
		                        <td class="at-int-dl1">
		                            <h2 class="at-IntHdr">6.2<span class="time-sep"> hrs</span></h2>
		                            <span class="todownload">to download*</span>
		                        </td>
		                        <td class="at-int-dl2">
		                            <h2 class="at-IntHdr">55<span class="time-sep"> min</span></h2>
		                            <span class="todownload">to download*</span>
		                        </td>
		                        <td class="at-int-dl3">
		                            <h2 class="at-IntHdr">11<span class="time-sep"> min</span></h2>
		                            <span class="todownload">to download*</span>
		                        </td>
		                        <td class="at-int-price">
		                            <h2 class="at-IntHdr">
		                                        <span>$</span>11.95<span class="per-month">/mo</span>
		                                    </h2>
		                            <span class="check-info">12 Month Pricing</span> No Contract Required
		                        </td>
		                        <td class="at-int-check"><a href="#" class="btn white">Check Availability</a></td>
		                    </tr>
		                    <tr>
		                        <td class="at-int-speedname">
		                            <h2 class="at-IntHdr">Company Name</h2>
		                            <ul>
		                                <li><b>768Kbps</b> Download</li>
		                                <li><b>384Kbps</b> Upload</li>
		                            </ul>
		                        </td>
		                        <td class="at-int-dl1">
		                            <h2 class="at-IntHdr">6.2<span class="time-sep"> hrs</span></h2>
		                            <span class="todownload">to download*</span>
		                        </td>
		                        <td class="at-int-dl2">
		                            <h2 class="at-IntHdr">55<span class="time-sep"> min</span></h2>
		                            <span class="todownload">to download*</span>
		                        </td>
		                        <td class="at-int-dl3">
		                            <h2 class="at-IntHdr">11<span class="time-sep"> min</span></h2>
		                            <span class="todownload">to download*</span>
		                        </td>
		                        <td class="at-int-price">
		                            <h2 class="at-IntHdr">
		                                        <span>$</span>11.95<span class="per-month">/mo</span>
		                                    </h2>
		                            <span class="check-info">12 Month Pricing</span> No Contract Required
		                        </td>
		                        <td class="at-int-check"><a href="#" class="btn white">Check Availability</a></td>
		                    </tr>
		                    <tr>
		                        <td class="at-int-speedname">
		                            <h2 class="at-IntHdr">Company Name</h2>
		                            <ul>
		                                <li><b>768Kbps</b> Download</li>
		                                <li><b>384Kbps</b> Upload</li>
		                            </ul>
		                        </td>
		                        <td class="at-int-dl1">
		                            <h2 class="at-IntHdr">6.2<span class="time-sep"> hrs</span></h2>
		                            <span class="todownload">to download*</span>
		                        </td>
		                        <td class="at-int-dl2">
		                            <h2 class="at-IntHdr">55<span class="time-sep"> min</span></h2>
		                            <span class="todownload">to download*</span>
		                        </td>
		                        <td class="at-int-dl3">
		                            <h2 class="at-IntHdr">11<span class="time-sep"> min</span></h2>
		                            <span class="todownload">to download*</span>
		                        </td>
		                        <td class="at-int-price">
		                            <h2 class="at-IntHdr">
		                                    <span>$</span>11.95<span class="per-month">/mo</span>
		                                </h2>
		                            <span class="check-info">12 Month Pricing</span> No Contract Required
		                        </td>
		                        <td class="at-int-check"><a href="#" class="btn white">Check Availability</a></td>
		                    </tr>
		                </tbody>
		            </table>
		        </div>
		    </div>
		    <div class="row">
		        <div class="col text-center mt-5 mb-5">
		            <a href="sign-in.html" class="btn btn-common btn-find plan ">Register to Unlock Telco Tales</a>
		        </div>
		    </div>
		</div>
	<!-- Content End Here -->

@endsection