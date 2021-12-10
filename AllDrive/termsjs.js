/*Navigation Bar Javascript*/

/*Prevent dropdown menu from closing when click inside the form*/
$(document).on("click", ".action-buttons .dropdown-menu", function(e){
	e.stopPropagation();
});