<?php
include_once('config/config.inc.php'); //cargando archivo de configuracion

$uM = load_model('usuario'); //uM userModel
$hM = load_model('html');
/* $nombre_usuario = '';
$contrasenya_usuario = '';
 */
//GET___________________________________________________________________________
/* if (isset($_GET['unlogin'])) {
    $uM->unlogin_usuario();
} */
//GET___________________________________________________________________________

//POST__________________________________________________________________________
/* if (isset($_POST['nombre_usuario'])) { //si viene de submit de login
    
    $nombre_usuario = $_POST['nombre_usuario'];
    $contrasenya_usuario = $_POST['contrasenya_usuario'];
    
    $result_login = $uM->login_usuario($nombre_usuario, $contrasenya_usuario);
    
    if (strlen($result_login) > 1) {
        $str_errores = $result_login;
    }
} */
//POST__________________________________________________________________________

include_once('inc/cabecera.inc.php'); //cargando cabecera
?>
<script type="text/javascript">

</script>

<body>
    <?php include_once('inc/franja_top.inc.php'); ?>
    <?php //include_once('inc/main_menu.inc.php'); ?>

    <div class="container-fluid">
        <div class="row">
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
            <div class="col-sm-12 col-md-8 offset-md-4 col-lg-9 offset-lg-3 col-xl-10 offset-xl-2 px-0">
                <nav class="navbar justify-content-end mt-3">
                    <div class="redes-sociales">
                        <a href="https://www.pinterest.es/sesnines/"><img src="img/pinterest.svg" class="logo-rs" alt=""></a>
                        <!-- <img src="img/twitter.svg" class="logo-rs" alt=""> -->
                        <a href="https://www.facebook.com/sesnineshopper/"><img src="img/fb.svg" class="logo-rs" alt=""></a>
                        <a href="https://www.instagram.com/sesnineshopper/"><img src="img/insta.svg" class="logo-rs" alt=""></a>
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
                <div id="carouselSesninesHome" class="carousel slide mt-3" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#carouselSesninesHome" data-slide-to="0" class="active"></li>
                        <li data-target="#carouselSesninesHome" data-slide-to="1"></li>
                        <li data-target="#carouselSesninesHome" data-slide-to="2"></li>
                    </ol>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img class="d-block w-100 o-80" src="img/slider_1.jpg" alt="First slide">
                        </div>
                        <div class="carousel-item">
                            <img class="d-block w-100 o-80" src="img/slider_2.jpg" alt="Second slide">
                        </div>
                        <div class="carousel-item">
                            <img class="d-block w-100 o-80" src="img/slider_3.jpg" alt="Third slide">
                        </div>
                    </div>
                    <a class="carousel-control-prev o-100" href="#carouselSesninesHome" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next o-100" href="#carouselSesninesHome" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
                <div class="row mx-0 blq_1 mt-4">
                    <div class="col-9 col-sm-6 col-md-6 col-lg-6 titulo-sesnines mt-4">
                        <a href="#sesnines">
                            <h3 class="titulo-sn mt-4 mb-0">ses nïnes</h3>
                        </a>
                    </div>
                    <div class="col-lg-10 offset-lg-1">
                        <div class="blq_2 mt-5">
                            <p>Bienvenida al lugar del cambio, de la mejora, del sentirte guapa, donde sacaremos tu mejor versión.
                                A partir de ahora, si nos dejas colarnos en tu armario seremos tu Personal Shopper. Porque
                                tú eres única.</p>
                            <p>Que te veas bien, te sientas mejor, ganes en confianza y definas tu personalidad y con ello
                                todo lo que te propongas. Nosotras nos encargamos de asesorarte y llenar tu armario con prendas
                                seleccionadas sólo para ti.</p>
                            <p>Déjate acompañar, prometemos sorprenderte… si has llegado hasta aquí es que algo ya está cambiando
                                en ti.</p>
                        </div>
                    </div>
                    <div class="col-12 col-sm-8 offset-sm-4 col-md-6 offset-md-6 col-lg-6 offset-lg-6 titulo-ps mt-4 mb-3">
                        <a href="#sesnines">
                            <h3 class="titulo-sn mt-4 mb-0">experiencia personal shopper</h3>
                        </a>
                    </div>
                    <div class="col-lg-10 offset-lg-1">
                        <!-- <div class="blq_3 mt-5"></div> -->
                        <div class="row blq_3 mt-4">
                            <div class="col-6 col-sm-6 col-md-6 col-lg-4 mt-2 mb-5">
                                <div class="blq_exp_ps">
                                    <img src="img/1.jpg" class="img-fluid" alt="">
                                    <h5 class="titulo">Es tu nueva forma de comprar</h5>
                                    <p class="texto">Tu Personal shopper seleccionará las prendas que mejor te sienten.</p>
                                </div>
                            </div>
                            <div class="col-6 col-sm-6 col-md-6 col-lg-4 mt-2 mb-5">
                                <div class="blq_exp_ps">
                                    <img src="img/2.jpg" class="img-fluid" alt="">
                                    <h5 class="titulo">Somos tus nuevas Personal Shopper</h5>
                                    <p class="texto">Cuéntanos qué necesitas, tu tipología y estilo. ¡Nosotras sacaremos lo mejor de ti! ¿Nos
                                        haces un hueco en tu armario?</p>
                                </div>
                            </div>
                            <div class="col-6 col-sm-6 col-md-6 col-lg-4 mt-2 mb-5">
                                <div class="blq_exp_ps">
                                    <img src="img/3.jpg" class="img-fluid" alt="">
                                    <h5 class="titulo">Un armario irresistible</h5>
                                    <p class="texto">Te enviamos una carta con consejos e indicaciones sobre cómo combinar las prendas.</p>
                                </div>
                            </div>
                            <div class="col-6 col-sm-6 col-md-6 col-lg-4 mt-2 mb-5">
                                <div class="blq_exp_ps">
                                    <img src="img/4.jpg" class="img-fluid" alt="">
                                    <h5 class="titulo">¿Hablamos?</h5>
                                    <p class="texto">Si tienes alguna duda, o nosotras queremos hacerte algún comentario para un mejor servicio,
                                        ¡aquí estamos!
                                    </p>
                                </div>
                            </div>
                            <div class="col-6 col-sm-6 col-md-6 col-lg-4 mt-2 mb-5">
                                <div class="blq_exp_ps">
                                    <img src="img/5.jpg" class="img-fluid" alt="">
                                    <h5 class="titulo">Emoción y sorpresa</h5>
                                    <p class="texto">Porque sabemos que te encanta recibir el paquete preparado con cariño para ti, exclusivo
                                        y único.</p>
                                </div>
                            </div>
                            <div class="col-6 col-sm-6 col-md-6 col-lg-4 mt-2 mb-5">
                                <div class="blq_exp_ps">
                                    <img src="img/6.jpg" class="img-fluid" alt="">
                                    <h5 class="titulo">¡Qué cómodo es!</h5>
                                    <p class="texto">Lo recibes en tu casa, te lo pruebas tranquilamente, y decides qué te quedas. ¡No puede
                                        ser más fácil!</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-10 offset-lg-1">
                        <h2 class="tu-ps text-center mt-3">Tu Personal Shopper</h2>
                        <button class="btn-sesnines-empezamos btn rounded-0 px-5 text-center ml-auto mr-auto mt-4">¿Empezamos?</button>
                    </div>
                    <div class="col-lg-11 offset-lg-1 mb-5 mt-4">
                        <div id="carouselSesninesHome" class="carousel slide mt-5" data-ride="carousel">
                            <ol class="carousel-indicators">
                                <li data-target="#carouselSesninesHome" data-slide-to="0" class="active"></li>
                                <li data-target="#carouselSesninesHome" data-slide-to="1"></li>
                                <li data-target="#carouselSesninesHome" data-slide-to="2"></li>
                            </ol>
                            <div class="carousel-inner">
                                <div class="carousel-item d-flex active">
                                    <div class="contenedor w-100">
                                        <div class="d-flex flex-column align-items-center justify-content-center carousel-sesnines-rsp1 100vh">
                                            <p class="w-70 texto-slider">"Crea un buen fondo de armario con prendas atemporales para hacer mil y una combinaciones.
                                                No tenemos tiempo pero sí ganas de vernos guapas."</p>
                                                <h4 class="w-70 text-right texto-slider">Mónica</h4>
                                        </div>
                                        <img class="d-block carousel-sesnines-rsp2 h-100 o-80" src="img/slider1.jpg" alt="First slide">
                                    </div>
                                </div>
                            </div>
                            <a class="carousel-control-prev carousel-control-prev-mod o-100" href="#carouselSesninesHome" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next carousel-control-next-mod o-100" href="#carouselSesninesHome" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="row mx-0 blq_1">
                    <div class="col-9 col-sm-6 col-md-6 col-lg-6 titulo-sesnines mt-4">
                        <a href="#inspirate">
                            <h3 class="titulo-sn">inspírate</h3>
                        </a>
                    </div>
                </div>
                <div class="row mx-0 blq_2 mt-5">
                    <div class="col-lg-4 mt-2">
                        <div class="cat_inspirate">
                            <div class="imagen">
                                <img src="img/modelo3.jpg" class="img-fluid-personalizado o-80" alt="">
                                <div class="texto">
                                    <!-- <div class="linea-inspirate">___</div> -->
                                    <h3 class="h3-enlace efecto-linea">fasion tips</h3>
                                    <!-- <div class="linea-inspirate">___</div> -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 mt-2">
                        <div class="cat_inspirate">
                            <div class="imagen">
                                <img src="img/modelo2.jpg" class="img-fluid-personalizado o-80" alt="">
                                <div class="texto">
                                    <!-- <div class="linea-inspirate">___</div> -->
                                    <h3 class="h3-enlace efecto-linea">by look</h3>
                                    <!-- <div class="linea-inspirate">___</div> -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 mt-2">
                        <div class="cat_inspirate">
                            <div class="imagen">
                                <img src="img/modelo4.jpg" class="img-fluid-personalizado o-80" alt="">
                                <div class="texto">
                                    <!-- <div class="linea-inspirate">__</div> -->
                                    <h3 class="h3-enlace efecto-linea">moda, beauty &amp; lifestyle</h3>
                                    <!-- <div class="linea-inspirate">__</div> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mx-0 blq_1">
                    <div class="col-12 col-sm-8 offset-sm-4 col-md-6 offset-md-6 col-lg-6 offset-lg-6 titulo-ps mt-5">
                        <a href="#sesnines">
                            <h3 class="titulo-sn mt-4">tú opinas</h3>
                        </a>
                    </div>
                    <div id="carouseltuopinas" class="carousel slide mt-2 mb-2 w-100" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-target="#carouseltuopinas" data-slide-to="0" class="active"></li>
                            <li data-target="#carouseltuopinas" data-slide-to="1"></li>
                            <li data-target="#carouseltuopinas" data-slide-to="2"></li>
                        </ol>
                        <div class="carousel-inner">
                            <div class="carousel-item carousel-item-tuopinas active">
                                <div class="d-flex flex-column justify-content-center align-items-center">
                                    <p class="texto-tuopinas">" Me ha encantado.. de verdad verdadera. Me han sorprendido un montón, han entendido a la primera lo que buscaba y TODAS las prendas me gustan. Impresionada de lo bien que ha ido el primer pedido. Repetiré seguro "</p>
                                    <h1 class="texto-tuopinas mt-3">A. Aznar</h1>
                                </div>
                            </div>
                            <div class="carousel-item carousel-item-tuopinas">
                            <div class="d-flex flex-column justify-content-center align-items-center">
                                    <h1 class="texto-tuopinas">" Me ha encantado.. de verdad verdadera. Me han sorprendido un montón, han entendido a la primera lo que buscaba y TODAS las prendas me gustan. Impresionada de lo bien que ha ido el primer pedido. Repetiré seguro "</h1>
                                    <h1 class="texto-tuopinas mt-3">A. Aznar</h1>
                                </div>
                            </div>
                            <div class="carousel-item carousel-item-tuopinas">
                                <div class="d-flex flex-column justify-content-center align-items-center">
                                    <h1 class="texto-tuopinas">" Me ha encantado.. de verdad verdadera. Me han sorprendido un montón, han entendido a la primera lo que buscaba y TODAS las prendas me gustan. Impresionada de lo bien que ha ido el primer pedido. Repetiré seguro "</h1>
                                    <h1 class="texto-tuopinas mt-3">A. Aznar</h1>
                                </div>
                            </div>
                        </div>
                        <a class="carousel-control-prev carousel-control-prev-mod" href="#carouseltuopinas" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next carousel-control-next-mod" href="#carouseltuopinas" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>
                <div class="row mx-0 blq_3">
                    <div class="col-md-12 px-0 imagen_principal position-relative">
                        <img src="img/slider_3.JPG" class="img-fluid o-80" alt="">
                        <div class="blq_centrado p-4 text-center">
                            <div class="d-flex px-4">
                                <!-- <div class="linea-inspirate tachar">&nbsp;&nbsp;&nbsp;</div> -->
                                <h1 class="titulo efecto-linea">¿Empezamos?</h1>
                                <!-- <div class="linea-inspirate">___</div> -->
                            </div>
                            <h4 class="texto-nrm py-2">
                                <a href="#ps">Personal Shopper</a>
                            </h4>
                            <h4 class="texto-nrm py-2">o</h4>
                            <h4 class="texto-nrm py-2">
                                <a href="#fa">Fondo de Armario</a>
                            </h4>
                        </div>
                    </div>
                    <div class="newsletter col-md-12 position-relative">
                        <div class="row">
                            <div class="col-sm-12 col-lg-6">
                                <div class="p-5">
                                    <h1 class="news">Newsletter</h1>
                                    <p class="news pr-3">Prometemos enviarte solo lo último en tendencias, inspiraciones y recomendaciones. Te
                                        encantará recibirlo.</p>
                                </div>
                            </div>
                            <div class="col-sm-12 col-lg-6">
                                <form action="" class="d-flex flex-column p-4 h-100 justify-content-end">
                                    <div class="mail-pc">
                                        <input id="mail-newsletter" type="text" placeholder="Introduce tu e-mail" class="mr-2 mb-2" name="mail-newsletter">
                                        <button id="btn-mail-newsletter" class="mb-2" type="submit">Suscribirme</button>
                                    </div>
                                    <p id="acepto-terminos" class="d-flex">
                                        <input type="checkbox" name="" class="mr-2">Acepto los términos, condiciones y política de privacidad</p>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="row footer py-5">
                            <div class="col-md-4 brd-right">
                                <div class="logo">
                                    <img class="logo-sesnines-footer" src="img/logo_blanco.svg" alt="">
                                </div>
                                <div class="menu-sesnines-footer pl-4">
                                    <ul>
                                        <li class="nav-item">
                                            <a href="http://sesnineshopper.com/index.php" class="nav-link">mi cuenta</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="" class="nav-link">contacto</a>
                                        </li class="nav-item">
                                        <li class="nav-item">
                                            <form id="frmBuscarfooter" action="" class="d-flex nav-link">
                                                <input type="text" placeholder="Buscar cosas bonitas" class="mr-2">
                                                <button type="submit" class=""></button>
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                                <div class="redes-sociales d-flex justify-content-center">
                                    <a href="https://www.pinterest.es/sesnines/"><img src="img/pin1.svg" class="logo-rs" alt=""></a>
                                    <!-- <img src="img/twitter1.svg" class="logo-rs" alt=""> -->
                                    <a href="https://www.facebook.com/sesnineshopper/"><img src="img/fb1.svg" class="logo-rs" alt=""></a>
                                    <a href="https://www.instagram.com/sesnineshopper/"><img src="img/insta1.svg" class="logo-rs" alt=""></a>
                                </div>
                            </div>
                            <div class="col-md-4 brd-right">
                                <div class="menu-sesnines-footer h-100 d-flex flex-column justify-content-end">
                                    <ul class="">
                                        <?php echo $html_mmnu; ?>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="menu-sesnines-footer h-100 d-flex flex-column justify-content-end">
                                    <ul>
                                        <li class="nav-item">
                                            <a href="http://sesnineshopper.com/content/3-condiciones-de-compra" class="nav-link">términos y condiciones de compra</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="http://sesnineshopper.com/content/5-politica-privacidad" class="nav-link">política de privacidad</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="http://sesnineshopper.com/content/6-politica-cookies" class="nav-link">política de cookies</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="http://sesnineshopper.com/content/2-aviso-legal" class="nav-link">aviso legal</a>
                                        </li>
                                    </ul>
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