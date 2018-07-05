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
    echo var_dump($_POST);
    //control de errores ---------------------------------------------------- */
    //control de errores ---------------------------------------------------- */
    
    //MySQL ----------------------------------------------------------------- */
    if ($verif == true) {
        
        //id_categoria
        $nombre_categoria = $catM->escstr($nombre_categoria);
        $imagen_categoria = false;
        
        var_dump($_FILES);
        //var_dump($_FILES['imagen_categoria']);
        
        //upload de img
        if (isset($_FILES['imagen_categoria'])) {
            echo 'LVL 1<BR>';
            $cantidad = count($_FILES['imagen_categoria']['tmp_name']);//Recibe un array de FILES que se hace poniendo el mismo name a todos los input[type="file"]
            for ($i=0;$i<$cantidad;$i++) {//Recorre el bucle
                if($_FILES['imagen_categoria']['name'][$i]!=""){ //Si está vacio es que no ha insertado ninguna imagen por lo tanto no hace las siguientes comprobaciones
                    echo 'LVL 2<BR>';
                    $imagenInfo = getimagesize($_FILES['imagen_categoria']['tmp_name'][$i]);//Saca el mime "type" pero que no se puede modificar
                    if ($imagenInfo['mime']=='image/png' || $imagenInfo['mime']=='image/jpeg') {//Si tiene una de las siguientes extensiones es que es imagen
                        $res = move_uploaded_file($_FILES['imagen_categoria']['tmp_name'][$i],$document_root.'imgcategorias/'.$_FILES['imagen_categoria']['name'][$i]);
                        if ($res) {
                            echo 'LVL 3<BR>';
                            //tenemos nombre valido
                            $imagen_categoria = $_FILES['imagen_categoria'];
                            /*
                            $rciu=$uM->clear_imgs_usuario($id_usuario);
                            if ($rciu) {
                                $result_img = $uM->add_imagen_usuario($id_usuario,$id_usuario.$_FILES['arraySiluetaImg']['name'][$i]);
                                if (!$result_img) {
                                    $str_errores = '<div class="error_alert">Error añadiendo el archivo</div>';
                                }
                            }
                            */
                        }
                    } else $str_errores = $hM->get_error_alert('El archivo no es de tipo imagen');           
                } else $str_errores = $hM->get_error_alert('Campo requerido');
            }
        } else $str_errores = $hM->get_error_alert('Campo requerido');
        
        if ($imagen_categoria) {
            
            if ($id_categoria > 0) { //UPDATE
                $ruc = $catM->update_categoria($id_categoria, $nombre_categoria, $imagen_categoria);
                if ($ruc) {
                    header('Location: '.$ruta_inicio.'categorias.php?editar_categoria=true'); exit();
                } else $str_errores = $hM->get_alert_danger('Error actualizando categoría');
            } else { //NUEVO
                $rac = $catM->add_categoria($nombre_categoria, $imagen_categoria);
                if ($rac) {
                    header('Location: '.$ruta_inicio.'categorias.php?nueva_categoria=true'); exit();
                } else $str_errores = $hM->get_alert_danger('Error añadiendo categoría');
            }
        } else $str_errores = $hM->get_alert_danger('Error cargando imagen');
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
                                    <h4>Nuevo cliente</h4>
                                </div>
                                <div class="layout-table-content">
                                    <form method="post" enctype="multipart/form-data">
                                    <?php 
                                        echo $iM->get_input_hidden('id_categoria', $id_categoria);
                                        echo $iM->get_input_text('nombre_categoria', $nombre_categoria, 'form-control', 'Nombre categoría', '', 'Campo requerido', 1);
                                    ?>
                                    <div class="form-group">
                                        <label>Imagen categoría</label>
                                        <div class="file-loading">
                                            <input required id="imagen_categoria" name="imagen_categoria[]" type="file" multiple>
                                        </div>
                                    </div>
                                    <script>
                                        $('#imagen_categoria').fileinput({
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