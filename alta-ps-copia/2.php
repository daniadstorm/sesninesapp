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
$actividad_estilo = '';
if (isset($_POST['actividad_estilo'])) $actividad_estilo = $_POST['actividad_estilo'];
$profesion_estilo = '';
if (isset($_POST['profesion_estilo'])) $profesion_estilo = $_POST['profesion_estilo'];
$tienes_hijos = '';
if (isset($_POST['tienes_hijos'])) $tienes_hijos = $_POST['tienes_hijos'];
//GET___________________________________________________________________________
//GET___________________________________________________________________________

//POST__________________________________________________________________________
if (isset($_POST['actividad_estilo'])) {
    $rcsu=$uM->clear_sobremi_usuario($id_usuario);
    if ($rcsu) {
        $raeu=$uM->add_sobremi_usuario($id_usuario, $actividad_estilo, $profesion_estilo, $tienes_hijos);
        if (!$raeu) {
            $str_errores = '<div class="error_alert">Error guardando datos</div>';
        } 
    } else $str_errores = '<div class="error_alert">Error eliminando datos de usuario</div>';
}
//POST__________________________________________________________________________

//LISTADO__________________________________________________________________________
$header_pag = '<div class="flex-container-row">';
for($i=1;$i<=$total_pag_form;$i++){
    $header_pag .= '<div ';
    ($nombre_fichero==$i.".php") ? $header_pag .= 'class="bg_salmon tipogr_blanca flex-container-center" ' : $header_pag .= 'class="flex-container-center"';
    $header_pag .= 'style="width: 100%; padding: 0.5em;">'.$i.'</div>';
}

$rgsu = $uM->get_sobremi_usuario($id_usuario);
if ($rgsu) {
    while ($frgsu = $rgsu->fetch_assoc()) {
        print_r($frgsu);
        $actividad_estilo = $frgsu['actividad_estilo'];
        $profesion_estilo = $frgsu['profesion_estilo'];
        $tienes_hijos = $frgsu['tienes_hijos'];
    }
} else $str_errores = '<div class="error_alert">Error cargando datos sobre mi</div>';

if(isset($_POST['actividad_estilo']) && $str_errores==''){
    header('Location: '.$ruta_inicio.'alta-ps/3.php'); exit();
}

//LISTADO__________________________________________________________________________

//CONTROL_______________________________________________________________________
if(isset($_SERVER["HTTP_REFERER"])){
    $array = explode('/', $_SERVER["HTTP_REFERER"]);
    $ruta_anterior = array_pop($array);
    if(!$ruta_anterior=="1.php"){
        header('Location: '.$ruta_inicio.'alta-ps/1.php'); exit();
    }
}else{
    header('Location: '.$ruta_inicio.'alta-ps/1.php'); exit();
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
                        <form action="2.php" method="post">
                            <div class="flex-container-center">
                                <h1>Sobre mí</h1>
                            </div>
                            <div class="flex-container-sa">
                                <div class="flex-container-column">
                                    <img src="http://sesnineshopper.com/adstorm/img/ocio.png" alt="" width="188px" height="126px">
                                    <p>Cuéntamos tus actividades de ocio</p>
                                    <?php
                                    if ($actividad_estilo!='') echo '<input type="text" value="'.$actividad_estilo.'" class="form-control" name="actividad_estilo" placeholder="Escribe aquí" style="background-color: #d1d1d1; border-radius: 0p;">';
                                    else echo '<input type="text" class="form-control" name="actividad_estilo" placeholder="Escribe aquí" style="background-color: #d1d1d1; border-radius: 0p;">';
                                    
                                    ?>
                                </div>
                                <div class="flex-container-column">
                                    <img src="http://sesnineshopper.com/adstorm/img/maleta.png" alt="" width="94px" height="125px">
                                    <p>¿A qué te dedicas?</p>
                                    <?php
                                    if ($profesion_estilo!='') echo '<input type="text" value="'.$profesion_estilo.'" class="form-control" name="profesion_estilo" placeholder="Escribe aquí" style="background-color: #d1d1d1; border-radius: 0p;">';
                                    else echo '<input type="text" class="form-control" name="profesion_estilo" placeholder="Escribe aquí" style="background-color: #d1d1d1; border-radius: 0p;">';
                                    ?>
                                </div>
                                <div class="flex-container-column"><!-- https://png.icons8.com/ultraviolet/80/000000/boy.png -->
                                    <img src="https://png.icons8.com/ultraviolet/80/000000/boy.png" alt="" width="80px" height="80px">
                                    <p>¿Tienes hijos?</p>
                                    <?php
                                        echo $uM->get_combo_hijos('tienes_hijos',$tienes_hijos);
                                    ?>
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