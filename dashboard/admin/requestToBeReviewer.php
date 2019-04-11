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
		$connection = mysqli_connect($dbserver, $dbusername, $dbpassword, $database);
		$query = "SELECT * FROM user_data WHERE reviewer_flag = 0 AND reviewer_request = 1";
		$result = mysqli_query($connection, $query);
	?>
	
        <table id="t01">
        <tr>
			<th colspan ="4">Requests to be Reviewer</th>
		</tr>
		<tr>
            <th> Full Name </th>
            <th> Email </th>
            <th> Inistitution </th>
			<th> Accept/Reject </th>
        </tr>
			
		<?php
			while($row = mysqli_fetch_array($result)){
				echo "<td>" . $row['first_name'] . " " . $row['last_name'] . "</td>";
				echo "<td>" . $row['email'] . "</td>";
				echo "<td>" . $row['institution'] . "</td>";
				echo "<th>" . "<button id=\"accept-button\"> Accept </button>" . "    " . "<button id=\"reject-button\"> Reject </button>" . "</th>";
			}
		?>	
		</table>
    </div>
</body>
</html>