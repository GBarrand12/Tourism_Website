<!-- Page to display all of the activities in a region -->
<?php
		//Assign region id from URL to a variable
		$region_id = $_GET['region_id'];
		// echo $region_id;
		
		//Query to get the images related to that region
		$images_sql = "SELECT * FROM photos WHERE photos.region_id = $region_id";
		
		// Run query by calling query funtion
		$images_query = mysqli_query($dbc, $images_sql);
		
		// Check that the query worked
		if(!$images_query) {
			echo "Sorry there is no result";
		} else {
			echo '<!-- Slideshow container -->
		<div class="slideshow-container">';
			//loop through to display each image for the region
			while($rsImages = mysqli_fetch_assoc($images_query)) {		
				echo "<!-- Full-width images -->
				<div class='mySlides fade'>
					<img src='images/".$rsImages['image_link']."' style='width:100%' alt='".$rsImages['image_title']."' title='".$rsImages['image_title']."'>
					<div class='text'>".$rsImages['image_title']."</div>
				</div>";
				}
			echo '<!-- Next and previous buttons -->
  <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
  <a class="next" onclick="plusSlides(1)">&#10095;</a>
  </div> <!-- end slideshow-container -->
		<br>';
		}?>
		<div style="text-align:center">
		  <span class="dot" onclick="currentSlide(1)"></span> 
		  <span class="dot" onclick="currentSlide(2)"></span> 
		  <span class="dot" onclick="currentSlide(3)"></span> 
		</div>
		
		<?php
		// Create a query to find what region the region_id is for
		$region_sql = "SELECT region FROM region WHERE region_id = $region_id";
		
		// Run query by calling query function_exists
		$region_query = mysqli_query($dbc, $region_sql);
		
		$rsRegion = mysqli_fetch_assoc($region_query);
		$region = $rsRegion['region'];
		
		// Displaying the region as a title
		echo '<h2>'.$region.'</h2>';
		
		// Create a query to select activities by region ID
		$activity_sql = "SELECT * FROM activity, category WHERE activity.region_id = $region_id AND activity.category_id = category.category_id";
		
		//Run query by calling query function
		$activity_query = mysqli_query($dbc, $activity_sql);
		
	
		// Check that query worked
		if($activity_query && mysqli_num_rows($activity_query) > 0) {
			
			echo "<table class='format_2'>
					<tr class='format_2'>
						<th class='format_2'>Activity</th>
						<th class='format_2'>Category</th>
					</tr>";
			while($rsActivity = mysqli_fetch_assoc($activity_query)) {
				echo "<tr class='format_2'>
						<td class='format_2'><a href='index.php?page=activity&activity_id=".$rsActivity['activity_id']."'>".$rsActivity['activity_title']."</a></td>
						<td class='format_2'>".$rsActivity['category']."</td>
					</tr>";
			}
			echo "</table>";
			
		} else {
			echo '<h2'.$region.'</h2>';
			echo "There are no activities for this region.";
		}
		
?>
<!-- Javascript is moved here so that the slideshow is displayed without the user having to click one of the dots first -->
<script>
/*Allows slideshows to work*/
	var slideIndex = 1;
	showSlides(slideIndex);

	function plusSlides(n) {
	  showSlides(slideIndex += n);
	}

	function currentSlide(n) {
	  showSlides(slideIndex = n);
	}

	function showSlides(n) {
	  var i;
	  var slides = document.getElementsByClassName("mySlides");
	  var dots = document.getElementsByClassName("dot");
	  if (n > slides.length) {slideIndex = 1}    
	  if (n < 1) {slideIndex = slides.length}
	  for (i = 0; i < slides.length; i++) {
		  slides[i].style.display = "none";  
	  }
	  for (i = 0; i < dots.length; i++) {
		  dots[i].className = dots[i].className.replace(" active", "");
	  }
	  slides[slideIndex-1].style.display = "block";  
	  dots[slideIndex-1].className += " active";
	}
</script>
