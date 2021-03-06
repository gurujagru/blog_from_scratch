<!DOCTYPE html>
<html>
<head>
    <!--<meta charset="utf-8"/>-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Glob-blog</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="/assets/js/view.js"></script>
    <link rel="stylesheet" type="text/css" href="/assets/main.css">
</head>
<body>
<?php

use blog\core\Session;
?>
<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="http://glob-blog.test">GLOB-BLOG</a>
        </div>
        <ul class="nav navbar-nav">
            <li><a href="http://glob-blog.test">Početna</a></li>
            <?php if (Session::getSession('userId') == null): ?>
                <li><a href="/login" id="login">Prijava</a></li>
                <li><a href="/signup" id="sign-up">Registracija</a></li>
            <?php else: ?>
                <li><a href="/article/my-articles">Moji članci</a></li>
                <li><a href="/logout">Logout <?= ucfirst(Session::getSession('username')) ?></a></li>
            <?php endif ?>
        </ul>
    </div>
</nav>
<div class="container">
    <div class="pop-up">
        <div class="pop-up-content" id="ajaxLogin"></div>
    </div>

