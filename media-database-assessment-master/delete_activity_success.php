<?php
// Get name from $_GET, ensuring only allowed characters
$activity = preg_replace('/[^0-9a-zA]-/','',$_GET['activity_title']);
// Div has class of success to format nicely
echo "<div class='success'>
		<h3>You have successfully deleted the activity $activity!</h3>
	</div>";
	
?>
<p><a class="small_button" href="admin.php?page=logout">Logout</a>
<a class="small_button" href="admin.php?page=adminpanel">Admin Panel</a></p>