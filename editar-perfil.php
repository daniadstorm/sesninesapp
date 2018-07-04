<?php
include_once('config/config.inc.php'); //cargando archivo de configuracion
//$uM->control_sesion($ruta_inicio, ADMIN);

$fM = load_model('form');

$uM = load_model('usuario'); //uM userModel

$nombre_usuario = '';
$contrasenya_usuario = '';
$id_usuario = 0;
$nombrecompleto_usuario = '';
$email_usuario = '';
$fecha_nacimiento = '';
$telf_usuario = '';
$nie_usuario = '';

$arr_err = array();
$verif = true;

if (isset($_GET['id_usuario'])) {
    
    $id_usuario = $_GET['id_usuario'];
    
    $rgu = $uM->get_user($id_usuario);
    if ($rgu) {
        while ($fgu = $rgu->fetch_assoc()) {
            $nombrecompleto_usuario = $fgu['nombrecompleto_usuario'];
            $email_usuario = $fgu['email_usuario'];
            $fecha_nacimiento = $fgu['fecha_nacimiento'];
            $contrasenya_usuario = $fgu['contrasenya_usuario'];
            $telf_usuario = $fgu['telf_usuario'];
            $nie_usuario = $fgu['nie_usuario'];
        }
    } else $str_errores = $str_errores = '<div class="error_alert">Error cargando usuario</div>';
}else if(isset($_SESSION['id_usuario'])){
    $id_usuario = $_SESSION['id_usuario'];
    
    $rgu = $uM->get_user($id_usuario);
    if ($rgu) {
        while ($fgu = $rgu->fetch_assoc()) {
            $nombrecompleto_usuario = $fgu['nombrecompleto_usuario'];
            $email_usuario = $fgu['email_usuario'];
            $fecha_nacimiento = $fgu['fecha_nacimiento'];
            $contrasenya_usuario = $fgu['contrasenya_usuario'];
            $telf_usuario = $fgu['telf_usuario'];
            $nie_usuario = $fgu['nie_usuario'];
        }
    } else $str_errores = $str_errores = '<div class="error_alert">Error cargando usuario</div>';
}

//GET___________________________________________________________________________

//GET___________________________________________________________________________

//POST__________________________________________________________________________
if (isset($_POST['id_usuario'])) {
    
    $id_usuario = $_POST['id_usuario'];
    $nombrecompleto_usuario = $_POST['nombrecompleto_usuario'];
    $email_usuario = $_POST['email_usuario'];
    $fecha_nacimiento = $_POST['fecha_nacimiento'];//
    $contrasenya_usuario = $_POST['contrasenya_usuario'];
    $telf_usuario = $_POST['telf_usuario'];
    $nie_usuario = $_POST['nie_usuario'];
    
    //control de errores ---------------------------------------------------- */
    $fM->check_length('nombrecompleto_usuario', $nombrecompleto_usuario, $verif, $arr_err);
    $fM->check_is_valid_email('email_usuario', $email_usuario, $verif, $arr_err, 'Debe ser una dirección email');
    //$fM->check_is_date('fecha_nacimiento',$fecha_nacimiento, $verif, $arr_err, 'La fecha de nacimiento no es válida');
    $fM->check_length('contrasenya_usuario',$contrasenya_usuario, $verif, $arr_err);
    $fM->check_length('telf_usuario', $telf_usuario, $verif, $arr_err);
    $fM->check_length('nie_usuario', $nie_usuario, $verif, $arr_err);
    //control de errores ---------------------------------------------------- */
    
    //MySQL ----------------------------------------------------------------- */
    if ($verif == true) {
        
        //id_usuario
        $nombrecompleto_usuario = $uM->escstr($nombrecompleto_usuario);
        $fecha_nacimiento = $fecha_nacimiento;
        $email_usuario = $uM->escstr($email_usuario);
        $contrasenya_usuario = $uM->escstr($contrasenya_usuario);
        $telf_usuario = $uM->escstr($telf_usuario);
        $nie_usuario = $uM->escstr($nie_usuario);
        
        if ($id_usuario > 0) { //UPDATE
            //para el campo nombre_usuario se le pasa email_usuario (el email es usado para el login)
            $ruu = $uM->update_usuario($id_usuario, $email_usuario, $fecha_nacimiento, $nombrecompleto_usuario, $email_usuario, $contrasenya_usuario, $telf_usuario, $nie_usuario, 
                USER);
            if ($ruu) {
                header('Location: '.$ruta_inicio.'ver-perfil.php'); exit();
            } else $str_errores = '<div class="error_alert">Error actualizando usuario</div>';
            
        }
    }
    //MySQL ----------------------------------------------------------------- */
}
//POST__________________________________________________________________________

//CONTROL_______________________________________________________________________

//CONTROL_______________________________________________________________________

include_once('inc/cabecera.inc.php'); //cargando cabecera
?>
<script type="text/javascript">

</script>

<body>
    <?php include_once('inc/franja_top.inc.php'); ?>
    <?php include_once('inc/main_menu.inc.php'); ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="content mt-1">
                    <div class="layout">
                        <div class="layout-table">
                            <div id="alertas">
                                <?php if (isset($str_info)) echo $str_info; ?>
                                <?php if (isset($str_errores)) echo '<div class="alert alert-danger" role="alert">'.$str_errores.'</div>'; ?>
                            </div>
                            <div class="layout-table-item">
                                <div class="layout-table-header">
                                    <h4>Editar perfil</h4>
                                </div>
                                <div class="layout-table-content">
                                    <form action="editar-perfil.php" method="post">
                                    <?php 
                                        echo $fM->get_input_hidden('id_usuario', $id_usuario);
                                        echo $fM->get_input_text('nombrecompleto_usuario', 'Nombre completo', $nombrecompleto_usuario, $arr_err);
                                        echo $fM->get_input_text('email_usuario', 'Email', $email_usuario, $arr_err);
                                        echo $fM->get_input_date('fecha_nacimiento', 'Fecha de nacimiento', $fecha_nacimiento, $arr_err);
                                        echo $fM->get_input_text('contrasenya_usuario', 'Contraseña', $contrasenya_usuario, $arr_err);
                                        echo $fM->get_input_text('telf_usuario', 'Telefono', $telf_usuario, $arr_err);
                                        echo $fM->get_input_text('nie_usuario', 'DNI / NIE', $nie_usuario, $arr_err);
                                    ?>
                                    <button class="btn bg-primary text-light">Aceptar</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- <div id="main_container">
    <div id="responsive_back_content">
        <?php include_once('inc/franja_top.inc.php'); ?>
        <?php //include_once('inc/main_menu.inc.php'); ?>
        <div id="responsive_seccion_back">
            
            <div id="ttl_seccion_back">
                <h2>Editar perfil</h2>
                <div style="clear:both;"></div>
            </div>
            
            <div id="filtros_seccion">
                <?php if (isset($str_info)) echo $str_info; ?>
                <?php if (isset($str_errores)) echo $str_errores; ?>
            </div>
            <div id="filtros_seccion">
                <form action="editar-perfil.php" method="post" id="form_tiendasvf_valores" name="form_tiedasvf_valores">
                    <div class="login_form">
                        <?php 
                            echo $fM->get_input_hidden('id_usuario', $id_usuario);
                            echo $fM->get_input_text('nombrecompleto_usuario', 'Nombre completo', $nombrecompleto_usuario, $arr_err);
                            echo $fM->get_input_text('email_usuario', 'Email', $email_usuario, $arr_err);
                            echo $fM->get_input_date('fecha_nacimiento', 'Fecha de nacimiento', $fecha_nacimiento, $arr_err);
                            echo $fM->get_input_text('contrasenya_usuario', 'Contraseña', $contrasenya_usuario, $arr_err);
                            echo $fM->get_input_text('telf_usuario', 'Telefono', $telf_usuario, $arr_err);
                            echo $fM->get_input_text('nie_usuario', 'DNI / NIE', $nie_usuario, $arr_err);
                        ?>
                        <div style="float:right; margin:0.8em 0;">
                            <input type="submit" style="float:none;" class="btn_aceptar" value="Aceptar" />
                        </div>
                        <div style="clear:both;"></div>
                    </div>
                </form>
            </div>
            
        </div>
    </div>
</div> -->
</body>

</html>