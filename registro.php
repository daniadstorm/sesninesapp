<?php
include_once('config/config.inc.php'); //cargando archivo de configuracion

$uM = load_model('usuario'); //uM userModel
$fM = load_model('form');
$iM = load_model('inputs');
$hM = load_model('html');

$nombre_usuario = '';
$contrasenya_usuario = '';

$str_error = '';

//GET___________________________________________________________________________

//GET___________________________________________________________________________

//POST__________________________________________________________________________
if (isset($_POST['nombre_usuario']) && isset($_POST['contrasenya_usuario']) && isset($_POST['contrasenya_usuario_conf'])) { //si viene de submit de login
    
    $nombre_usuario = $_POST['nombre_usuario'];
    $contrasenya_usuario = $_POST['contrasenya_usuario'];

    if($_POST['contrasenya_usuario']==$_POST['contrasenya_usuario_conf']){
        
    }else{
        $str_error = 'Las contraseñas no coinciden';
    }
    
}

//POST__________________________________________________________________________

//CONTROL_______________________________________________________________________
if (isset($_SESSION['id_tipo_usuario'])) { //si hay login
    header('Location: '.$ruta_inicio.'index.php');
    exit();
}
//CONTROL_______________________________________________________________________

echo '<pre>';
print_r($_SESSION);
echo '</pre>';


include_once('inc/cabecera.inc.php'); //cargando cabecera
?>
<script type="text/javascript"></script>
<body style="background-color: rgba(12,15,28,.02);">
    <div class="container">
        <div class="modallogin">
            <form action="" method="POST" class="frmlogin">
                <div class="header">
                    <h1 class="titulo">Registrate en Sesnines</h1>
                </div>
                <hr>
                <div class="body">
                    <?php echo ($str_error!='') ? $hM->get_alert_danger($str_error) : ''; ?>
                    <?php $nombre_usuario = (isset($_SESSION['frmdatosemail'])) ? $_SESSION['frmdatosemail'] : ''; ?>
                    <?php echo $iM->get_input_text('nombre_usuario', $nombre_usuario, 'form-control frmlogin', 'Email'); ?>
                    <?php echo $iM->get_input_text('contrasenya_usuario', '', 'form-control frmlogin', 'Contraseña'); ?>
                    <?php echo $iM->get_input_text('contrasenya_usuario_conf', '', 'form-control frmlogin', 'Confirmar Contraseña'); ?>
                </div>
                <div class="d-flex flex-column">
                <input type="submit" class="p-3 rounded border-0" value="Iniciar Sesión">
                <label class="mt-3">¿Aún no tienes cuenta en Lookiero? <strong><a class="text-dark" href="<?php echo $ruta_inicio; ?>altaps">Crea tu perfil ahora</a></strong></label>
                </div>
            </form>
        </div>
    </div>
</body>
</html>