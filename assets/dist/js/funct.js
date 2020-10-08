
function openUrl(url,archivo,titulo,descripcion){
    
    if(!(archivo=='#')){
        $('html,body').animate({scrollTop:0},600)
        $('#loader').show();
        $('#tituloicont').html(titulo);
        $('#descripcont').html(descripcion);
        cargarCapa(url+archivo)
    }
    
}

function cargarCapa(url){
    
    $("#capaload").load(url,{}, function(response, status, xhr) {
        if (status == "error") {
            var msg = "Error!, algo ha sucedido al intentar cargar la informacion";
            $("#capaload").html(msg + xhr.status + " " + xhr.statusText);
        }
        $('#loader').hide();
    });
}



$(document).ready(function () {
    /*para que la carga de la pagina principal*/
    cargarCapa(base_url+"index.php/dashboard");

    $(window).scroll(function(){
        if ($(this).scrollTop() > 100) {
             $('.scrollup').fadeIn();
        } else {
             $('.scrollup').fadeOut();
        }
     });
      
     $('.scrollup').click(function(){
         $("html, body").animate({ scrollTop: 0 }, 600);
         return false;
     });
});