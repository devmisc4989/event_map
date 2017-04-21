      	var map;
		var gmarkers = [];

      function initMap() {
        map = new google.maps.Map(document.getElementById('map_wrapper'), {        
          center: {lat: -34.397, lng: 150.644},
          zoom: 10
        });
  	  }
		var ajax = new XMLHttpRequest();
		ajax.open("GET", "/event/city_list", true);
		ajax.onload = function() {
			var list = JSON.parse(ajax.responseText).map(function(i) { return i.search; });
			new Awesomplete(document.querySelector("#city_name"),{ list: list });
		};
		ajax.send();      

	jQuery(document).ready(function() {
		$('#search_city').click(function(e){
			e.preventDefault();
			getEvents({city_name: $('#city_name').val()});
		});		

		$('#filter_event').click(function(e){
			e.preventDefault();
			getEvents({
					city_name: $('#param_city_name').val(),
					event_filter: $('#param_event_filter').val()
					});
		});		

		$('#filter_date').click(function(e){
			e.preventDefault();
			getEvents({
					city_name: $('#param_city_name').val(),
					event_filter: $('#param_event_filter').val(),
					event_order: $('#param_event_order').val()
					});
		});		

      	function getEvents(param){
	      $.ajax({
	        url: "/event/search",
	        type: "post",
	        datatype: 'json',
	        data: param,
	        success: function(data){
	            $('.pagination-wrapper').pagination({
	                dataSource: data.event_list,
	                pageSize: 15,
	                callback: function(data, pagination) {
	                    var template = '<table>';
	                    for(var i = 0; i < data.length; i++){
	                    	template += '<tr><td><img src="https://cdn1.iconfinder.com/data/icons/ui-navigation-1/152/marker-128.png" style="width: 50px;"></td><td><span>' + data[i].title + '</span><br/><span>' + data[i].start_date + ' - ' + data[i].end_date + '</span></td></tr>'
	                    }
	                    template += '</table>';
	                    $('.test-content-wrapper').html(template);
	                }
	            });                
	            if($('.pagination-wrapper').pagination('getTotalPage') == 1){
	              $('.pagination-wrapper').pagination('hide');
	            }

	            $('#param_city_name').val(data.city_name);
	            $('#param_event_order').val(data.event_order);

	         // Google Map		         	
	         	initialMap(data);
	        },
	        error:function(){
	        }   
	      });			

      	}
      	
      	function initialMap(data){
      		removeMarkers();
      		map.setCenter(new google.maps.LatLng(data.location.lat, data.location.lon));
	        var infoWindow = new google.maps.InfoWindow;
	          // Change this depending on the name of your PHP or XML file
	        var xml = $.parseXML(data.event_list_xml);
	        var markers = xml.documentElement.getElementsByTagName('marker');
	        Array.prototype.forEach.call(markers, function(markerElem) {        	
		          var point = new google.maps.LatLng(
		              parseFloat(markerElem.getAttribute('lat')),
		              parseFloat(markerElem.getAttribute('lon')));

		          var infowincontent = document.createElement('div');
		          var text = document.createElement('text');
		          text.textContent = markerElem.getAttribute('title')
		          infowincontent.appendChild(text);
		          var marker = new google.maps.Marker({
		            map: map,
		            position: point
		          });
		          marker.addListener('click', function() {
		            infoWindow.setContent(infowincontent);
		            infoWindow.open(map, marker);
		          });
		          gmarkers.push(marker);
		    });		         
      	}

		function removeMarkers(){
		    for(i=0; i<gmarkers.length; i++){
		        gmarkers[i].setMap(null);
		    }
		}

	});