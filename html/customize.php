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
	
	
?> 

<html>
<head>
	<link rel="stylesheet" href="p2styles.css" type = "text/css">
	<title>Customize your schedule</title>
	
	<script>
		
		var moreCourses	= new Array();
		var haveCredit	= new Array();
		
		function addCourse(name){
			moreCourses.push(name);
			var html= "<ul>";
			for(i=0;i<moreCourses.length;i++){
				html += "<li>" + moreCourses[i] +" </li>";
			}
			html+="</ul>";
			document.getElementById('addcourses').value = '';
			document.getElementById('addlist').innerHTML = html;
		}
		
		function addCredit(name){
			haveCredit.push(name);
			var html= "<ul>";
			for(i=0;i<haveCredit.length;i++){
				html += "<li>" + haveCredit[i] +" </li>";
			}
			html+="</ul>";
			document.getElementById('havecredit').value = '';
			document.getElementById('havecreditlist').innerHTML = html;
		}
	</script>
</head>
<body>
	<div id="left">
		<h2>Major</h2>
			<p><ul>
			<li>Computer Science B.S.</li>
			</ul></p>
		<h2>Minor</h2>
			<p><ul>
			<li>Mathematics</li>
			</ul></p>
		<h2>Cluster</h2>
			<p><ul>
			<li>Ethics and Values</li>
			<li>Psychology as a Social Science</li>
			</ul></p>
	</div>
	
	<div id="center">
		<h1>Customize your schedule</h1>
		<h2>Major</h2>
		
		<div id="centermajor">
			
		</div>
		
		<div id="centerminor">
		
		</div>
		
		<div id="centercluster">
		
		</div>
	</div>
	
	<div id="right">
		<label for="addcourses">Other Courses to Add</label>
		<input id="addcourses">
		<button onClick="addCourse(document.getElementById('addcourses').value)">Add</button>
		<div id="addlist"></div>
		
		<label for="havecredit">Courses you have credit for</label>
		<input id="havecredit">
		<button onClick="addCredit(document.getElementById('havecredit').value)">Add</button>
		<div id="havecreditlist"></div>
	</div>
</body>
</html>
<?php mysqli_close($con); ?>
