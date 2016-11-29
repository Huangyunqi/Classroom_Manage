<html>
<head>
<title>view the schedule</title>
</head>
<body>
<?php
	session_start();
	$conn = new mysqli("localhost", "root", "", "Classroom_Manage");
	if($conn->connect_error)
	{
		die('Could not connect: ' . $conn->connect_error);
	}
	$user_type = $_SESSION['user_type'];
	$id = $_SESSION['user_id'];
	$query1 = "SELECT course_id FROM Student_course WHERE student_id = $id";
	$course_id_result = $conn->query($query1);
	$course_id = array();
	if($course_id_result->num_rows == 0)
	{
		echo "no result!";
	}
	
	else
	{
		while($course_row = $course_id_result->fetch_row())
		{
			$course_id[] = $course_row[0];  //将该学生要上的所有course_id先取出来
		}
		$course_num = count($course_id);
//		$course_mon = array();	$course_tue = array();	$course_wed = array();	$course_thu = array();	$course_fri = array(); $course_sat = array(); $course_sun = array();
//		echo "course_num is $course_num <br>";
		echo "<table border = '1'>
			<tr>
		<td> course_id </td>
			<td> course_name </td>
			<td> professor </td>
			<td> classroom </td>
			<td> week time </td>
			<td> week </td>
			<td> class time </td> 
			</tr>
			" ;
		for($i = 0; $i < $course_num; $i ++)
		{			
			$query2 = "SELECT * FROM Course WHERE course_id = $course_id[$i]";
			$course_result = $conn->query($query2);
			$row = $course_result->fetch_row();
			echo "<tr>";
			echo "<td> $row[0] </td>";
			echo "<td> $row[1] </td>";
			$query3 = "SELECT name FROM Professor WHERE professor_id = $row[2]";	
			$professor_result= $conn->query($query3);
			$_name = $professor_result->fetch_row();
			echo "<td> $_name[0] </td>";
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
		echo "</table>";
		
	}
	$conn->close();
?>

</body>
</html>
