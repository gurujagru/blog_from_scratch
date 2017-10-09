<?php
include_once('views/layout/layout.php');

?>
<h1><?=$data['singleArticle']['title']?></h1>
<p><?=$data['singleArticle']['content']?></p>

<?php
if(isset($_SESSION['username']) && ($_SESSION['username']) == $data['userHasArticle']): ?>
    <a href="/article/edit/<?=$data['singleArticle']['id'] ?>"><h3>Izmeni postojeci clanak</h3></a>
    <a href="/article/delete/<?=$data['singleArticle']['id'] ?>" onclick="return confirm('Da li zelite da obrisete artikal?')"><h3>Obrisi postojeci clanak</h3></a>
<?php endif?>