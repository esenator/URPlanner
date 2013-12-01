<?php
	// Create connection
	$con=mysqli_connect("localhost","root","EDS","URPlanner");

	// Check connection
	if (mysqli_connect_errno())
	{
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
	
	
	function getCourses($maj)
	{
		$result = mysqli_query($con,"select * from majors where major_name=\"".$maj."\"");
		$row = mysqli_fetch_array($result);
		echo $row['major_id'];
	}
	
	function getRequiredCourses($majID)
	{
		global $con;
		$result = mysqli_query($con,"select * from major_requirements where major_id=".$majID." and track_id is NULL and req_id is NULL;");
		
		$requiredCourses = [];
		while($row = mysqli_fetch_array($result))
		{
			$requiredCourses = $row[course_id];
			//echo $row[course_id]."<br>";
		}
		var_dump($requiredCourses);.
		return $requiredCourses;
	}
	
	
	
	mysqli_close($con);
?> 

<html>
<body>
	<?php 
		getRequiredCourses(1); 
		echo "<br>something";
	?>
</body>
</html>
