<?php
	session_start();  //for the _SESSION, something like cookie

	//connect to the database
	$conn = new mysqli("localhost", "root", "", "Classroom_Manage");
	if($conn->connect_error)
	{
		die('Could not connect: ' . $conn->connect_error);
	}

	//get the var from home.html
	$account = $_POST["account"];
	$password = $_POST["password"];
	$user_type = $_POST["user_type"];

	//the 4 kinds of user bellow
	if($user_type == "External")
	{
		echo "<script>
				location.href='External_menu.php';
			</script>";
	}
	
	else if($user_type == "Student")
	{
		$query = "SELECT * FROM $user_type WHERE student_id = '$account' AND password = '$password'";
		$result = $conn->query($query);
		if($result->num_rows == 0)
		{
			echo "<script>
					alert('password error');
					location.href='home.html';
				</script>";
		}
		$_SESSION["user_id"] = $account;
		$_SESSION["user_type"] = $user_type;
		$url = $user_type . '_menu.php';
		echo "<script>
				location.href='$url';
			</script>";
	}

	else if($user_type == "Professor")
	{
		$query = "SELECT * FROM $user_type WHERE professor_id = '$account' AND password = '$password'";
		$result = $conn->query($query);
		if($result->num_rows == 0)
		{
			echo "<script>
					alert('password error');
					location.href='home.html';
				</script>";
		}
		$_SESSION["user_id"] = $account;
		$_SESSION["user_type"] = $user_type;
		$url = $user_type . '_menu.php';
		echo "<script>
				location.href='$url';
			</script>";
	}

	else if($user_type == "Manager")
	{
		$query = "SELECT * FROM $user_type WHERE manager_id = '$account' AND password = '$password'";
		$result = $conn->query($query);
		if($result->num_rows == 0)
		{
			echo "<script>
					alert('password error');
					location.href='home.html';
				</script>";
		}
		$_SESSION["user_id"] = $account;
		$_SESSION["user_type"] = $user_type;
		$url = $user_type . '_menu.php';
		echo "<script>
				location.href='$url';
			</script>";
	}

	$conn->close();
?>

