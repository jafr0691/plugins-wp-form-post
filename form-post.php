<?php
/*
Plugin Name: FormPost
Plugin URI:  https://www.lexumcorp.com
Description: Capture the traffic through a form in the post
Version:     1.0
Author:      Daniel Plaza
Author URI:  https://www.lexumcorp.com
Domain Path: /languages/
Text Domain: form Post
 */
defined('ABSPATH') or die('No script please!');

global $wpdb;
define('DocForm', plugin_dir_path(__FILE__));
define('ArcForm', plugin_dir_url(__FILE__));

add_action('wp_enqueue_scripts', 'formPortAjax');
function formPortAjax()
{
    wp_register_script('script_send', plugin_dir_url(__FILE__) . 'js/formPost.js', array('jquery'), '1', true);
    wp_enqueue_script('script_send');
    wp_localize_script('script_send', 'sendformpost', ['ajaxurl' => admin_url('admin-ajax.php')]);
}

add_action('wp_ajax_sendformpost', 'sendformpost');
add_action('wp_ajax_nopriv_sendformpost', 'sendformpost');


function sqlformpost()
{
    require_once DocForm . 'action/sql.php';
}

function sendformpost()
{
    require_once DocForm . 'action/sendformpost.php';
}

function control_jquery_form_post()
{
    wp_enqueue_script('bootstrap.3.4.1.min_file', plugins_url('/js/bootstrap.3.4.1.min.js', __FILE__));
    wp_register_script('script_sql', plugin_dir_url(__FILE__) . 'js/sql.js', array('jquery'), '1', true);
    wp_enqueue_script('script_sql');
    wp_localize_script('script_sql', 'sqlformpost', ['sqlajaxurl' => admin_url('admin-ajax.php')]);
}
add_action('admin_enqueue_scripts', 'control_jquery_form_post');
add_action('wp_ajax_sqlformpost', 'sqlformpost');
add_action('wp_ajax_nopriv_sqlformpost', 'sqlformpost');

function cssFormPost()
{
    if(is_single()){
        wp_enqueue_style('formPostCss', plugins_url('/css/formpost.css', __FILE__));
    }

}
add_action('wp_enqueue_scripts', 'cssFormPost');

//insertar anuncios dentro del contenido

add_filter( 'the_content', 'insertar_anuncios_contenido_post' );

function insertar_anuncios_contenido_post( $content ) {
    global $wpdb;
    $postfpstyle = $wpdb->get_row("SELECT * FROM " . $wpdb->prefix . "fp_styleform where id=1");
    $contenido_ad1 = '<br><div class="container-form-post">
            <div class="cardfp containerf-p" style="background-color:'.$postfpstyle->colorfondo.' !important; color:'.$postfpstyle->colortext.' !important;font-family:'.$postfpstyle->tipoletra.' !important;">
                <form id="acction-form-post">
                <input type="hidden" name="formposturl" id="formposturl" value="">
                    <div class="cardfp-body">
                        <h6 class="cardfp-title text-center title-c-f-p" style="color:'.$postfpstyle->colortext.' !important;">
                            <strong>
                                ¿Preguntas?
                            </strong>
                            Deja tus datos y te llamamos hoy.
                        </h6>
                        <hr class="hr-f-p" style="background-color:'.$postfpstyle->colorbtn.' !important;">
                            <div class="form-f-p-row">
                                <div class="form-f-p-group col-sm-6">
                                    <input class="form-f-p-control inputfp" style="background-color:'.$postfpstyle->colorfondoinput.' !important; color:'.$postfpstyle->colortext.' !important;font-family:'.$postfpstyle->tipoletra.' !important; border-radius: 0 !important;" id="formpostname" name="formpostname" placeholder="Nombre" type="text" required>
                                    </input>
                                </div>
                                <div class="form-f-p-group col-sm-6">
                                    <input class="form-f-p-control inputfp"  style="background-color:'.$postfpstyle->colorfondoinput.' !important; color:'.$postfpstyle->colortext.' !important;font-family:'.$postfpstyle->tipoletra.' !important; border-radius: 0 !important;" id="formpostemail" name="formpostemail" placeholder="Correo Electrónico" type="email" required>
                                    </input>
                                </div>
                            </div>
                            <div>
                                <div class="form-f-p-group">
                                    <input class="form-f-p-control inputfp"  style="background-color:'.$postfpstyle->colorfondoinput.' !important; color:'.$postfpstyle->colortext.' !important;font-family:'.$postfpstyle->tipoletra.' !important; border-radius: 0 !important;" id="formpostpregunta" name="formpostpregunta" placeholder="Explique su caso" type="text" required>
                                    </input>
                                </div>
                            </div>
                            <div class="form-f-p-row">
                                <div class="form-f-p-group col-sm-6">
                                    <input class="form-f-p-control inputfp"  style="background-color:'.$postfpstyle->colorfondoinput.' !important; color:'.$postfpstyle->colortext.' !important;font-family:'.$postfpstyle->tipoletra.' !important; border-radius: 0 !important;" id="formposttlf" name="formposttlf" placeholder="Teléfono" onkeyUp="return ValNumer(this);" type="tel" required>
                                    </input>
                                </div>
                                <div class="form-f-p-group col-sm-6">
                                    <button class="form-f-p-control text-uppercase" style="background-color:'.$postfpstyle->colorbtn.' !important; color:'.$postfpstyle->colortext.' !important;font-family:'.$postfpstyle->tipoletra.' !important;width:100% !important;height:100% !important;
font-size:1em !important;font-weight:650 !important;border-color:'.$postfpstyle->colorbtn.' !important;cursor: pointer;" id="btnformpostclick" type="submit">
                                        SOLICITAR ACESORÍA
                                    </button>
                                </div>
                                <img style="display: none;" src="'.ArcForm.'img/carga.gif" id="formpostcargar" width="70px" height="50px">
                                <div id="msgformpost">
                                </div>
                            </div>
                        </hr>
                    </div>
                </form>
            </div>
            </div>
        </br><script>
  function Solo_Numeric(variable){
      Numer=parseInt(variable);
      if (isNaN(Numer)){
          return "";
      }
      return Numer;
  }
  function ValNumer(Control){
      Control.value=Solo_Numeric(Control.value);
  }
  document.getElementById("formposturl").value = window.location.href;
</script>';


    if ( is_single() && ! is_admin() ) {

        $content= insertar_despues_del_parrafo( $contenido_ad1, $postfpstyle->position, $content );
        return $content;
    }

    return $content;
}
//buscando el lugar dentro del contenido

function insertar_despues_del_parrafo( $insertion, $paragraph_id, $content ) {
    $closing_p = '</p>';
    $paragraphs = explode( $closing_p, $content );
    foreach ($paragraphs as $index => $paragraph) {

        if ( trim( $paragraph ) ) {
            $paragraphs[$index] .= $closing_p;
        }

        if ( $paragraph_id == $index + 1 ) {
            $paragraphs[$index] .= $insertion;
        }
    }

    return implode( '', $paragraphs );
}

function panel_form_post()
{
    add_menu_page('Cp FormPost', 'FormPost', 'manage_options', DocForm . 'action/controlFormPost.php');

}
add_action('admin_menu', 'panel_form_post');

function db_form_post()
{
    require_once DocForm . 'dbformpost.php';
}
register_activation_hook(__FILE__, 'db_form_post');


