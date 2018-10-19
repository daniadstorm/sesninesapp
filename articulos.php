<?php
include_once('config/config.inc.php'); //cargando archivo de configuracion

$uM = load_model('usuario');
$uM->control_sesion($ruta_inicio, ADMIN);

$pagM = load_model('paginado');
$hM = load_model('html');
$aM = load_model('articulos');

$oga = '';
$pagM->regs_x_pag=20;
$pagM->pag=0;

$str_ruta = $ruta_inicio.'etiquetas.php?';

//GET___________________________________________________________________________
if (isset($_GET['nuevo_articulo']) && $_GET['nuevo_articulo'] == 'true') $str_info = $hM->get_alert_success('Artículo añadido');
if (isset($_GET['editar_articulo']) && $_GET['editar_articulo'] == 'true') $str_info = $hM->get_alert_success('Artículo actualizado');
/*
if (isset($_GET['eliminar_etiqueta'])) {
    
    $id_etiqueta = $_GET['eliminar_etiqueta'];
    
    if ($eM->is_safe_deleting($id_etiqueta)) {
        $rde = $eM->delete_etiqueta($id_etiqueta);
        if ($rde) {
            $str_info = $hM->get_alert_success('Etiqueta eliminada');
        } else $str_errores = $hM->get_alert_danger('Error eliminando etiqueta');
    } else $str_errores = $hM->get_alert_danger('No se puede eliminar etiqueta (actualmente en uso)');
}
*/
if (isset($_GET['pag'])) $pagM->pag=$_GET['pag'];
//GET___________________________________________________________________________

//LISTADO_______________________________________________________________________
//$total_regs = $aM->get_articulos_total_regs(htmlentities($filtro_marcas), htmlentities($filtro_categoria), htmlentities($filtro_subcategoria1), htmlentities($filtro_subcategoria2));
//$ra = $aM->get_articulos(htmlentities($filtro_marcas), htmlentities($filtro_categoria), htmlentities($filtro_subcategoria1), htmlentities($filtro_subcategoria2), $pag, $regs_x_pag);
$pagM->total_regs = $aM->get_articulos_total_regs();
$rga = $aM->get_articulos($pagM->pag, $pagM->regs_x_pag);

if ($rga) {
    while ($fga = $rga->fetch_assoc()) {
        $oga .= '<tr>';
        $oga .=     '<td><a href="ver-articulo.php?id_articulo='.$fga['id_articulo'].'">';
        $oga .=         '<button type="button" class="btn btn-outline-secondary">'.$fga['referencia_articulo'].'</button>';
        $oga .=     '</a></td>';
        $oga .=     '<td><a href="nuevo-articulo.php?id_articulo='.$fga['id_articulo'].'" target="_blank" >'.$fga['nombre_articulo'].'</a></td>';
        
        /* $oga .=     '<td>'.(($fga['activado_articulo'] == 0) ? 'NO' : 'SÍ').'</td>'; */
        
        $oga .=     '<td>'.(($fga['visible_en_tienda_articulo'] == 0) ? 'NO' : 'SÍ').'</td>';
        
        $oga .=     '<td>'.$fga['precio_coste_articulo'].' &euro;</td>';
        
        $oga .=     '<td>'.$fga['PVP_final_articulo'].' &euro;</td>';
        
        $oga .=     '<td><a href="'.$ruta_inicio.'asignar-existencias-articulo.php?id_articulo='.$fga['id_articulo'].'">';
        $oga .=         '<button type="button" class="btn btn-outline-info">Existencias - Asignar</button>';
        $oga .=     '</a></td>';
        
        $oga .=     '<td><a href="'.$ruta_inicio.'asignar-img-articulo.php?id_articulo='.$fga['id_articulo'].'">';
        $oga .=         '<button type="button" class="btn btn-outline-info">Img - Asignar</button>';
        $oga .=     '</a></td>';
        
        $oga .=     '<td><a href="'.$ruta_inicio.'asignar-etiquetas-articulo.php?id_articulo='.$fga['id_articulo'].'">';
        $oga .=         '<button type="button" class="btn btn-outline-info">Etiquetas - Asignar</button>';
        $oga .=     '</a></td>';
        
        $oga .=     '<td>';
        $oga .=         '<a href="'.$ruta_inicio.'articulos.php?eliminar_articulo='.$fga['id_articulo'].'">';
        $oga .=             '<button type="button" class="btn btn-outline-danger">Eliminar</button>';
        $oga .=         '</a>';
        $oga .=     '</td>';
        
        //$ogu .= '<td><a href="'.$ruta_inicio.'asignar-articulos-pedido.php?id_pedido='.$fgu['id_pedido'].'"><button type="button" class="btn btn-outline-info">Modificar</button>';
        
        /*
        
        
        $oga .=     '<td>'.$row['margen_articulo'].' &euro;</td>';
        $oga .=     '<td><a href="img-articulos.php?id_articulo='.$row['id_articulo'].'" target="_blank" ><button type="button" class="btn btn-outline-info">Ver</button></a></td>';
        */
        
        $oga .=  '<div style="clear:both;"></div>';
        $oga .= '</tr>';
        
    }
}
//LISTADO_______________________________________________________________________

//PAGINADO______________________________________________________________________
$mpag = $pagM->get_menu_paginacion($str_ruta);
//PAGINADO______________________________________________________________________

//MENU ORDER BY_________________________________________________________________

//MENU ORDER BY_________________________________________________________________

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
                                    <h4 class="mb-0">Artículos</h4>
                                    <div class="ml-2">
                                        <a href="nuevo-articulo.php"><button class="btn btn-light ml-2">Nuevo Artículo</button></a>
                                    </div>
                                </div>
                                <div class="layout-table-content">
                                    <div class="table-responsive-sm">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>Ref</th>
                                                    <th>Nombre artículo</th>
                                                    <!-- th>Activo</th> -->
                                                    <th>Visible</th>
                                                    <th>Coste</th>
                                                    <th>PVP</th>
                                                    <th>Existencias</th>
                                                    <th>Imágenes</th>
                                                    <th>Etiquetas</th>
                                                    <th>Eliminar artículo</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php echo $oga; ?>
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