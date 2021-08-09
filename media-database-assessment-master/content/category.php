<!-- Page to display all of the activities in a category -->
<?php
		//Assign category id from URL to a variable
		$category_id = $_GET['category_id'];
		// echo $category_id;
		
		// Create a query to find what category the category_id is for
		$category_sql = "SELECT category FROM category WHERE category_id = $category_id";
		
		// Run query by calling query function_exists
		$category_query = mysqli_query($dbc, $category_sql);
		
		$rsCategory = mysqli_fetch_assoc($category_query);
		$category = $rsCategory['category'];
		
		// Displaying the category as a title
		echo '<h2>'.$category.'</h2>';
		
		// Create a query to select activities by category ID
		$activity_sql = "SELECT * FROM activity, region WHERE activity.category_id LIKE $category_id AND activity.region_id = region.region_id";
		
		//Run query by calling query function
		$activity_query = mysqli_query($dbc, $activity_sql);
		
		
		
		// Check that query worked
		if($activity_query && mysqli_num_rows($activity_query) > 0) {
			
			echo "<table class='format_2'>
					<tr class='format_2'>
						<th class='format_2'>Activity</th>
						<th class='format_2'>Region</th>
					</tr>";
			while($rsActivity = mysqli_fetch_assoc($activity_query)) {
				echo "<tr class='format_2'>
						<td class='format_2'><a href='index.php?page=activity&activity_id=".$rsActivity['activity_id']."'>".$rsActivity['activity_title']."</a></td>
						<td class='format_2'>".$rsActivity['region']."</td>
					</tr>";
			}
			echo "</table>";
			
		} else {
			
			echo '<h2'.$category.'</h2>';
			echo "There are no activities for this category.";
		}
		
?>