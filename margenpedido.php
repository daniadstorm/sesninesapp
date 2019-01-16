<?php
include_once('config/config.inc.php'); //cargando archivo de configuracion

$uM = load_model('usuario');
$iM = load_model('inputs');
$uM->control_sesion($ruta_inicio, ADMIN);
$margendias = 1;

$rget = $uM->get_estado_tienda();
if($rget){
    while($fget = $rget->fetch_assoc()){
        $margendias = $fget['margen_pedidos'];
    }
}

$myArray = array("margen_pedidos" => $margendias);

?>
<?php echo json_encode($myArray); ?>