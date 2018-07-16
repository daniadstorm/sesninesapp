<?php
include_once('config/config.inc.php'); //cargando archivo de configuracion
$uM = load_model('usuario');
$uM->control_sesion($ruta_inicio, ADMIN);

$hM = load_model('html');
$iM = load_model('inputs');
$aM = load_model('articulos');
$exM = load_model('existencias');
$eM = load_model('etiquetas');

$id_articulo = 0;

$ttl = 'Ver artículo';
$oga = ''; //output get articulo
$ogex = ''; //output get existencias
$ogia = ''; //output get imagenes articulo
$oge = ''; //output get etiquetas

/*
$nombre_articulo = '';
$referencia_articulo = '';
$referencia_proveedor_articulo = '';
$descripcion_articulo = '';
$activado_articulo = '';
    $arr_opt_activado_articulo = array(1 => 'SÍ', 0 => 'NO');
$visible_en_tienda_articulo = '';
    $arr_opt_visible_en_tienda_articulo = array(1 => 'SÍ', 0 => 'NO');
$precio_coste_articulo = 0;
$coste_externo_portes_articulo = 0;
$PVP_final_articulo = 0;
$margen_articulo = 0;
$cantidad_articulo = '';
$inicio_descuento_articulo = '';
$fin_descuento_articulo = '';
$descuento_porcentaje_articulo = '';
$descuento_euros_articulo  = '';
$almacen_articulo = '';
*/

//GET___________________________________________________________________________
if (isset($_GET['id_articulo'])) {
    
    $id_articulo = $_GET['id_articulo'];
    
    /* datos base articulo --------------------------------------------------- */
    $rga = $aM->get_articulo($id_articulo);
    if ($rga) {
        while ($fga = $rga->fetch_assoc()) {
            $oga .= '<div><span class="mr-2">Nombre</span><span class="font-weight-bold">'.$fga['nombre_articulo'].'</span></div>';
            $oga .= '<div><span class="mr-2">Referencia</span><span class="font-weight-bold">'.$fga['referencia_articulo'].'</span></div>';
            
            $oga .= '<div><span class="mr-2">Referencia proveedor</span><span class="font-weight-bold">'.$fga['referencia_proveedor_articulo'].'</span></div>';
            $oga .= '<div><span class="mr-2">Descripción</span><span class="font-weight-bold">'.$fga['descripcion_articulo'].'</span></div>';
            $oga .= '<div><span class="mr-2">Activado</span><span class="font-weight-bold">'.($fga['activado_articulo'] == 1 ? 'Sí':'No').'</span></div>';
            $oga .= '<div><span class="mr-2">Visible en tienda</span><span class="font-weight-bold">'.($fga['visible_en_tienda_articulo'] == 1 ? 'Sí':'No').'</span></div>';
            $oga .= '<div><span class="mr-2">Precio de coste</span><span class="font-weight-bold">'.$fga['precio_coste_articulo'].' €</span></div>';
            $oga .= '<div><span class="mr-2">Coste externo portes</span><span class="font-weight-bold">'.$fga['coste_externo_portes_articulo'].' €</span></div>';
            $oga .= '<div><span class="mr-2">PVP</span><span class="font-weight-bold">'.$fga['PVP_final_articulo'].' €</span></div>';
            $oga .= '<div><span class="mr-2">Margen</span><span class="font-weight-bold">'.$fga['margen_articulo'].' €</span></div>';
            $oga .= '<div><span class="mr-2">Cantidad</span><span class="font-weight-bold">'.$fga['cantidad_articulo'].'</span></div>';
            $oga .= '<div><span class="mr-2">Inicio descuento</span><span class="font-weight-bold">'.$aM->mysql_datetime_to_date($fga['inicio_descuento_articulo']).'</span></div>';
            $oga .= '<div><span class="mr-2">Nombre</span><span class="font-weight-bold">'.$aM->mysql_datetime_to_date($fga['fin_descuento_articulo']).'</span></div>';
            
            $oga .= '<div><span class="mr-2">Descuento porcentaje</span><span class="font-weight-bold">'.$fga['descuento_porcentaje_articulo'].' %</span></div>';
            $oga .= '<div><span class="mr-2">Descuento euros</span><span class="font-weight-bold">'.$fga['descuento_euros_articulo'].' €</span></div>';
            $oga .= '<div><span class="mr-2">Almacén</span><span class="font-weight-bold">'.$fga['almacen_articulo'].'</span></div>';
            
            /*
            $nombre_articulo = $fga['nombre_articulo'];
            $referencia_articulo = $fga['referencia_articulo'];
            $referencia_proveedor_articulo = $fga['referencia_proveedor_articulo'];
            $descripcion_articulo = $fga['descripcion_articulo'];
            $activado_articulo = $fga['activado_articulo'];
            $visible_en_tienda_articulo = $fga['visible_en_tienda_articulo'];
            $precio_coste_articulo = $fga['precio_coste_articulo'];
            $coste_externo_portes_articulo = $fga['coste_externo_portes_articulo'];
            $PVP_final_articulo = $fga['PVP_final_articulo'];
            $margen_articulo = $fga['margen_articulo'];
            $cantidad_articulo = $fga['cantidad_articulo'];
            $inicio_descuento_articulo = $fga['inicio_descuento_articulo'];
            $fin_descuento_articulo = $fga['fin_descuento_articulo'];
            $descuento_porcentaje_articulo = $fga['descuento_porcentaje_articulo'];
            $descuento_euros_articulo = $fga['descuento_euros_articulo'];
            $almacen_articulo = $fga['almacen_articulo'];
            */
        }
    } else $str_errores = $hM->get_alert_danger('Error cargando artículo');
    /* datos base articulo --------------------------------------------------- */
    
    /* existencias articulo -------------------------------------------------- */
    $rge = $exM->get_existencias_by_articulo($id_articulo);
    if ($rge) {
        $ogex .= '<tr>';
        while ($fge = $rge->fetch_assoc()) {
            
            $ogex .= '<label class="mr-1">'.$fge['color_existencia'].',</label>';
            $ogex .= '<label class="mr-1">'.$fge['talla_existencia'].',</label>';
            $ogex .= '<label class="mr-2">'.$fge['cantidad_existencia'].' uds.</label>';
            $ogex .= '<br>';
            
        }
        $ogex .= '</tr>';
    } else $str_errores = $hM->get_alert_danger('Error cargando etiquetas artículo');
    /* existencias articulo -------------------------------------------------- */
    
    /* imagenes articulo ----------------------------------------------------- */
    $rgia = $aM->get_imagenes_by_articulo($id_articulo);
    if ($rgia) {
        $ogia .= '<tr>';
        while ($fgia = $rgia->fetch_assoc()) {
            
            $ogia .= '<td>';
            
            $ogia .=    '<img class="img-fluid img-thumbnail mr-2" src="'.$fgia['ruta_imagen'].'" width="120" />';
            //$ogia .= '<div>'.substr($fgia['ruta_imagen'], strpos($fgia['ruta_imagen'], '/')+1, strlen($fgia['ruta_imagen'])).'</div>';
            
            //$ogia .= '<td><img class="img-fluid img-thumbnail" src="'.$fgia['ruta_imagen'].'" width="100" /></td>';
            //$ogia .= '<td>'.substr($fgia['ruta_imagen'], strpos($fgia['ruta_imagen'], '/')+1, strlen($fgia['ruta_imagen'])).'</td>';
            
            $ogia .= '</td>';
        }
        $ogia .= '</tr>';
    } else $str_errores = $hM->get_alert_danger('Error cargando etiquetas artículo');
    /* imagenes articulo ----------------------------------------------------- */
    
    /* etiquetas articulo ---------------------------------------------------- */
    $rge = $eM->get_etiquetas_by_articulo($id_articulo);
    if ($rge) {
        $oge .= '<tr>';
        while ($fge = $rge->fetch_assoc()) {
            $oge .= '<label class="mr-2">'.$fge['nombre_etiqueta'].'</label>';
        }
        $oge .= '</tr>';
    } else $str_errores = $hM->get_alert_danger('Error cargando etiquetas artículo');
    /* etiquetas articulo ---------------------------------------------------- */
}
//GET___________________________________________________________________________

//POST__________________________________________________________________________
//POST__________________________________________________________________________

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
                                    <h5>Datos artículo</h5>
                                    <div class="dropdown">
                                        <?php echo $oga; ?>
                                    </div>
                                    <hr />
                                    <h5>Existencias artículo</h5>
                                    <div class="dropdown">
                                        <?php echo $ogex; ?>
                                    </div>
                                    <hr />
                                    <h5>Imágenes artículo</h5>
                                    <div class="dropdown">
                                        <?php echo $ogia; ?>
                                    </div>
                                    <hr />
                                    <h5>Etiquetas artículo</h5>
                                    <div class="dropdown">
                                        <?php echo $oge; ?>
                                    </div>
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