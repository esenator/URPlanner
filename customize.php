<?php
	// Create connection
	$con=mysqli_connect("localhost","root","EDS","URPlanner");

	// Check connection
	if (mysqli_connect_errno())
	{
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
	
	class major
	{
		var $groupType
		var $id;
		var $tracks;
		var $courses;
		
		function major($name)
		{
			global $con;
			$result = mysqli_query($con,"select * from major_requirements where major_name=".$name);
			$row = mysqli_fetch_array($result);
			
			$this->id=$row['major_id']
			
		}
	}
	class minor
	{
		var $id;
		var $tracks;
		var $courses;
		
		function minor($name)
		{
			global $con;
			$result = mysqli_query($con,"select * from minor_requirements where minor_name=".$name);
			$row = mysqli_fetch_array($result);
			
			$this->id=$row['minor_id']
			
		}
	}
	
	
	
	function getCourses($maj)
	{
		global $con;
		$result = mysqli_query($con,"select * from majors where major_name=\"".$maj."\"");
		$row = mysqli_fetch_array($result);
		echo $row['major_id'];
	}
	
	function getRequiredCourses($majID)
	{
		global $con;
		$result = mysqli_query($con,"select * from major_requirements where major_id=".$majID." and track_id is NULL and req_id is NULL;");
		var_dump($result);
		while($row = mysqli_fetch_array($result))
		{
			$requiredCourses[] = $row[course_id];
			echo $row[course_id]."<br>";
		}
		var_dump($requiredCourses);
		return $requiredCourses;
	}
	
	function enumerateTracks($majID)
	{
		global $con;
		$result = mysqli_query($con,"select track_id from major_requirements where major_id=".$majID);
		while($row = mysqli_fetch_array($result))
		{
			$tracks[] = $row['track_id'];
		}
		$tracks = array_unique($tracks);
		print_r($tracks);
		
		return $tracks;
	}
	
	function enumerateReqsForTrack($majID, $trackID)
	{
		global $con;
		$result = mysqli_query($con,"select track_id from major_requirements where major_id=".$majID." and track_id=".$trackID);
		while($row = mysqli_fetch_array($result))
		{
			$reqs[] = $row['req_id'];
		}
		$reqs = array_unique($reqs);
		return $reqs;
	}
	
	
?> 

<html>
<body>
	<?php 
		enumerate(1); 
		echo "<br>something";
	?>
</body>
</html>
<?php mysqli_close($con); ?>
