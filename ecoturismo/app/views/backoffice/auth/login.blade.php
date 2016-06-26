<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Administrador</title>
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
    <body>
        <div class="navbar navbar-default navbar-fixed-top bg-red" role="navigation">
            <div class="container">
                <p class="header-login text-center"></p>
            </div>
        </div>

        <div class="form-box" id="login-box">
            <div class="header">Bienvenido</div>
            <form action="{{ route('login') }}" method="post">
                <div class="body">
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-user"></i></div>
                            <input type="text" name="email" class="form-control" placeholder="Ingresar correo"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-lock"></i></div>
                            <input type="password" name="password" class="form-control" placeholder="Ingresar clave"/>
                        </div>
                    </div>          
		            @if (Session::has('login_error'))
		                <div class="alert alert-danger" role="alert"><i class="fa fa-lock"></i>Credenciales <b>no válidas</b></div>
		            @endif
                </div>                
                <div class="footer">                                                               
                    <button type="submit" class="btn btn-in bg-red btn-block">INGRESAR</button>
                    <p><a class="custom-link" href="{{ route('reminder') }}">Olvidé mi contraseña</a></p>                      
                </div>                
            </form>
        </div>


        <!-- jQuery 2.0.2 -->
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
        <!-- Bootstrap -->
        <script src="{{ asset('/backoffice/js/bootstrap.min.js') }}" type="text/javascript"></script>        

    </body>
</html>