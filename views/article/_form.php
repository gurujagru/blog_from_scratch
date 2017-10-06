<form action="<?=!isset($data['articleEdit'])?'/article/create':'/article/edit/'.$data['articleEdit']['id']?>" method="post">
    <input type="text" name="title" placeholder="title" value="<?=isset($data['articleEdit']['title'])?$data['articleEdit']['title']:null?>"/> <br/><br/>
    <textarea placeholder="content" name="content" rows="3" cols="22"><?=isset($data['articleEdit']['content'])?$data['articleEdit']['content']:null?></textarea> <br/>
    <label>Kategorija</label>
    <select name="category">
        <?php foreach($data['categories'] as $k=>$v):?>
            <option><?= $v['title']?></option>
        <?php endforeach?>
    </select><br/><br/>
    <input type="submit" name="<?=!isset($data['articleEdit'])?'create-article':'edit-article'?>" value="Sacuvaj"
           onclick="return confirm('Potvrdite vas zahtev!')"/>
</form>
<?php
var_dump($data['potkategorije'])
?>