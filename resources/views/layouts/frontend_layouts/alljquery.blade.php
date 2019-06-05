
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
<script>
  $(".rating").rate({
    // readonly:true
  });
  var count = 0;
  var coverage_count = 0;
  var service_stability_count = 0;
  var billing_payment_count = 0;
  var data_speed_count = 0;
  var service_waiting_count = 0;
  var voice_quality_count = 0;
  $(".rating").on("change", function(ev, data){
    var coverage = $('.coverage').rate('getValue');
    var service_stability = $('.service_stability').rate('getValue');
    var billing_payment = $('.billing_payment').rate('getValue');
    var data_speed = $('.data_speed').rate('getValue');
    var service_waiting = $('.service_waiting').rate('getValue');
    var voice_quality = $('.voice_quality').rate('getValue');

    if(parseFloat(coverage) > 0){
      coverage_count = 1;
    }
    if(parseFloat(service_stability) > 0){
      service_stability_count = 1;
    }
    if(parseFloat(billing_payment) > 0){
      billing_payment_count = 1;
    }
    if(parseFloat(data_speed) > 0){
      data_speed_count = 1;
    }
    if(parseFloat(service_waiting) > 0){
      service_waiting_count = 1;
    }
    if(parseFloat(voice_quality) > 0){
      voice_quality_count = 1;
    }
    count = parseInt(coverage_count) + parseInt(service_stability_count) + parseInt(billing_payment_count) + parseInt(data_speed_count) + parseInt(service_waiting_count) + parseInt(voice_quality_count);
    var counttotal = parseFloat(coverage) + parseFloat(service_stability) + parseFloat(billing_payment) + parseFloat(data_speed) + parseFloat(service_waiting) + parseFloat(voice_quality);
      var average = counttotal/count;
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
                    toastr.error('Add detail', 'Somthing went wrong' , {displayDuration:3000,position: 'top-right'});
                  }
              }         
          });
        });

        $('.reveiewing_form_service').on('submit',function(e){
          e.preventDefault();
          var reviewform = $(this);
          var provider_name = $('.provider_name.active').val();
          var provider_status = $('.provider_status').val();
          var contract_type = $('.contract_type:checked').val();
          var price = $('.price').val();
          var payment_type = $('.payment_type').val();
          var service_type = $('.service_type').val();
          var local_min = $('.local_min').val();
          var datavolume = $('.datavolume').val();
          var long_distance_min = $('.long_distance_min').val();
          var international_min = $('.international_min').val();
          var roaming_min = $('.roaming_min').val();
          var data_speed = $('.data_speed').val();
          var currency_id = $('.currency_id').val();
          var sms = $('.sms').val();
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
                'currency_id':currency_id 
              },
              success: function (data) {
                  if(data.success){
                    $('.service_id').val(data.service_id);
                    reviewform.closest('.service_form_section').addClass('section-d-none');
                    $('.services-rating-section').removeClass('section-d-none');
                  }else{
                    toastr.error('Add detail', data.message , {displayDuration:3000,position: 'top-right'});
                  }
              }         
          });
        });

        $('.service-rating-submit-btn').on('click',function(e){
          e.preventDefault();
          var ratingform = $(this);
          var coverage = $('.coverage').rate('getValue');
          var service_stability = $('.service_stability').rate('getValue');
          var billing_payment = $('.billing_payment').rate('getValue');
          var data_speed = $('.data_speed').rate('getValue');
          var service_waiting = $('.service_waiting').rate('getValue');
          var voice_quality = $('.voice_quality').rate('getValue');
          var service_id = $('.service_id').val();
          var average = $('.average_input').val();
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
                'coverage': coverage,
                'service_stability': service_stability,
                'billing_payment': billing_payment,
                'data_speed': data_speed,
                'service_waiting': service_waiting,
                'voice_quality': voice_quality,
                'service_id':service_id,
                'rating_average':average,
              },
              success: function (data) {
                  if(data.success){
                    toastr.success('Rating', data.message , {displayDuration:3000,position: 'top-right'});
                    ratingform.closest('.services-rating-section').addClass('section-d-none');
                    ratingform.closest('.service-detail').addClass('section-d-none');
                    window.location.href = "{{url('/profile')}}";
                  }else{
                    toastr.error('Rating', data.message , {displayDuration:3000,position: 'top-right'});
                  }
              }         
          });
        });
        // End Review page ajax
</script>