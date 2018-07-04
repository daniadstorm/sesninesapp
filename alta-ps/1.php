<?php
include_once('../config/config.inc.php'); //cargando archivo de configuracion
//$uM->control_sesion($ruta_inicio, ADMIN);

$fM = load_model('form');
$uM = load_model('usuario'); //uM userModel

$total_pag_form = 5;
$array = explode('/', $_SERVER['PHP_SELF']);
$nombre_fichero = array_pop($array);

$id_usuario = '';
if (isset($_SESSION['id_usuario'])) $id_usuario = $_SESSION['id_usuario'];
$tipo_estilo = '';
if (isset($_POST['tipo_estilo'])) $tipo_estilo = $_POST['tipo_estilo'];
$color_estilo = '';
if (isset($_POST['color_estilo'])) $color_estilo = $_POST['color_estilo'];
$textura_estilo = '';
if (isset($_POST['textura_estilo'])) $textura_estilo = $_POST['textura_estilo'];
$referente_estilo = '';
if (isset($_POST['referente_estilo'])) $referente_estilo = $_POST['referente_estilo'];

$arr_err = '';
$arrayCategorias = '';

//GET___________________________________________________________________________
//GET___________________________________________________________________________

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
        $raeu=$uM->add_estilo_usuario($id_usuario, $tipo_estilo, $color_estilo, $textura_estilo, $referente_estilo);
        if (!$raeu) {
            $str_errores = '<div class="error_alert">Error guardando estilos</div>';
        } 
    } else $str_errores = '<div class="error_alert">Error eliminando estilos de usuario</div>';
}

if(isset($_POST['tipo_estilo']) && $str_errores==''){
    header('Location: '.$ruta_inicio.'alta-ps/2.php'); exit();
}

//POST__________________________________________________________________________

//LISTADO__________________________________________________________________________

$header_pag = '<div class="flex-container-row">';
for($i=1;$i<=$total_pag_form;$i++){
    $header_pag .= '<div ';
    ($nombre_fichero==$i.".php") ? $header_pag .= 'class="bg_salmon tipogr_blanca flex-container-center" ' : $header_pag .= 'class="flex-container-center"';
    $header_pag .= 'style="width: 100%; padding: 0.5em;">'.$i.'</div>';
}

$rguc = $uM->get_usuario_categorias($id_usuario);
$oc = '';
if ($rguc) {
    while ($frguc = $rguc->fetch_assoc()) {
        $oc .= '<div class="flex-container-column div-input-img-selected">';
        $oc .= $fM->get_input_checkbox_arr_selected_img($frguc['id_categoria'], $frguc['imagen_categoria'], $frguc['id_usuario'], "arrayCategorias[]", $arr_err);
        $oc .= '<div style="color:#ff6666; font-weight:bold; padding:5px; text-align:center;">'.$frguc['nombre_categoria'].'</div>';
        $oc .= '</div>';
    }
} else $str_errores = '<div class="error_alert">Error cargando categorias</div>';

$rgue = $uM->get_estilos_usuario($id_usuario);
$oeu = '';
if ($rgue) {
    while ($frgue = $rgue->fetch_assoc()) {
        $color_estilo = $frgue["color_estilo"];
        $tipo_estilo = $frgue["tipo_estilo"];
        $textura_estilo = $frgue["textura_estilo"];
        $referente_estilo = $frgue["referente_estilo"];
    }
}


//LISTADO__________________________________________________________________________

//CONTROL_______________________________________________________________________
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
                        <form action="1.php" method="post">
                            <div class="flex-container-center">
                                <h1>¿COMO TE GUSTA VESTIR EN TU DIA A DIA?</h1>
                            </div>
                            <div class="flex-container-sa">
                                <?php echo $oc ?>                              
                            </div>
                            <div class="flex-container-center">
                                <h1>¿COMO SUELES VESTIR?</h1>
                            </div>
                            <div class="flex-container-sa">
                                <div class="flex-container-column">
                                    <div style="width:10em;">
                                        <img src="http://sesnineshopper.com/adstorm/img/chica.png" alt="" width="38px" height="126px">
                                        <p>¿Cómo sueles vestir?</p>
                                        <div class="form-group">
                                            <?php 
                                                echo $uM->get_combo_tipo_estilo('tipo_estilo',$tipo_estilo);
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex-container-column">
                                    <div style="width:10em;">
                                    <img src="http://sesnineshopper.com/adstorm/img/armario.png" alt="" width="94px" height="125px">
                                    <p>¿Qué colores predominan en tu armario?</p>
                                    <?php
                                    if ($color_estilo!='') echo '<input type="text" value="'.$color_estilo.'" class="form-control" name="color_estilo" placeholder="Escribe aquí" style="background-color: #d1d1d1; border-radius: 0p;">';
                                    else echo '<input type="text" class="form-control" name="color_estilo" placeholder="Escribe aquí" style="background-color: #d1d1d1; border-radius: 0p;">';
                                    ?>
                                    </div>
                                </div>
                                <div class="flex-container-column">
                                    <div style="width:10em;">
                                        <img src="http://sesnineshopper.com/adstorm/img/estampados.png" alt="" width="158px" height="126px">
                                        <div class="form-group">
                                            <?php 
                                        echo $uM->get_combo_textura_estilo('textura_estilo',$textura_estilo);
                                        ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex-container-column">
                                    <div style="width:10em;">
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
                                </div>
                            </div>
                            <div class="flex-container-sa">

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