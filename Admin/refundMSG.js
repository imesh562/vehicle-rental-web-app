function refund_message(paymentID)
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
            window.location.href = "add2Refund.php?paymentID="+payID;
        }
    })
    }

    function confirm_message(bookID)
    {
        var bookID = parseInt(bookID)
        Swal.fire
    ({
        title: "Are you sure?",
        text: "You Want To Confirm Booking?",
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
            window.location.href = "confirmBook.php?bookID="+bookID;
        }
    })
    }
