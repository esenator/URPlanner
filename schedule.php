<?php
function schedule($courses, $prereqEdges,$startYear,$startInFall,$years)
{
	var $years = [];
	
	for($i=1;$i < $years ; $i++)
	{
		
	}
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
}

class semester
{
	var $title;
	var $courses;
}
?>
<html>
Test.

</html>
