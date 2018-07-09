<?php
include_once('../config/config.inc.php'); //cargando archivo de configuracion
//$uM->control_sesion($ruta_inicio, ADMIN);

$fM = load_model('form');
$uM = load_model('usuario'); //uM userModel
$pM = load_model('pedido');
$iM = load_model('inputs');

//GET___________________________________________________________________________
//GET___________________________________________________________________________

//POST__________________________________________________________________________
if(isset($_POST['actividad_estilo'])) $_SESSION['actividad_estilo']=$_POST['actividad_estilo'];
if(isset($_POST['tienes_hijos'])) $_SESSION['tienes_hijos']=$_POST['tienes_hijos'];
if(isset($_POST['profesion_estilo'])) $_SESSION['profesion_estilo']=$_POST['profesion_estilo'];
echo '<pre>';
print_r($_SESSION);
echo '</pre>';
//POST__________________________________________________________________________

//LOAD__________________________________________________________________________
$actividad_estilo = '';
$tienes_hijos = '';
$profesion_estilo = '';
(isset($_SESSION['actividad_estilo'])) ? $actividad_estilo=$_SESSION['actividad_estilo'] : $actividad_estilo='';
(isset($_SESSION['tienes_hijos'])) ? $tienes_hijos=$_SESSION['tienes_hijos'] : $tienes_hijos='';
(isset($_SESSION['profesion_estilo'])) ? $profesion_estilo=$_SESSION['profesion_estilo'] : $profesion_estilo='';

//LOAD__________________________________________________________________________


//CONTROL_______________________________________________________________________
if(isset($_POST['actividad_estilo'])){//Comprobación de $_POST['actividad_estilo'] porque el campo es obligatorio.
    header('Location: '.$ruta_inicio.'alta-ps/3.php');
}
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
                                    <h4 class="mb-0">Alta Personal Shopper</h4>
                                </div>
                                <div class="container my-2">
                                    <div class="progress">
                                        <div class="progress-bar progress-bar-striped bg-info" role="progressbar" style="width: 50%" aria-valuenow="20" aria-valuemin="0"
                                            aria-valuemax="100"></div>
                                    </div>
                                </div>
                                <div class="layout-table-content">
                                    <form action="3.php" method="post">
                                        <div id="parte2">
                                            <h3 class="text-center">Mi tipología</h3>
                                            <div class="row justify-content-center">
                                                <div class="col-md-1 text-center">
                                                    <img class="card-img-top w-50 text-center" src="http://sesnineshopper.com/adstorm/img/ocio.png">
                                                    <p>¿Cómo sueles vestir?</p>
                                                    <?php echo $iM->get_input_text("actividad_estilo",$actividad_estilo,"form-control");  ?>
                                                </div>
                                                <div class="col-md-1 text-center">
                                                    <img class="card-img-top w-50 text-center" src="http://sesnineshopper.com/adstorm/img/estampados.png">
                                                    <p>¿Cómo sueles vestir?</p>
                                                    <?php echo $iM->get_combo_array("tienes_hijos",$uM->arr_si_no,"form-control",$tienes_hijos);  ?>
                                                </div>
                                                <div class="col-md-1 text-center">
                                                    <img class="card-img-top w-50 text-center" src="http://sesnineshopper.com/adstorm/img/maleta.png">
                                                    <p>¿Cómo sueles vestir?</p>
                                                    <?php echo $iM->get_input_text("profesion_estilo",$profesion_estilo,"form-control","","","",false,false,true);  ?>
                                                </div>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Enviar</button>
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
    </script>
</body>

</html>