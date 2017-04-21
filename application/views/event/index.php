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
<link rel="stylesheet" type="text/css" href="/assets/pagination/pagination.css"/>
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
		<input type="text" name="city_name" value="" class="awesomplete" id="city_name"/>
		<input type="button" value="Search" id="search_city">

		<hr/>		
		<div id="map_wrapper"></div>

		<h4>Search Result for <span id="search_city_name"></span></h4>
		<div>
			<table>
				<tr>
					<td>
						<button type="submit" id="filter_date">
							<img src="https://cdn2.iconfinder.com/data/icons/font-awesome/1792/sort-amount-asc-128.png" style="width: 30px;">
						</button>
					</td>
					<td>
							<input type="hidden" id="param_event_order" value="asc"/>
							<input type="hidden" id="param_city_name" value=""/>
							<input type="text" id="param_event_filter" value=""/>
							<input type="submit" value="Filter"  id="filter_event">
					</td>
				</tr>
			</table>
		</div>

		<div class="test-content-wrapper"></div>
		<div class="pagination-wrapper"></div>

	</div>
	<script src="/assets/js/event_map.js"></script>
	<script src="/assets/pagination/pagination.js"></script>
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDwqiVx_277NiKSoKxEEz28R2ZAEid37qw&callback=initMap" async defer></script>	
</body>
</html>