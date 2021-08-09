<?php
	// Check that an activity id has come through in the URL
	if(!isset($_GET['activity_id'])) {
		echo "Sorry, something went wrong. Return to the home page.";
	} else {
		// Assign the activity id from the URL to a variable
		$activity_id = $_GET['activity_id'];
	}
	
	//NEED TO TEST THIS QUERY
	// SQL to select specific information related to a particular activity
	$activity_sql = "SELECT * FROM activity, region, category WHERE activity.activity_id = $activity_id AND activity.region_id = region.region_id AND activity.category_id = category.category_id";
	
	// Run query by calling query funtion
	$activity_query = mysqli_query($dbc, $activity_sql);
	
	// Check that the query worked
	if(!$activity_query) {
		echo "Sorry there is no result";
	} else {
		$rsActivity = mysqli_fetch_assoc($activity_query);
	}
	
	
?>


<!-- Display the information for the activity -->
<h1><?php echo $rsActivity['activity_title']; ?></h1>
<b>Category</b>
<p><?php echo $rsActivity['category']; ?></p>
<b>Region</b>
<p><?php echo $rsActivity['region']; ?></p>
<b>Address</b>
<p><?php echo $rsActivity['address']; ?></p>
<b>Distance</b>
<p><?php echo $rsActivity['distance']; ?></p>
<b>Price</b>
<p><?php echo $rsActivity['price']; ?></p>
<b>Description</b>
<p><?php echo $rsActivity['description']; ?></p>

<div class="blue_box">
	<h3>Nearby Accommodation</h3>
	<p><?php echo $rsActivity['accomodation_title']?> - <a href="<?php echo $rsActivity['accomodation_link'];?>" title="<?php echo $rsActivity['accomodation_title'];?>"><?php echo $rsActivity['accomodation_link'];?></a></p>
</div>

<?php

if($_POST) {

	extract($_POST);

	
$inquiry = addslashes($inquiry); //Code to add slashes before apostrophes, quotation marks etc. so that the query will submit


$errors = array();
//Code to check form for errors
if(!$user_name) {
	$errors[] = "Please enter your name. ";
} else if(strlen($user_name) > 50) {
	$errors[] = 'Please enter a shorter name. ';
}
if(!$inquiry) {
	$errors[] = 'Please enter an inquiry. ';
} else if(strlen($inquiry > 1500)) {
	$errors[] = "Please enter a shorter inquiry. ";
}
if(!$email) {
	$errors[] = "Please enter an email to be contacted on about your inquiry ";
} else if(strlen($email > 100)) {
	$errors[] = 'Please enter a email. ';
}

//Insert information from the form into the database if there are no errors
if(empty($errors)) {
	$inquiry_sql = "INSERT INTO inquiries VALUES(NULL, '$activity_id', '$user_name', '$inquiry', '$email')";
	
	$inquiry_query = mysqli_query($dbc, $inquiry_sql);
	
	
	if($inquiry_query&&mysqli_affected_rows($dbc)> 0) {
		if (!headers_sent()) {    
			header("Location: index.php?page=inquiry_success");
			exit;
		} else {  
			echo '<script type="text/javascript">';
			echo "window.location.href='index.php?page=inquiry_success';";
			echo '</script>';
			echo '<noscript>';
			echo "<meta http-equiv='refresh' content='0;url='index.php?page=inquiry_success' />";
			echo '</noscript>'; exit;
			}
		} else {
			echo "<p class='error'>Failed to update database</p>";
		}
		} else {
			echo '<div class="error">';
			echo "<ul class='no-bullet'>";
			foreach($errors as $error) {
				//Code to display errors as a list
				echo '<li>';
				echo $error;
				echo '</li>';
				
			}
			echo '</ul>';
			echo '</div> <!-- close error div -->';
		} 
}else {
	//Dropdown button which is only displayed if there are no errors
	echo '<button id="show" class="small_button">Make an Inquiry</button>';
	
}
?>
<?php 
	if(!$_POST && empty($errors)) {
		echo '<div id="hidden">';
	}
?>
		<div class="light_blue">
<!-- Form to add an inquiry to an activity -->
		<h3>Make an Inquiry</h3>
		<p>Please complete the form below to submit an inquiry for this activity</p>
		<form method="post" id="inquiry" action="index.php?page=activity&activity_id=<?php echo $activity_id;?>">
			<div class="row">
				<div class="label">Your Name:</div> <!-- close label div -->
					<div class="input"><input type="text" name="user_name" value="<?php echo $user_name; ?>"></div>
			</div> <!-- close row -->
			<div class="row">
				<div class="label">Email:</div> <!-- close label div -->
					<div class="input"><input type="text" name="email" value="<?php echo $email; ?>"></div>
			</div> <!-- close row -->
			<div class="row">
				<div class="label">Inquiry:</div> <!-- close label div -->
					<div class="input"><textarea type="text" name="inquiry" cols="60" rows="7" value="<?php echo $inquiry; ?>"></textarea></div>
			</div> <!-- close row -->
			<input type="submit" name="submit" value="Submit Inquiry" class="small_button">
			<input type="reset" value="Reset" class="small_button">
		</form>
		</div>
<?php 
	if(!$_POST && empty($errors)) {
		echo '</div>';
	}
?>
