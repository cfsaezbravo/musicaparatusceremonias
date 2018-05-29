<?php
if(isset($_POST['inputmail']))
  {
 
    ##Cami cambia aca el mail a tu Gmail para probarlo una vez que esté en el servidor y luego pones el mail de la igle
    $email_to = "cfsaezbravo@gmail.com";
    $email_subject = "Contacto Web";

    $first_name = $_POST['inputname']; // required
    $email_from = $_POST['inputmail']; // required
    $comments = $_POST['inputtext']; // required

    $error_message = "";
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
 
  if(!preg_match($email_exp,$email_from)) {
    $error_message .= 'La dirección de correo electrónico que ingresó no parece ser válida.<br />';
  }
 
    $string_exp = "/^[A-Za-z .'-]+$/";
 
  if(!preg_match($string_exp,$first_name)) {
    $error_message .= 'El primer nombre que ingresó no parece ser válido.<br />';
  }
 
  if(strlen($comments) < 2) {
    $error_message .= 'Los Comentarios que ingresaste no parecen ser válidos.<br />';
  }
 
  if(strlen($error_message) > 0) {
    died($error_message);
  }
 
  $email_message = "El siguiente mensaje ha sido enviado desde la página web de la Iglesia La Trinidad:\n\n";
     
  function clean_string($string)
  {
      $bad = array("content-type","bcc:","to:","cc:","href");
      return str_replace($bad,"",$string);
  }
 
  $email_message .= "Nombre: ".clean_string($first_name)."\n";
  $email_message .= "Email: ".clean_string($email_from)."\n";
  $email_message .= "Mensaje: ".clean_string($comments)."\n";
 
    // create email headers
    $headers = 'From: '.$email_from."\r\n".
    'Reply-To: '.$email_from."\r\n" .
    'X-Mailer: PHP/' . phpversion();
    @mail($email_to, $email_subject, $email_message, $headers);
 
  }

?>
