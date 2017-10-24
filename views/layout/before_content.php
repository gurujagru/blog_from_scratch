<html>
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="/assets/js/view.js"></script>
    <link rel="stylesheet" type="text/css" href="/assets/main.css">
</head>
<body>
<?php
use blog\core\Session;

/*if(!isset($_SESSION)){
    header('Location:/');
}
echo isset($_SESSION['errorUpdate'])?'<h1 id="flash">' . $_SESSION['errorUpdate'] . '</h1>':null;
unset($_SESSION['errorUpdate']);*/
?>
<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="http://glob-blog.org">GLOB-BLOG</a>
        </div>
        <ul class="nav navbar-nav">
            <li class="active"><a href="http://glob-blog.org">Home</a></li>
            <?php if (Session::getSession('userId') == null ):?>
            <li><a href="/login">Login</a></li>
            <li><a href="/signup">Signup</a></li>
            <?php else:?>
                <li><a href="/article/my-articles">Moji clanci</a></li>
                <li><a href="/logout">Logout <?= ucfirst(Session::getSession('username'))?></a></li>
            <?php endif?>
        </ul>
    </div>
</nav>
<div class="container">

