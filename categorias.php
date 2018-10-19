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
if (isset($_GET['nueva_categoria']) && $_GET['nueva_categoria'] == 'true') $str_info = $hM->get_alert_success('Categoría añadida');
if (isset($_GET['editar_categoria']) && $_GET['editar_categoria'] == 'true') $str_info = $hM->get_alert_success('Categoría actualizado');
if (isset($_GET['eliminar_categoria'])) {
    $id_categoria = $_GET['eliminar_categoria'];
    $rdc = $catM->delete_categoria($id_categoria);
    if ($rdc) {
        $str_info = $hM->get_alert_success('Categoría eliminada');
    } else $str_errores = $hM->get_alert_danger('Error eliminando categoría');
}
if (isset($_GET['eliminar_subcategoria'])) {
    
    $id_categoria = $_GET['eliminar_subcategoria'];
        $rdc = $catM->delete_subcategoria($id_categoria);
        if ($rdc) {
            $str_info = $hM->get_alert_success('Subcategoría eliminada');
        } else $str_errores = $hM->get_alert_danger('Error eliminando subcategoría');
    
}
if(isset($_GET['desactivar_categoria'])){
    $id_categoria = $_GET['desactivar_categoria'];
    $ruec = $catM->update_estado_categoria($id_categoria,0);
    if($ruec){
        $rgsc = $catM->get_subcategoria($id_categoria);
        if($rgsc){
            while($fgsc = $rgsc->fetch_assoc()){
                $catM->update_estado_subcategoria($fgsc['id_subcategoria'],0);
            }
        }
        $str_info = $hM->get_alert_success('Se ha desactivado la categoria');
    } else $str_errores = $hM->get_alert_danger('Error desactivando categoría');
}
if(isset($_GET['activar_categoria'])){
    $id_categoria = $_GET['activar_categoria'];
    $ruec = $catM->update_estado_categoria($id_categoria,1);
    if($ruec){
        $str_info = $hM->get_alert_success('Se ha activado la categoria');
    } else $str_errores = $hM->get_alert_danger('Error activando categoría');
}

if(isset($_GET['desactivar_subcategoria'])){
    $id_categoria = $_GET['desactivar_subcategoria'];
    $ruec = $catM->update_estado_subcategoria($id_categoria,0);
    if($ruec){
        $str_info = $hM->get_alert_success('Se ha desactivado la categoria');
    } else $str_errores = $hM->get_alert_danger('Error desactivando categoría');
}
if(isset($_GET['activar_subcategoria'])){
    $id_categoria = $_GET['activar_subcategoria'];
    $ruec = $catM->update_estado_subcategoria($id_categoria,1);
    if($ruec){
        $str_info = $hM->get_alert_success('Se ha activado la categoria');
    } else $str_errores = $hM->get_alert_danger('Error activando categoría');
}
if (isset($_GET['pag'])) $pagM->pag=$_GET['pag'];
//GET___________________________________________________________________________

//POST__________________________________________________________________________
//POST__________________________________________________________________________

//LISTADO_______________________________________________________________________

$pagM->total_regs = $catM->get_categorias_total_regs();
$rgc = $catM->get_categorias($pagM->pag, $pagM->regs_x_pag);
if ($rgc) {
    while($fgc = $rgc->fetch_assoc()) {
        $ogc .= '<tr>';
        $ogc .=     '<td><a href="'.$ruta_inicio.'nueva-categoria.php?id_categoria='.$fgc['id_categoria'].'">'.$fgc['nombre_categoria'].'</a></td>';
        $ogc .=     '<td></td>';
        $ogc .=     '<td>';
        $ogc .=         '<a href="'.$ruta_inicio.'categorias.php?eliminar_categoria='.$fgc['id_categoria'].'">';
        $ogc .=             '<button type="button" class="btn btn-outline-danger">Eliminar</button>';
        $ogc .=         '</a>';
        $ogc .=     '</td>';
        if($fgc['visible']){
            $ogc .=     '<td><a href="'.$ruta_inicio.'categorias.php?desactivar_categoria='.$fgc['id_categoria'].'">
            <button type="button" class="btn btn-outline-info">Desactivar</button></a></td>';
        }else if(!$fgc['visible']){
            $ogc .=     '<td><a href="'.$ruta_inicio.'categorias.php?activar_categoria='.$fgc['id_categoria'].'">
            <button type="button" class="btn btn-outline-secondary">Activar</button></a></td>';
        }
        $ogc .= '</tr>';
        $rsc = $catM->get_subcategoria($fgc['id_categoria']);
        if($rsc->num_rows>0){
            while($frsc = $rsc->fetch_assoc()){
                $ogc .= '<tr>';
                $ogc .=     '<td></td>';
                $ogc .=     '<td><a href="'.$ruta_inicio.'nueva-subcategoria.php?id_categoria='.$frsc['id_subcategoria'].'">'.$frsc['nombre_subcategoria'].'</a></td>';
                $ogc .=     '<td>';
                $ogc .=         '<a href="'.$ruta_inicio.'categorias.php?eliminar_subcategoria='.$frsc['id_subcategoria'].'">';
                $ogc .=             '<button type="button" class="btn btn-outline-danger">Eliminar</button>';
                $ogc .=         '</a>';
                $ogc .=     '</td>';
                if($frsc['visible']){
                    $ogc .=     '<td><a href="'.$ruta_inicio.'categorias.php?desactivar_subcategoria='.$frsc['id_subcategoria'].'">
                    <button type="button" class="btn btn-outline-info">Desactivar</button></a></td>';
                }else if(!$frsc['visible']){
                    $ogc .=     '<td><a href="'.$ruta_inicio.'categorias.php?activar_subcategoria='.$frsc['id_subcategoria'].'">
                    <button type="button" class="btn btn-outline-secondary">Activar</button></a></td>';
                }
                $ogc .= '</tr>';
            }
        }
    }
} else $str_errores = $hM->get_alert_danger('Error cargando categorías');

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
                                    <h4>Categorías</h4>
                                    <div class="ml-2">
                                        <a href="nueva-categoria.php"><button class="btn btn-light ml-2">Nueva Categoría</button></a>
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
                                                    <th>Nombre categoría</th>
                                                    <th>subcategoría</th>
                                                    <th>Eliminar categoría</th>
                                                    <th>Activar/Desactivar</th>
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