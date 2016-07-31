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


$("#btn_cal").click(function(){

    var myYear = document.getElementById('year_select').value;
    var myMonth = document.getElementById('month_select').value;
   
    if(myMonth<10){
        myMonth = "0" + myMonth;
    }

    var route = "/calendario/" +  myMonth + '/' + myYear;
    window.location.assign(route);

    //getEvents(myYear,myMonth);
});


$("#btn_cal_admin").click(function(){

    var myYear = document.getElementById('year_select').value;
    var myMonth = document.getElementById('month_select').value;
   
    if(myMonth<10){
        myMonth = "0" + myMonth;
    }

    var route = "/admin/calendario/" +  myMonth + '/' + myYear;
    window.location.assign(route);
});


function calendar(date){
        $('#calendar').fullCalendar({
            defaultDate: date,
            editable: false,
            lang: 'es',
            eventLimit: true, // allow "more" link when too many events
            events: eventos
        });
}

function hide_alert(){
    $("#msj-success").addClass("hide");
    $("#msj-fail").addClass("hide");
    $("#alert-success").addClass("hide");
}

function clearModals(){
    $("#ev_title").val('');
    $("#datepicker_start").val('');
    $("#datepicker_end").val('');
}


$(function() {
    $( "#datepicker_start" ).datepicker({
      showOn: "button",
      buttonImage: "../img/n_5.png",
      buttonImageOnly: true,
      buttonText: "seleccionar Fecha"
    });
    $( "#datepicker_start" ).datepicker("option", "dateFormat", "yy-mm-dd");

    $( "#datepicker_start1" ).datepicker({
      showOn: "button",
      buttonImage: "../img/n_5.png",
      buttonImageOnly: true,
      buttonText: "seleccionar Fecha"
    });
    $( "#datepicker_start1" ).datepicker("option", "dateFormat", "yy-mm-dd");

    $( "#datepicker_end" ).datepicker({
      showOn: "button",
      buttonImage: "../img/n_5.png",
      buttonImageOnly: true,
      buttonText: "seleccionar Fecha"
    });
    $( "#datepicker_end" ).datepicker("option", "dateFormat", "yy-mm-dd");

    $( "#datepicker_end1" ).datepicker({
      showOn: "button",
      buttonImage: "../img/n_5.png",
      buttonImageOnly: true,
      buttonText: "seleccionar Fecha"
    });
    $( "#datepicker_end1" ).datepicker("option", "dateFormat", "yy-mm-dd");
});


function mostrar_evento(btn){
    
    hide_alert();

    var route = "/eventos/"+ btn.value;

    $.get(route, function(res){
        $('#ev_title1').val(res.title);
        $("#datepicker_start1").val(res.start);
        $("#datepicker_end1").val(res.end);
        $("#evento_id").val(res.id);
    });
}


$("#registrar_evento").click(function(){

    hide_alert();

    var dato1 = $("#ev_title").val();
    var dato2 = $("#datepicker_start").val();
    var dato3 = $("#datepicker_end").val();
    var route = "/eventos";
    var token = $("#token_evento").val();

    $.ajax({
        url: route,
        headers: {'X-CSRF-TOKEN': token},
        type: 'POST',
        dataType: 'json',
        data:{title: dato1, start: dato2, end: dato3},
        success:function(){
            window.location.reload();
        },
        error: function (jqXHR, exception) {
            var obj = jQuery.parseJSON(jqXHR.responseText);
            $("#msj-fail").removeClass( "hide");
            var msj = obj.title + '<br>' + obj.start + '<br>' + obj.end + '<br>';
            var res = msj.replace(/undefined<br>/gi, '');
            var res = res.replace(/title/gi, 'Titulo');
            var res = res.replace(/start/gi, 'Fecha de Inicio');
            var res = res.replace(/end/gi, 'Fecha de Termino');
            var res = res.replace(/Y-m-d/gi, 'año-mes-dia');
            $("#msj-fail").html(res);
            $('#eventos_create').modal('toggle');
        }
    });
});


$("#actualizar_evento").click(function(){

    hide_alert();

    var value = $("#evento_id").val();
    var dato1 = $("#ev_title1").val();
    var dato2 = $("#datepicker_start1").val();
    var dato3 = $("#datepicker_end1").val();

    var route = "/eventos/" + value;
    var token = $("#token_evento").val();

    $.ajax({
        url: route,
        headers: {'X-CSRF-TOKEN': token},
        type: 'PUT',
        dataType: 'json',
        data:{title: dato1, start: dato2, end: dato3},
        success:function(){
            window.location.reload();
        },
        error: function (jqXHR, exception) {
            var obj = jQuery.parseJSON(jqXHR.responseText);
            $("#msj-fail").removeClass( "hide");
            var msj = obj.title + '<br>' + obj.start + '<br>' + obj.end + '<br>';
            var res = msj.replace(/undefined<br>/gi, '');
            var res = res.replace(/title/gi, 'Titulo');
            var res = res.replace(/start/gi, 'Fecha de Inicio');
            var res = res.replace(/end/gi, 'Fecha de Termino');
            var res = res.replace(/Y-m-d/gi, 'año-mes-dia');
            $("#msj-fail").html(res);
            $('#eventos_edit').modal('toggle');
        } 
    });
});

$("#delete_att").click(function(){
    $('#btns_delete').slideUp( "fast", function() {
        $("#btns_confirm").show( "fast" );
    });
});

$("#delete").click(function(){

        hide_alert();

        var value = $("#evento_id").val();
        var route = "/eventos/"+value;
        var token = $("#token_evento").val();

        $.ajax({
            url: route,
            headers: {'X-CSRF-TOKEN': token},
            type: 'DELETE',
            dataType: 'json',
            success:function(){
                window.location.reload();
            },
            error: function (jqXHR, exception) {
                $("#msj-fail").removeClass( "hide");

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






