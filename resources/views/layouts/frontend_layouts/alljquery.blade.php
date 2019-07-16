
<!-- <button onclick="alert($('.rate').rate('getValue'));">get</button> -->
<script src="{{URL::asset('frontend/assets/js/jquery-min.js')}}"></script>
<script src="{{URL::asset('frontend/assets/js/popper.min.js')}}"></script>
<script src="{{URL::asset('frontend/assets/js/bootstrap.min.js')}}"></script>
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
<script src="{{URL::asset('frontend/jsplugins/jquery.city-autocomplete.js')}}"></script>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?key=AIzaSyBF1pe8Sl7TDb-I7NBP-nviaZmDpnmNk_s&libraries=places&language=en"></script>


  <script>
    
    $('input#city').cityAutocomplete();
    $('input#user_city').cityAutocomplete();
    $('<div class="country_list"><ul class="country-autocomplete"></ul></div>').appendTo('#country_div');
    $('#country_div input').keyup(function(){
        var search = $(this).val();
        if(window.location.protocol == "http:"){
            resuesturl = "{{url('/getCountry')}}"
        }else if(window.location.protocol == "https:"){
            resuesturl = "{{secure_url('/getCountry')}}"
        }
        $.ajax({
          type: "post",
          url: resuesturl,
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          dataType:'json',
          data: {
              'search':search
          },
          success: function (data) {
              if(data.success){
                $('.country_list').css('display','block');
                $('.country-autocomplete').html('');
                var resp = $.map(data.data,function(obj){
                    $('.country-autocomplete').append('<li><a href="javascript:void(0);" data-name="'+obj.name+'" data-code="'+obj.code+'">'+obj.name+'</a></li>');
               }); 
    
              }
          }         
      });
    });

    $(document).on('click','.country-autocomplete li',function(){
        $('#country').val($(this).find('a').attr('data-name'));
        $('#city').attr('data-country',$(this).find('a').attr('data-code'));
        $('.country_list').css('display','none');
        setTimeout(function(){
            $('input#city').cityAutocomplete();
        },500);
    });
    $(document).on('click','.country-autocomplete li',function(){
        $('#user_country').val($(this).find('a').attr('data-name'));
        $('#user_city').attr('data-country',$(this).find('a').attr('data-code'));
        $('.country_list').css('display','none');
        setTimeout(function(){
            $('input#user_city').cityAutocomplete();
        },500);
    });




  $("#firstform").validate();
  $("#device_rating_form").validate();
  $("#address_form").validate();
  $("#overage_price_form").validate({
    rules: {
        overage_price: {
          required: true,
          number: true
        },
        data_over_age: {
          required: true,
          number: true
        }
      }
  });
  $("#change_address_form").validate({
    rules: {
        postal_code: {
          required: true,
          number: true
        }
      }
  });
  $("#change_password_form").validate({
    rules: {
      new_password: "required",
      confirm_password: {
        equalTo: "#new_password"
      },
      old_password: {
        required: true,
      }
    }
  });
  $("#usage_price_form").validate({
    rules: {
        voice_usage_price: {
          required: true,
          number: true
        },
        data_usage_age: {
          required: true,
          number: true
        }
      }
  });
  $(".reveiewing_form_service").validate({
    rules: {
        price: {
          required: true,
          number: true
        }
      }
  });
  $(".rating").rate({
    // readonly:true
  });
  $('.mint_input').focusout(function(){
    var mintval = $(this).val();
    if(mintval != "Unlimited" && mintval != "unlimited" && $.isNumeric(mintval) != true){
      $(this).val('');
    }
  });
  $(".rating").on("change", function(ev, data){
  var rateTotal=0;
  var count = 0;
    var question_count = $('#rating_section .rating').length;
    var perams = [];
    $('#rating_section .rating').each(function(index, item){
      var rate = $(item).rate('getValue');
      if(rate == 0){
        count = count+1;
      }
      rateTotal += rate;
    });
    var count_avr = question_count-count;
    var average = rateTotal/count_avr;
    $('.average_div').text(average.toFixed(2));
    $('.average_input').val(average);
  });

  $(".rating_disable").rate({
    readonly:true
  });
  $(".provider_text_show").on('click',function(){
    if ($(".provider_select select").attr("disabled")) {
      
        $('.provider_status').val(1);
        $('.provider_select select').attr('disabled',false);
        $('.provider_select select').attr('required',true);
        $('.provider_select select').addClass('active');
        $('.provider_text input').removeClass('active');
        $('.provider_text input').attr('required',false);
        $('.provider_text').hide();

    } else {

        $('.provider_status').val(2);
        $('.provider_select select option').prop('selected',false);
        $('.provider_select select').attr('required',false);
        $('.provider_select select option:nth-child(1)').prop('selected',true);
        $('.provider_select select').attr('disabled',true);
        $('.provider_select select').removeClass('active');
        $('.provider_text input').addClass('active');
        $('.provider_text input').attr('required',true);
        $('.provider_text').show();

    }
    
  });
    var sections = $('section');
    var nav = $('nav');
    var nav_height = nav.outerHeight();
    $(window).on('scroll', function () {
        var cur_pos = $(this).scrollTop();
        sections.each(function() {
            var top = $(this).offset().top - nav_height,
            bottom = top + $(this).outerHeight();
        
            if (cur_pos >= top && cur_pos <= bottom) {
                nav.find('a').removeClass('active');
                sections.removeClass('active');
              
                $(this).addClass('active');
                nav.find('a[href="#'+$(this).attr('id')+'"]').addClass('active');
            }
        });
    });

    nav.find('a').on('click', function () {
        var $el = $(this);
        var id = $el.attr('href');
    
        $('html, body').animate({
            scrollTop: $(id).offset().top - nav_height
        }, 500);
    
        return false;
    });
        // Review Page Js
            $('.start_btn').on('click',function(){
            	$(this).hide();
                var class_hide_show = $(this).attr('data-class');
                $('.'+class_hide_show).removeClass('section-d-none');
            });
            $('.select_one').on('change',function(){
               var section_class = $(this).val();
               $('.section-both').addClass('section-d-none');
                $('.'+section_class).removeClass('section-d-none');
                $('.'+section_class+' .service_form_section').removeClass('section-d-none');
            });
            $(function(){
                $('.btn-circle').on('click',function(){
                   $('.btn-circle.btn-info').removeClass('btn-info').addClass('btn-default');
                   $(this).addClass('btn-info').removeClass('btn-default').blur();
                });
                
                $('.next-step, .prev-step').on('click', function (e){
                   var $activeTab = $('.tab-pane.active');
                
                   $('.btn-circle.btn-info').removeClass('btn-info').addClass('btn-default');
                
                   if ( $(e.target).hasClass('next-step') )
                   {
                      var nextTab = $activeTab.next('.tab-pane').attr('id');
                      $('[href="#'+ nextTab +'"]').addClass('btn-info').removeClass('btn-default');
                      $('[href="#'+ nextTab +'"]').tab('show');
                   }
                   else
                   {
                      var prevTab = $activeTab.prev('.tab-pane').attr('id');
                      $('[href="#'+ prevTab +'"]').addClass('btn-info').removeClass('btn-default');
                      $('[href="#'+ prevTab +'"]').tab('show');
                   }
                });
            });
            $('.contract_type').on('change',function(){
              var type = $(this).attr('data-type');
              if($(this).prop("checked") == true){
                $('.service_type .buisness').show();
                $('.service_type .personal').hide();
              }else{
                $('.service_type .buisness').hide();
                $('.service_type .personal').show();
              }
            });
            
        // End Review page js
        // Review page ajax
        $('#firstform').on('submit',function(e){
          var thisform = $(this);
          e.preventDefault();
          var firstname = $('#firstname').val();
          var lastname = $('#lastname').val();
          var country = $('#country').val();
          var city = $('#city').val();
          var postal_code = $('#postal_code').val();
          var mobile_number = $('#mobile_number').val();
          if(firstname == "" || lastname == "" || country == "" || city == ""){
            return;
          }
          if(window.location.protocol == "http:"){
              resuesturl = "{{url('/reviewsDetail')}}"
          }else if(window.location.protocol == "https:"){
              resuesturl = "{{secure_url('/reviewsDetail')}}"
          }
          $.ajax({
              type: "post",
              url: resuesturl,
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              },
              dataType:'json',
              data: {
                  'firstname':firstname,
                  'lastname':lastname,
                  'country':country,
                  'city':city,
                  'postal_code':postal_code,
                  'mobile_number':mobile_number
              },
              success: function (data) {
                  if(data.success){
                    thisform.closest('.intro-section').addClass('section-d-none');
                    $('.service-detail').removeClass('section-d-none');
                  }else{
                    // toastr.error('Add detail', 'Somthing went wrong' , {displayDuration:3000,position: 'top-right'});
                  }
              }         
          });
        });

        $('.reveiewing_form_service').on('submit',function(e){
          e.preventDefault();
          if(!$('.reveiewing_form_service').valid()){
            return;
          }
          var reviewform = $(this);
          var provider_name = $('.provider_name.active').val();
          var provider_status = $('.provider_status').val();
          var contract_type = $('.contract_type:checked').val();
          var pay_as_usage = $('.pay_as_usage:checked').val();
          var price = $('.price').val();
          var currency_id = $('.currency_id').val();
          var currency_name = $('.currency_id option:checked').text();
          var payment_type = $('.payment_type:checked').val();
          var overage_price = $('#overage_price:checked').val();
          var service_type = $('.service_type').val();
          var technology_type = $('.technology_type').val();
          var voice_price = $('#voice_overage_price').val();
          var data_price = $('#data_over_age').val();
          var voice_usage_price = $('#voice_usage_price').val();
          var data_usage_age = $('#data_usage_age').val();
          var local_min = $('.local_min').val();
          var datavolume = $('.datavolume').val();
          var long_distance_min = $('.long_distance_min').val();
          var international_min = $('.international_min').val();
          var roaming_min = $('.roaming_min').val();
          var data_speed = $('.data_speed').val();
          var sms = $('.sms').val();

          if(pay_as_usage != 1){
            if(local_min != "Unlimited" && local_min != "unlimited" && $.isNumeric(local_min) != true){
             return;
            }
            if(long_distance_min != "Unlimited" && long_distance_min != "unlimited" && $.isNumeric(long_distance_min) != true){
             return;
            }
            if(international_min != "Unlimited" && international_min != "unlimited" && $.isNumeric(international_min) != true){
             return;
            }
            if(roaming_min != "Unlimited" && roaming_min != "unlimited" && $.isNumeric(roaming_min) != true){
             return;
            }
            if(sms != "Unlimited" && sms != "unlimited" && $.isNumeric(sms) != true){
             return;
            }
          }
          if(data_speed != "Unlimited" && data_speed != "unlimited" && $.isNumeric(data_speed) != true){
           return;
          }

          swal({
              title: currency_name+' '+price,
              text: "Above price is including tax"
            })
          .then(name => {
              if(name){
                
                if(window.location.protocol == "http:"){
                    resuesturl = "{{url('/reviewService')}}"
                }else if(window.location.protocol == "https:"){
                    resuesturl = "{{secure_url('/reviewService')}}"
                }
                $.ajax({
                    type: "post",
                    url: resuesturl,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    dataType:'json',
                    data: {
                      'provider_id': provider_name,
                      'provider_status':provider_status,
                      'contract_type': contract_type,
                      'price': price,
                      'payment_type': payment_type,
                      'service_type': service_type,
                      'local_min': local_min,
                      'datavolume': datavolume,
                      'long_distance_min': long_distance_min,
                      'international_min': international_min,
                      'roaming_min': roaming_min,
                      'data_speed': data_speed,
                      'sms':sms,
                      'technology':technology_type,
                      'currency_id':currency_id,
                      'overage_price':overage_price,
                      'voice_price':voice_price,
                      'data_price':data_price,
                      'voice_usage_price':voice_usage_price,
                      'data_usage_price':data_usage_age,
                      'pay_as_usage_type':pay_as_usage
                    },
                    success: function (data) {
                        if(data.success){
                          $('.service_id').val(data.service_id);
                          reviewform.closest('.service_form_section').addClass('section-d-none');
                          $('.services-rating-section').removeClass('section-d-none');
                        }else{
                          // toastr.error('Add detail', data.message , {displayDuration:3000,position: 'top-right'});
                        }
                    }         
                });
              }
            });
          
        });

        $('.service-rating-submit-btn').on('click',function(e){
          e.preventDefault();
          var isset = 0;
          var comment = $('#comment').val();
          var average_input = $('.average_input').val();
          var service_id = $('.service_id').val();
          var user_address_id = $('#user_address_id').val();
          var user_full_address = $('#user_full_address').val();
          var user_city = $('#user_city').val();
          var user_country = $('#user_country').val();
          var user_postal_code = $('#user_postal_code').val();
          var is_primary = $('#is_primary').val();
          var formatted_address = user_full_address+' '+user_city+' '+user_country+' '+user_postal_code;
          var perams = [];
          $('#rating_section .rating').each(function(index, item){
            var rate = $(item).rate('getValue');
            var question_id = $(item).attr('data-question_id');
            if(rate==0){
              $('.starrating_error').removeClass('d-none');
              setTimeout(function(){
                $('.starrating_error').addClass('d-none');
              },3000);
              isset = 0;
              return false;
            }else{
              isset = 1;
              if (perams[index] === undefined) {
                  perams[index] = {question_id: question_id,rate: rate};
              } else {
                  perams[index].question_id = question_id;
                  perams[index].rate = rate;
              }
            }
          });
          if(isset == 1){
            $('#user_address').modal({
                show: true
            });
            var ratingform = $(this);
            if(window.location.protocol == "http:"){
                resuesturl = "{{url('/ratingService')}}"
            }else if(window.location.protocol == "https:"){
                resuesturl = "{{secure_url('/ratingService')}}"
            }
            $.ajax({
                type: "post",
                url: resuesturl,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                dataType:'json',
                data: {
                  'perameters':perams,
                  'comment':comment,
                  'average_input':average_input,
                  'plan_id':service_id,
                  'user_address_id':user_address_id,
                  'user_full_address':user_full_address,
                  'user_city':user_city,
                  'user_country':user_country,
                  'user_postal_code':user_postal_code,
                  'is_primary':is_primary,
                  'formatted_address':formatted_address

                },
                success: function (data) {
                    if(data.success){

                      toastr.success('Rating', data.message , {displayDuration:3000,position: 'top-right'});
                      $('.detail-section').addClass('section-d-none');
                      ratingform.closest('.services-rating-section').addClass('section-d-none');
                      ratingform.closest('.services-rating-section').next('.speed-test-button-section').removeClass('section-d-none');
                      
                    }else{
                      // toastr.error('Rating', data.message , {displayDuration:3000,position: 'top-right'});
                    }
                }         
            });
          }
        });

        $('.continue-btn').on('click',function(e){
        	e.preventDefault();
        	$(this).closest('.speed-test-button-section').addClass('section-d-none');
        	$(this).closest('.speed-test-button-section').next('.speedtest-section').removeClass('section-d-none');
        });
        // End Review page ajax

        $('.plan_page .switch input').on('change',function(){
          if($(this).prop("checked") == true){
            $(this).closest('.plan_page .switch').prev('.toggle_label').removeClass('active');
            $(this).closest('.plan_page .switch').next('.toggle_label').addClass('active');
          }else{
            $(this).closest('.plan_page .switch').next('.toggle_label').removeClass('active');
            $(this).closest('.plan_page .switch').prev('.toggle_label').addClass('active');
          }
        });
        $(document).on('change','.review_page .switch input',function(){
          if($(this).prop("checked") == true){
            $(this).closest('.review_page .switch').prev('.reviewpage_toggle').removeClass('active');
            $(this).closest('.review_page .switch').next('.reviewpage_toggle').addClass('active');
          }else{
            $(this).closest('.review_page .switch').next('.reviewpage_toggle').removeClass('active');
            $(this).closest('.review_page .switch').prev('.reviewpage_toggle').addClass('active');
          }
        });
        // Changes Address
        $(".edit_address").on('click',function(e){
            e.preventDefault();
            var address_id = $(this).attr('data-address_id');
            if(window.location.protocol == "http:"){
                resuesturl = "{{url('/getAddress')}}"
            }else if(window.location.protocol == "https:"){
                resuesturl = "{{secure_url('/getAddress')}}"
            }
            $.ajax({
              type: "post",
              url: resuesturl,
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              },
              dataType:'json',
              data: {
                  'address_id':address_id
              },
              success: function (data) {
                  if(data.success){
                    $('#address').val(data.data.address);
                    $('#country').val(data.data.country);
                    $('#city').val(data.data.city);
                    $('#postal_code').val(data.data.postal_code);
                    $('#change_address_model').modal({
                        show: true
                    });
                  }
              }         
          });
        });
        
</script>
