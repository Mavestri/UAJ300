
<?php
    session_start();
?>


<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="/res/css/dashModule.css">
        <link href="https://fonts.googleapis.com/css?family=Lato:100,300,300i,400" rel="stylesheet">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    </head>

    <body>
<!--
        <form>
            <input type="text" name="title">
            <input type="text" name="abstract">
            <input type="file" name="journal">

            <input type="submit">
        </form>
-->
        
    <form method="post" enctype="multipart/form-data">
        <table width="350" border="0" cellpadding="1" cellspacing="1" class="box">
            <tr> 
                <td width="246">
                <input type="hidden" name="MAX_FILE_SIZE" value="2000000">
                <input type ="text" name ="journalTitle" placeholder="Enter Title.">
                <input name="userfile" type="file" id="userfile"> 
                </td>
                <td width="80"><input name="upload" type="submit" class="box" id="upload" value=" Upload "></td>
            </tr>
        </table>
    </form>
    </body>
</html>


<?php

    if(isset($_POST['upload']) && $_FILES['userfile']['size'] > 0) {
        require_once "require_once('./inc/dbinfo.php');";
        $connection = mysqli_connect($dbserver, $dbusername, $dbpassword, $database);
        $title = filter_var(trim($_POST['journalTitle']), FILTER_SANITIZE_STRING);  
        $fileName = $_FILES['userfile']['name'];
        $tmpName  = $_FILES['userfile']['tmp_name'];
        $fileSize = $_FILES['userfile']['size'];
        $fileType = $_FILES['userfile']['type'];
        $date = date('Y-m-d H:i:s');
        $article_id = guidv4(openssl_random_pseudo_bytes(16));
        
        $fp      = fopen($tmpName, 'r');
        $content = fread($fp, filesize($tmpName));
        $content = addslashes($content);
        fclose($fp);
        
        $fileName = addslashes($fileName);
        $query = "INSERT INTO article_data (article_id, title, status, date, author_id, 'filename','filetype','filesize','filebody') VALUES ('$article_id', '$title', 'Submitted','$date'," .$_SESSION['user'].", '$fileName', '$fileType', '$fileSize', '$content')";
        $run_query = mysqli_query($connection, $query);
        
        if($run_query) {
            echo "File Uploaded.";
        } else {
            echo "File not uploaded.";
        }
         
    }

    //Generates UUID
//credit to Jack on stackoverflow
function guidv4($data)
{
    assert(strlen($data) == 16);

    $data[6] = chr(ord($data[6]) & 0x0f | 0x40); // set version to 0100
    $data[8] = chr(ord($data[8]) & 0x3f | 0x80); // set bits 6-7 to 10

    return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
}
    

?>

