<?php
include_once('config/config.inc.php'); //cargando archivo de configuracion
$uM = load_model('usuario');
$uM->control_sesion($ruta_inicio, ADMIN);

$fM = load_model('form');
$sM = load_model('slider');

//campos formulario
$id_usuario = '';
$titulo_slider = '';
$tipo_slider = '';
$arr_err = array();

$arr_tipo_slider = array(
    'Home' => 'home',
);


(isset($_SESSION['id_usuario'])) ? $id_usuario=$_SESSION['id_usuario'] : "";
(isset($_POST['titulo_slider'])) ? $titulo_slider=$_POST['titulo_slider'] : "";
(isset($_POST['tipo_slider'])) ? $tipo_slider=$_POST['tipo_slider'] : "";


//POST__________________________________________________________________________
if (isset($_FILES['arraySiluetaImg'])) {
    $cantidad = count($_FILES['arraySiluetaImg']['tmp_name']);//Recibe un array de FILES que se hace poniendo el mismo name a todos los input[type="file"]
    for ($i=0;$i<$cantidad;$i++) {//Recorre el bucle
        if($_FILES['arraySiluetaImg']['name'][$i]!=""){//Si está vacio es que no ha insertado ninguna imagen por lo tanto no hace las siguientes comprobaciones
            $imagenInfo = getimagesize($_FILES['arraySiluetaImg']['tmp_name'][$i]);//Saca el mime "type" pero que no se puede modificar
            if ($imagenInfo['mime']=='image/png' || $imagenInfo['mime']=='image/jpeg') {//Si tiene una de las siguientes extensiones es que es imagen
                $res = move_uploaded_file($_FILES['arraySiluetaImg']['tmp_name'][$i],$document_root.'img/slider/'.$_FILES['arraySiluetaImg']['name'][$i]);
                if ($res) {
                    $result_img = $sM->add_slider($titulo_slider,$_FILES['arraySiluetaImg']['name'][$i], $tipo_slider);
                    if (!$result_img) {
                        $str_errores = '<div class="error_alert">Error añadiendo el slider</div>';
                    }else{
                        header('Location: '.$ruta_inicio); exit();
                    }
                }
            }else $str_errores = '<div class="error_alert">El archivo no es de tipo imagen</div>';           
        }
    }
}
//POST__________________________________________________________________________

//GET___________________________________________________________________________
//GET___________________________________________________________________________

//COMBOS________________________________________________________________________
//COMBOS________________________________________________________________________

include_once('inc/cabecera.inc.php'); //cargando cabecera 
?>
<script type="text/javascript">
    
</script>
<body>
<div id="main_container">
    <div id="responsive_back_content">
        <?php include_once('inc/franja_top.inc.php'); ?>
        <?php include_once('inc/main_menu.inc.php'); ?>
        <section class="section_top">
        </section>
        <div id="responsive_seccion_back">
            <div class="middle_section">
            <div id="ttl_seccion_back">
                <h2>Añadir slider</h2>
                <div style="clear:both;"></div>
            </div>
            <div id="filtros_seccion">
                <?php if (isset($str_info)) echo $str_info; ?>
                <?php if (isset($str_errores)) echo $str_errores; ?>
            </div>
            <div class="campo">
                <div style="float:left;"></div>
                <div style="clear:both;"></div>
            </div>
            <div class="table_list">
                <form action="new-slider.php" method="post" id="form_slider" name="form_slider" enctype="multipart/form-data"> 
                    <div class="form_slider">
                        <?php 
                            echo $fM->get_input_text('titulo_slider', 'Titulo slider', $titulo_slider, $arr_err);
                            echo $uM->get_combo_array($arr_tipo_slider,"tipo_slider");
                        ?>
                        <div class="flex-container-sa">
                            <div class="flex-container-row">
                                <label><input type="file" value="img1" name="arraySiluetaImg[]"></label>
                            </div>
                            </div>
                        <div class="campo">
                            <div style="float:right;">
                                <input type="submit" class="btn_aceptar bg_salmon tipogr_blanca" value="ACEPTAR" />
                            </div>
                            <div style="clear:both;"></div>
                        </div>
                    </div>
                </form>
            </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>