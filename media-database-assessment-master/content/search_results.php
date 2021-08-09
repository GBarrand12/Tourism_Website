<h2>Search Results</h2>
<?php
	//Search Bar Query
	if($_POST['submit'] == 'Search' && $_POST['search_input'] == "") {
		echo "No search term entered";
	} else if(strlen($_POST['search_input']) > 0) {
		$search_input = $_POST['search_input'];
		$search_sql = "SELECT * FROM activity, region, category WHERE region.region_id = activity.region_id AND category.category_id = activity.category_id AND description LIKE '%$search_input%'";
		$search_query = mysqli_query($dbc, $search_sql);
		if($search_query && mysqli_num_rows($search_query) < 1) {
			echo "We could not find what you're looking for";
		}else{
			while($rsSearch = mysqli_fetch_assoc($search_query)) {
				echo "<ul>";
					echo "<li><h3><a href='index.php?page=activity&activity_id=".$rsSearch['activity_id']."'>".$rsSearch['activity_title']."</a></h3><p>".$rsSearch['description']."</p>";
					echo "</li>";
				echo "</ul>";
			}
		}
	}
?>