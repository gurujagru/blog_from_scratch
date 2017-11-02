<?php
if (isset($_SESSION['username'])){
    header('Location:/');
}
?>
<h1>Registracija</h1>
<form action="/signup" method="post">
    <input type="text" class="form" placeholder="username" name="username"><br/><br/>
    <input type="password" class="form" name="password" placeholder="password" ><br/><br/>
    <input type="submit" class="btn btn-primary" name="signup" value="Registruj se">
    <button type="button" id="zatvori" class="btn btn-default">Zatvori</button>
</form>