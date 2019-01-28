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
    "#c45850"
);
$arrMesesUsuariosNuevos = array(
    "enero" => $aM->get_registro_month(1),
    "febrero" => $aM->get_registro_month(2),
    "marzo" => $aM->get_registro_month(3),
    "abril" => $aM->get_registro_month(4),
    "mayo" => $aM->get_registro_month(5),
    "junio" => $aM->get_registro_month(6),
    "julio" => $aM->get_registro_month(7),
    "agosto" => $aM->get_registro_month(8),
    "septiembre" => $aM->get_registro_month(9),
    "octubre" => $aM->get_registro_month(10),
    "noviembre" => $aM->get_registro_month(11),
    "diciembre" => $aM->get_registro_month(12)
);
$arrMesesPedidos = array(
    "enero" => $aM->get_pedidos_month(1),
    "febrero" => $aM->get_pedidos_month(2),
    "marzo" => $aM->get_pedidos_month(3),
    "abril" => $aM->get_pedidos_month(4),
    "mayo" => $aM->get_pedidos_month(5),
    "junio" => $aM->get_pedidos_month(6),
    "julio" => $aM->get_pedidos_month(7),
    "agosto" => $aM->get_pedidos_month(8),
    "septiembre" => $aM->get_pedidos_month(9),
    "octubre" => $aM->get_pedidos_month(10),
    "noviembre" => $aM->get_pedidos_month(11),
    "diciembre" => $aM->get_pedidos_month(12)
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
$(document).ready(function(e){
    new Chart(document.getElementById("char-usuariosnuevos"), {
        type: \'line\',
        data: {
            labels: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"],
            datasets: [
                {
                    showLine: true,
                    data: ['.$arrMesesUsuariosNuevos["enero"].', '.$arrMesesUsuariosNuevos["febrero"].', '.$arrMesesUsuariosNuevos["marzo"].', '.$arrMesesUsuariosNuevos["abril"].', '.$arrMesesUsuariosNuevos["mayo"].', '.$arrMesesUsuariosNuevos["junio"].', '.$arrMesesUsuariosNuevos["julio"].', '.$arrMesesUsuariosNuevos["agosto"].', '.$arrMesesUsuariosNuevos["septiembre"].', '.$arrMesesUsuariosNuevos["octubre"].', '.$arrMesesUsuariosNuevos["noviembre"].', '.$arrMesesUsuariosNuevos["diciembre"].'],
                    backgroundColor: ["#3cba9f"]
                }
            ]
        },
        options: {
            legend: { display: false },
            title: {
                display: true,
                text: \'Usuarios nuevos :)\'
            }
        }
    });
    new Chart(document.getElementById("char-pedidos"), {
        type: \'radar\',
        data: {
            labels: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"],
            datasets: [
                {
                    showLine: true,
                    data: ['.$arrMesesPedidos["enero"].', '.$arrMesesPedidos["febrero"].', '.$arrMesesPedidos["marzo"].', '.$arrMesesPedidos["abril"].', '.$arrMesesPedidos["mayo"].', '.$arrMesesPedidos["junio"].', '.$arrMesesPedidos["julio"].', '.$arrMesesPedidos["agosto"].', '.$arrMesesPedidos["septiembre"].', '.$arrMesesPedidos["octubre"].', '.$arrMesesPedidos["noviembre"].', '.$arrMesesPedidos["diciembre"].'],
                    backgroundColor: ["#3cba9f"]
                }
            ]
        },
        options: {
            legend: { display: false },
            title: {
                display: true,
                text: \'Pedidos :)\'
            }
        }
    });
});
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