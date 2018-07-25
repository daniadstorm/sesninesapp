<?php
include_once('config/config.inc.php'); //cargando archivo de configuracion
//$uM->control_sesion($ruta_inicio, ADMIN);

$fM = load_model('form');
$uM = load_model('usuario'); //uM userModel
$iM = load_model('inputs');

$nombre_usuario = '';

$arr_err = array();
$verif = true;

$id_usuario = '';
$nombre = '';
$direccion = '';
$cp = '';
$poblacion = '';
$provincia = '';
$hora_inicio = '';
$minuto_inicio = '';
$hora_fin = '';
$minuto_fin = '';



if (isset($_SESSION['id_usuario'])) {
    
    $id_usuario = $_SESSION['id_usuario'];
    $rgud = $uM->get_destino_usuario($id_usuario);
    //echo $rgud;
    if ($rgud) {
        while($fgud = $rgud->fetch_assoc()){
            $nombre = $fgud['nombre'];
            $direccion = $fgud['direccion'];
            $cp = $fgud['cp'];
            $poblacion = $fgud['poblacion'];
            $provincia = $fgud['provincia'];
            $arr_hora_inicio = explode(':',$fgud['fecha_hora_inicio']);
            $hora_inicio = $arr_hora_inicio[0];
            $minuto_inicio = $arr_hora_inicio[1];
            $arr_hora_fin = explode(':',$fgud['fecha_hora_fin']);
            $hora_fin = $arr_hora_fin[0];
            $minuto_fin = $arr_hora_fin[1];
        }
    } else $str_errores = $str_errores = '<div class="error_alert">Error cargando datos</div>';

}

//GET___________________________________________________________________________

//GET___________________________________________________________________________

//POST__________________________________________________________________________

if (isset($_POST['id_usuario'])) {
    
    $id_usuario = $_POST['id_usuario'];
    $nombre = $_POST['nombre'];
    $direccion = $_POST['direccion'];
    $cp = $_POST['cp'];
    $poblacion = $_POST['poblacion'];
    $provincia = $_POST['provincia'];
    $hora_inicio = $_POST['hora_inicio'];
    $minuto_inicio = $_POST['minuto_inicio'];
    $hora_fin = $_POST['hora_fin'];
    $minuto_fin = $_POST['minuto_fin'];
    //MySQL -----------------------------------------------------------------
    $rcud = $uM->clear_destino_usuario($id_usuario);
    if($rcud){
        $uM->add_destino_usuario($id_usuario, $nombre, $direccion, $cp, $poblacion, $provincia, $hora_inicio.':'.$minuto_inicio, $hora_fin.':'.$minuto_fin);
    }

    //MySQL -----------------------------------------------------------------
}
//POST__________________________________________________________________________

//CONTROL_______________________________________________________________________

//CONTROL_______________________________________________________________________

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
                                    <h4>Datos de envio</h4>
                                </div>
                                <div class="layout-table-content">
                                    <form method="post">
                                    <?php
                                        echo $fM->get_input_hidden('id_usuario', $id_usuario);
                                        echo $fM->get_input_text('nombre', 'Nombre', $nombre, $arr_err);
                                        echo $fM->get_input_text('direccion', 'Direccion', $direccion, $arr_err);
                                        echo $fM->get_input_text('cp', 'Codigo postal', $cp, $arr_err);
                                        echo $fM->get_input_text('poblacion', 'Poblacion', $poblacion, $arr_err);
                                        echo $fM->get_input_text('provincia', 'Provincia', $provincia, $arr_err);
                                        echo '<div class="form-group">Hora inicio<br><div class="d-flex">'.combo_horas("hora_inicio",$hora_inicio,"form-control col-1").combo_minutos("minuto_inicio",$minuto_inicio,"form-control col-1").'</div></div>';
                                        echo '<div class="form-group">Hora fin<br><div class="d-flex">'.combo_horas("hora_fin",$hora_fin,"form-control col-1").combo_minutos("minuto_fin",$minuto_fin,"form-control col-1").'</div></div>';
                                    ?>
                                    <button class="btn bg-primary text-light">Guardar cambios</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</body>

<!-- <body>
<div id="main_container">
    <div id="responsive_back_content">
        <?php include_once('inc/franja_top.inc.php'); ?>
        <?php include_once('inc/main_menu.inc.php'); ?>
        <div id="responsive_seccion_back">

            <section class="section_top">
            <div class="menu_top">
                <h2>Datos envio</h2>
            </div>
        </section>
            <section class="middle_section">
                <div class="responsive_seccion">
                    <div id="filtros_seccion">
                        <?php if (isset($str_info)) echo $str_info; ?>
                        <?php if (isset($str_errores)) echo $str_errores; ?>
                    </div>
                    <div id="filtros_seccion">
                    <form action="datos-envio.php" method="post">
                    <div class="login_form">
                        <?php 
                            echo $fM->get_input_hidden('id_usuario', $id_usuario);
                            echo $fM->get_input_text('nombre', 'Nombre', $nombre, $arr_err);
                            echo $fM->get_input_text('direccion', 'Direccion', $direccion, $arr_err);
                            echo $fM->get_input_text('cp', 'Codigo postal', $cp, $arr_err);
                            echo $fM->get_input_text('poblacion', 'Poblacion', $poblacion, $arr_err);
                            echo $fM->get_input_text('provincia', 'Provincia', $provincia, $arr_err);
                            echo '<div class="form-group">Hora inicio<br>'.combo_horas("hora_inicio",$hora_inicio).combo_minutos("minuto_inicio",$minuto_inicio).'</div>';
                            echo '<div class="form-group">Hora fin<br>'.combo_horas("hora_fin",$hora_fin).combo_minutos("minuto_fin",$minuto_fin).'</div>';
                        ?>
                        <div style="float:right; margin:0.8em 0;">
                            <input type="submit" style="float:none;" class="btn_aceptar" value="Aceptar" />
                        </div>
                        <div style="clear:both;"></div>
                    </div>
                </form></div>
                </div>
            </section>
            
        </div>
    </div>
</div>
</body> -->
</html>