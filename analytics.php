<?php
include_once('config/config.inc.php'); //cargando archivo de configuracion

$uM = load_model('usuario');
$uM->control_sesion($ruta_inicio, ADMIN);
$aM = load_model('analytics');

$bgColors = array(
    "#3e95cd",
    "#8e5ea2",
    "#3cba9f",
    "#e8c3b9",
    "#c45850",
    "#3e95cd",
    "#8e5ea2",
    "#3cba9f",
    "#e8c3b9",
    "#c45850",
    "#3e95cd",
    "#8e5ea2",
    "#3cba9f",
    "#e8c3b9",
    "#c45850",
    "#3e95cd",
    "#8e5ea2",
    "#3cba9f",
    "#e8c3b9",
    "#c45850"
);

$arrMesesUsuariosNuevos = array(
    "Enero" => $aM->get_registro_month(1),
    "Febrero" => $aM->get_registro_month(2),
    "Marzo" => $aM->get_registro_month(3),
    "Abril" => $aM->get_registro_month(4),
    "Mayo" => $aM->get_registro_month(5),
    "Junio" => $aM->get_registro_month(6),
    "Julio" => $aM->get_registro_month(7),
    "Agosto" => $aM->get_registro_month(8),
    "Septiembre" => $aM->get_registro_month(9),
    "Octubre" => $aM->get_registro_month(10),
    "Noviembre" => $aM->get_registro_month(11),
    "Diciembre" => $aM->get_registro_month(12)
);

$arrMesesPedidos = array(
    "Enero" => $aM->get_pedidos_month(1),
    "Febrero" => $aM->get_pedidos_month(2),
    "Marzo" => $aM->get_pedidos_month(3),
    "Abril" => $aM->get_pedidos_month(4),
    "Mayo" => $aM->get_pedidos_month(5),
    "Junio" => $aM->get_pedidos_month(6),
    "Julio" => $aM->get_pedidos_month(7),
    "Agosto" => $aM->get_pedidos_month(8),
    "Septiembre" => $aM->get_pedidos_month(9),
    "Octubre" => $aM->get_pedidos_month(10),
    "Noviembre" => $aM->get_pedidos_month(11),
    "Diciembre" => $aM->get_pedidos_month(12)
);

$arrAVGps = array(
    "Enero" => $aM->get_pedidos_month(1),
    "Febrero" => $aM->get_pedidos_month(2),
    "Marzo" => $aM->get_pedidos_month(3),
    "Abril" => $aM->get_pedidos_month(4),
    "Mayo" => $aM->get_pedidos_month(5),
    "Junio" => $aM->get_pedidos_month(6),
    "Julio" => $aM->get_pedidos_month(7),
    "Agosto" => $aM->get_pedidos_month(8),
    "Septiembre" => $aM->get_pedidos_month(9),
    "Octubre" => $aM->get_pedidos_month(10),
    "Noviembre" => $aM->get_pedidos_month(11),
    "Diciembre" => $aM->get_pedidos_month(12)
);
//GET___________________________________________________________________________

//GET___________________________________________________________________________

//POST__________________________________________________________________________
/* echo '<pre>';
print_r($_POST);
echo '</pre>'; */
//POST__________________________________________________________________________

//LISTADO_______________________________________________________________________

//LISTADO________________________________________________________________________

//PAGINADO______________________________________________________________________

//PAGINADO______________________________________________________________________


include_once('inc/cabecera.inc.php'); //cargando cabecera 
?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.bundle.min.js"></script>
<?php
    echo '<script>
    $(document).ready(function(e){';
    echo $aM->get_chart("char-usuariosnuevos", "line", "Nuevos usuarios", $arrMesesUsuariosNuevos, $bgColors[rand(0,4)]);
    echo $aM->get_chart("char-pedidos" ,"radar", "Pedidos", $arrMesesPedidos, $bgColors[rand(0,4)]);
    echo $aM->get_chart("char-avg-tallas" ,"bar", "AVG", $arrAVGps, $bgColors);
    echo '});
    </script>';
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
                                <?php if (isset($str_info)) echo $str_info; ?>
                                <?php if (isset($str_errores)) echo $str_errores; ?>
                            </div>
                            <div class="layout-table-item">
                                <div class="layout-table-header">
                                    <h4>Analytics</h4>
                                </div>
                                <div class="layout-table-content">
                                    <div class="table-responsive-sm">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <canvas id="char-usuariosnuevos"></canvas>
                                            </div>
                                            <div class="col-md-4">
                                                <canvas id="char-pedidos"></canvas>
                                            </div>
                                            <div class="col-md-4">
                                                <canvas id="char-avg-tallas"></canvas>
                                            </div>
                                        </div>
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