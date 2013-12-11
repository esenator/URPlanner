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
                global $courses;
                $result = mysqli_query($con,"SELECT course_id FROM major_requirements WHERE major_id=1 AND req_id=8");

                while ($row = mysqli_fetch_array($result)) { 
                	$array[] = $row['course_id'];
                }
                
                // Match course_id to department and course_num for sorting
                foreach ($array as $id) {
                	$keys[] = $id;
                	$values[] = $courses[id-1]['department'] . $courses[$id-1]['course_num'];
                }
                
                // Sort a combined array (sorting the course_ids by the departent and course_num)
                $sorted = array_combine($keys, $values);
                asort($sorted);
                
                foreach (array_keys($sorted) as $id) {
                	$cid = getCourseId($id);
                    $name = getCourseName($id);
                	$html = $html . '<input type="checkbox" class="check1 CSCAdvanced" name="';
                    $html = $html . $cid . '" />' . $name . '<br />';
                }
                
                echo $html;
        }
        
        function getCourseId($id) {
        	global $courses;
            $id = $id - 1;
            $dep = strtolower($courses[$id]['department']);
            $number = $dep . $courses[$id]['course_num'];
            return $number;
        }
        
        function getCourseName($id){
            global $courses;
            $id = $id - 1;
            $number = $courses[$id]['department'] . " " . $courses[$id]['course_num'];
            $name = $number . ": " . $courses[$id]['course_name'];
            return $name;
        }
        
        
        function advancedMTHTable(){
        	global $con;
            global $courses;
                $result = mysqli_query($con,"SELECT course_id FROM minor_requirements WHERE minor_id=2 and req_id=8");

            while ($row = mysqli_fetch_array($result)) { 
                $array[] = $row['course_id'];
            }
                
            // Match course_id to department and course_num for sorting
            foreach ($array as $id) {
                $keys[] = $id;
                $values[] = $courses[id-1]['department'] . $courses[$id-1]['course_num'];
            }
                
            // Sort a combined array (sorting the course_ids by the departent and course_num)
            $sorted = array_combine($keys, $values);
            asort($sorted);
                
            foreach (array_keys($sorted) as $id) {
                $cid = getCourseId($id);
                $name = getCourseName($id);
                $html = $html . '<input type="checkbox" class="check2 MTHAdvanced" name="';
                $html = $html . $cid . '" />' . $name . '<br />';
            }

            echo $html;
        }
?> 

<html>
	 <head>
        <meta charset="utf-8">
        <title>Customize your Schedule</title>
		<link rel="stylesheet" href="customize.css" type = "text/css">
		<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
		<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
		<script src="customize.js" type="text/javascript"></script>
        <script>
			$(function() {
				$( ".tabs" ).tabs();
			});
		</script>
    </head>
    
	<body>
        <h1>Customize your schedule</h1>
        
		<h2>Major: Computer Science BS</h2>
            <div class="tabs">
                <ul>
                	<li><a href="#tab1">Pre-declaration Courses</a></li>
                	<li><a href="#tab2">Core Courses</a></li>
                	<li><a href="#tab3">Advanced Courses</a></li>
                </ul>
                	
                <div id="tab1">
                	<h3>You must take the following courses:</h3>
                	<ul>
                		<li>MTH 150: Discrete Mathematics</li>
                		<li>CSC 171: The Science of Programming</li>
                		<li>CSC 172: The Science of Data Structures</li>
                	</ul>
                		
                	<h3>Please select one of the following options:</h3>
                	<input type="radio" name="track1" value="req1" checked="true">
                		MTH 161: Calculus IA
                		<br />
                		<span>MTH 162: Calculus IIA</span>
                	</input>
                	<br />
                	<br />
            		<input type="radio" name="track1" value="req2">
            			MTH 171: Honors Calculus I
            			<br />
                		<span>MTH 172: Honors Calculus II</span>
                	</input>
            		<br />
            		<br />
            		<input type="radio" name="track1" value="req3">
            			MTH 141: Calculus I
                		<br />
                		<span>MTH 142: Calculus II</span>
                		<br />
            			<span>MTH 143: Calculus III</span>
            		</input>
            	</div>
                	
                <div id="tab2">
            		<h3>You must take the following courses:</h3>
            		<ul>
            			<li>CSC 173: Computation and Formal Systems</li>
            			<li>CSC 242: Artificial Intelligence</li>
                		<li>CSC 252: Computer Organization</li>
                		<li>CSC 254: Programming Language Desing & Impletation</li>
                		<li>CSC 280: Computer Models and Limitations</li>
            			<li>CSC 282: Design and Analysis of Efficient Algorithms</li>
            			<li>CSC 200: Undergraduate Problem Seminar</li>
            		</ul>
                		
                	<h3>Please select one of the following options:</h3>
                	<input type="radio" name="track2" value="req4" checked="true">
            			MTH 165: Linear Algebra with Differential Equations
            		</input>
            		<br />
            		<input type="radio" name="track2" value="req5">
                		MTH 173: Honors Calculus III
                	</input>
                	<br />
            		<input type="radio" name="track2" value="req6">
            			MTH 163: Ordinary Differential Equations I
            			<br />
            			<span>MTH 235: Linear Algebra</span>
                	</input>
                </div>
            	
            	<div id="tab3">
            		<h3 class="3">Please select three of the following options:</h3>
                	<?php advancedCSCTable() ?>
            	</div>
            </div>
            
            
            <h2>Minor: Mathematics</h2>
                <div class="tabs">
                	<ul>
                		<li><a href="#tab4">Pre-declaration Courses</a></li>
                		<li><a href="#tab5">Core Courses</a></li>
                		<li><a href="#tab6">Advanced Courses</a></li>
                	</ul>
                	
                	<div id="tab4">
                		<h3>Please select one of the following options:</h3>
                		<input type="radio" name="track3" value="req7" checked="true" />
                			MTH 150: Discrete Mathematics
                		<br />
                		<input type="radio" name="track3" value="req8" />
                			MTH 164: Multidimensional Analysis
                		<br />
                		<input type="radio" name="track3" value="req9" />
                			MTH 174: Honors Calculus IV
                			
                		<h3>Please select one of the following options:</h3>
                		<input type="radio" name="track4" value="req10" />
                			MTH 163: Ordinary Differential Equations I
                		<br />
                		<input type="radio" name="track4" value="req11" checked="true" />
                			MTH 165: Linear Algebra with Differential Equations
                		<br />
                		<input type="radio" name="track4" value="req12" />
                			MTH 173: Honors Calculus III
                			
                		<h3>Please select one of the following options:</h3>
                		<input type="radio" name="track5" value="req13" checked="true">
                			MTH 161: Calculus IA
                			<br />
                			<span>MTH 162: Calculus IIA</span>
                		</input>
                		<br />
                		<br />
                		<input type="radio" name="track5" value="req14">
                			MTH 171: Honors Calculus I
                			<br />
                			<span>MTH 172: Honors Calculus II</span>
                		</input>
                		<br />
                		<br />
                		<input type="radio" name="track5" value="req15">
                			MTH 141: Calculus I
                			<br />
                			<span>MTH 142: Calculus II</span>
                			<br />
                			<span>MTH 143: Calculus III</span>
                		</input>
                	</div>
                	
                	<div id="tab5">
                		<h3>Please select one of the following options:</h3>
                		<input type="radio" name="track6" value="req16" />
                			MTH 173: Honors Calculus III
                		<br />
                		<input type="radio" name="track6" value="req17" checked="true" />
                			MTH 235: Linear Algebra
                	</div>
                	
                	<div id="tab6">
                		<h3 class="2">Please select two of the following options:</h3>
                		<?php advancedMTHTable() ?>
                	</div>
                </div>
        
        <button>Continue</button>
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
