<?php
include_once('../config/config.inc.php'); //cargando archivo de configuracion
//$uM->control_sesion($ruta_inicio, ADMIN);

$fM = load_model('form');
$uM = load_model('usuario'); //uM userModel

$total_pag_form = 5;
$array = explode('/', $_SERVER['PHP_SELF']);
$nombre_fichero = array_pop($array);

$arr_talla_superior = array(
    '34XS' => '34xs',
    '36S' => '36s',
    '38M' => '38m',
    '40L' => '40l',
    '42XL' => '42xl',
);

$arr_talla_pecho = array(
    '80' => '80',
    '85' => '85',
    '90' => '90',
    '95' => '95',
    '100' => '100',
    '105' => '105',
    '110' => '100',
    'más' => 'mas',
);

$arr_altura = array(
    '-155' => '-155',
    '156-160' => '156-160',
    '161-165' => '161-165',
    '166-170' => '166-170',
    '171-175' => '171-175',
    'más' => 'mas',
);

$arr_tono_piel = array(
    'rosada' => 'rosada',
    'beige' => 'beige',
    'dorada' => 'dorada',
    'mulata' => 'mulata',
    'negra' => 'negra',
);

$arr_ojos = array(
    'azul' => 'azul',
    'verde' => 'verde',
    'gris' => 'gris',
    'miel' => 'miel',
    'marrón' => 'marrón',
    'negro' => 'negro',
);


$id_usuario = '';
if (isset($_SESSION['id_usuario'])) $id_usuario = $_SESSION['id_usuario'];
$silueta_usuario = '';
if (isset($_POST['arraySilueta'])) $silueta_usuario = $_POST['arraySilueta'][0];
$talla_superior = '';
if (isset($_POST['talla_superior'])) $talla_superior = $_POST['talla_superior'][0];
$talla_inferior = '';
if (isset($_POST['talla_inferior'])) $talla_inferior = $_POST['talla_inferior'][0];
$talla_pecho = '';
if (isset($_POST['talla_pecho'])) $talla_pecho = $_POST['talla_pecho'][0];
$altura = '';
if (isset($_POST['altura'])) $altura = $_POST['altura'][0];
$parte_preferida_cuerpo = '';
if (isset($_POST['parte_preferida_cuerpo'])) $parte_preferida_cuerpo = $_POST['parte_preferida_cuerpo'];
$parte_menos_preferida_cuerpo = '';
if (isset($_POST['parte_menos_preferida_cuerpo'])) $parte_menos_preferida_cuerpo = $_POST['parte_menos_preferida_cuerpo'];
$tono_piel = '';
if (isset($_POST['tono_piel'])) $tono_piel = $_POST['tono_piel'][0];
$ojos = '';
if (isset($_POST['ojos'])) $ojos = $_POST['ojos'][0];
$color_pelo = '';
if (isset($_POST['color_pelo'])) $color_pelo = $_POST['color_pelo'];

$arr_err = '';


$arr_silueta = array(
    array('ruta_img'=>'http://sesnineshopper.com/adstorm/img/silueta1.png', 'nombre'=>'Triangulo'),
    array('ruta_img'=>'http://sesnineshopper.com/adstorm/img/silueta2.png', 'nombre'=>'Triangulo invertido'),
    array('ruta_img'=>'http://sesnineshopper.com/adstorm/img/silueta3.png', 'nombre'=>'Reloj arena'),
    array('ruta_img'=>'http://sesnineshopper.com/adstorm/img/silueta4.png', 'nombre'=>'Rectangular'),
    array('ruta_img'=>'http://sesnineshopper.com/adstorm/img/silueta5.png', 'nombre'=>'Redonda'),
);




//GET___________________________________________________________________________
        
//GET___________________________________________________________________________

//POST__________________________________________________________________________
if (isset($_POST['talla_superior'])) {
    $rctu=$uM->clear_tallas_usuario($id_usuario);
    if ($rctu) {
        $ratu=$uM->add_tallas_usuario($id_usuario, $talla_superior, $talla_inferior, $talla_pecho, $altura, $parte_preferida_cuerpo, $parte_menos_preferida_cuerpo, $tono_piel, $ojos, $color_pelo, $silueta_usuario);
        if (!$ratu) {
            $str_errores = '<div class="error_alert">Error guardando tallas</div>';
        }
    } else $str_errores = '<div class="error_alert">Error eliminando tallas</div>';
}
//POST__________________________________________________________________________

//LISTADO__________________________________________________________________________
$header_pag = '<div class="flex-container-row">';
for($i=1;$i<=$total_pag_form;$i++){
    $header_pag .= '<div ';
    ($nombre_fichero==$i.".php") ? $header_pag .= 'class="bg_salmon tipogr_blanca flex-container-center" ' : $header_pag .= 'class="flex-container-center"';
    $header_pag .= 'style="width: 100%; padding: 0.5em;">'.$i.'</div>';
}


//LISTADO__________________________________________________________________________

//CONTROL_______________________________________________________________________

if (isset($_FILES['arraySiluetaImg'])) {
    $cantidad = count($_FILES['arraySiluetaImg']['tmp_name']);//Recibe un array de FILES que se hace poniendo el mismo name a todos los input[type="file"]
    for ($i=0;$i<$cantidad;$i++) {//Recorre el bucle
        if($_FILES['arraySiluetaImg']['name'][$i]!=""){//Si está vacio es que no ha insertado ninguna imagen por lo tanto no hace las siguientes comprobaciones
            $imagenInfo = getimagesize($_FILES['arraySiluetaImg']['tmp_name'][$i]);//Saca el mime "type" pero que no se puede modificar
            if ($imagenInfo['mime']=='image/png' || $imagenInfo['mime']=='image/jpeg') {//Si tiene una de las siguientes extensiones es que es imagen
                $res = move_uploaded_file($_FILES['arraySiluetaImg']['tmp_name'][$i],$document_root.'imgperfil/'.$id_usuario.$_FILES['arraySiluetaImg']['name'][$i]);
                if ($res) {
                    $rciu=$uM->clear_imgs_usuario($id_usuario);
                    if ($rciu) {
                        $result_img = $uM->add_imagen_usuario($id_usuario,$id_usuario.$_FILES['arraySiluetaImg']['name'][$i]);
                        if (!$result_img) {
                            $str_errores = '<div class="error_alert">Error añadiendo el archivo</div>';
                        }
                    }
                }
            }else $str_errores = '<div class="error_alert">El archivo no es de tipo imagen</div>';           
        }
    }
}

$rgtu = $uM->get_tallas_usuario($id_usuario);
if ($rgtu) {
    while($frgtu = $rgtu->fetch_assoc()){
        $talla_superior = $frgtu['talla_superior'];
        $talla_inferior = $frgtu['talla_inferior'];
        $talla_pecho = $frgtu['talla_pecho'];
        $altura = $frgtu['altura'];
        $parte_preferida_cuerpo = $frgtu['parte_preferida_cuerpo'];
        $parte_menos_preferida_cuerpo = $frgtu['parte_menos_preferida_cuerpo'];
        $tono_piel = $frgtu['tono_piel'];
        $ojos = $frgtu['color_ojos'];
        $color_pelo = $frgtu['color_pelo'];
        $silueta_usuario = $frgtu['tipologia'];
    }
}

$oas = '';
foreach ($arr_silueta as $clave => $valor){
    $oas .= '<div class="flex-container-column div-input-img-selected">';
    $oas .= $fM->get_input_checkbox_arr_selected_img($valor['nombre'], $valor['ruta_img'], ($silueta_usuario==$valor['nombre']) ? $silueta_usuario : null, "arraySilueta[]", $arr_err, 'radio');
    $oas .= '<div style="color:#ff6666; font-weight:bold; padding:5px; text-align:center;">'.$valor['nombre'].'</div>';
    $oas .= '</div>';
}

if(isset($_POST['talla_superior']) && $str_errores==''){
    header('Location: '.$ruta_inicio.'alta-ps-copia/4.php'); exit();
}

if(isset($_SERVER["HTTP_REFERER"])){
    $array = explode('/', $_SERVER["HTTP_REFERER"]);
    $ruta_anterior = array_pop($array);
    if(!$ruta_anterior=="1.php"){
        header('Location: '.$ruta_inicio.'alta-ps-copia/1.php'); exit();
    }
}else{
    header('Location: '.$ruta_inicio.'alta-ps-copia/1.php'); exit();
}

//CONTROL_______________________________________________________________________

include_once('../inc/cabecera.inc.php'); //cargando cabecera
?>
    <body>
        <div id="main_container">
            <?php include_once('../inc/franja_top.inc.php'); ?>
            <?php include_once('../inc/main_menu.inc.php'); ?>
            <section class="section_top">
                <?php include_once('../inc/acceso_top.inc.php'); ?>
                <?php echo $header_pag?>
            </section>
            <section class="sep_section">
            <?php
                
            ?>
            </section>
            <section class="middle_section">
                <div class="responsive_seccion">
                    <div id="filtros_seccion">
                        <?php if (isset($str_info)) echo $str_info; ?>
                        <?php if (isset($str_errores)) echo $str_errores; ?>
                    </div>
                    <div id="filtros_seccion"></div>
                </div>
            </section>
            <section class="middle_section">
                <div class="responsive_seccion">
                    <div class="flex-container-column">
                        <form action="3.php" method="post" enctype="multipart/form-data">
                            <div class="flex-container-center">
                                <h1>Mi tipología</h1>
                            </div>
                            <div class="flex-container-sa">
                                <?php echo $oas; ?>
                            </div>
                            <div class="flex-container-sa">
                                <div class="flex-container-row">
                                    <label><input type="file" value="img1" name="arraySiluetaImg[]"></label>
                                    <label><input type="file" value="img2" name="arraySiluetaImg[]"></label>
                                    <label><input type="file" value="img3" name="arraySiluetaImg[]"></label>
                                    <label><input type="file" value="img4" name="arraySiluetaImg[]"></label>
                                    <label><input type="file" value="img5" name="arraySiluetaImg[]"></label>
                                </div>
                            </div>
                            <div class="flex-container-sa">
                                <div class="flex-container-row">
                                    <div style="display:flex;flex-direction:column;flex-wrap:wrap;width:100%;margin:50px;">
                                        <img src="http://sesnineshopper.com/adstorm/img/camiseta.png">
                                        <?php echo $uM->get_input_array($arr_talla_superior,"talla_superior",$talla_superior); ?>
                                    </div>
                                    <div style="display:flex;flex-direction:column;flex-wrap:wrap;width:100%;margin:50px;">
                                        <img src="http://sesnineshopper.com/adstorm/img/inferior.png">
                                        <?php echo $uM->get_input_array($arr_talla_superior,"talla_inferior",$talla_inferior); ?>
                                    </div>
                                    <div style="display:flex;flex-direction:column;flex-wrap:wrap;width:100%;margin:50px;">
                                        <img src="http://sesnineshopper.com/adstorm/img/pecho.png">
                                        <?php echo $uM->get_input_array($arr_talla_pecho,"talla_pecho",$talla_pecho); ?>
                                    </div>
                                    <div style="display:flex;flex-direction:column;flex-wrap:wrap;width:100%;margin:50px;">
                                        <img src="http://sesnineshopper.com/adstorm/img/body.png">
                                        <?php echo $uM->get_input_array($arr_altura,"altura",$altura); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="flex-container-sa">
                                <div class="flex-container-row">
                                <div style="display:flex;flex-direction:column;flex-wrap:wrap;align-items:center;">
                                    <p>¿Qué parte de tu cuerpo te gusta más (realzar)?</p>
                                    <?php
                                    if ($parte_preferida_cuerpo!='') {
                                        echo '<input type="text" value="'.$parte_preferida_cuerpo.'" class="form-control" name="parte_preferida_cuerpo" placeholder="Escribe aquí" style="background-color: #d1d1d1; border-radius: 0p;">';
                                    }else{
                                        echo '<input type="text" class="form-control" name="parte_preferida_cuerpo" placeholder="Escribe aquí" style="background-color: #d1d1d1; border-radius: 0p;">';
                                    }
                                    ?>
                                </div>
                                <div style="display:flex;flex-direction:column;flex-wrap:wrap;align-items:center;">
                                    <p>¿Qué parte de tu cuerpo te gusta menos (disimular)?</p>
                                    <?php
                                    if ($parte_menos_preferida_cuerpo!='') {
                                        echo '<input type="text" value="'.$parte_menos_preferida_cuerpo.'" class="form-control" name="parte_menos_preferida_cuerpo" placeholder="Escribe aquí" style="background-color: #d1d1d1; border-radius: 0p;">';
                                    }else{
                                        echo '<input type="text" class="form-control" name="parte_menos_preferida_cuerpo" placeholder="Escribe aquí" style="background-color: #d1d1d1; border-radius: 0p;">';
                                    }
                                    ?>
                                </div>
                                <div style="display:flex;flex-direction:column;flex-wrap:wrap;align-items:center;">
                                    <img src="http://sesnineshopper.com/adstorm/img/colorpiel.png" alt="" width="94px" height="125px">
                                    <p>Tono de piel</p>
                                    <?php echo $uM->get_input_array($arr_tono_piel,"tono_piel",$tono_piel); ?>
                                </div>
                                <div style="display:flex;flex-direction:column;flex-wrap:wrap;align-items:center;">
                                    <img src="http://sesnineshopper.com/adstorm/img/ojo.png" alt="" width="94px" height="125px">
                                    <p>Tono de piel</p>
                                    <?php echo $uM->get_input_array($arr_ojos,"ojos",$ojos); ?>
                                </div>
                                <div style="display:flex;flex-direction:column;flex-wrap:wrap;align-items:center;">
                                    <img src="http://sesnineshopper.com/adstorm/img/cabello.png" alt="" width="94px" height="125px">
                                    <p>Colorpelo</p>
                                    <?php
                                    if ($color_pelo!='') {
                                        echo '<input type="text" value="'.$color_pelo.'" class="form-control" name="color_pelo" placeholder="Escribe aquí" style="background-color: #d1d1d1; border-radius: 0p;">';
                                    }else{
                                        echo '<input type="text" class="form-control" name="color_pelo" placeholder="Escribe aquí" style="background-color: #d1d1d1; border-radius: 0p;">';
                                    }
                                    ?>
                                </div>
                                </div>
                            </div>
                            <div style="float:left; margin:0.8em 0;">
                                <input type="submit" style="float:none;" class="btn_aceptar" value="Aceptar" />
                            </div>
                        </form>
                    </div>
                </div>
            </section>
        </div>
    </body>
    </html>