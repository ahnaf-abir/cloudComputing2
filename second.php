<?php 
	session_start();
	require_once 'php/google-api-php-client/vendor/autoload.php';
?>
<!DOCTYPE html>
<html>
<head>
	<title>Weather today</title>
	<meta charset='UTF-8'>
	
	<link href='https://fonts.googleapis.com/css?family=Cabin' rel='stylesheet' type='text/css'>
	<link rel='stylesheet' type='text/css' href='/css/style.css'>
	
</head>
<body>
	<div id='header'>
		Weather for <?php echo htmlspecialchars($_GET['city'])?> is: 
		<p><a href="./index.php">Go back</a></p>
	</div>
	
	<div class='content'>
	<?php
		$client = new Google_Client();
		$client->useApplicationDefaultCredentials();
		$client->addScope(Google_Service_Bigquery::BIGQUERY);
		$bigquery = new Google_Service_Bigquery($client);
		$projectId = 'project-1558';


		$request = new Google_Service_Bigquery_QueryRequest();
		$str = '';
		
		$city = htmlspecialchars($_GET['city']);
		$date = htmlspecialchars($_GET['date']);
		$month = htmlspecialchars($_GET['month']);
		$year = htmlspecialchars($_GET['year']);

		$request->setQuery("SELECT stn, year, mo, da, max, min 
FROM [bigquery-public-data:noaa_gsod.gsod2018]
where stn ='996470' and year ='$year'and mo='0$month' and da='$date'");
		
		$response = $bigquery->jobs->query($projectId, $request);
		$rows = $response->getRows();

		$str = "<table>".
		"<tr>" .
		"<th>Station</th>" .
		"<th>Year</th>" .
		"<th>Month</th>" .
		"<th>Date</th>" .
		"<th>Max</th>" .
		"<th>Min</th>" .
		"</tr>";
		
		foreach ($rows as $row)
		{
			$str .= "<tr>";

			foreach ($row['f'] as $field)
			{
				$str .= "<td>" . $field['v'] . "</td>";
			}
			$str .= "</tr>";
		}

		$str .= '</table></div>';

		echo $str;
	?>
	</div>
</body>
</html>
