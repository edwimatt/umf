'use strict';

var locations=[],
    map,
    marker,
    markersArr=[],
    markerClusterer = null,
    drawingManager,
    drawing_color=$('#favcolor').val(),
    params={
        search_latitude: parseFloat($('#search_latitude').val()),
        search_longitude: parseFloat($('#search_longitude').val())
    },
    infowindow,
    territory_arr=[],
    check_territory_arr=[],
    check_user_pin_arr=[],
    googleAutoComplete;

//date filter
$('.date_filter').change(function(e){
    e.preventDefault();
    var value = $(this).val();
    if( value == 'custom' ){
        $(this).parent().hide();
        $('#custom_date').show();
    } else {
        $('#custom_date').hide();
    }
})
//clear map filter
$('.clear_filter').click(function(){
    $('#custom_date').hide();
    $('.date_filter').parent().show();
    $('#search_pin_form').trigger("reset");
})

//add territory
$(".add_territory").click(function(e){
    $('.territory_list').css("display","none");
    $(".territory_form").css("display","flex");
})
//territory close
$('.territory-close').click(function(e){
    $('.territory_list').css("display","block");
    $(".territory_form").css("display","none");
    $(".edit_territory_form").css("display","none");
})
//user pin filer
$('#search_pin_form').submit( function(e){
    e.preventDefault();
    params = $(this).serialize()
    loadPins().then( function(){
        clusteringMarker()
    });
})
// territory form reset
$('.territory-close').click( function () {
    $('#add_territory_form').trigger("reset");
    $('#update_territory_form').trigger("reset");
})
// territory form submit
$( '#add_territory_form' ).submit( function(e){
    e.preventDefault();
    var geo_fence         = $('#territory_latlng').val();
    var favcolor          = $('#favcolor').val();
    var territory_title   = $('#territory_title').val();
    var territory_user_id = $('#territory_user_id').val();

    if( geo_fence == ''){
        alert("Kindly draw a territory on map");
    } else if( favcolor == '') {
        alert("color field id required");
    } else if( territory_title == '' ) {
        alert("Name field is required");
    } else if( territory_user_id == '' ){
        alert("Assign user field is required");
    } else{
        $.ajax({
            type:'POST',
            url: base_url + '/admin/territory/save',
            data: $(this).serialize(),
            beforeSend: function(){
                $('#overlay').show();
            },
            success: function(data){
                $('#overlay').hide();
                if( data.code == 200 ){
                    alert('Territory has been added successfully');
                    location.reload(true)
                } else {
                    alert( data.message );
                }
            }
        });
    }
})
//update territory
$('#update_territory_form').submit( function(e) {
    e.preventDefault();
    var geo_fence         = $(this).find('#territory_latlng').val();
    var favcolor          = $(this).find('#favcolor').val();
    var territory_title   = $(this).find('#territory_title').val();
    var territory_user_id = $(this).find('#territory_user_id').val();

    if( geo_fence == ''){
        alert("Kindly draw a territory on map");
    } else if( favcolor == '') {
        alert("color field id required");
    } else if( territory_title =='' ) {
        alert("Name field is required");
    } else if( territory_user_id == '' ){
        alert("Assign user field is required");
    } else{
        $.ajax({
            type:'POST',
            url: base_url + '/admin/territory/update',
            data: $(this).serialize(),
            beforeSend: function(){
                $('#overlay').show();
            },
            success: function(data){
                $('#overlay').hide();
                if( data.code == 200 ){
                    alert('Territory has been updated successfully');
                    location.reload(true)
                } else {
                    alert( data.message );
                }
            }
        });
    }

})

// territory color change event
$('.favcolor').change(function(){

    drawing_color = $(this).val();
    var territory_id  = $('[name="territory_id"]').val();

    if( territory_id != ''){
        if( territory_arr.length > 0 ){
            for( var i in territory_arr ){
                if( territory_arr[i].id == territory_id ){

                    // territory_arr[i].fillColor   = drawing_color
                    // territory_arr[i].strokeColor = drawing_color
                    //
                    // console.log('strokeColor',territory_arr[i].strokeColor);
                    // console.log('fillColor',territory_arr[i].fillColor);
                    //
                    // drawingManager.setOptions(territory_arr[i])
                    // drawingManager.setMap(map);
                }
            }
        }
    } else {
        drawingManager.setOptions({
            polygonOptions: {
                editable: true,
                draggable: false,
                strokeColor: drawing_color,
                strokeOpacity: 0.8,
                strokeWeight: 2,
                fillColor: drawing_color,
                fillOpacity: 0.35,
            }
        });
        drawingManager.setMap(map);
    }
})

$(document).on('click','.add_territory',function(){
    //drawing map
    drawingManager = new google.maps.drawing.DrawingManager({
        drawingMode: google.maps.drawing.OverlayType.POLYGON,
        drawingControl: false,
        drawingControlOptions: {
            position: google.maps.ControlPosition.TOP_CENTER,
            drawingModes: [
                google.maps.drawing.OverlayType.POLYGON,
            ],
        },
        polygonOptions: {
            editable: true,
            draggable: false,
            strokeColor: drawing_color,
            strokeOpacity: 0.8,
            strokeWeight: 2,
            fillColor: drawing_color,
            fillOpacity: 0.35,
        }
    });
    drawingManager.setMap(map);

    google.maps.event.addListener(drawingManager, 'overlaycomplete', function(event) {

        if (event.type == 'polygon') {
            let polygonArray = [];
            drawingManager.setMap(null);
            var overlay = event.overlay;
            var getPath = overlay.getPath();
            var coordinates_aray = getPath.getArray();          
            for(var index=0; index < getPath.getLength(); index++){
                var latLngObj = {};
                latLngObj.latitude  = coordinates_aray[index].lat();
                latLngObj.longitude = coordinates_aray[index].lng();
                polygonArray.push(latLngObj);
            }
            $('#territory_latlng').val(JSON.stringify(polygonArray));
            $('#add_center_point').val(JSON.stringify(calculateCenterPoint(polygonArray)));

            google.maps.event.addListener(getPath, 'set_at', function (event) {
                var coordinates_aray = getPath.getArray();
                for(var index=0; index < getPath.getLength(); index++){
                    var latLngObj = {};
                    latLngObj.latitude  = coordinates_aray[index].lat();
                    latLngObj.longitude = coordinates_aray[index].lng();
                    polygonArray.push(latLngObj);
                }
                $('#territory_latlng').val(JSON.stringify(polygonArray));
                $('#add_center_point').val(JSON.stringify(calculateCenterPoint(polygonArray)));
            });

            google.maps.event.addListener(getPath, 'insert_at', function (event) {
                var polygonArray = [];
                var coordinates_aray = getPath.getArray();
                for(var index=0; index < getPath.getLength(); index++){
                    var latLngObj = {};
                    latLngObj.latitude  = coordinates_aray[index].lat();
                    latLngObj.longitude = coordinates_aray[index].lng();
                    polygonArray.push(latLngObj);
                }
                $('#territory_latlng').val(JSON.stringify(polygonArray));
                $('#add_center_point').val(JSON.stringify(calculateCenterPoint(polygonArray)));
            });

        }
    });


})

$(document).on('click', '.user_pin_filter, .territory-close',function(){
    if( typeof drawingManager != 'undefined'){
        drawingManager.setMap(null);
    }
})

$(document).on('click', '.user_pin_filter',function(){
    if( $('#pills-filter').hasClass('show') ){
        $('#pills-tabContent').toggle();
    }
})

$(document).on('click','.territory', function(){
    if( $('#pills-terr').hasClass('show') ){
        $('#pills-tabContent').toggle();
    }
})

$(document).on( 'click','.edit_territory',function(e){
    e.preventDefault();
    var record = $(this).data('record');

    var LatLng = JSON.parse(record.geofence_detail);
        LatLng = { lat: LatLng[0].latitude, lng: LatLng[0].longitude }

    map.setCenter(LatLng);
    map.setZoom(13);

    var update_form = $('#update_territory_form');

    update_form.find('#favcolor').val(record.color);
    update_form.find('#universe').val(record.universe);
    update_form.find('#territory_title').val(record.title);

    update_form.find('[name="assignee_user_id[]"] option').each( function(){
        if( record.assignee_user.length > 0 ){
            var option = $(this);
            var assignee_user_id = $(this).val();
            for( var i in record.assignee_user ){
                if( record.assignee_user[i].id == assignee_user_id ){
                    option.prop('selected',true);
                }
            }
        }
    })
    update_form.find('[name="geofence_detail"]').val(record.geofence_detail);
    update_form.find('[name="territory_id"]').val(record.id);
    update_form.find('[name="center_point"]').val(record.center_point);

    $(".edit_territory_form").css("display","flex");
    $('.territory_list').css("display","none");

    //enable drawing manager tool
    drawingManager = new google.maps.drawing.DrawingManager({
        drawingMode: google.maps.drawing.OverlayType.POLYGON,
        drawingControl: false,
        drawingControlOptions: {
            position: google.maps.ControlPosition.TOP_CENTER,
            drawingModes: [
                google.maps.drawing.OverlayType.POLYGON,
            ],
        }
    });
   
    for( var teritory_index in territory_arr )
    {
        if( territory_arr[teritory_index].id == record.id ){

            let edit_territory = territory_arr[teritory_index];
            edit_territory.setOptions({
                editable: true,
            })

            let getPath = territory_arr[teritory_index].getPath();
            google.maps.event.addListener(getPath, 'set_at', function (event) {
                var polygonArray = [];
                var coordinates_aray = getPath.getArray();
                for(var index=0; index < getPath.getLength(); index++){
                    var latLngObj = {};
                    latLngObj.latitude  = coordinates_aray[index].lat();
                    latLngObj.longitude = coordinates_aray[index].lng();
                    latLngObj.lat       = coordinates_aray[index].lng();
                    latLngObj.lng       = coordinates_aray[index].lng();
                    polygonArray.push(latLngObj);
                }
                $('#edit_territory_latlng').val(JSON.stringify(polygonArray));
                $('#edit_center_point').val(JSON.stringify(calculateCenterPoint(polygonArray)));

            });

            google.maps.event.addListener(getPath, 'insert_at', function (event) {
                var polygonArray = [];
                var coordinates_aray = getPath.getArray();
                for(var index=0; index < getPath.getLength(); index++){
                    var latLngObj = {};
                    latLngObj.latitude  = coordinates_aray[index].lat();
                    latLngObj.longitude = coordinates_aray[index].lng();
                    latLngObj.lat       = coordinates_aray[index].lng();
                    latLngObj.lng       = coordinates_aray[index].lng();
                    polygonArray.push(latLngObj);
                }
                $('#edit_territory_latlng').val(JSON.stringify(polygonArray));
                $('#edit_center_point').val(JSON.stringify(calculateCenterPoint(polygonArray)));
            });
            break;
        }

    }

})

//move territory
$('.move_territory').click( function(e){
    e.preventDefault();
    var record = $(this).data('record');
    var LatLng = JSON.parse(record.geofence_detail);
    LatLng = { lat: LatLng[0].latitude, lng: LatLng[0].longitude }

    map.setCenter(LatLng);
    map.setZoom(15);
})

//delete territory
$('.delete_territory').click(function(e){
    e.preventDefault();
    var ele = $(this);
    var msg = confirm("Are you sure you want to continue?");
    if( msg ){
        $.ajax({
            type:'POST',
            url: base_url + '/admin/territory/delete',
            data: {id:ele.attr('id')},
            beforeSend : function () {
                $('#overlay').show()
            },
            success : function(data){
                $('#overlay').hide()
                alert(data.message);
                if( data.code == 200 ){
                    location.reload(true);
                }
            }
        });
    } else {
        return false
    }
})

//delete pin
$(document).on('click','.delete_pin',function(e){
    e.preventDefault()
    var element = $(this);
    var msg = confirm('Are you sure you want to continue?');
    if( msg ){
        $.ajax({
            type: 'POST',
            url: base_url + '/admin/user-pin/delete',
            data:{id:element.attr('id')},
            beforeSend : function(){
                $('#overlay').show();
            },
            success: function(data){
                $('#overlay').hide();
                alert(data.message);
                location.reload(true);
            }
        });
    } else {
        return false;
    }
})
//auto complete
function GoogleAutoComplete()
{
    googleAutoComplete = new google.maps.places.Autocomplete( document.getElementById('googleautocomplete') );
    googleAutoComplete.addListener('place_changed', fillInAddress);
}

function fillInAddress()
{
    var place = googleAutoComplete.getPlace();
    var lat   = place.geometry.location.lat();
    var long  = place.geometry.location.lng();

    $('#search_latitude').val(lat);
    $('#search_longitude').val(long);

    map.setCenter(new google.maps.LatLng(lat, long));
    map.setZoom(13);
}

function initMap()
{
    let myLatLng = { lat: params.search_latitude, lng: params.search_longitude};
    map = new google.maps.Map(document.getElementById("map"), {
        zoom: 13,
        center: myLatLng,
        mapTypeControlOptions: {
          position: google.maps.ControlPosition.TOP_CENTER,
        },
        zoomControlOptions: {
          position: google.maps.ControlPosition.RIGHT_TOP,
        },
        streetViewControlOptions: {
          position: google.maps.ControlPosition.LEFT_TOP,
        },
    });

    //map zoom in & out event
    map.addListener("zoom_changed", () => {
        $('#search_latitude').val(map.getCenter().lat());
        $('#search_longitude').val(map.getCenter().lng());
        loadPins().then( function(){
            clusteringMarker()
        });
        loadTerritory();
    });
    // map drag event
    map.addListener('dragend', () => {
        $('#search_latitude').val(map.getCenter().lat());
        $('#search_longitude').val(map.getCenter().lng());
        loadPins().then( function(){
            clusteringMarker()
        });
        loadTerritory();
    });

    if( user_pin != '' )
    {
        map.setCenter(new google.maps.LatLng(parseFloat(user_pin.latitude), parseFloat(user_pin.longitude)));
        map.setZoom(17);
    }

    loadPins().then( function(){
        clusteringMarker()
    });
    loadTerritory();
}

function clusteringMarker()
{
    if (markerClusterer) {
        markerClusterer.clearMarkers();
    }
    markerClusterer = new MarkerClusterer(map, markersArr, {
        imagePath:
            "https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/m",
    });
}

function getPins(cb)
{
    $.ajax({
        type:'GET',
        url: base_url + '/admin/map/get-pins',
        data:$('#search_pin_form').serialize(),
        beforeSend: function(){

        },
        success: function(data){
            cb(data)
        }
    });
}

function loadPins()
{
    $('#filter_error_msg').hide();
    return new Promise( function(resolve,reject){
        infowindow = new google.maps.InfoWindow();
        getPins( function(data) {
            //show validation message
            if( data.code != 200){
                let validation_msg_html = '<div class="alert alert-danger">';
                let validation_messages = Object.values(data.data);
                for( var index in validation_messages ){
                    validation_msg_html += '<p>'+ validation_messages[index] +'</p>';
                }
                validation_msg_html += '</div>';
                $('#filter_error_msg').html(validation_msg_html);
                $('#filter_error_msg').show();
                return;
            }
            //load pins
            let res = data.data;
            if (res.length > 0) {
                for (var i = 0; i < res.length; i++) {

                    if( check_user_pin_arr.indexOf(res[i].id) == -1 )
                    {
                        let pin_status_count;
                        if( res[i].pin_status_history === null || res[i].pin_status_history === ''){
                            pin_status_count = '0';
                        } else {
                            pin_status_count = res[i].pin_status_history.length.toString();
                        }
                        locations.push([res[i].house_address, res[i].latitude, res[i].longitude]);
                        const image = {
                            url: res[i].pin_status.image_url,
                        };

                        marker = new google.maps.Marker({
                            position: new google.maps.LatLng(res[i].latitude, res[i].longitude),
                            map: map,
                            icon: image,
                            user_pin_id:res[i].id,
                            user_pin:res[i],
                            label:pin_status_count
                        });

                        check_user_pin_arr.push(res[i].id)
                        markersArr.push(marker);

                        if( user_pin != '' )
                        {
                            if( res[i].id == user_pin.id )
                            {
                                var appointment_date;
                                var appointment_time;
                                if( res[i].appointment == null || res[i].appointment == '' || res[i].appointment.length == 0 ){
                                    appointment_date = '';
                                    appointment_time = '';
                                } else {
                                    appointment_date = moment(res[i].appointment.start_datetime).format('MM-DD-YYYY');
                                    appointment_time = res[i].appointment.start_datetime.split(' ')[1]
                                }
                                infowindow.setContent(`
                                <div class="info-box">
                                   <div class="d-flex justify-content-between">
                                      <h5 class="font-weight-bold" style="color:${res[i].pin_status.color};"> 
                                        <img src="${res[i].pin_status.image_url}" style="width:35px; height:35px; object-fit: contain;">
                                        ${res[i].pin_status.title} 
                                      </h5>
                                      <div><button onclick="pinDetailPopup(${res[i].id})" class="btn bg-orange">View</button></div>
                                   </div>
                                   <div class="d-flex justify-content-between pt-4">
                                      <div style="width: 70%;">
                                         <div class="ft-13">${res[i].house_address}</div>
                                      </div>
                                      <div>
                                         <div class="ft-13">${appointment_date}</div>
                                         <div class="ft-13">${appointment_time}</div>
                                      </div>
                                   </div>
                                </div>
                            `)
                                infowindow.open(map, marker);
                            }
                        }

                        google.maps.event.addListener(marker, 'click', (function (marker, i) {

                            return function () {
                                var appointment_date;
                                var appointment_time;
                                if( res[i].appointment == null || res[i].appointment == '' || res[i].appointment.length == 0 ){
                                    appointment_date = '';
                                    appointment_time = '';
                                } else {
                                    appointment_date = moment(res[i].appointment.start_datetime).format('MM-DD-YYYY');
                                    appointment_time = res[i].appointment.start_datetime.split(' ')[1]
                                }
                                infowindow.setContent(`
                            <div class="info-box">
                               <div class="d-flex justify-content-between">
                                  <h5 class="font-weight-bold" style="color:${res[i].pin_status.color};"> 
                                    <img src="${res[i].pin_status.image_url}" style="width:35px; height:35px; object-fit: contain;">
                                    ${res[i].pin_status.title} 
                                  </h5>
                                  <div><button onclick="pinDetailPopup(${res[i].id})" class="btn bg-orange">View</button></div>
                               </div>
                               <div class="d-flex justify-content-between pt-4">
                                  <div style="width: 70%;">
                                     <div class="ft-13">${res[i].house_address}</div>
                                  </div>
                                  <div>
                                     <div class="ft-13">${appointment_date}</div>
                                     <div class="ft-13">${appointment_time}</div>
                                  </div>
                               </div>
                            </div>
                        `)
                                infowindow.open(map, marker);
                            }
                        })(marker, i));
                    }
                }
            }else{
                for (let i = 0; i < markersArr.length; i++) {
                    markersArr[i].setMap(null);
                }
                markersArr = [];
                check_user_pin_arr = [];
            }
            resolve(true);
        });
    })
}

function pinDetailPopup(user_pin_id)
{
    $.ajax({
        type: 'GET',
        url: base_url + '/admin/user-pin/edit/' + user_pin_id,
        beforeSend : function(){
            $('#overlay').show();
        },
        success: function(data){
            $('#overlay').hide();
            $('#update_pin_modal').html(data)
            $('#pinDetail').modal('show');
        }
    });
}

function loadTerritory()
{
    $.ajax({
        type: 'GET',
        url: base_url + '/admin/territory/get',
        data:{latitude:params.search_latitude, longitude: params.search_longitude},
        success : function(data){
            if( data.code == 200 ){
                if( data.data.length > 0 ){
                    var territories = data.data;
                    for( var i=0; i < territories.length; i++ )
                    {
                        if( check_territory_arr.indexOf(territories[i].id) == -1)
                        {
                            var coordinates = [];
                            var latLng = JSON.parse(territories[i].geofence_detail);
                            for( var index in latLng ){
                                var obj = {
                                    lat: latLng[index].latitude,
                                    lng: latLng[index].longitude,
                                }
                                coordinates.push(obj);
                            }
                            var territory_polygon = new google.maps.Polygon({
                                map,
                                paths: coordinates,
                                strokeColor: territories[i].color,
                                strokeOpacity: 0.8,
                                strokeWeight: 2,
                                fillColor: territories[i].color,
                                fillOpacity: 0.1,
                                draggable: false,
                                geodesic: true,
                                title: territories[i].title,
                                id:territories[i].id
                            });

                            territory_arr.push(territory_polygon);
                            check_territory_arr.push(territories[i].id);

                            google.maps.event.addListener(territory_polygon, 'click', function (event) {
                                    let contentString = this.title;
                                    infowindow.setContent(contentString);
                                    infowindow.setPosition(event.latLng);
                                    infowindow.open(map);
                            });

                            google.maps.event.addListener(territory_polygon, 'mouseout', function (event) {
                                infowindow.open(false);
                            });

                        }
                    }
                }
            }
        }
    })
}

function calculateCenterPoint( points=[] )
{
    let latitude = 0;
    let longitude = 0;
    const n = points.length;
    for (const point of points) {
        latitude += point.latitude;
        longitude += point.longitude;
    }

    return {
        latitude: latitude / n, longitude: longitude / n
    }
}