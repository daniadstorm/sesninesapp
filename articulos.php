<?php
include_once('config/config.inc.php'); //cargando archivo de configuracion

//CONTROL SESION________________________________________________________________
$uM = load_model('usuario');
$uM->control_sesion($ruta_inicio, ADMIN);
//CONTROL SESION________________________________________________________________


$pagM = load_model('paginado');

//viene de paginado por href
if(isset($_GET['pag'])){
$pagM->pag = $_GET['pag'];
}

$str_estado ='';

$aM = load_model('articulos');
//$cM = load_model('carrito');
//$prM = load_model('pricing');


$pagM->regs_x_pag = 20;



$mpag = ''; //menu paginacion

$filtro_marcas = '-- Todas las marcas --';
$filtro_categoria = '-- Todas las categorias --';
$filtro_subcategoria1 = '-- Todas las subcategorias --';
$filtro_subcategoria2 = '-- Todas las subcategorias (2) --';


//COMENTARIO DE AÑADIDO
if(isset($_REQUEST['str_estado'])){
    
    $str_estado = $_REQUEST['str_estado'];
}

if(isset($_REQUEST['str_errores'])){
    
    $str_errores = $_REQUEST['str_errores'];
}

//GET___________________________________________________________________________
if (isset($_GET['pag'])) {
    $pag = $_GET['pag'];
    //$filtro_marcas = $_GET['filtro_marcas'];
    
}
//GET___________________________________________________________________________

//POST__________________________________________________________________________
if (isset($_POST['filtro_marcas'])) {
    //$filtro_marcas = $_POST['filtro_marcas'];
    
    if ($_POST['set_destacado'] != -1) {
        if ($_POST['set_destacado'] == 1) $aM->set_destacado($_POST['id_articulo']);
            else $aM->delete_destacado($_POST['id_articulo']);
    }
}
//POST__________________________________________________________________________

//LISTADO_______________________________________________________________________



//$total_regs = $aM->get_articulos_total_regs(htmlentities($filtro_marcas), htmlentities($filtro_categoria), htmlentities($filtro_subcategoria1), htmlentities($filtro_subcategoria2));
//$ra = $aM->get_articulos(htmlentities($filtro_marcas), htmlentities($filtro_categoria), htmlentities($filtro_subcategoria1), htmlentities($filtro_subcategoria2), $pag, $regs_x_pag);
$pagM->total_regs = $aM->get_articulos_total_regs();
$ra = $aM->get_articulos($pagM->pag, $pagM->regs_x_pag);

if ($ra) {
    $rw = '';
    $cf = 1;
    $count=1;
    while ($row = $ra->fetch_assoc()) {
        $rw .= '<tr>'; 
        $rw .=  '<td><a href="nuevo_articulo.php?id_articulo='.$row['id_articulo'].'" target="_blank"><button type="button" class="btn btn-outline-secondary">'.$count.'</button></a></td>';
        $rw .=  '<td>'.'<a href="vista-articulo.php?id_articulo='.$row['id_articulo'].'" target="_blank" >'.$row['nombre_articulo'].'</a>'.'</td>';
        $rw .=  '<td>'.$row['activado_articulo'].'</td>';
        $rw .=  '<td>'.$row['visible_en_tienda_articulo'].'</td>';
        $rw .=  '<td>'.$row['almacen_articulo'].'</td>';
        $rw .=  '<td>'.$row['PVP_final_articulo'].' &euro;</td>';
        $rw .=  '<td>'.$row['margen_articulo'].' &euro;</td>';
        $rw .=  '<td><a href="img-articulos.php?id_articulo='.$row['id_articulo'].'" target="_blank" ><button type="button" class="btn btn-outline-info">Ver</button></a></td>';
        $rw .=  '<div style="clear:both;"></div>';
        $rw .= '</tr>';
        
        $cf = ($cf == 1) ? 2 : 1;
        
        $count++;
    }
}
//LISTADO_______________________________________________________________________

//PAGINADO______________________________________________________________________
//monta el encabezado de paginación
$str_ruta = $ruta_inicio.'articulos.php?';
$mpag = $pagM->get_menu_paginacion($str_ruta);
//PAGINADO______________________________________________________________________


//MENU ORDER BY_________________________________________________________________
$obs = ' id="order_by_selected" ';
$mob  = 'ORDENA PER: ';
//$mob .= combo_orderby($id_lang, $order_by);
//MENU ORDER BY_________________________________________________________________


//$sl_marca = combo_marcas('filtro_marcas', $filtro_marcas);
//$sl_categoria = combo_categorias('filtro_categoria', $filtro_categoria);
//$sl_subcategoria1 = combo_subcategoria1('filtro_subcategoria1', $filtro_subcategoria1);
//$sl_subcategoria2 = combo_subcategoria2('filtro_subcategoria2', $filtro_subcategoria2);

include_once('inc/cabecera.inc.php'); //cargando cabecera 
?>
<script type="text/javascript">
    
    function apply_filters(actual_url) {
        document.location.replace(actual_url);
    }
    
    function set_destacados(id_articulo, set_destacado) {
        $("#id_articulo").val(id_articulo);
        $("#set_destacado").val(set_destacado);
        $("#form_filtros_articulos").submit();
    }
    function mostrar_articulo_detalle(){
        $("div.table_tr.row_1").click(function(){
  alert( "Hola." );
});
        
    }
    
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
                                        <h4 class="mb-0">Pedidos</h4>
                                    </div>
                                    <div class="layout-table-content">
                                        <div class="table-responsive-sm">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th>ID</th>
                                                        <th>Nombre</th>
                                                        <th>Activo</th>
                                                        <th>Visible</th>
                                                        <th>Almacen</th>
                                                        <th>PVP</th>
                                                        <th>Margen</th>
                                                        <th>Imagenes</th>
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
<div id="main_container">
    <?php include_once('inc/main_menu.inc.php'); ?>
    <div id="agcontent">
        <?php include_once('inc/franja_top.inc.php'); ?>
        <div id="seccion_back" style="margin-top: 10%">
            <div id="ttl_seccion_back">
                <img src="img/articulos.png" />
                <h2>Art&iacute;culos</h2>
                <div style="clear:both;"></div>
            </div>
            <div id="filtros_seccion">
                <?php if (isset($str_estado)) echo $str_estado; ?>
                <?php if (isset($str_errores)) echo $str_errores; ?>
                <form action="articulos.php" method="post" id="form_filtros_articulos" name="form_filtros_articulos" >
                    <input type="hidden" name="set_destacado" id="set_destacado" value="-1" />
                    <input type="hidden" name="id_articulo" id="id_articulo" value="-1" />
                    <div class="filtro_cont"><?php /*echo $sl_marca;*/?></div>
                    <div class="filtro_cont"><?php /*echo $sl_categoria;*/ ?></div>
                    <!--<div class="filtro_cont"><?php /*echo $sl_subcategoria1;*/?></div>-->
                    <div class="filtro_cont"><?php /*echo $sl_subcategoria2;*/?></div>
                   
                    <div class="filtro_cont"><input type="submit" class="btn_aceptar" style="padding:4px 22px;" value="Filtrar" /></div>
                    <div style="clear:both;"></div>
                </form>
            </div>
            <div id="filtros_seccion">
                <div class="filtro_cont" ><a href="nuevo_articulo.php"  class="btn_aceptar" style="background-color:#DFDFDF;" value="Añadir artículo">Añadir artículo</a></div> 
                <div style="clear:both;"></div>
             </div>
            <div class="table_list">
                <div class="table_th">
                    <div class="left_td table_td" style="width:8%;min-width:1px;text-align:center;">Id</div>
                    <div class="left_td table_td" style="width:8%;min-width:1px;text-align:center;">Nom</div>
                    <div class="left_td table_td" style="width:8%;min-width:1px;text-align:center;">Acti</div>
                    <div class="left_td table_td" style="width:8%;min-width:1px;text-align:center;">Visib</div>
                    <div class="left_td table_td" style="width:8%;min-width:1px;text-align:center;">Almacén</div>
                    <div class="left_td table_td" style="width:8%;min-width:1px;text-align:center;">PVP</div>
                    <div class="left_td table_td" style="width:8%;min-width:1px;text-align:center;">Mar</div>
                    <div class="left_td table_td" style="width:8%;min-width:1px;text-align:center;">Img</div>
                    <div style="clear:both;"></div>
                </div>
                <?php echo $rw; ?>
            </div>
            <div id="filtros_seccion">
                <div class="filtro_cont menu_paginacion"><?php echo $mpag; ?></div>
                <div style="clear:both;"></div>
            </div>
            <div id="filtros_seccion">
                <div class="filtro_cont">&nbsp;</div>
                <div style="clear:both;"></div>
            </div>
           </div>
    </div>
</div>
</body>
</html>
<?php //} else { unset($_SESSION['username']);header('Location: '.$ruta_inicio.'index.php'); exit(); } ?>