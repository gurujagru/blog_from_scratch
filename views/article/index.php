<?php
use blog\core\Session;

include_once('views/layout/before_content.php');
?>
<header>
    <h1 align="center">Welcome<?=isset($_SESSION['username'])?', '.ucfirst($_SESSION['username']).'!':null ?></h1>
</header>
<?php if (Session::getSession('userId')):;?>
    <a href="/article/my-articles"><h3>Moji clanci</h3></a>
<?php endif?>
<h2>Lista clanaka</h2><br/>
    <?php if(isset($data['articles'])):?>
    <?php foreach($data['articles'] as $k=>$v):?>
        <h4><a href='/article/view/<?= $v['id']?>'><?= $v['title']?></a></h4>
    <?php endforeach?>
<?php endif?>
<?php
include_once('views/layout/after_content.php');
?>
