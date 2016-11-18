<html>
	<body>
    	<?php 
    	session_start();
		$con = mysql_connect("localhost", "root");
		if (!$con)
		{
			die('Could not connect: ' . mysql_error());
		}
		$username = $_POST["account"];
		$password = $_POST["password"];
		$db_selected = mysql_select_db("Classroom_Manage", $con);
		if (!$db_selected)
  		{
  			die ("Can\'t use C-REGISTRATION: " . mysql_error());
  		}
		$result = mysql_query("SELECT * FROM Student
		WHERE student_id = '$username' AND password = '$password'", $con);
		if (mysql_num_rows($result) == 0)
		{
			echo "<script>alert('账户信息有误');location.href='home.html';</script>"; 
		}
		$row = mysql_fetch_array($result);
		
		echo "welcome" . $row['name'] . '<br>';
		?>
        
	</body>
</html>