<?php
if($_POST)
{
    $to_email = "reb_189@hotmail.com"; //Recipient email, Replace with own email here
	
	
    //check if its an ajax request, exit if not
    if(!isset($_SERVER['HTTP_X_REQUESTED_WITH']) AND strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') {
        
        $output = json_encode(array( //create JSON data
            'type'=>'error', 
            'text' => 'Sorry Request must be Ajax POST'
        ));
        die($output); //exit script outputting json data
    } 
    
    //Sanitize input data using PHP filter_var().
    $name      = filter_var($_POST["name"], FILTER_SANITIZE_STRING);
    $email     = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
    $subject   = filter_var($_POST["subject"], FILTER_SANITIZE_STRING);
    $msg       = filter_var($_POST["msg"], FILTER_SANITIZE_STRING);
    
    //additional php validation
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){ //email validation
        $output = json_encode(array('type'=>'mail', 'text' => 'Please enter a valid email!'));
        die($output);
    }
    //email body
    $message_body =  "Mensaje enviado por: " . $name . "\r\nEmail: " . $email . "\r\nMensaje: " . $msg;
    
    //proceed with PHP email.
    $headers = 'From: '.$name.'' . "\r\n" .
    'Reply-To: '.$email.'' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();
    
    $send_mail = mail($to_email, $subject, $message_body);
    
    if(!$send_mail)
    {
        //If mail couldn't be sent output error. Check your PHP email configuration (if it ever happens)
        $output = json_encode(array('type'=>'error', 'text' => 'Could not send mail! Please check your PHP mail configuration.'));
        die($output);
    }else{
        $output = json_encode(array('type'=>'message', 'text' => 'Hi '.$user_name .' Thank you for your email'));
        die($output);
    }
}
?>