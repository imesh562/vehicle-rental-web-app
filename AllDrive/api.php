<!DOCTYPE html>
<html>
<head>
	<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
	<title></title>
</head>
<body>
	<?php
        // Fetching JSON
		$req_url = 'https://v6.exchangerate-api.com/v6/0820f7f6c3d3b40606fa7500/latest/LKR';
		$response_json = file_get_contents($req_url);

		// Continuing if we got a result
		if(false !== $response_json) {

		    // Try/catch for json_decode operation
		    try {

				// Decoding
				$response = json_decode($response_json);

				// Check for success
				if('success' === $response->result) {

					// YOUR APPLICATION CODE HERE, e.g.
					$rate = $response->conversion_rates->USD;
					echo $rate;

				}

		    }
		    catch(Exception $e) {
		        echo "API ERROR";
		    }

		}
?>
</body>
</html>