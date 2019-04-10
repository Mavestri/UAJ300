
<html>
<head>
<title>Download File From MySQL</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>

<body>
<?php
    require_once('../../res/php/dbinfo.php');
    $connection = mysqli_connect($dbserver, $dbusername, $dbpassword, $database);
    $query = "SELECT article_id, title FROM article_data";
    $result = mysqli_query($connection, $query);

    while($row = mysqli_fetch_array($result)):  
?>
   <a class href="downloadArticle.php?articleid=<?php echo $row['article_id'] ?>"> <?php echo $row['title'] ?></a>
 
        <?php endwhile; ?>
</body>
</html>




<?php
    if(isset($_GET['articleid'])) {
        $articleid = $_GET['articleid'];
        $query = "SELECT filename, filetype, filesize, filebody FROM article_data WHERE article_id = '$articleid'";
        $run_query = mysqli_query($connection, $query);
        $result = mysqli_fetch_array($run_query);
        if ($run_query) {
            $name = $result['filename'];
            $size = $result['filesize'];
            $type = $result['filetype'];
            $content = $result['filebody'];
            header('Content-type: application/pdf');
    
        //header("Content-Disposition: attachment; filename=$name");
           echo $result['filebody'];
           //echo $content;
        }
    }

?>