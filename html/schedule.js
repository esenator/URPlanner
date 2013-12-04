//getting fun stuff from javascript.
$(function(){
	populateHTML();

	set_collapse($("img.collapse"));
	set_expand($("img.expand"));
	select_course($("button"));
	
	set_sorting($(".semester"));
});

var lastSelected = "";

function populateHTML() {
	populateLeft();
	populateCenter();
	populateRight();
}

function populateLeft() {
	var html = '<h2>Major' + populateLeftSection(schedule.majors);
	
	if (schedule.minors.length > 0)
		html += '<h2>Minor' + populateLeftSection(schedule.minors);
	
	if (schedule.clusters.length > 0)
		html += '<h2>Cluster' + populateClusters(schedule.clusters);
		
	document.getElementById('left').innerHTML = html;
}

function populateLeftSection(lst) {
	var courses = schedule.courses;
	var html = "";
	
	if (lst.length > 1)
		html += 's';
	html += '</h2>';

	for (var i in lst) {
		html += '<p><div><img src="res/DownWedge.png" alt="Expand" title="Expand" class="expand"/>' +
			'<span class="expandable">' + lst[i].title + '</span><ul>';
		
		
		if (lst[i].predec.length > 0) {
			html += '<li><img src="res/DownWedge.png" alt="Expand" title="Expand" class="expand"/>' + 
				'<span class="expandable">Pre-declaration Courses</span><ul>';
				
				
			for (var j in lst[i].predec) {
				course = courses[lst[i].predec[j]];
				html += '<li><button class="' + course.clas + '">' + course.name + '</button></li>';
			}
			
			html += '</ul></li>';
		}
		
		if (lst[i].core.length > 0) {
			html += '<li><img src="res/DownWedge.png" alt="Expand" title="Expand" class="expand"/>' + 
				'<span class="expandable">Core Courses</span><ul>';
				
			for (var j in lst[i].core) {
				course = courses[lst[i].core[j]];
				html += '<li><button class="' + course.clas + '">' + course.name + '</button></li>';
			}
			
			html += '</ul></li>';
		}
		
		if (lst[i].advanced.length > 0) {
			html += '<li><img src="res/DownWedge.png" alt="Expand" title="Expand" class="expand"/>' + 
				'<span class="expandable">Advanced Courses</span><ul>';
				
			for (var j in lst[i].advanced) {
				course = courses[lst[i].advanced[j]];
				html += '<li><button class="' + course.clas + '">' + course.name + '</button></li>';
			}
			
			html += '</ul></li>';
		}
		
		
		html += '</ul></div></p>';
	}
	
	return html;
}

function populateClusters(lst) {
	var html = "";
	var courses = schedule.courses;
	
	if (lst.length > 1)
		html += 's';
	html += '</h2>';
	
	for (var i in lst) {
		html += '<p><div><img src="res/DownWedge.png" alt="Expand" title="Expand" class="expand"/>' +
			'<span class="expandable">' + lst[i].title + '</span><ul>';
			
		for (var j in lst[i].courses) {
				course = courses[lst[i].courses[j]];
				html += '<li><button class="' + course.clas + '">' + course.name + '</button></li>';
			}
			
		html += '</ul></div></p>';
	}
	
	return html;
}

function populateCenter() {
	var all_courses = schedule.courses;
	var col_num, year, semester, sem_courses, course;
	var html = "";
	
	for (var i in schedule.years) {
		col_num = 1;
		year = schedule.years[i];
		
		html += '<h2>' + year.title + '</h2>';
		html += '<div class="semesters">';
	
		for (var i in year.semesters) {
			semester = year.semesters[i];
			sem_courses = semester.courses
		
			html += '<div class="col' + col_num + '">';
			html += '<ul class="connectedSortable semester">';
			html += '<li class="ui-default ui-disabled semester-header">' + semester.title + '</li>';
			for (var i in sem_courses) {
				course = all_courses[sem_courses[i]];
				html += '<li class="ui-default"';
		
				if (course.id != null)
					html += ' id="' + course.id + '"';
				
				if (course.clas != null)
					html += '><button class="' + course.clas + '">' + course.name + ': '
						+ course.title + '</button></li>';
				else html += '>' + course.name + ': ' + course.title + '</li>';
			}
			html += '</ul>';
			html += '</div>';
	
			col_num = col_num + 1;
		}


		html += '</div>';
		html += '<br class="clear"/>';
	}
	
	document.getElementById('years').innerHTML = html;
}

function populateRight() {
	var html = '<h2>Prerequisites</h2><p id="directions">Click on a course to see its prerequisites</p>';
	html += '<p>NOTE: this is not yet functional. Prerequisites will be highlighted, but this panel will not change.</p>';
	html += '<div id="prereq"></div>';
	document.getElementById('right').innerHTML = html;
}

/**
*collapses the review the user clicked on
*/
function set_collapse(UpArrow){
	UpArrow.click(function(){  
		$(this).parent().children("ul").first().slideUp();
		
		$(this).attr("src", "res/DownWedge.png");
		$(this).attr("alt", "Expand");
		$(this).attr("title", "Expand");
		$(this).attr("class", "expand");
		
		$(this).unbind("click");
		set_expand($(this));
	});
}

function set_expand(DownArrow){
	DownArrow.click(function(){
		$(this).parent().children("ul").first().slideDown();

		$(this).attr("src", "res/UpWedge.png");
		$(this).attr("alt", "Hide");
		$(this).attr("title", "Collapse");
		$(this).attr("class", "collapse");
		
		$(this).unbind("click");
		set_collapse($(this));
	});
}

function select_course(Button) {
	Button.click(function() {
		var clas = $(this).attr('class');
		var id = clas.toLowerCase();
		var curr = document.getElementById(id).style.background;
		
		if (lastSelected == id) {	// It is already the selected one
			toWhite(id);
//			hideRight();
			lastSelected = "";
		} else {
			toWhite(lastSelected);
			toColor(id);
//			showRight(id);
			lastSelected = id;
		}
	});
}

function toWhite(id) {
	var index = -1;
	for (var i in schedule.courses) {
		if (schedule.courses[i].id == id) {
			index = i;
			break;
		}
	}
	
	if (index < 0) return;
	
	var course = document.getElementById(id);
	course.style.background = "rgba(255, 255, 255, .5)";
	
	if (schedule.courses[index].concurrent != null) {
		var coIndex = schedule.courses[index].concurrent;
		var co = document.getElementById(schedule.courses[coIndex].id);
		co.style.background = "rgba(255, 255, 255, .5)";
	}
	
	var preInds = schedule.courses[index].pre;
	var pre;
	for (var i in preInds) {
		pre = document.getElementById(schedule.courses[preInds[i]].id);
		pre.style.background = "rgba(255, 255, 255, .5)";
	}
	
	var postInds = schedule.courses[index].post;
	var post;
	for (var i in postInds){
		post = document.getElementById(schedule.courses[postInds[i]].id);
		post.style.background = "rgba(255, 255, 255, .5)";
	}
}

function toColor(id) {
	var index = -1;
	for (var i in schedule.courses) {
		if (schedule.courses[i].id == id) {
			index = i;
			break;
		}
	}
	
	if (index < 0) return;
	
	var course = document.getElementById(id);
	course.style.background = "rgba(0, 255, 255, .5)";		// Cyan
	
	if (schedule.courses[index].concurrent != null) {
		var coIndex = schedule.courses[index].concurrent;
		var co = document.getElementById(schedule.courses[coIndex].id);
		co.style.background = "rgba(255, 255, 0, .5)";		// Yellow
	}
	
	var preInds = schedule.courses[index].pre;
	var pre;
	for (var i in preInds) {
		pre = document.getElementById(schedule.courses[preInds[i]].id);
		pre.style.background = "rgba(255, 0, 0, .5)";		// Red
	}
	
	var postInds = schedule.courses[index].post;
	var post;
	for (var i in postInds){
		post = document.getElementById(schedule.courses[postInds[i]].id);
		post.style.background = "rgba(0, 0, 255, .5)";		// Blue
	}
}

function hideRight() {
	alert('hiding');
	document.getElementById('prereq').slideUp();
	document.getElementById('directions').slideDown();
}

function showRight(id) {
	alert('showing');
	document.getElementById('directions').slideUp();
	var div = document.getElementById('prereq');
	
	html = '';
	
	div.innerHTML = html;
	
	div.slideDown();
	alert('done');
	/*
			<h3 id="course">CSC 172</h3>
			
			<h3 id="pre">Prerequisites for CSC 172:</h3>
			<ul>
				<li>CSC 171</li>
				<li>MTH 150</li>
			</ul>
			
			<h3 id="post">CSC 172 is a prerequisite for:</h3>
			<ul>
				<li>CSC 173</li>
				<li>CSC 252</li>
				<li>CSC 242</li>
				<li>CSC 200</li>
				<li>CSC 282</li>
			</ul>
			
			<h3 id="co">CSC 172 must be taken concurrently with:</h3>
			<ul>
				<li>CSC 172 Lab</li>
			</ul>
	*/
}

function set_sorting(Data) {
	Data.sortable({ items: "li:not(.ui-disabled)" });
	Data.sortable({ connectWith: ".connectedSortable" });
    Data.sortable({ placeholder: "ui-highlight" });
    
    Data.disableSelection();
}

