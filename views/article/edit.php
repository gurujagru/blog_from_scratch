<?php
include_once('../views/layout/before_content.php');

if (!isset($_SESSION['username'])) {
    header('Location:/login');
}
?>
<h2>Izmeni ?lanak</h2>
<?php include_once ('_form.php')?>
