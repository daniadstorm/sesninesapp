<?php
include_once('config/config.inc.php'); //cargando archivo de configuracion

$uM = load_model('usuario');
$iM = load_model('inputs');
$uM->control_sesion($ruta_inicio, ADMIN);
$ecommerce = '';

if(isset($_POST['ecommerce'])){
    $ecommerce = $_POST['ecommerce'];
    $uet = $uM->update_estado_tienda($ecommerce);
    if(!$uet){
        $str_errores = 'No se ha podido actualizar el estado';
    }
}

$rget = $uM->get_estado_tienda();
if($rget){
    while($fget = $rget->fetch_assoc()){
        $ecommerce = $fget['estado_tienda'];
    }
}
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
                                    <h4>Inicio</h4>
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
                                        <form id="frmEcommerce" action="" method="post" class="d-flex flex-column align-items-center">
                                            <h1 class="h6">Activar / Desactivar e-commerce</h1>
                                            <label class="switch">
                                                <input name="ecommerce" type="submit" <?php echo ($ecommerce) ? 'check="check" value="0"' : 'value="1"'; ?> >
                                                <span class="slider round">
                                                    <label class="on">On</label>
                                                    <label class="off">Off</label>
                                                </span>
                                            </label>
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