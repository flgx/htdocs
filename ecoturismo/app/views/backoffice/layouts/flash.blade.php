<script type="text/javascript" charset="utf-8">

@if(Session::has('successMessage'))
    alertify.success("{{{ Session::get('successMessage') }}}");
@endif

@if(isset($successMessage))
    alertify.success("{{{ $successMessage }}}");    
@endif

@if(Session::has('errorMessage'))
    alertify.error("{{{ Session::get('errorMessage') }}}");
@endif

@if(isset($errorMessage))
    alertify.error("{{{ $errorMessage }}}");    
@endif

@if(Session::has('customMessage'))
    alertify.custom("{{{ Session::get('customMessage') }}}");
@endif

@if(isset($customMessage))
    alertify.custom("{{{ $customMessage }}}");    
@endif

</script>