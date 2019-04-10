<?php
    session_start();
?>

<!DOCTYPE html>

<html>
<head>
    <link rel="stylesheet" type="text/css" href="../../res/css/dashModule.css">
        <link href="https://fonts.googleapis.com/css?family=Lato:100,300,300i,400" rel="stylesheet">
</head>
<body>
    
    
    <div id = "submittedV">
        <table id = "t01" align = center>
        <th colspan = "4"> My Submitted Journals </th>
        <tr>
            <th id = "leftC"> Title </th>
            <th> Date </th>
            <th> Feedback </th>
            <th id = "rightC"> Status </th>
        </tr>
          <?php
               require_once('../../res/php/dbinfo.php');
                $connection = mysqli_connect($dbserver, $dbusername, $dbpassword, $database);
                $query = "SELECT article_id, title, date, status FROM article_data WHERE author_id ='{$_SESSION['user']}'";
                $result = mysqli_query($connection, $query);

                while($row = mysqli_fetch_array($result)):  
                ?>
            <tr>
                <td> <a class href="downloadArticle.php?articleid=<?php echo $row['article_id'] ?>"> <?php echo $row['title'] ?></a> </td>
                <td> <?php echo $row['date'] ?></td>
                <td> <?php echo "Fill in later"?></td>
                <td> <?php echo $row['status'] ?> </td>
            </tr>
        <?php endwhile; ?>
        </table>
    </div>
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
            header("Content-length: $size");
            header("Content-type: $type");;
            //header("Content-Disposition: attachment; filename=$name");
            echo $result['filebody'];
           //echo $content;
        }
    }

?>
