<?php
if (isset($_SESSION['username'])){
    header('Location:/');
}
?>
<title>Signup</title>
<h1>Sign up</h1>
<form action="/signup" method="post">
    <input type="text" placeholder="username" name="username">
    <input type="password" placeholder="password" name="password">
    <input type="submit" name="signup" value="signup">
</form>