function cancel_button(paymentID)
    {
        var payID = parseInt(paymentID)
        Swal.fire
    ({
        title: "Are you sure?",
        text: "You Want To Cancel Booking?",
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
            window.location.href = "adminCancel.php?paymentID="+payID;
        }
    })
    }