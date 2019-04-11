<?php
	session_start();
	require_once('../../res/php/dbinfo.php');
	
	function get_buttons()
	{
		$str=' ';
		$btn=array(
		
		1=>'Accept',
		2=>'Reject',
		3=>'Major Revision',
		4=>'Minor Revision',);
		
		while(list($k,$v)=each($btn))
		{
			$str.='<input type="submit" value="'.$v.'"name="btn_'.$k.'"id="btn_'.$k.'"/>';
		}
		return $str;
	}
?>

<!DOCTYPE html>
<html>
<head>
<link href="https://fonts.googleapis.com/css?family=Lato:100,300,300i,400" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="../../res/css/dashModule.css">
</head>

<body>
<form action="<?php echo $SERVER['PHP_SELF'];?>" method="post">
<div id="page">

	<table id="t01">
	<tr>
		<th colspan="5">My Articles</th>
	</tr>
	<tr>
	<th>Title</th>
	<th>Author</th>
	<th>Date Uploaded</th>
	<th>Feedbacks</th>
	<th>Actions</th>
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
        echo "<td>" . $row['title'] . "</td>";
        echo "<td>" . $row['first_name'] . " " . $row['last_name'] . "</td>";
        echo "<td>" . $row['date'] . "</td>";
		echo "<td>" . $row['recommendation'] . "</td>";
		echo "<td>" . get_buttons() . "</td>";
        echo "</tr>";
    }?>
	</table>

</div>
</form>
</body>
</html>
