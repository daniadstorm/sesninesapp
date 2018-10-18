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
                        <button id="btn-sesnines-menu" class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
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
        <?php include_once('inc/menu_sh.inc.php'); ?>
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-9 offset-lg-3 col-xl-10 offset-xl-2 px-0 margen-personalizado">
                <div id="carouselSesninesHome" class="carousel slide mt-lg-3" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#carouselSesninesHome" data-slide-to="0" class="active"></li>
                        <li data-target="#carouselSesninesHome" data-slide-to="1"></li>
                        <li data-target="#carouselSesninesHome" data-slide-to="2"></li>
                    </ol>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img class="d-block w-100 o-80" src="img/slider_1.jpg" alt="First slide">
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
                <div class="row mx-0 blq_1 mt-lg-4">
                    <div class="col-9 col-sm-6 col-md-6 col-lg-6 titulo-sesnines mt-lg-4">
                        <a href="#sesnines">
                            <h3 class="titulo-sn mt-4 mb-0">ses nïnes</h3>
                        </a>
                    </div>
                    <div class="col-lg-10 offset-lg-1">
                        <div class="blq_2 mt-5">
                            <p>Bienvenida al lugar del cambio, de la mejora, del sentirte guapa, donde sacaremos tu mejor versión.
                                A partir de ahora, si nos dejas colarnos en tu armario seremos tu Personal Shopper. Porque
                                tú eres única.</p>
                            <p>Que te veas bien, te sientas mejor, ganes en confianza y definas tu personalidad y con ello todo
                                lo que te propongas. Nosotras nos encargamos de asesorarte y llenar tu armario con prendas
                                seleccionadas sólo para ti.</p>
                            <p>Déjate acompañar, prometemos sorprenderte… si has llegado hasta aquí es que algo ya está cambiando
                                en ti.</p>
                        </div>
                    </div>
                    <div class="offset-2 col-10 col-sm-8 offset-sm-4 col-md-6 offset-md-6 col-lg-6 offset-lg-6 titulo-ps mt-4 mb-3">
                        <a href="#sesnines">
                            <h3 class="titulo-sn mt-4 mb-0 titulo-sn-exp">experiencia personal shopper</h3>
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
                        <a href="">
                            <button class="btn-sesnines-empezamos btn rounded-0 px-5 text-center ml-auto mr-auto mt-4">¿Empezamos?</button>
                        </a>
                    </div>
                    <div class="col-lg-11 offset-lg-1 mb-5 mt-4">
                    <div id="carouselBodega" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-target="#carouselBodega" data-slide-to="0" class="active"></li>
                            <li data-target="#carouselBodega" data-slide-to="1"></li>
                            <li data-target="#carouselBodega" data-slide-to="2"></li>
                        </ol>
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <div class="col-md-6 carousel-sesnines-rsp1">
                                    <div class="slider-doble d-flex justify-content-center align-items-center w-100">
                                        <p>hola</p>
                                    </div>
                                </div>
                                <div class="col-md-6 fondo-1">
                                    <!-- <img class="d-block w-100" src="img/slider1.jpg" alt="First slide"> -->
                                </div>
                            </div>
                            <div class="carousel-item">
                                <div class="col-md-6 carousel-sesnines-rsp1">
                                    <div class="slider-doble d-flex justify-content-center align-items-center w-100">
                                        <p>hola</p>
                                    </div>
                                </div>
                                <div class="col-md-6 fondo-1">
                                    <!-- <img class="d-block w-100" src="img/slider1.jpg" alt="First slide"> -->
                                </div>
                            </div>
                            <div class="carousel-item">
                                <div class="col-md-6 carousel-sesnines-rsp1">
                                    <div class="slider-doble d-flex justify-content-center align-items-center w-100">
                                        <p>hola</p>
                                    </div>
                                </div>
                                <div class="col-md-6 fondo-1">
                                    <!-- <img class="d-block w-100" src="img/slider1.jpg" alt="First slide"> -->
                                </div>
                            </div>
                            <!-- <div class="carousel-item">
                                <div class="col-md-6 carousel-sesnines-rsp1">
                                    <div class="slider-doble d-flex justify-content-center align-items-center w-100">
                                        <p>hola</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <img class="d-block w-100" src="img/slider1.jpg" alt="First slide">
                                </div>
                            </div>
                            <div class="carousel-item">
                                <div class="col-md-6 carousel-sesnines-rsp1">
                                    <div class="slider-doble d-flex justify-content-center align-items-center w-100">
                                        <p>hola</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <img class="d-block w-100" src="img/slider1.jpg" alt="First slide">
                                </div>
                            </div> -->
                        </div>
                        <a class="carousel-control-prev" href="#carouselBodega" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselBodega" role="button" data-slide="next">
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
                                    <h3 class="h3-enlace efecto-linea">fashion tips</h3>
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
                    <div class="offset-1 col-11 col-sm-8 offset-sm-4 col-md-6 offset-md-6 col-lg-6 offset-lg-6 titulo-ps mt-5">
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
                                    <p class="texto-tuopinas">“Me ha encantado.. de verdad verdadera. Me han sorprendido un montón, han entendido a la primera lo que buscaba y TODAS las prendas me gustan. Impresionada de lo bien que ha ido el primer pedido. Repetiré seguro"</p>
                                    <h1 class="texto-tuopinas mt-3">A. Aznar</h1>
                                </div>
                            </div>
                            <div class="carousel-item carousel-item-tuopinas">
                                <div class="d-flex flex-column justify-content-center align-items-center">
                                    <h1 class="texto-tuopinas">Quiero felicitaros por el trabajo, se nota que lo habéis leído con detenimiento y os habéis esforzado en ello. Mil gracias porque me han encantado todas las prendas y me habéis sorprendido mucho con los looks</h1>
                                    <h1 class="texto-tuopinas mt-3">E. López</h1>
                                </div>
                            </div>
                            <div class="carousel-item carousel-item-tuopinas">
                                <div class="d-flex flex-column justify-content-center align-items-center">
                                    <h1 class="texto-tuopinas">Hola esta sería la cuarta caja, las dos últimas me las he quedado entera. He salido de compras para renovar el armario junto lo que os compre y me he ido con las manos vacías.. O es muy fea o no le veo el bonito. Así que recurro de nuevo a vosotras”</h1>
                                    <h1 class="texto-tuopinas mt-3">L. Garcia</h1>
                                </div>
                            </div>
                            <div class="carousel-item carousel-item-tuopinas">
                                <div class="d-flex flex-column justify-content-center align-items-center">
                                    <h1 class="texto-tuopinas">"Me ha encantado TODA la selección de prendas que me habéis mandado. Que sepáis q habéis ganado una clienta!! Hablaré por todos lados de vosotras”</h1>
                                    <h1 class="texto-tuopinas mt-3">E.Magaña</h1>
                                </div>
                            </div>
                            <div class="carousel-item carousel-item-tuopinas">
                                <div class="d-flex flex-column justify-content-center align-items-center">
                                    <h1 class="texto-tuopinas">Quedé muy contenta con mi primer pedido. Supisteis entender muy bien lo que buscaba, y me sorprendisteis muchísimo con los looks, además de acertar con las tallas. Fue absolutamente una experiencia de 10. Así que me he animado con una nueva caja.</h1>
                                    <h1 class="texto-tuopinas mt-3">R. Gómez</h1>
                                </div>
                            </div>
                            <div class="carousel-item carousel-item-tuopinas">
                                <div class="d-flex flex-column justify-content-center align-items-center">
                                    <h1 class="texto-tuopinas">Sí, me lo quedo todo. ¡Me ha encantado! Las tallas un acierto total . Cruzo los dedos a ver si para finales de mes puedo pediros otra caja... Estilazo total :-)</h1>
                                    <h1 class="texto-tuopinas mt-3">O. Illana</h1>
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
                        <img src="img/slider_3.JPG" class="img-fluid o-80 w-100" alt="">
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
                                <div class="padding-newsletter">
                                    <h1 class="news">Newsletter</h1>
                                    <p class="news pr-3">Prometemos enviarte solo lo último en tendencias, inspiraciones y recomendaciones. Te
                                        encantará recibirlo.</p>
                                </div>
                            </div>
                            <div class="col-sm-12 col-lg-6">
                                <form action="" class="d-flex flex-column pl-4 pb-4 h-100 justify-content-end">
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
                    <?php include_once('inc/footer.inc.php'); ?>
                </div>
            </div>
        </div>
    </div>
</body>

</html>