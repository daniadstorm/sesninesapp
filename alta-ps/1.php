<?php
include_once('../config/config.inc.php'); //cargando archivo de configuracion
//$uM->control_sesion($ruta_inicio, ADMIN);

$fM = load_model('form');
$uM = load_model('usuario'); //uM userModel
$pM = load_model('pedido');
$iM = load_model('inputs');

//ARRAY_________________________________________________________________________
$arr_estilos = array(
    'Holgada' => 'Holgada',
    'Recta' => 'Recta',
    'Entallada' => 'Entallada'
);
$arr_estilos = array(
    'Estampados' => 'Estampados',
    'Colores lisos' => 'Colores lisos'
);
//ARRAY_________________________________________________________________________

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
                                <?php if(isset($_POST)){
                                    echo '<pre>';
                                    print_r($_POST);
                                    echo '</pre>';
                                } ?>
                            </div>
                            <div class="layout-table-item">
                                <div class="layout-table-header">
                                    <h4 class="mb-0">Alta Personal Shopper</h4>
                                </div>
                                <div class="container my-2">
                                    <div class="progress">
                                        <div class="progress-bar progress-bar-striped bg-info" role="progressbar" style="width: 0%" aria-valuenow="20" aria-valuemin="0"
                                            aria-valuemax="100"></div>
                                    </div>
                                </div>
                                <div class="layout-table-content">
                                    <form action="1.php" method="post">
                                        <div id="parte1">
                                            <h3 class="text-center">¿Cómo te gusta vestir en tu dia a dia?</h3>
                                            <div class="row justify-content-center">
                                                <div class="col-xs-12 col-sm-4 col-md-2">
                                                    <label>
                                                        <img src="http://sesnineshopper.com/adstorm/img/casualstreet.jpg" class="img-thumbnail img-check">
                                                        <input type="checkbox" name="check[]" value="img1" id="item" hidden>
                                                        <p class="text-center">Nombre</p>
                                                    </label>
                                                </div>
                                                <div class="col-xs-12 col-sm-4 col-md-2">
                                                    <label>
                                                        <img src="http://sesnineshopper.com/adstorm/img/casualstreet.jpg" class="img-thumbnail img-check">
                                                        <input type="checkbox" name="check[]" value="img2" id="item" hidden>
                                                        <p class="text-center">Nombre</p>
                                                    </label>
                                                </div>
                                                <div class="col-xs-12 col-sm-4 col-md-2">
                                                    <label>
                                                        <img src="http://sesnineshopper.com/adstorm/img/casualstreet.jpg" class="img-thumbnail img-check">
                                                        <input type="checkbox" name="check[]" value="img3" id="item" hidden>
                                                        <p class="text-center">Nombre</p>
                                                    </label>
                                                </div>
                                                <div class="col-xs-12 col-sm-4 col-md-2">
                                                    <label>
                                                        <img src="http://sesnineshopper.com/adstorm/img/casualstreet.jpg" class="img-thumbnail img-check">
                                                        <input type="checkbox" name="check[]" value="img4" id="item" hidden>
                                                        <p class="text-center">Nombre</p>
                                                    </label>
                                                </div>
                                                <div class="col-xs-12 col-sm-4 col-md-2">
                                                    <label>
                                                        <img src="http://sesnineshopper.com/adstorm/img/casualstreet.jpg" class="img-thumbnail img-check">
                                                        <input type="checkbox" name="check[]" value="img5" id="item" hidden>
                                                        <p class="text-center">Nombre</p>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="parte2">
                                            <h3 class="text-center">¿Cómo sueles vestir?</h3>
                                            <div class="row justify-content-center">
                                                <div class="col-md-1 text-center">
                                                    <img class="card-img-top w-50 text-center" src="http://sesnineshopper.com/adstorm/img/chica.png">
                                                    <p>¿Cómo sueles vestir?</p>
                                                    <?php echo $iM->get_combo_array("tipo_estilo",$arr_estilos,"form-control");  ?>
                                                </div>
                                                <div class="col-md-1 text-center">
                                                    <img class="card-img-top w-50 text-center" src="http://sesnineshopper.com/adstorm/img/armario.png">
                                                    <p>¿Cómo sueles vestir?</p>
                                                    <?php echo $iM->get_input_text("tipo_estilo","","form-control");  ?>
                                                </div>
                                                <div class="col-md-1 text-center">
                                                    <img class="card-img-top w-50 text-center" src="http://sesnineshopper.com/adstorm/img/estampados.png">
                                                    <p>¿Cómo sueles vestir?</p>
                                                    <?php echo $iM->get_combo_array("tipo_estilo",$arr_estilos,"form-control");  ?>
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
        $(document).ready(function (e) {
            $(".img-check").click(function () {
                $(this).toggleClass("check");
            });
        });
    </script>
</body>

</html>