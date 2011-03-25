function sfGmapWidgetWidget(options){
  // this global attributes
  this.lng      = null;
  this.lat      = null;
  this.address  = null;
  this.map      = null;
  this.geocoder = null;
  this.marker   = null;
  this.options  = options;
 
  this.init();
}
 
sfGmapWidgetWidget.prototype = new Object();
 
sfGmapWidgetWidget.prototype.init = function() {
  // retrieve dom element
  this.lng      = jQuery("#" + this.options.longitude);
  this.lat      = jQuery("#" + this.options.latitude);
  this.address  = jQuery("#" + this.options.address);
  this.lookup   = jQuery("#" + this.options.lookup);
  this.initialLocation;
  this.ibiza = new google.maps.LatLng(38.9102, 1.4324);
  // this.ibiza = new google.maps.LatLng(40.69847032728747, -73.9514422416687);
 
  // create the google geocoder object
  this.geocoder = new google.maps.Geocoder();
 
  // create the map
  var myOptions = {
      center: this.ibiza,
      zoom: 13,
      mapTypeId: google.maps.MapTypeId.HYBRID
  };
  this.map = new google.maps.Map(jQuery("#" + this.options.map).get(0),myOptions);

  if (this.lat.val() && this.lng.val()) {
    this.initialLocation = new google.maps.LatLng(this.lat.val(), this.lng.val());
  }
  else {
    this.initialLocation = this.ibiza;
  }
 
  // cross reference object
  this.map.sfGmapWidgetWidget = this;
  this.geocoder.sfGmapWidgetWidget = this;
  this.lookup.get(0).sfGmapWidgetWidget = this;
 
  // add the default location
  this.marker = new google.maps.Marker({ position: this.initialLocation, map: this.map });
  this.map.setCenter(this.initialLocation,13);
 
  // bind the click action on the map
  google.maps.event.addListener(this.map, "click", function(event) {
    sfGmapWidgetWidget.activeWidget = this.sfGmapWidgetWidget;
    if (event.latLng != null) {
      sfGmapWidgetWidget.moveMarker(event.latLng);

      sfGmapWidgetWidget.activeWidget = this.sfGmapWidgetWidget;
      this.sfGmapWidgetWidget.geocoder.geocode({'latLng': event.latLng}, function(results, status) {
        if (status == google.maps.GeocoderStatus.OK) {
          if (results[1]) {
            sfGmapWidgetWidget.reverseLookupCallback(results[1].formatted_address);
          }
        }
      });
    }
  });
 
  // bind the click action on the lookup field
  this.lookup.bind('click', function(){
    sfGmapWidgetWidget.activeWidget = this.sfGmapWidgetWidget;
    this.sfGmapWidgetWidget.geocoder.geocode( {'address': this.sfGmapWidgetWidget.address.val()}, function(results, status) {
      if (status == google.maps.GeocoderStatus.OK) {
        sfGmapWidgetWidget.moveMarker(results[0].geometry.location);
      } else {
        // alert("Geocode was not successful for the following reason: " + status);
        alert("Address not found. " + status);
      }
    });

    return false;
  })
}
 
sfGmapWidgetWidget.activeWidget = null;
sfGmapWidgetWidget.moveMarker = function(point)
{
  // get the widget and clear the state variable
  var widget = sfGmapWidgetWidget.activeWidget;
  sfGmapWidgetWidget.activeWidget = null;
 
  widget.marker.setPosition(point);
  widget.map.setCenter(point, 13);
  widget.lat.val(point.lat());
  widget.lng.val(point.lng());
}
 
sfGmapWidgetWidget.reverseLookupCallback = function(address)
{
  // get the widget and clear the state variable
  var widget = sfGmapWidgetWidget.activeWidget;
  sfGmapWidgetWidget.activeWidget = null; 
 
  // update values
  widget.address.val(address);
}
