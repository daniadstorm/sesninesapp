<?php
include_once('config/config.inc.php'); //cargando archivo de configuracion

$uM = load_model('usuario'); //uM userModel
$fM = load_model('form');

$nombre_usuario = '';
$contrasenya_usuario = '';

$arr_err = array();

//GET___________________________________________________________________________
if (isset($_GET['unlogin'])) {
    $uM->unlogin_usuario();
}
//GET___________________________________________________________________________

//POST__________________________________________________________________________
if (isset($_POST['nombre_usuario'])) { //si viene de submit de login
    
    $nombre_usuario = $_POST['nombre_usuario'];
    $contrasenya_usuario = $_POST['contrasenya_usuario'];
    
    $result_login = $uM->login_usuario($nombre_usuario, $contrasenya_usuario);
    
    if (strlen($result_login) > 1) {
        $str_errores = $result_login;
    }
}
//POST__________________________________________________________________________

//CONTROL_______________________________________________________________________
if (isset($_SESSION['id_tipo_usuario'])) { //si hay login
    switch ($_SESSION['id_tipo_usuario']) {
        default:
        case USER:
            header('Location: '.$ruta_inicio.'inicio.php');
            exit();
        break;
        case ADMIN:
            header('Location: '.$ruta_inicio.'inicio-administrador.php');
            exit();
        break;
    }
}
//CONTROL_______________________________________________________________________

include_once('inc/cabecera.inc.php'); //cargando cabecera
?>
<script type="text/javascript">
    
</script>
<body>
<div id="main_container">
    <?php include_once('inc/franja_top.inc.php'); ?>
    <?php //include_once('inc/main_menu.inc.php'); ?>
    <section class="section_top mt-3"> <?php include_once('inc/acceso_top.inc.php'); ?> </section>
    
    <section class="container">
            <div class="mt-3">
                <?php if (isset($str_info)) echo $str_info; ?>
                <?php if (isset($str_errores)) echo '<div class="alert alert-danger" role="alert">'.$str_errores.'</div>'; ?>
            </div>
            <div class="form mt-3">
                <form action="login.php" method="post" id="form_login" name="form_login" >
                    <?php 
                        echo $fM->get_input_text('nombre_usuario', 'Nombre de usuario', $nombre_usuario, $arr_err);
                        echo $fM->get_input_password('contrasenya_usuario', 'Contraseña', $contrasenya_usuario, $arr_err); 
                    ?>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                    <div class="form-group">
                        <div class="fb-login-button" scope="public_profile,email" onlogin="comprobarEstadologin();" data-max-rows="1" data-size="large" data-button-type="continue_with" data-show-faces="false" data-auto-logout-link="false" data-use-continue-as="true"></div>
                    </div>
                    <div class="campo">
                        <div id="status"></div>
                    </div>
                </form>
            </div>
    </section>
</div>
<?php //include_once('inc/footer.inc.php'); ?>
</body>
</html>