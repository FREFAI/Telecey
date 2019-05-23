@if ($message = Session::get('success'))
<div class="alert alert-success alert-block">
<button type="button" class="close" data-dismiss="alert">×</button>
        <strong>{{ $message }}</strong>
</div>
@endif


@if ($message = Session::get('error'))
<div class="alert alert-danger alert-block">
<button type="button" class="close" data-dismiss="alert">×</button>
        <strong class="error_msg_more">{!! str_limit($message, 150) !!}
            @if (strlen($message) > 150)
            <a href="#" class="read-more"> ...Ver mais</a>
            @endif
        </strong>
        <strong class="error_msg_less" style="display:none;">{!! $message !!}
            @if (strlen($message) > 150)
            <a href="#" class="read-less">Menos</a>
            @endif
        </strong>          
</div>
@endif


@if ($message = Session::get('warning'))
<div class="alert alert-warning alert-block">
<button type="button" class="close" data-dismiss="alert">×</button>
<strong>{{ $message }}</strong>
</div>
@endif


@if ($message = Session::get('info'))
<div class="alert alert-info alert-block">
<button type="button" class="close" data-dismiss="alert">×</button>
<strong>{{ $message }}</strong>
</div>
@endif
<div class="alert alert-success alert-block" style="display:none">
<button type="button" class="close" data-dismiss="alert">×</button>
<strong class="alertMsg"></strong>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
    $(document).on('click', '.read-more', function(){
        $('.error_msg_less').show();
        $('.error_msg_more').hide();
    });

    $(document).on('click', '.read-less', function(){
        $('.error_msg_less').hide();
        $('.error_msg_more').show();
    });
</script>