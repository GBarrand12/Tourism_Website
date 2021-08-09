<h2>Inquiries</h2>
<div class="center">
<?php
	$inquiries_sql = "SELECT * FROM inquiries, activity WHERE inquiries.activity_id = activity.activity_id ORDER BY inquiry_id ASC";
	
	$inquiries_query = mysqli_query($dbc, $inquiries_sql);
	
	if(!$inquiries_query) {
		echo "Sorry, something went wrong";
	} else {
		$activity_id = $rsInquiries['activity_id'];
		echo "<table class='format'>
			<tr class='format'>
				<th class='format'>Name</th>
				<th class='format'>Activity</th>
				<th class='format'>Email</th>
				<th class='format'>Inquiry</th>
			</tr>";
		while ($rsInquiries = mysqli_fetch_assoc($inquiries_query)) {
			echo "<tr class='format'>
				<td class='format'>".$rsInquiries['user_name']."</td>";
			echo "<td class='format'>".$rsInquiries['activity_title']."</td>";
			echo "<td class='format'>".$rsInquiries['email']."</td>
				<td class='format'>".$rsInquiries['inquiry']."</td>
			</tr>";
		}
		echo "</table>";
	}
?>
</div>
<a href='admin.php?page=adminpanel' class='small_button' style="margin-top: 10px; margin-bottom: 10px;">Back to Admin Panel</a>