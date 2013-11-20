//getting fun stuff from javascript.
$(function(){
	set_collapse($("img.collapse"));
	set_expand($("img.expand"));
	select_course($("button"));
	
	set_table_sorting($(".semester"));
});


/**
*collapses the review the user clicked on
*/
function set_collapse(UpArrow){
	UpArrow.click(function(){  
		$(this).parent().children("ul").first().slideUp();
		
		$(this).attr("src", "Images/DownWedge.png");
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

		$(this).attr("src", "Images/UpWedge.png");
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
		
		if (clas == "MTH162") {
			if (document.getElementById('mth162').style.background == "none repeat scroll 0% 0% rgba(0, 255, 0, 0.7)") {
				mthToWhite();
			} else {
				cscToWhite();
				mthToColors();
			}
		} else if (clas == "CSC172") {
			if (document.getElementById('csc172').style.background == "none repeat scroll 0% 0% rgba(0, 255, 0, 0.7)") {
				cscToWhite();
			} else {
				mthToWhite();
				cscToColors();
			}
		}
	});
}

function mthToWhite() {
	var course = document.getElementById('mth162');
	var pre = document.getElementById('mth161');
	var post = document.getElementById('mth165');
	
	// Go back to default (white)
	course.style.background = "rgba(255, 255, 255, .7)";
	pre.style.background = "rgba(255, 255, 255, .7)";
	post.style.background = "rgba(255, 255, 255, .7)";
}

function mthToColors() {
	var course = document.getElementById('mth162');
	var pre = document.getElementById('mth161');
	var post = document.getElementById('mth165');
	
	
	course.style.background = "rgba(0, 255, 0, .7)";	// Green
	pre.style.background = "rgba(255, 0, 0, .7)";		// Red
	post.style.background = "rgba(0, 0, 255, .7)";		// Blue
}

function cscToWhite() {
	var course = document.getElementById('csc172');
	var copre = document.getElementById('mth150');
	var co = document.getElementById('csc172L');
	var pre = document.getElementById('csc171');
			
	var postIds = ['csc173', 'csc200', 'csc242', 'csc252', 'csc282'];
	var posts = [];
	for (var i in postIds)
		posts.push(document.getElementById(postIds[i]));
		
	// Go back to default (white)
	course.style.background = "rgba(255, 255, 255, .7)";
	copre.style.background = "rgba(255, 255, 255, .7)";
	co.style.background = "rgba(255, 255, 255, .7)";
	pre.style.background = "rgba(255, 255, 255, .7)";
				
	for (var i in posts)
		posts[i].style.background = "rgba(255, 255, 255, .7)";
}

function cscToColors() {
	var course = document.getElementById('csc172');
	var copre = document.getElementById('mth150');
	var co = document.getElementById('csc172L');
	var pre = document.getElementById('csc171');
			
	var postIds = ['csc173', 'csc200', 'csc242', 'csc252', 'csc282'];
	var posts = [];
	for (var i in postIds)
		posts.push(document.getElementById(postIds[i]));
		
		
	course.style.background = "rgba(0, 255, 0, .7)";	// Green
	pre.style.background = "rgba(255, 0, 0, .7)";		// Red
	copre.style.background = "rgba(255, 127, 0, .7)";	// Orange
	co.style.background = "rgba(255, 255, 0, .7)";		// Yellow
				
	for (var i in posts)
		posts[i].style.background = "rgba(0, 0, 255, .7)";	// Blue
}

function set_table_sorting(Data) {
	Data.sortable({ items: "li:not(.ui-disabled)" });
	Data.sortable({ connectWith: ".connectedSortable" });
    	Data.sortable({ placeholder: "ui-highlight" });
    
    	Data.disableSelection();
}

