<?php
include_once('../views/layout/before_content.php');
if (!isset($_SESSION['username'])) {
    header('Location:/login');
}
?>
<br/>
<a href="/article/my-articles">Moji članci</a>

<h1>Novi članak</h1>
<?php include_once ('_form.php')?>

