<?php

$file = "db/selected.txt";

// Open the file to get existing content
$current = file_get_contents($file);

// check if location already exist
$check = strpos( $current, $_POST["selection"] );

if( $check === false ) {

	// Append a location to the file
	$current .= $_POST["selection"] . "\t";

	// Write the contents back to the file
	file_put_contents($file, $current);
}
?>