<?php
include_once('config/config.inc.php'); //cargando archivo de configuracion

$uM = load_model('usuario');
$uM->control_sesion($ruta_inicio, ADMIN);

$pagM = load_model('paginado');
$hM = load_model('html');
$pM = load_model('proveedores');

$oge = '';
$pagM->regs_x_pag=20;
$pagM->pag=0;

$str_ruta = $ruta_inicio.'proveedores.php?';

//GET___________________________________________________________________________
if (isset($_GET['nueva_proveedor']) && $_GET['nueva_proveedor'] == 'true') $str_info = $hM->get_alert_success('proveedor añadida');
if (isset($_GET['editar_proveedor']) && $_GET['editar_proveedor'] == 'true') $str_info = $hM->get_alert_success('proveedor actualizada');
if (isset($_GET['eliminar_proveedor'])) {
    
    $id_proveedor = $_GET['eliminar_proveedor'];
    
        $rde = $pM->delete_proveedor($id_proveedor);
        if ($rde) {
            $str_info = $hM->get_alert_success('proveedor eliminada');
        } else $str_errores = $hM->get_alert_danger('Error eliminando proveedor');
}

if (isset($_GET['pag'])) $pagM->pag=$_GET['pag'];
//GET___________________________________________________________________________

//POST__________________________________________________________________________
//POST__________________________________________________________________________

//LISTADO_______________________________________________________________________

$pagM->total_regs = $pM->get_proveedores_total_regs();
$rge = $pM->get_proveedores($pagM->pag, $pagM->regs_x_pag);
if ($rge) {
    while($fge = $rge->fetch_assoc()) {
        $oge .= '<tr>';
        
        $oge .=     '<td><a href="'.$ruta_inicio.'nuevo-proveedor.php?id_proveedor='.$fge['id_proveedor'].'">'.$fge['nombre_proveedor'].'</a></td>';
        $oge .=     '<td>';
        $oge .=         '<a href="'.$ruta_inicio.'proveedores.php?eliminar_proveedor='.$fge['id_proveedor'].'">';
        $oge .=             '<button type="button" class="btn btn-outline-danger">Eliminar</button>';
        $oge .=         '</a>';
        $oge .=     '</td>';
        
        $oge .= '</tr>';
    }
} else $str_errores = $hM->get_alert_danger('Error cargando proveedores');

//LISTADO________________________________________________________________________

//PAGINADO______________________________________________________________________
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
                                    <h4>proveedores</h4>
                                    <div class="ml-2">
                                        <a href="nuevo-proveedor.php"><button class="btn btn-light ml-2">Nueva proveedor</button></a>
                                    </div>
                                </div>
                                <div class="ml-3 mr-3 mt-3">
                                    <div class="dropdown">
                                        <form method="post">
                                            <!-- filtros -->
                                        </form>
                                    </div>
                                </div>
                                <div class="layout-table-content">
                                    <div class="table-responsive-sm">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>Nombre proveedor</th>
                                                    <th>Eliminar proveedor</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php echo $oge; ?>
                                            </tbody>
                                        </table>
                                        <nav id="paginacion">
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