<?php

	

	// Create connection
	$con=mysqli_connect("localhost","root","EDS","URPlanner");

	// Check connection
	if (mysqli_connect_errno())
	{
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
	
	$majors   = array();
	$minors   = array();
	$clusters = array();
	
		
	var_dump($_POST);
	
	//Create local copy of courses
	$result = mysqli_query($con,"select * from courses");
	
	while($row = mysqli_fetch_array($result))
	{
		$courses[$row['course_id']] = $row;
		
	}
	
	//Setting up majors
	function setUpMajors(){
		for ($i=0;$i<count($majors);$i++){
			echo "<h2>".$_POST['majors'][$i]."</h2>";
			echo "<div class=\"tabs\">\n
			<ul>
                	<li><a href=\"#tab1\">Pre-declaration Courses</a></li>
                	<li><a href=\"#tab2\">Core Courses</a></li>
                	<li><a href=\"#tab3\">Advanced Courses</a></li>
                </ul>";
			echo "<div id = \"tab1\">";
			//majorPreTab($majors[$i]);
			echo "</div>";
			echo "<div id = \"tab2\">";
			//majorCoreTab($majors[$i]);
			echo "</div>";
			echo "<div id = \"tab3\">";
			//majorAdvancedTab($majors[$i]);
			echo "</div>";
			echo "</div>";
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
		
		while($row = mysqli_fetch_array($result))
		{
			$requiredCourses[] = $row[course_id];
			echo $row[course_id]."<br>";
		}
		return $requiredCourses;
	}
	
	function enumerateTracks($sqlwheres)
	{
		global $con;
		$result = mysqli_query($con,"select track_id from major_requirements where ".$sqlwheres);
		while($row = mysqli_fetch_array($result))
		{
			$tracks[] = $row['track_id'];
		}
		$tracks = array_unique($tracks);
		
		return $tracks;
	}
	
	function getRequiredForSection($sqlwheres){
		global $con;
		$result = mysqli_query($con,"select course_id from major_requirements where ".$sqlwheres);
		while($row = mysqli_fetch_array($result))
		{
			$cs[] = $row['course_id'];
		}
		$cs = array_unique($tracks);
		
		return $cs;
	}
	
	function majorPreTab($maj_id){
		$tracks = enumerateTracks("major_id=".$maj_id." and is_pre_req=1");
	}
	
	function majorCoreTab($maj_id){
		$tracks = enumerateTracks("major_id=".$maj_id." and is_core=1");
	}
	
	function majorAdvancedTab($maj_id){
		
		$tracks = enumerateTracks("major_id=".$maj_id." and is_advanced=1");
		global $con;
		$result = mysqli_query($con,"select course_id from major_requirements where major_id=".$maj_id." ");
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
	
	<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css">
	<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
	<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
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
		
		$(function() {
			$( ".tabs" ).tabs();
		});
	</script>

</head>
<body>

	<div id="center">
		<h1>Customize your schedule</h1>
		<h2>Major</h2>
		
		<div id="centermajor">
			<?php if($_POST['major']== ?>
				
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
