<?php
global $wpdb;
$regemail = '/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/';
$fpmail = $wpdb->get_row("SELECT * FROM " . $wpdb->prefix . "fp_phpmailer where id=1");
$url=$_POST['formposturl'];
$msgs = array();
$pregunta = $_POST['formpostpregunta'];
if (empty($_POST['formpostname'])) {
  $msgs[] = "El campo nombre no puede estar vacío";
}else if(preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚäëïöüÄËÏÖÜàèìòùÀÈÌÒÙ\s]+$/", $_POST['formpostname'])){
	$name = $_POST['formpostname'];
}else{
	$msgs[] = "El nombre solo puede tener letras y espacio";
}

if (empty($_POST['formpostemail'])) {
  $msgs[] = "El campo correo está vacío";
}else if(preg_match($regemail, $_POST['formpostemail'])){
	$email = $_POST['formpostemail'];
}else{
	$msgs[] = "El campo del correo no es valido";
}

if (empty($_POST['formposttlf'])) {
  $msgs[] = "El campo Telefono no puede estar vacío";
}else if(is_numeric($_POST['formposttlf'])){
	$tlf = $_POST['formposttlf'];
}else{
	$msgs[] = "El campo Telefono solo tiene que tener numeros";
}

function resultBlock($msgs,$style)
{
	$list="";
    if (count($msgs) > 0) {
        $list .= "<div id='error' class='alert alert-".$style."' role='alert'>
			<ul>";
        foreach ($msgs as $error) {
            $list .= "<li>" . $error . "</li>";
        }
        $list .= "</ul>";
        $list .= "</div>";
        return $list;
    }
}
if(!empty($msgs)){
    $data = array('result' => false, 'msgs'=>resultBlock($msgs,'danger'));
    exit(json_encode($data));
}

add_filter('wp_mail_from_name', 'formPost_email_name_sender');

function formPost_email_name_sender($email_from) {
    if($email_from === "WordPress")
        return 'Formulario de Contacto Web';
    else {
        return $email_from;}
}

add_filter( "wp_mail_content_type", "tipo_de_contenido_html" );
require DocForm .'action/plantilla-html-mail.php';

$destinatario = $fpmail->setfrom;
$asunto = $name.' - '.$email;
$cuerpo= $notificacion;
$cabeceras= array('Content-Type: text/html; charset=UTF-8');

wp_mail( $destinatario, $asunto , $cuerpo, $cabeceras);
remove_filter( 'wp_mail_content_type', 'tipo_de_contenido_html' );
function tipo_de_contenido_html() {
     return "text/html";
}



	$msgs[] = "Su correo fue enviado exitosamente, le atendenderemos muy pronto";
	$f   = date("m/d/Y");
    $hora   = date("h:i:s A");
    $wpdb->insert($wpdb->prefix . 'fp_contacformpost',
      array(
        'id_cfp' => NULL,
        'nombre'       => $name,
        'numero'    => $tlf,
        'email' => $email,
        'pregunta' => $pregunta,
        'fecha'       => $f,
        'hora'    => $hora,
        'url'    => $url,
      )
    );


$data = array('result' => true, 'msgs'=>resultBlock($msgs,'success'));
exit(json_encode($data));

 ?>