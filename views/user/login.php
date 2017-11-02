<?php
use blog\core\Session;

Session::getFlashMessage();
?>
<h1>Prijava</h1>
<form action="/login" method="post">
    <input type="text" class="form" name="username" placeholder="Korisničko ime" autofocus/><br/><br/>
    <input type="password" class="form" name="password" placeholder="Šifra"/><br/><br/>
    <input type="submit" class="btn btn-primary" name="login" value="Prijavi se"/>
    <button type="button" id="zatvori" class="btn btn-default">Zatvori</button>
</form>
