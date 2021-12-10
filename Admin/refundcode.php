<?php
class refund
{
	function eligibleAmount($bookDate,$cancelDate,$amount)
	{
		$datetime1 = new DateTime($bookDate);
		$datetime2 = new DateTime($cancelDate);
		$time = $datetime1->diff($datetime2);

		$minutes = $time->days * 24 * 60;
		$minutes += $time->h * 60;
		$minutes += $time->i;

		if($minutes<360)
		{
			return (round($amount, 2));
		}
		else if ($minutes<1440)
		{
			return (round(($amount*0.9), 2));
		}
		else
		{
			return (round(($amount*0.75), 2));
		}
	}
}
?>