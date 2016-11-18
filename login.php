<html>
	<body>
		<?php
			session_start();
			$conn = new mysqli("localhost", "root", "", "Classroom_Manage");
			if($conn->connect_error)
			{
				die('Could not connect: ' . $conn->connect_error);
			}

			$account = $_POST["account"];
			$password = $_POST["password"];
/*
			$db = mysql_select_db("Classroom_Manage", $conn);
			if(!$db)
			{
				die("No database found" . mysql_error());
			}
*/
			$query = "SELECT * FROM Student WHERE student_id = '$account' AND password = '$password'";
			$result = $conn->query($query);
			if($result->num_rows == 0)
			{
				echo "<script>
						alert('password error');
						location.href='home.html';
					</script>";
			}
			$result->data_seek(0);
			$name = $result->fetch_assoc()['name'];
			$result->data_seek(0);
			$grade = $result->fetch_assoc()['grade'];
			$result->data_seek(0);
			$major = $result->fetch_assoc()['major'];
			$result->data_seek(0);
			$email = $result->fetch_assoc()['email'];

			echo 'student_id : ' . $account . '<br>';
			echo '  name : ' . $name .'<br>';
			echo '  grade : ' . $grade .'<br>';
			echo '  major : ' . $major .'<br>';
			echo '  email : ' . $email .'<br>';
		?>
	</body>
</html>
