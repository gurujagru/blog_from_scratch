<?php
use blog\core\Session;

include_once('views/layout/before_content.php');

Session::userLogged();
?>
<?php
if (isset($data['myArticles'])):?>

    <?php foreach ($data['myArticles'] as $k=>$v):?>
        <h4><a href="/article/view/<?=$v['id']?>"><h4><?= $v['title']?></a></h4><br/>
    <?php endforeach ?>

<?php endif?>
<a href="/article/create"><h5>Postavi novi clanak</h5></a>
<?php
include_once('views/layout/after_content.php');
?>
