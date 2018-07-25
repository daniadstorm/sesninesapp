<?php
include_once('config/config.inc.php'); //cargando archivo de configuracion
$uM = load_model('usuario');
$uM->control_sesion($ruta_inicio, ADMIN);

$hM = load_model('html');
$iM = load_model('inputs');
$aM = load_model('articulos');
$exM = load_model('existencias');

$ttl = 'Asignar etiquetas artículo';

//campos formulario
$id_articulo = 0;
$id_existencia = 0;
$color_existencia = '';
$talla_existencia = '';
$cantidad_existencia = 0;

$ogex = '';
$oge = '';
$verif = true;

//GET___________________________________________________________________________
if (isset($_GET['id_articulo'])) $id_articulo = $_GET['id_articulo'];
if (isset($_GET['eliminar_existencia'])) {
    $eliminar_existencia = $_GET['eliminar_existencia'];
    $rdaex = $exM->delete_existencia($eliminar_existencia);
    if ($rdaex) {
        $str_info = $hM->get_alert_success('Existencia eliminada del artículo correctamente');
    } else $str_errores = $hM->get_alert_danger('Error eliminando existencia del artículo');
}
//GET___________________________________________________________________________

//POST__________________________________________________________________________
if (isset($_POST['id_articulo'])) {
    
    $id_articulo = $_POST['id_articulo'];
    $id_existencia = $_POST['id_existencia'];
    $color_existencia = $_POST['color_existencia'];
    $talla_existencia = $_POST['talla_existencia'];
    $cantidad_existencia = $_POST['cantidad_existencia'];
    
    //control de errores ---------------------------------------------------- */
    //verificar que la etiqueta no se encuentre ya asignada
        //el control lo hace mysql por key compuesta repetida
    //control de errores ---------------------------------------------------- */
    
    //MySQL ----------------------------------------------------------------- */
    if ($verif == true) {
        
        if ($id_existencia > 0) {
            
            $ruaex = $exM->update_existencia($id_existencia, $id_articulo, $color_existencia, $talla_existencia, $cantidad_existencia);
            if ($ruaex) {
                $str_info = $hM->get_alert_success('Existencia añadida al artículo correctamente');
            } else $str_errores = $hM->get_alert_danger('Error añadiendo existencia al artículo');
        } else {
            $raaex = $exM->add_existencia($id_articulo, $color_existencia, $talla_existencia, $cantidad_existencia);
            if ($raaex) {
                $str_info = $hM->get_alert_success('Existencia añadida al artículo correctamente');
            } else $str_errores = $hM->get_alert_danger('Error añadiendo existencia al artículo');
        }
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
/* --------------------------------------------------------------------------- */
    $rge = $exM->get_existencias_by_articulo($id_articulo);
    if ($rge) {
        while ($fge = $rge->fetch_assoc()) {
            $ogex .= '<tr>';
            $ogex .=     '<td>'.$fge['color_existencia'].'</td>';
            $ogex .=     '<td>'.$fge['talla_existencia'].'</td>';
            $ogex .=     '<td>'.$fge['cantidad_existencia'].'</td>';
            $ogex .=     '<td>';
            $ogex .=         '<a href="'.$ruta_inicio.'asignar-existencias-articulo.php?id_articulo='.$id_articulo.'&eliminar_existencia='.$fge['id_existencia'].'">';
            $ogex .=             '<button type="button" class="btn btn-outline-danger">Eliminar</button>';
            $ogex .=         '</a>';
            $ogex .=     '</td>';
            $ogex .= '</tr>';
        }
    } else $str_errores = $hM->get_alert_danger('Error cargando etiquetas artículo');
    
} else $str_errores = $hM->get_alert_danger('No se ha encontrado el artículo');
//LISTADO_______________________________________________________________________

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
                                        <h5>Datos artículo</h5>
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
                                <hr class="mt-0" />
                                <div class="ml-3 mr-3">
                                    <h5>Asignar existencias</h5>
                                    <div class="dropdown">
                                        <form method="post">
                                            <?php 
                                                echo $iM->get_input_hidden('id_articulo', $id_articulo);
                                                echo $iM->get_input_hidden('id_existencia', $id_existencia);
                                                echo $iM->get_input_text('color_existencia', $color_existencia, 'form-control', 'Color', '', 'Campo requerido', 1);
                                                echo $exM->get_select_tallas('talla_existencia', $talla_existencia, 'form-control', 'Talla');
                                                echo $iM->get_input_text('cantidad_existencia', $cantidad_existencia, 'form-control', 'Cantidad', '', 'Campo requerido', 1);
                                                
                                            ?>
                                            <button class="btn bg-primary text-light">Asignar existencia</button>
                                        </form>
                                    </div>
                                </div>
                                <hr />
                                <div class="layout-table-content">
                                    <div class="table-responsive-sm">
                                        <h5>Existencias asignadas</h5>
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>Color</th>
                                                    <th>Talla</th>
                                                    <th>Cantidad</th>
                                                    <th>Eliminar</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    echo $ogex;
                                                ?>
                                            </tbody>
                                        </table>
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