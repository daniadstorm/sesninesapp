<?php
include_once('config/config.inc.php'); //cargando archivo de configuracion
//$uM->control_sesion($ruta_inicio, ADMIN);

$fM = load_model('form');
$uM = load_model('usuario'); //uM userModel
$pM = load_model('pedido'); //pM pedidosModel

$ps_completo = '';
$tipo_suscripcion = '';
$id_usuario = '';
$personal_shopper = '';
$proxima_fecha = '';
$arr_err = '';
$id_pedido = '';
$comentario = '';

$arr_suscripcion = array(
    "ninguna" => "Ninguna",
    "mensual" => "Mensual",
    "bimensual" => "Bimensual",
    "3meses" => "3 Meses",
    "6meses" => "6 Meses",
);

(isset($_SESSION['id_usuario'])) ? $id_usuario=$_SESSION['id_usuario'] : ''; 

//GET___________________________________________________________________________
//GET___________________________________________________________________________

//POST__________________________________________________________________________

if(isset($_POST["arr_suscripcion"])){
    $tipo_suscripcion=$_POST["arr_suscripcion"];
    $rus = $uM->update_suscripcion($id_usuario, $tipo_suscripcion);
    if(!$rus) $str_errores = '<div class="error_alert">Error actualizando suscripción</div>';
}

(isset($_POST['comentario'])) ? $comentario=$_POST['comentario'] : "";

if(isset($_POST["personal_shopper"])){
    /*$rgpp = $pM->get_pedidos_personalshopper($id_usuario, 0);
    if($rgpp){
        $rapd = '';
        ($rgpp->num_rows==0) ? $rapd = $pM->add_pedido_personalshopper($id_usuario) : $str_errores = '<div class="error_alert">Ya hay un pedido en curso</div>';
        if($rapd){
            header('Location: '.$ruta_inicio.'mi-personal-shopper.php');
        }else if($rapd!='') $str_errores = '<div class="error_alert">Error añadiendo pedido</div>';
    }*/
    $rapd = '';
    $rapd = $pM->add_pedido_personalshopper($id_usuario, $comentario);
    if($rapd){
         header('Location: '.$ruta_inicio.'mi-personal-shopper.php');
    }else if($rapd!='') $str_errores = '<div class="error_alert">Error añadiendo pedido</div>';
}

//POST__________________________________________________________________________

//CONTROL_______________________________________________________________________
$rgu = $uM->get_user($_SESSION["id_usuario"]);
if($rgu){
    while($fgu = $rgu->fetch_assoc()){
        $ps_completo=$fgu["ps_completo"];
        $tipo_suscripcion=$fgu["tipo_suscripcion"];
    }
}
if(!$ps_completo){
    header('Location: '.$ruta_inicio.'sobre-mi.php'); exit();
}
$rgpp = $uM->get_proximo_paquete($_SESSION['id_usuario']);
if($rgpp){
    while($fgpp = $rgpp->fetch_assoc()){
        $proxima_fecha = mysql_to_date($fgpp['fecha_lastmod_pedido']);
        $id_pedido = $fgpp['id_pedido'];
    }
}
if(isset($_POST["paquete_recibido_val"])){
    $ruep = $pM->update_estado_pedido_actual($id_pedido,3,2);//todo cambiar orden en el que se ejecuta el control
    if($ruep){
        header('Location: '.$ruta_inicio.'seleccionar-articulos-pedido.php?id_pedido='.$id_pedido); exit();
    }
}


//CONTROL_______________________________________________________________________

//LISTADO_______________________________________________________________________
$rpu = $pM->get_pedidos_usuario($id_usuario);
$ogu = '';
if ($rpu) {
    $cf = 1;
    while($rgpu = $rpu->fetch_assoc()) {
            $ogu .= '<div class="table_tr row_'.$cf.'">';
            $ogu .= '<div class="left_td table_td" style="margin-left:10px;width:230px;min-width:1px;">'.$rgpu['id_pedido'].'</a></div>';
            $ogu .= '<div class="left_td center_td" style="width:220px;min-width:1px;text-align:center;">'.mysql_to_date($rgpu['fecha_pedido']).'</div>';
            $ogu .= '<div class="left_td table_td" style="width:126px;min-width:1px;">'.$rgpu['observaciones_pedido'].'</div>';
            $ogu .= '<div style="clear:both;"></div>'; 
            $ogu .= '</div>';
            $cf = ($cf == 1) ? 2 : 1;
    }
} else $str_errores = '<div class="error_alert">Error cargando pedidos</div>';

//LISTADO_______________________________________________________________________

include_once('inc/cabecera.inc.php'); //cargando cabecera
?>

<body>
<div id="main_container">
    <?php include_once('inc/franja_top.inc.php'); ?>
    <?php include_once('inc/main_menu.inc.php'); ?>
    <section class="section_top"></section>
    <section class="sep_section"></section>
    <section class="middle_section">
        <div class="responsive_seccion">
            <div id="filtros_seccion">
                <?php if (isset($str_info)) echo $str_info; ?>
                <?php if (isset($str_errores)) echo $str_errores; ?>
            </div>
            <div id="filtros_seccion"></div>
        </div>
        <div class="campo">
            <div style="float:left;">
                <form id="form-mi-ps" action="mi-personal-shopper.php" method="post">
                    <?php
                    echo $uM->get_combo_array($arr_suscripcion,"arr_suscripcion",$tipo_suscripcion,"btn_aceptar bg_salmon tipogr_blanca",true);
                    echo '<br>';
                    echo $fM->get_input_text('comentario', 'Comentario', $comentario, $arr_err);
                    echo '<input style="border-radius:5px;" class="btn_aceptar bg_salmon tipogr_blanca" name="personal_shopper" type="submit" Value="Quiero mi Personal Shopper"></input>';
                    echo $fM->get_input_date('proxima_fecha', 'Caja expedida en:', $proxima_fecha, $arr_err);
                    //echo $uM->get_combo_array($arr_personal_shopper,"arr_personal_shopper",$personal_shopper,"btn_aceptar bg_salmon tipogr_blanca",true);
                    ?>
                    
                </form>
                <form id="form-mi-ps2" action="mi-personal-shopper.php" method="post">
                    <input style="display:none;" type="text" name="paquete_recibido_val" value="1">
                    <?php
                    if($id_pedido!=''){
                        echo '<input style="border-radius:5px;" class="btn_aceptar bg_salmon tipogr_blanca" name="paquete_recibido" type="submit" Value="He recibido mi paquete"></input>';
                    }
                    ?>
                </form>
                
            </div>
            <div style="clear:both;"></div>
            <div class="table_list">
                <div class="table_th">
                    <div class="left_td table_td" style="margin-left:10px;width:190px;min-width:1px;">ID Pedido</div>
                    <div class="left_td center_td" style="width:320px;min-width:1px;text-align:center;">Fecha pedido</div>
                    <div class="left_td table_td" style="width:306px;min-width:1px;">Observaciones</div>
                    <div style="clear:both;"></div>
                </div>
                <?php echo $ogu; ?>
            </div>
        </div>
    </section>
</div>
</body>
</html>