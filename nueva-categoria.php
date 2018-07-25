<?php
include_once('config/config.inc.php'); //cargando archivo de configuracion
$uM = load_model('usuario');
$uM->control_sesion($ruta_inicio, ADMIN);

$hM = load_model('html');
$iM = load_model('inputs');
$catM = load_model('categorias');

$ttl = 'Nueva categoría';
//$aux_ruta_imagen_categoria = $catM->dir;

//campos formulario
$id_categoria = 0;
$nombre_categoria = '';
$imagen_categoria = array();

$verif = true;

//GET___________________________________________________________________________
if (isset($_GET['id_categoria'])) {
    
    $id_categoria = $_GET['id_categoria'];
    
    $rgc = $catM->get_categoria($id_categoria);
    if ($rgc) {
        while ($fgc = $rgc->fetch_assoc()) {
            $nombre_categoria = $fgc['nombre_categoria'];
            $imagen_categoria = $fgc['imagen_categoria'];
        }
    } else $str_errores = $hM->get_alert_danger('Error cargando categoría');
}
//GET___________________________________________________________________________

//POST__________________________________________________________________________
if (isset($_POST['id_categoria'])) {
    
    $id_categoria = $_POST['id_categoria'];
    $nombre_categoria = $_POST['nombre_categoria'];
    //$imagen_categoria = $_POST['imagen_categoria'];
    
    //control de errores ---------------------------------------------------- */
    //control de errores ---------------------------------------------------- */
    
    //MySQL ----------------------------------------------------------------- */
    if ($verif == true) {
        $imagenOK = array();
        //id_categoria
        $nombre_categoria = $catM->escstr($nombre_categoria);
        $aux_fecha_hora = date('Ymd').'-'.date('Hms');
        
        //upload de img
        if (isset($_FILES['imagen_categoria'])) {
            $cantidad = count($_FILES['imagen_categoria']['tmp_name']); //Recibe un array de FILES que se hace poniendo el mismo name a todos los input[type="file"]
            for ($i=0;$i<$cantidad;$i++) { //Recorre el bucle
                if($_FILES['imagen_categoria']['name'][$i]!=""){ //Si está vacio es que no ha insertado ninguna imagen por lo tanto no hace las siguientes comprobaciones
                    $imagenInfo = getimagesize($_FILES['imagen_categoria']['tmp_name'][$i]); //Saca el mime "type" pero que no se puede modificar
                    if ($imagenInfo['mime']=='image/png' || $imagenInfo['mime']=='image/jpeg') { //Si tiene una de las siguientes extensiones es que es imagen
                        $res = move_uploaded_file($_FILES['imagen_categoria']['tmp_name'][$i],$document_root.$catM->dir.$aux_fecha_hora.$_FILES['imagen_categoria']['name'][$i]);
                        if ($res) {
                            $imagen_categoria = $catM->dir.$aux_fecha_hora.$_FILES['imagen_categoria']['name'][$i];
                            if ($imagen_categoria) {
                                if ($id_categoria > 0) { //UPDATE
                                    $ruc = $catM->update_categoria($id_categoria, $nombre_categoria, $imagen_categoria);
                                    if ($ruc) {
                                        $catM->clean_dir_imgcategorias($document_root);
                                        header('Location: '.$ruta_inicio.'categorias.php?editar_categoria=true'); exit();
                                    } else $str_errores = $hM->get_alert_danger('Error actualizando categoría');
                                } else { //NUEVO
                                    $imagenOK = $catM->add_categoria($nombre_categoria, $imagen_categoria);
                                    /* if ($rac) {
                                        header('Location: '.$ruta_inicio.'categorias.php?nueva_categoria=true'); exit();
                                    } else $str_errores = $hM->get_alert_danger('Error añadiendo categoría'); */
                                }
                            } else $str_errores = $hM->get_alert_danger('Error cargando imagen');
                        }
                    } else $str_errores = $hM->get_alert_danger('El archivo no es de tipo imagen');           
                } else $str_errores = $hM->get_alert_danger('Campo requerido');
            }
            if($imagenOK){
                header('Location: '.$ruta_inicio.'categorias.php?nueva_categoria=true'); exit();
            } else $str_errores = $hM->get_alert_danger('Error añadiendo categoría');
        } else $str_errores = $hM->get_alert_danger('Campo requerido');
    }
    //MySQL ----------------------------------------------------------------- */
}
//POST__________________________________________________________________________

//COMBOS________________________________________________________________________

//COMBOS________________________________________________________________________

if ($id_categoria > 0) $ttl = 'Editar categoría';

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
                                        echo $iM->get_input_hidden('id_categoria', $id_categoria);
                                        echo $iM->get_input_text('nombre_categoria', $nombre_categoria, 'form-control', 'Nombre categoría', '', 'Campo requerido', 1);
                                        echo $iM->get_input_img('imagen_categoria', $imagen_categoria, $ruta_archivos, '', 'Imagen categoría', 'required', false);
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