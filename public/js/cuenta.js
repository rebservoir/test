
    var index=0;
    var idx = 0;
    var pagos = [];
    var id_user=0;
    var lng;

function hide_alert(){
    $("#msj-success").addClass("hide");
    $("#msj-fail").addClass("hide");
    $("#alert-success").addClass("hide");
}

$("#actualizar_pago").click(function(){

    hide_alert();

    id_user = $("#id_user").val();

    var route = "/pagos_show/";

    $.get(route, function(res){
        
        lng = res.length;
    
        id_user = res.id_user;

        for (index = 0; index < res.length; index++) {
            pagos[index] = res[index].id;
        }

        update();

    });

});



function update(){

    hide_alert();

    for (idx = 0; idx < lng; idx++){

        var route = "/pagos/" + pagos[idx] + "";    
        var token = $("#token").val();

        $.ajax({
            url: route,
            headers: {'X-CSRF-TOKEN': token},
            type: 'PUT',
            dataType: 'json',
            data:{status: 1},

            success:function(){
                $("#int_div3").load(location.href+" #int_div3>*","");
            },
             error: function (jqXHR, exception) {
                var obj = jQuery.parseJSON(jqXHR.responseText);
            } 

        });
    }

}


function registrar_pagos($cont){

    hide_alert();

    if($cont==1){
        modal = '#mensual';
    }else if($cont==6){
        modal = '#semestral';
    }else{
        modal = '#anual';
    }

    id_user = $("#id_user").val();
    var date = $("#begin_date").val();

    var res = date.split("-");

    var year = parseInt(res[0]);
    var mes = parseInt(res[1]) + 1;
    var dia = parseInt(res[2]);
   
    var amount = $("#amount").val();
    var user_name = $("#user_name").val();
    var status = 1;


    if(mes==13){
        mes=1;
        year++;
    }

    var route = "/pagos";
    var token = $("#token").val();

    for (x = 0; x < $cont; x++){

        if(mes<10){
            date = year + "-0" + mes + "-15"; 
        }
        else{
            date = year + "-" + mes + "-15";
        }

    $.ajax({
        url: route,
        headers: {'X-CSRF-TOKEN': token},
        type: 'POST',
        dataType: 'json',
        data:{id_user: id_user, date: date, amount: amount, status: status, user_name: user_name},

        success:function(){
            $("#cuenta_pago").load(location.href+" #cuenta_pago>*","");
            //$("#mensual").load(location.href+" #mensual>*","");

            if((x+1)==$cont){
                $(modal).modal('toggle');
            }
        },
         error: function (jqXHR, exception) {
            var obj = jQuery.parseJSON(jqXHR.responseText);
        } 
    });

        mes++;

        if(mes==13){
            mes=1;
            year++;
        }
    }
}

/** modificar **/

function asignar_id(btn){

    hide_alert();

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



$("#mensual_pago").click(function(){
   registrar_pagos(1);
});
$("#semestral_pago").click(function(){
   registrar_pagos(6);
});
$("#anual_pago").click(function(){
   registrar_pagos(12);
});





