<?php
if (isset($_SESSION['username'])){
    header('Location:/');
}
?>
<title>Login</title>
<h1>Login</h1>
<form action="/login" method="post">
    <input type="text" placeholder="Username" name="username" autofocus/>
    <input type="password" placeholder="Password" name="password"/>
    <input type="submit" name="login" value="Login"/>
</form>
