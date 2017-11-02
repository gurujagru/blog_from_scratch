<?php
require('../views/layout/before_content.php');
?>

<h2><?=$data['singleArticle']['title']?></h2>
<p>Autor: <i><?=ucfirst($data['userHasArticle'])?></i></p>

<p id="clanak"><?=$data['singleArticle']['content']?></p>
<?php
if(isset($_SESSION['username']) && ($_SESSION['username']) == $data['userHasArticle']): ?>
    <a href="/article/edit/<?=$data['singleArticle']['id'] ?>"><h4>Izmeni postojeći članak</h4></a>
    <a href="/article/delete/<?=$data['singleArticle']['id'] ?>" onclick="return confirm('Da li zelite da obrisete clanak?')"><h4>Obriši postojeći članak</h4></a>
<?php endif?>
<form action="<?=$_SERVER['REQUEST_URI']?>" method="post">
    <h3>Komentari</h3>
    <textarea id="noviKomentar" name="comment[content]" placeholder="Napišite komentar"></textarea><br/><br/>
    <button type="submit" id="sacuvaj" name="sacuvaj-komentar" class="skriveniDugmici btn btn-default" >Sačuvaj</button>
    <button id="otkaziKomentar" type="button" class="skriveniDugmici btn btn-default">Otkaži</button>
</form>

<?php
$buttonNames = 'Odgovori | Obriši | Prikaži odgovore';
$buttonNames = explode('|',$buttonNames);
$namesButton = ['Odgovori','Obriši','Prikaži odgovore'];
$namesButton = implode(' | ',$namesButton);
function rekurzija($x){
	echo '<ul>';
	foreach ($x as $key => $value) {
        $dateTime = date_format(date_create($value['created_at']),'H:i:s d/m/Y');
		echo "<li><br/<br/><p><b>{$value['username']} </b>$dateTime</p>
			 <p readonly>{$value['Parent']}</p>
             <form class=\"formeKomentara\" action=\"{$_SERVER['REQUEST_URI']}\" method=\"post\">
                 <input id=\"commentId\" name=\"comment[comment_id]\" value=\"{$value['commentId']}\" hidden/>
                 <textarea class=\"skriveno\" name=\"comment[content]\"></textarea><br/><br/>
                 <button class=\"sacuvaj btn btn-default\" type=\"submit\" name=\"sacuvaj-komentar\">Sačuvaj</button>
                 <button class=\"otkazi btn btn-default\" type=\"button\">Otkaži</button>
             </form>";
        $loginUsername = isset($_SESSION['username']) ? $_SESSION['username'] : null;?>
        <a href="#" class="odgovoriNaKomentar"><b><?= ($value['username'] == $loginUsername) || (!empty($value['Children'])) ? "Odgovori | " : "Odgovori" ?></b></a>
        <?php
        if ($value['username'] == $loginUsername):?>
            <a href="#" class="obrisiKomentar"><b><?= empty($value['Children']) ? "Obriši" : "Obriši | " ?></b></a>
        <?php endif ?>
        <?php
		if (!empty($value['Children'])){
            echo "<a href=\"#\" class=\"odgovori\"><b>Prikaži odgovore</b><span class=\"caret\"</span></a>";
			rekurzija($value['Children']);
		}
		echo '</li>';
	}
	echo '</ul>';
}
rekurzija($data['comments']);
?>
<?php
include_once('../views/layout/after_content.php');
?>