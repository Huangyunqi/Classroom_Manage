<?php
	session_start();
	$conn = new mysqli("localhost", "root", "", "Classroom_Manage");
	if($conn->connect_error)
	{
		die('Could not conncet: ' . $conn->connect_error);
	}
	$report_id = $_POST['report_id'];
	$classroom_id = $_POST['classroom_id'];
	$reason = $_POST['reason'];
	
	$query = "UPDATE `Classroom_Manage`.`Classroom` SET `facility`='1' WHERE `classroom_id`='$classroom_id'";
	$query1 = "UPDATE `Classroom_Manage`.`Report` SET `vertify`='1' WHERE `report_id`='$report_id'";
	if($conn->query($query) && $conn->query($query1))
	{
		print<<<EOT
			<script>
				alert('handle successful!');
				location.href = 'manager_view_repair.php';
			</script>

EOT;
	}
	else
	{
		print<<<EOT
			<script>
				alert('handle fail!');
				location.href = 'manager_view_repair.php';
			</script>
EOT;
	}
	$conn->close();
?>
