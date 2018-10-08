<?php 
	session_start();
	require_once 'php/google-api-php-client/vendor/autoload.php';
?>
<!DOCTYPE html>
<html>
 <head>
      <title>Weather Today</title>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
     <link rel="stylesheet" type="text/css" href="css/style.css">
  </head>
<body>
	 <?php include("nav.php") ?>
      <div class="container">
	<div id='header'>
		<h1>Weather for <?php echo htmlspecialchars($_GET['city'])?> is: </h1>
	</div>
	
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
		"<th>State Name</th>" .
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

	 	$handle = fopen('gs://project-1558.appspot.com/cloud_assign2/searches'.date("Y-m-d h:i:sa").'.txt','w');

	 	fwrite($handle, "User searched at ".date("Y-m-d h:i:sa")." ------ "."City : ".$city.", Date : ".$date.", Month- ".$month.", Year: ".$year);

		

		fclose($handle);
		

	?>
	
</div>
</body>
</html>
