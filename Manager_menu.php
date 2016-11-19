<?php
	session_start();
	//connect to the database
	$conn = new mysqli("localhost", "root", "", "Classroom_Manage");
	if($conn->connect_error)
	{
		die('Could not connect: ' . $conn->connect_error);
	}

	$manager_id = $_SESSION["user_id"];

	$query = "SELECT * FROM Manager WHERE manager_id = '$manager_id'";
	$result = $conn->query($query);

	$result->data_seek(0);
	$row = $result->fetch_assoc();
	$name = $row['name'];

	echo 'welcome!' . '<br>';
	echo 'manager_id : ' . $manager_id . '<br>';
	echo '  name : '  . $name .'<br>';

	$conn->close();
?>