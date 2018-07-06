<?php
include_once('config/config.inc.php'); //cargando archivo de configuracion

$uM = load_model('usuario');
$uM->control_sesion($ruta_inicio, ADMIN);

$pagM = load_model('paginado');
$hM = load_model('html');
$eM = load_model('etiquetas');

$oge = '';
$pagM->regs_x_pag=20;
$pagM->pag=0;

$str_ruta = $ruta_inicio.'categorias.php?';

//GET___________________________________________________________________________
if (isset($_GET['nueva_etiqueta']) && $_GET['nueva_etiqueta'] == 'true') $str_info = $hM->get_alert_success('Etiqueta añadida');
if (isset($_GET['editar_etiqueta']) && $_GET['editar_etiqueta'] == 'true') $str_info = $hM->get_alert_success('Etiqueta actualizada');
if (isset($_GET['eliminar_etiqueta'])) {
    
    $id_etiqueta = $_GET['eliminar_etiqueta'];
    
    if ($eM->is_safe_deleting($id_etiqueta)) {
        $rde = $eM->delete_etiqueta($id_etiqueta);
        if ($rde) {
            $str_info = $hM->get_alert_success('Etiqueta eliminada');
        } else $str_errores = $hM->get_alert_danger('Error eliminando etiqueta');
    } else $str_errores = $hM->get_alert_danger('No se puede eliminar etiqueta (actualmente en uso)');
}

if (isset($_GET['pag'])) $pagM->pag=$_GET['pag'];
//GET___________________________________________________________________________

//POST__________________________________________________________________________
//POST__________________________________________________________________________

//LISTADO_______________________________________________________________________

$pagM->total_regs = $catM->get_etiquetas_total_regs();
$rge = $catM->get_etiquetas($pagM->pag, $pagM->regs_x_pag);
if ($rge) {
    while($fge = $rge->fetch_assoc()) {
        $oge .= '<tr>';
        /*
        $oge .=     '<td><a href="'.$ruta_inicio.'nueva-categoria.php?id_categoria='.$fgc['id_categoria'].'">'.$fgc['nombre_categoria'].'</a></td>';
        $oge .=     '<td><img class="img-fluid img-thumbnail" src="'.$fgc['imagen_categoria'].'" width="100" /></td>';
        $oge .=     '<td>';
        $oge .=         '<a href="'.$ruta_inicio.'categorias.php?eliminar_categoria='.$fgc['id_categoria'].'">';
        $oge .=             '<button type="button" class="btn btn-outline-danger">Eliminar</button>';
        $oge .=         '</a>';
        $oge .=     '</td>';
        */
        $oge .= '</tr>';
    }
} else $str_errores = $hM->get_alert_danger('Error cargando etiquetas');

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
                                    <h4>Etiquetas</h4>
                                    <div class="ml-2">
                                        <a href="nueva-etiqueta.php"><button class="btn btn-light ml-2">Nueva Etiqueta</button></a>
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
                                                    <th>Nombre etiqueta</th>
                                                    <th>Eliminar etiqueta</th>
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