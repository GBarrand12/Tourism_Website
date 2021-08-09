    <nav class="navigation" id="navBar">
		<div class="logo">
			<a href="index.php?page=home">
			<img src="images/logo.png" alt="Navigate NZ Logo" title="Navigate NZ Logo">
			</a>
		</div> <!-- close logo div -->
		
		<!-- "Hamburger menu" / "Bar icon" to toggle the navigation links -->
		<a href="javascript:void(0);" class="icon" onclick="makeResponsive()">
			<i class="fa fa-bars"></i>
		</a>
		
			<a href="index.php" class="active">Home</a>
			<div class="dropdown">
				<a href="#">Region <i class="fa fa-caret-down"></i></a> <!-- Will provide link to activities in a region on dropdown -->
					<div class="dropdown-content">
						
						<!-- Put code here to query regions in a loop -->
							<?php
								// set up query
								$region_sql = "SELECT * FROM region ORDER BY region";
								// run query
								$region_query = mysqli_query($dbc, $region_sql);
								// test if query worked
								if(!$region_query) {
									echo "Sorry there is no result for region";
								} else {
									//loop through to create the list of clothing types as links
									while($rsRegion = mysqli_fetch_assoc($region_query)) {
										echo '<a class="nav" href="index.php?page=region&region_id='.$rsRegion['region_id'].'">'.$rsRegion['region'].'</a>';
										// Note $rsRegion['region_id'] etc are database field names
									}
								}
							?>
						
					</div> <!-- close dropdown content div -->
			</div> <!-- close dropdown div -->
			<div class="dropdown">
				<a href="#">Category <i class="fa fa-caret-down"></i></a> <!-- Will provide link to activities in a category on dropdown -->
					<div class="dropdown-content">
						<!-- Put code here to query categories in a loop -->
							<?php
								// set up query
								$category_sql = "SELECT * FROM category ORDER BY category";
								// run query
								$category_query = mysqli_query($dbc, $category_sql);
								// test if query worked
								if(!$category_query) {
									echo "Sorry there is no result for category";
								} else {
									//loop through to create the list of clothing types as links
									while($rsCategory = mysqli_fetch_assoc($category_query)) {
										echo '<a class="nav" href="index.php?page=category&category_id='.$rsCategory['category_id'].'">'.$rsCategory['category'].'</a>';
										// Note $rsCategory['category_id'] etc are database field names
									}
								}
							?>
					</div> <!-- close dropdown content div -->
			</div>	<!-- close dropdown div -->
			
			<div class="search">
				<!-- Search Bar Form -->
				<form method="post" action="index.php?page=search_results" id="search">
					<input type="text" name="search_input" placeholder="Search.."> <!-- Search bar -->
					<button type="submit" name="submit" class="small_button" value="Search"><i class="fa fa-search"></i></button>
				</form>
					
			</div>  <!-- close dropdown div -->

	</nav>
