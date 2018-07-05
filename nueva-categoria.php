<?php
include_once('config/config.inc.php'); //cargando archivo de configuracion
$uM = load_model('usuario');
$uM->control_sesion($ruta_inicio, ADMIN);

$hM = load_model('html');
$iM = load_model('inputs');
$catM = load_model('categorias');

$ttl = 'Nueva categoría';

//campos formulario
$id_categoria = 0;
$nombre_categoria = '';
$imagen_categoria = '';

$arr_err = array();
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
        
        //id_categoria
        $nombre_categoria = $catM->escstr($nombre_categoria);
        
        //upload de img
        
        if ($id_categoria > 0) { //UPDATE
            $ruc = $catM->update_categoria($id_categoria, $nombre_categoria, $imagen_categoria);
            if ($ruc) {
                header('Location: '.$ruta_inicio.'categorias.php?editar_categoria=true'); exit();
            } else $str_errores = $hM->get_alert_danger('Error actualizando categoría');
        } else { //NUEVO
            $rac = $catM->add_categoria($nombre_categoria, $imagen_categoria);
            if ($rac) {
                header('Location: '.$ruta_inicio.'categorias.php?nuevo_usuario=true'); exit();
            } else $str_errores = $hM->get_alert_danger('Error añadiendo categoría');
        }
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
                                <?php if (isset($str_errores)) echo '<div class="alert alert-danger" role="alert">'.$str_errores.'</div>'; ?>
                            </div>
                            <div class="layout-table-item">
                                <div class="layout-table-header">
                                    <h4>Nuevo cliente</h4>
                                </div>
                                <div class="layout-table-content">
                                    <form method="post">
                                    <?php 
                                        echo $iM->get_input_hidden('id_categoria', $id_categoria);
                                        echo $iM->get_input_text('nombre_categoria', $nombre_categoria, 'form-control', 'Nombre categoría', '', 'Campo requerido', 1);
                                        echo $iM->get_input_text('nombre_categoria', $nombre_categoria, 'form-control', 'Nombre categoría 5 10', '', 'Campo requerido', 5, 10);
                                        echo $iM->get_input_text('nombre_categoria', $nombre_categoria, 'form-control', 'Nombre categoría 5 10 true', '', 'Campo requerido', 5, 10, true);
                                    ?>
                                    <div class="form-group">
                                        <label>Imagen categoría</label>
                                        <div class="file-loading">
                                            <input id="file-es" name="file-es[]" type="file" multiple>
                                        </div>
                                    </div>
                                    <script>
                                        $('#file-es').fileinput({
                                            theme: 'fa',
                                            language: 'es',
                                            //uploadUrl: '#',
                                            showUpload: false,
                                            allowedFileExtensions: ['jpg', 'png', 'gif']
                                        });
                                    </script>
                                    
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