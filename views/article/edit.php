<?php
include_once('views/layout/layout.php');
if (!isset($_SESSION['username'])) {
    header('Location:/login');
}
?>
    <br/>
    <a href="/article/my-articles">Moji clanci</a>

    <h1>Izmeni clanak</h1>
<?php include_once ('_form.php')?>