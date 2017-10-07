<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</head>
<body>
<style>
    .dropdown-submenu {
        position: relative;
    }

    .dropdown-submenu .dropdown-menu {
        top: 0;
        left: 100%;
        margin-top: -1px;
    }
</style>
<form action="<?=!isset($data['articleEdit'])?'/article/create':'/article/edit/'.$data['articleEdit']['id']?>" method="post">
    <input type="text" name="title" placeholder="title" value="<?=isset($data['articleEdit']['title'])?$data['articleEdit']['title']:null?>"/> <br/><br/>
    <textarea placeholder="content" name="content" rows="3" cols="22"><?=isset($data['articleEdit']['content'])?$data['articleEdit']['content']:null?></textarea> <br/>
    <label>Kategorija</label>
    <select name="category">
       <?php rekurzija($data['potkategorije'])?>
    </select><br/><br/>
    <input type="submit" name="<?=!isset($data['articleEdit'])?'create-article':'edit-article'?>" value="Sacuvaj"
           onclick="return confirm('Potvrdite vas zahtev!')"/>
</form>

<?php

function rekurzija($x)
{
    echo "<ul class='dropdown-menu'>";
    foreach ($x as $k=>$v) {
        echo "<li class='dropdown-submenu'>".$v['Parent'].'</li>';
        rekurzija($v['Children']);
    }
    echo '</ul>';
}
rekurzija($data['potkategorije'])
?>

<div class="container">
    <h2>Multi-Level Dropdowns</h2>
    <p>In this example, we have created a .dropdown-submenu class for multi-level dropdowns (see style section above).</p>
    <p>Note that we have added jQuery to open the multi-level dropdown on click (see script section below).</p>
    <div class="dropdown">
        <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">Tutorials
            <span class="caret"></span></button>
        <?php rekurzija($data['potkategorije'])?>
    </div>
</div>


<script>
    $(document).ready(function(){
        $('.dropdown-submenu').on("click", function(e){
            $(this).next('ul').toggle();
            e.stopPropagation();
            e.preventDefault();
        });
    });
</script>

    </body>
</html>