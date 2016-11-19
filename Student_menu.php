<?php
	session_start();
	//connect to the database
	$conn = new mysqli("localhost", "root", "", "Classroom_Manage");
	if($conn->connect_error)
	{
		die('Could not connect: ' . $conn->connect_error);
	}

	$student_id = $_SESSION["user_id"];

	$query = "SELECT * FROM Student WHERE student_id = '$student_id'";
	$result = $conn->query($query);

	$result->data_seek(0);
	$row = $result->fetch_assoc();
	$name = $row['name'];
	$grade = $row['grade'];
	$major = $row['major'];
	$email = $row['email'];

	echo 'welcome!' . '<br>';
	echo 'student_id : ' . $student_id . '<br>';
	echo '  name : '  . $name .'<br>';
	echo '  grade : ' . $grade .'<br>';
	echo '  major : ' . $major .'<br>';
	echo '  email : ' . $email .'<br>';

	$conn->close();
?>