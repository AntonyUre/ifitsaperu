<?php
    $to = 'ltorres@ifitsaperu.com';
    $firstname = $_POST["name"];
    $email= $_POST["email"];
    $text= $_POST["message"];
    $phone= $_POST["phone"];
    


    $headers = 'MIME-Version: 1.0' . "\r\n";
    $headers .= "From: " . $firstname . "\r\n"; // Sender's E-mail
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

    $message ='<table style="width:100%">
        <tr>
            <td><b>Nombres:</b> '.$firstname.'  '.$laststname.'</td>
        </tr>
        <tr><td><b>Email:</b> '.$email.'</td></tr>
        <tr><td><b>Fono:</b> '.$phone.'</td></tr>
        <tr><td><b>Mensaje:</b> '.$text.'</td></tr>
        
    </table>';

    if (@mail($to, $email, $message, $headers))
    {
        echo 'Este mensaje ha sido enviado.';
    }else{
        echo 'Mensaje no enviado';
    }

?>
