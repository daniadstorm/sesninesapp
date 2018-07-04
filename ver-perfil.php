<?php
include_once('config/config.inc.php'); //cargando archivo de configuracion

$uM = load_model('usuario');
$uM->control_sesion($ruta_inicio, USER);

$id_usuario = '';
$nombrecompleto_usuario = '';
$email_usuario = '';
$fecha_nacimiento = '';
$contrasenya_usuario = '';
$telf_usuario = '';
$nie_usuario = '';
$ogu = '';



//GET__________________________________________________________________________
if (isset($_GET['update_perfil']) && $_GET['update_perfil'] == 'true')
    $str_info = '<div class="ok_alert">Perfil actualizado correctamente</div>';

//GET__________________________________________________________________________
if (isset($_SESSION['id_usuario'])) {
    
    if(isset($_GET['id_usuario'])){
        $id_usuario = $_GET['id_usuario'];
    }else{
        $id_usuario = $_SESSION['id_usuario'];
    }
    
    $rgu = $uM->get_user($id_usuario);
    if ($rgu) {
        while ($fgu = $rgu->fetch_assoc()) {
            $ogu .= '<div class="form-row">
                        <div class="form-group col-md-6">
                            <label>Nombre completo</label>
                            <input type="text" class="form-control" value="'.$fgu['nombrecompleto_usuario'].'" disabled>
                        </div>';
            $ogu .= '<div class="form-group col-md-6">
                        <label>Correo electronico</label>
                        <input type="email" class="form-control" value="'.$fgu['email_usuario'].'" disabled>
                    </div>
                    </div>';
            $ogu .= '<div class="form-row">
                        <div class="form-group col-md-4">
                        <label>Fecha de nacimiento</label>
                        <input type="date" class="form-control" value="'.$fgu['fecha_nacimiento'].'" disabled>
                    </div>
                    <div class="form-group col-md-4">
                        <label>Telefono</label>
                        <input type="text" class="form-control" value="'.$fgu['telf_usuario'].'" disabled>
                    </div>
                    <div class="form-group col-md-4">
                        <label>DNI/NIE</label>
                        <input type="text" class="form-control" value="'.$fgu['nie_usuario'].'" disabled>
                    </div>
                    </div>';
            $ogu .= '<a class="btn bg-primary text-light" href="editar-perfil.php?id_usuario='.$id_usuario.'">Editar perfil</a>';
        }
    } else $str_errores = $str_errores = '<div class="error_alert">Error cargando usuario</div>';
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
                                    <h4>Ver perfil</h4>
                                </div>
                                <div class="layout-table-content">
                                    <form>
                                        <?php echo $ogu ?>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</body>

</html>