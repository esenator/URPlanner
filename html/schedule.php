<?php
	
	
	/* PHP index:
	- Variables
	- Scheduling methods
	- Formatting output methods
	- Class definitions
	*/
	
	//Global Variables
	$canTake 		= array(); //Courses whose prereqs have been satisfied
	$mustTake 		= array(); //Courses that are yet to be taken
	$hasCreditFor 	= array(); //Courses that the student has credit for.
	$semesters 		= array(); //An array of semesters
	$prereqEdges 	= array(); //The implementation of a graph, courses are nodes.
	$courses		= array(); //Local copy of the courses in the schedule. Multiple purposes.
	//Initializing them
	//fillLocalCourses();
	//buildPrereqGraph();
	
	//--Initializer.
	//--Fills $prereqEdges with edges from A to B where
	//--A is a prerequisite of B
	function buildPrereqGraph(){
		global $courses;
		foreach ($courses as $course){
			
		}
	}
	function fillLocalCourses(){
		
	}
	
	//The Scheduling Function
	function schedule(){
		global $canTake;
		global $mustTake;
		global $semesters;
		global $years;
		
		$isFall = true;
		for($i=0; $i<$years*2; $i++){
			$sem = new Semester();
			$limit = 19;
			
			//Find courses that don't have awaiting prereqs
			$canTake = getTakeableCourses($isFall);
			
			//Sort them so that the course that satisfies most prerequisites is last
			//(So that it can be popped)
			$canTake = sortByPrereqs($canTake);
			
			$withinLimit = true;
			while($withinLimit and count($canTake)>0){
				$c = array_pop($canTake);
				
				$ccredits = $c->credits;
				if(count($c->concurrent)>0){
					//ADD CODEHERE
				}
			}
			
			//Add this semester to the main array.
			$semesters[] = $sem;
			$isFall = !$isFall;
		}
	}
	
	function getTakeableCourses($isFall){
		
	}
	
	//--Helper function for schedule()
	//--Sorts an array of courses by the number of courses it is a prerequisite for
	function sortByPrereqs($courseArray){
		return usort($courseArray);
	}
	
	//----Helper for sortByPrereqs
	//----Setting up a comparator for sorting by number of prereqs
	function sort_callback($a,$b){
		if( count($a->post) == count($b->post) ) {
			return 0;
		}
	}
	
	
	//Class definitions for JSON encoding
	class Schedule{
		var $majors;
		var $minors;
		var $clusters;
		var $years;
		var $courses;
	}
	class Major{
		var $title;
		var $predec;
		var $core;
		var $advanced;
	}
	class Minor{
		var $title;
		var $predec;
		var $core;
		var $advanced;
	}
	class Cluster{
		var $title;
		var $courses;
	}
	class Year{
		var $title;
		var $semesters;
	}
	class Semester{
		var $title;
		var $courses;
	}
	class Course{
		var $name;
		var $title;
		var $id;
		var $clas;
		var $credits;
		var $concurrent = array();
		var $pre = array();
		var $post = array();
	}
	
	$a = new Year();
	$a = new Semester();
	$a = new Cluster();
	$a = new Major();
	$a = new Minor();
	$a = new Schedule();
	echo "No syntax error yet :/";
?>
