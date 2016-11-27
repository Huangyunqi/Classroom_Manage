<!--
	apply_classroom.php
	Function: get data from last page and insert an application into database, for Student and Professor. Add a button "Add" for user to make more applications.
	Author: gyc, wq
	Last Update: 2016 Nov 27
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
	switch ($user_type) 
	{
		case 'Student':
			$user_type_id = 'student_id';
			$user_type_abbr = 's';
			break;

		case 'Professor':
			$user_type_id = 'professor_id';
			$user_type_abbr = 'p';
			break;
		
		default:
			print<<<EOT
				<script>
					alert('user_type error');
					location.href='home.html';
				</script>
EOT;
			break;
	}

	//get data posted from Student or Professor_apply_classroom.html
	
	$reason = $_POST["reason"];
	$num_rows = $_POST["num_rows"];
	
	for($i = 0 ; $i < $num_rows ; $i ++)
	{
		if($i == 0)
		{
			$week = $_POST["week"];
			$day = $_POST["day"];
			$course_begin = $_POST["course_begin"];
			$course_end = $_POST["course_end"];
			$size = $_POST["size"];
		}
		else
		{
			$week = $_POST["week" . strval($i + 1)];
			$day = $_POST["day". strval($i + 1)];
			$course_begin = $_POST["course_begin". strval($i + 1)];
			$course_end = $_POST["course_end". strval($i + 1)];
			$size = $_POST["size". strval($i + 1)];
		}
		

		//Reject if course_end < course_begin
		if($course_end < $course_begin)
		{
			switch ($user_type) 
			{
				case 'Student':
					print<<<EOT
						<script>
							alert('Course End must be greater than Course Begin');
							location.href = 'Student_apply_classroom.html';	
						</script>
EOT;
					break;

				case 'Professor':
					print<<<EOT
						<script>
							alert('Course End must be greater than Course Begin');
							location.href = 'Professor_apply_classroom.html';	
						</script>
EOT;
					break;

				default:
					print<<<EOT
						<script>
							alert('user_type error');
							location.href='home.html';
						</script>
EOT;
					break;
			}
		}

		//insert an application into database 
		$query = "INSERT INTO Application (user_type, user_id, size, week, day, course_begin, course_end, reason) VALUES ('$user_type_abbr', '$id', '$size', '$week', '$day', '$course_begin', '$course_end', '$reason')";
		$result = $conn->query($query);
		if(!$result)
		{
			die('Connect Error');
		}

		//response
		switch ($user_type) 
		{
			case 'Student':
				print<<<EOT
					<script>
						alert('Your application was submitted sucessfully.');
						location.href = 'Student_menu.html';	
					</script>
EOT;
				break;
	
			case 'Professor':
				print<<<EOT
					<script>
						alert('Your application was submitted sucessfully.');
						location.href = 'Professor_menu.html';	
					</script>
EOT;
				break;

			default:
				print<<<EOT
					<script>
						alert('user_type error');
						location.href='home.html';
					</script>
EOT;
				break;
		}
	}
	$conn->close();
?>
