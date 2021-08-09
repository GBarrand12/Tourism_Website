<?php 
//include required files
include("config.php"); //gives database credentials

//Connect to database
$dbc = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);

// Check for connection error and display error if so
if (!$dbc) {
	echo "Could not connect to the database.";
	exit;
}

?>
<!DOCTYPE HTML>
<html lang="en">
<?php
include("head.html");
include("content/navigation.php"); // There is a "content" folder to store page content
?>
	
	<main>
		<?php
			// checking if a specific page has been requested in the url
			if(!isset($_GET['page'])) {
				include("content/home.php");
			} else{
				// prevents users from navigating through file system from the URL
				$page=preg_replace('/[^0-9a-zA-Z]-/', '', $_REQUEST['page']);
				include("content/$page.php");
			}
		?>
	</main>

<?php include("footer.php"); ?>

