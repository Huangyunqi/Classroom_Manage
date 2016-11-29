<?php
	session_start();
	$conn = new mysqli("localhost", "root", "", "Classroom_Manage");
	if($conn->connect_error)
	{
		die('Could not connect: ' . $conn->connect_error);
	}
	$id = $_SESSION["user_id"];
	$query1 = "SELECT * FROM Report WHERE vertify = '0' or vertify = '-1'";
	$result = $conn->query($query1);
	if($result->num_rows == 0)
	{
		echo"no repair report! <br>";
	}
	else
	{
		echo"<table boder = '1'>
			<tr>
			<td> report id </td>
			<td> classroom id </td>
			<td> reason </td>
			<td> vertify  </td>
			</tr>";
		while($row = $result->fetch_row())
		{
			echo"<tr>";
			echo"<td> $row[0] </td>";
			echo"<td> $row[3] </td>";
			echo"<td> $row[1] </td>";
			$vertify = '';
			switch($row[2])
			{
				case '0': $vertify = 'not checking';break;
				case '-1': $vertify = 'not handle'; break;
			}
			echo"<td> $vertify </td>";
			echo"<td>
				<form action = 'manager_check_repair.php' method='post'>
					<input type='hidden' name='report_id' value='$row[0]' >
					<input type='hidden' name='classroom_id' value='$row[3]'>
					<input type='hidden' name='reason' value='$row[1]'>
					<input type='submit' value='checking'>
				</form>
			     </td>";
			echo"<td>
				<form action = 'manager_handle_repair.php' method='post'>
					<input type='hidden' name='report_id' value='$row[0]'>
					<input type='hidden' name='classroom_id' value='$row[3]'>
					<input type='hidden' name='reason' value='$row[1]'>
					<input type='submit' value='handing'>
				</form>
			     </td>";
			echo"</tr>";
		}
		echo"</table>";
	}
	print<<<EOT
		<a href = "Manager_menu.html"><input type="button" value="Go Back"></a>
EOT;
	$conn->close();
?>
