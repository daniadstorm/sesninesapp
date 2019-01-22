<?php
include_once('config/config.inc.php'); //cargando archivo de configuracion

$uM = load_model('usuario');
$uM->control_sesion($ruta_inicio, ADMIN);

$pM = load_model('pedido');
$pagM = load_model('paginado');
$hM = load_model('html');
$ogu = '';
$pagM->regs_x_pag=20;
$pagM->pag=0;
//$pagM->regs_x_pag=1;

$arr_filtro = array(//Estados
    0 => "PENDIENTE (Confirmación de pedido)",
    1 => "ENVIADO",
    2 => "RECIBIDO",
    3 => "ÚLTIMO DÍA",
    4 => "CHECK OUT REALIZADO DEVOLVIENDO PRENDAS",
    5 => "CHECK OUT REALIZADO SE LO QUEDA TODO Y PAGADO",
    6 => "CHECK OUT REALIZADO SE LO QUEDA TODO Y NO PAGADO",
    7 => "DEVOLUCIÓN COMPLETA Y PAGADA",
    8 => "DEVOLUCIÓN ROPA PERO NO PAGADA",
    9 => "SEGUIMOS SIN PODER HACER EL CARGO DE LA TARJETA",
    10 => "INICIO PROCESO LEGAL",
    
);
$arr_filtro_ps = 0;

//GET___________________________________________________________________________
if (isset($_GET['nuevo_usuario']) && $_GET['nuevo_usuario'] == 'true') $str_info = $hM->get_alert_success('Usuario añadido');
if (isset($_GET['editar_usuario']) && $_GET['editar_usuario'] == 'true') $str_info = $hM->get_alert_success('Usuario actualizado');
if (isset($_GET['eliminar_usuario']) && $_GET['eliminar_usuario'] == 'true') $str_info = $hM->get_alert_success('Usuario eliminado');
if ((isset($_GET['cambiar_estado']) && $_GET['cambiar_estado']==2) && isset($_GET['id_pedido'])) $pM->update_estado_pedido($_GET['id_pedido'],2);
if (isset($_REQUEST['cambio_estado']) && isset($_REQUEST['id_pedido'])) $pM->update_estado_pedido($_REQUEST['id_pedido'], $_REQUEST['cambio_estado']);
if(isset($_REQUEST['arr_filtro'])){
    $arr_filtro_ps=$_REQUEST['arr_filtro'];
    $str_ruta = $ruta_inicio.'pedidos.php?arr_filtro='.$arr_filtro_ps.'&';
}else{
    $arr_filtro_ps=0;
    $str_ruta = $ruta_inicio.'pedidos.php?';
}

if (isset($_GET['pag'])) {
    $pagM->pag=$_GET['pag'];
}

echo '<pre>';
print_r($_POST);
echo '</pre>';


//GET___________________________________________________________________________

//POST__________________________________________________________________________
if(isset($_POST['usuario_fiabilidad'])){
    $rcuf = $uM->cambiar_usuario_fiable($_POST['usuario_fiabilidad']);
    if($rcuf){
        $str_info = 'Cambio realizado correctamente';
    }else $str_errores = 'No se ha podido cambiar la fiabilidad del usuario';
}
//POST__________________________________________________________________________

//LISTADO_______________________________________________________________________
$pagM->total_regs = $pM->get_pedidos_personalshopper_total_regs($arr_filtro_ps);
$rgu = $pM->get_pedidos($pagM->pag, $pagM->regs_x_pag, $arr_filtro_ps);
if ($rgu) {
    $cf = 1;
    while($fgu = $rgu->fetch_assoc()) {
        /* echo '<pre>';
        print_r($fgu);
        echo '</pre>'; */

        $ogu .= '<tr>';
        $ogu .= '<td><a href="'.$ruta_inicio.'ver-perfil.php?id_usuario='.$fgu['id_usuario'].'">'.$fgu['nombrecompleto_usuario'].'</a></td>';
        $ogu .= '<td>'.$rootM->mysql_datetime_to_date($fgu['fecha_pedido']).'</td>';
        if($fgu['estado_pedido']==0){
            $ogu .= '<td><button type="button" class="btn btn-outline-info" data-toggle="modal" data-target="#modalPedido'.$fgu['id_pedido'].'">Ver observaciones</button>
            <div class="modal fade" id="modalPedido'.$fgu['id_pedido'].'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"><div class="modal-dialog modal-dialog-centered" role="document"><div class="modal-content"><div class="modal-header"><h5 class="modal-title" id="exampleModalLabel">Observaciones</h5><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button></div><div class="modal-body">'.$fgu['observaciones_pedido'].'</div><div class="modal-footer"><button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button></div></div></div></div></td>';
            if($fgu['prendas_seleccionadas']==1) $ogu .= '<td><i class="fa fa-check-circle color-verde" style="font-size:2rem;"></i></td>';
                else $ogu .= '<td><a href="'.$ruta_inicio.'asignar-articulos-pedido.php?id_pedido='.$fgu['id_pedido'].'"><button type="button" class="btn btn-outline-info">Modificar</button></td>';
        }
        //if($fgu['estado_pedido']==1) $ogu .= '<td><a href="'.$ruta_inicio.'pedidos.php?id_pedido='.$fgu['id_pedido'].'&cambiar_estado=2&arr_filtro='.$arr_filtro_ps.'"><button type="button" class="btn btn-outline-success">Enviado</button></a></td>';
        $ogu .= '<td><form method="post" class="m-0"><input type="hidden" name="usuario_fiabilidad" value="'.$fgu['id_usuario'].'"><i class="fa-fiabilidad fa ';
        $ogu .= ($fgu['fiable']) ? 'fa-check-circle color-verde' : 'fa-ban color-red';
        $ogu .= '" style="font-size:2rem;"></i></form></td>';
        $ogu .= '<td>'.$fgu['pedirpsfuera'].'</td>';
        $ogu .= '<td>'.$fgu['tipoopcion'].'</td>';
        $ogu .= '<td><form method="post"><input type="hidden" name="id_pedido" value="'.$fgu['id_pedido'].'">';
        $ogu .= $uM->get_combo_array($arr_filtro,"cambio_estado",$arr_filtro_ps,"",true).'</form></td>';
        $ogu .= '<td><form method="post"><button type="submit" name="enviarMail" value="'.$fgu['id_pedido'].'" class="btn btn-outline-info">Enviar</button></form></td>';
        $ogu .= '</tr>';
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
$(document).ready(function(){
    $(".fa-fiabilidad").on('click', function(){
        $(this).closest('form').submit();
    });
});
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
                                    <?php if (isset($str_info)) echo $hM->get_alert_success($str_info); ?>
                                    <?php if (isset($str_errores)) echo $hM->get_alert_danger($str_error); ?>
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
                                                        <th>Fecha pedido</th>
                                                        <?php
                                                            if($arr_filtro_ps==0){
                                                                echo '<th>Observaciones</th>';
                                                                echo '<th>Modificar pedido</th>';
                                                                echo '<th>Usuario fiable</th>';
                                                                echo '<th>Mi ps es..</th>';
                                                                echo '<th>Tipo</th>';
                                                            }
                                                        ?>
                                                        <th>Cambiar estado a</th>
                                                        <th>Mail estado</th>
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