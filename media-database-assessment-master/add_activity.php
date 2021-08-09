<?php
	if(!empty($_POST)) {
		// Convert array values to variables which makes it much easier to write the code
		extract($_POST);
		
		// Sanitise all variables
		
		$activity_title = test_input($activity_title);
		$address = test_input($address);
		$distance = test_input($distance);
		$price = test_input($price);
		$description = test_input($description);
		$accomodation_title = test_input($accomodation_title);
		$accomodation_link = test_input($accomodation_link);
		$region_id = test_input($region_id);
		$category_id = test_input($category_id);
		
		// Create an empty array to store the errors
		$errors = array();
		
		// Every time an error is encountered, a message is added to the errors array. At the end, a check will be performed to see if the array is empty or not
		if(!$activity_title) {
			// There is no value for the name
			$errors[] = 'Please enter a name for the activity';
		} else if(strlen($activity_title) > 50) {
			// The length of the activity name is greater than 50 characters and will not fit in the database
			$errors[] = 'Your activity name is too long to be stored - please enter a shorter activity name';
		}
		if(!$address) {
			// There is no value for the address
			$errors[] = 'Please enter an address for the activity';
		} else if(strlen($address) > 50) {
			// The length of the address is greater than 50 characters and will not fit in the database
			$errors[] = 'Your address is too long to be stored - please enter a shorter address';
		}
		if(!$distance) {
			// There is no value for the distance
			$errors[] = 'Please enter the distance of the activity from the nearest town centre';
		} else if(strlen($distance) > 30) {
			// The length of the distance is greater than 30 characters and will not fit in the database
			$errors[] = 'Your distance is too long to be stored - please enter a shorter distance';
		}
		if(!$price) {
			$errors[] = 'Please enter a price';
		} else if(strlen($price) > 50) {
			// The length of the price is greater than 50 characters and will not fit in the database
			$errors[] = 'Your price is too long to be stored - please enter a shorter price';
		}
		if(!$description) {
			// There is no value for the description
			$errors[] = 'Please enter a description for the item';
		} else if(strlen($description) > 1500) {
			// The length of the short description is greater than 1500 characters and will not fit in the database
			$errors[] = 'Your description is too long to be stored - please enter a shorter description';
		}
		if(!$accomodation_title) {
			// There is no value for the accomodation title
			$errors[] = 'Please enter an accomodation title for the item';
		} else if(strlen($accomodation_title) > 50) {
			// The length of the accomodation title is greater than 50 characters and will not fit in the database
			$errors[] = 'Your accomodation title is too long to be stored - please enter a shorter accomodation title';
		}
		if(!$accomodation_link) {
			// There is no value for the accomodation link
			$errors[] = 'Please enter an accomodation link for the item';
		} else if(strlen($accomodation_link) > 2000) {
			// The length of the accomodation link is greater than 2000 characters and will not fit in the database
			$errors[] = 'Your accomodation link is too long to be stored - please enter a shorter accomodation link';
		}
		if($region_id == 0) {
			/*There is no value for region*/
			$errors[] = "You need to select a region.";
		}
		if($category_id == 0) {
			/*There is no value for category*/
			$errors[] = "You need to select a category.";
		}
		
		if(!empty($errors)) {
			//There were errors
			echo 'Please fix the following errors: ';
			
			echo '<div class="error">';
			// display the opening unordered list tage
			echo '<ul>';
			// loop through all of the error messages and display each one within its own list item
			foreach($errors as $error) {
				echo '<li>';
				echo $error;  // the value of the error message
				echo '</li>';
			}
			echo '</ul>';
			echo '</div> <!-- close error div -->';
		} else {
			$add_activity_sql = "INSERT INTO activity VALUES(NULL, '$category_id', '$region_id', '$activity_title', '$address', '$distance', '$price', '$description', '$accomodation_title', '$accomodation_link')";
			
			$add_activity_query = mysqli_query($dbc, $add_activity_sql);
			
			// Was the insert successful?
			if($add_activity_query && mysqli_affected_rows($dbc) > 0) {
				$new_id_sql = "SELECT activity_id FROM activity WHERE activity_title LIKE '$activity_title'";
				$new_id_query = mysqli_query($dbc, $new_id_sql);
				if(mysqli_num_rows($new_id_query) > 0) {
					$rsNew_id = mysqli_fetch_assoc($new_id_query);
					if (!headers_sent()) {
						header("Location: admin.php?page=add_activity_success&activity_title=$activity_title&activity_id=".$rsNew_id['activity_id']."");
						exit;
					} else {
						echo '<script type="text/javascript">';
						echo "window.location.href='admin.php?page=add_activity_success&activity_title=$activity_title&activity_id=".$rsNew_id['activity_id']."'";
						echo '</script>';
						echo '<noscript>';
						echo "<meta http-equiv='refresh'content'0;url='admin.php?page=add_activity_success&activity_title=$activity_title&activity_id=".$rsNew_id['activity_id']."' />";
						echo '</noscript>'; exit;
					}
				} else {
					echo "Problem!";
				}
					
			} else {
				echo "Could not add your item";
			}
		}
	}
	
?>
<form id="add-activity" method="post" action="<?php htmlspecialchars($_SERVER['PHP_SELF']."?page=add_activity"); ?>" enctype="multipart/form-data">
	<fieldset>
		<legend><h2>Add an Activity</h2></legend>
		<div class="row">
			<div class="label">Activity Name:</div>
			<div class="input"><input type="text" name="activity_title" value="<?php echo $activity_title; ?>"></div>
		</div> <!-- end row -->
		<div class="row">
			<div class="label">Address:</div>
			<div class="input"><input type="text" name="address" value="<?php echo $address; ?>"></div>
		</div> <!-- end row -->
		<div class="row">
			<div class="label">Distance:</div>
			<div class="input"><input type="text" name="distance" value="<?php echo $distance; ?>"></div>
		</div> <!-- end row -->
		<div class="row">
			<div class="label">Price:</div>
			<div class="input"><input type="text" name="price" value="<?php echo $price; ?>"></div>
		</div> <!-- end row -->
		<div class="row">
			<div class="label">Accommodation Name:</div>
			<div class="input"><input type="text" name="accomodation_title" value="<?php echo $accomodation_title; ?>"></div>
		</div> <!-- end row -->
		<div class="row">
			<div class="label">Accommodation Link:</div>
			<div class="input"><input type="text" name="accomodation_link" value="<?php echo $accomodation_link; ?>"></div>
		</div> <!-- end row -->
		<div class="row">
			<div class="label">Region:</div>
			<div class="input">
			<select name="region_id" value="<?php echo $region_id; ?>">
				<?php
					// Put code here to query regions in a loop
					// REGIONS QUERY
					// set up query
					$region_sql = "SELECT * FROM region";
					// run query
					$region_query = mysqli_query($dbc, $region_sql);
					// test if query worked
					if(!$region_query) {
						echo "Sorry there is no result for region";
					} else {
						//loop through to create the list of regions as options
						while($rsRegion = mysqli_fetch_assoc($region_query)) {
							echo '<option value="'.$rsRegion['region_id'].'">'.$rsRegion['region'].'</option>';
						}
					}
				?>
			</select>
			</div>
		</div> <!-- end row -->
		<div class="row">
			<div class="label">Category:</div>
			<div class="input"><select  name="category_id" value="<?php echo $category_id; ?>">
				<?php
					// Put code here to query categories in a loop
					// Categories QUERY
					// set up query
					$category_sql = "SELECT * FROM category";
					// run query
					$category_query = mysqli_query($dbc, $category_sql);
					// test if query worked
					if(!$category_query) {
						echo "Sorry there is no result for category";
					} else {
						//loop through to create the list of categories as options
						while($rsCategory = mysqli_fetch_assoc($category_query)) {
							echo '<option value="'.$rsCategory['category_id'].'">'.$rsCategory['category'].'</option>';
						}
					}
				?>
			</select>
			</div>
		</div> <!-- end row -->
		<div class="row">
			<div class="label">Description:</div>
			<div class="input"><textarea type="text" name="description" cols="60" rows="7"> <?php echo $description; ?></textarea></div>
		</div> <!-- end row -->
		<div class="row">
			<div class="label">Submit</div>
			<div class="input"><input type="submit" name="submit" value="Add activity" class="small_button"></div>
			<a class="small_button cancel" href="admin.php?page=adminpanel">Cancel</a>
		</div> <!-- end row -->
	</fieldset>
</form>
