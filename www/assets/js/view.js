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

    //button Odgovori

    $(".odgovoriNaKomentar").click(function() {
        event.preventDefault();
        $(this).hide();
        $(this).nextAll('.obrisiKomentar:first').hide();
        $(this).nextAll('.odgovori:first').hide();
        $(this).prevAll('form:first').show();
    });


    //button Otkazi

    $(".otkazi").click(function(){
        var $parent = $(this).parent();
        $parent.hide();
        $parent.nextAll('.odgovoriNaKomentar:first').show();
        $parent.nextAll('.obrisiKomentar:first').show();
        $parent.nextAll('.odgovori:first').show();
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

    $(".obrisiKomentar").click(function(){
        event.preventDefault();
        var result = confirm("Zelite li da obrisete komentar?");
        if (result) {
            var $thisElement = $(this);
            var commentId = $(this).prev().prev().children([0]).val();
            $.ajax({
                url:'/article/deleteComment/' + commentId,
                type:'post',
                data:{id:commentId}
            }).done(function(rsp){
                var buttonSakrijOdgovore = $thisElement.parent('li').parent('ul').prev();
                var roditeljUl = buttonSakrijOdgovore.next();
                $thisElement.parent().remove();
                if (roditeljUl.children('li').length == 0){
                    buttonSakrijOdgovore.remove();
                }
            }).fail(function(err,responseText,XHRobj){

            });
        }
    });
    function popUp(selector, view){
        $(selector).click(function(){
            event.preventDefault();
            $(".pop-up").show();
            $("#ajaxLogin").load(view);
        });
        $(document).on("click","#zatvori",function(){
            $(".pop-up").hide();
        })
    }
    popUp("#login","/login");
    popUp("#sign-up","/signup");

    //validation

    $(document).on("submit",function(){
       if($(".form").val() == "" || !isNaN($(".form").val())){
           event.preventDefault();
           alert("Ne sme biti praznih polja!");
       }
    });
});
