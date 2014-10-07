<?php
	if(isset($_GET['qid']) && isset($_GET['password'])) {
		require_once('../config.php');
		if($_GET['password'] != $adminpassword) {
			echo 'invalid password';
			die();
		}
		$conn;
		// Check connection
		if (mysqli_connect_errno()) {
		  echo "Failed to connect to MySQL: " . mysqli_connect_error();
		}
		$query = "SELECT * FROM response JOIN user ON user.user_id=response.user_id WHERE resource_id = '".$_GET['qid']."'";
		$result = mysqli_query($conn,$query);
?>
	<style>
	table, th, td {
		border:1px solid #333;
		padding:10px;
	}
	</style>
	<table>
	<tr>
		<th>User ID</th><th>Name</th><th>Image</th><th>Response</th><th>Location</th><th>Response ID</th><th>Date</th>
	</tr>
<?php
		while($row = mysqli_fetch_array($result)) {
?>
	<tr>
		<td><?php echo $row['user_id'];?></td>
		<td><?php echo $row['fullname'];?></td>
		<td><img src='<?php echo $row['image_url'];?>' width='200' /></td>
		<td style='width:300px;'><?php echo $row['response_body'];?></td>
		<td><?php echo $row['location'];?></td>
		<td><?php echo $row['response_id'];?></td>
		<td><?php echo $row['create_time'];?></td>
	</tr>
<?php
			//echo $row['response_body'];
		}
		
		mysqli_close($con);

?>
	</table>
<?php
	} else {
?>
<form>
	<label for='qid'>Resource ID: </label><input name='qid' />
	<label for='qid'>Password: </label><input name='password' />
	<input type="submit" />
</form>
<?php
	}
?>