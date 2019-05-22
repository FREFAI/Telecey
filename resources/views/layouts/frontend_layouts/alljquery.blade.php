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
<script>
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
            $('#firstform').on('submit',function(e){
                e.preventDefault();
                $(this).closest('.intro-section').addClass('section-d-none');
                $('.service-detail').removeClass('section-d-none');
            });
            $('.select_one').on('change',function(){
               var section_class = $(this).val();
               $('.section-both').addClass('section-d-none');
                $('.'+section_class).removeClass('section-d-none');
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
        // End Review page js
</script>