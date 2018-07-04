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
            $ogu .= '<tr>';
            $ogu .= '<td>'.$rgpu['id_pedido'].'</a></td>';
            $ogu .= '<td>'.mysql_to_date($rgpu['fecha_pedido']).'</td>';
            $ogu .= '<td>'.$rgpu['observaciones_pedido'].'</td>';
            $ogu .= '</tr>';
            $cf = ($cf == 1) ? 2 : 1;
    }
} else $str_errores = 'Error cargando pedidos';

//LISTADO_______________________________________________________________________

include_once('inc/cabecera.inc.php'); //cargando cabecera
?>

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
                                        <h4 class="mb-0">Mi personal shopper</h4>
                                        <div class="ml-3 mr-3">
                                            <div class="dropdown">
                                                <form action="mi-personal-shopper.php" method="post">
                                                    <?php echo $uM->get_combo_array($arr_suscripcion,"arr_suscripcion",$tipo_suscripcion,"",true); ?>
                                                </form>
                                            </div>
                                        </div>       
                                    </div>       
                                    <div class="layout-table-content">
                                            <form id="form-mi-ps" action="mi-personal-shopper.php" method="post">
                                                <?php
                                                    echo $fM->get_input_text('comentario', 'Comentario', $comentario, $arr_err);
                                                    echo $fM->get_input_date('proxima_fecha', 'Caja expedida en:', $proxima_fecha, $arr_err);
                                                    echo '<button name="personal_shopper" class="btn btn-outline-info mb-1" type="submit">Quiero mi Personal Shopper</button>';
                                                ?>
                                            </form>
                                            <form id="form-mi-ps2" action="mi-personal-shopper.php" method="post">
                                                <input style="display:none;" type="text" name="paquete_recibido_val" value="1">
                                                <?php
                                                if($id_pedido!=''){
                                                    echo '<button class="btn btn-outline-success mb-2" name="paquete_recibido" type="submit">He recibido mi paquete</button>';
                                                }
                                                ?>
                                            </form>
                                            <div class="table-responsive-sm">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th>ID Pedido</th>
                                                        <th>Fecha pedido</th>
                                                        <th>Observaciones</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php echo $ogu; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>
</body>
</html>