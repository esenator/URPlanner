<?php
	// Create connection
	$con=mysqli_connect("localhost","root","EDS","URPlanner");

	// Check connection
	if (mysqli_connect_errno())
	{
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
	
	//Create local copy of courses
	$result = mysqli_query($con,"select * from courses");
	$courses[] =mysqli_fetch_array($result);
	while($row = mysqli_fetch_array($result))
	{
		$courses[] = $row;
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
	
	function advancedCSCTable(){
		global $con;
		$result = mysqli_query($con,"select course_id from major_requirements where major_id=1 and req_id=8");
		$html = "<table border=\"0\" cellpadding=\"2\">	<tr>";
		$i = 1;
		
		while($row = mysqli_fetch_array($result))
		{
			if($i %6 == 0){
				$html = $html."</tr><tr>";
			}
			
			$c = getCourseNumber($row['course_id']);
			$html = $html."<td><input type=\"checkbox\" name=\"".$c."\">".$c."</td>";
			$i = $i + 1;
		}
		
		$html = $html."</tr></table>";
		echo $html;
	}
	
	function getCourseNumber($id){
		global $courses;
		$id = $id - 1;
		$number = $courses[$id]['department']." ".$courses[$id]['course_num'];
		return $number;
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
				html += "<li>" + moreCourses[i].toUpperCase() +" </li>";
			}
			html+="</ul>";
			document.getElementById('addcourses').value = '';
			document.getElementById('addlist').innerHTML = html;
		}
		
		function addCredit(name){
			haveCredit.push(name);
			var html= "<ul>";
			for(i=0;i<haveCredit.length;i++){
				html += "<li>" + haveCredit[i].toUpperCase() +" </li>";
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
			<h2>Computer Science B.S.</h2><br>
			
			<h3>Premajor Requirements</h3><br>
			<b>You must take:</b> MTH 150, CSC 171, CSC 172.<br><br>
			<b>Choose one of the following:</b><br>
			<table border="0" cellpadding="2">
				<tr>
					<td><input type="radio" name="track1" value="req2" /></td>
					<td><input type="radio" name="track1" value="req3" /></td>
					<td><input type="radio" name="track1" value="req4" /></td>
				</tr>
				<tr>
					<td>MTH 141<br>MTH 142<br>MTH 143</td>
					<td>MTH 161<br>MTH 162</td>
					<td>MTH 171<br>MTH 172</td>
				</tr>
			</table>
			<h3>Core courses</h3><br>
			<b>You must take: </b> CSC 173, CSC 200, CSC 242, CSC 252, CSC 254, CSC 280, CSC 282<br><br>
			<b>Choose one of the following:</b>
			<table border="0" cellpadding="2">
				<tr>
					<td><input type="radio" name="track2" value="req5" /></td>
					<td><input type="radio" name="track2" value="req6" /></td>
					<td><input type="radio" name="track2" value="req7" /></td>
				</tr>
				<tr>
					<td>MTH 165</td>
					<td>MTH 173</td>
					<td>MTH 163<br>MTH 235</td>
				</tr>
			</table>
			
			<h3>Advanced Courses</h3><br>
			<b>Choose at least 3 of:</b><br>
			<?php advancedCSCTable() ?>
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
		<div id="addlist"><br></div>
		<br>
		<label for="havecredit">Courses you have credit for</label>
		<input id="havecredit">
		<button onClick="addCredit(document.getElementById('havecredit').value)">Add</button>
		<div id="havecreditlist"></div>
		<br><br>
		<button onClick="location.href='schedule.html'" >Continue</button>
	</div>
</body>
</html>
<?php mysqli_close($con); ?>
