function clearModals(){
    $("#name").val('');
    $("#email").val('');
    $("#address").val('');
    $("#phone").val('');
    $("#cel").val('');
    $("#id").val('');
    $("#type").val(null);
    $("#field1").val('');
    $("#field2").val('');

    $("#name1").val('');
    $("#email1").val('');
    $("#address1").val('');
    $("#phone1").val('');
    $("#cel1").val('');
    $("#id1").val('');
    $("#type1").val(null);
    $("#field1_1").val('');
    $("#field2_2").val('');
    clearAlerts();
}

function clearAlerts(){
    $("#email_msg").html('');
    $("#react_btn").addClass('hidden');
    $(".type_msg").html('');
    $(".role_msg").html('');
    $("#asignar_btn").addClass('hidden');    
    $("#changePass").addClass("hide");
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

var id_usuario;
function get_id_user_pago(id_user){
    id_usuario = id_user;
    search();
}

function Mostrar(btn){

    hide_alert();
    clearAlerts();

    var route = "/usuario/"+btn.value+"/edit";

    $.get(route, function(res){
        $("#name1").val(res[0].name);
        $("#email1").val(res[0].email);
        $("#address1").val(res[0].address);
        $("#phone1").val(res[0].phone);
        $("#cel1").val(res[0].celphone);
        $("#role1").val(res[0].role);
        $("#id1").val(res[0].id_user);
        $("#type1").val(res[0].type);
        $("#field1_1").val(res[0].field1);
        $("#field2_1").val(res[0].field2);

        if(res[0].role == 1){
            $("#changePass").removeClass("hide");
        }

    });

}

function loadData(){
    var route = "/load";
    $.get(route, function(res){
    });
}

 $("#load_data").on("submit", function(e){
    hide_alert();
    e.preventDefault();
    var fd = new FormData(this);

    var route = "/load";
    var token = $("#token_load").val();

    $.ajax({
        url: route,
        headers: {'X-CSRF-TOKEN': token},
        type: 'POST',
        dataType: 'json',
        data: fd,
        contentType: false,
        processData: false,

        success:function(){

        },
        error: function (jqXHR, exception) {
        }    
    });
});


function detalle_pagos(btn){

    $('#tab-content').html("");
    hide_alert();
    $pagos = [];
    var JSONObject='';
    var s_year='';
    var year='';
    var years = [];
    var n=0;
    var str='',str2='',str3='';
    meses = ["x","Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"];
    var route = "/detalle_pagos/"+btn.value;

    $.get(route, function(res){

        str+="<table class='table table-condensed'><tbody><tr><td><strong>Cliente:</strong></td><td>"+ res[0].user_name +"</td></tr></tbody></table><br><br>";
        
        year = (res[0].date).split('-');
        save = year[0];
        years[n] = save;
        n++;
        for(index = 0; index < res.length; index++){
            year = (res[index].date).split('-');
            if(save !== year[0]){
                save = year[0];
                years[n] = save;
                n++
            }
        }
        
        str += "<ul class='nav nav-tabs'>"; // ul years
        str2 += "<div class='tab-content'>"; // tab years
        for(j=0;j<years.length;j++){
            str+= "<li><a href='#" + years[j] + "' data-toggle='pill'>" + years[j] + "</a></li>"; // li years
            str2+= "<div id='" + years[j] + "' class='tab-pane fade'>"; // divs years
            str2+="<ul class='nav nav-pills'>"; // ul months

            for(index = 0; index < res.length; index++){
                year = (res[index].date).split('-');
                if(years[j] == year[0]){
                    // li months
                    if(res[index].status == 0){
                        str2+="<li><a class='adeudo' href='#" + meses[parseInt(year[1])] + year[0] + "' data-toggle='pill'>" + meses[parseInt(year[1])] + "</a></li>";
                    }else if(res[index].status == 1){
                        str2+="<li><a class='saldado' href='#" + meses[parseInt(year[1])] + year[0] + "' data-toggle='pill'>" + meses[parseInt(year[1])] + "</a></li>";
                    }
                    str3+= "<div id='" + meses[parseInt(year[1])] + year[0] + "' class='tab-pane fade'>"; // divs months
                    str3+="<br><table class='table table-condensed'><thead><tr><th>Fecha</th><th>Importe</th><th>Status</th></tr></thead><tbody><tr><td><p>";
                    str3+= year[2]+"-"+meses[parseInt(year[1])]+"-"+year[0]+"</p></td><td><p>$"+res[index].amount+".00</p></td><td>";
                    if(res[index].status == 0){
                        str3+="<span class='label label-danger'>Adeudo</span>"; 
                    }else if(res[index].status == 1){
                        str3+="<span class='label label-success'>Saldado</span>";
                    }
                    str3+="</td></tr></tbody></table></div>";
                }
            }

            str2+="</ul><div class='tab-content'>"; // end ul months
            str3+="</div>";
            str2+=str3;
            str3='';
            str2+="</div>"; // end tab-pane
        }
        str += "</ul>"; // end ul years
        str2+="</div>"; // end tab-content

        $('#tab-content').html(str + str2);
    });
                                                    
}

$( "#email" ).change(function() {
    if(!($(this).val() == '')){
        $("#email_msg").html('');
        $("#react_btn").addClass('hidden');

        var dato = $(this).val();
        var route = "checkEmail/"+dato;

        $.get(route, function(response){
            if(response.res == '1'){ 
                $("#email_msg").html('<div class="alert alert-success" style="padding: 5px;"><p>Email sin registrar.</p></div>');
            }else if(response.res == '2'){ 
                $("#email_msg").html('<div class="alert alert-danger" style="padding: 5px;"><p>Este email ya esta registrado para un usuario de este sitio.</p></div>');
            }else if(response.res == '3'){
                $("#email_msg").html('<div class="alert alert-warning" style="padding: 5px;"><p>Existe un usuario registrado con este email para otro sitio en Bill Box, desea asignar este sitio al usuario? Si/No</p></div>');
                $("#asignar_btn").removeClass('hidden');
                $("#asignar_btn").val(response.id_user);
            }else if(response.res == '4'){
                $("#email_msg").html('<div class="alert alert-warning" style="padding: 5px;"><p>Un usuario con este email existia anteriormente para otro sitio en Bill Box. Desea reactivarlo y asignarlo a este sitio? </p></div>');
                $("#react_btn").removeClass('hidden');
                $("#react_btn").val(response.id_user);
            }else if(response.res == '5'){
                $("#email_msg").html('<div class="alert alert-warning" style="padding: 5px;"><p>Un usuario con este email existia anteriormente para este sitio. desea reactivarlo? </p></div>');
                $("#react_btn").removeClass('hidden');
                $("#react_btn").val(response.id_user);
            }
        });
    }
});


$("#react_btn").click(function(){
    dato = $(this).val();
    var route = "/edit_react/" + dato;

    $.get(route, function(res){
        $("#name").val(res.name);
        $("#email").val(res.email);
        $("#address").val(res.address);
        $("#phone").val(res.phone);
        $("#cel").val(res.celphone);
        $("#id").val(res.id);
        $("#type").val(res.type);
        $("#field1").val(res.field1);
        $("#field2").val(res.field2);
    });

    $(".btn_go").addClass("hide");
    $("#react_btn").addClass("hide");
    $("#email_msg").html('');
    $(".btn_reactivar_2").removeClass("hide");
});

$("#reactivar_2").click(function(){

    hide_alert();
    var dato1 = $("#type").val();

    if(dato1==null || dato1 == ''){
        $(".type_msg").html('<div class="alert alert-danger" style="padding: 5px;"><p>Se debe asignar una cuota al usuario.</p></div>');
    }else{ 

    $(".btn_reactivar_2").addClass("hide");
    $(".procesando").removeClass("hide");

    var value = $("#id").val();
    var dato1 = $("#name").val();
    var dato2 = $("#email").val();
    var dato3 = $("#address").val();
    var dato4 = $("#phone").val();
    var dato5 = $("#cel").val();
    var dato6 = $("#role").val();
    var dato7 = $("#type").val();
    var dato8 = $("#field1").val();
    var dato9 = $("#field2").val();

    var route = "reactivar/"+ value;
    var token = $("#token").val();

    $.ajax({
        url: route,
        headers: {'X-CSRF-TOKEN': token},
        type: 'POST',
        dataType: 'json',
        data:{
            name:       dato1, 
            email:      dato2, 
            address:    dato3, 
            phone:      dato4,
            celphone:   dato5,
            role:       dato6,
            type:       dato7,
            field1:     dato8,
            field2:     dato9 
        },
        success:function(data){
            if(data.res=='ok'){
                    $("#msj-success").removeClass("hide");
                    $("#msj-success").html('<p>El usuario se encuentra activo nuevamente.</p>');
                    $("#react_btn").addClass('hidden');
                    $("#tablaUsuarios").load(location.href+" #tablaUsuarios>*","");
                    $("#divSitio").load(location.href+" #divSitio>*","");
                    $('#user_create').modal('toggle');
                    hide_btn2();
            }else if(data.res=='fail'){
                    $("#msj-fail").removeClass("hide"); 
                    $("#msj-fail").html('<p>Limite alcanzado. No se pueden crear más usuarios.</p>');
                    $("#react_btn").addClass('hidden');
                    $('#user_create').modal('toggle');
                    hide_btn2();
            } 
        },
        error: function (jqXHR, exception) {
            var obj = jQuery.parseJSON(jqXHR.responseText);
            $("#msj-fail").removeClass( "hide");
            var msj = obj.name + '<br>' + obj.email + '<br>' + '<br>' + obj.address + '<br>';
            var res = msj.replace(/undefined<br>/gi, '');
            var res = res.replace(/name/gi, 'Nombre');
            var res = res.replace(/address/gi, 'Dirección');
            var res = res.replace(/email/gi, 'Email');
            $("#msj-fail").html(res);
            $('#user_create').modal('toggle');
        }              
    });
}
});

$("#asignar_btn").click(function(){

    dato = $(this).val();
    var route = "/edit_react/" + dato;

    $.get(route, function(res){
        $("#name").val(res.name);
        $("#email").val(res.email);
        $("#address").val(res.address);
        $("#phone").val(res.phone);
        $("#cel").val(res.celphone);
        $("#id").val(res.id);
        $("#type").val(res.type);
        $("#field1").val(res.field1);
        $("#field2").val(res.field2);
    });

    $(".btn_go").addClass("hide");
    $(".btn_asignar_2").removeClass("hide");
    $("#email_msg").html('');
    $("#asignar_btn").addClass("hide");

});

$("#asignar_2").click(function(){


    hide_alert();
    var dato7 = $("#type").val();

    if(dato7==null || dato7 == ''){
        $(".type_msg").html('<div class="alert alert-danger" style="padding: 5px;"><p>Se debe asignar una cuota al usuario.</p></div>');
    }else{
        $(".type_msg").html('');
        $("#asignar_2").addClass("hide");
        $(".procesando").removeClass("hide");

        var dato = $("#id").val();
        var dato1 = $("#name").val();
        var dato2 = $("#email").val();
        var dato3 = $("#address").val();
        var dato4 = $("#phone").val();
        var dato5 = $("#cel").val();
        var dato6 = $("#role").val();
        var dato7 = $("#type").val();
        var dato8 = $("#field1").val();
        var dato9 = $("#field2").val();

        var route = "asignar/"+dato;
        var token = $("#token").val();


    $.ajax({
        url: route,
        headers: {'X-CSRF-TOKEN': token},
        type: 'POST',
        dataType: 'json',
        data:{
            name:       dato1, 
            email:      dato2, 
            address:    dato3, 
            phone:      dato4,
            celphone:   dato5,
            role:       dato6,
            type:       dato7,
            field1:     dato8,
            field2:     dato9
        },
        success:function(response){
            if(response.res == 'ok'){ //load json data from server and output message 
                $("#msj-success").removeClass("hide");
                $("#msj-success").html('<p>El usuario se encuentra activo para este sitio.</p>');
                $("#react_btn").addClass('hidden');
                $("#tablaUsuarios").load(location.href+" #tablaUsuarios>*","");
                $("#divSitio").load(location.href+" #divSitio>*","");
                $('#user_create').modal('toggle');
                hide_btn2();
            }else if(response.res == 'fail'){ //load json data from server and output message
                $("#msj-fail").removeClass("hide"); 
                $("#msj-fail").html('<p>Limite alcanzado. No se pueden crear más usuarios.</p>');
                $("#react_btn").addClass('hidden');
                $('#user_create').modal('toggle');
                hide_btn2();
            }
        },
        error: function (jqXHR, exception) {
            var obj = jQuery.parseJSON(jqXHR.responseText);
            $("#msj-fail").removeClass( "hide");
            var msj = obj.name + '<br>' + obj.email + '<br>' + obj.password + '<br>' + obj.address + '<br>';
            var res = msj.replace(/undefined<br>/gi, '');
            var res = res.replace(/name/gi, 'Nombre');
            var res = res.replace(/address/gi, 'Dirección');
            var res = res.replace(/email/gi, 'Email');
            var res = res.replace(/password/gi, 'Password');
            $("#msj-fail").html(res);
            $('#user_create').modal('toggle');
            hide_btn2();
        }              
    });
    }

});

$("#registrar").click(function(){

    hide_alert();
    var dato7 = $("#type").val();

    if(dato7==null || dato7 == ''){
        $(".type_msg").html('<div class="alert alert-danger" style="padding: 5px;"><p>Se debe asignar una cuota al usuario.</p></div>');
    }else{

    hide_btn();

    var value = $("#id").val();
    var dato1 = $("#name").val();
    var dato2 = $("#email").val();
    var dato3 = $("#address").val();
    var dato4 = $("#phone").val();
    var dato5 = $("#cel").val();
    var dato6 = $("#role").val();
    var dato7 = $("#type").val();
    var dato8 = $("#field1").val();
    var dato9 = $("#field2").val();

    var route = "/usuario";
    var token = $("#token").val();

    $.ajax({
        url: route,
        headers: {'X-CSRF-TOKEN': token},
        type: 'POST',
        dataType: 'json',
        data:{
            name:       dato1, 
            email:      dato2, 
            address:    dato3, 
            phone:      dato4,
            celphone:   dato5,
            role:       dato6,
            type:       dato7,
            field1:     dato8,
            field2:     dato9

        },
        success:function(data){
            if(data.tipo=='success'){
                    $("#msj-success").removeClass("hide");
                    $("#msj-success").html(data.message);
                    $("#tablaUsuarios").load(location.href+" #tablaUsuarios>*","");
                    $("#divSitio").load(location.href+" #divSitio>*","");
                    $('#user_create').modal('toggle');
                    hide_btn2();
            }else if(data.tipo=='limite'){
                    $("#msj-fail").removeClass( "hide");
                    $("#msj-fail").html(data.message);
                    $('#user_create').modal('toggle');
                    hide_btn2();
            } 
        },
        error: function (jqXHR, exception) {
            var obj = jQuery.parseJSON(jqXHR.responseText);
            $("#msj-fail").removeClass( "hide");
            var msj = obj.name + '<br>' + obj.email + '<br>' + obj.password + '<br>' + obj.address + '<br>';
            var res = msj.replace(/undefined<br>/gi, '');
            var res = res.replace(/name/gi, 'Nombre');
            var res = res.replace(/address/gi, 'Dirección');
            var res = res.replace(/email/gi, 'Email');
            var res = res.replace(/password/gi, 'Password');
            $("#msj-fail").html(res);
            $('#user_create').modal('toggle');
            hide_btn2();
        }              
    });
}
});

$("#actualizar").click(function(){

    hide_alert();
    var dato7 = $("#type1").val();

    if(dato7==null || dato7 == ''){
        $(".type_msg").html('<div class="alert alert-danger" style="padding: 5px;"><p>Se debe asignar una cuota al usuario.</p></div>');
    }else{
     
    $(".type_msg").html('');
    hide_btn();

    var value = $("#id1").val();
    var dato1 = $("#name1").val();
    var dato2 = $("#email1").val();
    var dato3 = $("#address1").val();
    var dato4 = $("#phone1").val();
    var dato5 = $("#cel1").val();
    var dato6 = $("#role1").val();
    var dato7 = $("#type1").val();
    var dato8 = $("#field1_1").val();
    var dato9 = $("#field2_1").val();

    var route = "/usuario/"+value+"";
    var token = $("#token").val();

    $.ajax({
        url: route,
        headers: {'X-CSRF-TOKEN': token},
        type: 'PUT',
        dataType: 'json',
        data:{
            name:       dato1, 
            email:      dato2, 
            address:    dato3, 
            phone:      dato4,
            celphone:   dato5,
            role:       dato6,
            type:       dato7,
            field1:     dato8,
            field2:     dato9
        },

        success:function(){
            $("#msj-success").removeClass( "hide");
            $("#msj-success").html("Usuario actualizado exitosamente.");
            $("#tablaUsuarios").load(location.href+" #tablaUsuarios>*","");
            $('#user_edit').modal('toggle');
            hide_btn2();
        },
        error: function (jqXHR, exception) {
            var obj = jQuery.parseJSON(jqXHR.responseText);
            $("#msj-fail").removeClass( "hide");
            var msj = obj.name + '<br>' + obj.email + '<br>' + obj.password + '<br>' + obj.address + '<br>';
            var res = msj.replace(/undefined<br>/gi, '');
            var res = res.replace(/name/gi, 'Nombre');
            var res = res.replace(/address/gi, 'Dirección');
            var res = res.replace(/email/gi, 'Email');
            $("#msj-fail").html(res);
            $('#user_edit').modal('toggle');
            hide_btn2();
        }

    });
}
});


$("#delete_att").click(function(){
    $('#btns_delete').slideUp( "fast", function() {
        $("#btns_confirm").show( "fast" );
    });
});

$("#delete").click(function(){

    hide_alert();
    hide_btn();

        var value = $("#id1").val();
        var route = "/usuario/"+value+"";
        var token = $("#token").val();

        $.ajax({
            url: route,
            headers: {'X-CSRF-TOKEN': token},
            type: 'DELETE',
            dataType: 'json',
            success:function(){
                $("#msj-success").removeClass( "hide");
                $("#msj-success").html("Usuario eliminado exitosamente.");
                $("#tablaUsuarios").load(location.href+" #tablaUsuarios>*","");
                $("#divSitio").load(location.href+" #divSitio>*","");
                $('#user_edit').modal('toggle');
                hide_btn2();
            },
            error: function (jqXHR, exception) {
                $("#msj-fail").removeClass("hide");
                $("#msj-fail").html("<p>Intentar de nuevo.</p>");
                $('#user_edit').modal('toggle');
                hide_btn2();
            } 
        });

        $('#btns_confirm').hide( "fast");
        $("#btns_delete").show( "fast" );
});

$("#cancel").click(function(){
    $('#btns_confirm').hide( "fast", function() {
        $("#btns_delete").show( "fast" );
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

function search(){
    var route = "/admin/usuarios/search/" + id_usuario + "" ;
    window.location.assign(route);
}

$( ".select_user" ).change(function() {
    sort(this.value);
});

function sort(sort){
    var route = "/admin/usuarios/sort/" + sort + "" ;
     window.location.assign(route);
}


$("#type").change(function() {
    
    var id = this.value;

    if(id==null || id == ''){
        $(".type_msg").html('<div class="alert alert-danger" style="padding: 5px;"><p>Se debe asignar una cuota al usuario.</p></div>');
    }else{
        var route = "/cuotas/"+ id +"/edit";

        $.get(route, function(res){
            var concepto = res.concepto;
            var monto = res.amount;
            var msg = '<div class="alert alert-info" style="padding: 5px;">Monto de ' + concepto + ': $' + monto +'.00</div>';
            $(".type_msg").html( msg );
        });
    }
});

$("#type1").change(function() {
    
    var id = this.value;

    if(id==null || id == ''){
        $(".type_msg").html('<div class="alert alert-danger" style="padding: 5px;"><p>Se debe asignar una cuota al usuario.</p></div>');
    }else{
        var route = "/cuotas/"+ id +"/edit";

        $.get(route, function(res){
            var concepto = res.concepto;
            var monto = res.amount;
            var msg = '<div class="alert alert-info" style="padding: 5px;">Monto de ' + concepto + ': $' + monto +'.00</div>';
            $(".type_msg").html( msg );
        });
    }
});

$("#role").change(function() {

    var role = this.value;

    if(role==1){
        $(".role_msg").html('<div class="alert alert-warning" style="padding: 5px;">Atención: Ha seleccionado un Rol de Administrador para este usuario.</div>');
    }else{
        $(".role_msg").html('');
    }
});

$("#role1").change(function() {

    var role = this.value;

    if(role==1){
        $(".role_msg").html('<div class="alert alert-warning" style="padding: 5px;">Atención: Ha seleccionado un Rol de Administrador para este usuario.</div>');
    }else{
        $(".role_msg").html('');
    }
});

/** modificar password **/

function asignar_id(btn){

    hide_alert();
    console.log('id:'+btn);
    $('#user_edit').modal('toggle');

    $('#pass_edit').modal('toggle');
    $("#id_pass").val(btn);
}

$("#pass_modify").click(function(){

    hide_alert();

    var c1 = $("#current_pass").val();
    var c2 = $("#new_pass").val();
    var c3 = $("#new_pass_2").val();
    var id = $("#id_pass").val();
    var token = $("#token_pass").val();
    var route = "change_pass/"+ id;

    $.ajax({
        url: route,
        headers: {'X-CSRF-TOKEN': token},
        type: 'POST',
        dataType: 'json',
        data:{
            pass: c1, 
            new_pass: c2, 
            new_pass_2: c3
        },
        success:function(data){
            if(data.res=='success'){
                    $("#msj-success").removeClass("hide");
                    $("#msj-success").html(data.msg);
                    $('#pass_edit').modal('toggle');
            }else if(data.res=='fail'){
                    $("#msj-fail").removeClass("hide"); 
                    $("#msj-fail").html(data.msg);
                    $('#pass_edit').modal('toggle');
            } 
        },
        error: function (jqXHR, exception) {
            $("#msj-fail").removeClass("hide"); 
            $("#msj-fail").html('Volver a intentar.');
            $('#pass_edit').modal('toggle');
        }
    });
});
