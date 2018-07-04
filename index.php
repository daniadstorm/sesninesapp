    <?php
include_once('config/config.inc.php'); //cargando archivo de configuracion

$uM = load_model('usuario'); //uM userModel
$hM = load_model('html');
$nombre_usuario = '';
$contrasenya_usuario = '';

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

include_once('inc/cabecera.inc.php'); //cargando cabecera
?>
<script type="text/javascript">
    
</script>
<body>
  <?php include_once('inc/franja_top.inc.php'); ?>
  <?php include_once('inc/main_menu.inc.php'); ?>
  
  <?php //include_once('inc/footer.inc.php'); ?>
  <main id="content" role="main">
    <div class="container">
      hola mundo
      <?php //echo $hM->get_slider($ruta_inicio); ?>
    </div>
  </main>
</body>
</html>