<?php
include_once('config/config.inc.php'); //cargando archivo de configuracion
$uM = load_model('usuario');
$uM->control_sesion($ruta_inicio, ADMIN);

$fM = load_model('form');
$hM = load_model('html');
$catM = load_model('categorias');

//campos formulario
$id_categoria = 0;
$nombre_categoria = '';
$imagen_categoria = '';

$arr_err = array();
$verif = true;

//POST__________________________________________________________________________
if (isset($_POST['id_categoria'])) {
    
    $id_categoria = $_POST['id_categoria'];
    $nombre_categoria = $_POST['nombre_categoria'];
    $imagen_categoria = $_POST['imagen_categoria'];
    
    
    //control de errores ---------------------------------------------------- */
    //control de errores ---------------------------------------------------- */
    
    //MySQL ----------------------------------------------------------------- */
    if ($verif == true) {
        
        //id_categoria
        $nombre_categoria = $catM->escstr($nombre_categoria);
        $imagen_categoria = $catM->escstr($imagen_categoria);
        
        //upload de img
        
        if ($id_categoria > 0) { //UPDATE
            $ruc = $catM->update_categoria($id_categoria, $nombre_categoria, $imagen_categoria);
            if ($ruc) {
                header('Location: '.$ruta_inicio.'categorias.php?editar_categoria=true'); exit();
            } else $str_errores = $hM->get_alert_danger('Error actualizando categoría');
        } else { //NUEVO
            $rac = $catM->add_categoria($nombre_categoria, $imagen_categoria);
            if ($rac) {
                header('Location: '.$ruta_inicio.'categorias.php?nuevo_usuario=true'); exit();
            } else $str_errores = $hM->get_alert_danger('Error añadiendo categoría');
        }
    }
    //MySQL ----------------------------------------------------------------- */
}
//POST__________________________________________________________________________

//GET___________________________________________________________________________
if (isset($_REQUEST['id_categoria'])) {
    
    $id_categoria = $_REQUEST['id_categoria'];
    
    $rgctr = $catM->get_categoria();
    
    if ($rgu) {
        while ($fgu = $rgu->fetch_assoc()) {
            $nombrecompleto_usuario = $fgu['nombrecompleto_usuario'];
            $email_usuario = $fgu['email_usuario'];
            $fecha_nacimiento = $fgu['fecha_nacimiento'];
            $contrasenya_usuario = $fgu['contrasenya_usuario'];
            $telf_usuario = $fgu['telf_usuario'];
            $nie_usuario = $fgu['nie_usuario'];
        }
    } else $str_errores = $str_errores = '<div class="error_alert">Error cargando usuario</div>';
}
//GET___________________________________________________________________________

//COMBOS________________________________________________________________________

//COMBOS________________________________________________________________________

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
                                    <h4>Nuevo cliente</h4>
                                </div>
                                <div class="layout-table-content">
                                    <form action="nuevo-cliente.php" method="post">
                                        hey
                                        <input pattern=".{3,}"   required title="3 characters minimum john boy">
                                    <?php 
                                        echo $fM->get_input_hidden('id_usuario', $id_usuario);
                                        echo $fM->get_input_text('nombrecompleto_usuario', 'Nombre completo', $nombrecompleto_usuario, $arr_err);
                                        echo $fM->get_input_text('email_usuario', 'Email', $email_usuario, $arr_err);
                                        echo $fM->get_input_date('fecha_nacimiento', 'Fecha de nacimiento', $fecha_nacimiento, $arr_err);
                                        echo $fM->get_input_text('contrasenya_usuario', 'Contraseña', $contrasenya_usuario, $arr_err);
                                        echo $fM->get_input_text('telf_usuario', 'Telefono', $telf_usuario, $arr_err);
                                        echo $fM->get_input_text('nie_usuario', 'DNI / NIE', $nie_usuario, $arr_err);
                                    ?>
                                    <button class="btn bg-primary text-light">Aceptar</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<!-- <div id="main_container">
    <div id="responsive_back_content">
        <?php include_once('inc/franja_top.inc.php'); ?>
        <?php include_once('inc/main_menu.inc.php'); ?>
        <div id="responsive_seccion_back">
            
            <div id="ttl_seccion_back">
                <h2>Nuevo Usuario</h2>
                <div style="clear:both;"></div>
            </div>
            
            <div id="filtros_seccion">
                <?php if (isset($str_info)) echo $str_info; ?>
                <?php if (isset($str_errores)) echo $str_errores; ?>
            </div>
            <div id="filtros_seccion">
                <form action="nuevo-cliente.php" method="post" id="form_tiendasvf_valores" name="form_tiedasvf_valores">
                    <div class="login_form">
                        <?php 
                            echo $fM->get_input_hidden('id_usuario', $id_usuario);
                            echo $fM->get_input_text('nombrecompleto_usuario', 'Nombre completo', $nombrecompleto_usuario, $arr_err);
                            echo $fM->get_input_text('email_usuario', 'Email', $email_usuario, $arr_err);
                            echo $fM->get_input_date('fecha_nacimiento', 'Fecha de nacimiento', $fecha_nacimiento, $arr_err);
                            echo $fM->get_input_text('contrasenya_usuario', 'Contraseña', $contrasenya_usuario, $arr_err);
                            echo $fM->get_input_text('telf_usuario', 'Telefono', $telf_usuario, $arr_err);
                            echo $fM->get_input_text('nie_usuario', 'DNI / NIE', $nie_usuario, $arr_err);
                        ?>
                        <div style="float:right; margin:0.8em 0;">
                            <input type="submit" style="float:none;" class="btn_aceptar" value="Aceptar" />
                        </div>
                        <div style="clear:both;"></div>
                    </div>
                </form>
            </div>
            
        </div>
    </div>
</div> -->
</body>
</html>