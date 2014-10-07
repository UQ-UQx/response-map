<?php
	require_once('config.php');

	if (mysqli_connect_error()) {
		echo 'Failed to connect to question database: ' . mysqli_connect_error();
		die();
	}
	
	$location = $_POST['user_location'];
	
	$geocode = JSON_decode(file_get_contents("https://maps.googleapis.com/maps/api/geocode/json?address=" . urlencode($location) . "&sensor=false&key=" . $google_key));
	if ($geocode->status === 'OK') {
		$lat = $geocode->results[0]->geometry->location->lat;
		$lng = $geocode->results[0]->geometry->location->lng;
		
		$user_id = $_POST['user_id'];
		$update_response_query = mysqli_query($conn, 'UPDATE user SET location="'.$location.'",lat='.$lat.',lng='.$lng.' WHERE user_id="'.$user_id.'" LIMIT 1');		
	}
	$postvars = json_decode($_POST['postvars']);
?>
<html>
<head>
</head>
<body>
<p>Redirecting, please refresh your browser if the map doesn't appear</p>
<form action='index.php' method='post' name='redirect_frm'>
<?php
foreach ($postvars as $a => $b) {
echo "<input type='hidden' name='".htmlentities($a)."' value='".htmlentities($b)."'>";
}
?>
</form>
<script language="JavaScript">
document.redirect_frm.submit();
</script>
</body>
</html>

