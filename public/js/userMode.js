function mostrar_info(btn){
    $("#msj-success").addClass( "hide");
    $( "#msj-fail").addClass( "hide");
 	var route = "/edit_info/"+ btn.value +"";
    $.get(route, function(res){
        $("#name").val(res.name);
        $("#email").val(res.email);
        $("#address").val(res.address);
        $("#phone").val(res.phone);
        $("#cel").val(res.celphone);
        $("#id").val(res.id);
    });
}


$("#modificar_info").click(function(){

    $("#msj-success").addClass( "hide");
    $( "#msj-fail").addClass( "hide");

    var value = $("#id").val();
    var dato1 = $("#name").val();
    var dato2 = $("#email").val();
    var dato3 = $("#address").val();
    var dato4 = $("#phone").val();
    var dato5 = $("#cel").val();

    var route = "/update_info_user/"+value+"";
    var token = $("#token_info").val();

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
        },

        success:function(){
            $("#msj-success").removeClass( "hide");
            $("#info_user").load(location.href+" #info_user>*","");
            $('#user_edit').modal('toggle');
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
            $(".msj").html(res);
        }

    });
});

/*

$("#modificar_pass").click(function(){

    $("#msj-success2").addClass( "hide");
    $( "#msj-fail2").addClass( "hide");

    var value = $("#id1").val();
    var pass1 = $("#pass1").val();
    var pass2 = $("#pass2").val();
    var pass3 = $("#pass3").val();


    if(pass2 == pass3){

	    var route = "http://localhost:8080/laravel5_1/public/update_info_user/"+value+"";
	    var token = $("#token_info").val();

	    $.ajax({
	        url: route,
	        headers: {'X-CSRF-TOKEN': token},
	        type: 'PUT',
	        dataType: 'json',
	        data:{
	            password: pass2, 
	        },

	        success:function(){
	            $("#msj-success2").removeClass( "hide");
	        },
	        error: function (jqXHR, exception) {
	        	/*
	            var obj = jQuery.parseJSON(jqXHR.responseText);
	            $("#msj-fail").removeClass( "hide");
	            var msj = obj.name + '<br>' + obj.email + '<br>' + obj.password + '<br>' + obj.address + '<br>';
	            var res = msj.replace(/undefined<br>/gi, '');
	             var res = res.replace(/name/gi, 'Nombre');
	              var res = res.replace(/address/gi, 'Dirección');
	              var res = res.replace(/email/gi, 'Email');
	              var res = res.replace(/password/gi, 'Password');
	               */ /*
	            $(".msj").html('Intentar de nuevo.');

	        }
	    });
    }
});

*/