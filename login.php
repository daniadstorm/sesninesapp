<?php
include_once('config/config.inc.php'); //cargando archivo de configuracion

$uM = load_model('usuario'); //uM userModel
$fM = load_model('form');
$iM = load_model('inputs');

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
            header('Location: '.$ruta_inicio.'micuenta.php');
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
<script type="text/javascript"></script>
<body style="background-color: rgba(12,15,28,.02);">
    <div class="container">
        <div class="modallogin">
            <a href="<?php echo $ruta_inicio; ?>altaps"><h1>Registrarme</h1></a>
            <form action="" method="POST" class="frmlogin">
                <div class="header">
                    <h1 class="titulo">Inicia sesión en Sesnines</h1>
                </div>
                <hr>
                <div class="body">
                    <?php echo $iM->get_input_text('nombre_usuario','','form-control frmlogin','Email'); ?>
                    <?php echo $iM->get_input_text('contrasenya_usuario','','form-control frmpassword','Contraseña'); ?>
                </div>
                <input type="submit" value="Login">
            </form>
        </div>
    </div>
</body>
</html>