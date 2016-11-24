<!--
	get_unhandled_application.php
	Function: Get un-handled applications from database and show them on page, for Manager
	Author: gyc 
	Last Update: 2016 Nov 23
-->

<?php
	session_start();

	//connect to the database
	$conn = new mysqli("localhost", "root", "", "Classroom_Manage");
	if($conn->connect_error)
	{
		die('Could not connect: ' . $conn->connect_error);
	}

	//get user type and user id
	$user_type = $_SESSION["user_type"];
	if($user_type != 'Manager')
	{
		print<<<EOT
				<script>
					alert('user_type error');
					location.href='home.html';
				</script>
EOT;
	}
	$id = $_SESSION["user_id"];

	//get applications with vertify equals to 0, which means these applications were not handled
	$query = "SELECT * FROM Application WHERE vertify = '0'";
	$result = $conn->query($query);
	if(!$result)
	{
		die('Connect Error');
	}

	//show all items in a table
	print<<<EOT
		<table>
			<tr>
				<td align="center">Application ID</td>
				<td align="center">Size</td>
				<td align="center">Week</td>
				<td align="center">Day</td>
				<td align="center">Course Begin</td>
				<td align="center">Course End</td>
				<td align="center">Reason</td>
			</tr>
EOT;
	for ($i = 0 ; $i < $result->num_rows ; $i++)
	{
		$result->data_seek($i);
		$row = $result->fetch_assoc();

		$application_id = $row['application_id'];
		$size = $row['size'];
		$week = $row['week'];
		$day = $row['day'];
		$course_begin = $row['course_begin'];
		$course_end = $row['course_end'];
		$reason = $row['reason'];

		//Here, for each item, I used post method to jump to another page(get_available_classroom.php)
		print<<<EOT
			<tr>
				<td align="center">$application_id</td>
				<td align="center">$size</td>
				<td align="center">$week</td>
				<td align="center">$day</td>
				<td align="center">$course_begin</td>
				<td align="center">$course_end</td>
				<td align="center">$reason</td>
				<td>
					<form action="get_available_classroom.php" method="post">
						<input type="hidden" name="application_id" value="$application_id">
						<input type="hidden" name="size" value="$size">
						<input type="hidden" name="week" value="$week">
						<input type="hidden" name="day" value="$day">
						<input type="hidden" name="course_begin" value="$course_begin">
						<input type="hidden" name="course_end" value="$course_end">
						<input type="submit" value="Handle">
					</form>
				</td>
			</tr>
EOT;
	}
	print<<<EOT
		</table>
		<a href="Manager_menu.html"><input type="button" value="Go Back"></a>	
EOT;
	
	$conn->close();
?>
