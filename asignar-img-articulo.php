<?php
include_once('config/config.inc.php'); //cargando archivo de configuracion
$uM = load_model('usuario');
$uM->control_sesion($ruta_inicio, ADMIN);

$hM = load_model('html');
$iM = load_model('inputs');
$aM = load_model('articulos');

$ttl = 'Asignar imágenes artículo';

//campos formulario
$id_articulo = 0;

$verif = true;

//GET___________________________________________________________________________
if (isset($_GET['id_articulo'])) {
    
    $id_articulo = $_GET['id_articulo'];
    
}
//GET___________________________________________________________________________

//POST__________________________________________________________________________
if (isset($_POST['id_articulo'])) {
    
    $id_articulo = $_POST['id_articulo'];
    
    
    //control de errores ---------------------------------------------------- */
    //control de errores ---------------------------------------------------- */
    
    //MySQL ----------------------------------------------------------------- */
    if ($verif == true) {
        
        //id_articulo
        //imagenes
        
        //clear previo
        //actualizar (insertar)
        
        /*
        if ($id_articulo > 0) { //UPDATE
            $rua = $aM->update_articulo($id_articulo, $nombre_articulo, $referencia_articulo, $referencia_proveedor_articulo, $descripcion_articulo, $activado_articulo, 
                $visible_en_tienda_articulo, $precio_coste_articulo, $coste_externo_portes_articulo, $PVP_final_articulo, $margen_articulo, $inicio_descuento_articulo,
                $fin_descuento_articulo, $descuento_porcentaje_articulo, $descuento_euros_articulo, $cantidad_articulo, $almacen_articulo);
            //$rua = $aM->update_artciulo($id_articulo, $nombre_etiqueta);
            if ($rua) {
                header('Location: '.$ruta_inicio.'articulos.php?editar_articulo=true'); exit();
            } else $str_errores = $hM->get_alert_danger('Error actualizando artículo');
        } else { //NUEVO
            $raa = $aM->add_articulo($nombre_articulo, $referencia_articulo, $referencia_proveedor_articulo, $descripcion_articulo, $activado_articulo, $visible_en_tienda_articulo,
                $precio_coste_articulo, $coste_externo_portes_articulo, $PVP_final_articulo, $margen_articulo, $inicio_descuento_articulo, $fin_descuento_articulo,
                $descuento_porcentaje_articulo, $descuento_euros_articulo, $cantidad_articulo, $almacen_articulo);
            if ($raa) {
                header('Location: '.$ruta_inicio.'articulos.php?nuevo_articulo=true'); exit();
            } else $str_errores = $hM->get_alert_danger('Error añadiendo artículo');
        }
        */
    }
    //MySQL ----------------------------------------------------------------- */
}
//POST__________________________________________________________________________

//LISTADO_______________________________________________________________________
if ($id_articulo > 0) {
    $rga = $aM->get_articulo($id_articulo);
    if ($rga) {
        while ($fga = $rga->fetch_assoc()) {
            $nombre_articulo = $fga['nombre_articulo'];
            $referencia_articulo = $fga['referencia_articulo'];
            $descripcion_articulo = $fga['descripcion_articulo'];
        }
    } else $str_errores = $hM->get_alert_danger('Error cargando datos artículo');
} else $str_errores = $hM->get_alert_danger('No se ha encontrado el artículo');
//LISTADO_______________________________________________________________________

//COMBOS________________________________________________________________________

//COMBOS________________________________________________________________________

if ($id_articulo > 0) $ttl = 'Editar imágenes artículo';

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
                                    <div class="table-responsive-sm">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>Ref</th>
                                                    <th>Nombre artículo</th>
                                                    <th>Descripción artículo</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td><?php echo $referencia_articulo; ?></td>
                                                    <td><?php echo $nombre_articulo; ?></td>
                                                    <td><?php echo $descripcion_articulo; ?></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="layout-table-content">
                                    <form method="post" enctype="multipart/form-data">
                                    <?php 
                                        echo $iM->get_input_hidden('id_articulo', $id_articulo);
                                        echo $iM->get_input_img('imagenes_articulo', $imagen_categoria, $ruta_archivos, '', 'Imagen categoría');
                                        //input de imagenes a 5
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