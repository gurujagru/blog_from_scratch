<?php
use blog\core\Session;

include_once('../views/layout/before_content.php');

Session::userLogged();
?>
<?php
if(isset($data['myArticles'])):?>
    <?php foreach($data['myArticles'] as $k=>$v):?>
        <h4><?= $v['title']?></h4>
        <p><?php $belina = substr($v['content'],500,1);
            if($belina == " "){
                echo substr($v['content'],0,500).'...';
            } else {
                $odBeline = substr($v['content'],500);
                $ostatak = strchr($odBeline," ",true);
                echo substr($v['content'],0,500) . $ostatak . '...';
            }
            ?>
        </p>
        <a href='/article/view/<?= $v['id']?>'>Pročitaj više...</a>
    <?php endforeach?>
<?php endif?>
<a href="/article/create"><h4>Postavi novi članak</h4></a>
<?php
include_once('../views/layout/after_content.php');
?>
