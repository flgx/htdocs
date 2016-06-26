'use strict';

$(document).ready(function() {

	var markerOld = null;
var map = null;
var infoWindow = null;
	$("#tags").select2();

	$("#btn-show-map").on('click', function(){
		$('#selectCoordinatesModal').modal('show');
	});


function openInfoWindow(marker) {
    var markerLatLng = marker.getPosition();
    infoWindow.setContent([
        'La posicion del marcador es: ',
        markerLatLng.lat(),
        ', ',
        markerLatLng.lng(),
        'y haz click para actualizar la posici'
    ].join(''));
    infoWindow.open(map, marker);
    $('#lat_input').val(markerLatLng.lat());
    $('#lng_input').val( markerLatLng.lng());
}

function initialize() {
    var myLatlng = new google.maps.LatLng(-35.63399899856378,-61.715694125000037);
  
    var myOptions = {
      zoom: 4,
      center: new google.maps.LatLng(-39.1477868, -62.9157204),
      mapTypeId: google.maps.MapTypeId.ROADMAP
    };
    var mapDiv = document.getElementById('map_canvas');
 
    var map = new google.maps.Map(mapDiv, myOptions);
    $("#selectCoordinatesModal").on("shown.bs.modal", function () {
     var currentCenter = map.getCenter();
      google.maps.event.trigger(map, "resize");
      map.setCenter(currentCenter);
    });
    infoWindow = new google.maps.InfoWindow();
    var marker = new google.maps.Marker({
        position: myLatlng,
        draggable: true,
        map: map,
        title:"Ejemplo marcador arrastrable"
    });
 
    google.maps.event.addListener(marker, 'click', function(){
        openInfoWindow(marker);
    });   

}
  initialize();

});