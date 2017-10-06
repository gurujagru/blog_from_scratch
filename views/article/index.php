<?php
include_once('views/layout/layout.php');
?>
<h1>Lista clanaka</h1>
<table>
    <?php if(isset($data['articles'])):?>
    <?php foreach($data['articles'] as $k=>$v):?>
        <tr>
            <td><a href='/article/view/<?= $v['id']?>'><?= $v['title']?></a></td>
        </tr>
    <?php endforeach?>
</table>
<?php endif?>
    <?php if(isset($_SESSION['username'])):?>
        <a href="/article/my-articles"><h3>Moji clanci</h3></a>
    <?php endif?>