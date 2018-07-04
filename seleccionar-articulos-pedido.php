<?php
include_once('config/config.inc.php'); //cargando archivo de configuracion
//$uM->control_sesion($ruta_inicio, ADMIN);

$fM = load_model('form');
$uM = load_model('usuario'); //uM userModel
$pM = load_model('pedido');

$id_usuario = '';
$id_pedido = '';
$ogu = '';
$str_errores = false;
$fecha_recogida = '';
$arr_err = '';

//GET___________________________________________________________________________
isset($_SESSION["id_usuario"]) ? $id_usuario=$_SESSION["id_usuario"] : "";
isset($_REQUEST["id_pedido"]) ? $id_pedido=$_REQUEST['id_pedido'] : "";
isset($_POST['fecha_recogida']) ? $fecha_recogida=date_to_mysql($_POST['fecha_recogida']) : "";

//TODO me muestra solo los seleccionados, comparar si está en el pedido y insertarlo y si no borrarlo
//GET___________________________________________________________________________

//POST__________________________________________________________________________
if(isset($_POST["arrayArticulos"])){
    $rcap = $pM->clear_articulos_pedido($id_pedido);
    if($rcap){
        $i=0;
        while($i<count($_POST["arrayArticulos"])){
            $str_errores = $pM->add_articulo_pedido($id_pedido,$_POST["arrayArticulos"][$i]);
            $i++;
        }
        if($str_errores){
            $ufrp = $pM->update_fecha_recogida_pedido($id_pedido, $fecha_recogida);
            if($ufrp){//cambiar orden y comprobar si los pedidos es igual al maximo para evitar fecha recogido //TODO
                $ruspa = $pM->update_estado_pedido_actual($id_pedido,4,3);
                if($ruspa){
                    header('Location: '.$ruta_inicio); exit();
                }else $str_errores = "No se ha podido actualizar el pedido";
            }else $str_errores = "No se ha podido actualizar la fecha de recogida del pedido";
        }else{
            $str_errores = "No se ha podido insertar un articulo";
        }
    }
}
//POST__________________________________________________________________________

//CONTROL_______________________________________________________________________
//CONTROL_______________________________________________________________________

//LISTADO_______________________________________________________________________
if(isset($_GET['id_pedido'])){
    $rtap = $pM->get_total_articulos_pedido($id_pedido);
    if ($rtap) {
        $cf = 1;
        while($frtap = $rtap->fetch_assoc()) {
                $ogu .= '<div class="table_tr row_'.$cf.'">';
                $ogu .= '<div class="left_td table_td" style="margin-left:10px;width:190px;min-width:1px;"><img width="150px" src="'.$ruta_archivos.'img/'.$frtap['ruta'].'"/></div>';
                $ogu .= '<div class="left_td center_td" style="width:320px;min-width:1px;text-align:center;">'.$frtap['nombre_articulo'].'</div>';
                $ogu .= '<div class="left_td table_td" style="width:130px;min-width:1px;"><input type="checkbox" value="'.$frtap['id_articulo'].'" name="arrayArticulos[]" checked></div>';
                //$ogu .= '<div class="left_td table_td" style="width:100px;min-width:1px;"><a href="'.$ruta_inicio.'asignar-articulos-pedido.php?id_pedido='.$fgu['id_pedido'].'"><img src="'.$ruta_inicio.'img/editpedido.png"></div>';
                $ogu .= '<div style="clear:both;"></div>'; 
                $ogu .= '</div>';
                $cf = ($cf == 1) ? 2 : 1;
        }
    } else $str_errores = '<div class="error_alert">Error cargando usuarios</div>';
}

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
        
        <form id="seleccionarArticulos" action="seleccionar-articulos-pedido.php" method="post">
            <div class="table_list">
                <h1>Paquete recibido</h1>
                <div class="table_th">
                    <div class="left_td table_td" style="margin-left:10px;width:160px;min-width:1px;">Imagen</div>
                    <div class="left_td center_td" style="width:300px;min-width:1px;text-align:center;">Nombre articulo</div>
                    <div class="left_td table_td" style="width:200px;min-width:1px;">Me lo quedo</div>
                    <div style="clear:both;"></div>
                </div>
                <?php echo $ogu; ?>
                <input style="width:0px; height:0px;" type="text" name="id_pedido" value="<?php echo $id_pedido ?>">
                <div id="fecharecogida">
                    <?php echo $fM->get_input_date('fecha_recogida', 'Fecha de recogida', $fecha_recogida, $arr_err); ?>
                </div>
            <input style="border-radius:5px;margin-left:15px;float:right;margin-top:8px;"  class="btn_aceptar bg_salmon tipogr_blanca" type="submit" Value="Guardar">
        </form>
    </section>
</div>
</body>
</html>