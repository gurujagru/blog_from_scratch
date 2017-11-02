<form action="<?=!isset($data['articleEdit'])?'/article/create':'/article/edit/'.$data['articleEdit']['id']?>" method="post">
    <input type="text" name="article[title]" value="<?=isset($data['articleEdit']['title'])?$data['articleEdit']['title']:null?>" placeholder="title"/> <br/><br/>
    <textarea name="article[content]" placeholder="content" rows="3" cols="22"><?=isset($data['articleEdit']['content'])?$data['articleEdit']['content']:null?></textarea> <br/>
    <label>Kategorija</label>
    <?php 
    function rekurzija($x,$y = [])
    {
        foreach ($x as $k=>$v){
            echo '<option>'.implode("/",$y).(!empty($y)?'/':'').$v['Parent']."</option>";
            if($v['Children'] != null) {
                $next = $y;
                $next[] = $v["Parent"];
                rekurzija($v['Children'],$next);
            }
        }
    }
    echo "<select name='category'>";
    rekurzija($data['potkategorije']);
    echo "</select>";
    ?>
    <input type="submit" name="<?=!isset($data['articleEdit'])?'create-article':'edit-article'?>" value="Sacuvaj"
           onclick="return confirm('Potvrdite vas zahtev!')"/>
</form>
<?php
include_once('../views/layout/after_content.php');
?>
