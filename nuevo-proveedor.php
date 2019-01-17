<?php
include_once('config/config.inc.php'); //cargando archivo de configuracion
$uM = load_model('usuario');
$uM->control_sesion($ruta_inicio, ADMIN);

$hM = load_model('html');
$iM = load_model('inputs');
$eM = load_model('proveedores');

$ttl = 'Nueva proveedor';
//$aux_ruta_imagen_categoria = $catM->dir;

//campos formulario
$id_proveedor = 0;
$nombre_proveedor = '';
$referencia_proveedor = '';

$verif = true;

//GET___________________________________________________________________________
if (isset($_GET['id_proveedor'])) {
    
    $id_proveedor = $_GET['id_proveedor'];
    
    $rge = $eM->get_proveedor($id_proveedor);
    if ($rge) {
        while ($fge = $rge->fetch_assoc()) {
            $nombre_proveedor = $fge['nombre_proveedor'];
            $referencia_proveedor = $fge['referencia_proveedor'];
        }
    } else $str_errores = $hM->get_alert_danger('Error cargando proveedor');
}
//GET___________________________________________________________________________

//POST__________________________________________________________________________
if (isset($_POST['id_proveedor'])) {
    
    $id_proveedor = $_POST['id_proveedor'];
    $nombre_proveedor = $_POST['nombre_proveedor'];
    $referencia_proveedor = $_POST['referencia_proveedor'];
    
    //control de errores ---------------------------------------------------- */
    //control de errores ---------------------------------------------------- */
    
    //MySQL ----------------------------------------------------------------- */
    if ($verif == true) {
        
        //id_proveedor
        $nombre_proveedor = $eM->escstr($nombre_proveedor);
            
        if ($id_proveedor > 0) { //UPDATE
            $rue = $eM->update_proveedor($id_proveedor, $nombre_proveedor, $referencia_proveedor);
            if ($rue) {
                header('Location: '.$ruta_inicio.'proveedores.php?editar_proveedor=true'); exit();
            } else $str_errores = $hM->get_alert_danger('Error actualizando categoría');
        } else { //NUEVO
            $rae = $eM->add_proveedor($nombre_proveedor, $referencia_proveedor);
            if ($rae) {
                header('Location: '.$ruta_inicio.'proveedores.php?nueva_proveedor=true'); exit();
            } else $str_errores = $hM->get_alert_danger('Error añadiendo proveedor');
        }
    }
    //MySQL ----------------------------------------------------------------- */
}
//POST__________________________________________________________________________

//COMBOS________________________________________________________________________

//COMBOS________________________________________________________________________

if ($id_proveedor > 0) $ttl = 'Editar proveedor';

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
                                <?php if (isset($str_errores)) echo $str_errores; ?>
                            </div>
                            <div class="layout-table-item">
                                <div class="layout-table-header">
                                    <h4><?php echo $ttl; ?></h4>
                                </div>
                                <div class="layout-table-content">
                                    <form method="post" enctype="multipart/form-data">
                                    <?php 
                                        echo $iM->get_input_hidden('id_proveedor', $id_proveedor);
                                        echo $iM->get_input_text('nombre_proveedor', $nombre_proveedor, 'form-control', 'Nombre proveedor', '', 'Campo requerido', 1);
                                        echo $iM->get_input_text('referencia_proveedor', $referencia_proveedor, 'form-control', 'Referencia proveedor', '', 'Campo requerido', 1);
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
    </div>
</body>
</html>