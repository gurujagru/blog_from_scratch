<?php
include_once('views/layout/layout.php');
if (!isset($_SESSION['username'])){
    header('Location:/login');
}
?>
<?php
if (isset($data['myArticles'])):
    foreach ($data['myArticles'] as $k=>$v):?>
        <ul>
            <li><a href="/article/view/<?=$v['id']?>"><?= $v['title']?></a></li>
        </ul>
    <?php endforeach ?>
<a href="/article/create"><h3>Postavi novi clanak</h3></a>
<?php endif?>

