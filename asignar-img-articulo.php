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
$ogia = ''; //output get imagenes articulo

$verif = true;

//GET___________________________________________________________________________
if (isset($_GET['id_articulo'])) $id_articulo = $_GET['id_articulo'];
if (isset($_GET['eliminar_imagen'])) {
    $eliminar_imagen = $_GET['eliminar_imagen'];
    $rdai = $aM->delete_articulo_imagen($id_articulo, $eliminar_imagen);
    if ($rdai) {
        $str_info = $hM->get_alert_success('Imagen eliminada del artículo correctamente');
        $aM->clean_dir_imgart($document_root); //limpiar directorio
    } else $str_errores = $hM->get_alert_danger('Error eliminando imagen del artículo');
}
//GET___________________________________________________________________________

//POST__________________________________________________________________________
if (isset($_POST['id_articulo'])) {
    
    $id_articulo = $_POST['id_articulo'];
    
    //control de errores ---------------------------------------------------- */
    //obtener cantidad de imágenes que hay actualmente
    $total_imagenes_asignadas = $aM->get_total_imagenes_articulo($id_articulo);
    if ($total_imagenes_asignadas >= $aM->max_imagenes_articulo) {
        $verif = false;
        $str_errores = $hM->get_alert_danger('Máximo de '.$aM->max_imagenes_articulo.' imágenes por artículo');
    }
    //control de errores ---------------------------------------------------- */
    
    //MySQL ----------------------------------------------------------------- */
    if ($verif == true) {
        $imagenOK = array();
        //id_categoria
        //$nombre_categoria = $aM->escstr($nombre_categoria);
        $aux_fecha_hora = date('Ymd').'-'.date('Hms');
        
        //limpiar registros
        //$rcai = $aM->clear_articulo_img($id_articulo);
        
        //upload de img
        if (isset($_FILES['imagenes_articulo'])) {
            $cantidad = count($_FILES['imagenes_articulo']['tmp_name']); //Recibe un array de FILES que se hace poniendo el mismo name a todos los input[type="file"]
            for ($i=0;$i<$cantidad;$i++) { //Recorre el bucle
                if($_FILES['imagenes_articulo']['name'][$i]!=""){ //Si está vacio es que no ha insertado ninguna imagen por lo tanto no hace las siguientes comprobaciones
                    $imagenInfo = getimagesize($_FILES['imagenes_articulo']['tmp_name'][$i]); //Saca el mime "type" pero que no se puede modificar
                    if ($imagenInfo['mime']=='image/png' || $imagenInfo['mime']=='image/jpeg') { //Si tiene una de las siguientes extensiones es que es imagen
                        $res = move_uploaded_file($_FILES['imagenes_articulo']['tmp_name'][$i],$document_root.$aM->dir.$aux_fecha_hora.$_FILES['imagenes_articulo']['name'][$i]);
                        if ($res) {
                            
                            $ruta_imagen_articulo = $aM->dir.$aux_fecha_hora.$_FILES['imagenes_articulo']['name'][$i];
                            
                            //añadir registro
                            $raai = $aM->add_articulo_img($id_articulo, $ruta_imagen_articulo);
                            
                            if($raai) {
                                $str_info = $hM->get_alert_success('Imagen enlazada al artículo correctamente');
                            } else $str_errores = $hM->get_alert_danger('Error enlazando imagen al artículo');
                            
                            //en principio solo requerido al eliminar?
                            //analizar cuando puede ser requerido...
                            //$aM->clean_dir_imgart($document_root);
                        }
                    } else $str_errores = $hM->get_alert_danger('El archivo no es de tipo imagen');           
                } else $str_errores = $hM->get_alert_danger('Campo requerido');
            }
        } else $str_errores = $hM->get_alert_danger('Campo requerido');
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
    $rgia = $aM->get_imagenes_by_articulo($id_articulo);
    if ($rgia) {
        while ($fgia = $rgia->fetch_assoc()) {
            $ogia .= '<tr>';
            $ogia .=     '<td><img class="img-fluid img-thumbnail" src="'.$fgia['ruta_imagen'].'" width="100" /></td>';
            $ogia .=     '<td>'.substr($fgia['ruta_imagen'], strpos($fgia['ruta_imagen'], '/')+1, strlen($fgia['ruta_imagen'])).'</td>';
            $ogia .=     '<td>';
            $ogia .=         '<a href="'.$ruta_inicio.'asignar-img-articulo.php?id_articulo='.$id_articulo.'&eliminar_imagen='.$fgia['id_imagen'].'">';
            $ogia .=             '<button type="button" class="btn btn-outline-danger">Eliminar</button>';
            $ogia .=         '</a>';
            $ogia .=     '</td>';
            $ogia .= '</tr>';
        }
    } else $str_errores = $hM->get_alert_danger('Error cargando etiquetas artículo');
    
} else $str_errores = $hM->get_alert_danger('No se ha encontrado el artículo');
//LISTADO_______________________________________________________________________

//COMBOS________________________________________________________________________

//COMBOS________________________________________________________________________

//if ($id_articulo > 0) $ttl = 'Editar imágenes artículo';

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
                                <div class="layout-table-content">
                                    <h5>Asignar imágenes</h5>
                                    <form method="post" enctype="multipart/form-data">
                                    <?php 
                                        echo $iM->get_input_hidden('id_articulo', $id_articulo);
                                        echo $iM->get_input_img('imagenes_articulo', array(), $ruta_archivos, '', 'Asignar imagen al artículo', 'required');
                                        //input de imagenes a 5
                                    ?>                                    
                                    <button class="btn bg-primary text-light">Aceptar</button>
                                    </form>
                                </div>
                                <hr />
                                <div class="layout-table-content">
                                    <div class="table-responsive-sm">
                                        <h5>Imagenes asignadas</h5>
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>Imagen</th>
                                                    <th>Nombre Imagen</th>
                                                    <th>Eliminar Imagen</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    echo $ogia;
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