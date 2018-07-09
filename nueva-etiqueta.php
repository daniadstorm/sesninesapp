<?php
include_once('config/config.inc.php'); //cargando archivo de configuracion
$uM = load_model('usuario');
$uM->control_sesion($ruta_inicio, ADMIN);

$hM = load_model('html');
$iM = load_model('inputs');
$eM = load_model('etiquetas');

$ttl = 'Nueva etiqueta';
//$aux_ruta_imagen_categoria = $catM->dir;

//campos formulario
$id_etiqueta = 0;
$nombre_etiqueta = '';

$verif = true;

//GET___________________________________________________________________________
if (isset($_GET['id_etiqueta'])) {
    
    $id_etiqueta = $_GET['id_etiqueta'];
    
    $rge = $eM->get_etiqueta($id_etiqueta);
    if ($rge) {
        while ($fge = $rge->fetch_assoc()) {
            $nombre_etiqueta = $fge['nombre_etiqueta'];
        }
    } else $str_errores = $hM->get_alert_danger('Error cargando etiqueta');
}
//GET___________________________________________________________________________

//POST__________________________________________________________________________
if (isset($_POST['id_etiqueta'])) {
    
    $id_etiqueta = $_POST['id_etiqueta'];
    $nombre_etiqueta = $_POST['nombre_etiqueta'];
    
    //control de errores ---------------------------------------------------- */
    //control de errores ---------------------------------------------------- */
    
    //MySQL ----------------------------------------------------------------- */
    if ($verif == true) {
        
        //id_etiqueta
        $nombre_etiqueta = $eM->escstr($nombre_etiqueta);
            
        if ($id_etiqueta > 0) { //UPDATE
            $rue = $eM->update_etiqueta($id_etiqueta, $nombre_etiqueta);
            if ($rue) {
                header('Location: '.$ruta_inicio.'etiquetas.php?editar_etiqueta=true'); exit();
            } else $str_errores = $hM->get_alert_danger('Error actualizando categoría');
        } else { //NUEVO
            $rae = $eM->add_etiqueta($nombre_etiqueta);
            if ($rae) {
                header('Location: '.$ruta_inicio.'etiquetas.php?nueva_etiqueta=true'); exit();
            } else $str_errores = $hM->get_alert_danger('Error añadiendo etiqueta');
        }
    }
    //MySQL ----------------------------------------------------------------- */
}
//POST__________________________________________________________________________

//COMBOS________________________________________________________________________

//COMBOS________________________________________________________________________

if ($id_etiqueta > 0) $ttl = 'Editar etiqueta';

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
                                        echo $iM->get_input_hidden('id_etiqueta', $id_etiqueta);
                                        echo $iM->get_input_text('nombre_etiqueta', $nombre_etiqueta, 'form-control', 'Nombre etiqueta', '', 'Campo requerido', 1);
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