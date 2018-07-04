<?php
include_once('config/config.inc.php'); //cargando archivo de configuracion
$uM = load_model('usuario');
$aM = load_model('articulos');
$uM->control_sesion($ruta_inicio, ADMIN);

$str_errores = '';
$str_estado = '';
$id_archivo = 'archivo_csv';
$ff = load_model('file');
$fM = load_model('form');


$id_articulo = 0;
$nombre_articulo = '';

$arr_err = array();
$verif = true;
$titulo = 'Imágenes';

//extensión archivo
$ext = '';
$exten = array(1, 2, 3, 4, 5);
$img = array('', '', '', '', '');


$rw = ''; //row imagenes
$re='';



  

//GET___________________________________________________________________________
if (isset($_GET['id_articulo'])) {
    $id_articulo= $_GET['id_articulo'];
   //para conseguir el nombre del artículo
    $rga = $aM->get_articulo($id_articulo);
    if ($rga) {

        while ($fgu = $rga->fetch_assoc()) {
            $nombre_articulo = $fgu['nombre_articulo'];
        }
    }
    
     //para eliminar una imagen   
    if( isset($_REQUEST['id_articulo'])&& isset($_REQUEST['i'])){
        //$id_img= $_REQUEST['id_img'];   
        //$ruta= $_REQUEST['ruta_img'];   
        $i= $_REQUEST['i'];   
        echo 'DENTRO!<br>';
        $aM->delete_articulo_img($id_articulo, $i);
    }  
      
    //para conseguir las imagenes y meterlas en array
    $rgi = $aM->get_articulo_img($id_articulo);
    if ($rgi) {
        
        while ($fgu = $rgi->fetch_assoc()) {
            $id_img=$fgu['id_img'];
            for ($i=0;$i<5;$i++) {
                  
                    $img[$i] = $fgu['ruta' . $i];
                    
                }  
            }
        }
    }

//GET___________________________________________________________________________
//CONTROL______________________________________________________________________
//CONTROL______________________________________________________________________
//POST__________________________________________________________________________
if (isset($_POST['id_articulo'])) {

    //$titulo = 'Actualizar artículo';
    $id_articulo = $_POST['id_articulo'];
    //$id_usuario = $_SESSION['id_usuario'];
   
    
    
    $nombre_articulo = $_POST['nombre_articulo'];
    
    $rgi = $aM->get_articulo_img($id_articulo);
    
    // Sacar todas las etiquetas por id_artículo.
   
        
        //echo '<BR>ETIQUETAS INICIO<BR>';
        //echo 'ETIQUETAS '.$row['id_etiqueta'].'; NOMBRE ETIQUETA = '.$row['nombre_etiqueta'].' <BR>';
      
        
        
       // echo 'ETIQUETAS FIN<BR>';
        
        
    

    //$checkbox_________________________________________________________________
    //control de errores________________________________________________________ */
//control $FILES________________________________________________________________
    if (isset($_FILES['arrayArticuloImg'])) {

        //$aux_any_img = false;
        $aux_any_img = 0;

        $cantidad = count($_FILES['arrayArticuloImg']['tmp_name']); //Recibe un array de FILES que se hace poniendo el mismo name a todos los input[type="file"]
        for ($i = 0; $i < $cantidad; $i++) {//Recorre el bucle
            if ($_FILES['arrayArticuloImg']['name'][$i] != "") {

                $img[$i] = $_FILES['arrayArticuloImg']['name'][$i];
                //echo $_FILES['arrayArticuloImg']['name'][$i].'<br>';
                //echo $img[$i] . '<br>';

                $imagenInfo = getimagesize($_FILES['arrayArticuloImg']['tmp_name'][$i]); //Saca el mime "type" pero que no se puede modificar
                if ($imagenInfo['mime'] == 'image/png' || $imagenInfo['mime'] == 'image/jpeg') {//Si tiene una de las siguientes extensiones es que es imagen
                    //mueve del archivo temporal al archivo que le indiquemos.
                    //es para que en el post, en caso de error, se vean las imagenes subidas.
                    $res = move_uploaded_file($_FILES['arrayArticuloImg']['tmp_name'][$i], $document_root . 'imgart/' . $_FILES['arrayArticuloImg']['name'][$i]);
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
    }
//control $FILES________________________________________________________________

    if ($verif == true) {
        //MySQL ----------------------------------------------------------------- */
//control imagenes______________________________________________________________

        if (isset($_FILES['arrayArticuloImg'])) {

            $cantidad = count($_FILES['arrayArticuloImg']['tmp_name']); //Recibe un array de FILES que se hace poniendo el mismo name a todos los input[type="file"]
            for ($i = 0; $i < $cantidad; $i++) {//Recorre el bucle
                if ($_FILES['arrayArticuloImg']['name'][$i] != "") {//Si está vacio es que no ha insertado ninguna imagen por lo tanto no hace las siguientes comprobaciones
                    //echo "<br>HOLA!<br>";
                    if ($res) {
                        $rgea = $uM->get_existe_articulo($id_articulo);
                        if ($rgea > 0) {

                            $result_img = $aM->update_imagen_art($id_articulo, $_FILES['arrayArticuloImg']['name'][$i], $i);
                            if (!$result_img) {
                                $str_errores = '<div class="error_alert">Error añadiendo el archivo</div>';
                            }
                        } else {
                            $result_img = $aM->add_imagen_art($id_articulo, $_FILES['arrayArticuloImg']['name'][$i], $i);

                            if (!$result_img) {
                                $str_errores = '<div class="error_alert">Error añadiendo el archivo</div>';
                            }
                        }
                    } else
                        $str_errores = '<div class="error_alert">El archivo no es de tipo imagen</div>';
                    //print_r($_FILES);
                }
            }
        }
//control imagenes______________________________________________________________
    }
    
    $rgo = $aM->get_articulo_img($id_articulo);
    if ($rgo) {
        
        while ($fgu = $rgo->fetch_assoc()) {
           $id_img=$fgu['id_img'];
            
            for ($i=0;$i<5;$i++) {
                
                    $img[$i] = $fgu['ruta' . $i];
                
                //echo $img[$i] . '<br>';
                
            }
           
        }
    }
}
//MySQL_________________________________________________________________________ */    
//POST__________________________________________________________________________
//COMBOS________________________________________________________________________
//$sl_tiendavf = $tvfM->get_combo_tiendasvf('id_tiendavf', $id_tiendavf);
//$sl_tipo_usuario = $uM->get_combo_tipos_usuario('id_tipo_usuario', $id_tipo_usuario);
//COMBOS________________________________________________________________________
//LISTADO_______________________________________________________________________
//LISTADO_______________________________________________________________________        

include_once('inc/cabecera.inc.php'); //cargando cabecera 
?>

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
                    <form action="img-articulos.php" method="post" id="form_articulos" name="form_articulos" enctype="multipart/form-data" >
                        
                        <div class="login_form" style="border-color:#DFDFDF; border-radius: 3px; border-radius:3px; box-shadow: 0 1px 0 #FFFFFF inset; border-style:solid; border-with: 1px; line-height: 1; padding: 0; font-size: 1.2em; margin: 0 0 1em 0;">
                    <?php
//echo $fM->get_input_combo('id_tipo_usuario', 'Tipo usuario', $sl_tipo_usuario, $arr_err);
                    echo $fM->get_input_hidden('id_articulo', $id_articulo);
                    echo $fM->get_input_text('nombre_articulo', 'Nombre artículo', $nombre_articulo, $arr_err);

/* * */
//echo '<div class= campo> Imagenes </div>';
//echo $fM->get_input_img('arrayArticuloImg', 'Imagenes', $arr_err);
                    echo isset($arr_err['arrayArticuloImg']) ? $arr_err['arrayArticuloImg'] : '';
                    ?>
                            <div style= "margin: 0 auto;" class="">

                                <div class="row" style="height: 260px;  "> 
                    <?php    for ($i = 0; $i < 5; $i++) { ?>
                                        <div style="float:left; width: 19%; margin: 0.5% 0.5%; text-align: center; background-color: blue;">
                                            <img style=" max-width:250px; max-height: 250px; " src="imgart/<?php echo $img[$i] ?>" alt="" >
                                        </div>
                    <?php } ?> 

                                </div>
                                <div class="row" style="height:50px;" >
                    <?php     for ($i = 0; $i < 5; $i++) { ?>
                                        <input style=" color: transparent; width: 12%; margin: 0 auto; " type="file" value="<?php echo $img[$i] ?>" name="arrayArticuloImg[]" onchange="set_txt_input_file(<?php echo $i ?>, this.value)">

                    <?php } ?>


                                </div>
                                <div class="row" style="height:50px;" >
                    <?php     for ($i = 0; $i < 5; $i++) { ?>
                                        <p id="txt_input_file_<?php echo $i  ?>" style="position:relative; width: 12%; margin: 0 auto;"><?php echo $img[$i] ?></p>
                                 <?php    } ?>
                              </div>
                                
                                <br>
                                <br>
                                <br>
                              
                                <div class="row" style="height:50px;" > 
                                <?php     for ($i = 0; $i < 5; $i++) { ?>
                         <?php if($img[$i]!=''){ ?>  
                    <div style="position:relative; width: 12%; margin: 0 auto;" class="table_tr row_1"  >
                           
                    <a href="img-articulos.php?id_articulo=<?php echo $id_articulo ?>&i=<?php echo $i ?>">Eliminar</a>
                       <div style="clear:both;"></div>
                      </div>
                           <?php  } else{ ?>
                    <div style="position:relative; width: 12%; margin: 0 auto;" class="table_tr row_1"  >
                       </div>           
                               
                        <?php   } } ?>
                                </div>

                                </div>
                                <div style="clear:both;"></div> 
                            </div>

                            <div style="clear:both;"></div>    
                        
                        <div style="float:right; margin:0.8em 0;">
                            <input type="submit" name="Submit" style="float:none;" class="btn_aceptar" value="Aceptar" />
                        </div>
                    </form>
                   </div>
                </div>

            </div>
        </div>
    </div>
</body>
</html>
