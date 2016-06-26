<!DOCTYPE html>
<html class="bg-black">
    <head>
        <meta charset="UTF-8">
        <title>Naturaleza Argentina</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- bootstrap 3.0.2 -->
        <link href="{{ asset('/backoffice/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
        <!-- font Awesome -->
        <link href="{{ asset('/backoffice/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="{{ asset('/backoffice/css/Admin.css') }}" rel="stylesheet" type="text/css" />

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="bg-black">

        <div class="form-box" id="login-box">
            <div class="header">Recuparar contraseña</div>
            @if ( ! Session::has('status'))  
            <form action="{{ route('reminder.sent') }}" method="post">
                <div class="body bg-gray">
                    <div class="form-group">
                        <input type="text" name="email" class="form-control" placeholder="Ingresar correo"/>
                    </div>
                    @if (Session::has('error'))                    	
		                <div class="alert alert-danger message-reminder" role="alert" style="margin-left:0">{{ Session::get('error'); }}</div>
		            @endif
                </div>                
                <div class="footer">                                                               
                    <button type="submit" class="btn bg-olive btn-block custom-buttom">RECUPERAR</button>                 
                </div>      
                
            </form>
            @else
            	<div class="alert alert-info  message-reminder" role="alert" style="margin-left:0">{{ Session::get('status'); }}</div>
            @endif
        </div>


        <!-- jQuery 2.0.2 -->
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
        <!-- Bootstrap -->
        <script src="{{ asset('/backoffice/js/bootstrap.min.js') }}" type="text/javascript"></script>        

    </body>
</html>