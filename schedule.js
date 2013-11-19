//getting fun stuff from javascript.
$(function(){
	set_collapse($("img.collapse"));
	set_expand($("img.expand"));
	select_course($("button.MTH162"));
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
		var course = document.getElementById('mth162');
		course.style.background = "rgba(0, 255, 0, .7)";
		
		var pre = document.getElementById('mth161');
		pre.style.background = "rgba(255, 0, 0, .7)";
		
		var post = document.getElementById('mth165');
		post.style.background = "rgba(0, 0, 255, .7)";
	});
}


