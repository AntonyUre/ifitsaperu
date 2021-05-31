<?
//***Made by GARGS
$site_name = "www.ifitsaperu.com";
$admin_email = "requerimientos@ifitsaperu.com";
include_once 'securimage/securimage.php';
$securimage = new Securimage();
if ($securimage->check($_POST['captcha_code']) == false)
{
  die('El código ingresado no coincide. Tratar de nuevo / The code you entered was incorrect.  Go back and try again.');
}
function check_email_address($email) {
  // First, we check that there's one @ symbol, and that the lengths are right
  if (!ereg("^[^@]{1,64}@[^@]{1,255}$", $email)) {
    header("Location: index.php?status=0");
  }
  // Split it into sections to make life easier
  $email_array = explode("@", $email);
  $local_array = explode(".", $email_array[0]);
  for ($i = 0; $i < sizeof($local_array); $i++) {
     if (!ereg("^(([A-Za-z0-9!#$%&'*+/=?^_`{|}~-][A-Za-z0-9!#$%&'*+/=?^_`{|}~\.-]
              {0,63})|(\"[^(\\|\")]{0,62}\"))$", $local_array[$i])) {
       header("Location: index.php?status=0");
    }
  }
  if (!ereg("^\[?[0-9\.]+\]?$", $email_array[1])) {
    $domain_array = explode(".", $email_array[1]);
    if (sizeof($domain_array) < 2) {
         die ("Dirección de E-Mail invalida");// Not enough parts to domain
    }
    for ($i = 0; $i < sizeof($domain_array); $i++) {
      if (!ereg("^(([A-Za-z0-9][A-Za-z0-9-]{0,61}[A-Za-z0-9])|([A-Za-z0-9]+))$",
      $domain_array[$i])) {
         header("Location: index.php?status=0");
      }
    }
  }
  return $email;
}
function escape_val($string) {
        $string = str_replace(array("\"","\'","<",">",'\\'), array("&#34;","&#39;","&lt;","&gt;",""), $string);
        return $string;
}
$check_email = check_email_address($_REQUEST['email']);
$empresa = escape_val($_REQUEST['empresa']);
$nombre = escape_val($_REQUEST['nombre']);
$tel = escape_val($_REQUEST['tel']);
$movil = escape_val($_REQUEST['movil']);
$direccion = escape_val($_REQUEST['direccion']);
$ciudad = escape_val($_REQUEST['ciudad']);
$estado = escape_val($_REQUEST['estado']);
$pais = escape_val($_REQUEST['pais']);
$comentarios = escape_val($_REQUEST['comentarios']);
$time = date('l dS \of F Y h:i:s A');
$email_subject = "Nuevo contacto desde ".$site_name."";
$ip = $_SERVER["REMOTE_ADDR"];
$mes = "Enviado el: ".$time." desde ".$ip."\n\n";
$mes .= "Nombre: ".$nombre."\n\n";
$mes .= "Empresa: ".$empresa."\n\n";
$mes .= "Teléfono: ".$tel."\n\n";
$mes .= "Móvil: ".$movil."\n\n";
$mes .= "Dirección: ".$direccion."\n\n";
$mes .= "Ciudad: ".$ciudad."\n\n";
$mes .= "Estado: ".$estado."\n\n";
$mes .= "País: ".$pais."\n\n";
$mes .= "Comentarios: ".$comentarios."\n\n";
if(mail($admin_email,$email_subject,$mes,
"From:$check_email")) {
header("Location: http://$site_name/index.php?status=1");
exit;
} else {
header("Location: http://$site_name/index.php?status=0");
}
?>
