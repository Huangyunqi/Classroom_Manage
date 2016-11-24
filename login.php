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
		print<<<EOT
			<script>
				location.href='External_menu.html';
			</script>
EOT;
	}

	else
	{
		switch ($user_type) 
		{
			case 'Student':
				$user_type_id = 'student_id';
				break;

			case 'Professor':
				$user_type_id = 'professor_id';
				break;

			case 'Manager':
				$user_type_id = 'manager_id';
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

		$query = "SELECT * FROM $user_type WHERE $user_type_id = '$account' AND password = '$password'";
		$result = $conn->query($query);
		if($result->num_rows == 0)
		{
			print<<<EOT
				<script>
					alert('Password Error');
					location.href='home.html';
				</script>
EOT;
		}
		$_SESSION["user_id"] = $account;
		$_SESSION["user_type"] = $user_type;
		$url = $user_type . '_menu.html';
		print<<<EOT
			<script>
				location.href='$url';
			</script>
EOT;
	}

	$conn->close();
?>