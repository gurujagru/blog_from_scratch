<?php
if(!isset($_SESSION)){
    header('Location:/');
}
?>
<html>
    <head>
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
