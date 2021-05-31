<?php
$status = $_GET['status'];//our status will be called here
if($status=="1") {//if the email was sent
   echo '<div class="successAlert" style="width:560px; margin:auto">
   Mensaje enviado satisfactoriamente!<br><br><A HREF="index.html" target="_parent">Ir a inicio</A></div>';
   } elseif ($status=="0") {//if the email was not sent
   echo '<div class="warningAlert" style="width:560px; margin:auto">
   El mensaje no fue enviado. Por favor revise sus contenidos!</div>';
   } else {//we're here for the first time so no status is available
   echo"";//do nothing or do something. Use your imagination :)
   }
?>
