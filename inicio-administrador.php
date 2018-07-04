<?php
include_once('config/config.inc.php'); //cargando archivo de configuracion

$uM = load_model('usuario');
$uM->control_sesion($ruta_inicio, ADMIN);

include_once('inc/cabecera.inc.php'); //cargando cabecera 
?>
<script type="text/javascript">
    
</script>
<body>
<div id="main_container">
    <div id="responsive_back_content">
        <?php include_once('inc/franja_top.inc.php'); ?>
        <?php include_once('inc/main_menu.inc.php'); ?>
        <div id="responsive_seccion_back">
            <div id="ttl_seccion_back" style=" margin-top: 10%;">
<<<<<<< HEAD
                <h3>Inicio Administrador Re-MOD</h3>
=======
                <h3>Inicio Administrador</h3>
>>>>>>> f767c4ee0cd8f988a738b77d009679d75f7402a1
                <div style="clear:both;"></div>
            </div>
            
            <?php include_once('inc/main_menu.inc.php'); ?>
        </div>
    </div>
</div>
</body>
</html>