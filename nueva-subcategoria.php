<?php
include_once('config/config.inc.php'); //cargando archivo de configuracion
$uM = load_model('usuario');
$uM->control_sesion($ruta_inicio, ADMIN);

$hM = load_model('html');
$iM = load_model('inputs');
$catM = load_model('categorias');

$ttl = 'Nueva categoría';
$lbl_input_img = 'Imagen categoría';
$req_input_img = 'required';
//$aux_ruta_imagen_categoria = $catM->dir;

//campos formulario
$id_categoria = 0;
$nombre_categoria = '';

$verif = true;

$pcat = "";

//GET___________________________________________________________________________
if (isset($_GET['id_categoria'])) {
    $id_categoria = $_GET['id_categoria'];
    $rgc = $catM->get_subcategorias($id_categoria);
    if ($rgc) {
        while ($fgc = $rgc->fetch_assoc()) {
            $nombre_categoria = $fgc['nombre_subcategoria'];
        }
    } else $str_errores = $hM->get_alert_danger('Error cargando subcategoría');
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
        //$imagenOK = true;
        //id_categoria
        $nombre_categoria = $catM->escstr($nombre_categoria);
        $aux_fecha_hora = date('Ymd').'-'.date('Hms');
        
        if ($id_categoria > 0) { //UPDATE
            $ruc = $catM->update_subcategoria($id_categoria, $nombre_categoria);
            if ($ruc) {
            //$catM->clean_dir_imgcategorias($document_root);
                header('Location: '.$ruta_inicio.'categorias.php?editar_categoria=true'); exit();
            } else $str_errores = $hM->get_alert_danger('Error actualizando categoría');
            //} else $str_errores = $hM->get_alert_danger('Error actualizando categoría');
        }
    }
    //MySQL ----------------------------------------------------------------- */
}
//POST__________________________________________________________________________

//COMBOS________________________________________________________________________

//COMBOS________________________________________________________________________

if ($id_categoria > 0) {
    $ttl = 'Editar categoría';
    $lbl_input_img = 'Sustituir imagen';
    $req_input_img = '';
}

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
                                    <h4>
                                        <?php echo $ttl; ?>
                                    </h4>
                                </div>
                                <div class="layout-table-content">
                                    <form method="post" enctype="multipart/form-data">
                                        <?php 
                                        echo $iM->get_input_hidden('id_categoria', $id_categoria);
                                        echo $iM->get_input_text('nombre_categoria', $nombre_categoria, 'form-control', 'Nombre categoría', '', 'Campo requerido', 1);
                                        if($id_categoria==0){
                                            echo $pcat;
                                        }
                                        /* if ($id_categoria > 0) {
                                            echo '<div class="form-group">';
                                            echo '<div><label>Imagen actual</label><div>';
                                            echo '<div><img class="img-fluid img-thumbnail" src="'.$imagen_categoria[0].'" width="150" /></div>';
                                            echo '</div>';
                                        } */
                                        /* echo $iM->get_input_img('imagen_categoria', array(), $ruta_archivos, '', $lbl_input_img, $req_input_img); */
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