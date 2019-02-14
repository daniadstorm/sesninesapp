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
        $rau = $uM->add_usuario($nombre_usuario, $_SESSION['frmdatosfechanacimiento'], $_SESSION['frmdatosnombre'].' '.$_SESSION['frmdatosapellidos'], $_SESSION['frmdatosemail'], $contrasenya_usuario, null, null, USER);
        if($rau){
            $uM->login_usuario($nombre_usuario, $contrasenya_usuario);
            $raps = $uM->add_ps_reg($_SESSION['id_usuario'], $_SESSION['opcion'], $_SESSION['vestirdiadia'], $_SESSION['vestirsuperior'], $_SESSION['vestirinferior'], $_SESSION['colorarmario'], $_SESSION['colorfav'], $_SESSION['personaConocida'], $_SESSION['actividadOcio'], $_SESSION['profesion'], $_SESSION['hijos'], $_SESSION['frmdatosnombre'], $_SESSION['frmdatosapellidos'], $_SESSION['frmdatosfechanacimiento'], $_SESSION['frmdatosemail'], $_SESSION['silueta'], $_SESSION['tallasuperior'], $_SESSION['tallainferior'], $_SESSION['tallapecho'], $_SESSION['altura'], $_SESSION['cuerporealzar'], $_SESSION['cuerpodisimular'], $_SESSION['tonopiel'], $_SESSION['ojos'], $_SESSION['colorcabello'], $_SESSION['enviarfoto'], $_SESSION['listadoprendas'], $_SESSION['renovar'], $_SESSION['looksasesoria'], $_SESSION['otroasesoria'], $_SESSION['pedirps'], $_SESSION['pedirpsotros'], $_SESSION['pedirpsfuera'], $_SESSION['pedirpsfueraotros'], $_SESSION['tendencias']);
            if($raps){
                echo '2- Añadido con éxito';
                $uM->update_pscompleto($_SESSION['id_usuario'],1);
                header('Location: '.$ruta_inicio.'micuenta.php'); exit();
            }else{
                echo '2- Fallo al añadir<hr>';
                $uM->update_pscompleto($_SESSION['id_usuario'],0);
            }
        }else{
            $str_error = 'Error al crear el usuario';
        }
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
                <label class="mt-3">¿Aún no tienes cuenta en Sesnines? <strong><a class="text-dark" href="<?php echo $ruta_inicio; ?>altaps">Crea tu perfil ahora</a></strong></label>
                </div>
            </form>
        </div>
    </div>
</body>
</html>