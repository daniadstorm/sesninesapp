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
if(isset($_POST['silueta'])) $_SESSION['silueta']=$_POST['silueta'];
if(isset($_POST['talla_superior'])) $_SESSION['talla_superior']=$_POST['talla_superior'];
if(isset($_POST['talla_inferior'])) $_SESSION['talla_inferior']=$_POST['talla_inferior'];
if(isset($_POST['talla_pecho'])) $_SESSION['talla_pecho']=$_POST['talla_pecho'];
if(isset($_POST['altura'])) $_SESSION['altura']=$_POST['altura'];
/* if(isset($_POST['arraySiluetaImg'])){
    for($i=1;$i<=5;$i++){
        $_SESSION['silueta'.$i]='';
    }
    for($i=0;$i<count($_POST['check']);$i++){
        $_SESSION[$_POST['check'][$i]]=$_POST['check'][$i];
    }
} */
echo '<pre>';
print_r($_SESSION);
echo '</pre>';
//POST__________________________________________________________________________

//LOAD__________________________________________________________________________
$talla_superior = '';
$talla_inferior = '';
$talla_pecho = '';
$altura = '';
$imagen_categoria = '';
$silueta = '';
(isset($_SESSION['talla_superior'])) ? $talla_superior=$_SESSION['talla_superior'] : $talla_superior='';
(isset($_SESSION['talla_inferior'])) ? $talla_inferior=$_SESSION['talla_inferior'] : $talla_inferior='';
(isset($_SESSION['talla_pecho'])) ? $talla_pecho=$_SESSION['talla_pecho'] : $talla_pecho='';
(isset($_SESSION['altura'])) ? $altura=$_SESSION['altura'] : $altura='';
(isset($_SESSION['silueta'])) ? $silueta=$_SESSION['silueta'] : $silueta='';

//LOAD__________________________________________________________________________


//CONTROL_______________________________________________________________________
if(isset($_POST['talla_superior'])){ //Comprobación de $_POST['talla_superior'] porque el campo es obligatorio.
    header('Location: '.$ruta_inicio.'alta-ps/4.php');
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
                                            <?php echo $iM->get_input_img('imagen_categoria', $imagen_categoria, $ruta_archivos, '', 'Puedes subir imágenes tuyas si lo prefieres..', '', true); ?>  
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <?php echo $iM->get_input_radio('talla_superior',$talla_superior,$uM->arr_talla_superior,'flex-wrap d-flex justify-content-center'); ?>
                                                </div>
                                                <div class="col-md-3">
                                                    <?php echo $iM->get_input_radio('talla_inferior',$talla_inferior,$uM->arr_talla_superior,'flex-wrap d-flex justify-content-center'); ?>
                                                </div>
                                                <div class="col-md-3">
                                                    <?php echo $iM->get_input_radio('talla_pecho',$talla_pecho,$uM->arr_talla_pecho,'flex-wrap d-flex justify-content-center'); ?>
                                                </div>
                                                <div class="col-md-3">
                                                    <?php echo $iM->get_input_radio('altura',$altura,$uM->arr_altura,'flex-wrap d-flex justify-content-center'); ?>
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
        $(document).ready(function (e) {
            $(".img-check").click(function () {
                $(".img-check").removeClass("check");
                $(this).toggleClass("check");
            });
        });
    </script>
</body>

</html>