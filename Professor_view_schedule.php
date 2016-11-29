<?php
	session_start();
	$conn = new mysqli("localhost", "root", "", "Classroom_Manage");
	if($conn->connect_error)
	{
		die('Could not connect: '. $conn->connect_erro);
	}
	$id = $_SESSION['user_id'];
	$query1 = "SELECT * FROM Course WHERE professor_id = '$id'";
	$result = $conn->query($query1);
	if($result->num_rows == 0)
	{
		echo"no result!";
	}	
	else
	{
		echo "<table border = '1'>
			<tr>
		<td> course_id </td>
			<td> course_name </td>
			<td> classroom </td>
			<td> week time </td>
			<td> week </td>
			<td> class time </td> 
			</tr>
			" ;
		while($row = $result->fetch_row())
		{
			echo "<tr>";
			echo "<td> $row[0] </td>";
			echo "<td> $row[1] </td>";
			echo "<td>" . $row[3] . "</td>";
			echo "<td>" . $row[4] . "-" . $row[5] ."</td>";
			switch($row[6])
			{
				case '1': echo"<td> Mon </td>";break;
				case '2': echo"<td> Tue </td>";break;
				case '3': echo"<td> Wed </td>";break;
				case '4': echo"<td> Thu </td>";break;
				case '5': echo"<td> Fri </td>";break;
				case '6': echo"<td> Sat </td>";break;
				case '7': echo"<td> Sun </td>";break;
			}
			echo "<td>" . $row[7] . "-" . $row[8] . "</td>"; 
			echo "</tr>";
		}
		echo"</table>";
	}
	$conn->close();
?>
