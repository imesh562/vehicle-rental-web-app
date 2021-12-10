/*Navigation Bar Javascript*/

/*Prevent dropdown menu from closing when click inside the form*/
$(document).on("click", ".action-buttons .dropdown-menu", function(e){
	e.stopPropagation();
});

function check_pass() 
  {
    if (document.getElementById('password1').value != document.getElementById('confirm_password').value) 
      {
        document.getElementById('confirm_password').setCustomValidity("Passwords Don't Match");
      } 
      else 
      {
        document.getElementById('confirm_password').setCustomValidity("");
      }
  }


login = $(function() {
  $("#log_click").on("click", function(e) {
    $("#login_drop").toggleClass("show");
  });
  $(document).on("click", function(e) {
    if ($(e.target).is("#log_click") === false) {
      $("#login_drop").removeClass("show");
    }
  });
});