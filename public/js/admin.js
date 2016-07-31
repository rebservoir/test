var id_usuario,id_actual;
var user_name;
var id_usuario_actual;

function get_id_user_pago(id_user){
    id_usuario = id_user;
}

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
    $("#search-input").val('');
    $("#datepicker").val('');
    $("#status").val(null);
    $("#concept").val('');
    $("#path").val(null);
    $("#datepicker_eg").val('');
    $("#amount_egresos").val('');
    $("#concept_cuota").val('');
    $("#monto_cuota").val('');

}

 $.datepicker.regional['es'] = {
 closeText: 'Cerrar',
 prevText: '<Ant',
 nextText: 'Sig>',
 currentText: 'Hoy',
 monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
 monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
 dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
 dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
 dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá'],
 weekHeader: 'Sm',
 dateFormat: 'dd/mm/yy',
 firstDay: 1,
 isRTL: false,
 showMonthAfterYear: false,
 yearSuffix: ''
 };
 $.datepicker.setDefaults($.datepicker.regional['es']);

$(function() {

    $( "#datepicker" ).datepicker({
      showOn: "button",
      buttonImage: "../img/n_5.png",
      buttonImageOnly: true,
      buttonText: "seleccionar Fecha"
    });
    $( "#datepicker" ).datepicker("option", "dateFormat", "yy-mm-dd");
  
	$( "#datepicker_eg" ).datepicker({
      showOn: "button",
      buttonImage: "../img/n_5.png",
      buttonImageOnly: true,
      buttonText: "seleccionar Fecha"
    });
    $( "#datepicker_eg" ).datepicker("option", "dateFormat", "yy-mm-dd");

    $( "#datepicker_pago" ).datepicker({
      showOn: "button",
      buttonImage: "../img/n_5.png",
      buttonImageOnly: true,
      buttonText: "seleccionar Fecha"
    });
    $( "#datepicker_pago" ).datepicker("option", "dateFormat", "yy-mm-dd");

    $( "#datepicker_eg_edit" ).datepicker({
      showOn: "button",
      buttonImage: "../img/n_5.png",
      buttonImageOnly: true,
      buttonText: "seleccionar Fecha"
    });
    $( "#datepicker_eg_edit" ).datepicker("option", "dateFormat", "yy-mm-dd");
  });


$("#registrar_pago").click(function(){

    hide_alert();
    hide_btn();

    var dato1 = id_usuario;
    var dato2 = $("#datepicker").val();
    var dato3 = $("#status").val();
    var dato4 = $('#search-input').val();
   
    var route = "/pagos";
    var token = $("#token").val();

    $.ajax({
        url: route,
        headers: {'X-CSRF-TOKEN': token},
        type: 'POST',
        dataType: 'json',
        data:{id_user: dato1, date: dato2, status: dato3, user_name: dato4},

        success:function(data){
            if(data.tipo=='success'){
                    $("#msj-success").removeClass("hide");
                    $("#msj-success").html("Pago registrado exitosamente.");
                    $("#tablaPagos").load(location.href+" #tablaPagos>*","");
                    $('#pago_create').modal('toggle');
                    hide_btn2();
                    clearModals();
            }else if(data.tipo=='fail'){
                    $("#msj-fail").removeClass( "hide");
                    $("#msj-fail").html(data.message);
                    $('#pago_create').modal('toggle');
                    hide_btn2();
            } 
        },
         error: function (jqXHR, exception) {
            var obj = jQuery.parseJSON(jqXHR.responseText);
            $("#msj-fail").removeClass( "hide");
            var msj = obj.id_user + '<br>' + obj.date + '<br>' + obj.amount + '<br>';
            var res = msj.replace(/undefined<br>/gi, '');
            var res = res.replace(/id user/gi, 'Usuario');
            var res = res.replace(/date/gi, 'Fecha');
            var res = res.replace(/amount/gi, 'Cantidad');
            var res = res.replace(/Y-m-d/gi, 'año-mes-dia');
            $("#msj-fail").html(res);
            $('#pago_create').modal('toggle');
            hide_btn2();
        } 
    });
});

function Mostrar_pago(btn){

    hide_alert();

    id_usuario='';
    var route = "/pagos/"+btn.value+"/edit";

    $.get(route, function(res){
        $("#id_pago").val(res.id);
        $("#hidden_id_user").val(res.id_user);
        $("#datepicker_pago").val(res.date);
        $("#amount_pago").val(res.amount);
        $("#status_pago").val(res.status);
        $("#search-input2").val(res.user_name);
    });

}

$("#actualizar_pago").click(function(){

    hide_alert();
    hide_btn();
 
    var dato1 = $("#hidden_id_user").val();
    var dato2 = $("#datepicker_pago").val();
    var dato3 = $("#amount_pago").val();
    var dato4 = $("#status_pago").val();
    var dato5 = $("#search-input2").val();
    var value = $("#id_pago").val();

    if(id_usuario!=''){
        if(dato1!=id_usuario){
            dato1 = id_usuario;
        }
    }

    var route = "/pagos/"+value+"";
    var token = $("#token_pago").val();

    $.ajax({
        url: route,
        headers: {'X-CSRF-TOKEN': token},
        type: 'PUT',
        dataType: 'json',
        data:{id_user: dato1, date: dato2, amount: dato3, status: dato4, user_name: dato5},
        success:function(){
            $("#msj-success").removeClass("hide");
            $("#msj-success").html("Pago actualizado exitosamente.");
            $("#tablaPagos").load(location.href+" #tablaPagos>*","");
            $('#pago_edit').modal('toggle');
            hide_btn2();
        },
        error: function (jqXHR, exception) {
            var obj = jQuery.parseJSON(jqXHR.responseText);
            $("#msj-fail").removeClass( "hide");
            var msj = obj.id_user + '<br>' + obj.date[0] + '<br>' + obj.date[1] + '<br>' + obj.amount + '<br>';
            var res = msj.replace(/undefined<br>/gi, '');
            var res = res.replace(/id user/gi, 'Usuario');
            var res = res.replace(/date/gi, 'Fecha');
            var res = res.replace(/Y-m-d/gi, 'año-mes-dia');
            var res = res.replace(/amount/gi, 'Cantidad');
            $("#msj-fail").html(res);
            $('#pago_edit').modal('toggle');
            hide_btn2();
        } 

    });
});


$("#delete_att_pago").click(function(){
    $('#btns_delete_pago').slideUp( "fast", function() {
        $("#btns_confirm_pago").show( "fast" );
    });
});

$("#delete_pago").click(function(){

    hide_alert();
    hide_btn();

        var value = $("#id_pago").val();
        var route = "/pagos/"+value;
        var token = $("#token_pago").val();

        $.ajax({
            url: route,
            headers: {'X-CSRF-TOKEN': token},
            type: 'DELETE',
            dataType: 'json',
            success:function(){
            $("#msj-success").removeClass("hide");
            $("#msj-success").html("Pago eliminado exitosamente.");
            $("#tablaPagos").load(location.href+" #tablaPagos>*","");
            $('#pago_edit').modal('toggle');
            hide_btn2();
            },
            error: function (jqXHR, exception) {
                $("#msj-fail").removeClass( "hide");
                $("#msj-fail").html("Intentar de nuevo.");
            } 
        });     

        $('#btns_confirm_pago').hide( "fast");
        $("#btns_delete_pago").show( "fast" );
});

$("#cancel_pago").click(function(){
    $('#btns_confirm_pago').hide( "fast", function() {
        $("#btns_delete_pago").show( "fast" );
    });
});

/* EGRESOS */

 $("#registrar_egresos").on("submit", function(e){

    hide_alert();
    hide_btn();

    e.preventDefault();
    var fd = new FormData(this);

    //var dato1 = $("#concept").val();
    //var dato2 = $("#datepicker_eg").val();
    //var dato3 = $("#amount_egresos").val();

    var route = "/egresos";
    var token = $("#token_eg").val();

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
            $("#msj-success").html("Egreso registrado exitosamente.");
            $("#tablaEgresos").load(location.href+" #tablaEgresos>*","");
            $('#egresos_create').modal('toggle');
            hide_btn2();
            clearModals();
        },
        error: function (jqXHR, exception) {
            var obj = jQuery.parseJSON(jqXHR.responseText);
            $("#msj-fail").removeClass("hide");
            var msj = obj.concept + '<br>' + obj.date[0] + '<br>' + obj.date[1] + '<br>' + obj.amount + '<br>';
            var res = msj.replace(/undefined<br>/gi, '');
            var res = res.replace(/concept/gi, 'Concepto');
            var res = res.replace(/date/gi, 'Fecha');
            var res = res.replace(/amount/gi, 'Cantidad');
            $("#msj-fail").html(res);
            $('#egresos_create').modal('toggle');
            hide_btn2();
        }    
    });
});

function Mostrar_egresos(btn){

    hide_alert();

    var route = "/egresos/"+btn.value+"/edit";
    $.get(route, function(res){
        $("#concept_eg").val(res.concept);
        $("#datepicker_eg_edit").val(res.date);
        $("#amount_eg").val(res.amount);
        $("#id_egresos").val(res.id);
    });
    var value = $("#id_egresos").val();
}

$("#delete_att_egresos").click(function(){
    $('#btns_delete_egresos').slideUp( "fast", function() {
        $("#btns_confirm_egresos").show( "fast" );
    });
});

$("#delete_egresos").click(function(){

    hide_alert();
    hide_btn();

        var value = $("#id_egresos").val();
        var route = "/egresos/"+value;
        var token = $("#token_eg1").val();

        $.ajax({
            url: route,
            headers: {'X-CSRF-TOKEN': token},
            type: 'DELETE',
            dataType: 'json',
            success:function(){
                $("#msj-success").removeClass("hide");
                $("#msj-success").html("Egreso eliminado exitosamente.");
                $("#tablaEgresos").load(location.href+" #tablaEgresos>*","");
                $('#egresos_edit').modal('toggle');
                hide_btn2();
            },
            error: function (jqXHR, exception) {
                $("#msj-fail").removeClass("hide");
                $("#msj-fail").html("Intentar de nuevo.");
                hide_btn2();
            } 

        });

        $('#btns_confirm_egresos').hide( "fast");
        $("#btns_delete_egresos").show( "fast" );
});

$("#cancel_egresos").click(function(){
    $('#btns_confirm_egresos').hide( "fast", function() {
        $("#btns_delete_egresos").show( "fast" );
    });
});



var index=0;
var names = [];

$( document ).ready(function() {

 var route = "/usuario/show";
    $.get(route, function(res){

    for (index = 0; index < res.length; index++) {
        names[index] = res[index].name + '/' +res[index].id;
    }

    });
});

var substringMatcher = function(strs) {

  return function findMatches(q, cb) {
    var matches, substringRegex;

    // an array that will be populated with substring matches
    matches = [];

    // regex used to determine if a string contains the substring `q`
    substrRegex = new RegExp(q, 'i');
    
    // iterate through the pool of strings and for any string that
    // contains the substring `q`, add it to the `matches` array
    $.each(strs, function(i, str) {
          var xxx = str;
        //var xxx = str.split('/');
      if (substrRegex.test(str)) {
        matches.push(xxx);
      }
    });

    cb(matches);

  };
};

$('#the-basics .typeahead').typeahead({
  hint: true,
  highlight: true,
  minLength: 1
},
{
  name: 'states',
  source: substringMatcher(names)
});

/* CUOTA */

function mostrar_cuota(btn){

    hide_alert();

    var route = "/cuotas/"+btn.value+"/edit";

    $.get(route, function(res){
        $("#concept_cuota1").val(res.concepto);
        $("#monto_cuota1").val(res.amount);
        $("#id_cuota1").val(res.id);
    });
}

$("#registrar_cuota").click(function(){

    hide_alert();
    hide_btn();

    var dato1 = $("#concept_cuota").val();
    var dato2 = $("#monto_cuota").val();
    var route = "cuotas";
    var token = $("#token_cuota").val();

    $.ajax({
        url: route,
        headers: {'X-CSRF-TOKEN': token},
        type: 'POST',
        dataType: 'json',
        data:{concepto: dato1, amount: dato2},

        success:function(){
            $("#msj-success").removeClass("hide");
            $("#msj-success").html("Cuota registrada exitosamente.");
            $("#divCuotas").load(location.href+" #divCuotas>*","");
            $('#cuota_create').modal('toggle');
            hide_btn2();
            clearModals();
        },
         error: function (jqXHR, exception) {
            var obj = jQuery.parseJSON(jqXHR.responseText);
            $("#msj-fail").removeClass("hide");
            var msj = obj.concepto + '<br>' + obj.amount;
            var res = msj.replace(/undefined/gi, 'Error');
            var res = res.replace(/concepto/gi, 'Concepto');
            var res = res.replace(/amount/gi, 'Monto');
            $("#msj-fail").html(res);
            $('#cuota_create').modal('toggle');
            hide_btn2();
        } 
    });
});


$("#actualizar_cuota").click(function(){

    hide_alert();
    hide_btn();

    var value = $("#id_cuota1").val();
    var dato1 = $("#concept_cuota1").val();
    var dato2 = $("#monto_cuota1").val();

    var route = "/cuotas/"+value+"";
    var token = $("#token_cuota1").val();

    $.ajax({
        url: route,
        headers: {'X-CSRF-TOKEN': token},
        type: 'PUT',
        dataType: 'json',
        data:{concepto: dato1, amount: dato2},

        success:function(){
            $("#msj-success").removeClass("hide");
            $("#msj-success").html("Cuota actualizada exitosamente.");
            $("#divCuotas").load(location.href+" #divCuotas>*","");
            $('#cuota_edit').modal('toggle');
            hide_btn2();
        },
         error: function (jqXHR, exception) {
            var obj = jQuery.parseJSON(jqXHR.responseText);
            $("#msj-fail").removeClass( "hide");
            var msj = obj.concepto + '<br>' + obj.amount;
            var res = msj.replace(/undefined/gi, 'Error');
            var res = res.replace(/concepto/gi, 'Concepto');
            var res = res.replace(/amount/gi, 'Monto');
            $("#msj-fail").html(res);
            $('#cuota_edit').modal('toggle');
            hide_btn2();
        } 

    });
});

$("#delete_att_cuota").click(function(){
    $('#btns_delete_cuota').slideUp( "fast", function() {
        $("#btns_confirm_cuota").show( "fast" );
    });
});

$("#delete_cuota").click(function(){

    hide_alert();
    hide_btn();

        var value = $("#id_cuota1").val();
        var route = "/cuotas/"+value;
        var token = $("#token_cuota1").val();

        $.ajax({
            url: route,
            headers: {'X-CSRF-TOKEN': token},
            type: 'DELETE',
            dataType: 'json',
            success:function(data){
                if(data.tipo=='success'){
                    $("#msj-success").removeClass("hide");
                    $("#msj-success").html("Cuota eliminada exitosamente.");
                }else if(data.tipo=='warning'){
                    $("#msj-warning").removeClass( "hide");
                    $("#msj-warning").html(data.message);
                }
                $("#divCuotas").load(location.href+" #divCuotas>*","");
                $('#cuota_edit').modal('toggle');
                hide_btn2();
            },
            error: function (jqXHR, exception) {
                $( "#msj-fail").removeClass( "hide");
                $("#msj-fail").html("Intentar de nuevo.");
                hide_btn2();
            }
        });        

        $('#btns_confirm_cuota').hide( "fast");
        $("#btns_delete_cuota").show( "fast" );
});

$("#cancel_cuota").click(function(){
    $('#btns_confirm_cuota').hide( "fast", function() {
        $("#btns_delete_cuota").show( "fast" );
    });
});



var tipo=1;
//se selecciona el tipo de mensaje y se agrega el codigo correspondiente.
$( "#tipo_select" ).change(function() {

    var tipo1 =  '<div><h4>Asunto:</h4><input type="text" id="txt_subj" style="width: 300px;"></div><div><h4>Redactar mensaje:</h4><textarea id="txt_msg" rows="5" cols="50"></textarea></div>';
    var tipo2 =  "<div><h4>Mensaje de Corte</h4></div>";
    var tipo3 =  "<div><h4>Mensaje de Adeudo</h4></div>";

    if( this.value == 1){
         $("#tipos").html(tipo1);
         tipo = 1;
    }else if( this.value == 2){
        $("#tipos").html(tipo2);
        tipo = 2;
    }else{
        $("#tipos").html(tipo3);
        tipo = 3;
    }
});

//se selecciona el destinatario y se llama la funcion getusers. 
$( "#to_select" ).change(function(){

    var sort;
    var code=0;

        if( this.value == 1){
            getUsers(1);
            $( "#add_user").addClass( "hidden");
        }else if( this.value == 2){
            getUsers(2);
            $( "#add_user").addClass( "hidden");
        }else if( this.value == 3){
            getUsers(3);
            $( "#add_user").addClass( "hidden");
        }else if( this.value ==4 ){
            $( "#add_user").removeClass( "hidden");
            $('#user_table').html("<table id='myTable' class='table table-striped'><thead><tr><th>Marcar</th><th>Nombre</th><th>Email</th><th>Status</th></tr></thead><tbody></tbody></table>");
        } 
});

    var usrs = [];

//funcion para llamar a los users y popular la tabla en base al select. 
function getUsers(sort){
    var route = "/admin/usuarios/sort_usr/" + sort + "" ;

    $.get(route, function(res){

        var code="<table class='table table-striped'><thead><tr><th>Marcar</th><th>Nombre</th><th>Email</th><th>Status</th><tr></thead><tbody>";

        for (index = 0; index < res.length; index++){
            code+="<tr><td><input type='checkbox' name='chk' value='" + res[index].id + "' checked></td><td>";
            code+= res[index].name + "</td><td>" + res[index].email + "</td><td>";

            if(res[index].status == 0){ 
                code+="<span class='label label-danger'>Adeudo</span>";
            }else if(res[index].status == 1){
                code+="<span class='label label-success'>Ok</span>";
            }
            code+="</td></tr>";
        }
            code+="</tbody></table>";

        $('#user_table').html(code);

    });

}

//se llama al user por medio de su id y se agrega a la tabla. 
function add(){
    var route = "/admin/usuarios/add/" + id_usuario + "" ;
    var code='';

    $.get(route, function(res){

        code+="<tr><td><input type='checkbox' name='chk' value='" + res[0].id + "' checked></td><td>";
        code+= res[0].name + "</td><td>" + res[0].email + "</td><td>";

            if(res[0].status == 0){ 
                code+="<span class='label label-success'>Ok</span>";
            }else if(res[0].status == 1){
                code+="<span class='label label-danger'>Adeudo</span>";
            }
            code+="</td></tr>";

            $('#myTable > tbody:last-child').append(code);
    });
}

//se llama la funcion para llenar la tabla con todos los users. 
$(document).ready(function() { 
    getUsers(1);
});

//aqui se checan los checkboxes y si estan marcados el id del user se agrega al array.
//el array esta listo para mandarse y enviar mails.  
$("#btn_send").click(function(){

    hide_alert();

    var usrs = [];
    var index=0;
    var $boxes = $('input[name=chk]:checked');
    var i=0;
        $boxes.each(function(){
            usrs[i] = this.value;
            i++;
        });

    if( tipo == 1){
            var msg = $("#txt_msg").val();
            var subj = $("#txt_subj").val();

                    jQuery.each( usrs, function() { 
                        var route = "/sendEmailMsg/" + usrs[index];
                        var token = $("#token_send").val();
                            $.ajax({
                                url: route,
                                headers: {'X-CSRF-TOKEN': token},
                                type: 'GET',
                                dataType: 'json',
                                data:{
                                    msg:msg,
                                    subj:subj
                                },
                                success:function(){
                                    $("#msj-success").removeClass( "hide");
                                    $("#msj-success").html('Su mensaje ha sido enviado.');
                                },
                                error: function (jqXHR, exception) {
                                    $("#msj-fail").removeClass( "hide");
                                    $("#msj-success").html('Error al enviar el mensaje. Intentar de nuevo.');
                                }
                            });
                                index++;
                        });
    }else if( tipo == 2){
            jQuery.each( usrs, function() { 
                    var route = "/sendEmail/" + usrs[index] + "/corte";
                    var token = $("#token_send").val();
                    $.ajax({
                        url: route,
                        headers: {'X-CSRF-TOKEN': token},
                        type: 'GET',
                        dataType: 'json',
                        success:function(){
                            $("#msj-success").removeClass( "hide");
                            $("#msj-success").html('Su mensaje ha sido enviado.');
                        },
                        error: function (jqXHR, exception) {
                            $("#msj-fail").removeClass( "hide");
                            $("#msj-success").html('Error al enviar el mensaje. Intentar de nuevo.');
                        }
                    });
                        index++;
                }); 
    }else{
         jQuery.each( usrs, function(){ 
                    var route = "/sendEmail/" + usrs[index] + "/adeudo";
                    var token = $("#token_send").val();
                    $.ajax({
                        url: route,
                        headers: {'X-CSRF-TOKEN': token},
                        type: 'GET',
                        dataType: 'json',
                        success:function(){
                            $("#msj-success").removeClass( "hide");
                            $("#msj-success").html('Su mensaje ha sido enviado.');
                        },
                        error: function (jqXHR, exception) {
                            $("#msj-fail").removeClass( "hide");
                            $("#msj-success").html('Error al enviar el mensaje. Intentar de nuevo.');
                        }
                });
                    index++;
        }); 
    }
});


/** Sitio **/
function Mostrar_sitio(btn){

    hide_alert();

    var route = "/sitio/"+btn.value+"/edit";

    $.get(route, function(res){
        $("#name_frac").val(res.name);
        $("#path_sitio").val(res.path);
    });
}



/* PAYPAL */

function mostrar_paypal(btn){

    hide_alert();

    var route = "/credenciales/"+btn.value+"/edit";

    $.get(route, function(res){
        $("#client_id").val(res[0].client_id);
        $("#secret").val(res[0].secret);
    });
}

$("#registrar_paypal").click(function(){

    hide_alert();
    hide_btn();

    var dato1 = $("#client_id").val();
    var dato2 = $("#secret").val();
    var route = "/credenciales";
    var token = $("#token_paypal").val();

    $.ajax({
        url: route,
        headers: {'X-CSRF-TOKEN': token},
        type: 'POST',
        dataType: 'json',
        data:{client_id: dato1, secret: dato2},

        success:function(){
            $("#msj-success").removeClass("hide");
            $("#msj-success").html("Datos registrados exitosamente.");
            $('#paypal_edit').modal('toggle');
            hide_btn2();
        },
         error: function (jqXHR, exception) {
            var obj = jQuery.parseJSON(jqXHR.responseText);
            $("#msj-fail").removeClass("hide");
            var msj = obj.concepto + '<br>' + obj.amount;
            var res = msj.replace(/undefined/gi, 'Error');
            var res = res.replace(/client_id/gi, 'Id Cliente');
            var res = res.replace(/secret/gi, 'Clave Secreta');
            $("#msj-fail").html(res);
            $('#paypal_edit').modal('toggle');
            hide_btn2();
        } 
    });


});
