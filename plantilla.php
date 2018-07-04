<?php
include_once('config/config.inc.php'); //cargando archivo de configuracion
//$uM->control_sesion($ruta_inicio, ADMIN);

$fM = load_model('form');
$uM = load_model('usuario'); //uM userModel
$pM = load_model('pedido');

//GET___________________________________________________________________________
//GET___________________________________________________________________________

//POST__________________________________________________________________________
//POST__________________________________________________________________________

//CONTROL_______________________________________________________________________
//CONTROL_______________________________________________________________________

include_once('inc/cabecera.inc.php'); //cargando cabecera
?>

<body>
<div id="main_container">
    <?php //include_once('inc/franja_top.inc.php'); ?>
    <?php //include_once('inc/main_menu.inc.php'); ?>
    <section class="section_top"></section>
    <section class="sep_section"></section>
    <section class="middle_section">
        <div class="responsive_seccion">
            <div id="filtros_seccion">
                <?php if (isset($str_info)) echo $str_info; ?>
                <?php if (isset($str_errores)) echo $str_errores; ?>
            </div>
            <div id="filtros_seccion"></div>
        </div>
    </section>
</div>
</body>
</html>