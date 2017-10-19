<?php
if(!isset($_SESSION)){
    header('Location:/');
}
echo isset($_SESSION['errorUpdate'])?'<h1 id="flash">' . $_SESSION['errorUpdate'] . '</h1>':null;
unset($_SESSION['errorUpdate']);
?>
<style>
    #flash {
        color: red;
    }
</style>
<html>
    <head>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    </head>
    <body>
        <header>
            <h1>WELCOME <?=isset($_SESSION['username'])?ucfirst($_SESSION['username']):null ?></h1>
        </header>
        <nav><?php if (!isset($_SESSION['username'])):?>
                <a href="/login"><button>Login</button></a>
                <a href="/signup"><button>Signup</button></a>
            <?php else:?>
                <a href="/logout"><button>Logout <?= ucfirst($_SESSION['username'])?></button></a>
            <?php endif?>
        </nav>
    </body>
</html>
