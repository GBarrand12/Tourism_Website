<?php
	// Get the activity id from the form
	$activity_id = $_POST['activity_id'];
	if(!$activity_id) {
		echo "Please choose an activity to delete ...";
		echo "<p><a href='admin.php?page=adminpanel' class='button'>Back to Admin Panel</a></p>";
		exit;
		
	} 
	else {
		$activity_sql = "SELECT activity_title FROM activity WHERE activity_id = $activity_id";
		
		$activity_query = mysqli_query($dbc, $activity_sql);
		
		$rsActivity = mysqli_fetch_assoc($activity_query);
	}
	
?>

<h2>Delete activity - Confirm</h2>
<p>Do you REALLY want to delete <?php echo $rsActivity['activity_title']; ?> from the database?</p>

<div class="row">
	<a href="admin.php?page=delete_activity&activity_id=<?php echo $activity_id;?>" class="small_button">Yes - delete</a>
	<a href="admin.php?page=adminpanel" class="small_button cancel">Cancel</a>
</div> <!-- end row div -->