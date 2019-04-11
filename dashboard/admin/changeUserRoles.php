<?php session_start(); ?>

<!DOCTYPE html>

<html>
<head>
    <link rel="stylesheet" type="text/css" href="../../res/css/dashModule.css">
    <link href="https://fonts.googleapis.com/css?family=Lato:100,300,300i,400" rel="stylesheet">
</head>
<body>

    <div id = "submittedV">
	
	<?php 
		require_once('../../res/php/dbinfo.php');
		$query = "SELECT * FROM user_data WHERE reviewer_flag = 0 AND reviewer_request = 1";
		$result = mysqli_connect($connection, $query);
	?>
	
        <table id="t01">
        <tr>
			<th colspan ="5">List of Users</th>
		</tr>
		<tr>
            <th> Full Name </th>
            <th> Email </th>
            <th> Inistitution </th>
			<th> Current User Role </th>
			<th> Edit </th>
        </tr>
			<td> jon john </td>
			<td> john@john.jon </td>
			<td> john school for jons </td>
			<td> johnanoid </td>
			<td> <button onclick="return openPage('admin/userSettings.php')"> Edit </button> </td>
		
		<?php
			while($row = mysqli_fetch_array($result)){
				echo "<td>" . $row['first_name'] . " " . $row['last_name'] . "</td>";
				echo "<td>" . $row['email'] . "</td>";
				echo "<td>" . $row['institution'] . "</td>";
				echo "<td>" . "<button id=\"accept-button\"> Accept </button>" . "<button id=\"reject-button\"> Reject </button>" . "</td>";
			}
		?>	
		</table>
    </div>
</body>
<script type="text/javascript" src="../../res/js/dash.js"></script>
</html>