<?php
// Get name from $_GET, ensuring only allowed characters
$activity = preg_replace('/[^0-9a-zA]-/','',$_GET['activity_title']);

	
echo "<div class='success'><h3> Your activity $activity_title has been edited!</h3></div><!-- /success -->";
	echo "<p>
			<a href='admin.php?page=adminpanel' class='small_button'>Back to Admin Panel</a>
			<a href='admin.php?page=logout' class='small_button'>Log Out</a>
		</p>";

?>
