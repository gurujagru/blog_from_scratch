<?php
include_once('views/layout/layout.php');

?>
<h1><?=$data['singleArticle']['title']?></h1>
<p><?=$data['singleArticle']['content']?></p>
<h2>Komentari</h2>
<?php 
function rekurzija($x){
	echo '<ul>';
	foreach ($x as $key => $value) {
		echo '<li><p>' . $value['username'] . ' ' . date_format(date_create($value['created_at']),"H:i:s d/m/Y") . '</p>
			<form action = "#" method = "post"><textarea readonly>' . $value['Parent'] . '</textarea><br/><br/>
				<input name = "comment_id" value = "' . $value['comment_id'] . '" hidden/>
				<input type = "submit" value = "Odgovori"/>';
		if (!empty($value['Children'])){
			rekurzija($value['Children']);
		}
		echo '</li>';
	}
	echo '</ul>';	
}
rekurzija($data['comments']);
?>
<style type="text/css">
	ul,li {
		list-style-type: none;

	}
</style>
<?php
if(isset($_SESSION['username']) && ($_SESSION['username']) == $data['userHasArticle']): ?>
    <a href="/article/edit/<?=$data['singleArticle']['id'] ?>"><h3>Izmeni postojeci clanak</h3></a>
    <a href="/article/delete/<?=$data['singleArticle']['id'] ?>" onclick="return confirm('Da li zelite da obrisete artikal?')"><h3>Obrisi postojeci clanak</h3></a>
<?php endif?>