<?php
	session_start();	
	$conn = new mysqli("localhost", "root", "", "Classroom_Manage");
	if($conn->connect_error)
	{
		die('Could not connect: ' . $conn->connect_error);
	}
	$classroom_id = $_POST["classroom"];
	$reason = $_POST["reason"];
	$query1 = "SELECT * FROM Classroom WHERE classroom_id = '$classroom_id'";
	$result = $conn->query($query1);
	$query3 = "SELECT * FROM Report WHERE classroom_id = '$classroom_id' AND vertify = '0'";
	$result1 = $conn->query($query3);
	$user_type = $_SESSION['user_type'];
	if($result->num_rows == 0)
	{
		print<<<EOT
			<script>
				alert('wrong classroom');
				location.href = 'report_repair.html';
			</script>
EOT;
	}
	else if($result1->num_rows != 0)
	{
		print<<<EOT
			<script>
				alert('this classroom have been report!');
				location.href = 'report_repair.html';
			</script>
EOT;
	}
	else
	{
		$query2 = "INSERT INTO Report(statement, vertify, classroom_id) values('$reason', '0', '$classroom_id')";
		if($conn->query($query2))
		{
			switch($user_type)
			{
				case 'Student':
					print<<<EOT
						<script>
							alert('report successful!');
							location.href = 'Student_menu.html';
						</script>
EOT;
					break;
				case 'Professor':
					print<<<EOT
						<script>
							alert('report successful!');
							location.href = 'Professor_menu.html';
						</script>
EOT;
					break;
			}
		} 
		else
		{
			print<<<EOT
				<script>
					alert('report fail');
					location.href = 'report_repair.html';
				</script>
EOT;
		}
	}
	$url = $user_type . '_menu.html';
	$conn->close();
	
?>
