<?php
include_once('config/config.inc.php'); //cargando archivo de configuracion
//$uM->control_sesion($ruta_inicio, ADMIN);

$fM = load_model('form');

$uM = load_model('usuario'); //uM userModel

$id_usuario = 0;
//$contrasenya_usuario = '';
$nombrecompleto_usuario = '';
$id_tipo_usuario = USER;
$email_usuario = '';

$arr_err = array();
$verif = true;
//GET___________________________________________________________________________
if(isset($_GET["email"]) && isset($_GET["first_name"]) && isset($_GET["last_name"])){
    $nombrecompleto_usuario=$_GET["first_name"]." ".$_GET["last_name"];
    $email_usuario=$_GET["email"];

    //control de errores --------------------------------
    $fM->check_length('nombrecompleto_usuario', $nombrecompleto_usuario, $verif, $arr_err);
    $fM->check_is_valid_email('email_usuario', $email_usuario, $verif, $arr_err, 'Debe ser una dirección email');

    if($verif == true){
        $nombrecompleto_usuario = $uM->escstr($nombrecompleto_usuario);
        $email_usuario = $uM->escstr($email_usuario);
        //MySQL -----------------------------------------------------------------
        if(!$id_usuario){
            $rauf = $uM->add_usuario_fb($email_usuario, $nombrecompleto_usuario, $email_usuario, USER);
            if ($rauf) {
                header('Location: '.$ruta_inicio.'clientes.php?nuevo_usuario=true'); exit();
            } else $str_errores = '<div class="error_alert">Error añadiendo usuario</div>';
        }
        //MySQL -----------------------------------------------------------------
    }
}
//GET___________________________________________________________________________

//POST__________________________________________________________________________

//POST__________________________________________________________________________

//CONTROL_______________________________________________________________________

//CONTROL_______________________________________________________________________

include_once('inc/cabecera.inc.php'); //cargando cabecera
?>
<script type="text/javascript">
    
</script>
<body>
<div id="main_container">
    <div id="responsive_back_content">
        <?php include_once('inc/franja_top.inc.php'); ?>
        <?php //include_once('inc/main_menu.inc.php'); ?>
        <div id="responsive_seccion_back">
            
            <div id="ttl_seccion_back">
                <h2>Nuevo Usuario</h2>
                <div style="clear:both;"></div>
            </div>
            
            <div id="filtros_seccion">
                <?php if (isset($str_info)) echo $str_info; ?>
                <?php if (isset($str_errores)) echo $str_errores; ?>
            </div>
            <div id="filtros_seccion">
                <!--<form action="new-account-fb.php" method="post" id="form_tiendasvf_valores" name="form_tiedasvf_valores">
                    <div class="login_form">
                        <?php /*
                            echo $fM->get_input_hidden('id_usuario', $id_usuario);
                            echo $fM->get_input_text('nombrecompleto_usuario', 'Nombre completo', $nombrecompleto_usuario, $arr_err);
                            echo $fM->get_input_text('email_usuario', 'Email', $email_usuario, $arr_err);
                            echo $fM->get_input_date('fecha_nacimiento', 'Fecha de nacimiento', $fecha_nacimiento, $arr_err);
                            echo $fM->get_input_text('contrasenya_usuario', 'Contraseña', $contrasenya_usuario, $arr_err);
                            echo $fM->get_input_text('telf_usuario', 'Telefono', $telf_usuario, $arr_err);
                            echo $fM->get_input_text('nie_usuario', 'DNI / NIE', $nie_usuario, $arr_err);*/
                        ?>
                        <div style="float:right; margin:0.8em 0;">
                            <input type="submit" style="float:none;" class="btn_aceptar" value="Aceptar" />
                        </div>
                        <div style="clear:both;"></div>
                    </div>
                </form>-->
            </div>
            
        </div>
    </div>
</div>
</body>
</html>