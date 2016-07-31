
//internas
var current_li = "#int_l1";
var current_div = "#int_div1";

function Toogle(x,y){
    $( current_li ).removeClass( "left_sel" );
    $( current_div).css("display", "none"); 
    current_li=x;
    current_div = y;
    $( current_li ).addClass( "left_sel" );
    $( current_div ).css("display", "inline");
    $(".alert-success").addClass("hide"); 
}


$( "#int_l1" ).on( "click", function() {
    Toogle("#int_l1","#int_div1");
});
$( "#int_l2" ).on( "click", function() {
    Toogle("#int_l2","#int_div2");
});
$( "#int_l3" ).on( "click", function() {
    Toogle("#int_l3","#int_div3");
});
$( "#int_l4" ).on( "click", function() {
    Toogle("#int_l4","#int_div4");
});
$( "#int_l5" ).on( "click", function() {
    Toogle("#int_l5","#int_div5");
});
$( "#int_l6" ).on( "click", function() {
    Toogle("#int_l6","#int_div6");
});
$( "#int_l7" ).on( "click", function() {
    Toogle("#int_l7","#int_div7");
});


//TABS
$(document).ready(function(){
    $(".nav-tabs a").click(function(){
        $(this).tab('show');
    });
});


//AJAX PAGINATE

/*

$(document).on('click', '.pagination a',function(e){
    e.preventDefault();
    var page = $(this).attr('href').split('page=')[1];
    var route = "http://localhost:8080/laravel5_1/public/noticias";

    $.ajax({
        url: route,
        data: {page: page},
        type: 'GET',
        dataType: 'json',
        success: function(data){
           // $(".noticias").html(data);
           console.log(page);
        }
    });

});

*/



/** CONTACT **/

$("#enviar_contacto").click(function(){

    var name = $("#name").val();
    var email = $("#email").val();
    var msg = $("#msg").val();
    var token = $("#token_contact").val();

    var route = "/mail";

    $.ajax({
        url: route,
        headers: {'X-CSRF-TOKEN': token},
        type: 'POST',
        dataType: 'json',
        data:{
            name:       name, 
            email:      email, 
            msg:        msg
        },
        success:function(){
            $("#msj-success").removeClass( "hide");
        },
        error: function (jqXHR, exception) {
            $("#msj-fail").removeClass( "hide");
        }
    });
});


/** burger nav mobile **/

var flag = true; 

$(".burger").click(function(){
    if(flag){
        $('.nav_menu').slideUp("fast");
        flag=false;
    }else{
        $('.nav_menu').slideDown("fast");
        flag=true;
    }
});




        

