<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en" class="no-js">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
<meta charset="utf-8"/>
<title>Event Map</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="width=device-width, initial-scale=1" name="viewport"/>
<meta content="" name="description"/>
<meta content="" name="author"/>
<link rel="Stylesheet" type="text/css" href="/assets/css/awesomplete.css"/>
<script src="/assets/js/awesomplete.js" async></script>
<script
  src="https://code.jquery.com/jquery-1.12.4.min.js"
  integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ="
  crossorigin="anonymous"></script>

	<style type="text/css">
	    ::selection{ background-color: #E13300; color: white; }
	    ::moz-selection{ background-color: #E13300; color: white; }
	    ::webkit-selection{ background-color: #E13300; color: white; }
	    body {
	        background-color: #fff;
	        margin: 40px;
	        font: 13px/20px normal Helvetica, Arial, sans-serif;
	        color: #4F5155;
	    }
	    a {
	        color: #003399;
	        background-color: transparent;
	        font-weight: normal;
	    }
	    h1 {
	        color: #444;
	        background-color: transparent;
	        border-bottom: 1px solid #D0D0D0;
	        font-size: 19px;
	        font-weight: normal;
	        margin: 0 0 14px 0;
	        padding: 14px 15px 10px 15px;
	    }
	    code {
	        font-family: Consolas, Monaco, Courier New, Courier, monospace;
	        font-size: 12px;
	        background-color: #f9f9f9;
	        border: 1px solid #D0D0D0;
	        color: #002166;
	        display: block;
	        margin: 14px 0 14px 0;
	        padding: 12px 10px 12px 10px;
	    }
	    #body{
	        margin: 15px;
	    }
	    p.footer{
	        text-align: right;
	        font-size: 11px;
	        border-top: 1px solid #D0D0D0;
	        line-height: 32px;
	        padding: 0 10px 0 10px;
	        margin: 20px 0 0 0;
	    }
	    #container{
	        margin: 10px;
	        border: 1px solid #D0D0D0;
	        -webkit-box-shadow: 0 0 8px #D0D0D0;
	    }

	    #map_wrapper{
	    	height: 500px;
	    }
	</style>

</head>
<body>
	<h2>Event Map</h2>
	<div>
		<form action="/event/search" method="post">
			<input type="text" name="city_name" value="" class="awesomplete" list="city_list" />
			<datalist id="city_list">
				<?php foreach ($city_list as $item) { ?>
					<option><?php echo $item['search'];?></option>
				<?php } ?>
			</datalist>
			<input type="submit" value="Search">
		</form>

		<hr/>		
		<?php if (isset($city_name)) { ?>
		<h4>Search Result for <?php echo $city_name; ?></h4>
		<div id="map_wrapper"></div>
		<div>
			<table>
				<tr>
					<form action="/event/search" method="post">
						<td>
							<button type="submit">
								<img src="https://cdn2.iconfinder.com/data/icons/font-awesome/1792/sort-amount-asc-128.png" style="width: 30px;">
							</button>
						</td>
						<td>
								<input type="hidden" name="event_order" value="<?php echo $event_order; ?>"/>
								<input type="hidden" name="city_name" value="<?php echo $city_name; ?>"/>
								<input type="text" name="event_filter" value=""/>
								<input type="submit" value="Filter">
						</td>
					</form>						
				</tr>
				<?php if(isset($event_list)){ ?>
					<?php foreach ($event_list as $item) { ?>
					<tr>
						<td>
							<img src="https://cdn1.iconfinder.com/data/icons/ui-navigation-1/152/marker-128.png" style="width: 50px;">
						</td>
						<td>
							<span><?php echo $item['title']; ?></span><br/>
							<span><?php echo $item['start_date']; ?> - <?php echo $item['end_date']; ?></span>
						</td>
					</tr>
					<?php } ?>
				<?php } ?>
			</table>
		</div>
		<?php } ?>
	</div>
    <script>
      var map;
      function initMap() {
        map = new google.maps.Map(document.getElementById('map_wrapper'), {
          center: {lat: <?php echo $location['lat'];?>, lng: <?php echo $location['lon'];?>},
          zoom: 10
        });

        var infoWindow = new google.maps.InfoWindow;

          // Change this depending on the name of your PHP or XML file
        var xml = $.parseXML('<?php echo $event_list_xml;?>');
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
        });

      }
    </script>	
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDwqiVx_277NiKSoKxEEz28R2ZAEid37qw&callback=initMap" async defer></script>	
</body>
</html>