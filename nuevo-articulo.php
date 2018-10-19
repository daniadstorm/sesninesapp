<?php
include_once('config/config.inc.php'); //cargando archivo de configuracion
$uM = load_model('usuario');
$uM->control_sesion($ruta_inicio, ADMIN);

$hM = load_model('html');
$iM = load_model('inputs');
$aM = load_model('articulos');

$ttl = 'Nuevo artículo';

//campos formulario
$id_articulo = 0;
$nombre_articulo = '';
$referencia_articulo = '';
$referencia_proveedor_articulo = '';
$descripcion_articulo = '';
$activado_articulo = '';
$arr_opt_activado_articulo = array(1 => 'SÍ', 0 => 'NO');
$visible_en_tienda_articulo = '';
$arr_opt_visible_en_tienda_articulo = array(1 => 'SÍ', 0 => 'NO');
$precio_coste_articulo = 0;
$coste_externo_portes_articulo = 0;
$PVP_final_articulo = 0;
$margen_articulo = 0;
/* $cantidad_articulo = ''; */
$inicio_descuento_articulo = '';
$fin_descuento_articulo = '';
$descuento_porcentaje_articulo = '';
$descuento_euros_articulo  = '';
$almacen_articulo = '';

$verif = true;

//GET___________________________________________________________________________
if (isset($_GET['id_articulo'])) {
    
    $id_articulo = $_GET['id_articulo'];
    
    $rga = $aM->get_articulo($id_articulo);
    if ($rga) {
        while ($fga = $rga->fetch_assoc()) {
            $nombre_articulo = $fga['nombre_articulo'];
            $referencia_articulo = $fga['referencia_articulo'];
            $referencia_proveedor_articulo = $fga['referencia_proveedor_articulo'];
            $descripcion_articulo = $fga['descripcion_articulo'];
            $activado_articulo = $fga['activado_articulo'];
            $visible_en_tienda_articulo = $fga['visible_en_tienda_articulo'];
            $precio_coste_articulo = $fga['precio_coste_articulo'];
            $coste_externo_portes_articulo = $fga['coste_externo_portes_articulo'];
            $PVP_final_articulo = $fga['PVP_final_articulo'];
            $margen_articulo = $fga['margen_articulo'];
            /* $cantidad_articulo = $fga['cantidad_articulo']; */
            $inicio_descuento_articulo = $fga['inicio_descuento_articulo'];
            $fin_descuento_articulo = $fga['fin_descuento_articulo'];
            $descuento_porcentaje_articulo = $fga['descuento_porcentaje_articulo'];
            $descuento_euros_articulo = $fga['descuento_euros_articulo'];
            $almacen_articulo = $fga['almacen_articulo'];
        }
    } else $str_errores = $hM->get_alert_danger('Error cargando artículo');
}
//GET___________________________________________________________________________

//POST__________________________________________________________________________
if (isset($_POST['id_articulo'])) {
    
    $id_articulo = $_POST['id_articulo'];
    $nombre_articulo = $_POST['nombre_articulo'];
    $referencia_articulo = $_POST['referencia_articulo'];
    $referencia_proveedor_articulo = $_POST['referencia_proveedor_articulo'];
    $descripcion_articulo = $_POST['descripcion_articulo'];
    $activado_articulo = $_POST['activado_articulo'];
    $visible_en_tienda_articulo = $_POST['visible_en_tienda_articulo'];
    $precio_coste_articulo = $_POST['precio_coste_articulo'];
    $coste_externo_portes_articulo = $_POST['coste_externo_portes_articulo'];
    $PVP_final_articulo = $_POST['PVP_final_articulo'];
    $margen_articulo = $_POST['margen_articulo'];
    /* $cantidad_articulo = $_POST['cantidad_articulo']; */
    $inicio_descuento_articulo = $_POST['inicio_descuento_articulo'];
    $fin_descuento_articulo = $_POST['fin_descuento_articulo'];
    $descuento_porcentaje_articulo = $_POST['descuento_porcentaje_articulo'];
    $descuento_euros_articulo = $_POST['descuento_euros_articulo'];
    $almacen_articulo = $_POST['almacen_articulo'];
    
    //control de errores ---------------------------------------------------- */
    //control de errores ---------------------------------------------------- */
    
    //MySQL ----------------------------------------------------------------- */
    if ($verif == true) {
        
        //id_articulo
        $nombre_articulo = $aM->escstr($nombre_articulo);
        $referencia_articulo = $aM->escstr($referencia_articulo);
        $referencia_proveedor_articulo = $aM->escstr($referencia_proveedor_articulo);
        $descripcion_articulo = $aM->escstr($descripcion_articulo);
        //$activado_articulo;
        //$visible_en_tienda_articulo;
        $precio_coste_articulo = $aM->escstr($precio_coste_articulo);
        $coste_externo_portes_articulo = $aM->escstr($coste_externo_portes_articulo);
        $PVP_final_articulo = $aM->escstr($PVP_final_articulo);
        $margen_articulo = $aM->escstr($margen_articulo);
        /* $cantidad_articulo = $aM->escstr($cantidad_articulo); */
        //$inicio_descuento_articulo;
        //$fin_descuento_articulo;
        $descuento_porcentaje_articulo = $aM->escstr($descuento_porcentaje_articulo);
        $descuento_euros_articulo = $aM->escstr($descuento_euros_articulo);
        //$almacen_articulo;
        
        if ($id_articulo > 0) { //UPDATE
            $rua = $aM->update_articulo($id_articulo, $nombre_articulo, $referencia_articulo, $referencia_proveedor_articulo, $descripcion_articulo, $activado_articulo, 
                $visible_en_tienda_articulo, $precio_coste_articulo, $coste_externo_portes_articulo, $PVP_final_articulo, $margen_articulo, $inicio_descuento_articulo,
                $fin_descuento_articulo, $descuento_porcentaje_articulo, $descuento_euros_articulo, $cantidad_articulo, $almacen_articulo);
            //$rua = $aM->update_artciulo($id_articulo, $nombre_etiqueta);
            if ($rua) {
                header('Location: '.$ruta_inicio.'articulos.php?editar_articulo=true'); exit();
            } else $str_errores = $hM->get_alert_danger('Error actualizando artículo');
        } else { //NUEVO
            $raa = $aM->add_articulo($nombre_articulo, $referencia_articulo, $referencia_proveedor_articulo, $descripcion_articulo, $activado_articulo, $visible_en_tienda_articulo,
                $precio_coste_articulo, $coste_externo_portes_articulo, $PVP_final_articulo, $margen_articulo, $inicio_descuento_articulo, $fin_descuento_articulo,
                $descuento_porcentaje_articulo, $descuento_euros_articulo, $cantidad_articulo, $almacen_articulo);
            if ($raa) {
                header('Location: '.$ruta_inicio.'articulos.php?nuevo_articulo=true'); exit();
            } else $str_errores = $hM->get_alert_danger('Error añadiendo artículo');
        }
    }
    //MySQL ----------------------------------------------------------------- */
}
//POST__________________________________________________________________________

//COMBOS________________________________________________________________________

//COMBOS________________________________________________________________________

if ($id_articulo > 0) $ttl = 'Editar artículo';

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
                                    <h4><?php echo $ttl; ?></h4>
                                </div>
                                <div class="layout-table-content">
                                    <form method="post" enctype="multipart/form-data">
                                    <?php 
                                        echo $iM->get_input_hidden('id_articulo', $id_articulo);
                                        echo $iM->get_input_text('nombre_articulo', $nombre_articulo, 'form-control', '*Nombre artículo', '', 'Campo requerido', 1);
                                        echo $iM->get_input_text('referencia_articulo', $referencia_articulo, 'form-control', '*Referencia', '', 'Campo requerido', 1);
                                        echo $iM->get_input_text('referencia_proveedor_articulo', $referencia_proveedor_articulo, 'form-control', '*Referencia Proveedor', '', 'Campo requerido', 1);
                                        echo $iM->get_input_textarea('descripcion_articulo', $descripcion_articulo, 'form-control', '*Descripción', '', 'Campo requerido', 1);
                                        /* echo $iM->get_input_radio('activado_articulo', $activado_articulo, $arr_opt_activado_articulo, '', 'Activado'); */
                                        echo $iM->get_input_radio('visible_en_tienda_articulo', $visible_en_tienda_articulo, $arr_opt_visible_en_tienda_articulo, '', 'Visible en tienda');
                                        echo $iM->get_input_number('precio_coste_articulo', $precio_coste_articulo, 'form-control', '*Precio de coste (&euro;)', '', 'Campo requerido', 1, false, 'price');
                                        echo $iM->get_input_number('coste_externo_portes_articulo', $coste_externo_portes_articulo, 'form-control', '*Precio de portes (&euro;)', '', 'Campo requerido', 1, false, 'price');
                                        echo $iM->get_input_number('PVP_final_articulo', $PVP_final_articulo, 'form-control', '*Precio de venta al público (&euro;)', '', 'Campo requerido', 1, false, 'price');
                                        echo $iM->get_input_number('margen_articulo', $margen_articulo, 'form-control', '*Margen (&euro;)', '', 'Campo requerido', 1, false, 'price');
                                        /* echo $iM->get_input_number('cantidad_articulo', $cantidad_articulo, 'form-control', 'Cantidad', '', 'Campo requerido', 1, false, 'int', true); */
                                        echo $iM->get_input_date('inicio_descuento_articulo', $inicio_descuento_articulo, 'form-control', 'Fecha inicio descuento', '', '', false, false, true);
                                        echo $iM->get_input_date('fin_descuento_articulo', $fin_descuento_articulo, 'form-control', 'Fecha fin descuento', '', '', false, false, true);
                                        echo $iM->get_input_number('descuento_porcentaje_articulo', $descuento_porcentaje_articulo, 'form-control', 'Descuento (%)', '', '', 1, 100, 'int', true);
                                        echo $iM->get_input_number('descuento_euros_articulo', $descuento_euros_articulo, 'form-control', 'Descuento (&euro;)', '', '', 1, false, 'int', true);
                                        echo $aM->get_combo_almacenes('almacen_articulo', $almacen_articulo, 'form-control', 'Almacén');
                                    ?>                                    
                                    <button class="btn bg-primary text-light">Aceptar</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
    $(document).ready(function(){
        if($("#id_articulo").val()==0){
            $(".form-control").keyup(function(){
                let precio_coste = parseInt($("#precio_coste_articulo").val(),10);
                let precio_porte = parseInt($("#coste_externo_portes_articulo").val(),10);
                let precio_final_articulo = parseInt($("#PVP_final_articulo").val(),10);
                let margen = (precio_final_articulo-(precio_coste+precio_porte))-21/100;
                $("#margen_articulo").val(margen);
            });
        }
    });
    </script>
</body>
</html>