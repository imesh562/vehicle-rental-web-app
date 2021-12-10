
/*Navigation Bar Javascript*/

/*Prevent dropdown menu from closing when click inside the form*/
$(document).on("click", ".action-buttons .dropdown-menu", function(e){
	e.stopPropagation();
});

$(document).ready(function () {
  // MDB Lightbox Init
  $(function () {
    $("#mdb-lightbox-ui").load("mdb-addons/mdb-lightbox-ui.html");
  });
});