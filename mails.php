<?php
include_once('config/config.inc.php'); //cargando archivo de configuracion

$uM = load_model('usuario');
$uM->control_sesion($ruta_inicio, ADMIN);

$pM = load_model('pedido');
$pagM = load_model('paginado');
$hM = load_model('html');
$iM = load_model('inputs');

$arr_filtro = array(//Estados
    0 => "PENDIENTE (Confirmación de pedido)",
    1 => "ENVIADO",
    2 => "RECIBIDO",
    3 => "ÚLTIMO DÍA",
    4 => "CHECK OUT REALIZADO DEVOLVIENDO PRENDAS",
    5 => "CHECK OUT REALIZADO SE LO QUEDA TODO Y PAGADO",
    6 => "CHECK OUT REALIZADO SE LO QUEDA TODO Y NO PAGADO",
    7 => "DEVOLUCIÓN COMPLETA Y PAGADA",
    8 => "DEVOLUCIÓN ROPA PERO NO PAGADA",
    9 => "SEGUIMOS SIN PODER HACER EL CARGO DE LA TARJETA",
    10 => "INICIO PROCESO LEGAL",
    
);
$arr_filtro_ps = 0;
$asuntomail = '';
$editormail = '';

//GET___________________________________________________________________________
if(isset($_REQUEST['arr_filtro'])){
    $arr_filtro_ps=$_REQUEST['arr_filtro'];
}

//GET___________________________________________________________________________

//POST__________________________________________________________________________
if(isset($_POST['editormail'])){
    if(!$uM->existemail($arr_filtro_ps)){
        $rau = $uM->addmail($arr_filtro_ps, "asuntooo", $_POST['editormail']);
        if($rau){
            $str_info = 'Añadido correctamente';
        }else{
            $str_error = 'No se ha podido añadir';
        }
    }else{
        $rau = $uM->updatemail($arr_filtro_ps, "asuntooo", $_POST['editormail']);
        if($rau){
            $str_info = 'Actualizado correctamente';
        }else{
            $str_error = 'No se ha podido actualizar';
        }
    }
}
//POST__________________________________________________________________________

//LISTADO_______________________________________________________________________
$rgm = $uM->getmail($arr_filtro_ps);
if($rgm){
    while($frgm = $rgm->fetch_assoc()){
        $editormail .= $frgm['cuerpo'];
        $asuntomail .= $frgm['asunto'];
    }
}
//LISTADO________________________________________________________________________

//PAGINADO______________________________________________________________________

//PAGINADO______________________________________________________________________

include_once('inc/cabecera.inc.php'); //cargando cabecera 

echo '<script type="text/javascript">
$(document).ready(function(){
    $("#editormail").summernote({
        height: 300,
        minHeight: null,
        maxHeight: null
    });
    $("#editormail").summernote(\'code\', `'.$editormail.'`);
    $(".select-tag").on(\'click\', function(){
        var textTemp = $(this).attr("valor");
        $(".note-editable.card-block").html(function(i, origText){
            return origText + textTemp;
        });
    });
});
</script>'
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
                                    <?php if (isset($str_info)) echo $hM->get_alert_success($str_info); ?>
                                    <?php if (isset($str_error)) echo $hM->get_alert_danger($str_error); ?>
                                </div>
                                <div class="layout-table-item">
                                    <div class="layout-table-header">
                                        <h4 class="mb-0">Pedidos</h4>
                                    </div>
                                    <div class="ml-3 mr-3 mt-3">
                                        <div class="dropdown">
                                            <form method="post">
                                                <?php echo $uM->get_combo_array($arr_filtro,"arr_filtro",$arr_filtro_ps,"btn_aceptar bg_salmon tipogr_blanca",true) ?>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="layout-table-content">
                                        <div class="table-responsive-sm">
                                        <form method="post">
                                            <?php echo $iM->get_input_text("asuntomail", $asuntomail, 'form-control mb-0', 'Asunto'); ?>
                                            <p class="mb-2">Contenido</p>
                                            <div class="row">
                                                <div class="col-10">
                                                    <textarea id="editormail" name="editormail"></textarea>
                                                </div>
                                                <div class="col-2">
                                                    <h1 class="lead text-center">Tags</h1>
                                                    <nav class="nav nav-pills flex-column flex-sm-row">
                                                        <a class="flex-sm-fill text-sm-center nav-link select-tag btn btn-outline-info" href="#" valor="[nombre_usuario]">Nombre usuario</a>
                                                    </nav>
                                                </div>
                                            </div>
                                            <div class="d-flex justify-content-center mt-2">
                                                <button type="submit" class="btn btn-block btn-lg btn-info">Guardar</button>
                                            </div>
                                        </form>
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