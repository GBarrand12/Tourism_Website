<!-- form to allow user to enter username and password -->
<?php
	if(isset($_SESSION['admin'])) {
		echo "You are already logged in!<br>";
		echo "<a href='admin.php?page=adminpanel'>Go to admin panel</a> ";
		echo "<a href='admin.php?page=logout'>Log out</a>";
		exit;
	} else {
		echo "<h2>Login:</h2>";
	}
?>

	<form action="admin.php?page=adminlogin" method="post">
		<p>Username: <input name="username"></p>
		<p>Password: <input name="password" type="password"></p>
		<p>
			<?php
				if(isset($_GET['error'])) {
					echo "<span class='error'>Incorrect username/password</span>";
				}
			?>
		</p>
		<p><input type="submit" name="login" value="Log in" class="small_button"></p>
	</form>