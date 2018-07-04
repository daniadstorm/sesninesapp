<?php
include_once('config/config.inc.php'); //cargando archivo de configuracion

$uM = load_model('usuario');
$uM->control_sesion($ruta_inicio, ADMIN);

$pagM = load_model('paginado');
$hM = load_model('html');
$catM = load_model('categorias'); //cM es carritoModel

$ogc = '';
$pagM->regs_x_pag=20;
$pagM->pag=0;

$str_ruta = $ruta_inicio.'categorias.php?';

//GET___________________________________________________________________________
if (isset($_GET['nueva_categoria']) && $_GET['nuevo_categoria'] == 'true') $str_info = $hM->get_alert_success('Categoría añadida');
if (isset($_GET['editar_categoria']) && $_GET['editar_categoria'] == 'true') $str_info = $hM->get_alert_success('Categoría actualizado');
if (isset($_GET['eliminar_categoria']) && $_GET['eliminar_categproa'] == 'true') $str_info = $hM->get_alert_success('Categoría eliminada');

/*
if (isset($_GET['delete_usuario'])) {
    $id_usuario = $_GET['delete_usuario'];
    $rdu = $uM->delete_usuario($id_usuario);
    if ($rdu) {
        header('Location: '.$ruta_inicio.'usuarios.php?eliminar_usuario=true'); exit();
    } else $str_errores = '<div class="error_alert">'.BD_ERR_MSG.'</div>';
}
*/
if (isset($_GET['pag'])) {
    $pagM->pag=$_GET['pag'];
}
//GET___________________________________________________________________________

//POST__________________________________________________________________________
//POST__________________________________________________________________________

//LISTADO_______________________________________________________________________

$pagM->total_regs = $catM->get_categorias_total_regs();
$rgc = $catM->get_categorias($pagM->pag, $pagM->regs_x_pag);
if ($rgc) {
    while($fgc = $rgc->fetch_assoc()) {
        $ogc .= '<tr>';
        $ogc .= '<td>'.$fgc['nombre_categoria'].'</td>';
        $ogc .= '<td><img src="'.$fgc['imagen_categoria'].'" /></td>';
        $ogc .= '</tr>';
        /*
        $ogc .= '<td><a href="nuevo-cliente.php?id_usuario='.$fgu['id_usuario'].'">'.$fgu['nombrecompleto_usuario'].'</a></td>';
        $ogc .= '<td>'.$fgu['email_usuario'].'</td>';
        $ogc .= '<td>'.$fgu['nie_usuario'].'</td>';
        $ogc .= '<td>'.mysql_to_date($fgu['fecha_nacimiento']).'</td>';
        $ogc .= '<td>'.$fgu['telf_usuario'].'</td>';
        $ogc .= '<td>';
        ($fgu['ps_completo']) ? $ogu.='Completado' : $ogu.='No Completado';
        $ogc .= '</td>';
        */
    }
} else $str_errores = $hM->get_alert_danger('Error cargando categorías');

//LISTADO________________________________________________________________________

//PAGINADO______________________________________________________________________
//$str_ruta = $ruta_inicio.'clientes.php?filtro_meses='.$filtro_meses.'&filtro_anyos='.$filtro_anyos.'&filtro_KPI='.$filtro_KPI;
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
                                    <h4>Categorías</h4>
                                    <div class="ml-2">
                                        <a href="nueva-categoria.php"><button class="btn btn-light ml-2">Nueva Categoría</button></a>
                                    </div>
                                </div>
                                <div class="ml-3 mr-3 mt-3">
                                    <div class="dropdown">
                                        <form action="clientes.php" method="post">
                                            
                                        </form>
                                    </div>
                                </div>
                                <div class="layout-table-content">
                                    <div class="table-responsive-sm">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>Nombre categoría</th>
                                                    <th>Imagen categoría</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php echo $ogc; ?>
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