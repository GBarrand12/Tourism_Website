<h1>Admin Panel</h1>
<div class="center">
	<hr>
	<h2>Activities</h2>
	<!-- Add Activity -->
	<h3>Add Activity</h3>
	<!-- Button to go to a form to add an activity-->
	<p>Press the button to go to a form to add an activity</p>
	<a class="small_button" href="admin.php?page=add_activity">Add an activity</a>
	
	<h3>Edit Activity</h3>
	<form method="post" action="admin.php?page=edit_activity">
		<p>Select an activity to edit and press the button to go to a form to edit that activity.</p>
		<b>Edit: </b><select name="activity_id">
		<?php
			// Put code here to query activities in a loop
			// EDIT ACTIVITY QUERY
			//NEED TO TEST THIS QUERY
			// set up query
			$edit_sql = "SELECT activity_id, activity_title FROM activity";
			// run query
			$edit_query = mysqli_query($dbc, $edit_sql);
			// test if query worked
			if(!$edit_query) {
				echo "Sorry there is no result for activity";
			} else {
				//loop through to create the list of activities as options
				while($rsEdit = mysqli_fetch_assoc($edit_query)) {
					echo '<option value="'.$rsEdit['activity_id'].'">'.$rsEdit['activity_title'].'</option>';
				}
			}
		?>
		</select>

		<input type="submit" value="Edit activity" class="small_button">
	</form>
	
	
	<h3>Delete Activity</h3>
	<p>Select an activity to delete</p>
	<form method="post" action="admin.php?page=delete_activity_confirm">
		<b>Delete: </b><select name="activity_id">
		<?php
			// Put code here to query activities in a loop
			// DELETE CLOTHING_TYPES OPTIONS QUERY
			// set up query
			$delete_sql = "SELECT activity_id, activity_title FROM activity";
			// run query
			$delete_query = mysqli_query($dbc, $delete_sql);
			// test if query worked
			if(!$delete_query) {
				echo "Sorry there is no result for activity";
			} else {
				//loop through to create the list of clothing types as options
				while($rsDelete = mysqli_fetch_assoc($delete_query)) {
					echo '<option value="'.$rsDelete['activity_id'].'">'.$rsDelete['activity_title'].'</option>';
				}
			}
		?>
		</select>
		
		<input type="submit" value="Delete activity" class="small_button">
	</form>
	
	<br>
	<hr>
	
	<h2>Inquiries</h2>
	<p>Press the button to see the inquiries submitted</p>
	<!-- Button to go to page which displays the inquiries -->
	<a class="small_button" href="admin.php?page=display_inquiries">Display Inquiries</a>
	
	<br>
	<hr>
	<a href='admin.php?page=logout' class='small_button' style="margin: 10px;">Log Out</a>
</div>