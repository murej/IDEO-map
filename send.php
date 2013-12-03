<?php

	// empty currently selected location info
	$f = @fopen("db/curr.txt", "r+");
	if ($f !== false) {
	    ftruncate($f, 0);
	    fclose($f);
	}

	$email = $_POST;
	
	$selectedLocations = explode("\t", file_get_contents("db/selected.txt"));
	unset($selectedLocations[count($selectedLocations)-1]);
	
	$locationData = json_decode(file_get_contents("db/locations.json"), true);

	// If email not yet entered
	if( empty($_POST) == true ) {
		
?>
	<form action="index.php" method="post">
		<h2>Please enter your email address:</h2>
		<input name="email" type="text">
		<button type="submit" class="button">Send locations</button>
	</form>
	
<?php
	
	}
	// if email already entered
	else {
	
		$to = $_POST["email"];
		
		// for each location selected
		foreach($selectedLocations as $value) {
			
			$i++;
			
			// define URL parameters
			$locations .= "markers=label:" . $i . "%7C" . urlencode($locationData[$value][address]) . "&";
			
			// define HTML
			$locationHTML .= "<h1>" . $i . ": " . $locationData[$value][name] . "</h1>\n<h2>" . $locationData[$value][address] . "</h2>\n<p>" . $locationData[$value][tips] . "</p>\n";
		}
		
		$subject = "Things to do while in Munich";
		
		$message = '
<html>
<head>
</head>
<body>
<img src="http://maps.googleapis.com/maps/api/staticmap?' . $locations . 'markers=icon:http://s22.postimg.org/67m01qp9p/IDEO_icon.png%7CKellerstr.%2027,%20Munich&zoom=14&size=600x500&sensor=false&key=AIzaSyDvgGaf_Mw4lMOnChANCcsm2z7ylMrzO1c">
' . $locationHTML . '
<h2>Enjoy your day!</h2f>
<p> &ndash; IDEO Munich
</body>
</html>';

		// To send HTML mail, the Content-type header must be set
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
		
		// Additional headers
		$headers .= 'From: IDEO Munich <munich@ideo.com>' . "\r\n";
		
		$send = mail( $to, $subject, $message, $headers );
		
		if($send == true) {
			echo "<h2>Email sent.</h2>";
			// empty selected locations
			$f = @fopen("db/selected.txt", "r+");
			if ($f !== false) {
			    ftruncate($f, 0);
			    fclose($f);
			}
		}
		else {
			echo "<h1>Sending failed!<h1>\n<h2>Please enter your email again.</h2>";
		}
		
	}
		
?>