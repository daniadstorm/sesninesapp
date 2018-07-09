<?php
include_once('config/config.inc.php'); //cargando archivo de configuracion
$uM = load_model('usuario');
$uM->control_sesion($ruta_inicio, ADMIN);

$str_errores = '';
$str_estado = '';
$id_archivo = 'archivo_csv';
$ff = load_model('file');
$fM = load_model('form');
$aM = load_model('articulos');
//$tvfM = load_model('tiendasvf');


$id_articulo = 0;
$nombre_articulo = '';
$referencia_articulo = '';
$referencia_proveedor_articulo = '';
$descripcion_articulo = '';
$etiquetas_articulo = '';
$activado_articulo = '';
$visible_en_tienda_articulo = '';
$precio_coste_articulo = 0;
$coste_externo_portes_articulo = 0;
$PVP_final_articulo = 0;
$margen_articulo = 0;
$cantidad_articulo = 0;
$almacen_articulo = 0;

//variables fecha
$inicio_descuento_articulo = '';
$fin_descuento_articulo = '';
//variables del descuento
$descuento_porcentaje_articulo = '';
$descuento_euros_articulo = '';
//valor del checkbox
$checkbox_porcentaje = 0;
$checkbox_euros = 0;
//input checkbox
$checked_porcentaje = false;
$checked_euros = false;

$arr_err = array();
$verif = true;
$titulo = 'Nuevo artículo';

//extensión archivo
$ext = '';
$verifoto = '';
$exten = array(1, 2, 3, 4, 5);
$img = array('', '', '', '', '');

$rw = ''; //row imagenes
//GET___________________________________________________________________________
if (isset($_GET['id_articulo'])) {

    if (isset($_GET['id_img'])) {
        $id_img = $_GET['id_img'];
        $aM->delete_articulo_img($id_img);
    }
}
//GET___________________________________________________________________________
//CONTROL______________________________________________________________________
//CONTROL______________________________________________________________________
//POST__________________________________________________________________________
if (isset($_POST['id_articulo'])) {

    $titulo = 'Actualizar artículo';
    $id_usuario = $_SESSION['id_usuario'];
    $id_articulo = $_POST['id_articulo'];

    $nombre_articulo = $_POST['nombre_articulo'];
    $referencia_articulo = $_POST['referencia_articulo'];
    $referencia_proveedor_articulo = $_POST['referencia_proveedor_articulo'];
    $descripcion_articulo = $_POST['descripcion_articulo'];
    $etiquetas_articulo = isset($_POST['etiquetas_articulo']) ? $_POST['etiquetas_articulo'] : "";
    $activado_articulo = isset($_POST['activado_articulo']) ? $_POST['activado_articulo'] : "";
    $visible_en_tienda_articulo = isset($_POST['visible_en_tienda_articulo']) ? $_POST['visible_en_tienda_articulo'] : "";
    $precio_coste_articulo = $_POST['precio_coste_articulo'];
    $coste_externo_portes_articulo = $_POST['coste_externo_portes_articulo'];
    $PVP_final_articulo = $_POST['PVP_final_articulo'];
    $margen_articulo = $_POST['margen_articulo'];
    $cantidad_articulo = $_POST['cantidad_articulo'];
    $inicio_descuento_articulo = $_POST['inicio_descuento_articulo'];
    $fin_descuento_articulo = isset($_POST['fin_descuento_articulo']) ? $_POST['fin_descuento_articulo'] : "";
    $descuento_porcentaje_articulo = $_POST['descuento_porcentaje_articulo'];
    $descuento_euros_articulo = $_POST['descuento_euros_articulo'];
    $almacen_articulo = $_POST['almacen_articulo'];


    //checkbox__________________________________________________________________
    $checkbox_porcentaje = isset($_POST['checkbox_porcentaje']) ? $_POST['checkbox_porcentaje'] : "";
    $checkbox_euros = isset($_POST['checkbox_euros']) ? $_POST['checkbox_euros'] : "";


    if ($checkbox_porcentaje) {
        $checked_porcentaje = 'checked';
    }

    if ($checkbox_euros) {
        $checked_euros = 'checked';
    }
    //$checkbox_________________________________________________________________
    //control de errores________________________________________________________ */

    $fM->check_length('nombre_articulo', $nombre_articulo, $verif, $arr_err);
    $fM->check_length('referencia_articulo', $referencia_articulo, $verif, $arr_err);
    $fM->check_length('referencia_proveedor_articulo', $referencia_proveedor_articulo, $verif, $arr_err);
    $fM->check_length('descripcion_articulo', $descripcion_articulo, $verif, $arr_err);
    $fM->check_is_greater_than_0('precio_coste_articulo', $precio_coste_articulo, $verif, $arr_err);
    $fM->check_is_greater_than_0('coste_externo_portes_articulo', $precio_coste_articulo, $verif, $arr_err);
    $fM->check_is_greater_than_0('PVP_final_articulo', $PVP_final_articulo, $verif, $arr_err);
    $fM->check_is_greater_than_0('margen_articulo', $margen_articulo, $verif, $arr_err);
    $fM->check_is_greater_than_0('cantidad_articulo', $cantidad_articulo, $verif, $arr_err);
    if (isset($_POST['inicio_descuento_articulo']) && $inicio_descuento_articulo != "")
        $fM->check_is_date('inicio_descuento_articulo', $inicio_descuento_articulo, $verif, $arr_err);
    if (isset($_POST['fin_descuento_articulo']) && $fin_descuento_articulo != "")
        $fM->check_is_date('fin_descuento_articulo', $fin_descuento_articulo, $verif, $arr_err);
    //$arrayImg= if (isset($_FILES['arrayArticuloImg'])) {
    //$fM->check_img_no_empty('arrayArticuloImg',$_FILES['arrayArticuloImg'],$verif,$arr_err);
//control $FILES________________________________________________________________
   /* if (isset($_FILES['arrayArticuloImg'])) {

        //$aux_any_img = false;
        $aux_any_img = 0;

        $cantidad = count($_FILES['arrayArticuloImg']['tmp_name']); //Recibe un array de FILES que se hace poniendo el mismo name a todos los input[type="file"]
        for ($i = 0; $i < $cantidad; $i++) {//Recorre el bucle
            if ($_FILES['arrayArticuloImg']['name'][$i] != "") {

                $img[$i] = $_FILES['arrayArticuloImg']['name'][$i];
                //echo $_FILES['arrayArticuloImg']['name'][$i].'<br>';
                echo $img[$i] . '<br>';

                $imagenInfo = getimagesize($_FILES['arrayArticuloImg']['tmp_name'][$i]); //Saca el mime "type" pero que no se puede modificar
                if ($imagenInfo['mime'] == 'image/png' || $imagenInfo['mime'] == 'image/jpeg') {//Si tiene una de las siguientes extensiones es que es imagen
                    //mueve del archivo temporal al archivo que le indiquemos.
                    //es para que en el post, en caso de error, se vean las imagenes subidas.
                    $res = move_uploaded_file($_FILES['arrayArticuloImg']['tmp_name'][$i], $document_root . 'imgperfil/' . $_FILES['arrayArticuloImg']['name'][$i]);
                }

                $aux_any_img++;
            }
        }
        if ($aux_any_img == 0) {
            $verif = false;
            $arr_err['arrayArticuloImg'] = '<div class="campo"><div class="error_alert">Debe haber una imagen como mínimo </div></div>';
        }
        //comprobaciones extra si necesarias...
        //echo 'tamaño de files: '.count($_FILES['arrayArticuloImg']['tmp_name']).'<br>';
        //$_FILES['arrayArticuloImg']['name'][$i]
    }*/
//control $FILES________________________________________________________________
//
//
    //$fM->check_length('etiquetas_articulo', $etiquetas_articulo, $verif, $arr_err);
    //$fM->foto('archivo_csv1', $referencia_articulo, $verif, $arr_err);
    //$fM->check_combo('id_tiendavf', $id_tiendavf, $verif, $arr_err);
    //$fM->check_is_valid_email('email_usuario', $email_usuario, $verif, $arr_err, 'Debe ser una dirección email');
    //control de errores________________________________________________________ */
    //No se añade o se modifica si no pasa el control de errores.
    if ($verif == true) {
        //MySQL ----------------------------------------------------------------- */
        //control para evitar SQL por inyección
        $nombre_articulo = $uM->escstr($nombre_articulo);
        $referencia_articulo = $uM->escstr($referencia_articulo);
        $referencia_proveedor_articulo = $uM->escstr($referencia_proveedor_articulo);
        $descripcion_articulo = $uM->escstr($descripcion_articulo);
        // $etiquetas_articulo = $uM->escstr($etiquetas_articulo);
        $activado_articulo = ($activado_articulo == 'on') ? 1 : 0;
        $visible_en_tienda_articulo = ($visible_en_tienda_articulo == 'on') ? 1 : 0;

// tratamiento fechas___________________________________________________________

        $inicio_descuento_articulo = date_to_mysql($inicio_descuento_articulo);
        $fin_descuento_articulo = date_to_mysql($fin_descuento_articulo);
// tratamiento fechas___________________________________________________________   
        if ($id_articulo > 0) { //UPDATE
            //para el campo nombre_usuario se le pasa email_usuario (el email es usado para el login)
            $ruu = $aM->update_articulo($id_articulo, $nombre_articulo, $referencia_articulo, $referencia_proveedor_articulo, $descripcion_articulo, $activado_articulo, $visible_en_tienda_articulo, $precio_coste_articulo, $coste_externo_portes_articulo, $PVP_final_articulo, $margen_articulo, $inicio_descuento_articulo, $fin_descuento_articulo, $descuento_porcentaje_articulo, $descuento_euros_articulo, $cantidad_articulo, $almacen_articulo);
            //no se modifican etiquetas en la vista del update
            //$rau = $aM->delete_articulo_etiquetas($id_articulo);
            //$rau = $aM->add_articulo_etiquetas($id_articulo, $etiquetas_articulo);

            if ($ruu) {
                //header('Location: ' . $ruta_inicio . 'articulos.php?editar_articulo=true');
            } else
                $str_errores = '<div class="error_alert">Error actualizando artículo</div>';
        } else { //NUEVO
            //añado articulo y etiqueta
            $raa = $aM->add_articulo($nombre_articulo, $referencia_articulo, $referencia_proveedor_articulo, $descripcion_articulo, $activado_articulo, $visible_en_tienda_articulo, $precio_coste_articulo, $coste_externo_portes_articulo, $PVP_final_articulo, $margen_articulo, $inicio_descuento_articulo, $fin_descuento_articulo, $descuento_porcentaje_articulo, $descuento_euros_articulo, $cantidad_articulo, $almacen_articulo);

            //$rae = $aM->add_etiqueta($etiquetas_articulo);
            //consigo id articulo
            $id_articulo = $aM->get_insert_id();

            //añado id articulo y id etiqueta en tabla relacional articulo_etiqueta  
            $rau = $aM->add_articulo_etiquetas($id_articulo, $etiquetas_articulo);

            if ($rau) {
                echo 'añadido';
                //$id_articulo = $aM->get_insert_id();
                header('Location: ' . $ruta_inicio . 'articulos.php?nuevo_articulo=true');
                // exit();
            } else
                $str_errores = '<div class="error_alert">Error añadiendo artículo</div>';
        }
//control imagenes______________________________________________________________

      /*  if (isset($_FILES['arrayArticuloImg'])) {

            $cantidad = count($_FILES['arrayArticuloImg']['tmp_name']); //Recibe un array de FILES que se hace poniendo el mismo name a todos los input[type="file"]
            for ($i = 0; $i < $cantidad; $i++) {//Recorre el bucle
                if ($_FILES['arrayArticuloImg']['name'][$i] != "") {//Si está vacio es que no ha insertado ninguna imagen por lo tanto no hace las siguientes comprobaciones
                    echo "<br>HOLA1!<br>";
                    if ($res) {
                        $rgea = $uM->get_existe_articulo($id_articulo);
                        if ($rgea > 0) {
                            $result_img = $uM->update_imagen_articulo($id_articulo, $id_usuario . $_FILES['arrayArticuloImg']['name'][$i], $i);
                            if (!$result_img) {
                                $str_errores = '<div class="error_alert">Error añadiendo el archivo</div>';
                            }
                        } else {
                            $result_img = $uM->add_imagen_articulo($id_articulo, $id_usuario . $_FILES['arrayArticuloImg']['name'][$i], $i);

                            if (!$result_img) {
                                $str_errores = '<div class="error_alert">Error añadiendo el archivo</div>';
                            }
                        }
                    } else
                        $str_errores = '<div class="error_alert">El archivo no es de tipo imagen</div>';
                    //print_r($_FILES);
                }
            }
        }*/
//control imagenes______________________________________________________________
    }
}
//MySQL_________________________________________________________________________ */    
//POST__________________________________________________________________________
//COMBOS________________________________________________________________________
//$sl_tiendavf = $tvfM->get_combo_tiendasvf('id_tiendavf', $id_tiendavf);
//$sl_tipo_usuario = $uM->get_combo_tipos_usuario('id_tipo_usuario', $id_tipo_usuario);
//COMBOS________________________________________________________________________
//LISTADO_______________________________________________________________________
if (isset($_GET['id_articulo'])) {

    $id_articulo = $_GET['id_articulo'];
    $titulo = 'Actualizar artículo';

    //datos articulo____________________________________________________________
    $rga = $aM->get_articulo($id_articulo);

    if ($rga) {

        while ($fgu = $rga->fetch_assoc()) {
            $nombre_articulo = $fgu['nombre_articulo'];
            $referencia_articulo = $fgu['referencia_articulo'];
            $referencia_proveedor_articulo = $fgu['referencia_proveedor_articulo'];
            $descripcion_articulo = $fgu['descripcion_articulo'];
            //$etiquetas_articulo = $fga['etiquetas_articulo'];
            $activado_articulo = $fgu['activado_articulo'];
            $visible_en_tienda_articulo = $fgu['visible_en_tienda_articulo'];
            $precio_coste_articulo = $fgu['precio_coste_articulo'];
            $coste_externo_portes_articulo = $fgu['coste_externo_portes_articulo'];
            $PVP_final_articulo = $fgu['PVP_final_articulo'];
            $margen_articulo = $fgu['margen_articulo'];
            $cantidad_articulo = $fgu['cantidad_articulo'];
            $inicio_descuento_articulo = $fgu['inicio_descuento_articulo'];
            $fin_descuento_articulo = $fgu['fin_descuento_articulo'];
            $descuento_porcentaje_articulo = $fgu['descuento_porcentaje_articulo'];
            $descuento_euros_articulo = $fgu['descuento_euros_articulo'];
            ($descuento_porcentaje_articulo > 1) ? $checked_porcentaje = "checked" : $checked_euros = "checked";
            $almacen = $fgu['almacen_articulo'];
        }
//LISTADO_______________________________________________________________________        
    } else
        $str_errores = '<div class="error_alert">Error cargando usuario</div>';
    //datos articulo------------------------------------------------------------
} else {

    $titulo = 'Nuevo artículo';
}
include_once('inc/cabecera.inc.php'); //cargando cabecera 
?>

<script type="text/javascript" src="js/ctl_data.js"></script>
<body>

    <div id="main_container">
        <div id="responsive_back_content">
            <?php include_once('inc/franja_top.inc.php'); ?>
            <?php include_once('inc/main_menu.inc.php'); ?>
            <div id="responsive_seccion_back" style="margin-top: 10%; ">

                <div id="ttl_seccion_back">
                    <h2><?php echo $titulo ?></h2>

                    <div style="clear:both;"></div>
                </div>

                <div style="margin:0 10px 10px 10px;">
                    <?php /* if (isset($str_estado) && strlen($str_estado) > 1) echo $str_estado; */ ?>
                    <?php /* if (isset($str_errores)) echo $str_errores; */ ?>
                </div>
                <br> 
                <div id="filtros_seccion">
                    <?php if (isset($str_info)) echo $str_info; ?>
                    <?php if (isset($str_errores)) echo $str_errores; ?>
                </div>

                <div id="filtros_seccion">
                    <form action="nuevo_articulo.php" method="post" id="form_articulos" name="form_articulos" enctype="multipart/form-data" >
                        <div class="login_form" style="border-color:#DFDFDF; border-radius: 3px; border-radius:3px; box-shadow: 0 1px 0 #FFFFFF inset; border-style:solid; border-with: 1px; line-height: 1; padding: 0; font-size: 1.2em; margin: 0 0 1em 0;">
                            <?php
//echo $fM->get_input_combo('id_tipo_usuario', 'Tipo usuario', $sl_tipo_usuario, $arr_err);
                            echo $fM->get_input_hidden('id_articulo', $id_articulo);
                            echo $fM->get_input_text('nombre_articulo', 'Nombre artículo', $nombre_articulo, $arr_err);
                            echo $fM->get_input_text('referencia_articulo', 'Referencia', $referencia_articulo, $arr_err);
                            echo $fM->get_input_text('referencia_proveedor_articulo', 'Referencia proovedor', $referencia_proveedor_articulo, $arr_err);
                            echo $fM->get_input_text('descripcion_articulo', 'Descripcion', $descripcion_articulo, $arr_err);

                            if ($id_articulo != 0) {
                                // echo '<div class= campo style="display:none;"> Etiquetas </div>';
                                // $aM->get_combo_etiquetas('etiquetas_articulo', $etiquetas_articulo, 'campo', false, false);
                            } else {
                                echo '<div class= campo > Etiquetas </div>';
                                echo $aM->get_combo_etiquetas('etiquetas_articulo', $etiquetas_articulo, 'campo', false, false);
                                echo '<br>';
                                echo '<br>';
                            }
                            echo '<div class= campo > Almacén </div>';
                            echo $aM->get_combo_tipo_estilo_arti('almacen_articulo');
                            echo '<br>';
                            echo '<br>';
                            echo $fM->get_input_checkbox('activado_articulo', 'Activado', $activado_articulo, $arr_err);
                            echo $fM->get_input_checkbox('visible_en_tienda_articulo', 'Visible en tienda', $visible_en_tienda_articulo, $arr_err);
                            echo $fM->get_input_number('precio_coste_articulo', 'Precio de coste', $precio_coste_articulo, $arr_err, 'campo', 0, 1000, true);
                            echo $fM->get_input_number('coste_externo_portes_articulo', 'Coste externo (portes)', $coste_externo_portes_articulo, $arr_err, 'campo', 0, 1000, true);
                            echo $fM->get_input_number('PVP_final_articulo', 'PVP final', $PVP_final_articulo, $arr_err, 'campo', 0, 1000, true);
                            echo $fM->get_input_number('margen_articulo', 'Margen', $margen_articulo, $arr_err, 'campo', 0, 1000, true);
                            echo $fM->get_input_number('cantidad_articulo', 'Cantidad', $cantidad_articulo, $arr_err, 'campo', 0, 1000, true);
                            echo $fM->get_input_date('inicio_descuento_articulo', 'Fecha inicio descuento', $inicio_descuento_articulo, $arr_err, 'campo');
                            echo $fM->get_input_date('fin_descuento_articulo', 'Fecha fin descuento', $fin_descuento_articulo, $arr_err, 'campo', 'disabled');

// echo $fM->get_input_checkbox('checkbox_porcentaje', 'Descuento en porcentaje', $checkbox_porcentaje, $arr_err);

                            echo '<div name="porcentaje" id="checkbox_porcentaje_wrapper" class="campo"> '; //output
                            echo '<input type="checkbox" disabled id="checkbox_porcentaje" name="checkbox_porcentaje" ' . $checked_porcentaje . '  />';
                            echo 'Descuento en %</div>';

                            echo '<div name="checkbox_euros" id="checkbox_euros_wrapper" class="campo"> '; //output
                            echo '<input type="checkbox" disabled id="checkbox_euros" name="checkbox_euros" ' . $checked_euros . ' />';
                            echo 'Descuento en €</div>';

//echo $fM->get_input_number('descuento_porcentaje_articulo', 'Descuento porcentual', $descuento_porcentaje_articulo, false, 'campo', 0, 100, true);

                            echo '<div id="descuento_porcentaje_articulo_wrapper" name="descuento_porcentaje_articulo" class="campo" style="display:none"> Descuento porcentual'; //output
                            echo '<input type="number" max="100" min="0" id="descuento_porcentaje_articulo" name="descuento_porcentaje_articulo" step=".01" value="' . htmlspecialchars(stripslashes($descuento_porcentaje_articulo)) . '" />';
                            echo '</div>';

//echo $fM->get_input_number('descuento_euros_articulo', 'Descuento en €', $descuento_euros_articulo, false, 'campo', 0, 999, true);
                            echo '<div id="descuento_euros_articulo_wrapper" name="descuento_euros_articulo" class="campo" style="display:none"> Descuento euros'; //output
                            echo '<input type="number" max="999" min="0" id="descuento_euros_articulo" name="descuento_euros_articulo" step=".01" value="' . htmlspecialchars(stripslashes($descuento_euros_articulo)) . '" />';
                            echo '</div>';
                            /*                             * */
//echo '<div class= campo> Imagenes </div>';
//echo $fM->get_input_img('arrayArticuloImg', 'Imagenes', $arr_err);
                           // echo isset($arr_err['arrayArticuloImg']) ? $arr_err['arrayArticuloImg'] : '';
                            ?>
                          <!--  <div style= "margin: 0 auto;" class="">

                                <div class="row" style="height: 260px;  "> 
                                    <?php for ($i = 0; $i < 5; $i++) { ?>
                                        <div style="float:left; width: 19%; margin: 0.5% 0.5%; text-align: center; background-color: blue;">
                                            <img style=" max-width:250px; max-height: 250px; " src="imgperfil/<?php echo $img[$i] ?>" alt="" >
                                        </div>
                                    <?php } ?> 

                                </div>
                                <div class="row" style="height:50x;" >
                                    <?php for ($i = 0; $i < 5; $i++) { ?>
                                        <input style=" color: transparent; width: 12%; margin: 0 auto; " type="file" value="<?php echo $img[$i] ?>" name="arrayArticuloImg[]">

                                    <?php } ?>


                                </div>
                                <div class="row" style="height:50px;" >
                                    <?php for ($i = 0; $i < 5; $i++) { ?>
                                        <p style="position:relative; width: 12%; margin: 0 auto;"><?php echo $img[$i] ?></p>
                                    <?php } ?>


                                </div>
                                <div style="clear:both;"></div> 
                            </div>-->

                            <div style="clear:both;"></div>    
                        </div>
                        <div style="float:right; margin:0.8em 0;">
                            <input type="submit" name="Submit" style="float:none;" class="btn_aceptar" value="Aceptar" />
                        </div>
                    </form>

                </div>

            </div>
        </div>
    </div>
</body>
</html>
