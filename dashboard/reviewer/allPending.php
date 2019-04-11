<?php
	session_start();
	require_once('../../res/php/dbinfo.php');

?>
<!DOCTYPE html>
<html>
<head>
<link href="https://fonts.googleapis.com/css?family=Lato:100,300,300i,400" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="../../res/css/dashModule.css">

</head>

<body>
<div id="page">

	<table id="t01">
	<tr>
		<th colspan="8">All Submitted Articles</th>
	</tr>
	<tr>
	<th>Title</th>
	<th>Author</th>
	<th>Date</th>
	<th>Status</th>
	<th>Preferred Reviewer</th>
	<th>Conflict</th>
	<th>Requests</th>
	<th>Action</th>
	</tr>
	
	<?php
	
	$query_myarticles = "SELECT * FROM review_data AS r "
            . "LEFT JOIN article_data AS a ON r.article_id = a.article_id "
            . "LEFT JOIN user_data AS u ON author_id = user_id "
			. "WHERE r.reviewer_id = '{$_SESSION["user"]}' AND "
			. "r.assigned = 1;";
            
            
    $result1 = mysqli_query($connection, $query_myarticles);
	
    while($row = mysqli_fetch_array($result1)){
	
        echo "<tr>";
        echo "<td>". $row['title'] . "</td>";
        echo "<td>". $row['first_name'] . " " . $row['last_name'] . "</td>";
        echo "<td>". $row['date'] . "</td>";
		echo "<td>" . $row['status'] . "</td>";
		echo "<td>" . $row['preferred'] . "</td>";
		echo "<td>" . $row['cannot'] . "</td>";
		echo "<td>" . $row['requests'] . "</td>";
		echo "<th>" . "<button id=\"accept-button\"> Accept </button>" . "<button id=\"reject-button\"> Reject </button>" . "</th>";
        echo "</tr>";
    }?>
	</table>
    </div>
  
  



</div>
</body>
</html>
