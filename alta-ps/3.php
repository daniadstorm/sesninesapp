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
if(isset($_POST['arraySiluetaImg'])){
    for($i=1;$i<=5;$i++){
        $_SESSION['img'.$i]='';
    }
    for($i=0;$i<count($_POST['check']);$i++){
        $_SESSION[$_POST['check'][$i]]=$_POST['check'][$i];
    }
}
echo '<pre>';
print_r($_SESSION);
echo '</pre>';
//POST__________________________________________________________________________

//LOAD__________________________________________________________________________
$actividad_estilo = '';
$tienes_hijos = '';
$profesion_estilo = '';
$imagen_categoria = '';
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
                                    <div class="row justify-content-center">
                                                <div class="col-xs-12 col-sm-4 col-md-2">
                                                    <label>
                                                        <img src="http://sesnineshopper.com/adstorm/img/casualstreet.jpg" class="img-thumbnail img-check">
                                                        <input type="radio" name="silueta" value="triangulo" id="item" hidden>
                                                        <p class="text-center">Triangulo</p>
                                                    </label>
                                                </div>
                                                <div class="col-xs-12 col-sm-4 col-md-2">
                                                    <label>
                                                        <img src="http://sesnineshopper.com/adstorm/img/casualstreet.jpg" class="img-thumbnail img-check">
                                                        <input type="radio" name="silueta" value="trianguloinvertido" id="item" hidden>
                                                        <p class="text-center">Triangulo invertido</p>
                                                    </label>
                                                </div>
                                                <div class="col-xs-12 col-sm-4 col-md-2">
                                                    <label>
                                                        <img src="http://sesnineshopper.com/adstorm/img/casualstreet.jpg" class="img-thumbnail img-check">
                                                        <input type="radio" name="silueta" value="relojarena" id="item" hidden>
                                                        <p class="text-center">Reloj arena</p>
                                                    </label>
                                                </div>
                                                <div class="col-xs-12 col-sm-4 col-md-2">
                                                    <label>
                                                        <img src="http://sesnineshopper.com/adstorm/img/casualstreet.jpg" class="img-thumbnail img-check">
                                                        <input type="radio" name="silueta" value="rectangular" id="item" hidden>
                                                        <p class="text-center">Rectangular</p>
                                                    </label>
                                                </div>
                                                <div class="col-xs-12 col-sm-4 col-md-2">
                                                    <label>
                                                        <img src="http://sesnineshopper.com/adstorm/img/casualstreet.jpg" class="img-thumbnail img-check">
                                                        <input type="radio" name="silueta" value="redonda" id="item" hidden>
                                                        <p class="text-center">Redonda</p>
                                                    </label>
                                                </div>
                                            </div>
                                            <?php echo $iM->get_input_img('imagen_categoria', $imagen_categoria, $ruta_archivos, '', 'Puedes subir imágenes tuyas si lo prefieres..', true); ?>  
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
        $(document).ready(function (e) {
            $(".img-check").click(function () {
                $(this).toggleClass("check");
            });
        });
    </script>
</body>

</html>