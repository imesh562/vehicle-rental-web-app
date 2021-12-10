<?php

function check_login($conn)
{
	if(isset($_SESSION['login_id']))
	{
		$id = $_SESSION['login_id'];
		$chkquery="select * from customer_login where login_id ='$id' limit 1";

		$result = mysqli_query($conn,$chkquery);
		if($result && mysqli_num_rows($result) > 0)
		{
			$user_data = mysqli_fetch_assoc($result);
			return $user_data;
		}
	}
}

?>