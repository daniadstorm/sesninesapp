<?php
include_once('config/config.inc.php'); //cargando archivo de configuracion

$uM = load_model('usuario');
$uM->control_sesion($ruta_inicio, ADMIN);

$pagM = load_model('paginado');
$hM = load_model('html');

$ogu = '';
$pagM->regs_x_pag=20;
$pagM->pag=0;

$arr_filtro_personal_shopper = array(
    "todos" => "Todos",
    "si" => "Completado",
    "no" => "No Completado",
);
$arr_filtro_ps = false;

//GET___________________________________________________________________________
if (isset($_GET['nuevo_usuario']) && $_GET['nuevo_usuario'] == 'true') $str_info = $hM->get_alert_success('Usuario añadido');
if (isset($_GET['editar_usuario']) && $_GET['editar_usuario'] == 'true') $str_info = $hM->get_alert_success('Usuario actualizado');
if (isset($_GET['eliminar_usuario']) && $_GET['eliminar_usuario'] == 'true') $str_info = $hM->get_alert_success('Usuario eliminado');
if(isset($_REQUEST['arr_filtro_personal_shopper'])){
    $arr_filtro_ps=$_REQUEST['arr_filtro_personal_shopper'];
    $str_ruta = $ruta_inicio.'clientes.php?arr_filtro_personal_shopper='.$arr_filtro_ps.'&';
}else{
    $str_ruta = $ruta_inicio.'clientes.php?';
}

if (isset($_GET['delete_usuario'])) {
    $id_usuario = $_GET['delete_usuario'];
    $rdu = $uM->delete_usuario($id_usuario);
    if ($rdu) {
        header('Location: '.$ruta_inicio.'usuarios.php?eliminar_usuario=true'); exit();
    } else $str_errores = $hM->get_alert_danger('Error eliminando usuario');
}

if (isset($_GET['pag'])) {
    $pagM->pag=$_GET['pag'];
}

//GET___________________________________________________________________________

//POST__________________________________________________________________________

//POST__________________________________________________________________________

//LISTADO_______________________________________________________________________
$pagM->total_regs = $uM->get_usuarios_total_regs($arr_filtro_ps);
$rgu = $uM->get_usuarios($pagM->pag, $pagM->regs_x_pag, $arr_filtro_ps);
if ($rgu) {
    $cf = 1;
    while($fgu = $rgu->fetch_assoc()) {
            $ogu .= '<tr>';
            $ogu .= '<td><a href="nuevo-cliente.php?id_usuario='.$fgu['id_usuario'].'">'.$fgu['nombrecompleto_usuario'].'</a></td>';
            $ogu .= '<td>'.$fgu['email_usuario'].'</td>';
            $ogu .= '<td>'.$fgu['nie_usuario'].'</td>';
            $ogu .= '<td>'.mysql_to_date($fgu['fecha_nacimiento']).'</td>';
            $ogu .= '<td>'.$fgu['telf_usuario'].'</td>';
            $ogu .= '<td>';
            ($fgu['ps_completo']) ? $ogu.='Completado' : $ogu.='No Completado';
            $ogu .= '</td>';
    }
} else $str_errores = $hM->get_alert_danger('Error cargando usuarios');
//LISTADO________________________________________________________________________

//PAGINADO______________________________________________________________________
//$str_ruta = $ruta_inicio.'clientes.php?filtro_meses='.$filtro_meses.'&filtro_anyos='.$filtro_anyos.'&filtro_KPI='.$filtro_KPI;
$mpag = $pagM->get_menu_paginacion($str_ruta);
//PAGINADO______________________________________________________________________


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
                                    <h4>Usuarios</h4>
                                    <div class="ml-2">
                                        <a href="nuevo-cliente.php"><button class="btn btn-light ml-2">Nuevo Usuario</button></a>
                                    </div>
                                </div>
                                <div class="ml-3 mr-3 mt-3">
                                    <div class="dropdown">
                                        <form action="clientes.php" method="post">
                                            <?php echo $uM->get_combo_array($arr_filtro_personal_shopper,"arr_filtro_personal_shopper",$arr_filtro_ps,"btn_aceptar bg_salmon tipogr_blanca",true) ?>
                                        </form>
                                        <form method="post">
                                            <?php echo $uM->get_combo_array($arr_filtro_personal_shopper,"arr_filtro_personal_shopper",$arr_filtro_ps,"btn_aceptar bg_salmon tipogr_blanca",true) ?>
                                        </form>
                                    </div>
                                </div>
                                <div class="layout-table-content">
                                    <div class="table-responsive-sm">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>Nombre Completo</th>
                                                    <th>Correo</th>
                                                    <th>NIE</th>
                                                    <th>Fecha de nacimiento</th>
                                                    <th>Teléfono</th>
                                                    <th>Personal Shopper</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php echo $ogu; ?>
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