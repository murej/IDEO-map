<!DOCTYPE HTML>
<html>

	<head>
	
		<title>Atlas</title>
		
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="viewport" content="width=device-width, user-scalable=no">
		<meta name="apple-mobile-web-app-status-bar-style" content="black">
		
		<link rel="stylesheet" type="text/css" href="reset.css">
		<link rel="stylesheet" type="text/css" href="style.css">
		
		<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
		
		<script type="text/javascript">
		
			$(document).ready(function(){
			
				var selection;

				// prevent elastic scrolling effect
				document.ontouchmove = function(event){
				    event.preventDefault();
				}

				// initialise interface 		TODO: check if anything already added to selection, display on add button
<?php
				// if email posted
				if( empty($_POST["email"]) == false ) {
?>					
					$("div#location-details").hide();
					$("div#email-wrapper").show();
					
					$.post("send.php", { email: "<?php echo $_POST["email"] ?>" }, function(result) {
						$("div#email-wrapper").html(result);
					});
<?php
				}
				// if email not yet posted
				else {
?>
					//$("div#location-details").show();
					$("div#email-wrapper").hide();
<?php
				}
?>	
				// GET LOCATIONS ///////////////////////////				
				$.getJSON("db/locations.json", function(locations) {
																													
					// check for selection change every 0.5s
					
					setInterval( function(){
					
						$.get('db/curr.txt', function(result) {
						
							// if changed
							if(result != selection) {
							
								// if result has value
								if(result.length != 0) {
									$("div#email-wrapper").hide();
								}
								// if no value
								else {
									$("div#location-details").hide();
									selection = "";
								}
								
								// CHANGE SELECTED LOCATION
								$("img#category").attr("src", locations[result].category);
								$("h1#name").html(locations[result].name);
								$("h2#address").html(locations[result].address);
								$("p#tips").html(locations[result].tips);
								$("p#recommendedBy").html(locations[result].recommendedBy);
								$("p#likedBy").html(locations[result].likedBy);
															
								$("div#location-details").show();
								
								selection = result;
							}
						});
						
					}, 500)
				
				});
				
				// add location to selection when button pressed
				$("a#add.button").click(function(){
					event.preventDefault();
					$.post("add.php", "selection="+selection);
					
					$.get('db/selected.txt', function(data) {
						var selectedItems = data.split("\t").length - 1;
						$("a#add").html("Add ("+selectedItems+")");
					});
				});
				
				$("a#finish.button").click(function(event){

					event.preventDefault();
					
					$("div#location-details").hide();
					$("div#email-wrapper").show();
					
					$.get("send.php", function(result) {
						$("div#email-wrapper").html(result);
					});
					
					$("a#add").html("Add");
					
				});
								
			});
			
		</script>
		
	</head>
	
	<body>
	
		<div id="email-wrapper"></div>
		
		<div id="location-details">
		
			<img src="" id="category">
			
			<div id="info">
			
				<h1 id="name"></h1>
				
				<h2 id="address" class="sub"></h2>
				
				<p id="tips"></p>
				
				<h2>Recommended</h2>
		
				<p id="recommendedBy"></p>
				
				<h2>Liked</h2>
		
				<p id="likedBy"></p>
			
			</div>
			
			<div id="buttons">
			
				<a href="#" id="add" class="button">Add</a>
				
				<a href="#" id="finish" class="button">Done</a>
			
			</div>

		</div>

	</body>
	
</html>