
function hide_alert(){
    $("#msj-success").addClass("hide");
    $("#msj-fail").addClass("hide");
    $("#alert-success").addClass("hide");
}

function hide_btn(){
    $(".btn_go").addClass("hide");
    $(".procesando").removeClass("hide");
}

function hide_btn2(){
    $(".procesando").addClass("hide");
    $(".btn_go").removeClass("hide");
}

function clearModals(){
    $("#titulo").val('');
    $("#contenido").val('');
    $("#path").val(null);

    $("#concept1").val('');
    $("#address1").val('');
    $("#phone_num1").val('');
    $("#url1").val('');

    $("#titulo_doc").val('');
    $("#path_doc").val(null);
}

/** Utiles **/

$("#registrar").click(function(){

    hide_alert();
    hide_btn();

    var dato1 = $("#concept1").val();
    var dato2 = $("#address1").val();
    var dato3 = $("#phone_num1").val();
    var dato4 = $("#category1").val();
    var dato5 = $("#url1").val();
    var route = "/utiles";
    var token = $("#token1").val();

    $.ajax({
        url: route,
        headers: {'X-CSRF-TOKEN': token},
        type: 'POST',
        dataType: 'json',
        data:{concept: dato1, address: dato2, phone_num: dato3, category: dato4, url: dato5},

        success:function(){
            $("#msj-success").removeClass("hide");
            $("#msj-success").html("<p>Datos registrados exitosamente.</p>");
            $("#tablaUtiles").load(location.href+" #tablaUtiles>*","");
            $('#util_create').modal('toggle');
            hide_btn2();
            clearModals();
        },
         error: function (jqXHR, exception) {
            var obj = jQuery.parseJSON(jqXHR.responseText);
            $("#msj-fail").removeClass("hide");
            var msj = obj.concept + '<br>' + obj.address + '<br>'+ obj.phone_num + '<br>'+ obj.category + '<br>'+ obj.url + '<br>';
            var res = msj.replace(/undefined<br>/gi, '');
            var res = res.replace(/concept/gi, 'Concepto');
            var res = res.replace(/address/gi, 'Dirección');
            var res = res.replace(/phone_num/gi, 'Teléfono');
            var res = res.replace(/category/gi, 'Categoria');
            var res = res.replace(/url/gi, 'URL');
            $("#msj-fail").html(res);
            $('#util_create').modal('toggle');
            hide_btn2();
        } 
    });
});

function Mostrar(btn){

    hide_alert();

    var route = "/utiles/"+btn.value+"/edit";
    $.get(route, function(res){
        $("#concept").val(res.concept);
        $("#address").val(res.address);
        $("#phone_num").val(res.phone_num);
        $("#category").val(res.category);
        $("#url").val(res.url);
        $("#id").val(res.id);
    });
}

$("#actualizar_util").click(function(){

    hide_alert();
    hide_btn();

    var value = $("#id").val();
    var dato1 = $("#concept").val();
    var dato2 = $("#address").val();
    var dato3 = $("#phone_num").val();
    var dato4 = $("#category").val();
    var dato5 = $("#url").val();

    var route = "/utiles/"+value+"";
    var token = $("#token").val();

    $.ajax({
        url: route,
        headers: {'X-CSRF-TOKEN': token},
        type: 'PUT',
        dataType: 'json',
        data:{concept: dato1, address: dato2, phone_num: dato3, category: dato4, url: dato5},

        success:function(){
            $("#msj-success").removeClass( "hide");
            $("#msj-success").html("<p>Datos actualizados exitosamente.</p>");
            $("#tablaUtiles").load(location.href+" #tablaUtiles>*","");
            $('#util_edit').modal('toggle');
            hide_btn2();
        },
         error: function (jqXHR, exception) {
            var obj = jQuery.parseJSON(jqXHR.responseText);
            $("#msj-fail").removeClass("hide");
            var msj = obj.concept + '<br>' + obj.address + '<br>'+ obj.phone_num + '<br>'+ obj.category + '<br>'+ obj.url + '<br>';
            var res = msj.replace(/undefined<br>/gi, '');
            var res = res.replace(/concept/gi, 'Concepto');
            var res = res.replace(/address/gi, 'Dirección');
            var res = res.replace(/phone_num/gi, 'Teléfono');
            var res = res.replace(/category/gi, 'Categoria');
            var res = res.replace(/url/gi, 'URL');
            $("#msj-fail").html(res);
            $('#util_create').modal('toggle');
            hide_btn2();
        } 

    });
});

$("#delete_att_util").click(function(){
    $('#btns_delete_util').slideUp( "fast", function() {
        $("#btns_confirm_util").show( "fast" );
    });
});

$("#delete_util").click(function(){

    hide_alert();
    hide_btn();
       
    var value = $("#id").val();
    var route = "/utiles/"+value+"";
    var token = $("#token").val();

    $.ajax({
        url: route,
        headers: {'X-CSRF-TOKEN': token},
        type: 'DELETE',
        dataType: 'json',
        success:function(){
            $("#msj-success").removeClass( "hide");
            $("#msj-success").html("<p>Dato eliminado exitosamente.</p>");
            $("#tablaUtiles").load(location.href+" #tablaUtiles>*","");
            $('#util_edit').modal('toggle');
            hide_btn2();
        },
        error: function (jqXHR, exception) {
            $("#msj-fail").removeClass("hide");
            $("#msj-fail").html("<p>Intentar de nuevo.</p>");
            $('#util_edit').modal('toggle');
            hide_btn2();
        } 
    });

        $('#btns_confirm_util').hide("fast");
        $("#btns_delete_util").show("fast");
});

$("#cancel_util").click(function(){
    $('#btns_confirm_util').hide("fast", function() {
        $("#btns_delete_util").show("fast");
    });
});


var file_noti;

function Mostrar_noticia(btn){

    hide_alert();

    var route = "/noticia/"+btn.value+"/edit";

    $.get(route, function(res){
        $("#titulo1").val(res.titulo);
        $("#contenido1").val(res.texto);
        file_noti = res.path;
        $("#id_noti_1").val(res.id);
    });
}


$("#registrar_noticia").on("submit", function(e){

    hide_alert();
    hide_btn();
    
    e.preventDefault();

    var fd = new FormData(this);
    var route = "/noticia";
    var token = $("#token").val();

    $.ajax({
        url: route,
        headers: {'X-CSRF-TOKEN': token},
        type: 'POST',
        dataType: 'json',
        data: fd,
        contentType: false,
        processData: false,

        success:function(){
            $("#msj-success").removeClass("hide");
            $("#msj-success").html("<p>Noticia Creada exitosamente.</p>");
            $("#tablaNoticias").load(location.href+" #tablaNoticias>*","");
            $('#noticia_create').modal('toggle');
            hide_btn2();
            clearModals();
        },
        error: function (jqXHR, exception) {
            var obj = jQuery.parseJSON(jqXHR.responseText);
            var msj = obj.titulo + '<br>' + obj.texto + '<br>' + obj.path + '<br>';
            var res = msj.replace(/undefined<br>/gi, '');
            var res = res.replace(/titulo/gi, 'Titulo');
            var res = res.replace(/texto/gi, 'Contenido');
            var res = res.replace(/path/gi, 'Imagen');
            $("#msj-fail").removeClass("hide");
            $("#msj-fail").html(res);
            $('#noticia_create').modal('toggle');
            hide_btn2();
        }
    });

});


$("#delete_att_noticia").click(function(){
    $('#btns_delete_noticia').slideUp( "fast", function() {
        $("#btns_confirm_noticia").show( "fast" );
    });
});

$("#delete_noticia").click(function(){
      
        hide_alert();
        hide_btn();

        var value = $("#id_noti_1").val();
        var route = "/noticia/"+value;
        var token = $("#token_noti_1").val();

        $.ajax({
            url: route,
            headers: {'X-CSRF-TOKEN': token},
            type: 'DELETE',
            dataType: 'json',
            success:function(){
                $("#msj-success").removeClass("hide");
                $("#msj-success").html("Noticia eliminada exitosamente.");
                $("#tablaNoticias").load(location.href+" #tablaNoticias>*","");
                $('#noticia_edit').modal('toggle');
                hide_btn2();
            },
            error: function (jqXHR, exception){
                $("#msj-fail").removeClass("hide");
                $("#msj-fail").html("<p>Intentar de nuevo.</p>");
                $('#noticia_edit').modal('toggle');
                hide_btn2();
            }
        });

        $('#btns_confirm_noticia').hide("fast");
        $("#btns_delete_noticia").show("fast");
});

$("#cancel_noticia").click(function(){
    $('#btns_confirm_noticia').hide("fast", function() {
        $("#btns_delete_noticia").show("fast");
    });
});



/** Documentos **/

function mostrar_doc(btn){

    hide_alert();

    var route = "/documentos/"+btn.value+"/edit";

    $.get(route, function(res){
        $("#titulo_edit").val(res.titulo);
        $("#id_doc").val(res.id);
    });
}

 $("#registrar_doc").on("submit", function(e){

    hide_alert();
    hide_btn();

    e.preventDefault();
    var fd = new FormData(this);

    var route = "/documentos";
    var token = $("#token_doc").val();

    $.ajax({
        url: route,
        headers: {'X-CSRF-TOKEN': token},
        type: 'POST',
        dataType: 'json',
        data: fd,
        contentType: false,
        processData: false,

        success:function(){
            $("#msj-success").removeClass("hide");
            $("#msj-success").html("Nuevo Documento Creado exitosamente.");
            $("#divDocs").load(location.href+" #divDocs>*","");
            $('#documento_create').modal('toggle');
            hide_btn2();
            clearModals();
        },
        error: function (jqXHR, exception) {
            var obj = jQuery.parseJSON(jqXHR.responseText);
            var msj = obj.titulo + '<br>' + obj.path;
            var res = msj.replace(/undefined<br>/gi, '');
            var res = res.replace(/titulo/gi, 'Titulo');
            var res = res.replace(/path/gi, 'Archivo');
            $("#msj-fail").removeClass("hide");
            $("#msj-fail").html(res);
            $('#documento_create').modal('toggle');
            hide_btn2();
        }    
    });
});

$("#delete_att_documento").click(function(){
    $('#btns_delete_documento').slideUp( "fast", function() {
        $("#btns_confirm_documento").show( "fast" );
    });
});

$("#delete_documento").click(function(){

    hide_alert();
    hide_btn();

    var value = $("#id_doc").val();
    var route = "/documentos/"+value;
    var token = $("#token_doc1").val();

        $.ajax({
            url: route,
            headers: {'X-CSRF-TOKEN': token},
            type: 'DELETE',
            dataType: 'json',
            success:function(){
                $("#msj-success").removeClass("hide");
                $("#msj-success").html("Documento eliminado exitosamente.");
                $("#divDocs").load(location.href+" #divDocs>*","");
                $('#documento_edit').modal('toggle');
                hide_btn2();
            },
            error: function (jqXHR, exception) {
                $("#msj-fail").removeClass("hide");
                $("#msj-fail").html("Intentar de nuevo.");
                $('#documento_edit').modal('toggle');
                hide_btn2();
            } 
        });

        $('#btns_confirm_documento').hide( "fast");
        $("#btns_delete_documento").show( "fast" );
});

$("#cancel_documento").click(function(){
    $('#btns_confirm_documento').hide( "fast", function() {
        $("#btns_delete_documento").show( "fast" );
    });
});


/** morosos **/

$("#act_morosos").click(function(){
    $('#btns_morosos').slideUp( "fast", function() {
        $("#btns_confirm_morosos").show( "fast" );
    });
});

$("#cancel_morosos").click(function(){
    $('#btns_confirm_morosos').hide("fast", function() {
        $("#btns_morosos").show("fast");
    });
});

/** finanzas **/

$("#act_finanzas").click(function(){
    $('#btns_finanzas').slideUp( "fast", function() {
        $("#btns_confirm_finanzas").show( "fast" );
    });
});

$("#cancel_finanzas").click(function(){
    $('#btns_confirm_finanzas').hide("fast", function() {
        $("#btns_finanzas").show("fast");
    });
});


