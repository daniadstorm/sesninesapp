<?php
include_once('config/config.inc.php'); //cargando archivo de configuracion
$uM = load_model('usuario');
$uM->control_sesion($ruta_inicio, ADMIN);

$hM = load_model('html');
$iM = load_model('inputs');
$aM = load_model('articulos');
$eM = load_model('etiquetas');

$ttl = 'Asignar etiquetas artículo';

//campos formulario
$id_articulo = 0;
$asignar_existencia = 0;
$asignar_etiqueta = '';

$ogex = '';
$oge = '';
$verif = true;

//GET___________________________________________________________________________
if (isset($_GET['id_articulo'])) $id_articulo = $_GET['id_articulo'];
if (isset($_GET['eliminar_existencia'])) {
    $eliminar_existencia = $_GET['eliminar_existencia'];
    $rdaex = $aM->delete_articulo_existencia($id_articulo, $eliminar_existencia);
    if ($rdaex) {
        $str_info = $hM->get_alert_success('Existencia eliminada del artículo correctamente');
    } else $str_errores = $hM->get_alert_danger('Error eliminando existencia del artículo');
}
//GET___________________________________________________________________________

//POST__________________________________________________________________________
if (isset($_POST['id_articulo'])) {
    
    $id_articulo = $_POST['id_articulo'];
    $asignar_etiqueta = $_POST['asignar_etiqueta'];
    
    //control de errores ---------------------------------------------------- */
    //verificar que la etiqueta no se encuentre ya asignada
        //el control lo hace mysql por key compuesta repetida
    //control de errores ---------------------------------------------------- */
    
    //MySQL ----------------------------------------------------------------- */
    if ($verif == true) {
        
        $raae = $aM->add_articulo_etiquetas($id_articulo, $asignar_etiqueta);
        if ($raae) {
            $str_info = $hM->get_alert_success('Etiqueta añadida al artículo correctamente');
        } else $str_errores = $hM->get_alert_danger('Error añadiendo etiqueta al artículo');
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
    $rge = $eM->get_etiquetas_by_articulo($id_articulo);
    if ($rge) {
        while ($fge = $rge->fetch_assoc()) {
            $oge .= '<tr>';
            $oge .=     '<td>'.$fge['nombre_etiqueta'].'</td>';
            $oge .=     '<td>';
            $oge .=         '<a href="'.$ruta_inicio.'asignar-etiquetas-articulo.php?id_articulo='.$id_articulo.'&eliminar_etiqueta='.$fge['id_etiqueta'].'">';
            $oge .=             '<button type="button" class="btn btn-outline-danger">Eliminar</button>';
            $oge .=         '</a>';
            $oge .=     '</td>';
            $oge .= '</tr>';
        }
    } else $str_errores = $hM->get_alert_danger('Error cargando etiquetas artículo');
    
} else $str_errores = $hM->get_alert_danger('No se ha encontrado el artículo');
//LISTADO_______________________________________________________________________

//COMBOS________________________________________________________________________
//$sl_etiquetas = $iM->get_select_etiquetas($id, $val, $class=false, $lbl=false, $onChange=false);
//COMBOS________________________________________________________________________

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
                                    <h5>Asignar etiquetas</h5>
                                    <div class="dropdown">
                                        <form method="post">
                                            <?php 
                                                echo $iM->get_input_hidden('id_articulo', $id_articulo);
                                                echo $eM->get_select_etiquetas('asignar_etiqueta', $asignar_etiqueta, 'form-control', 'Etiquetas diponibles'); 
                                            ?>
                                            <button class="btn bg-primary text-light">Asignar etiqueta</button>
                                        </form>
                                    </div>
                                </div>
                                <hr />
                                <div class="layout-table-content">
                                    <div class="table-responsive-sm">
                                        <h5>Etiquetas asignadas</h5>
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>Etiqueta</th>
                                                    <th>Eliminar asignación</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    echo $oge;
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