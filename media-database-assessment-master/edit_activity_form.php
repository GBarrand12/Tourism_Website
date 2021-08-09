<?php
	if(!empty($_POST)) {
		// Convert array values to variables - this does make it much easier to write the code
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
			$errors[] = 'Please enter an accommodation title for the item';
		} else if(strlen($accomodation_title) > 50) {
			// The length of the accomodation title is greater than 50 characters and will not fit in the database
			$errors[] = 'Your accommodation title is too long to be stored - please enter a shorter accommodation title';
		}
		if(!$accomodation_link) {
			// There is no value for the accomodation link
			$errors[] = 'Please enter an accommodation link for the item';
		} else if(strlen($accomodation_link) > 2000) {
			// The length of the accomodation link is greater than 2000 characters and will not fit in the database
			$errors[] = 'Your accommodation link is too long to be stored - please enter a shorter accommodation link';
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
			echo '</div> <!--Close error div -->';
		} else {
			$edit_activity_sql = "UPDATE activity SET 
				region_id = '$region_id',
				category_id = '$category_id',
				activity_title = '$activity_title',
				address = '$address',
				distance = '$distance',
				price = '$price',
				description = '$description',
				accomodation_title = '$accomodation_title',
				accomodation_link = '$accomodation_link'
				WHERE activity_id = '$activity_id'";
				
			$edit_activity_query = mysqli_query($dbc, $edit_activity_sql);
			
			//Was the insert successful?
			if($edit_activity_query && mysqli_affected_rows($dbc) > 0) {
				echo "<div class='success'><h3> Your activity $activity_title has been edited!</h3></div><!-- /success -->";
				echo "<p>
						<a href='admin.php?page=adminpanel' class='button'>Back to Admin Panel</a>
						<a href='admin.php?page=logout' class='button'>Log Out</a>
					</p>";
			} else {
				echo 'Could not edit your activity';
			}
		}
	}

?>
