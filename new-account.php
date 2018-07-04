<?php
include_once('config/config.inc.php'); //cargando archivo de configuracion
//$uM->control_sesion($ruta_inicio, ADMIN);

$fM = load_model('form');
$uM = load_model('usuario'); //uM userModel

$nombre_usuario = '';
$contrasenya_usuario = '';
$id_usuario = 0;
$nombrecompleto_usuario = '';
$id_tipo_usuario = USER;
$comision_total_vendido = 1;
$email_usuario = '';
$fecha_nacimiento = '';
$telf_usuario = '';
$nie_usuario = '';

$arr_err = array();
$verif = true;
//GET___________________________________________________________________________

//GET___________________________________________________________________________

//POST__________________________________________________________________________
if (isset($_POST['id_usuario'])) {
    
    $id_usuario = $_POST['id_usuario'];
    $nombrecompleto_usuario = $_POST['nombrecompleto_usuario'];
    $email_usuario = $_POST['email_usuario'];
    $fecha_nacimiento = $_POST['fecha_nacimiento'];
    $contrasenya_usuario = $_POST['contrasenya_usuario'];
    $telf_usuario = $_POST['telf_usuario'];
    $nie_usuario = $_POST['nie_usuario'];
    
    //control de errores ---------------------------------------------------- */
    $fM->check_length('nombrecompleto_usuario', $nombrecompleto_usuario, $verif, $arr_err);
    $fM->check_is_valid_email('email_usuario', $email_usuario, $verif, $arr_err, 'Debe ser una dirección email');
    $fM->check_is_date('fecha_nacimiento',$fecha_nacimiento, $verif, $arr_err, 'La fecha de nacimiento no es válida');
    $fM->check_length('contrasenya_usuario',$contrasenya_usuario, $verif, $arr_err);
    $fM->check_length('telf_usuario', $telf_usuario, $verif, $arr_err);
    $fM->check_length('nie_usuario', $nie_usuario, $verif, $arr_err);
    //control de errores ---------------------------------------------------- */
    
    //MySQL ----------------------------------------------------------------- */
    if ($verif == true) {
        
        //id_usuario
        $nombrecompleto_usuario = $uM->escstr($nombrecompleto_usuario);
        $fecha_nacimiento = date_to_mysql($fecha_nacimiento);
        $email_usuario = $uM->escstr($email_usuario);
        $contrasenya_usuario = $uM->escstr($contrasenya_usuario);
        $telf_usuario = $uM->escstr($telf_usuario);
        $nie_usuario = $uM->escstr($nie_usuario);
        
        if ($id_usuario > 0) { //UPDATE
            //para el campo nombre_usuario se le pasa email_usuario (el email es usado para el login)
            $ruu = $uM->update_usuario($id_usuario, $email_usuario, $fecha_nacimiento, $nombrecompleto_usuario, $email_usuario, $contrasenya_usuario, $telf_usuario, $nie_usuario, 
                USER);
            if ($ruu) {
                header('Location: '.$ruta_inicio.'clientes.php?editar_usuario=true'); exit();
            } else $str_errores = '<div class="error_alert">Error actualizando usuario</div>';
            
        } else { //NUEVO
            //para el campo nombre_usuario se le pasa email_usuario (el email es usado para el login)
            $rau = $uM->add_usuario($email_usuario, $fecha_nacimiento, $nombrecompleto_usuario, $email_usuario, $contrasenya_usuario, $telf_usuario, $nie_usuario, USER);
            if ($rau) {
                header('Location: '.$ruta_inicio.'clientes.php?nuevo_usuario=true'); exit();
            } else $str_errores = '<div class="error_alert">Error añadiendo usuario</div>';
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
<div id="main_container">
    <?php include_once('inc/franja_top.inc.php'); ?>
    <section class="section_top mt-3"> <?php include_once('inc/acceso_top.inc.php'); ?> </section>
    <section>
            <div class="container mt-3">
                <?php if (isset($str_info)) echo $str_info; ?>
                <?php if (isset($str_errores)) echo '<div class="alert alert-danger" role="alert">'.$str_errores.'</div>'; ?>
            </div>
            <div class="form container mt-3">
                <form action="login.php" method="post" id="form_login" name="form_login" >
                    <?php 
                        echo $fM->get_input_hidden('id_usuario', $id_usuario);
                        echo $fM->get_input_text('nombrecompleto_usuario', 'Nombre completo', $nombrecompleto_usuario, $arr_err);
                        echo $fM->get_input_text('email_usuario', 'Email', $email_usuario, $arr_err);
                        echo $fM->get_input_date('fecha_nacimiento', 'Fecha de nacimiento', $fecha_nacimiento, $arr_err);
                        echo $fM->get_input_text('contrasenya_usuario', 'Contraseña', $contrasenya_usuario, $arr_err);
                        echo $fM->get_input_text('telf_usuario', 'Telefono', $telf_usuario, $arr_err);
                        echo $fM->get_input_text('nie_usuario', 'DNI / NIE', $nie_usuario, $arr_err);
                    ?>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
    </section>
</div>
</body>
</html>