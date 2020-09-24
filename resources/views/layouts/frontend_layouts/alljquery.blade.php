<!-- <button onclick="alert($('.rate').rate('getValue'));">get</button> -->
<script src="{{URL::asset('frontend/assets/js/jquery-min.js')}}"></script>
<script src="{{URL::asset('frontend/assets/js/popper.min.js')}}"></script>
<script src="{{URL::asset('frontend/assets/js/bootstrap.min.js')}}"></script>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>

<script src="{{URL::asset('frontend/assets/js/jquery.counterup.min.js')}}"></script>
<script src="{{URL::asset('frontend/assets/js/waypoints.min.js')}}"></script>
<script src="{{URL::asset('frontend/assets/js/wow.js')}}"></script>
<script src="{{URL::asset('frontend/assets/js/owl.carousel.min.js')}}"></script>
<script src="{{URL::asset('frontend/assets/js/jquery.slicknav.js')}}"></script>
<script src="{{URL::asset('frontend/assets/js/main.js')}}"></script>
<script src="{{URL::asset('frontend/assets/js/form-validator.min.js')}}"></script>
<script src="{{URL::asset('frontend/assets/js/contact-form-script.min.js')}}"></script>
<script src="{{URL::asset('frontend/assets/js/summernote.js')}}"></script>
<script src="{{URL::asset('frontend/jsplugins/statr_rating/jquery.rateit.js')}}"></script>
<script src="{{URL::asset('frontend/jsplugins/statr_rating/rater.js')}}"></script>
<!-- Toster JS -->
<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script src="{{URL::asset('frontend/jsplugins/jsvalidation/jquery.form.js')}}"></script>
<script src="{{URL::asset('frontend/jsplugins/jsvalidation/jquery.validate.js')}}"></script>
@if(\Session::has('locale') && \Session::get('locale') == 'fr')
<script src="{{URL::asset('frontend/jsplugins/jsvalidation/messages_fr.js')}}"></script>
@endIf
<!-- <script src="{{URL::asset('frontend/jsplugins/jquery.city-autocomplete.js')}}"></script> -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
<script src="https://cdn.tiny.cloud/1/r33fht357sb48uzaif4s424d91smk1zo3s41jfq0gkx580ee/tinymce/5/tinymce.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBF1pe8Sl7TDb-I7NBP-nviaZmDpnmNk_s&libraries=places&language=en&callback=initMap"></script>

<script src="{{URL::asset('frontend/jsplugins/speedtest/speedtest.js')}}"></script>
@yield('script')
<script>
    $(".language").on("change", function () {
        $(this).closest("form").submit();
    });
    function initMap() {
        var input = document.getElementById("searchMapInput");

        var autocomplete = new google.maps.places.Autocomplete(input);

        autocomplete.addListener("place_changed", function () {
            var place = autocomplete.getPlace();
        });
    }
    if ($("#firstform #city").val() == "") {
        getLocation();
    }
    function getLocation() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(geoSuccess, geoError);
        } else {
            console.log("Geolocation is not supported by this browser.");
        }
    }
    function geoSuccess(position) {
        var lat = position.coords.latitude;
        var lng = position.coords.longitude;

        codeLatLng(lat, lng);
    }
    function geoError() {
        $('.getcity').val($('.getcity').attr('data-city'));
        $('.getpostalcode').val($('.getpostalcode').attr('data-postal_code'));
        console.log("Geocoder failed");
    }
    var geocoder;
    function initialize() {
        geocoder = new google.maps.Geocoder();
    }
    function codeLatLng(lat, lng) {
        var addr = {};
        var latlng = new google.maps.LatLng(lat, lng);
        geocoder.geocode({ latLng: latlng }, function (results, status) {
            if (status == google.maps.GeocoderStatus.OK) {
                if (results[1]) {
                    for (var ii = 0; ii < results[0].address_components.length; ii++) {
                        var street_number = (route = street = city = state = zipcode = country = formatted_address = "");
                        var types = results[0].address_components[ii].types.join(",");
                        if (types == "street_number") {
                            addr.street_number = results[0].address_components[ii].long_name;
                        }
                        if (types == "route" || types == "point_of_interest,establishment") {
                            addr.route = results[0].address_components[ii].long_name;
                        }
                        if (types == "sublocality,political" || types == "locality,political" || types == "neighborhood,political" || types == "administrative_area_level_3,political") {
                            addr.city = city == "" || types == "locality,political" ? results[0].address_components[ii].long_name : city;
                        }
                        if (types == "administrative_area_level_1,political") {
                            addr.state = results[0].address_components[ii].short_name;
                        }
                        if (types == "postal_code" || types == "postal_code_prefix,postal_code") {
                            addr.zipcode = results[0].address_components[ii].long_name;
                        }
                        if (types == "country,political") {
                            addr.country = results[0].address_components[ii].long_name;
                            addr.countryCode = results[0].address_components[ii].short_name;
                        }
                    }
                    $("#firstform #country").val(addr.country);
                    $("#firstform #city").val(addr.city);
                    $("#firstform #city").attr("data-country", addr.countryCode);
                    $("#firstform #postal_code").val(addr.zipcode);
                }
            }
        });
    }
    $(".register-btn").on("click", function (e) {
        e.preventDefault();
        var valid = passwordValidate();
        if (valid) {
            $("#registerForm").submit();
        }
    });
    function passwordValidate(e) {
        var email = $("#user_email").val();
        var pwd = $(".password_user").val();
        $("#password_error").text("");
        $("#password_error").css("color", "red");
        var res = email.toString().split("@");
        // var pwd = e.target.value;
        var regularExpression = /^(?=.*\d)(?=.*[a-z])[a-z\d]{2,}$/i;
        var valid = regularExpression.test(pwd);
        if (valid) {
            if (pwd == res[0]) {
                valid = false;
                $("#password_error").text("{{__('Your password and email are same')}}");
            } else {
                valid = true;
            }
        } else {
            valid = false;
            $("#password_error").text("{{__('index.Password must be alphanumeric')}}");
        }
        return valid;
    }

    var geocoder = new google.maps.Geocoder();
    var infowindow = new google.maps.InfoWindow();
    geocodePlaceId(geocoder, infowindow);
    function geocodePlaceId(geocoder, infowindow) {
        geocoder.geocode({ address: "160055" }, function (results, status) {
            if (status === "OK") {
                if (results[0]) {
                    // map.setZoom(11);
                    // map.setCenter(results[0].geometry.location);
                    // var marker = new google.maps.Marker({
                    //   map: map,
                    //   position: results[0].geometry.location
                    // });
                    // infowindow.setContent(results[0].formatted_address);
                    // infowindow.open(map, marker);
                } else {
                    window.alert("No results found");
                }
            } else {
                window.alert("Geocoder failed due to: " + status);
            }
        });
    }
    $(document).on("click", "#cookie_dismiss", function () {
        if (window.location.protocol == "http:") {
            resuesturl = "{{url('/cookieSet')}}";
        } else if (window.location.protocol == "https:") {
            resuesturl = "{{secure_url('/cookieSet')}}";
        }
        $.ajax({
            url: resuesturl,
            type: "GET",
            success: function (res) {
                $(".cookies_popup").fadeOut();
            },
        });
    });
    function valid_postal_code(value, country = "default") {
        let country_regex = {
            uk: /^[A-Z]{1,2}[0-9]{1,2} ?[0-9][A-Z]{2}$/i,
            ca: /^[A-Za-z]\d[A-Za-z][ -]?\d[A-Za-z]\d$/,
            it: /^[0-9]{5}$/i,
            de: /^[0-9]{5}$/i,
            us: /(^\d{5}$)|(^\d{5}-\d{4}$)/,
            default: /(^\d{5}$)|(^\d{5}-\d{4}$)/, // Same as US.
        };
        country = country.toLowerCase();
        if (!country_regex[country]) {
            country = "default";
        }
        if (country_regex[country].test(value)) {
            return "";
        } else {
            return '<label id="postal_code-error" class="errorcustom" for="postal_code">{{__("index.Postal code is invalid, Please select valid postal code")}}</label>';
        }
    }

    function readURL(input, size) {
        if (size) {
            size = size;
            var maxSize = size * 1024;
        } else {
            size = 10;
            var maxSize = 10240;
        }

        var file = input.files[0]; //get file
        var img = new Image();
        var sizeKB = file.size / 1024;

        if (sizeKB > maxSize) {
            toastr.error("Image size", "Image size should be less then " + size + "Mb.", { displayDuration: 100000, position: "top-right" });
            return false;
        }
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $("#imagePreview").css("background-image", "url(" + e.target.result + ")");
                $("#imagePreview").hide();
                $("#imagePreview").fadeIn(650);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
    $("#imageUpload").change(function () {
        readURL(this, $(this).attr("data-size"));
    });
    // $('input.city_input').cityAutocomplete();
    // $('.user_city_add input#user_city').cityAutocomplete();
    $('<div class="country_list"><ul class="country-autocomplete"></ul></div>').appendTo(".country_div");
    $('<div class="city_list"><ul class="city-autocomplete"></ul></div>').appendTo(".city_div");
    $(document).ready(function () {
        $("#example").DataTable({
            searching: false,
            lengthChange: false,
            paging: false,
            info: false,
            ordering: false,
        });
        tinymce.init({
            selector: ".text_editor",
            height: 300,
            plugins: [
                "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
                "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
                "save table contextmenu directionality emoticons template paste textcolor",
            ],
            content_css: "css/content.css",
            toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link | preview fullpage | forecolor backcolor emoticons | image",
        });
    });
    var countrySelection = true;
    var citySelection = true;
    $(document).on("click", ".country-autocomplete li", function () {
        countrySelection = true;
        $("#country").val($(this).find("a").attr("data-name"));
        $("#city").attr("data-country", $(this).find("a").attr("data-code"));
        $("#country_code").val($(this).find("a").attr("data-code"));
        $(".country_list").css("display", "none");
    });
    $(document).on("click", ".country-autocomplete li", function () {
        countrySelection = true;
        $("#user_country").val($(this).find("a").attr("data-name"));
        $("#user_city").attr("data-country", $(this).find("a").attr("data-code"));
        $(".country_list").css("display", "none");
    });
    $(document).on("click", ".city-autocomplete li", function () {
        citySelection = true;
        $("#city").val($(this).find("a").attr("data-name"));
        $("#city").attr("data-city", $(this).find("a").attr("data-code"));
        $("#city_code").val($(this).find("a").attr("data-code"));
        $(".city_list").css("display", "none");
    });
    $(document).on("click", ".city-autocomplete li", function () {
        citySelection = true;
        $("#user_city").val($(this).find("a").attr("data-name"));
        $("#user_city").attr("data-city", $(this).find("a").attr("data-code"));
        $(".city_list").css("display", "none");
    });
    $("input.city_input").on("keypress", function () {
        citySelection = false;
    });
    $(document).on("click", ".city-autocomplete div", function () {
        citySelection = true;
    });

    $("#firstform").validate();
    $("#caseGenerateForm").validate();
    $("#device_rating_form").validate({
        rules: {
            price: {
                required: true,
                number: true,
            },
        },
    });
    $("#address_form").validate();
    $("#overage_price_form").validate({
        rules: {
            overage_price: {
                required: true,
                number: true,
            },
            data_over_age: {
                required: true,
                number: true,
            },
        },
    });
    $("#change_address_form").validate();
    $("#change_password_form").validate({
        rules: {
            new_password: "required",
            confirm_password: {
                equalTo: "#new_password",
            },
            old_password: {
                required: true,
            },
        },
    });
    $("#usage_price_form").validate({
        rules: {
            voice_usage_price: {
                required: true,
                number: true,
            },
            data_usage_age: {
                required: true,
                number: true,
            },
        },
    });
    $("#speedtestForm").validate({
        rules: {
            data_speed: {
                number: true,
            },
            uploading_speed: {
                number: true,
            },
        },
    });
    $(".reveiewing_form_service").validate({
        rules: {
            price: {
                required: true,
                number: true,
            },
        },
    });
    $(".rating").rate();
    $(".mint_input").focusout(function () {
        var mintval = $(this).val();
        if (mintval != "Unlimited" && mintval != "unlimited" && $.isNumeric(mintval) != true) {
            $(this).val("");
        }
    });
    $(".rating").on("change", function (ev, data) {
        var rateTotal = 0;
        var count = 0;
        var question_count = $("#rating_section .rating").length;
        var perams = [];
        $("#rating_section .rating").each(function (index, item) {
            var rate = $(item).rate("getValue");
            if (rate == 0) {
                count = count + 1;
            }
            rateTotal += rate;
        });
        var count_avr = question_count - count;
        var average = rateTotal / count_avr;
        $(".average_div").text(average.toFixed(2));
        $(".average_input").val(average);
    });

    $(".rating_disable").rate({
        readonly: true,
    });
    $(".country_div input").keyup(function () {
        countrySelection = false;
        var search = $(this).val();
        if (window.location.protocol == "http:") {
            resuesturl = "{{url('/getCountry')}}";
        } else if (window.location.protocol == "https:") {
            resuesturl = "{{secure_url('/getCountry')}}";
        }
        $.ajax({
            type: "post",
            url: resuesturl,
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            dataType: "json",
            data: {
                search: search,
            },
            success: function (data) {
                if (data.success) {
                    $(".country_list").css("display", "block");
                    $(".country-autocomplete").html("");
                    var resp = $.map(data.data, function (obj) {
                        $(".country-autocomplete").append('<li><a href="javascript:void(0);" data-name="' + obj.name + '" data-code="' + obj.code + '">' + obj.name + "</a></li>");
                    });
                }
            },
        });
    });
    $(".city_div input").keyup(function () {
        citySelection = false;
        var country_code = $(this).attr("data-country");
        var search = $(this).val();
        if (window.location.protocol == "http:") {
            resuesturl = "{{url('/getCityByCountry')}}";
        } else if (window.location.protocol == "https:") {
            resuesturl = "{{secure_url('/getCityByCountry')}}";
        }
        $.ajax({
            type: "post",
            url: resuesturl,
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            dataType: "json",
            data: {
                search: search,
                country_code: country_code,
            },
            success: function (data) {
                $(".city-autocomplete").html("");
                $(".city_list").css("display", "none");
                if (data.success) {
                    $(".city_list").css("display", "block");
                    $(".city-autocomplete").css("display", "block");
                    var resp = $.map(data.data, function (obj) {
                        $(".city-autocomplete").append('<li><a href="javascript:void(0);" data-name="' + obj.name + '">' + obj.name + "</a></li>");
                    });
                }
            },
        });
    });

    var sections = $("section");
    var nav = $("nav");
    var nav_height = nav.outerHeight();
    $(window).on("scroll", function () {
        var cur_pos = $(this).scrollTop();
        sections.each(function () {
            var top = $(this).offset().top - nav_height,
                bottom = top + $(this).outerHeight();

            if (cur_pos >= top && cur_pos <= bottom) {
                nav.find("a").removeClass("active");
                sections.removeClass("active");

                $(this).addClass("active");
                nav.find('a[href="#' + $(this).attr("id") + '"]').addClass("active");
            }
        });
    });

    nav.find("a").on("click", function () {
        var $el = $(this);
        var id = $el.attr("href");

        $("html, body").animate(
            {
                scrollTop: $(id).offset().top - nav_height,
            },
            500
        );

        return false;
    });
    // Review Page Js
    $(".start_btn").on("click", function () {
        $(this).hide();
        var class_hide_show = $(this).attr("data-class");
        $("." + class_hide_show).removeClass("section-d-none");
    });
    $(".select_one").on("click", function () {
        // $(this).closest('form.get-in-touch.detail-section').hide();
        var section_class = $(this).attr("data-value");
        $(".section-both").addClass("section-d-none");
        $("." + section_class).removeClass("section-d-none");
        $("." + section_class + " .service_form_section").removeClass("section-d-none");
        document.body.scrollTop = 0;
        document.documentElement.scrollTop = 0;
    });
    $(function () {
        $(".btn-circle").on("click", function () {
            $(".btn-circle.btn-info").removeClass("btn-info").addClass("btn-default");
            $(this).addClass("btn-info").removeClass("btn-default").blur();
        });

        $(".next-step, .prev-step").on("click", function (e) {
            var $activeTab = $(".tab-pane.active");

            $(".btn-circle.btn-info").removeClass("btn-info").addClass("btn-default");

            if ($(e.target).hasClass("next-step")) {
                var nextTab = $activeTab.next(".tab-pane").attr("id");
                $('[href="#' + nextTab + '"]')
                    .addClass("btn-info")
                    .removeClass("btn-default");
                $('[href="#' + nextTab + '"]').tab("show");
            } else {
                var prevTab = $activeTab.prev(".tab-pane").attr("id");
                $('[href="#' + prevTab + '"]')
                    .addClass("btn-info")
                    .removeClass("btn-default");
                $('[href="#' + prevTab + '"]').tab("show");
            }
        });
    });
    $(".contract_type").on("change", function () {
        var type = $(this).attr("data-type");
        if ($(this).prop("checked") == true) {
            $(".service_type .buisness").show();
            $(".service_type .personal").hide();
        } else {
            $(".service_type .buisness").hide();
            $(".service_type .personal").show();
        }
    });

    // End Review page js
    // Review page ajax
    $(document)
        .find(".back-btn")
        .on("click", function () {
            $("#firstform").closest(".intro-section").removeClass("section-d-none");
            $(".service-detail").addClass("section-d-none");
            document.body.scrollTop = 0;
            document.documentElement.scrollTop = 0;
        });
    $(document)
        .find(".back-btn-2")
        .on("click", function () {
            $(".services-rating-section").addClass("section-d-none");
            $(".second-step").show();
            $(".detail-section").removeClass("section-d-none");
            $(".reveiewing_form_service").closest(".service_form_section").removeClass("section-d-none");
            document.body.scrollTop = 0;
            document.documentElement.scrollTop = 0;
        });
    $(document)
        .find(".back-btn-3")
        .on("click", function () {
            $("#device_rating_form").removeClass("section-d-none");
            $(".second-step").show();
            $(".detail-section").removeClass("section-d-none");
            $("#device_rating_form").next("#device_rating_section").addClass("section-d-none");
            document.body.scrollTop = 0;
            document.documentElement.scrollTop = 0;
        });
    $(document)
        .find(".back-btn-device")
        .on("click", function () {
            $("#firstform").closest(".intro-section").removeClass("section-d-none");
            $(".service-detail").addClass("section-d-none");
            document.body.scrollTop = 0;
            document.documentElement.scrollTop = 0;
        });

    function valid_postal_code_with_google_api(value, country, city) {
        let cities = [];
        let countryExist = "";
        let postalCode = "";
        return new Promise((resolve) => {
            $.ajax({
                url: "https://maps.googleapis.com/maps/api/geocode/json?address=" + value + "&key=AIzaSyBA8bx4gjNJX_EBkoqNDvaGN7QduUn6W68",
                type: "GET",
                dataType: "json",
                success: function (res) {
                    if (res.status == "OK") {
                        var data = [];
                        var results = res.results;
                        for (var ac = 0; ac < results[0].address_components.length; ac++) {
                            var component = results[0].address_components[ac];
                            if (component.types.indexOf("country") != -1) {
                                if (country == component.long_name) {
                                    countryExist = component.long_name;
                                }
                            } else if (component.types.indexOf("postal_code") != -1) {
                                postalCode = component.long_name;
                            } else {
                                cities.push(component.long_name);
                            }
                        }
                        data["formatted_address"] = results[0].formatted_address;

                        if (countryExist == country && cities.indexOf(city) != -1) {
                            data["status"] = true;
                        } else {
                            data["status"] = false;
                        }
                        resolve(data);
                    } else {
                        var data = [];
                        data["status"] = false;
                        resolve(data);
                    }
                },
            });
        });
    }
    $("#firstform").on("submit", async function (e) {
        e.preventDefault();
        if (countrySelection === false) {
            $(".country_list").css("display", "none");
            $("#country").addClass("error");
            // $('#country').val('');
            if ($("#country_div #country-error").length == 0) {
                $("#country_div").append('<label id="country-error" class="error" for="country">{{__("index.Pleace select country from a list")}}</label>');
            }
            return false;
        }
        if (citySelection === false) {
            $(".city_list").css("display", "none");
            $("#city").addClass("error");
            // $('#city').val('');
            if ($("#city_div #city-error").length == 0) {
                $("#city_div").append('<label id="city-error" class="error" for="city">{{__("index.Pleace select city from a list")}}</label>');
            }
            return false;
        }
        let postal = await valid_postal_code_with_google_api($("#firstform #postal_code").val(), $("#firstform #country").val(), $("#firstform .city_input").val());

        // let postal = valid_postal_code($('#firstform #postal_code').val(),$('#firstform .city_input').attr('data-country'));
        if (!postal["status"]) {
            if (!$("#firstform #postal_code").hasClass("error")) {
                $("#firstform #postal_code + #postal_code-error").remove();
                $("#firstform #postal_code").addClass("error");
                $("#firstform #postal_code").after('<label id="postal_code-error" class="error" for="postal_code">{{__("index.Postal code is invalid, Please select valid postal code")}}</label>');
            }
            return false;
        }
        var thisform = $(this);

        var latitude = $("#lat").val();
        var longitude = $("#long").val();
        var firstname = $("#firstname").val();
        var lastname = $("#lastname").val();
        var country = $("#country").val();
        var city = $("#city").val();
        var country_code = $("#city").attr("data-country");
        var postal_code = $("#postal_code").val();
        var mobile_number = $("#mobile_number").val();
        if (firstname == "" || lastname == "" || country == "" || city == "") {
            return;
        }
        if (window.location.protocol == "http:") {
            resuesturl = "{{url('/reviewsDetail')}}";
        } else if (window.location.protocol == "https:") {
            resuesturl = "{{secure_url('/reviewsDetail')}}";
        }

        $(".ajaxloader").show();
        $.ajax({
            type: "post",
            url: resuesturl,
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            dataType: "json",
            data: {
                latitude: latitude,
                longitude: longitude,
                firstname: firstname,
                lastname: lastname,
                country: country,
                city: city,
                country_code: country_code,
                postal_code: postal_code,
                mobile_number: mobile_number,
            },
            success: function (data) {
                $(".ajaxloader").hide();
                if (data.success) {
                    thisform.closest(".intro-section").addClass("section-d-none");
                    $(".service-detail").removeClass("section-d-none");
                    $(".ratingAddressLable").text(data.address);
                    document.body.scrollTop = 0;
                    document.documentElement.scrollTop = 0;
                } else {
                    // toastr.error('Add detail', 'Somthing went wrong' , {displayDuration:3000,position: 'top-right'});
                }
            },
        });
    });

    $(".reveiewing_form_service").on("submit", function (e) {
        e.preventDefault();
        if (!$(".reveiewing_form_service").valid()) {
            return;
        }
        var reviewform = $(this);
        var provider_name = $(".provider_name.active").val();
        var provider_status = $(".provider_status").val();
        var contract_type = $(".contract_type:checked").val();
        var pay_as_usage = $(".pay_as_usage:checked").val();
        var price = $(".price").val();
        var currency_id = $(".currency_id").val();
        var currency_name = $(this).find(".currency_id option:checked").text();
        var payment_type = $(".payment_type:checked").val();
        var overage_price = $("#overage_price:checked").val();
        var service_type = $(".service_type").val();
        var technology_type = $(".technology_type").val();
        var voice_price = $("#voice_overage_price").val();
        var data_price = $("#data_over_age").val();
        var voice_usage_price = $("#voice_usage_price").val();
        var data_usage_age = $("#data_usage_age").val();
        var latitude = $("#lat").val();
        var longitude = $("#long").val();
        var local_min = $(".local_min").val();
        var datavolume = $(".datavolume").val();
        var long_distance_min = $(".long_distance_min").val();
        var international_min = $(".international_min").val();
        var roaming_min = $(".roaming_min").val();
        var device_id_plan = $(".device_select").val();
        var upfront_price = $(".upfront_price").val();
        var sms = $(".sms").val();
        var plan_id = $("#plan_id").val();
        if (pay_as_usage != 1) {
            if (local_min != "Unlimited" && local_min != "unlimited" && $.isNumeric(local_min) != true) {
                return;
            }
            if (long_distance_min != "Unlimited" && long_distance_min != "unlimited" && $.isNumeric(long_distance_min) != true) {
                return;
            }
            if (international_min != "Unlimited" && international_min != "unlimited" && $.isNumeric(international_min) != true) {
                return;
            }
            if (roaming_min != "Unlimited" && roaming_min != "unlimited" && $.isNumeric(roaming_min) != true) {
                return;
            }
            if (sms != "Unlimited" && sms != "unlimited" && $.isNumeric(sms) != true) {
                return;
            }
        }

        swal({
            title: currency_name + " " + price,
            text: "{{__('index.Above price is including tax')}}",
            buttons: ["{{__('index.No')}}", "{{__('index.Yes')}}"],
        }).then(function (name) {
            if (name) {
                $(".ajaxloader").show();
                if (window.location.protocol == "http:") {
                    resuesturl = "{{url('/reviewService')}}";
                } else if (window.location.protocol == "https:") {
                    resuesturl = "{{secure_url('/reviewService')}}";
                }
                $.ajax({
                    type: "post",
                    url: resuesturl,
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                    },
                    dataType: "json",
                    data: {
                        provider_id: provider_name,
                        provider_status: provider_status,
                        contract_type: contract_type,
                        price: price,
                        payment_type: payment_type,
                        service_type: service_type,
                        local_min: local_min,
                        datavolume: datavolume,
                        long_distance_min: long_distance_min,
                        international_min: international_min,
                        roaming_min: roaming_min,
                        sms: sms,
                        technology: technology_type,
                        currency_id: currency_id,
                        overage_price: overage_price,
                        voice_price: voice_price,
                        data_price: data_price,
                        voice_usage_price: voice_usage_price,
                        data_usage_price: data_usage_age,
                        pay_as_usage_type: pay_as_usage,
                        latitude: latitude,
                        longitude: longitude,
                        brand_id: device_id_plan,
                        upfront_price: upfront_price,
                        plan_id: plan_id,
                    },
                    success: function (data) {
                        $(".ajaxloader").hide();
                        if (data.success) {
                            speedTestFunction();
                            $(".service_id").val(data.service_id);
                            $(".plan_id").val(data.service_id);
                            $("#plan_id").val(data.service_id);
                            $(".second-step").hide();
                            $(".get-in-touch.detail-section").hide();
                            reviewform.closest(".service_form_section").addClass("section-d-none");
                        } else {
                            // toastr.error('Add detail', data.message , {displayDuration:3000,position: 'top-right'});
                        }
                    },
                });
            }
        });
    });
    $("#speedtestForm").on("submit", function (e) {
        e.preventDefault();
        if (!$("#speedtestForm").valid()) {
            return;
        }
        if ($("#downloading_speed").val() != "" || $("#uploading_speed").val() != "") {
            $(".ajaxloader").show();
            var downloading_speed = $("#downloading_speed").val();
            var uploading_speed = $("#uploading_speed").val();
            var plan_id = $("#plan_id").val();
            var speedtest_type = $("#speedtest_type").val();
            if (window.location.protocol == "http:") {
                resuesturl = "{{url('/saveSpeedTest')}}";
            } else if (window.location.protocol == "https:") {
                resuesturl = "{{secure_url('/saveSpeedTest')}}";
            }
            $.ajax({
                type: "post",
                url: resuesturl,
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },
                dataType: "json",
                data: {
                    downloading_speed: downloading_speed,
                    uploading_speed: uploading_speed,
                    plan_id: plan_id,
                    speedtest_type: speedtest_type,
                },
                success: function (data) {
                    $(".ajaxloader").hide();
                    if (data.success) {
                        $(".services-rating-section").removeClass("section-d-none");
                        $(".detail-section").addClass("section-d-none");
                        $("#speedTestModel").modal("hide");
                    }
                },
            });
        } else {
            $(".services-rating-section").removeClass("section-d-none");
            $(".detail-section").addClass("section-d-none");
            $("#speedTestModel").modal("hide");
        }
    });
    $(".service-rating-submit-btn").on("click", function (e) {
        e.preventDefault();
        var isset = 0;
        var latitude = $("#lat").val();
        var longitude = $("#long").val();
        var comment = $("#comment").val();
        var average_input = $(".average_input").val();
        var service_id = $(".service_id").val();
        var type = $(".plan-type").val();
        var user_address_id = $("#user_address_id").val();
        var user_full_address = $("#user_full_address").val();
        var user_city = $("#user_city").val();
        var user_country_code = $("#user_city").attr("data-country");
        var user_country = $("#user_country").val();
        var user_postal_code = $("#user_postal_code").val();
        var is_primary = $("#is_primary").val();
        var formatted_address = user_full_address + " " + user_city + " " + user_country + " " + user_postal_code;
        var perams = [];
        $("#rating_section .rating").each(function (index, item) {
            var rate = $(item).rate("getValue");
            var question_id = $(item).attr("data-question_id");
            if (rate == 0) {
                $(".starrating_error").removeClass("d-none");
                setTimeout(function () {
                    $(".starrating_error").addClass("d-none");
                }, 3000);
                isset = 0;
                return false;
            } else {
                isset = 1;
                var text_field = $("#text_field_value" + question_id).val();
                var text_field_value = text_field != undefined ? text_field : null;
                if (perams[index] === undefined) {
                    perams[index] = { question_id: question_id, rate: rate, text_field_value: text_field_value };
                } else {
                    perams[index].question_id = question_id;
                    perams[index].rate = rate;
                    perams[index].text_field_value = text_field_value;
                }
            }
        });
        if (isset == 1) {
            $("#user_address").modal({
                show: true,
            });
            var ratingform = $(this);
            if (window.location.protocol == "http:") {
                resuesturl = "{{url('/ratingService')}}";
            } else if (window.location.protocol == "https:") {
                resuesturl = "{{secure_url('/ratingService')}}";
            }

            $(".ajaxloader").show();
            $.ajax({
                type: "post",
                url: resuesturl,
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },
                dataType: "json",
                data: {
                    perameters: perams,
                    latitude: latitude,
                    longitude: longitude,
                    comment: comment,
                    average_input: average_input,
                    service_id: service_id,
                    type: type,
                    user_address_id: user_address_id,
                    user_full_address: user_full_address,
                    user_city: user_city,
                    user_country_code: user_country_code,
                    user_country: user_country,
                    user_postal_code: user_postal_code,
                    is_primary: is_primary,
                    formatted_address: formatted_address,
                },
                success: function (data) {
                    $(".ajaxloader").hide();
                    if (data.success) {
                        toastr.success("Rating", data.message, { displayDuration: 3000, position: "top-right" });
                        $(".detail-section").addClass("section-d-none");
                        // ratingform.closest('.services-rating-section').addClass('section-d-none');
                        // ratingform.closest('.services-rating-section').next('.speed-test-button-section').removeClass('section-d-none');
                        if (type == 1) {
                            window.location.href = "{{url('/profile')}}";
                        } else {
                            window.location.href = "{{url('/profile')}}?type=2";
                        }
                    } else {
                        // toastr.error('Rating', data.message , {displayDuration:3000,position: 'top-right'});
                    }
                },
            });
        }
    });

    $(".continue-btn").on("click", function (e) {
        e.preventDefault();
        $(this).closest(".speed-test-button-section").addClass("section-d-none");
        $(this).closest(".speed-test-button-section").next(".speedtest-section").removeClass("section-d-none");
    });
    // End Review page ajax

    $(".plan_page .switch input").on("change", function () {
        if ($(this).prop("checked") == true) {
            $(this).closest(".plan_page .switch").prev(".toggle_label").removeClass("active");
            $(this).closest(".plan_page .switch").next(".toggle_label").addClass("active");
        } else {
            $(this).closest(".plan_page .switch").next(".toggle_label").removeClass("active");
            $(this).closest(".plan_page .switch").prev(".toggle_label").addClass("active");
        }
    });
    $(document).on("change", ".review_page .switch input", function () {
        if ($(this).prop("checked") == true) {
            $(this).closest(".review_page .switch").prev(".reviewpage_toggle").removeClass("active");
            $(this).closest(".review_page .switch").next(".reviewpage_toggle").addClass("active");
        } else {
            $(this).closest(".review_page .switch").next(".reviewpage_toggle").removeClass("active");
            $(this).closest(".review_page .switch").prev(".reviewpage_toggle").addClass("active");
        }
    });
    // Changes Address
    $(".edit_address").on("click", function (e) {
        e.preventDefault();
        var user_id = $(this).attr("data-user_id");
        if (window.location.protocol == "http:") {
            resuesturl = "{{url('/getAddress')}}";
        } else if (window.location.protocol == "https:") {
            resuesturl = "{{secure_url('/getAddress')}}";
        }
        $(".ajaxloader").show();
        $.ajax({
            type: "post",
            url: resuesturl,
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            dataType: "json",
            data: {
                user_id: user_id,
            },
            success: function (data) {
                $(".ajaxloader").hide();
                if (data.success) {
                    $("#address").val(data.data.address);
                    $("#country").val(data.data.country);
                    $("#city").val(data.data.city);
                    $("#city").attr("data-country", data.data.country_code);
                    $("#country_code").val(data.data.country_code);
                    $("#postal_code").val(data.data.postal_code);
                    $("#address_id").val(data.data.id);
                    $("#change_address_model").modal({
                        show: true,
                    });
                }
            },
        });
    });

    $("#device_rating_form").on("submit", function (e) {
        e.preventDefault();
        if (!$("#device_rating_form").valid()) {
            return;
        }
        var latitude = $("#lat").val();
        var longitude = $("#long").val();
        var brand_name = $(".brand_name.active").val();
        var model_name = $(".model_name.active").val();
        var supplier_name = $(".supplier_name.active").val();
        var brand_status = $(".brand_status").val();
        var supplier_status = $(".supplier_status").val();
        var reviewform = $(this);
        var device = $("#device_id").val();
        var currency_id = $(".currency_id").val();
        var currency_name = $(this).find(".currency_id option:checked").text();
        var price = $("#price").val();
        var storage = $("#storage").val();
        var device_color = $("#device_color").val();
        var device_review_id = $("#device_review_id").val();

        swal({
            title: currency_name + " " + price,
            text: "{{__('index.Above price is including tax')}}",
            buttons: ["{{__('index.No')}}", "{{__('index.Yes')}}"],
        }).then(function (name) {
            if (name) {
                $(".ajaxloader").show();
                if (window.location.protocol == "http:") {
                    resuesturl = "{{url('/reviewDevice')}}";
                } else if (window.location.protocol == "https:") {
                    resuesturl = "{{secure_url('/reviewDevice')}}";
                }
                $.ajax({
                    type: "post",
                    url: resuesturl,
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                    },
                    dataType: "json",
                    data: {
                        latitude: latitude,
                        longitude: longitude,
                        brand_id: brand_name,
                        model_name: model_name,
                        supplier_id: supplier_name,
                        brand_status: brand_status,
                        supplier_status: supplier_status,
                        currency_id: currency_id,
                        device_id: device,
                        price: price,
                        storage: storage,
                        device_color: device_color,
                        device_review_id: device_review_id,
                    },
                    success: function (data) {
                        $(".ajaxloader").hide();
                        if (data.success) {
                            $(".device_id").val(data.device_id);
                            $("#device_review_id").val(data.device_id);
                            reviewform.addClass("section-d-none");
                            $(".second-step").hide();
                            $(".get-in-touch.detail-section").hide();
                            reviewform.next("#device_rating_section").removeClass("section-d-none");
                        }
                    },
                });
            }
        });
    });

    $(".device-rating").on("change", function (ev, data) {
        var rateTotal = 0;
        var count = 0;
        var question_count = $("#device_rating_section .device-rating").length;
        var perams = [];
        $("#device_rating_section .device-rating").each(function (index, item) {
            var rate = $(item).rate("getValue");
            if (rate == 0) {
                count = count + 1;
            }
            rateTotal += rate;
        });
        var count_avr = question_count - count;
        var average = rateTotal / count_avr;
        $(".device_average_div").text(average.toFixed(2));
        $(".device_average_input").val(average);
    });

    $(".device-rating-submit-btn").on("click", function (e) {
        e.preventDefault();
        var isset = 0;
        var comment = $("#device_comment").val();
        var average_input = $(".device_average_input").val();
        var device_id = $(".device_id").val();
        var type = $(".device-type").val();
        var user_address_id = $("#user_address_id").val();
        var user_full_address = $("#user_full_address").val();
        var user_city = $("#user_city").val();
        var user_country_code = $("#user_city").attr("data-country");
        var user_country = $("#user_country").val();
        var user_postal_code = $("#user_postal_code").val();
        var is_primary = $("#is_primary").val();
        var latitude = $("#lat").val();
        var longitude = $("#long").val();
        var formatted_address = user_full_address + " " + user_city + " " + user_country + " " + user_postal_code;
        var perams = [];
        $("#device_rating_section .device-rating").each(function (index, item) {
            var rate = $(item).rate("getValue");
            var question_id = $(item).attr("data-question_id");
            if (rate == 0) {
                $(".device_starrating_error").removeClass("d-none");
                setTimeout(function () {
                    $(".device_starrating_error").addClass("d-none");
                }, 3000);
                isset = 0;
                return false;
            } else {
                isset = 1;
                var text_field = $("#text_field_value" + question_id).val();
                var text_field_value = text_field != undefined ? text_field : null;
                if (perams[index] === undefined) {
                    perams[index] = { question_id: question_id, rate: rate, text_field_value: text_field_value };
                } else {
                    perams[index].question_id = question_id;
                    perams[index].rate = rate;
                    perams[index].text_field_value = text_field_value;
                }
            }
        });
        if (isset == 1) {
            $("#user_address").modal({
                show: true,
            });
            var ratingform = $(this);
            if (window.location.protocol == "http:") {
                resuesturl = "{{url('/ratingDevice')}}";
            } else if (window.location.protocol == "https:") {
                resuesturl = "{{secure_url('/ratingDevice')}}";
            }
            $(".ajaxloader").show();
            $.ajax({
                type: "post",
                url: resuesturl,
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },
                dataType: "json",
                data: {
                    perameters: perams,
                    type: type,
                    comment: comment,
                    latitude: latitude,
                    longitude: longitude,
                    average_input: average_input,
                    device_id: device_id,
                    user_address_id: user_address_id,
                    user_full_address: user_full_address,
                    user_city: user_city,
                    user_country_code: user_country_code,
                    user_country: user_country,
                    user_postal_code: user_postal_code,
                    is_primary: is_primary,
                    formatted_address: formatted_address,
                },
                success: function (data) {
                    $(".ajaxloader").hide();
                    if (data.success) {
                        toastr.success("Rating", data.message, { displayDuration: 3000, position: "top-right" });
                        $(".detail-section").addClass("section-d-none");
                        // ratingform.closest('.services-rating-section').addClass('section-d-none');
                        // ratingform.closest('.services-rating-section').next('.speed-test-button-section').removeClass('section-d-none');
                        window.location.href = "{{url('/profile')}}?type=2";
                    } else {
                        // toastr.error('Rating', data.message , {displayDuration:3000,position: 'top-right'});
                    }
                },
            });
        }
    });
    // End Device section
    // Start Brand Section
    $("#brand").on("change", function () {
        var brandId = $(this).val();
        if (window.location.protocol == "http:") {
            resuesturl = "{{url('/getBrandColor')}}";
        } else if (window.location.protocol == "https:") {
            resuesturl = "{{secure_url('/getBrandColor')}}";
        }
        $.ajax({
            type: "post",
            url: resuesturl,
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            dataType: "json",
            data: {
                id: brandId,
            },
            success: function (data) {
                $("#device_color").html("");
                if (data.success) {
                    var colors = data.data;
                    console.log(colors);

                    if (colors != "") {
                        for (var i = 0; i <= colors.length; i++) {
                            $("#device_color").append('<option value="' + colors[i].id + '">' + colors[i].color_name + "</option>");
                        }
                    } else {
                        $("#device_color").append('<option value="">{{__("index.Color not found")}}</option>');
                    }
                } else {
                }
            },
        });
    });
    // End Brand Section

    // Profile Page
    $(".address_update_btn").on("click", async function (e) {
        e.preventDefault();
        if(!$("#change_address_form").valid()){
            return false;
        }
        if (countrySelection === false) {
            $(".country_list").css("display", "none");
            $("#country").addClass("error");
            // $('#country').val('');

            if ($("#country_div #country-error").length == 0) {
                $("#country_div").append('<label id="country-error" class="error" for="country">{{__("index.Pleace select country from a list")}}</label>');
            }
            return false;
        }
        if (citySelection === false) {
            $(".city_list").css("display", "none");
            $("#city").addClass("error");
            // $('#city').val('');
            if ($("#city_div #city-error").length == 0) {
                $("#city_div").append('<label id="city-error" class="error" for="city">{{__("index.Pleace select city from a list")}}</label>');
            }

            return false;
        }
        let postal = await valid_postal_code_with_google_api($("#postal_code").val(), $("#country").val(), $(".city_input").val());
        if (!postal["status"]) {
            if (!$("#change_address_form #postal_code").hasClass("error")) {
                $("#postal_code").addClass("error");
                $("#postal_code").after('<label id="postal_code-error" class="error" for="postal_code">{{__("index.Postal code is invalid, Please select valid postal code")}}</label>');
            }

            return false;
        }
        $("#change_address_form").submit();
    });
    // End Profile Page
    $(".delete_blog").on("click", function () {
        var blog_id = $(this).attr("data-blog_id");
        var delete_row = $(this);
        if (window.location.protocol == "http:") {
            resuesturl = "{{url('/deleteBlog')}}";
        } else if (window.location.protocol == "https:") {
            resuesturl = "{{secure_url('/deleteBlog')}}";
        }
        swal("{{__('index.Are you sure you want to delete this post')}}?", {
            buttons: ["{{__('index.No')}}", "{{__('index.Yes')}}"],
        }).then(function (name) {
            if (name) {
                $.ajax({
                    type: "post",
                    url: resuesturl,
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                    },
                    dataType: "json",
                    data: {
                        id: blog_id,
                    },
                    success: function (data) {
                        if (data.success) {
                            delete_row.closest("tr").remove();
                            toastr.success("{{__('index.Success')}}", data.message, { displayDuration: 3000, position: "top-right" });
                        } else {
                            toastr.error("{{__('index.Error')}}", data.message, { displayDuration: 3000, position: "top-right" });
                        }
                    },
                });
            }
        });
    });
</script>
@yield('pageScript')