<!--
	view_vacant_classroom.php
	Function: get data from database with specific week, day, course begin and end, for Student and Professor.
	Author: gyc
	Last Update: 2016 Nov 22
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
			break;

		case 'Professor':
			$user_type_id = 'professor_id';
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

	//get data posted from Student or professor view_vacant_classroom.html
	$week = $_POST["week"];
	$day = $_POST["day"];
	$course_begin = $_POST["course_begin"];
	$course_end = $_POST["course_end"];

	//ERROR if course_begin > course_end
	if($course_end < $course_begin)
	{
		switch ($user_type) 
		{
			case 'Student':
				print<<<EOT
					<script>
						alert('Course End must be greater than Course Begin');
						location.href = 'Student_view_vacant_classroom.html';	
					</script>
EOT;
				break;

			case 'Professor':
				print<<<EOT
					<script>
						alert('Course End must be greater than Course Begin');
						location.href = 'Professor_view_vacant_classroom.html';	
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

	//get data from database
	$day_column = 'Sparetime.' . $day;
	$query = "SELECT Classroom.classroom_id, Classroom.size, Classroom.facility, Sparetime.week, $day_column FROM Classroom, Sparetime WHERE Classroom.classroom_id = Sparetime.classroom_id AND Sparetime.week = '$week'";
	$result = $conn->query($query);
	if(!$result)
	{
		die('Connect Error');
	}

	//print results
	print<<<EOT
		<table>
			<tr>
				<td align="center">Classroom</td>
				<td align="center">Size</td>
				<td align="center">Facility State</td>
			</tr>
EOT;
	for ($i = 0 ; $i < $result->num_rows ; $i++)
	{
		$result->data_seek($i);
		$row = $result->fetch_assoc();
		switch ($day) 
		{
			case 'mon':
				$vacant_number = $row['mon'];
				break;

			case 'tue':
				$vacant_number = $row['tue'];
				break;

			case 'wed':
				$vacant_number = $row['wed'];
				break;

			case 'thu':
				$vacant_number = $row['thu'];
				break;

			case 'fri':
				$vacant_number = $row['fri'];
				break;

			case 'sat':
				$vacant_number = $row['sat'];
				break;

			case 'sun':
				$vacant_number = $row['sun'];
				break;
			
			default:
				print<<<EOT
					<script>
						alert('day error');
						location.href='home.html';
					</script>
EOT;
				break;
		}
		
		//handle the schedule
		$vacant = decbin($vacant_number);
		if(strlen($vacant) < 15)
		{
			$temp = $vacant;
			for($j = 0 ; $j < 15 - strlen($vacant) ; $j++)
			{
				$temp = '0' . $temp;
			}
			$vacant = $temp;
		}

		$time_string = substr($vacant, $course_begin - 1, $course_end - $course_begin + 1);
		if(bindec($time_string) != 0)
		{
			continue;
		}

		$classroom_id = $row['classroom_id'];
		$size = $row['size'];
		$facility = $row['facility'];
		if($facility == 1)
			$state = 'GOOD';
		else
			$state = 'BAD';

		//print a line 
		print<<<EOT
			<tr>
				<td align="center">$classroom_id</td>
				<td align="center">$size</td>
				<td align="center">$state</td>
			</tr>
EOT;
	}
	print<<<EOT
		</table>
EOT;

	//jump back when user click button "Go Back"
	switch ($user_type) 
	{
		case 'Student':
			print<<<EOT
				<a href = "Student_view_vacant_classroom.html"><input type = "button" value = "Go Back"></a>
EOT;
			break;

		case 'Professor':
			print<<<EOT
				<a href = "Professor_view_vacant_classroom.html"><input type = "button" value = "Go Back"></a>
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
	
	$conn->close();
?>
