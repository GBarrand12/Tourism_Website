<?php 
// starts a general session that will end when the user logs out, even though they are not logged in for a start
session_start();

//include required files
include("config.php"); //gives database credentials
include("functions.php");

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
				$page = "adminlogin";
			} else{
				// prevents users from navigating through file system from the URL
				$page=preg_replace('/[^0-9a-zA-Z]-/', '', $_REQUEST['page']);
				//include("content/$page.php");
			}
			
			// Offer logon if not logged in
			if($page=="logout" or $page=="adminlogin" or $page=="login") {
				include("$page.php");
			} else {
				// Send user back to index page if not logged in
				if(!isset($_SESSION['admin'])) {
					if (!headers_sent()) {
						header('Location: index.php');
						exit;
					} else {
						echo '<script type="text/javascript">';
						echo 'window.location.href="index.php";';
						echo '</script>';
						echo '<noscript>';
						echo '<meta http-equiv="refresh" content="0;url="index.php" />';
						echo '</noscript>'; exit;
					}
					
				} else {
					include("$page.php");
				}
			}
		?>
	</main> <!-- end main -->

<?php include("footer.php"); ?>

