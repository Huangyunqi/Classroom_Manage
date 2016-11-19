<?php
	session_start();
	//connect to the database
	$conn = new mysqli("localhost", "root", "", "Classroom_Manage");
	if($conn->connect_error)
	{
		die('Could not connect: ' . $conn->connect_error);
	}

	$professor_id = $_SESSION["user_id"];

	$query = "SELECT * FROM Professor WHERE professor_id = '$professor_id'";
	$result = $conn->query($query);

	$result->data_seek(0);
	$row = $result->fetch_assoc();
	$name = $row['name'];
	$email = $row['email'];

	echo 'welcome!' . '<br>';
	echo 'professor_id : ' . $professor_id . '<br>';
	echo '  name : '  . $name .'<br>';
	echo '  email : ' . $email .'<br>';

	$conn->close();
?>