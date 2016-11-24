<!--
	modufy_application_database.php
	Function: After getting available classrooms, manager can agree or disagree this application, and corresponding modifications were done in this .php, for Manager
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

	//get data posted from get_available_classroom.php
	$vertify = $_POST['vertify'];
	$application_id = $_POST['application_id'];

	//pass the application
	if($vertify == 1)
	{
		//update values in Application set vertify = 1 
		$classroom_id = $_POST['classroom_id'];
		$query = "UPDATE Application SET vertify = '1', classroom_id = '$classroom_id' WHERE application_id = '$application_id'";
		$result = $conn->query($query);
		if(!$result)
		{
			die('result error');
		}

		$week = $_POST["week"];
		$day = $_POST["day"];
		$course_begin = $_POST["course_begin"];
		$course_end = $_POST["course_end"];

		//get the time schedule of selected classroom, week and day
		$query = "SELECT $day FROM Sparetime WHERE classroom_id = '$classroom_id' AND week = '$week'";
		$result = $conn->query($query);
		if(!$result)
		{
			die('result error');
		}

		$result->data_seek(0);
		$row = $result->fetch_assoc();
		//Use switch because $row['$day'] is invalid
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

		$course_length = $course_end - $course_begin + 1;
		$ones = '';
		for($i = 0 ; $i < $course_length ; $i++)
		{
			$ones = $ones . '1';
		}

		//replace its bits occupied by this application and put new value into database
		$vacant = substr_replace($vacant, $ones, $course_begin - 1, $course_length);
		$vacant_number = bindec($vacant);

		$query = "UPDATE Sparetime SET $day = '$vacant_number' WHERE classroom_id = '$classroom_id' AND week = '$week'";
		$result = $conn->query($query);
		if(!$result)
		{
			die('result error');
		}

		print<<<EOT
			<p>Application Passed</p>
			<a href="Manager_handle_application.html"><input type="button" value="Go Back"></a>
EOT;
	}
	//reject the application
	else
	{
		//set vertify = -1, and no other information was changed
		$query = "UPDATE Application SET vertify = '-1' WHERE application_id = '$application_id'";
		$result = $conn->query($query);
		if(!$result)
		{
			die('result error');
		}
		print<<<EOT
			<p>Application Rejected</p>
			<a href="Manager_handle_application.html"><input type="button" value="Go Back"></a>
EOT;
	}

	$conn->close();
?>