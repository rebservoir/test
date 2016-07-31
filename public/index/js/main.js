jQuery(document).ready(function($) {
    $('.my-slider').unslider({
        autoplay:true
    });
});
                       
var bb_video= document.getElementById("bb_video"); 
var vidOn = false; 

$(document).ready(function(){
    $("#btnVideo").click(function(){
        $("#myVideo").modal();
            if(vidOn){
                bb_video.play();
                }
            });
        });

$("#myVideo").on('hide.bs.modal', function () {
    if(!(bb_video.paused)){
        bb_video.pause();
        vidOn=true;
        }
});
  
    $("#submit_btn").click(function() { 
       
        var proceed = true;
        //simple validation at client's end
        //loop through each field and we simply change border color to red for invalid fields       
        $("#form input[required=true], #form textarea[required=true]").each(function(){
            $(this).css('border-color',''); 
            if(!$.trim($(this).val())){ //if this field is empty 
                $(this).css('border-color','red'); //change border color to red   
                proceed = false; //set do not proceed flag
            }
            //check invalid email
            var email_reg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/; 
            if($(this).attr("type")=="email" && !email_reg.test($.trim($(this).val()))){
                $(this).css('border-color','red'); //change border color to red   
                proceed = false; //set do not proceed flag              
            }   
        });
       
        if(proceed) //everything looks good! proceed...
        {
            //get input field values data to be sent to server
            post_data = {
                'name'     : $('input[name=name]').val(), 
                'email'    : $('input[name=email]').val(),   
                'subject'  : 'Contacto', 
                'msg'      : $('textarea[name=msg]').val()
            };
            
            var formMessages = $('#form_msg');  
            
            //Ajax post data to server
            $.post('contacto.php', post_data, function(response){  
                if(response.type == 'mail'){ //load json data from server and output message 
                    $(formMessages).removeClass('verde');
                    $(formMessages).addClass('rojo');
                    $(formMessages).text('Introduzca un email valido.');
                }else if(response.type == 'error'){ //load json data from server and output message 
                    $(formMessages).removeClass('verde');
                    $(formMessages).addClass('rojo');
                    $(formMessages).text('Hubo un error. Intentelo de nuevo.');
                }else if(response.type == 'message'){
                    $(formMessages).removeClass('rojo');
                    $(formMessages).addClass('verde');
                    $(formMessages).text('Mensaje enviado. Gracias.');
                    //reset values in all input fields
                    $("#contact_form  input[required=true], #contact_form textarea[required=true]").val(''); 
                }
            }, 'json');
        }
    });