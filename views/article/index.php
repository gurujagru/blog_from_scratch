<?php
include_once('../views/layout/before_content.php');
?>
<h1 align="center">Dobrodošli<?=isset($_SESSION['username'])?', '.ucfirst($_SESSION['username']).'!':null ?></h1>
<?php if(isset($data['articles'])):?>
    <?php foreach($data['articles'] as $k=>$v):?>
        <h4><?= $v['title']?></h4>
        <div class="row">
        <img id="slika" class="col-md-6" src=<?php echo $v['img']?>>
        <p class="col-md-6">
            <?php $belina = substr($v['content'],500,1);
            if ($belina == " "){
                echo substr($v['content'],0,500).'...';
            } else {
                $odBeline = substr($v['content'],500);
                $ostatak = strchr($odBeline," ",true);
                echo substr($v['content'],0,500) . $ostatak . '...';
            }
            ?>
            <br/><br/>
            <a href='/article/view/<?= $v['id']?>'>PROČITAJ VIŠE...</a>
        </p>
        </div>

        <hr>
    <?php endforeach?>
<?php endif?>
<?php
include_once('../views/layout/after_content.php');
?>
