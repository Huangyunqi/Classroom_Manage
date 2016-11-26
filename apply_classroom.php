<!--
	apply_classroom.php
	Function: get data from last page and insert an application into database, for Student and Professor. (Add a button "+" for user to make more applications?)
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

	//get user type and id 
	$user_type = $_SESSION["user_type"];
	$id = $_SESSION["user_id"];
	$user_type_id = lcfirst($user_type) . '_id';
	$user_type_abbr = $user_type_id[0];

	//get data posted from Student or Professor_apply_classroom.html
	$week = $_POST["week"];
	$day = $_POST["day"];
	$course_begin = $_POST["course_begin"];
	$course_end = $_POST["course_end"];
	$size = $_POST["size"];
	$reason = $_POST["reason"];

	//Reject if course_end < course_begin
	if($course_end < $course_begin)
	{
		$url = $user_type . '_apply_classroom.html';
		
				print<<<EOT
					<script>
						alert('Course End must be greater than Course Begin');
						location.href = '$url';	
					</script>
EOT;
	}

	//insert an application into database 
	else
	{
		$query = "INSERT INTO Application (user_type, user_id, size, week, day, course_begin, course_end, reason) VALUES ('$user_type_abbr', '$id', '$size', '$week', '$day', '$course_begin', '$course_end', '$reason')";
		$result = $conn->query($query);
		if(!$result)
		{
			die('Connect Error');
		}

		//response
		$url = $user_type . '_menu.html';
		print<<<EOT
			<script>
				alert('Your application was submitted sucessfully.');
				location.href = '$url';	
			</script>
EOT;
	}
			
	
	$conn->close();
?>
