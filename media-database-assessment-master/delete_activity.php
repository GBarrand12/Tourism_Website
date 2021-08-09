<?php
	$activity_id = preg_replace('/[^0-9a-zA]-/','',$_GET['activity_id']);
	
	$get_activity_sql = "SELECT activity_title FROM activity WHERE activity_id = $activity_id";
	
	$get_activity_query = mysqli_query($dbc, $get_activity_sql);
	
	$rsGet_activity = mysqli_fetch_assoc($get_activity_query);
	$activity_title = $rsGet_activity['activity_title'];
	
	$del_activity_sql = "DELETE FROM activity WHERE activity_id = $activity_id";
	$del_activity_query = mysqli_query($dbc, $del_activity_sql);
	if ($del_activity_query && mysqli_affected_rows($dbc) > 0) {
		if (!headers_sent()) {
			header("Location: admin.php?page=delete_activity_success&activity_title=$activity_title");
			exit;
		} else {
			echo '<script type="text/javascript">';
			echo "window.location.href='admin.php?page=delete_activity_success&activity_title=$activity_title';";
			echo '</script>';
			echo '<noscript>';
			echo "<meta http-equiv='refresh'content'0;url='admin.php?page=delete_activity_success&activity_title=$activity_title' />";
			echo '</noscript>'; exit;
		}
		// header re-direct code ends here
	} else {
		echo "Sorry, your activity could not be deleted";
	}