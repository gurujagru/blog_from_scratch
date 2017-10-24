$(document).ready(function(){

    //button Sakrij/Prikazi odgovore

    $(".odgovori").click(function () {
        event.preventDefault();
        $(this).next('ul').toggle();
        if ($(this).text() == "Sakrij odgovore") {
            $(this).html("<b>Prikazi odgovore</b><span class=\"caret\"></span>");
        } else {
            $(this).html("<b>Sakrij odgovore</b><span class=\"dropup\"><span class=\"caret\"></span></span>");
        }
    });

    //skrivanje svih odgovora osim u prvom krugu

    $(".container").find("ul:not(:first)").hide();

    //button Odgovori/Otkazi

    $(".odgovoriNaKomentar").click(function () {
        event.preventDefault();
        if ($(this).text() == "Odgovori | ") {
            $(this).next().hide();
            var prev = $(this).prev();
            $(this).appendTo(prev);
            prev.show();
            $(this).html("<button class='btn btn-default'>Otkazi</button>");
        } else {
            var parent = $(this).parent();
            parent.hide();
            $(this).insertAfter(parent);
            $(this).next().show();
            $(this).html("<b>Odgovori | </b>");
        }
    });



    $("#noviKomentar").click(function () {
        event.preventDefault();
        $(".skriveniDugmici").show();
    });

    $("#otkaziKomentar").click(function () {
        event.preventDefault();
        $(".skriveniDugmici").hide();
        $("#noviKomentar").val("");
    });

    function sacuvajButton(sel1,sel2){
        $(sel1).keyup(function(){
            var thisSelector = $(this).parent().children(sel2);
            thisSelector.css("opacity","1.0");
            thisSelector.css("pointer-events","auto");
            if ($(this).val() == ""){
                thisSelector.css("opacity","0.65");
                thisSelector.css("pointer-events","none");
            }
        });
    }

    sacuvajButton('#noviKomentar','#sacuvaj');

    sacuvajButton('.skriveno','.sacuvaj');

    $(".formeKomentara").hide();

    //ajax brisanje komentara

    $(".submit").click(function(){
        event.preventDefault();
        var result = confirm("Zelite li da obrisete komentar?");
        if (result) {
            var thisElement = this;
            var commentId = $(this).prev().prev().children([0]).val();
            $.ajax({
                url:'/article/deleteComment/' + commentId,
                type:'post',
                data:{id:commentId},
                success:function(){
                    //location.reload(); // reloading page
                    var buttonSakrijOdgovore = $(thisElement).parent('li').parent('ul').prev();
                    var roditeljUl = buttonSakrijOdgovore.next();
                    $(thisElement).parent().remove();
                    if (roditeljUl.children('li').length == 0){
                        buttonSakrijOdgovore.remove();
                    }
                }
            });
        }
    });
});
