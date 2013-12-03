<?php
function scheduleit($majors,$minors,$clusters, $prereqEdges,$startYear,$startInFall,$years)
{
	//Populate semesters
	for($i=;$i < +$years ; $i++)
	{
		if($startInFall){
			$years[] = array(new semester("Fall ".$startYear+$i),new semester("Spring ".$startYear +$i+ 1));
		}
		else{
			$years[] = array(new semester("Spring ".$startYear+$i),new semester("Fall ".$startYear+$i));
		} 
	}
	
	//Extract courses from majors/minors/clusters
}

class schedule
{
	var $majors;
	var $minors;
	var $clusters;
	var $years;
	var $courses;
}

class major
{
	var $title;
	var $predec;
	var $core;
	var $advanced;
}


class minor
{
	var $title;
	var $predec;
	var $core;
	var $advanced;
}

class cluster
{
	var $title;
	var $courses;
}

class course
{
	var $title;
	var $id;
	var $clas;
	var $credits;
	var $concurrent;
	var $pre;
	var $post;
}

class year
{
	var $title;
	var $semesters;
	
	function __construct(){
		
	}
}

class semester
{
	var $title;
	var $courses;
	
	function __construct($title){
		$this->title = $title;
	}
}
?>
<html>
Test.

</html>
