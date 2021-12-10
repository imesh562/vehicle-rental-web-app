    /*Logout Message*/

function log_out_message()
    {
        Swal.fire
    ({
        title: "Are you sure?",
        text: "You Want To Log Out?",
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
            window.location.href = "log_out.php";
        }
    })
    }