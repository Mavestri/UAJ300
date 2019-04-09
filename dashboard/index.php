<?php
	session_start();
	
	if (!isset($_SESSION["loggedin"])) {
		header("Location: /login");
	}
?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="/res/css/dash.css">
        <link href="https://fonts.googleapis.com/css?family=Lato:100,300,300i,400" rel="stylesheet">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    
        <title>UAJ300 - Dashboard</title>
    </head>

    <body>
        <section id="header">
            <div style="display: table; height: 100%; overflow: hidden; margin-left: 20px;">
                <div style="display: table-cell; vertical-align: middle;">
                    <div id="title">UAJ 300 Dashboard</div>
                    <div id="path">Home</div>
                </div>
            </div>
        </section>

        <div id="embedWrapper">
            <iframe src="home.html" id="contentEmbed" frameBorder="0">Browser not compatible.</iframe>
        </div>

        <section id="sideNav">
            <ul>
                <li>
                    <a href="#" id="authorMenu" class="active1" onclick="return openSubmenu(this.id);"><i class="fas fa-user"></i>Author</a>
                    <ul id="author-stories">
                        <li><a href="#" class="active2" onclick="return openPage('author/submit_journal.php')">Submit Journal</a></li>
                        <li><a href="#" class="active2">My Journals</a></li>
                    </ul>
                <li>
                    <a href="#" id="reviewerMenu" class="active1" onclick="return openSubmenu(this.id);"><i class="fas fa-user"></i>Reviewer</a>
                    <ul id="reviewer-stories">
                        <li><a href="#" class="active2">My Pending Journals</a></li>
                        <li><a href="#" class="active2">All Pending Journals</a></li>
                        <li><a href="#" class="active2">My Recommendations</a></li>
                    </ul>
                <li>
                    <a href="#" id="editorMenu" class="active1" onclick="return openSubmenu(this.id);"><i class="fas fa-user"></i>Editor</a>
                    <ul id="editor-stories">
                        <li><a href="#" class="active2">Edit Users</a></li>
                        <li><a href="#" class="active2">Assign Reviewers</a></li>
                        <li><a href="#" class="active2">Journals Under Review </a></li>
                        <li><a href="#" class="active2">Reviewed Journals</a></li>
                    </ul>

                <li><a href="#" class="active1"><i class="fas fa-cog"></i>Settings</a></li>
                <li onclick="window.location.href='/login/logout.php';" style="cursor: pointer;"><a class="active1"> <i class="fas fa-sign-out-alt"></i>Logout</a></li>
            </ul>
        </section>
        
        <section id="sideBox">
            <img src="/res/img/logo.png" alt="Logo" class="logo" onclick="return openPage('home.html');" style="cursor: pointer;">
        </section>
    </body>

    <script type="text/javascript" src="/res/js/dash.js"></script>
</html>
