<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <title>Ecoturismo Argentina</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
    <link href='http://fonts.googleapis.com/css?family=Oxygen' rel='stylesheet' type='text/css'>
    <!-- Bootstrap -->
    <link href="{{ asset('/app/css/bootstrap.css')}}" rel="stylesheet" media="screen">
    <!-- Alertify -->
    <link href="{{ asset('/backoffice/css/alertify/alertify.core.css') }}" rel="stylesheet" type="text/css" />        
    <link href="{{ asset('/backoffice/css/alertify/alertify.default.css') }}" rel="stylesheet" type="text/css" />
    
    <!--link rel="stylesheet" href="{{ asset('/app/css/whhg.css')}}"-->
    <link href="{{ asset('./app/css/font-awesome.css') }}" rel="stylesheet" />
    <link href="{{ asset('/app/css/ionicons.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('/backoffice/css/select2/select2.css') }}" rel="stylesheet" />
    <link href="{{ asset('/backoffice/css/select2/select2-bootstrap.css') }}" rel="stylesheet" />
    <link href="{{ asset('/app/css/jquery.raty.css') }}" rel="stylesheet" />
    <link href="{{ asset('/app/css/main.css')}}" rel="stylesheet" media="screen">
    <link href="{{ asset('/app/css/lightbox.css')}}" rel="stylesheet" media="screen">
    @yield('styles')
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]> <script src="{{ asset('/app/assets/js/html5shiv.js')}}"></script> <script src="{{ asset('/app/assets/js/respond.min.js')}}"></script> <![endif]-->
</head>
<body onload="initializeApp()">

    <div id="appWrapper">
        @include('app.layouts.header')
        @include('app.layouts.sidebar')
        @include('app.layouts.map')

    </div>

    @if(Auth::check())
        @include('app.layouts.profile-edit')
    @endif

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script
              src="https://code.jquery.com/jquery-2.2.2.min.js"
              integrity="sha256-36cp2Co+/62rEAAYHLmRCPIych47CvdM+uTBJwSzWjI="
              crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://code.jquery.com/ui/1.11.2/jquery-ui.min.js"></script>

    <script src="{{ asset('/app/js/lightbox.js') }}" type="text/javascript"></script>

<script>
    lightbox.option({
      'resizeDuration': 200,
      'wrapAround': true,
      'fadeDuration':100
    })
</script>
    <script>
      $.widget( "custom.catcomplete", $.ui.autocomplete, {
        _create: function() {
          this._super();
          this.widget().menu( "option", "items", "> :not(.ui-autocomplete-category)" );
        },
        _renderMenu: function( ul, items ) {
          var that = this,
            currentCategory = "";
          $.each( items, function( index, item ) {
            var li;
            if ( item.category != currentCategory ) {
              ul.append( "<li class='ui-autocomplete-category'>" + item.category + "</li>" );
              currentCategory = item.category;
            }
            li = that._renderItemData( ul, item );
            if ( item.category ) {
              li.attr( "aria-label", item.category + " : " + item.label );
            }
          });
        }
      });
    </script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="{{ asset('/app/js/bootstrap.js')}}"></script>
    <script src="{{ asset('/backoffice/js/plugins/select2/select2.min.js')}}"></script>

    <!--Google maps API linl-->
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=places&key=AIzaSyCsbzuJDUEOoq-jS1HO-LUXW4qo0gW9FNs&sensor=false&&language=es"></script>

    <!--script type="text/javascript" src="{{ asset('/app/js/owl.carousel.js')}}"></script-->
    <!--script type="text/javascript" src="{{ asset('/app/js/pxgradient-1.0.2.jquery.js')}}"></script>
    <!-- Alertify -->
    <script src="{{ asset('/backoffice/js/plugins/alertify/alertify.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('/app/js/jquery.raty.js') }}" type="text/javascript"></script>
    
    <script type="text/javascript">
        ALL_LOCATIONS =  [
            @foreach($allLocations as $location)
                {{
                    '{id:' . $location['id'] . 
                    ',tag_id:' . $location['tag_id'] . 
                    ',tag_name:"' . $location['tag_name'] . '"' .
                    ',name:"' . $location['name'] . '"' .
                    ',lat:' . $location['lat'] . 
                    ',lng:' . $location['lng'] . 
                    ',marker:"' . $location['marker'] .
                    '"},' 
                }}
            @endforeach
        ];
        ALL_LOCATIONS_IMG =  [
            @foreach($allLocationsImg as $location)
                {{
                    '{id:' . $location['id'] . 
                    ',tag_id:' . $location['tag_id'] . 
                    ',tag_name:"' . $location['tag_name'] . '"' .
                    ',name:"' . $location['name'] . '"' . 
                    ',image:"' . $location['image_id'] . '"' .
                    ',lat:' . $location['lat'] . 
                    ',lng:' . $location['lng'] . 
                    ',marker:"' . $location['marker'] .
                    '"},' 
                }}
            @endforeach
        ];
        DATA_SEARCH =  [
            @foreach($allLocations as $location)
                {{
                    '{id:' . $location['id'] . 
                    ',label:"' . $location['name'] . '"' .
                    ',category:"' . $location['tag_name'] .
                    '"},' 
                }}
            @endforeach
        ];

        $(document).on('ready', function(){
            $("#uploadBtn").on('change', function(){
                $('#img-text').html('Imagen seleccionada: ' + this.value);
            });
        });

    </script>
            <script type="text/javascript" src="{{ asset('/app/js/markercluster.js')}}"></script>

    <script type="text/javascript" src="{{ asset('/app/js/app.js')}}"></script>


    @include('app.layouts.flash')
    @include('app.layouts.modals')

    @yield('scripts')


    <script>
        @if(Session::has('showProfile'))
            $(document).on('ready', function (e) {
                showUser();
            });
        @endif

        @if($errors->has('image'))
            $(document).on('ready', function () {
                showUser();
                $('#modal-edit-profile').modal('show');
            });
        @endif
    </script>
<script>
  window.fbAsyncInit = function() {
    FB.init({
      appId      : '1179239822106494',
      xfbml      : true,
      version    : 'v2.6'
    });
  };

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "//connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));
</script>
</body>
</html>
