<?php 
include_once('config/config.inc.php'); //cargando archivo de configuracion

$uM = load_model('usuario');
$pM = load_model('pedido');
$pagM = load_model('paginado');

//viene de paginado por href

/* echo '<pre>';
print_r($_POST);
echo '</pre>';
 */
$str_estado ='';
/* $str_info =''; */

$aM = load_model('articulos');
//$cM = load_model('carrito');
//$prM = load_model('pricing');

$pagM->regs_x_pag = 10;

$mpag = ''; //menu paginacion
$id_usuario=$_SESSION['id_usuario'];
$id_pedido = '';
$rau = '';
if(isset($_REQUEST['id_pedido'])){
    $id_pedido=$_REQUEST['id_pedido'];
}

//GET___________________________________________________________________________
if(isset($_REQUEST['arr_filtro'])){
    $arr_filtro_ps=$_REQUEST['arr_filtro'];
    $str_ruta = $ruta_inicio.'asignar-articulos-pedido.php?arr_filtro='.$arr_filtro_ps.'&id_pedido='.$id_pedido.'&';
}else{
    $str_ruta = $ruta_inicio.'asignar-articulos-pedido.php?id_pedido='.$id_pedido.'&';
}

if (isset($_REQUEST['pag'])) {
    $pagM->pag=$_REQUEST['pag'];
}

if(isset($_REQUEST['id_pedido'])){
    //Controlar si ha eliminado pedidos después de ser añadido a "listo para enviar"
    if(isset($_REQUEST['del_articulo'])){
        $rdap = $pM->delete_articulo_pedido($id_pedido, $_REQUEST['del_articulo']);
        if(!$rdap){
            $str_errores = 'Error al eliminar el producto';
        }
    }
    $rtpu = $pM->get_total_pedidos_user($id_pedido);
    if($rtpu<6){
        $pM->update_estado_pedido($id_pedido,0);
    }
    if(isset($_REQUEST['add_articulo'])){
        $rtpu = $pM->get_total_pedidos_user($id_pedido);
        if($rtpu<6){
            $rpm = $pM->add_articulo_pedido($id_pedido,$_REQUEST['add_articulo'],$_REQUEST['prenda']);
            if($rpm){
                if($rtpu>=5){
                    $str_info = 'Producto insertado, ya tienes los 6 articulos';
                    /* $pM->update_estado_pedido($id_pedido,1);
                    header('Location: '.$ruta_inicio.'pedidos.php'); */
                }
            }else $str_errores = 'Este producto ya está insertado o no hay stock';
        }else $str_errores = 'Este pedido ya contiene 6 articulos';
        
    }
    
}


//GET___________________________________________________________________________

//POST__________________________________________________________________________
//POST__________________________________________________________________________


//LISTADO

$pa = $pM->get_pedido($id_pedido);
if($pa){
    $rau = '<div class="card">
    <ul class="list-group list-group-flush mb-2">';
    while($row = $pa->fetch_assoc()){
        $rau .= '<li class="list-group-item">';
        $rau .= '<form method="post" action="" class="m-0">'.$row["nombre_articulo"].'
        <input type="hidden" value="'.$row["id_articulo"].'" name="del_articulo">
        <input type="hidden" value="'.$id_pedido.'" name="id_pedido">';
        $rau .= '<button type="submit" class="btn btn-outline-danger ml-1">Eliminar</button>'.'</form></li>';
        //$rau .= '<div>'.$row["nombre_articulo"].'<a style="color:red;" href="'.$ruta_inicio.'asignar-articulos-pedido.php?del_articulo='.$row["id_articulo"].'&id_pedido='.$id_pedido.'">Eliminar producto</a></div>';
    }
    $rau .= '</ul></div>';
}

$pagM->total_regs = $aM->get_articulos_total_regs();
$ra = $aM->get_articulos($pagM->pag, $pagM->regs_x_pag);

if ($ra) {
    $rw = '';
    $cf = 1;
    $count=1;
    $sel1 = '';
    while ($row = $ra->fetch_assoc()) {
        /* echo '<pre>';
        print_r($row);
        echo '</pre>'; */
            $rw .='<tr>';
            $rw .= '<form method="post" action="">';
            $rw .= '<td>'.$row['referencia_articulo'].'</td>';
            $rw .=  '<td>'.'<a href="vista_articulo.php?id_articulo='.$row['id_articulo'].'" style="color:red;"  target="_blank" >'.$row['nombre_articulo'].'</a>'.'</td>';
            $rw .=  '<td>';
            $rgea = $aM->get_existencias_articulos($row['id_articulo']);
            if($rgea){
                while($fgea = $rgea->fetch_assoc()){
                    $sel1 .= '<option value="'.$fgea['id_existencia'].'">'.$fgea['color_existencia'].' - '.$fgea['talla_existencia'].'</option>';
                }
                if($sel1!=''){
                    $rw .= '<select name="prenda" class="custom-select">'.$sel1.'</select>';
                }else{
                    $rw .=  '<a href="'.$ruta_inicio.'asignar-existencias-articulo.php?id_articulo='.$row['id_articulo'].'"><button type="button" class="btn btn-outline-success">Añadir existencias</button></a>';
                }
                $sel1 = '';
            }
            $rw .=  '</td>';
            $rw .=  '<td>'.$row['PVP_final_articulo'].' &euro;</td>';
            $rw .=  '<td>'.$row['margen_articulo'].' &euro;</td>';
            $rw .=  '<td>
            <input type="hidden" value="'.$row['id_articulo'].'" name="add_articulo">
            <input type="hidden" value="'.$id_pedido.'" name="id_pedido">
            <button type="submit" class="btn btn-outline-success">Añadir</button></a>
            </td>';
            $rw .= '</form>';
            $rw .='</tr>';
            
            $cf = ($cf == 1) ? 2 : 1;
            
            $count++;
    }
}
//LISTADO

//PAGINADO______________________________________________________________________


//PAGINADO______________________________________________________________________

$mpag = $pagM->get_menu_paginacion($str_ruta);
//CONTROL_______________________________________________________________________
//CONTROL_______________________________________________________________________

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
                                    <?php if (isset($str_info)) echo '<div class="alert alert-info" role="alert">'.$str_info.'</div>'; ?>
                                    <?php if (isset($str_errores)) echo '<div class="alert alert-danger" role="alert">'.$str_errores.'</div>'; ?>
                                </div>
                                <?php echo $rau; ?>
                                
                                <div class="layout-table-item">
                                    <div class="layout-table-header">
                                        <h4 class="mb-0">Asignar articulos pedido</h4>
                                    </div>
                                    <div class="layout-table-content">
                                        <div class="table-responsive-sm">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th>Referencia</th>
                                                        <th>Nombre</th>
                                                        <th>Existencias</th>
                                                        <th>PVP</th>
                                                        <th>Margen</th>
                                                        <th>Opción</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php echo $rw; ?>
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
<!-- <div id="main_container">
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
            <div id="filtros_seccion">
                <div class="filtro_cont menu_paginacion" ><?php echo $mpag; ?></div>
                <div style="clear:both;"></div>
            </div>

            <div class="table_list">
                <div class="table_th">
                    <div class="left_td table_td" style="width:9%;min-width:1px;text-align:center;">Nom</div>
                    <div style="clear:both;"></div>
                </div>
                <?php echo $rau; ?>
               
            </div>

            <div class="table_list">
                <div class="table_th">
                    <div class="left_td table_td" style="width:9%;min-width:1px;text-align:center;">Nom</div>
                    <div class="left_td table_td" style="width:9%;min-width:1px;text-align:center;">P_coste</div>
                    <div class="left_td table_td" style="width:9%;min-width:1px;text-align:center;">P_ext_port</div>
                    <div class="left_td table_td" style="width:9%;min-width:1px;text-align:center;">PVP</div>
                    <div class="left_td table_td" style="width:9%;min-width:1px;text-align:center;">Mar</div>
                    <div style="clear:both;"></div>
                </div>
                <?php echo $rw; ?>
               
            </div>

            <div id="filtros_seccion"></div>
        </div>
    </section>
</div> -->
</body>
</html>