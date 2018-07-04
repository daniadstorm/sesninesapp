<?php
include_once('../config/config.inc.php'); //cargando archivo de configuracion
//$uM->control_sesion($ruta_inicio, ADMIN);

$fM = load_model('form');
$uM = load_model('usuario'); //uM userModel
$pM = load_model('pedido');

//GET___________________________________________________________________________
//GET___________________________________________________________________________

//POST__________________________________________________________________________
//POST__________________________________________________________________________

//CONTROL_______________________________________________________________________
//CONTROL_______________________________________________________________________

include_once('../inc/cabecera.inc.php'); //cargando cabecera
?>

<body>
    <?php include_once('../inc/franja_top.inc.php'); ?>
    <?php include_once('../inc/main_menu.inc.php'); ?>
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
                                        <h4 class="mb-0">Pedidos</h4>
                                    </div>    
                                    <div class="container my-2">
                                        <div class="progress">
                                            <div class="progress-bar progress-bar-striped bg-info" role="progressbar" style="width: 20%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>  
                                    </div>                            
                                    <div class="layout-table-content">
                                        
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