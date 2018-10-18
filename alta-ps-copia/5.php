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
$look_asesoria = '';
if (isset($_POST['look_asesoria'])) $look_asesoria = $_POST['look_asesoria'];
$razon_ps = '';
if (isset($_POST['razon_ps'])) $razon_ps = $_POST['razon_ps'];
$comentario = '';
if (isset($_POST['comentario'])) $comentario = $_POST['comentario'];
//GET___________________________________________________________________________
//GET___________________________________________________________________________

//POST__________________________________________________________________________
if (isset($_POST['look_asesoria'])) {
    $rctu=$uM->clear_categorias_miarmario($id_usuario);
    if ($rctu) {
        $ratu=$uM->add_asesorame_usuario($id_usuario, $look_asesoria, $razon_ps, $comentario);
        if (!$ratu) {
            $str_errores = '<div class="error_alert">Error guardando asesoría</div>';
        }
    } else $str_errores = '<div class="error_alert">Error eliminando asesoría</div>';
}
//POST__________________________________________________________________________

//LISTADO__________________________________________________________________________
$header_pag = '<div class="flex-container-row">';
for($i=1;$i<=$total_pag_form;$i++){
    $header_pag .= '<div ';
    ($nombre_fichero==$i.".php") ? $header_pag .= 'class="bg_salmon tipogr_blanca flex-container-center" ' : $header_pag .= 'class="flex-container-center"';
    $header_pag .= 'style="width: 100%; padding: 0.5em;">'.$i.'</div>';
}

$rgtu = $uM->get_asesorame_usuario($id_usuario);
if ($rgtu) {
    while($frgtu = $rgtu->fetch_assoc()){
        $look_asesoria = $frgtu['look_asesoria'];
        $razon_ps = $frgtu['razon_ps'];
        $comentario = $frgtu['comentario'];
    }
}

if(isset($_POST['look_asesoria']) && $str_errores==''){
    $upc = $uM->update_pscompleto($id_usuario,1);
    ($upc) ? header('Location: '.$ruta_inicio.'mi-personal-shopper.php') : "";
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
                        <form action="5.php" method="post">
                            <div class="flex-container-center">
                                <h1>Sobre mí</h1>
                            </div>
                            <div class="flex-container-sa">
                                <div class="flex-container-column">
                                <div style="display:flex;flex-direction:column;flex-wrap:wrap;align-items:center;">
                                    <p>¿Para qué looks necesitas la asesoría?</p>
                                    <?php
                                    if ($look_asesoria!='') {
                                        echo '<input type="text" value="'.$look_asesoria.'" class="form-control" name="look_asesoria" placeholder="Escribe aquí" style="background-color: #d1d1d1; border-radius: 0p;">';
                                    }else{
                                        echo '<input type="text" class="form-control" name="look_asesoria" placeholder="Escribe aquí" style="background-color: #d1d1d1; border-radius: 0p;">';
                                    }
                                    ?>
                                </div>
                                <div style="display:flex;flex-direction:column;flex-wrap:wrap;align-items:center;">
                                    <p>Me apetece pedir mi PS porque..</p>
                                    <?php
                                    if ($razon_ps!='') {
                                        echo '<input type="text" value="'.$razon_ps.'" class="form-control" name="razon_ps" placeholder="Escribe aquí" style="background-color: #d1d1d1; border-radius: 0p;">';
                                    }else{
                                        echo '<input type="text" class="form-control" name="razon_ps" placeholder="Escribe aquí" style="background-color: #d1d1d1; border-radius: 0p;">';
                                    }
                                    ?>
                                </div>
                                <div style="display:flex;flex-direction:column;flex-wrap:wrap;align-items:center;">
                                    <p>Comentarios</p>
                                    <?php
                                    if ($comentario!='') {
                                        echo '<input type="text" value="'.$comentario.'" class="form-control" name="comentario" placeholder="Escribe aquí" style="background-color: #d1d1d1; border-radius: 0p;">';
                                    }else{
                                        echo '<input type="text" class="form-control" name="comentario" placeholder="Escribe aquí" style="background-color: #d1d1d1; border-radius: 0p;">';
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