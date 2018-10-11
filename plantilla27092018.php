<?php
include_once('config/config.inc.php'); //cargando archivo de configuracion

$uM = load_model('usuario'); //uM userModel
$hM = load_model('html');
$nombre_usuario = '';
$contrasenya_usuario = '';

//GET___________________________________________________________________________
if (isset($_GET['unlogin'])) {
    $uM->unlogin_usuario();
}
//GET___________________________________________________________________________

//POST__________________________________________________________________________
if (isset($_POST['nombre_usuario'])) { //si viene de submit de login
    
    $nombre_usuario = $_POST['nombre_usuario'];
    $contrasenya_usuario = $_POST['contrasenya_usuario'];
    
    $result_login = $uM->login_usuario($nombre_usuario, $contrasenya_usuario);
    
    if (strlen($result_login) > 1) {
        $str_errores = $result_login;
    }
}
//POST__________________________________________________________________________

include_once('inc/cabecera.inc.php'); //cargando cabecera
?>
<script type="text/javascript">

</script>

<body>
    <?php include_once('inc/franja_top.inc.php'); ?>
    <?php //include_once('inc/main_menu.inc.php'); ?>

    <div class="container-fluid">
            <div class="d-block d-lg-none">
                    <div class="menu-fijo">
                        <nav class="bg-transparencia-blanco">
                            <div class="navbar navbar-expand-lg navbar-light bg-white">
                                <a class="navbar-brand" href="<?php echo $ruta_inicio; ?>">
                                    <img src="<?php echo $ruta_inicio; ?>img/logo.svg" height="44px" alt="">
                                </a>
                                <button id="btn-sesnines-menu" class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                                    aria-expanded="false" aria-label="Toggle navigation">
                                    <span class="navbar-toggler-icon"></span>
                                </button>
                            </div>
                            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                <ul id="menu-top" class="navbar-nav mr-auto">
                                    <?php echo $html_mmnu; ?>
                                    <div class="row mb-2">
                                        <div class="col-3 d-flex justify-content-center align-items-center">
                                            <img src="img/icon1.svg" width="44px" alt="">
                                        </div>
                                        <div class="col-3 d-flex justify-content-center align-items-center">
                                            <img src="img/icon2.svg" width="44px" alt="">
                                        </div>
                                        <div class="col-3 d-flex justify-content-center align-items-center">
                                            <img src="img/icon3.svg" width="44px" alt="">
                                        </div>
                                        <div class="col-3 d-flex justify-content-center align-items-center">
                                            <img src="img/icon4.svg" width="44px" alt="">
                                        </div>
                                    </div>
                                </ul>
                            </div>
                        </nav>
                    </div>
                </div>
        <div class="row">
            <div class="d-none d-lg-block">
                <div class="col-sm-12 col-md-4 col-lg-3 col-xl-2 position-fixed">
                    <header class="">
                        <div class="logo-sesnines">
                            <img class="img-fluid" src="img/logo.svg" alt="">
                        </div>
                        <div class="menu-sesnines">
                            <ul>
                                <?php echo $html_mmnu; ?>
                            </ul>
                        </div>
                        <div class="info-sesnines mt-5">
                            <ul>
                                <li class="nav-item">
                                    <div class="info">
                                        <div class="img">
                                            <img src="img/icon4.svg" class="img-fluid" alt="">
                                        </div>
                                        <div class="texto">
                                            <p class="mb-0 text-color-marron-claro">Asesoramiento</p>
                                            <p class="mb-0 text-color-marron-claro">Personalizado</p>
                                            <label class="d-flex justify-content-center linea"></label>
                                        </div>
                                    </div>
                                </li>
                                <li class="nav-item">
                                    <div class="info">
                                        <div class="img">
                                            <img src="img/icon2.svg" class="img-fluid" alt="">
                                        </div>
                                        <div class="texto">
                                            <p class="mb-0 text-color-marron-claro">Sin gastos de envío</p>
                                            <p class="mb-0 text-color-marron-claro">ni devolución</p>
                                            <label class="d-flex justify-content-center linea"></label>
                                        </div>
                                    </div>
                                </li>
                                <li class="nav-item">
                                    <div class="info">
                                        <div class="img">
                                            <img src="img/icon1.svg" class="img-fluid" alt="">
                                        </div>
                                        <div class="texto">
                                            <p class="mb-0 text-color-marron-claro">Más compra,</p>
                                            <p class="mb-0 text-color-marron-claro">más descuento</p>
                                            <label class="d-flex justify-content-center linea"></label>
                                        </div>
                                    </div>
                                </li>
                                <li class="nav-item">
                                    <div class="info">
                                        <div class="img">
                                            <img src="img/icon3.svg" class="img-fluid" alt="">
                                        </div>
                                        <div class="texto">
                                            <p class="mb-0 text-color-marron-claro">Pruébatelo,</p>
                                            <p class="mb-0 text-color-marron-claro">tú decides</p>
                                            <label class="d-flex justify-content-center linea"></label>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </header>
                </div>
            </div>
            <div class="col-sm-12 col-md-12 col-lg-9 offset-lg-3 col-xl-10 offset-xl-2 px-0 margen-personalizado">
                <div class="d-none d-lg-block">
                    <nav class="navbar justify-content-end mt-3">
                        <div class="redes-sociales">
                            <a href="https://www.pinterest.es/sesnines/">
                                <img src="img/pinterest.svg" class="logo-rs" alt="">
                            </a>
                            <!-- <img src="img/twitter.svg" class="logo-rs" alt=""> -->
                            <a href="https://www.facebook.com/sesnineshopper/">
                                <img src="img/fb.svg" class="logo-rs" alt="">
                            </a>
                            <a href="https://www.instagram.com/sesnineshopper/">
                                <img src="img/insta.svg" class="logo-rs" alt="">
                            </a>
                        </div>
                        <div class="cuenta">
                            <a href="#contacto">
                                <p class="mb-0">contacto</p>
                            </a>
                            <div class="ln"></div>
                            <a href="http://sesnineshopper.com/index.php">
                                <p class="mb-0">mi cuenta</p>
                            </a>
                        </div>
                    </nav>
                </div>

                <!-- AQUÍ VA EL CONTENIDO -->

            </div>
        </div>
    </div>
</body>
</html>