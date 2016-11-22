<?php
	session_start();
	//connect to the database
	$conn = new mysqli("localhost", "root", "", "Classroom_Manage");
	if($conn->connect_error)
	{
		die('Could not connect: ' . $conn->connect_error);
	}

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

		case 'Manager':
			$user_type_id = 'manager_id';
			break;
		
		default:
			echo "<script>
				alert('user_type error');
				location.href='home.html';
			</script>";
			break;
	}

	$query = "SELECT * FROM $user_type WHERE $user_type_id = '$id'";
	$result = $conn->query($query);

	$result->data_seek(0);
	$row = $result->fetch_assoc();
	$name = $row['name'];
	$password = $row['password'];

	$old_password = $_POST["old_password"];
	$new_password = $_POST["new_password"];
	$ver_password = $_POST["ver_password"];

	if($old_password != $password)
	{
		switch ($user_type) 
		{
			case 'Student':
				print<<<EOT
					<script>
						alert('Wrong Password');
						location.href = 'Student_change_password.html';	
					</script>
EOT;
				break;

			case 'Professor':
				print<<<EOT
					<script>
						alert('Wrong Password');
						location.href = 'Professor_change_password.html';	
					</script>
EOT;
				break;

			case 'Manager':
				print<<<EOT
					<script>
						alert('Wrong Password');
						location.href = 'Manager_change_password.html';	
					</script>
EOT;
				break;
			
			default:
				echo "
					<script>
						alert('user_type error');
						location.href='home.html';
					</script>";
				break;
		}
	}
	else if($new_password != $ver_password)
	{
		switch ($user_type) 
		{
			case 'Student':
				print<<<EOT
					<script>
						alert('Password Verification Error');
						location.href = 'Student_change_password.html';	
					</script>
EOT;
				break;

			case 'Professor':
				print<<<EOT
					<script>
						alert('Password Verification Error');
						location.href = 'Professor_change_password.html';	
					</script>
EOT;
				break;

			case 'Manager':
				print<<<EOT
					<script>
						alert('Password Verification Error');
						location.href = 'Manager_change_password.html';	
					</script>
EOT;
				break;
			
			default:
				echo "<script>
					alert('user_type error');
					location.href='home.html';
				</script>";
				break;
		}
	}	
	else
	{
		$query = "UPDATE $user_type SET password = '$new_password' WHERE $user_type_id = '$id'";
		$conn->query($query);
		if($conn->connect_error)
		{
			die('Could not connect: ' . $conn->connect_error);
		}

		switch ($user_type) 
		{
			case 'Student':
				print<<<EOT
					<script>
						alert('Password Sucessfully Changed');
						location.href = 'Student_menu.html';	
					</script>
EOT;
				break;

			case 'Professor':
				print<<<EOT
					<script>
						alert('Password Sucessfully Changed');
						location.href = 'Professor_menu.html';	
					</script>
EOT;
				break;

			case 'Manager':
				print<<<EOT
					<script>
						alert('Password Sucessfully Changed');
						location.href = 'Manager_menu.html';	
					</script>
EOT;
				break;
			
			default:
				echo "<script>
					alert('user_type error');
					location.href='home.html';
				</script>";
				break;
		}
	}
	
	$conn->close();
?>
