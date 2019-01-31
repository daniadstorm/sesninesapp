<?php 
include_once('config/config.inc.php'); //cargando archivo de configuracion

$uM = load_model('usuario');
$pM = load_model('pedido');
$pagM = load_model('paginado');
$iM = load_model('inputs');

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
$id_usuario_datos = 0;

/*  */
$tipoopcion = '';
$vestirdiadia = '';
$vestirsuperior = '';
$vestirinferior = '';
$colorarmario = '';
$colorfav = '';
$personaConocida = '';
$actividadOcio = '';
$profesion = '';
$hijos = '';
$frmdatosnombre = '';
$frmdatosapellidos = '';
$frmdatosfechanacimiento = '';
$frmdatosemail = '';
$silueta = '';
$tallasuperior = '';
$tallainferior = '';
$tallapecho = '';
$altura = '';
$cuerporealzar = '';
$cuerpodisimular = '';
$tonopiel = '';
$ojos = '';
$colorcabello = '';
$enviarfoto = '';
$listadoprendas = '';
$renovar = '';
$looksasesoria = '';
$otroasesoria = '';
$pedirps = '';
$pedirpsotros = '';
$pedirpsfuera = '';
$pedirpsfueraotros = '';
$tendencias = '';
/*  */

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

if(isset($_POST['id_pedido'])){
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
                    $pM->update_estado_pedido_seleccionado($id_pedido, 1);
                    header('Location: '.$ruta_inicio.'pedidos.php');
                    /* $pM->update_estado_pedido($id_pedido,1);
                    header('Location: '.$ruta_inicio.'pedidos.php'); */
                }
            }else $str_errores = 'Este producto ya está insertado o no hay stock';
        }else{
            $str_errores = 'Este pedido ya contiene 6 articulos';
            header('Location: '.$ruta_inicio.'pedidos.php');
        }
        
    }
    
}

if(isset($_GET['id_pedido'])){
    $rgiup = $pM->get_id_usuario_pedido($_GET['id_pedido']);
    if($rgiup){
        while($frgiup = $rgiup->fetch_assoc()){
            $id_usuario_datos = $frgiup['id_usuario'];
        }
        $rgdp = $uM->get_data_ps($id_usuario_datos);
        if($rgdp){
            while($frgdp = $rgdp->fetch_assoc()){
                $tipoopcion = $frgdp['tipoopcion'];
                $vestirdiadia = $rootM->stringToArray($frgdp['vestirdiadia']);
                $vestirsuperior = $frgdp['vestirsuperior'];
                $vestirinferior = $frgdp['vestirinferior'];
                $colorarmario = $frgdp['colorarmario'];
                $colorfav = $frgdp['colorfav'];
                $personaConocida = $frgdp['personaConocida'];
                $actividadOcio = $frgdp['actividadOcio'];
                $profesion = $frgdp['profesion'];
                $hijos = $frgdp['hijos'];
                $frmdatosnombre = $frgdp['frmdatosnombre'];
                $frmdatosapellidos = $frgdp['frmdatosapellidos'];
                $frmdatosfechanacimiento = mysql_to_date($frgdp['frmdatosfechanacimiento']);
                $frmdatosemail = $frgdp['frmdatosemail'];
                $silueta = $frgdp['silueta'];
                $tallasuperior = $frgdp['tallasuperior'];
                $tallainferior = $frgdp['tallainferior'];
                $tallapecho = $frgdp['tallapecho'];
                $altura = $frgdp['altura'];
                $cuerporealzar = $frgdp['cuerporealzar'];
                $cuerpodisimular = $frgdp['cuerpodisimular'];
                $tonopiel = $frgdp['tonopiel'];
                $ojos = $frgdp['ojos'];
                $colorcabello = $frgdp['colorcabello'];
                $enviarfoto = $frgdp['enviarfoto'];
                $listadoprendas = $rootM->stringToArray($frgdp['listadoprendas']);
                $renovar = $frgdp['renovar'];
                $looksasesoria = $rootM->stringToArray($frgdp['looksasesoria']);
                $otroasesoria = $frgdp['otroasesoria'];
                $pedirps = $rootM->stringToArray($frgdp['pedirps']);
                $pedirpsotros = $frgdp['pedirpsotros'];
                $pedirpsfuera = $frgdp['pedirpsfuera'];
                $pedirpsfueraotros = $frgdp['pedirpsfueraotros'];
                $tendencias = $frgdp['tendencias'];
            }
        }
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
    <!-- Modal -->
    <div class="modal fade bd-example-modal-lg" id="modalDatos" tabindex="-1" role="dialog" aria-labelledby="modalDatosLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="modalDatosLabel">Información</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-12 col-md-6">
                    <?php echo $iM->get_input_text("tipoopcion", $tipoopcion, 'form-control', 'Tipo opción:'); ?>
                    <?php echo $iM->get_select("vestirdiadia", $vestirdiadia, $vestirdiadia, 'form-control', '¿Cómo te gusta vestir en tu día a día?', false, 'multiple'); ?>
                    <?php echo $iM->get_input_text("vestirsuperior", $vestirsuperior, 'form-control', '¿Cómo sueles vestir? (Parte superior)'); ?>
                    <?php echo $iM->get_input_text("vestirinferior", $vestirinferior, 'form-control', '¿Cómo sueles vestir? (Parte inferior)'); ?>
                    <?php echo $iM->get_input_text("colorarmario2", $colorarmario, 'form-control', '¿Qué colores predominan en tu armario?'); ?>
                    <?php echo $iM->get_input_text("colorfav", $colorfav, 'form-control', '¿Te gustan más lo estampados o eres más de colores lisos?'); ?>
                    <?php echo $iM->get_input_text("personaConocida2", $personaConocida, 'form-control', '¿Te identificas o te gusta el estilo de una persona conocida?'); ?>
                    <?php echo $iM->get_input_text("actividadOcio", $actividadOcio, 'form-control', 'Cuentanos tus actividades de ocio'); ?>
                    <?php echo $iM->get_input_text("profesion", $profesion, 'form-control', '¿A qué te dedicas?'); ?>
                    <?php echo $iM->get_input_text("hijos", $hijos, 'form-control', '¿Tienes hijos?'); ?>
                    <?php echo $iM->get_input_text("frmdatosnombre", $frmdatosnombre, 'form-control', 'Datos personales'); ?>
                    <?php echo $iM->get_input_text("frmdatosapellidos", $frmdatosapellidos, 'form-control', 'Datos personales'); ?>
                    <?php echo $iM->get_input_text("frmdatosfechanacimiento", $frmdatosfechanacimiento, 'form-control', 'Datos personales'); ?>
                    <?php echo $iM->get_input_text("frmdatosemail", $frmdatosemail, 'form-control', 'Datos personales'); ?>
                    <?php echo $iM->get_input_text("silueta", $silueta, 'form-control', 'Mi silueta es...'); ?>
                    <?php echo $iM->get_input_text("tallasuperior", $tallasuperior, 'form-control', 'Talla superior'); ?>
                    <?php echo $iM->get_input_text("tallainferior", $tallainferior, 'form-control', 'Talla inferior'); ?>
                    <?php echo $iM->get_input_text("tallapecho", $tallapecho, 'form-control', 'Talla de pecho'); ?>
                </div>
                <div class="col-12 col-md-6">
                    <?php echo $iM->get_input_text("altura", $altura, 'form-control', 'Mi altura es..'); ?>
                    <?php echo $iM->get_input_text("cuerporealzar", $cuerporealzar, 'form-control', '¿Qué parte de tu cuerpo te gusta más (realzar)?'); ?>
                    <?php echo $iM->get_input_text("cuerpodisimular", $cuerpodisimular, 'form-control', '¿Qué parte de tu cuerpo te gusta menos (disimular)?'); ?>
                    <?php echo $iM->get_input_text("tonopiel", $tonopiel, 'form-control', 'Tono de piel'); ?>
                    <?php echo $iM->get_input_text("ojos", $ojos, 'form-control', 'Ojos'); ?>
                    <?php echo $iM->get_input_text("colorcabello", $colorcabello, 'form-control', 'Color del cabello'); ?>
                    <p>imagenes</p>
                    <?php echo $iM->get_select("listadoprendas", $listadoprendas, $listadoprendas, 'form-control', 'Listado de prendas que te sueles poner', false, 'multiple'); ?>
                    <?php echo $iM->get_select("renovar", $renovar, $renovar, 'form-control', '¿Qué necesitarías renovar?', false, 'multiple'); ?>
                    <?php echo $iM->get_select("looksasesoria", $looksasesoria, $looksasesoria, 'form-control', '¿Para qué looks necesitas asesoría?', false, 'multiple'); ?>
                    <?php echo $iM->get_input_text("otroasesoria", $otroasesoria, 'form-control', 'Texto asesoría'); ?>
                    <?php echo $iM->get_select("pedirps", $pedirps, $pedirps, 'form-control', 'Me apetece pedir mi Personal Shopper porque:', false, 'multiple'); ?>
                    <?php echo $iM->get_input_text("pedirpsotros", $pedirpsotros, 'form-control', 'Texto personal shopper'); ?>
                    <?php echo $iM->get_input_text("pedirpsfuera", $pedirpsfuera, 'form-control', 'Me gustaría que mi Personal Shopper fuera:'); ?>
                    <?php echo $iM->get_input_text("pedirpsfueraotros", $pedirpsfueraotros, 'form-control', 'Otros personal shopper fuera..'); ?>
                    <?php echo $iM->get_input_text("tendencias", $tendencias, 'form-control', 'Ayudanos a conocerte mejor (sigues las tendencias, tu día a día, algua petición especial...)'); ?>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        </div>
        </div>
    </div>
    </div>
    <!--  -->
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
                                    <div class="layout-table-header" style="overflow-x: auto;">
                                        <h4 class="mb-0">Asignar articulos pedido</h4>
                                        <button type="button" class="ml-3 btn btn-info" data-toggle="modal" data-target="#modalDatos">Ver información</button>
                                    </div>
                                    <div class="layout-table-content">
                                        <div class="table-responsive-sm" style="overflow-x: auto;">
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
</body>
</html>