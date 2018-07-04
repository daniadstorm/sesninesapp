<?php
include_once('config/config.inc.php'); //cargando archivo de configuracion

$uM = load_model('usuario');
$uM->control_sesion($ruta_inicio, ADMIN);

$pM = load_model('pedido');
$pagM = load_model('paginado');

$ogu = '';
$pagM->regs_x_pag=20;
$pagM->pag=0;
//$pagM->regs_x_pag=1;

$arr_filtro = array(//Estados
    0 => "PENDIENTE",
    1 => "LISTO PARA ENVIAR",
    2 => "ENVIADO",
    3 => "RECIBIDO",
    4 => "CHECK OUT REALIZADO",
);
$arr_filtro_ps = 0;


//GET___________________________________________________________________________
if (isset($_GET['nuevo_usuario']) && $_GET['nuevo_usuario'] == 'true') $str_info = $hM->get_alert_success('Usuario añadido');
if (isset($_GET['editar_usuario']) && $_GET['editar_usuario'] == 'true') $str_info = $hM->get_alert_success('Usuario actualizado');
if (isset($_GET['eliminar_usuario']) && $_GET['eliminar_usuario'] == 'true') $str_info = $hM->get_alert_success('Usuario eliminado');
if ((isset($_GET['cambiar_estado']) && $_GET['cambiar_estado']==2) && isset($_GET['id_pedido'])) $pM->update_estado_pedido($_GET['id_pedido'],2);
if(isset($_REQUEST['arr_filtro'])){
    $arr_filtro_ps=$_REQUEST['arr_filtro'];
    $str_ruta = $ruta_inicio.'pedidos.php?arr_filtro='.$arr_filtro_ps.'&';
}else{
    $str_ruta = $ruta_inicio.'pedidos.php?';
}

if (isset($_GET['pag'])) {
    $pagM->pag=$_GET['pag'];
}


//GET___________________________________________________________________________

//POST__________________________________________________________________________

//POST__________________________________________________________________________

//LISTADO_______________________________________________________________________
$pagM->total_regs = $pM->get_pedidos_personalshopper_total_regs($arr_filtro_ps);
$rgu = $pM->get_pedidos($pagM->pag, $pagM->regs_x_pag, $arr_filtro_ps);
if ($rgu) {
    $cf = 1;
    while($fgu = $rgu->fetch_assoc()) {
            $ogu .= '<tr>';
            $ogu .= '<td><a href="'.$ruta_inicio.'ver-perfil.php?id_usuario='.$fgu['id_usuario'].'">'.$fgu['nombrecompleto_usuario'].'</a></td>';
            $ogu .= '<td>'.$fgu['estado_pedido'].'</td>';
            $ogu .= '<td>'.$fgu['fecha_pedido'].'</td>';
            //$ogu .= '<td><a href="'.$ruta_inicio.'asignar-articulos-pedido.php?id_pedido='.$fgu['id_pedido'].'"><img src="'.$ruta_inicio.'img/editpedido.png"></td>';
            $ogu .= '<td><a href="'.$ruta_inicio.'asignar-articulos-pedido.php?id_pedido='.$fgu['id_pedido'].'"><button type="button" class="btn btn-outline-info">Modificar</button>';
            if($fgu['estado_pedido']==1){
                $ogu .= '<a href="'.$ruta_inicio.'pedidos.php?id_pedido='.$fgu['id_pedido'].'&cambiar_estado=2&arr_filtro='.$arr_filtro_ps.'"><button type="button" class="btn btn-outline-success">Enviado</button></a></td>';//editpedido.png
            }
            $ogu .= '</td></tr>';
    }
} else $str_errores = $hM->get_alert_danger('Error cargando usuarios');

//LISTADO________________________________________________________________________

//PAGINADO______________________________________________________________________
//$str_ruta = $ruta_inicio.'pedidos.php?filtro_meses='.$filtro_meses.'&filtro_anyos='.$filtro_anyos.'&filtro_KPI='.$filtro_KPI;
$mpag = $pagM->get_menu_paginacion($str_ruta);
//PAGINADO______________________________________________________________________


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
                                    <?php if (isset($str_errores)) echo $str_errores; ?>
                                </div>
                                <div class="layout-table-item">
                                    <div class="layout-table-header">
                                        <h4 class="mb-0">Pedidos</h4>
                                    </div>
                                    <div class="ml-3 mr-3 mt-3">
                                        <div class="dropdown">
                                            <form action="pedidos.php" method="post">
                                                <?php echo $uM->get_combo_array($arr_filtro,"arr_filtro",$arr_filtro_ps,"btn_aceptar bg_salmon tipogr_blanca",true) ?>
                                            </form>
                                        </div>
                                    </div>
                                    
                                    <div class="layout-table-content">
                                        <div class="table-responsive-sm">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th>Nombre Completo</th>
                                                        <th>Estado</th>
                                                        <th>Fecha pedido</th>
                                                        <th>Modificar pedido</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php echo $ogu; ?>
                                                </tbody>
                                            </table>
                                            <nav id="paginacion" aria-label="Page navigation example">
                                                <ul class="pagination">
                                                    <?php echo $mpag; ?>
                                                </ul>
                                            </nav>
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