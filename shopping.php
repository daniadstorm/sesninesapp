<?php
include_once('config/config.inc.php'); //cargando archivo de configuracion

//CONTROL SESION________________________________________________________________
//$uM = load_model('usuario');
//$uM->control_sesion($ruta_inicio, ADMIN, false);
//CONTROL SESION________________________________________________________________

//CARGA MODELOS_________________________________________________________________
$pagM = load_model('paginado');
//CARGA MODELOS_________________________________________________________________

//VARIABLES_____________________________________________________________________
$pagM->pag = isset($_GET['pag'])?$_GET['pag']:0;

$str_estado = '';
$str_errores = '';

$aM = load_model('articulos');
//$cM = load_model('carrito');
//$prM = load_model('pricing');


$pagM->regs_x_pag = 12;

$mpag = ''; //menu paginacion
//VARIABLES_____________________________________________________________________

//GET___________________________________________________________________________
if (isset($_GET['pag'])) {
    $pag = $_GET['pag'];
    //$filtro_marcas = $_GET['filtro_marcas'];
}
//GET___________________________________________________________________________
//POST__________________________________________________________________________
//POST__________________________________________________________________________
//CONTROL_______________________________________________________________________
//CONTROL_______________________________________________________________________
//LISTADO_______________________________________________________________________
//$total_regs = $aM->get_articulos_total_regs(htmlentities($filtro_marcas), htmlentities($filtro_categoria), htmlentities($filtro_subcategoria1), htmlentities($filtro_subcategoria2));
//$ra = $aM->get_articulos(htmlentities($filtro_marcas), htmlentities($filtro_categoria), htmlentities($filtro_subcategoria1), htmlentities($filtro_subcategoria2), $pag, $regs_x_pag);
$pagM->total_regs = $aM->get_articulos_total_regs();
//echo 'numeroarti='.$pagM->regs_x_pag . '<br>';
//echo 'numerdepag='.$pagM->pag . '<br>';

//el pagM lo recibe del get, es el numero de la página (para k pueda avanzar.

//mete los artículos en un array con un limite 
$ra = $aM->get_articulos($pagM->pag, $pagM->regs_x_pag);

if ($ra) {
    $rw = '';
    //contador de fila para saber si es par o inpar
    $cf = 1;
    
    //$count = 1;
    //me va pasando uno a uno todos los artículos
    while ($fa = $ra->fetch_assoc()) {
        
        //$ia = $aM->get_articulo_img($fa[])
        
        $rai = $aM->get_articulo_img($fa['id_articulo']);
        
        if ($rai) {
            
            while ($fai = $rai->fetch_assoc()) {
                //c
                $fa['img'][] = $fai['ruta'];
            }
            /*
            $var1 += $var2;
            $var3 .= $var4;
            $var5 []= $var6;
            */
            //$rw = $ria->fetch_assoc();
            // $op .=  '<div class=><img src="csv/' . $rw['ruta'] . '" alt="" height="300px" width="220px"></div>';
            //$op .=  '<div class=><img src="csv/vestido-maxi-negro.jpg" alt=""></div>';
             
        } else $str_errores = '<div class="error_alert">Error cargando imagenes de articulo</div>';
        
        $rw .= $aM->html_ficha_producto_mini($fa);
        //$rw .= '<div>'.$fa['nombre_articulo'].'</div>'; //ESTRUCTURA OK
        
        /*
        if ($ria) {
             $rw=$ria->fetch_assoc();
            // $op .=  '<div class=><img src="csv/' . $rw['ruta'] . '" alt="" height="300px" width="220px"></div>';
         $op .=  '<div class=><img src="csv/vestido-maxi-negro.jpg" alt=""></div>';
             
         }
        
        $fa['ruta_inicio'] = $ruta_inicio;
        
        $rw .= $aM->html_ficha_producto_mini($fa);
        
        */

        $cf = ($cf == 1) ? 2 : 1;

        //$count++;
    }
}
//LISTADO_______________________________________________________________________
//PAGINADO______________________________________________________________________
$str_ruta = $ruta_inicio . 'shopping.php?';
$mpag = $pagM->get_menu_paginacion($str_ruta);
//PAGINADO______________________________________________________________________
//MENU ORDER BY_________________________________________________________________
$obs = ' id="order_by_selected" ';
$mob = 'ORDENA PER: ';
//$mob .= combo_orderby($id_lang, $order_by);
//MENU ORDER BY_________________________________________________________________



include_once('inc/cabecera.inc.php'); //cargando cabecera
?>

<body>
    <div id="main_container">
<?php include_once('inc/franja_top.inc.php'); ?>
<?php include_once('inc/main_menu.inc.php'); ?>
        
            

            <section class="section_top">
                <div class="sesnines_shopping_articulo_titulo">
                    <img src="img/shopper.png" />
                      <h2>Productos</h2> 
                    <div style="clear:both;"></div>
                </div>
                
                
            </section>
            <section class="sep_section"></section>
            <section class="middle_section">
                <div class="responsive_seccion">
                  
                    
                        <?php echo $rw; ?>
                        <div style="clear:both;"></div>
                        
                        <div class="menu_paginacion"><?php echo $mpag; ?></div>
                        <div style="clear:both;"></div>
                    
                </div>
            </section>
        </div> 
    
</body>
</html>