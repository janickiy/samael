$(document).ready(function() {
	$("#show_nav").click(function(){
		$("#nav_mobile").addClass("visible");
	});
	$("#hide_nav").click(function(){
		$("#nav_mobile").removeClass("visible");
	});
});
$(document).ready(
	function()
	{
		$(".show_info").click(
			function()
			{
				$(this).toggleClass("info_open");
				var button = $(this);
				var container = $("[containerID="+ button.attr("trigerID") +"]");
				
				if(container.css("display") == "none")
					container.slideDown();
				else
					container.slideUp();
			}
		);
	}
);

$(document).ready(function() {
	$(".show_info").click(function(){
		if($(this).children().css("display") == "none")
			$(this).children().slideDown();
				else
			$(this).children().slideUp();
	});

});	