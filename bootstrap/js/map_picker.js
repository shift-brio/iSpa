var zoomed = 13,map, infoWindow;  
function initMap(lat,lng,map_id = "map"){
if (lat && lng) {
  var mapCenter = new google.maps.LatLng(lat,lng);
}else{
  var mapCenter = new google.maps.LatLng(0.1768696,37.9083264);
}
var myOptions = {
  zoom: zoomed,
  center: mapCenter,
  gestureHandling: 'cooperative',
  mapTypeId: google.maps.MapTypeId.ROADMAP
};
map = new google.maps.Map(document.getElementById(map_id),
  myOptions);    
var k = {
  map: map,        
  /*title: place.address,*/
  position: {
    lat:function(){
      return lat
    },
    lng:function(){
      return lng;
    }
  }
};
setMarkerLocation(k);
}
function initialize() {
var mapCenter = new google.maps.LatLng(0.1768696,37.9083264);
var myOptions = {
  zoom: 8,
  center: mapCenter,
  gestureHandling: 'cooperative',
  mapTypeId: google.maps.MapTypeId.ROADMAP
};
map = new google.maps.Map(document.getElementById("map"),
  myOptions);
initAutocomplete(map); 
infoWindow = new google.maps.InfoWindow;     
}
function initAutocomplete(map) {                            
  // Cvar marker = false;reate the search box and link it to the UI element.
  var input = document.getElementById('location-search');
  var searchBox = new google.maps.places.SearchBox(input);
  /*map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);*/    

  // Bias the SearchBox results towards current map's viewport.
  map.addListener('bounds_changed', function() {
    searchBox.setBounds(map.getBounds());
  });

  var markers = [];
  // Listen for the event fired when the user selects a prediction and retrieve
  // more details for that place.
  searchBox.addListener('places_changed', function() {         
    var places = searchBox.getPlaces();

    if (places.length == 0) {
      return;
    }

    // Clear out the old markers.
    markers.forEach(function(marker) {
      marker.setMap(null);
    });
    markers = [];

    // For each place, get the icon, name and location.
    var bounds = new google.maps.LatLngBounds();
    places.forEach(function(place) {
      if (!place.geometry) {
        console.log("Returned place contains no geometry");
        return;
      }
      var icon = {
        url: place.icon,
        size: new google.maps.Size(71, 71),
        origin: new google.maps.Point(0, 0),
        anchor: new google.maps.Point(17, 34),
        scaledSize: new google.maps.Size(25, 25)
      };

      // Create a marker for each place.
      var chaged_marker = {
        map: map,
        icon: icon,
        title: place.formatted_address,
        position: place.geometry.location,
        draggable: true
      };
      markers.push(new google.maps.Marker());

      if (place.geometry.viewport) {
        // Only geocodes have viewport.
        bounds.union(place.geometry.viewport);
      } else {
        bounds.extend(place.geometry.location);
      }
      mk = chaged_marker;
    });                
    map.fitBounds(bounds);
    setMarkerLocation(mk);
    $(".selected-location").attr("data-location-name",mk.title);
    $(".selected-location").html(mk.title);
    $(".selected-location").attr("data-location",mk.position);
  });
  google.maps.event.addListener(map, 'click', function(event) {  
    //Get the location that the user clicked.
    var clickedLocation = event.latLng;    
    //If the marker hasn't been added.
    marker = new google.maps.Marker({
        position: clickedLocation,
        map: map,          
        draggable: true //make it draggable
    });
    //Listen for drag events!
    google.maps.event.addListener(marker, 'dragend', function(event){
        setMarkerLocation(marker);
    });
    //Get the marker's location.                
    setMarkerLocation(marker);      
  }); 
}
function setMarkerLocation(marker = false){
  if (marker) {
    var currentLocation = marker.position; 
    var map = new google.maps.Map(document.getElementById('map'), {
      zoom: 9,
      center: {lat: currentLocation.lat(), lng: currentLocation.lng()}
    });
    var geocoder = new google.maps.Geocoder;
    var infowindow = new google.maps.InfoWindow;

    geocodeLatLng(geocoder, map, infowindow,currentLocation.lat()+","+currentLocation.lng());              
  }
}
function geocodeLatLng(geocoder, map, infowindow,latLng) {
  var input = latLng;
  var latlngStr = input.split(',', 2);
  var latlng = {lat: parseFloat(latlngStr[0]), lng: parseFloat(latlngStr[1])};
  geocoder.geocode({'location': latlng}, function(results, status) {
    if (status === 'OK') {        
      if (results[0]) {
        map.setZoom(18);
        var marker = new google.maps.Marker({
          position: latlng,
          title:results[0].formatted_address,
          map: map,
          draggable: true
        });          
        initAutocomplete(map);
        $(".selected-location").attr("data-location-name",marker.title);
        $(".selected-location").html(marker.title);
        $(".selected-location").attr("data-location",marker.position.lat()+","+marker.position.lng());
        var cityCircle = new google.maps.Circle({
          strokeColor: '#FF0000',
          strokeOpacity: 0.8,
          strokeWeight: 2,
          fillColor: '#FF0000',
          fillOpacity: 0.35,
          map: map,
          center: results[0].geometry.location,
          radius: Math.sqrt(results[0].population) * 100
        });
        $(".location-search").val(marker.title);
      } else {
        window.alert('No results found');
      }
    } else {
      window.alert('Geocoder failed due to: ' + status);
    }
  });    
} 
$(document).ready(function(){
  $(".map-near").click(function(){
    notify("Make sure location is turned on");
    if (navigator.geolocation) {
      navigator.geolocation.getCurrentPosition(function(position) {
        var pos = {
          lat: position.coords.latitude,
          lng: position.coords.longitude
        };          
        infoWindow.setPosition(pos);
        var inM = {
          map: map,                           
          position: {
            lat:function(){
              return pos.lat
            },
            lng:function(){
              return pos.lng;
            }
          }
        };
        setMarkerLocation(inM)          
        map.setCenter(pos);          
      }, function() {
        handleLocationError(true, infoWindow, map.getCenter());
      });
    } else {
      // Browser doesn't support Geolocation
      handleLocationError(false, infoWindow, map.getCenter());
    }
  })
  function handleLocationError(browserHasGeolocation, infoWindow, pos) {
    infoWindow.setPosition(pos);
    infoWindow.setContent(browserHasGeolocation ?
      'Error: The Geolocation service failed.' :
      'Error: Your browser doesn\'t support geolocation.');
    infoWindow.open(map);
  }
})  