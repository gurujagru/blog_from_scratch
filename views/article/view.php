<?php
include_once('views/layout/before_content.php');
?>

<h2><?=$data['singleArticle']['title']?></h2>
<p>Autor: <i><?=ucfirst($data['userHasArticle'])?></i></p>

<p id="clanak"><?=$data['singleArticle']['content']?></p>
<?php
if(isset($_SESSION['username']) && ($_SESSION['username']) == $data['userHasArticle']): ?>
    <a href="/article/edit/<?=$data['singleArticle']['id'] ?>"><h5>Izmeni postojeci clanak</h5></a>
    <a href="/article/delete/<?=$data['singleArticle']['id'] ?>" onclick="return confirm('Da li zelite da obrisete clanak?')"><h5>Obrisi postojeci clanak</h5></a>
<?php endif?>
<form action="<?=$_SERVER['REQUEST_URI']?>" method="post">
    <h3>Komentari</h3>
    <textarea id="noviKomentar" name="contentComment" placeholder="Napisite komentar"></textarea><br/><br/>
    <button id="sacuvaj" type="submit" class="skriveniDugmici" name="sacuvaj-komentar">Sacuvaj</button>
    <button id="otkaziKomentar" type="button" class="skriveniDugmici">Otkazi</button>
</form>

<?php 
function rekurzija($x){
	echo '<ul>';
	foreach ($x as $key => $value) {
        $dateTime = date_format(date_create($value['created_at']),'H:i:s d/m/Y');
		echo "<li><br/<br/><p><b>{$value['username']} </b>$dateTime</p>
			    <p readonly>{$value['Parent']}</p>
                    <form class=\"formeKomentara\" action=\"{$_SERVER['REQUEST_URI']}\" method=\"post\">
                        <input id=\"commentId\" name=\"commentId\" value=\"{$value['commentId']}\" hidden/>
                        <textarea class=\"skriveno\" name=\"contentComment\"></textarea><br/><br/>
                        <button class=\"sacuvaj btn btn-default\" type=\"submit\" name=\"sacuvaj-komentar\">Sacuvaj</button>
                    </form>
                    <a href=\"#\" type=\"button\" class=\"odgovoriNaKomentar\"><b>Odgovori | </b></a>";
        $loginUsername = isset($_SESSION['username']) ? $_SESSION['username'] : null;
        if ($value['username'] == $loginUsername) {
            echo "<a href=\"#\" class=\"submit\"><b>Obrisi | </b></a>";
        }
		if (!empty($value['Children'])){
			echo '<a href="#" class="odgovori"><b>Prikazi odgovore</b><span class="caret"</span></a>';
			rekurzija($value['Children']);
		}
		echo '</li>';
	}
	echo '</ul>';
}
rekurzija($data['comments']);
?>
<?php
include_once('views/layout/after_content.php');
?>