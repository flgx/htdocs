<script type="text/javascript">
    @if(isset($showModalLogin) && $showModalLogin)
        $('#login').modal('show');
    @endif

    @if((isset($showModalRegister) && $showModalRegister) || Session::has('showModalRegister'))
        $('#register').modal('show');
    @endif

    @if((isset($showModalRemind) && $showModalRemind) || Session::has('showModalRemind'))
        $('#remind').modal('show');
    @endif

    @if((isset($showModalReset) && $showModalReset) || Session::has('showModalReset'))
        $('#remind-reset').modal('show');
    @endif
</script>