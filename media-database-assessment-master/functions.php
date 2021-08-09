<?php

// function to 'clean' data

function test_input($data) {
	//prevent injection of characters that might prevent inserting to database
	$link = mysqli_connect('localhost', 'tourism_admin', 'Cheese123', 'tourism');
	$data = mysqli_real_escape_string($link, $data);
	// remove unnecessary blank spaces
	$data = trim($data);
	// to correct special character rendering
	$data = htmlspecialchars($data);
	return $data;
}

?>