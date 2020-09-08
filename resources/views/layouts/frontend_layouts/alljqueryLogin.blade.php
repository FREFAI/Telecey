<script src="{{URL::asset('frontend/assets/js/jquery-min.js')}}"></script>
<script src="{{URL::asset('frontend/assets/js/popper.min.js')}}"></script>
<script src="{{URL::asset('frontend/assets/js/bootstrap.min.js')}}"></script>
<script src="{{URL::asset('frontend/jsplugins/jsvalidation/jquery.validate.js')}}"></script>
@if(\Session::has('locale') && \Session::get('locale') == 'fr')
<script src="{{URL::asset('frontend/jsplugins/jsvalidation/messages_fr.js')}}"></script>
@endIf
@yield('pageScript')