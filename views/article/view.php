<?php
include_once('views/layout/layout.php');

?>
<h1><?=$data['singleArticle']['title']?></h1>
<form>
    <textarea id="noviKomentar"><?=$data['singleArticle']['content']?></textarea>
<h2>Komentari</h2>
    <textarea placeholder="Napisite komentar"></textarea><br/><br/>
    <button type="submit" name="sacuvaj-komentar">Sacuvaj</button>
    <button type="submit" name="sacuvaj-komentar">Otkazi</button>
</form>

<?php 
function rekurzija($x){
	echo '<ul>';
	foreach ($x as $key => $value) {
		echo '<li><p>' . $value['username'] . ' ' . date_format(date_create($value['created_at']),'H:i:s d/m/Y') . '</p>
			    <textarea readonly>' . $value['Parent'] . '</textarea><br/><br/>
                    <form action="' . $_SERVER['REQUEST_URI'] . '" method="post">
                        <input name="commentId" value="' . $value['commentId'] . '" hidden/>
                        <textarea class="skriveno" name="contentComment"></textarea><br/><br/>
                        <button type="submit">Sacuvaj</button>
                    </form>
                    <button type="button" class="odgovoriNaKomentar">Odgovori</button>&nbsp;';
		if (!empty($value['Children'])){
			echo '<button type="button" class="odgovori">Prikazi odgovore</button>';
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
    #noviKomentar {
        width: 350px;
        height: 150px;
    }
</style>
<?php
if(isset($_SESSION['username']) && ($_SESSION['username']) == $data['userHasArticle']): ?>
    <a href="/article/edit/<?=$data['singleArticle']['id'] ?>"><h3>Izmeni postojeci clanak</h3></a>
    <a href="/article/delete/<?=$data['singleArticle']['id'] ?>" onclick="return confirm('Da li zelite da obrisete artikal?')"><h3>Obrisi postojeci clanak</h3></a>
<?php endif?>
<script>
	$(".odgovori").click(function(){
        $(this).next().toggle();
        if ($(this).text() == "Sakrij odgovore"){
            $(this).text("Prikazi odgovore");
        } else {
            $(this).text("Sakrij odgovore");
        }
	});

    $("ul:not(:first)").hide();

    $(".odgovoriNaKomentar").click(function(){
        if ($(this).text() == "Odgovori") {
            $(this).next().hide();
            var prev = $(this).prev();
            $(this).appendTo(prev);
            prev.show();
            $(this).text("Otkazi");
        } else {
            var parent = $(this).parent();
            parent.hide();
            $(this).insertAfter(parent);
            $(this).next().show();
            $(this).text("Odgovori");
        }
    });

    $("form:not(:first)").hide();

</script>