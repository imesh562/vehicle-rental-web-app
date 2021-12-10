    /*table*/

$(document).ready(function(){
    $('.filterable .btn-filter').click(function(){
        var $panel = $(this).parents('.filterable'),
        $filters = $panel.find('.filters input'),
        $tbody = $panel.find('.table tbody');
        if ($filters.prop('disabled') == true) {
            $filters.prop('disabled', false);
            $filters.first().focus();
        } else {
            $filters.val('').prop('disabled', true);
            $tbody.find('.no-result').remove();
            $tbody.find('tr').show();
        }
    });

    $('.filterable .filters input').keyup(function(e){
        /* Ignore tab key */
        var code = e.keyCode || e.which;
        if (code == '9') return;
        /* Useful DOM data and selectors */
        var $input = $(this),
        inputContent = $input.val().toLowerCase(),
        $panel = $input.parents('.filterable'),
        column = $panel.find('.filters th').index($input.parents('th')),
        $table = $panel.find('.table'),
        $rows = $table.find('tbody tr');
        /* Dirtiest filter function ever ;) */
        var $filteredRows = $rows.filter(function(){
            var value = $(this).find('td').eq(column).text().toLowerCase();
            return value.indexOf(inputContent) === -1;
        });
        /* Clean previous no-result if exist */
        $table.find('tbody .no-result').remove();
        /* Show all rows, hide filtered ones (never do that outside of a demo ! xD) */
        $rows.show();
        $filteredRows.hide();
        /* Prepend no-result row if all rows are filtered */
        if ($filteredRows.length === $rows.length) {
            $table.find('tbody').prepend($('<tr class="no-result text-center"><td colspan="'+ $table.find('.filters th').length +'">No result found</td></tr>'));
        }
    });
});

    /* Scroll */

    $(function()
    {
      $(".menu a") .on('click',function()
      {
        $("html, body").animate({
          scrollTop:$($.attr(this, 'href')).offset().top
        },500);
      });

      if(window.location.hash){
        scroll(0,0);
        setTimeout(function(){
          scroll(0,0);
        },1);
      }

      if(window.location.hash){
        $("html, body").animate({
          scrollTop: $(window.location.hash).offset().top + 'px'
        },500);
      }

    });

/* cancel message */

    function remove_button(vehID)
    {
        var vehID = parseInt(vehID)
        Swal.fire
    ({
        title: "Are you sure?",
        text: "You Want To Remove This Vehicle?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#31bfb1",
        cancelButtonColor: "#e60000",
        confirmButtonText: "Yes",
        allowOutsideClick: false,
    }).
    then((result) => 
    {
        if (result.isConfirmed) 
        {
            window.location.href = "removeVehicle.php?vehID="+vehID;
        }
    })
    }

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


  /* cancel message */

    function remove_driv(drivID)
    {
        var drivID = parseInt(drivID)
        Swal.fire
    ({
        title: "Are you sure?",
        text: "You Want To Remove This Driver?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#31bfb1",
        cancelButtonColor: "#e60000",
        confirmButtonText: "Yes",
        allowOutsideClick: false,
    }).
    then((result) => 
    {
        if (result.isConfirmed) 
        {
            window.location.href = "removeDriver.php?drivID="+drivID;
        }
    })
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

function cancelReview_button(reviewID)
    {
        var reviewID = parseInt(reviewID)
        Swal.fire
    ({
        title: "Are you sure?",
        text: "You Want To Cancel This Review?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#31bfb1",
        cancelButtonColor: "#e60000",
        confirmButtonText: "Yes",
        allowOutsideClick: false,
    }).
    then((result) => 
    {
        if (result.isConfirmed) 
        {
            window.location.href = "reviewCancel.php?reviewID="+reviewID;
        }
    })
    }