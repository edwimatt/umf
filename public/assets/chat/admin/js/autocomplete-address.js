var placeSearch, autocomplete;
function initAutocomplete() {
    autocomplete = new google.maps.places.Autocomplete( document.getElementById('autocomplete') );
    autocomplete.addListener('place_changed', fillInAddress);
}
function fillInAddress()
{
    var place = autocomplete.getPlace();
    var lat = place.geometry.location.lat();
    var long = place.geometry.location.lng();
    $('#longitude').val(long);
    $('#latitude').val(lat);

    //get territory
    if( territories.length > 0 ){
        for( var i=0; i < territories.length; i++ )
        {
            var triangleCoords = [];
            var ploygon_arr    = territories[i].ploygon_arr;
            for(var p=0; p < ploygon_arr.length; p++){
                var obj = {
                    lat: ploygon_arr[p].latitude,
                    lng: ploygon_arr[p].longitude,
                }
                triangleCoords.push(obj);
            }
            var bermudaTriangle = new google.maps.Polygon({ paths: triangleCoords });

            var result = google.maps.geometry.poly.containsLocation(
                place.geometry.location,
                bermudaTriangle
            );
            if( result ){
                $('#territory_id').val(territories[i].id)
                break;
            }
        }
    } else {
        $('#territory_id').val(0);
    }
    //get place detail
    if ( place.address_components ) {
        for( var index in place.address_components ){
            if( place.address_components[index].types[0] == 'administrative_area_level_1' ){
                $('input[name="state"]').val(place.address_components[index].short_name)
            }
            if( place.address_components[index].types[0] == 'locality' ){
                $('input[name="city"]').val(place.address_components[index].short_name)
            }
            if( place.address_components[index].types[0] == 'postal_code' ){
                $('input[name="zipcode"]').val(place.address_components[index].short_name)
            }
        }
    }
}