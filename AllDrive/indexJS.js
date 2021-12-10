
/*Navigation Bar Javascript*/

/*Prevent dropdown menu from closing when click inside the form*/
$(document).on("click", ".action-buttons .dropdown-menu", function(e){
	e.stopPropagation();
});

/*Image Slider Javascript*/

$(document).ready(function(){
	// Highlight bottom nav links
	var clickEvent = false;
	$("#myCarousel").on("click", ".nav a", function(){
		clickEvent = true;
		$(this).parent().siblings().removeClass("active");
		$(this).parent().addClass("active");		
	}).on("slid.bs.carousel", function(e){
		if(!clickEvent){
			itemIndex = $(e.relatedTarget).index();
			targetNavItem = $(".nav li[data-slide-to='" + itemIndex + "']");
			$(".nav li").not(targetNavItem).removeClass("active");
			targetNavItem.addClass("active");
		}
		clickEvent = false;
	});
});