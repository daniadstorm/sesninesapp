<?php
include_once('config/config.inc.php'); //cargando archivo de configuracion

$uM = load_model('usuario');
$fM = load_model('form');
$uM->control_sesion($ruta_inicio, USER);

//define('MAX_FILE_IMG',2097152);

$arr_err = array();
//$arr_estilos = array();
$arr_silueta = array();
$arr_silueta_img = array();
$arr_texto_silueta = array(
    1 => 'Triangulo',
    2 => 'Triángulo invertido',
    3 => 'Reloj arena',
    4 => 'Rectangular',
    5 => 'Redonda',
);
$arr_img_permitida = array(
    0 => 'image/bmp',
    1 => 'image/png',
    2 => 'image/jpeg',
);
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

$arr_calzado = array(
    '36' => '36',
    '37' => '37',
    '38' => '38',
    '39' => '39',
    '40' => '40',
    '41' => '41',
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
$tipo_estilo = '';
$color_estilo = '';
$textura_estilo = '';
$referente_estilo = '';
$actividad_estilo = '';
$profesion_estilo = '';
$silueta_estilo = '';
$talla_superior = '';
$talla_inferior = '';
$talla_pecho = '';
$altura = '';
$calzado = '';
$parte_preferida_cuerpo = '';
$parte_menos_preferida_cuerpo = '';
$tono_piel = '';
$ojos = '';
$color_pelo = '';
$looks_libre = '';
$looks_trabajo = '';
$looks_comentario = '';

if (isset($_SESSION['id_usuario'])) $id_usuario = $_SESSION['id_usuario'];
if (isset($_POST['tipo_estilo'])) $tipo_estilo = $_POST['tipo_estilo'];
if (isset($_POST['color_estilo'])) $color_estilo = $_POST['color_estilo'];
if (isset($_POST['textura_estilo'])) $textura_estilo = $_POST['textura_estilo'];
if (isset($_POST['referente_estilo'])) $referente_estilo = $_POST['referente_estilo'];
if (isset($_POST['actividad_estilo'])) $actividad_estilo = $_POST['actividad_estilo'];
if (isset($_POST['profesion_estilo'])) $profesion_estilo = $_POST['profesion_estilo'];
if (isset($_POST['arraySilueta'])) $arr_silueta = $_POST['arraySilueta'];
if (isset($_POST['talla_superior'])) $talla_superior = $_POST['talla_superior'][0];
if (isset($_POST['talla_inferior'])) $talla_inferior = $_POST['talla_inferior'][0];
if (isset($_POST['talla_pecho'])) $talla_pecho = $_POST['talla_pecho'][0];
if (isset($_POST['talla_inferior'])) $altura = $_POST['altura'][0];
if (isset($_POST['calzado'])) $calzado = $_POST['calzado'][0];
if (isset($_POST['parte_preferida_cuerpo'])) $parte_preferida_cuerpo = $_POST['parte_preferida_cuerpo'];
if (isset($_POST['parte_menos_preferida_cuerpo'])) $parte_menos_preferida_cuerpo = $_POST['parte_menos_preferida_cuerpo'];
if (isset($_POST['tono_piel'])) $tono_piel = $_POST['tono_piel'][0];
if (isset($_POST['ojos'])) $ojos = $_POST['ojos'][0];
if (isset($_POST['color_pelo'])) $color_pelo = $_POST['color_pelo'];
if (isset($_POST['arrayLookLibre'])) $looks_libre = $_POST['arrayLookLibre'][0];
if (isset($_POST['arrayLookTrabajo'])) $looks_trabajo = $_POST['arrayLookTrabajo'][0];
if (isset($_POST['looks_comentario'])) $looks_comentario = htmlspecialchars($_POST['looks_comentario']);

//POST__________________________________________________________________________

if (isset($_POST['arrayCategorias'])) {
    $rccu=$uM->clear_categorias_usuario($id_usuario);
    if ($rccu) {
        $racu=$uM->add_categoria_usuario($id_usuario,$_POST['arrayCategorias']);
        if (!$racu) {
            $str_errores = '<div class="error_alert">Error guardando categorias</div>';
        }
    } else $str_errores = '<div class="error_alert">Error eliminando categorias de usuario</div>';
}
    
if (isset($_POST['tipo_estilo'])) {
    $rceu=$uM->clear_estilos_usuario($id_usuario);
    if ($rceu) {
        $raeu=$uM->add_estilo_usuario($id_usuario, $tipo_estilo, $color_estilo, $textura_estilo, $referente_estilo, $actividad_estilo, $profesion_estilo, $arr_silueta[0]);
        if (!$raeu) {
            $str_errores = '<div class="error_alert">Error guardando estilos</div>';
        } 
    } else $str_errores = '<div class="error_alert">Error eliminando estilos de usuario</div>';
}

if (isset($_FILES['arraySiluetaImg'])) {
    for ($i=0;$i<count($_FILES['arraySiluetaImg']);$i++) {
        $verif = false;
        //Control errores defecto
        if ($_FILES['arraySiluetaImg']['error'][$i]>0) {
            if ($_FILES['arraySiluetaImg']['error'][$i]==1) {
                $str_errores = '<div class="error_alert">Maximo tama&ntilde;o excedido</div>';
            } else if($_FILES['arraySiluetaImg']['name'][$i]!="" && $_FILES['arraySiluetaImg']['error'][$i]==4) $str_errores = '<div class="error_alert">Error subiendo el archivo;'.$i.' por favor, inténtelo de nuevo</div>';
        }
        //Control de content type
        if ($_FILES['arraySiluetaImg']['error'][$i]==0) {
            $x=0;
            while ($x<count($arr_img_permitida) && !$verif){
                if ($arr_img_permitida[$x]==$_FILES['arraySiluetaImg']['type'][$i]) {
                    $verif=true;
                }
                $x++;
            }
        }
        //Control de mime type
        if ($_FILES['arraySiluetaImg']['error'][$i]==0) {
            $imagenInfo = getimagesize($_FILES['arraySiluetaImg']['tmp_name'][$i]);
            $x=0;
            if ($arr_img_permitida[0]!=$imagenInfo['mime'] && $arr_img_permitida[1]!=$imagenInfo['mime'] && $arr_img_permitida[2]!=$imagenInfo['mime']) {
                $verif=false;
            }
        }
        //Guardar imagen
        if ($verif && $_FILES['arraySiluetaImg']['error'][$i]==0) {
            $res = move_uploaded_file($_FILES['arraySiluetaImg']['tmp_name'][$i],'imgperfil/'.$id_usuario.$_FILES['arraySiluetaImg']['name'][$i]);
            if ($res) {
                $rciu=$uM->clear_imgs_usuario($id_usuario);
                if ($rciu) {
                    $result_img = $uM->add_imagen_usuario($id_usuario,$id_usuario.$_FILES['arraySiluetaImg']['name'][$i]);
                    if (!$result_img) {
                        $str_errores = '<div class="error_alert">Error añadiendo el archivo</div>';
                    }
                }
            }
        } else if($_FILES['arraySiluetaImg']['name'][$i]!='') {
            $str_errores = '<div class="error_alert">El archivo seleccionado no es de tipo imagen '.$_FILES['arraySiluetaImg']['name'][$i].'</div>';
        }
    }
}
if (isset($_POST['talla_superior'])) {
    $rctu=$uM->clear_tallas_usuario($id_usuario);
    if ($rctu) {
        $ratu=$uM->add_tallas_usuario($id_usuario, $talla_superior, $talla_inferior, $talla_pecho, $altura, $parte_preferida_cuerpo, $parte_menos_preferida_cuerpo, $tono_piel, $ojos, $color_pelo, $calzado);
        if (!$ratu) {
            $str_errores = '<div class="error_alert">Error guardando tallas</div>';
        }
    } else $str_errores = '<div class="error_alert">Error eliminando tallas</div>';
}


if (isset($_POST['arrayLookLibre'])) {
    $clu=$uM->clear_looks_usuario($id_usuario);
    if ($clu) {
        $ralul=$uM->add_looks_usuario($id_usuario, $looks_comentario, $looks_libre, $looks_trabajo);
        if (!$ralul) {
            $str_errores = '<div class="error_alert">Error guardando looks</div>';
        }
    } else $str_errores = '<div class="error_alert">Error eliminando looks</div>';
}
/*if (!$str_errores) {
    header('Location: '.$ruta_inicio.'ver-perfil.php?update_perfil=true'); exit();
}*/

//POST__________________________________________________________________________
//LISTADO_______________________________________________________________________
$rglul = $uM->get_looks_usuario("libre");
$olul = '';

if ($rglul) {
    while ($frglul = $rglul->fetch_assoc()) {
            if ($frglul['id_usuario']=='' || $frglul['id_usuario']==$id_usuario) {
                $olul .= '<div style="display:flex;flex-direction:column;width:25%;">';
                $olul .= '<img src="'.$frglul['imagen_look'].'" width="152" height="202">';
                $olul .= '<div style="display:flex;flex-direction:row;">';
                $olul .= $fM->get_input_checkbox_arr($frglul['id_look'], $frglul['tipo_look'], $frglul['id_usuario'], "arrayLookLibre[]", $arr_err, 'radio');
                $olul .= '</div></div>';
            }
    }
} else $str_errores = '<div class="error_alert">Error cargando looks</div>';

$rglut = $uM->get_looks_usuario("trabajo");
$olut = '';

if ($rglut) {
    while ($frglut = $rglut->fetch_assoc()) {
            if ($frglut['id_usuario']=='' || $frglut['id_usuario']==$id_usuario) {
                $olut .= '<div style="display:flex;flex-direction:column;width:25%;">';
                $olut .= '<img src="'.$frglut['imagen_look'].'" width="152" height="202">';
                $olut .= '<div style="display:flex;flex-direction:row;">';
                $olut .= $fM->get_input_checkbox_arr($frglut['id_look'], $frglut['tipo_look'], $frglut['id_usuario'], "arrayLookTrabajo[]", $arr_err, 'radio');
                $olut .= '</div></div>';
            }
    }
} else $str_errores = '<div class="error_alert">Error cargando looks</div>';


$rglut = $uM->get_looks_usuario("otro");

if ($rglut) {
    while ($frglut = $rglut->fetch_assoc()) {
        if ($frglut['id_usuario']==$id_usuario) {
            $looks_comentario = htmlspecialchars($frglut['comentario']);
        }
    }
} else $str_errores = '<div class="error_alert">Error cargando looks</div>';


$rguc = $uM->get_usuario_categorias($id_usuario);
$oc = '';
if ($rguc) {
    while ($frguc = $rguc->fetch_assoc()) {
            $oc .='<div style="display:flex;flex-direction:column;width:25%;">';
            $oc .='<img src="'.$frguc['imagen_categoria'].'" width="152" height="202">';
            $oc .='<div style="display:flex;flex-direction:row;">';
            $oc .= $fM->get_input_checkbox_arr($frguc['id_categoria'], $frguc['nombre_categoria'], $frguc['id_usuario'], "arrayCategorias[]", $arr_err);
            $oc .='</div></div>';
    }
} else $str_errores = '<div class="error_alert">Error cargando categorias</div>';

$rgeu = $uM->get_estilos_usuario($id_usuario);
if ($rgeu) {
    while($frgeu = $rgeu->fetch_assoc()){
        $tipo_estilo = $frgeu['tipo_estilo'];
        $color_estilo = $frgeu['color_estilo'];
        $textura_estilo = $frgeu['textura_estilo'];
        $referente_estilo = $frgeu['referente_estilo'];
        $actividad_estilo = $frgeu['actividad_estilo'];
        $profesion_estilo = $frgeu['profesion_estilo'];
        $silueta_estilo = $frgeu['silueta_estilo'];
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
        $calzado = $frgtu['calzado'];
        $tono_piel = $frgtu['tono_piel'];
        $ojos = $frgtu['color_ojos'];
        $color_pelo = $frgtu['color_pelo'];
    }
}

//LISTADO________________________________________________________________________
include_once('inc/cabecera.inc.php'); //cargando cabecera 
?>
    <script type="text/javascript">

    </script>

    <body>
        <div id="main_container">
            <div id="responsive_back_content">
                <?php include_once('inc/franja_top.inc.php'); ?>
                <?php include_once('inc/main_menu.inc.php'); ?>
                <div id="responsive_seccion_back">
                    
                </div>
                <div id="filtros_seccion">
                    <?php if (isset($str_info)) echo $str_info; ?>
                    <?php if (isset($str_errores)) echo $str_errores; ?>
                </div>
                <form action="sobre-mi.php" method="post" enctype="multipart/form-data">
                    <div style="display:flex;flex-direction:column;">
                        <div id="ttl_seccion_back">
                            <h1>
                                <img src="https://png.icons8.com/wired/50/000000/0-circle.png" width="50px"></h1>
                            <div style="clear:both;"></div>
                            <h2>El look que más va conmigo...</h2>
                            <div style="clear:both;"></div>
                        </div>
                        <div style="display:flex;flex-direction:row;flex-wrap:wrap;">
                            <?php echo $olul?>
                        </div>
                        <div style="display:flex;flex-direction:row;flex-wrap:wrap;">
                            <?php echo $olut?>
                        </div>
                        <div style="display:flex;flex-direction:row;flex-wrap:wrap;">
                        <h2>Comentario</h2>
                        <?php
                        if ($looks_comentario!='') {
                            echo '<input type="text" value="'.$looks_comentario.'" class="form-control" name="looks_comentario" placeholder="Escribe aquí" style="background-color: #d1d1d1; border-radius: 0p;">';
                        }else{
                            echo '<input type="text" class="form-control" name="looks_comentario" placeholder="Escribe aquí" style="background-color: #d1d1d1; border-radius: 0p;">';
                        }
                        ?>
                        </div>
                    </div>
                    <div style="display:flex;flex-direction:column;">
                        <div id="ttl_seccion_back">
                            <h1>
                                <img src="http://sesnineshopper.com/adstorm/img/1.png" width="50px">¿CÓMO TE GUSTA VESTIR EN TU DÍA A DÍA?</h1>
                            <div style="clear:both;"></div>
                        </div>
                        <div>
                            <h2>(Puedes escoger más de uno)</h2>
                        </div>
                        <div style="display:flex;flex-direction:row;flex-wrap:wrap;">
                            <?php echo $oc; ?>
                        </div>
                    </div>
                    <div id="responsive_seccion_back">
                        <div id="ttl_seccion_back">
                            <h1>
                                <img src="http://sesnineshopper.com/adstorm/img/2.png" width="50px">ESTILO</h1>
                            <div style="clear:both;"></div>
                        </div>
                    </div>
                    <div style="display:flex;flex-direction:column;">
                        <div style="display:flex;flex-direction:row;flex-wrap:wrap;align-items:center;">
                            <div style="display:flex;flex-direction:column;flex-wrap:wrap;width:50%;align-items:center;">
                                <div style="display:flex;flex-direction:column;flex-wrap:wrap;align-items:center;">
                                    <img src="http://sesnineshopper.com/adstorm/img/chica.png" alt="" width="38px" height="126px">
                                    <p>¿Cómo sueles vestir?</p>
                                    <div class="form-group">
                                        <?php 
                                            echo $uM->get_combo_tipo_estilo('tipo_estilo',$tipo_estilo);
                                        ?>
                                    </div>
                                </div>
                                <div style="display:flex;flex-direction:column;flex-wrap:wrap;align-items:center;">
                                    <img src="http://sesnineshopper.com/adstorm/img/estampados.png" alt="" width="158px" height="126px">
                                    <div class="form-group">
                                        <?php 
                                    echo $uM->get_combo_textura_estilo('textura_estilo',$textura_estilo);
                                    ?>
                                    </div>
                                </div>
                                <div style="display:flex;flex-direction:column;flex-wrap:wrap;align-items:center;">
                                    <img src="http://sesnineshopper.com/adstorm/img/ocio.png" alt="" width="188px" height="126px">
                                    <p>Cuéntamos tus actividades de ocio</p>
                                    <?php
                                    if ($actividad_estilo!='') {
                                        echo '<input type="text" value="'.$actividad_estilo.'" class="form-control" name="actividad_estilo" placeholder="Escribe aquí" style="background-color: #d1d1d1; border-radius: 0p;">';
                                    }else{
                                        echo '<input type="text" class="form-control" name="actividad_estilo" placeholder="Escribe aquí" style="background-color: #d1d1d1; border-radius: 0p;">';
                                    }
                                    ?>
                                </div>
                            </div>
                            <div style="display:flex;flex-direction:column;flex-wrap:wrap;width:50%;align-items:center;">
                                <div style="display:flex;flex-direction:column;flex-wrap:wrap;align-items:center;">
                                    <img src="http://sesnineshopper.com/adstorm/img/armario.png" alt="" width="94px" height="125px">
                                    <p>¿Qué colores predominan en tu armario?</p>
                                    <?php
                                    if ($color_estilo!='') {
                                        echo '<input type="text" value="'.$color_estilo.'" class="form-control" name="color_estilo" placeholder="Escribe aquí" style="background-color: #d1d1d1; border-radius: 0p;">';
                                    }else{
                                        echo '<input type="text" class="form-control" name="color_estilo" placeholder="Escribe aquí" style="background-color: #d1d1d1; border-radius: 0p;">';
                                    }
                                    ?>
                                </div>
                                <div style="display:flex;flex-direction:column;flex-wrap:wrap;align-items:center;">
                                    <img src="http://sesnineshopper.com/adstorm/img/estrella.png" alt="" width="94px" height="125px">
                                    <p>¿Te identificas o te gusta el estilo de una persona conocida?</p>
                                    <?php
                                    if ($referente_estilo!='') {
                                        echo '<input type="text" value="'.$referente_estilo.'" class="form-control" name="referente_estilo" placeholder="Escribe aquí" style="background-color: #d1d1d1; border-radius: 0p;">';
                                    }else{
                                        echo '<input type="text" class="form-control" name="referente_estilo" placeholder="Escribe aquí" style="background-color: #d1d1d1; border-radius: 0p;">';
                                    }
                                    ?>
                                </div>
                                <div style="display:flex;flex-direction:column;flex-wrap:wrap;align-items:center;">
                                    <img src="http://sesnineshopper.com/adstorm/img/maleta.png" alt="" width="94px" height="125px">
                                    <p>¿A qué te dedicas?</p>
                                    <?php
                                    if ($profesion_estilo!='') {
                                        echo '<input type="text" value="'.$profesion_estilo.'" class="form-control" name="profesion_estilo" placeholder="Escribe aquí" style="background-color: #d1d1d1; border-radius: 0p;">';
                                    }else{
                                        echo '<input type="text" class="form-control" name="profesion_estilo" placeholder="Escribe aquí" style="background-color: #d1d1d1; border-radius: 0p;">';
                                    }
                                    ?>
                                </div>
                            </div>
                            <div style="display:flex;flex-direction:row;flex-wrap:wrap;width:100%;align-items:center;">
                                <p>
                                    <img src="http://sesnineshopper.com/adstorm/img/3.png" width="50px">Mi silueta es ...</p>
                            </div>
                            <div style="display:flex;flex-direction:row;flex-wrap:wrap;align-items:center;">
                                <?php
                                for ($i=1;$i<=count($arr_texto_silueta);$i++) {
                                    $o = '';
                                    $o .=  '<div style="display:flex;flex-direction:column;flex-wrap:wrap;align-items:center;">';
                                    $o .=  '<img src="http://sesnineshopper.com/adstorm/img/silueta'.$i.'.png" height="300" width="107">';
                                    $o .=  '<label><input type="radio" value="silueta'.$i.'" name="arraySilueta[]" ';
                                    if ($silueta_estilo === "silueta".$i) $o .= 'checked>';
                                    else $o .= '>';
                                    $o .= $arr_texto_silueta[$i].'</label></div>';
                                    echo $o;
                                }
                                ?>
                            </div>
                            <div style="display:flex;flex-direction:column;flex-wrap:wrap;width:100%;align-items:center;">
                                <label><input type="file" value="img1" name="arraySiluetaImg[]"></label>
                                <label><input type="file" value="img2" name="arraySiluetaImg[]"></label>
                                <label><input type="file" value="img3" name="arraySiluetaImg[]"></label>
                                <label><input type="file" value="img4" name="arraySiluetaImg[]"></label>
                                <label><input type="file" value="img5" name="arraySiluetaImg[]"></label>
                            </div>
                            <div style="display:flex;flex-direction:row;flex-wrap:wrap;width:100%;align-items:center;">
                                <p>
                                    <img src="http://sesnineshopper.com/adstorm/img/4.png" width="50px">TALLAS
                                </p>
                            </div>
                            <div style="display:flex;flex-direction:row;width:100%;">
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
                                <div style="display:flex;flex-direction:column;flex-wrap:wrap;width:100%;margin:50px;">
                                    <img src="http://sesnineshopper.com/adstorm/img/calzado.png">
                        
                                    <?php echo $uM->get_input_array($arr_calzado,"calzado",$calzado); ?>
                                </div>
                            </div>
                            <div style="display:flex;flex-direction:row;width:100%;">
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
                    </div>
                    <div style="float:left; margin:0.8em 0;">
                        <input type="submit" style="float:none;" class="btn_aceptar" value="Aceptar" />
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>