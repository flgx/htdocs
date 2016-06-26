<header>
<nav class="navbar navbar-default mynav" style="margin-bottom: 0px;">
  <div class="container-fluid" id="nav-container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="/"><img src="{{ asset('/app/img/logo.png')}}" class="logo pull-left" alt="Naturaleza Argentina" /></a>
    </div>

	  <!-- Collect the nav links, forms, and other content for toggling -->
	  <div class="collapse navbar-collapse " id="bs-example-navbar-collapse-1">
		  <center>
			  <ul id="navbar-items" class="nav navbar-nav navbar-right">
				  <li  class="nav-item" data-toggle="tooltip" data-placement="left" title="Puntos interactivos">
					  <div id="btn-menu" class="custom-btn-2x"><i class="fa fa-map-marker fa-2x"></i></div>
				  </li>
				  <li class="nav-item" data-toggle="tooltip" data-placement="left" title="Calcular Ruta">
					  <div id="btn-route" class="custom-btn-2x"><i class="fa fa-road fa-2x"></i></div>
				  </li>
				  <li class="nav-item" data-toggle="tooltip" data-placement="left" title="Usuario">
					  <div id="btn-user" class="custom-btn-2x" ><i class="fa fa-user fa-2x" style="padding-right: 5px;"></i></div>
				  </li>
				  <li class="nav-item" data-toggle="tooltip" data-placement="left" title="Contacto">
					  <div id="btn-contact" class="custom-btn-2x btn-email " ><i class="fa fa-envelope fa-2x " style="padding-right: 3px;"></i></div>
				  </li>
			  </ul>
		  </center>
		  <form class="navbar-form navbar-right" role="search" style="padding: 0px 45px;">
			  <div id="search-input-group" class="input-group">
				  <input type="text" class="form-control" id="input-search" placeholder="Buscar por ciudad">
				  <span class="input-group-addon" style="width: 30px"><i class="fa fa-search"></i></span>
			  </div>
		  </form>
	  </div>
	  <!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
</header>