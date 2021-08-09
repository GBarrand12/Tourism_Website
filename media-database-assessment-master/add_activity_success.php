<?php
$activity = preg_replace('/[^0-9a-zA]-/','',$_GET['activity']);
$activity_id =  preg_replace('/[^0-9a-zA]-/','',$_GET['activity_id']);
echo "<div class='success'><h3>Your activity $activity has been added!</h3></div><!-- /sucess -->";

?>
<p>
	<a href='admin.php?page=adminpanel' class='small_button'>Back to Admin Panel</a>
	
	<a href='admin.php?page=logout' class='small_button'>Log Out</a>

</p>