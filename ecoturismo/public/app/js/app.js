"use strict";

var MAP;
var DIRECTION_DISPLAY;
var DIRECTION_SERVICE;
var OPEN_SIDEBAR= false;
var USER_MARKER= null;
var ALL_MARKERS = [] ;
var CURRENT_USER_LOCATION = null;
var CURRENT_MAP_LOCATION  = null;
var LAST_INFO_WINDOW_OPENED = null;
var autocomplete = null;
var places = null;
var markers = [];
var newMarkers = [];
var MarkerClusterArray =[];
var selectedMarker;
  var locationSelect;
var infowindow2;
var markerCluster=null;
var myfilter;
var Hospedajes = [];

$(document).on("ready", function(){
	$('.custom-btn-2x').hover(
		function(){
			$(this).css('color','#00aced');
		},
		function(){
			$(this).css('color','#5B8B06');
		}
	);
	showUser();
	$('[data-toggle="tooltip"]').tooltip();
	$('[data-toggle="popover"]').popover();
	$('.gm-style-iw').parent().css({top: '444px'});
	$('#btn-menu').on('click', showIndex);
	$('#btn-user').on('click', showUser);
	$('#btn-close-sidebar').on('click',closeSideBar);
	$('#btn-show-register').on('click',showRegister);
	$('#btn-show-login').on('click',showLogin);
	$('#btn-show-remind').on('click',showRemind);
	$('#btn-route').on('click',showRoutes);
	$('#btn-contact').on('click',showContact);
	$('.tag-menu').on('click',filterTag);
	$('.btn-foundLocation').on('click', foundLocation);
	$('#submit-editprofile').on('click', submitProfile);
	$("#route-start").select2();
	$("#route-end").select2();
    
	$('#calculate-route').on('click', function(event) {
		event.preventDefault();
		
		calculateRouteFromPanel();
	});

	$('#calculate-route-without-auth').on('click', function(event) {
		event.preventDefault();
		
		alertify.error("Para poder calcular una ruta, debe estar logeado");
	});

	$('#route-from-my-location').on('click', function(event){
		$('#start-route-container').toggle();
	});

	$('#btn-showAllLocations').on('click', function(event) {
		event.preventDefault();
		showAllLocations();
	});

    $.each($('.ranking'), function(index, value){
    	var currentRanking = $(this).attr('data-ranking');

		$(this).raty({ score: currentRanking, readOnly: true });
    });
});

function initializeApp() {

	locationSelect = document.getElementById("locationSelect");
    locationSelect.onchange = function() {
        var markerNum = locationSelect.options[locationSelect.selectedIndex].value;
        if (markerNum != "none"){
          google.maps.event.trigger(ALL_MARKERS[markerNum], 'click');
        }
      };
	DIRECTION_SERVICE = new google.maps.DirectionsService();
	DIRECTION_DISPLAY = new google.maps.DirectionsRenderer();

    //Map parametrs
  	var mapOptions = {
        zoom: 4,
        mapTypeId: google.maps.MapTypeId.ROADMAP,

        mapTypeControl: false,
        mapTypeControlOptions: {
            style: google.maps.MapTypeControlStyle.HORIZONTAL_BAR,
            //position: google.maps.ControlPosition.BOTTOM_RIGHT
        },
        panControl: false,
        panControlOptions: {
            position: google.maps.ControlPosition.TOP_RIGHT
        },
        zoomControl: true,
        zoomControlOptions: {
            style: google.maps.ZoomControlStyle.LARGE,
            position: google.maps.ControlPosition.RIGHT_BOTTOM
        },
        scaleControl: false,
        scaleControlOptions: {
            position: google.maps.ControlPosition.TOP_LEFT
        },
        streetViewControl: true,
        streetViewControlOptions: {
            position: google.maps.ControlPosition.RIGHT_BOTTOM
        }
    }

    //map
    MAP = new google.maps.Map(document.getElementById("map_canvas"), mapOptions);

    DIRECTION_DISPLAY.setMap(MAP);
  	DIRECTION_DISPLAY.setPanel(document.getElementById('routes-directions-panel'));

 	google.maps.event.addListener(MAP, "rightclick",function(event){showContextMenu(event.latLng)});
 	google.maps.event.addListener(MAP, "click",function(event){closeAllInfoWindow()});

    setLocationInit();
    setMarkers();
   
	autocomplete = new google.maps.places.Autocomplete(
		/** @type {HTMLInputElement} */(document.getElementById('input-search')),
		{
			types: ['(cities)'],
			componentRestrictions: {'country': 'ar'}
		});
	places = new google.maps.places.PlacesService(MAP);

	google.maps.event.addListener(autocomplete, 'place_changed', onPlaceChanged);
	markerCluster= new MarkerClusterer(MAP,newMarkers,{imagePath: 'images/m'});


}

function showContextMenu(currentMapLocation) {
	var contextmenuDir;
	var projection = MAP.getProjection() ;

	//CURRENT_MAP_LOCATION = {lat:location.coords.latitude, lng:location.coords.longitude};

	$('.contextmenu').remove();
	contextmenuDir = document.createElement("div");
    contextmenuDir.className  = 'contextmenu';
    contextmenuDir.innerHTML = '<ul class="dropdown-menu" role="menu" style="display:block !important;">'
							+  '<li><a onClick="foundMe()" id="contextmenu-btn-search-me" href="#"><i style="cursor:pointer" class="fa fa-binoculars"></i>&nbsp; Buscar mi posición</a></li>'
							+ '<li><a onClick="calculateRouteFromMap()" id="contextmenu-btn-calculate-route" href="#"><i style="cursor:pointer" class="fa fa-road"></i>&nbsp; Calcular Ruta desde mi ubicación</a></li>'
							+ '</ul>';

 	$(MAP.getDiv()).append(contextmenuDir);

 	$('.contextmenu').on('mouseleave', function(){
 		removeContextMenu();
 	});

 	$('.contextmenu').on('click', function(){
 		removeContextMenu();
 	});

 	setMenuXY(currentMapLocation);

 	contextmenuDir.style.visibility = "visible";
}

function removeContextMenu()
{
	$('.contextmenu').remove();
}

function getCanvasXY(caurrentLatLng){
    var scale 	= Math.pow(2, MAP.getZoom());
    var nw 		= new google.maps.LatLng(
        MAP.getBounds().getNorthEast().lat(),
        MAP.getBounds().getSouthWest().lng()
    );
      
    var worldCoordinateNW 		= MAP.getProjection().fromLatLngToPoint(nw);
    var worldCoordinate 		= MAP.getProjection().fromLatLngToPoint(caurrentLatLng);
    var caurrentLatLngOffset 	= new google.maps.Point(
        Math.floor((worldCoordinate.x - worldCoordinateNW.x) * scale),
        Math.floor((worldCoordinate.y - worldCoordinateNW.y) * scale)
    );
    
    return caurrentLatLngOffset;
}

function setMenuXY(caurrentLatLng){
    var mapWidth = $('#map_canvas').width();
    var mapHeight = $('#map_canvas').height();
    var menuWidth = $('.contextmenu').width();
    var menuHeight = $('.contextmenu').height();
    var clickedPosition = getCanvasXY(caurrentLatLng);
    var x = clickedPosition.x ;
    var y = clickedPosition.y ;

    if((mapWidth - x ) < menuWidth) {
        x = x - menuWidth;
    }
    
    if((mapHeight - y ) < menuHeight){
        y = y - menuHeight;
    }

    $('.contextmenu').css('left',x - 5);
    $('.contextmenu').css('top',y - 5);
};

function addLoading(selector, loaderContainerId) {

	$(selector).html('<p id="' + loaderContainerId + '" class="text-center"><img src="./app/img/ajax-loader.gif" /><br>Cargando...</p>');	

}

function hideLoading() {
	$('#loader-container').hide();
}

function filterTag(e) {
	e.preventDefault();

	$('.tag-menu').removeClass('tag-active');
	$(this).addClass('tag-active');

	if($(this).attr('data-id') != 0) {
		getChildrenTags($(this).attr('data-id'));
	}	
}

function closeAllInfoWindow() {
	$.each(ALL_MARKERS, function(index, value){
		value.marker.infowindow.close();
	});
}

function foundMe() {
	MAP.setCenter(new google.maps.LatLng(CURRENT_USER_LOCATION.lat, CURRENT_USER_LOCATION.lng));

	if(USER_MARKER != null) {
		USER_MARKER.infowindow.open(MAP,USER_MARKER);
	}

	MAP.setZoom(6);
	closeAllInfoWindow();
	closeSideBar();
}

function showLocationOnMap(id) {
	$.each(ALL_MARKERS, function(index, value){

		var marker = value.marker;		
		marker.infowindow.close();

		if(value.data.id == id) {			
			MAP.setCenter(marker.getPosition());
			marker.infowindow.open(MAP, marker);
			setLastInfoWindowOpened(marker.infowindow);
			centerMarker(value.data);
		} 
	});

	closeSideBar();
}

function foundLocation(event) {
	event.preventDefault();

	var id = $(this).attr('data-id');

	showLocationOnMap(id);
}

function showIndex() {
	showSideBar(350, $('#index-content'));
}

function showRoutes() {
	showSideBar(600, $('#routes-content'));
}
function showContact() {
	showSideBar(600, $('#contact-content'));
}

function showChildrenTagContainer() {
	$('#all-points').hide();
	$('#filter-points').hide();
	$('#children-tag-content').show();
}

function showFilterPointsContainer (){
	$('#children-tag-content').hide();
	$('#filter-points').show();
}

function showAllLocations() {
	$('#children-tag-content').hide();
	$('#filter-points').hide();
	$('#all-points').show();	
	showAllMarkers();
}

function showLocationDetail() {
	showSideBar(600, $('#location-content'));
}

function showUser() {
	var userContent = $('#user-content');

	if(userContent.length > 0) {
		showSideBar(600, $('#user-content'));
	} else {
		showSideBar(600, $('#profile-content'));
	}		
}

function showRegister(event) {
	event.preventDefault();
	$('.sidebar-content').hide();
	$('#register-content').show();
}

function showLogin(event) {
	event.preventDefault();
	$('.sidebar-content').hide();
	$('#user-content').show();
}
function showRemind(event) {
	event.preventDefault();
	$('.sidebar-content').hide();
	$('#remind-content').show();
}

function showSideBar(leftValue, objectContent) {
	hideLastInfoWindowsOpened();
	$('#sidebar').css("width",leftValue + 'px');
	$('#sidebar').css("max-width", '90%');
	$('#main-menu').css("left",'0px');
	$('.sidebar-content').hide();

	if(OPEN_SIDEBAR == true) {
		$('#sidebar').removeClass("open-sidebar").delay(260).queue(function(next){

	    	$(this).addClass("open-sidebar").delay(100).queue(function(next){
	    		objectContent.show();
	    		next();
	    	});

	    	next();
		});
	} else {
		$('#sidebar').addClass("open-sidebar").delay(100).queue(function(next){
    		objectContent.show();
    		next();
    	});

		OPEN_SIDEBAR = true;
	}
}

function closeSideBar() {
	$('#sidebar').removeClass('open-sidebar');
	OPEN_SIDEBAR = false;
}

function setMarkers() {
	$.each(ALL_LOCATIONS, function( index, value ) {
		
		addMarker(index, value);	
	});
}
function getLocationImages(id){
	var images = [];
		$.each(ALL_LOCATIONS_IMG, function( index, value ) {
			if(id == value.id && value.image != null && value.image != ''){
				images.push(value.image);
			}		
		});
	return images;
}
var images= [];
function getFilter(){

		return myfilter;
}
function showFilterMarkers(filter) {

	if(markerCluster){
		hideAllMarker();

		hideAllCluster();
	}


	$.each(ALL_MARKERS, function(index, value) {
		if($.inArray(value.data.id, filter) >= 0) {
			addMarkerCluster(index,value);
			value.marker.setMap(MAP);
		}
	});
	var markerCluster2= new MarkerClusterer(MAP,MarkerClusterArray,{imagePath: 'images/m'});




}

function addMarkerCluster(index, value) {
	var icon   = './app/img/icon/' + value.marker;

  	var contentString = '<div class="window-content">'+
  	'<strong>' + value.name + '</strong>' +
  	'<hr>';
	images = getLocationImages(value.id);
	var oneimage;

	var count = 0;
	if(images.length > 0) {
		
		$.each(images, function( index, image) {
		// crear funcion que pasando el value.id me devuelve todas las imagenes
		  	
				
				if(count == 0 ){
					contentString += '<a href="assets/images/location/' + image + '" data-lightbox="image-1"><img src="assets/images/location/' + image + '"  width="100%" /></a><br>';		
				}
				else{
					contentString += '<a href="assets/images/location/' + image + '" data-lightbox="image-1"></a><br>';		

				}
			
		  		
		  	
			count ++;
			oneimage = image;
		});
	
	}else {
	  		contentString += '<img src="./app/img/no-image.png"  width="100%" /><br>';	  		
	}		

  	contentString += '<a href="assets/images/location/' + oneimage + '" data-lightbox="image-1" id="link-show-location-detail" class=" link-info"><i class="fa fa-picture-o"></i>&nbsp;Ver todas las imagenes</a><br>' +'<a href="#" id="link-calculate-route-'+value.id+'" onclick="calculateRouteFromMarker(' +value.id+ ', '+ value.lng +', '+ value.lat +')" class=" link-info"><i class="fa fa-road"></i>&nbsp;Calcular ruta desde mi posición</a><br>'+
  	'<a href="#"  id="link-show-location-detail" onclick="getInfoLocation(' +value.id+ ')" class=" link-info"><i class="fa fa-plus"></i>&nbsp;Ver más información</a>'+'</div>';

	var infowindow = new google.maps.InfoWindow({
	    content: contentString,
	    zIndex: 99999,
	    maxWidth: 300,
	});

	var marker = new google.maps.Marker({
  		position: new google.maps.LatLng(value.lat, value.lng),
  		map: MAP,
  		title: value.name,
  		category: icon,
  		data: value,
  		icon: icon,
  		infowindow: infowindow
	});

	google.maps.event.addListener(marker, 'click', function() {

  		selectedMarker=marker;
  		hideLastInfoWindowsOpened();
  		infowindow.open(MAP,marker);
  		setLastInfoWindowOpened(infowindow);
  		closeSideBar();
  		centerMarker(value);
  		//searchLocations(marker);
  	});

  	MarkerClusterArray.push(marker);

}

function addMarker(index, value) {
	var icon   = './app/img/icon/' + value.marker;

  	var contentString = '<div class="window-content" >'+
  	'<strong>' + value.name + '</strong>' +
  	'<hr>';
	images = getLocationImages(value.id);
	var oneimage;

	var count = 0;
	if(images.length > 0) {
		
		$.each(images, function( index, image) {
		// crear funcion que pasando el value.id me devuelve todas las imagenes
		  	
				
				if(count == 0 ){
					contentString += '<a href="assets/images/location/' + image + '" data-lightbox="image-1"><img src="assets/images/location/' + image + '"  width="100%" /></a><br>';		
				}
				else{
					contentString += '<a href="assets/images/location/' + image + '" data-lightbox="image-1"></a><br>';		

				}
			
		  		
		  	
			count ++;
			oneimage = image;
		});
	
	}else {
	  		contentString += '<img src="./app/img/no-image.png"  width="100%" /><br>';	  		
	}		

  	contentString += '<a href="assets/images/location/' + oneimage + '" data-lightbox="image-1" id="link-show-location-detail" class=" link-info"><i class="fa fa-picture-o"></i>&nbsp;Ver todas las imagenes</a><br>' +'<a href="#" id="link-calculate-route-'+value.id+'" onclick="calculateRouteFromMarker(' +value.id+ ', '+ value.lng +', '+ value.lat +')" class=" link-info"><i class="fa fa-road"></i>&nbsp;Calcular ruta desde mi posición</a><br>'+
  	'<a href="#"  id="link-show-location-detail" onclick="getInfoLocation(' +value.id+ ')" class=" link-info"><i class="fa fa-plus"></i>&nbsp;Ver más información</a>'+'</div>';

	var infowindow = new google.maps.InfoWindow({
	    content: contentString,
	    zIndex: 99999,
	    maxWidth: 300,
	    pixelOffset: new google.maps.Size(0,20)
	});

	var marker = new google.maps.Marker({
  		position: new google.maps.LatLng(value.lat, value.lng),
  		map: MAP,
  		title: value.name,
  		category: icon,
  		data: value,
  		icon: icon,
  		infowindow: infowindow
	});

	google.maps.event.addListener(marker, 'click', function() {

  		selectedMarker=marker;
  		hideLastInfoWindowsOpened();
  		infowindow.open(MAP,marker);
  		setLastInfoWindowOpened(infowindow);
  		closeSideBar();
  		//centerMarker(value);
  		MAP.setCenter(marker.getPosition());
  		//searchLocations(marker);
  	});

  	newMarkers.push(marker);
  	ALL_MARKERS.push({data:value, marker:marker});
  

}

	function searchLocations(marker) {

		var location = new google.maps.LatLng(marker.data.lat,marker.data.lng);

		var geocoder = new google.maps.Geocoder();
		geocoder.geocode({location: location}, function(results, status) {
		if (status == google.maps.GeocoderStatus.OK) {
		  searchLocationsNear(results[0].geometry.location);
		} else {
		  alert(address + ' not found');
		}
		});
	}
   function clearLocations() {
     //infowindow2.close();
     for (var i = 0; i < markers.length; i++) {
       markers[i].setMap(null);
     }
 		markers.length = 0;

     locationSelect.innerHTML = "";
     var option = document.createElement("option");
     option.value = "none";
     option.innerHTML = "See all results:";
     locationSelect.appendChild(option);
   }
   function doNothing() {}
   function createOption(name, distance, num) {
      var option = document.createElement("option");
      option.value = num;
      option.innerHTML = name + "(" + distance.toFixed(1) + ")";
      locationSelect.appendChild(option);
    }
 	var images2;
    function createMarker2(latlng, name, id, location_id) {

      var html = "<b>" + name;
      var marker = new google.maps.Marker({
        map: MAP,
        position: latlng,
        icon:'./app/img/icon/13.png'
      });
  	var contentString = '<div class="window-content">'+
  	'<strong>' + name + '</strong>' +
  	'<hr>';
	images = getLocationImages(location_id);

	var oneimage = null;

	var count = 0;
	if(images.length > 0) {
		
		$.each(images, function( index, image) {
		// crear funcion que pasando el value.id me devuelve todas las imagenes
			if(count == 0 ){
				contentString += '<a href="assets/images/location/' + image + '" data-lightbox="image-1"><img src="assets/images/location/' + image + '"  width="100%" /></a><br>';		
			}
			else{
				contentString += '<a href="assets/images/location/' + image + '" data-lightbox="image-1"></a><br>';
			}
			count ++;
			oneimage = image;
		});
	}else{
	  	contentString += '<img src="./app/img/no-image.png"  width="100%" /><br>';	  		
	}		
	contentString += '<a href="assets/images/location/' + oneimage + '" data-lightbox="image-1" id="link-show-location-detail" class=" link-info"><i class="fa fa-picture-o"></i>&nbsp;Ver todas las imagenes</a><br>' +'<a href="#" id="link-calculate-route-'+location_id+'" onclick="calculateRouteFromMarker(' +location_id+ ', '+ latlng.lng() +', '+ latlng.lat() +')" class=" link-info"><i class="fa fa-road"></i>&nbsp;Calcular ruta desde mi posición</a><br>'+
  	'<a href="#"  id="link-show-location-detail" onclick="getInfoLocation(' + id + ')" class=" link-info"><i class="fa fa-plus"></i>&nbsp;Ver más información</a>'+'</div>';

    var infowindow2 = new google.maps.InfoWindow({
	    content: contentString,
	    zIndex: 99999,
	    masWidth: 300,
	    pixelOffset: new google.maps.Size(0,20)
	 });

      google.maps.event.addListener(marker, 'click', function() {
      	MAP.setZoom(6);
		MAP.panTo(marker.position);
        infowindow2.open(MAP, marker);
        hideLastInfoWindowsOpened();
  		infowindow2.open(MAP,marker);

  		MAP.setCenter(marker.getPosition());
  		setLastInfoWindowOpened(infowindow2);
  		closeSideBar();
      });
      markers.push(marker);
    }
   function searchLocationsNear(center) {
	 clearLocations();
	 hideAllMarker();
     var radius = 200;
     var id = 0;
     var location_id = 0;
     var testArray = [];
     var searchUrl = 'phpsqlsearch_genxml.php?lat=' + center.lat() + '&lng=' + center.lng() + '&radius=' + radius;
     downloadUrl(searchUrl, function(data) {
         if(data != ''){
       var xml = parseXml(data);

       var markerNodes = xml.documentElement.getElementsByTagName("marker");
       testArray = Array.prototype.slice.call(markerNodes);
       var bounds = new google.maps.LatLngBounds();
       for (var i = 0; i < markerNodes.length; i++) {
         var name = markerNodes[i].getAttribute("name");
         id = parseFloat(markerNodes[i].getAttribute("id"));
         location_id = parseFloat(markerNodes[i].getAttribute("location_id"));
         var distance = parseFloat(markerNodes[i].getAttribute("distance"));
         var latlng = new google.maps.LatLng(
              parseFloat(markerNodes[i].getAttribute("lat")),
              parseFloat(markerNodes[i].getAttribute("lng")));

         createOption(name, distance, i);
         createMarker2(latlng, name, id, location_id);
         bounds.extend(latlng);

       }
       MAP.fitBounds(bounds);
       locationSelect.style.visibility = "visible";
       locationSelect.onchange = function() {
         var markerNum = locationSelect.options[locationSelect.selectedIndex].value;
         google.maps.event.trigger(markers[markerNum], 'click');
       };
      }else{alert("No hay hospedajes cerca.");} 
      });
    }
    function downloadUrl(url, callback) {
      var request = window.ActiveXObject ?
          new ActiveXObject('Microsoft.XMLHTTP') :
          new XMLHttpRequest;

      request.onreadystatechange = function() {
        if (request.readyState == 4) {
          request.onreadystatechange = doNothing;
          callback(request.responseText, request.status);
        }
      };

      request.open('GET', url, true);
      request.send(null);
    }

    function parseXml(str) {
      if (window.ActiveXObject) {
        var doc = new ActiveXObject('Microsoft.XMLDOM');
        doc.loadXML(str);
        return doc;
      } else if (window.DOMParser) {
        return (new DOMParser).parseFromString(str, 'text/xml');
      }
    }
function createMarker(place) {


    
	var placeLoc = place.geometry.location;
	var marker = new google.maps.Marker({
    map: MAP,
    position: place.geometry.location,
    infowindow:infowindow

  });
  infowindow = new google.maps.InfoWindow();

   google.maps.event.addListener(marker, 'click', function() {

    infowindow.setContent(place.name);
    infowindow.open(MAP, this);
  });


}
function callback(results, status) {

  if (status === google.maps.places.PlacesServiceStatus.OK) {

    for (var i = 0; i < results.length; i++) {
      createMarker(results[i]);
      searchLocationsNear(results[0].geometry.location);
    }		
  }
}

function centerMarker(data) {
	var lat = data.lat + 5;
	var lng = data.lng ;

	setCenterLocation(lat, lng);
}

function hideLastInfoWindowsOpened() {
	if(LAST_INFO_WINDOW_OPENED != null) {
		LAST_INFO_WINDOW_OPENED.close();
	}
}


function setLastInfoWindowOpened(infoWindow) {
	LAST_INFO_WINDOW_OPENED = infoWindow;
}

function hideAllMarker() {
	$.each(ALL_MARKERS, function(index, value) {
		value.marker.setMap(null);
	});
}

function hideAllCluster() {
		markerCluster.clearMarkers();
}

function showAllMarkers() {
	$.each(ALL_MARKERS, function(index, value) {
		value.marker.setMap(MAP);
	});
}

function toggleBounce() {

  if (marker.getAnimation() != null) {
    marker.setAnimation(null);
  } else {
    marker.setAnimation(google.maps.Animation.BOUNCE);
  }
}

function getInfoLocation(id) {

	addLoading('#location-content', 'loader-container');
	$('#location-content').load('./' + id + '/location-info', function(){
		var currentRanking = $('#ranking').attr('data-ranking');
		var readOnly 	   = $('#ranking').attr('data-readonly');

    	if(readOnly) {
    		$('#ranking').raty({ score: currentRanking, click: vote, readOnly: true });
    		$('#ranking').on('click', function(){
    			alertify.error("Para poder calificar el punto interactivo, debe estar logeado.");
    		});
    	} else {
    		$('#ranking').raty({ score: currentRanking, click: vote});
    	}
		
	});
	showLocationDetail();
}

function vote(score, evt) {
	
	var locationId = $('#ranking').attr('data-location-id');

	$.ajax({
		type: "POST",
		url: 'http://ecoturismo.com.ar/ranking',
		data: {ranking: score, location_id: locationId},
		success: function (){
			alertify.success("Su votación se ha realizao con éxito, gracias por participar.");
			$('#ranking').raty({ score: score,  readOnly: true });
		},
		dataType: 'json'
	});
}

function sendComment(comment, locationId) {

	$('#btn-comment').hide();
	$('#load-comment').show();
	addLoading('#load-comment', '');


	$.ajax({
		type: "POST",
		url: 'http://ecoturismo.com.ar/comment',
		data: {comment: comment, location_id: locationId},
		success: function (data){
		
			$('#load-comment').hide();

			switch(data.success) {
				case true:
					alertify.success("Su comentario se ha realizao con éxito, gracias por participar.");
					$('#input-comment').attr('disabled', 'disabled');
					break;
				case false:
					$('#btn-comment').show();
					alertify.error("Su comentario no se ha podido realizar, por favor intente más tarde.");
					break;
				default:
					$('#btn-comment').show();
					alertify.error("Su comentario no se ha realizado, debido a que ha utilizado palabras inadecuadas, por favor modifique su comentario.");
			}
		},
		dataType: 'json'
	});
}

function getChildrenTags(id) {
	addLoading('#children-tag-content', 'loader-container');
	

	$('#children-tag-content').load('./' + id + '/children-tag');
	showChildrenTagContainer();
}

function getChildrenLocations(childrenTagId) {
	addLoading('#filter-points', 'loader-container');
	$('#filter-points').load('./' + childrenTagId + '/children-location');
	showFilterPointsContainer();
}

function setLocationInit() {

    var geolocation = navigator.geolocation;

    if(geolocation) {
       geolocation.getCurrentPosition(setUserLocation, setArgentinaLocation);
    } else {
        setArgentinaLocation();
    }
}

function setUserLocation(location) {
	CURRENT_USER_LOCATION = {lat:location.coords.latitude, lng:location.coords.longitude};

	var contentString = '<div class="window-user-content"><strong><i class="fa fa-user"></i>&nbsp; Ustede se encuentra aqui</strong></div>';

    var infowindow = new google.maps.InfoWindow({
	    content: contentString,
	    zIndex: 99999,
	});

	var marker = new google.maps.Marker({
  		position: new google.maps.LatLng(CURRENT_USER_LOCATION.lat, CURRENT_USER_LOCATION.lng),
  		map: MAP,
  		title: 'Su ubicación',
  		value:{id:0},
  		infowindow: infowindow
	});


	google.maps.event.addListener(marker, 'click', function() {
  		hideLastInfoWindowsOpened();
  		infowindow.open(MAP,marker);
  		setLastInfoWindowOpened(infowindow);
  		closeSideBar();
  	});

    setCenterLocation(CURRENT_USER_LOCATION.lat, CURRENT_USER_LOCATION.lng);
    USER_MARKER = marker;
}

function setArgentinaLocation() {
    var argentina  = {lat:-38.1477868, lng:-62.9157204};

    setCenterLocation(argentina.lat, argentina.lng);
}

function setCenterLocation(lat, lng) {
    var location = new google.maps.LatLng(lat, lng);

    MAP.setCenter(location);
}

function calculateRouteFromPanel() {
	var fromMyLocation    = $('#route-from-my-location').is(":checked");
	var start 		  	  = document.getElementById('route-start').value;
  	var end   		  	  = document.getElementById('route-end').value;

	if(fromMyLocation == true) { 		
		start = CURRENT_USER_LOCATION.lat + ',' +CURRENT_USER_LOCATION.lng;
	}

  	if(start == 0 || end == 0) {
  		alertify.error("Para calcular una ruta debe seleccionar desde y hasta, por favor intente nuevamente.");
  		hideLoading();
  		return false;
  	}

  	calculateRoute(start, end);
}

function calculateRouteFromMap() {

	if($('#route-from-my-location').is(':checked') == false) {
		$('#route-from-my-location').trigger('click');
	}

	showRoutes();
}
function getNearbyPlaces(){
	searchLocations(selectedMarker);
}
function calculateRouteFromMarker(linkId, lng, lat) {

	var link = $('link-calculate-route-' + linkId);

	if($('#route-from-my-location').is(':checked') == false) {
		$('#route-from-my-location').trigger('click');
	}

    $('#route-end').val(lat+ ',' +lng).trigger("change");
    $('#calculate-route').trigger('click');

	showRoutes();
}

function showRoutePanel() {
	addLoading('#routes-directions-panel', 'loader-container');
	$('#route-fieldset-container').show();
}

function calculateRoute(start, end) {
	hideLastInfoWindowsOpened();
	showRoutePanel();

    var travelMode 		= google.maps.TravelMode.DRIVING;
    var unitSystemType	= google.maps.UnitSystem.METRIC;

  	var request = {
    	origin: start,
    	destination: end,
    	travelMode: travelMode,
    	unitSystem: unitSystemType
  	};


  	DIRECTION_SERVICE.route(request, function(response, status) {
 
    	if (status == google.maps.DirectionsStatus.OK) {
      		DIRECTION_DISPLAY.setDirections(response);
      		hideLoading()
    	} else {
    		alertify.error("No se ha podido calcular la ruta especificada, por favor comuniquese con el administrador");
    		hideLoading()
    	}
  	});

  	$('#view-route-map').show();
}


/* SEARCH BY CITY */
// When the user selects a city, get the place details for the city and
// zoom the map in on the city.
function onPlaceChanged() {
	var place = autocomplete.getPlace();
	if (place.geometry) {
		MAP.panTo(place.geometry.location);
		MAP.setZoom(6);
		search();
	} else {
		document.getElementById('input-search').placeholder = 'Buscar por ciudad';
	}

}

// Search for hotels in the selected city, within the viewport of the map.
function search() {
	showAllLocations();
}

function submitProfile (e) {

	$('#form-editprofile').submit();
	addLoading('#modal-edit-profile .modal-body', 'loader-container');
}