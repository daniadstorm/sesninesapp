<?php
include_once('config/config.inc.php'); //cargando archivo de configuracion

$uM = load_model('usuario'); //uM userModel
$hM = load_model('html');

//GET___________________________________________________________________________

//GET___________________________________________________________________________

//POST__________________________________________________________________________

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
        <div class="container-fluid px-0">
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-9 offset-lg-3 col-xl-10 offset-xl-2 px-0 margen-personalizado">
                    <div id="carouselSesninesHome" class="carousel slide mt-lg-3" data-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img class="d-block w-100 o-80" src="img/slider_1.jpg" alt="First slide">
                            </div>
                        </div>
                    </div>
                    <div class="col-9 col-sm-6 col-md-6 col-lg-6 titulo-sesnines mt-lg-4">
                        <a href="#sesnines">
                            <h3 class="titulo-sn titulo-sobre-sn mt-4 mb-0">sobre ses nïnes</h3>
                        </a>
                    </div>
                    <div class="col-sm-12 texto-sn-qs mt-lg-4">
                        <p>Ses Nines es más que un proyecto: es un reto, un acto en rebeldía contra los estándares establecidos.
                            No todas somos iguales, no todas caminamos al mismo paso. Así pues, de esa necesidad de diferenciación
                            y de escapar de los cánones establecidos, nos encontramos con muchas mujeres que dan el paso
                            y confían en nosotras, que nos vamos conociendo y aprendiendo las unas de las otras, nos vamos
                            humanizando y volviendo a tener esa relación muchas veces perdida bajo la influencia de la gran
                            industria y consumismo.</p>
                        <p>Volvamos a conocernos, vamos a aprender de las personas que nos inspiran, y de recuperar nuestro
                            espacio, sentirnos únicas y especiales. Queremos acompañarte en tu día a día, como tu Personal
                            Shopper, tu compañera. Mejorar tu imagen, potenciarte, sacar lo mejor de ti, y que a través de
                            una mejora en la confianza y seguridad en ti misma alcances o mejores todo lo que te propongas.
                            No nos engañemos, la imagen hoy en día es muy importante. Juzgamos y nos dejamos llevar por primeras
                            impresiones a veces incorrectas, que luego cuestan deshacernos de ellas. Cuántas veces habremos
                            sentido aquello de… “ pues cuando te conocí pensé que eras de una manera u otra “. Porque nos
                            hacemos una idea de cómo es la persona tan sólo por la primera imagen que refleja. Así pues,
                            de una manera u otra pretendemos que la imagen que reflejes sea la imagen que quieres dar. Que
                            tu imagen no esconda, sino que te refleje, que seas tú, que brilles.</p>
                        <p>Pero, ¿quiénes somos? Dentro de Ses Nines podéis encontrarnos a nosotras: Mónica y Lidia, amigas,
                            confidentes, hermanas, mamás, trabajadoras y con una misma ilusión en la que ponemos todo nuestro
                            empeño: la moda, imagen y todo lo que ello conlleva. Expertas en marketing y gestión comercial,
                            la pasión por la moda que nos viene desde nuestra infancia jugando con la ropa de mamá, nos hizo
                            formarnos profesionalmente y hacer de nuestra vocación nuestra forma de sentir, ver, hacer y
                            vivir. Así pues, el 2016 empezó a ver la luz este reto en el que nuestro objetivo es uno: ayudarte.</p>
                        <p>Cada una con nuestra personalidad y puntos de vista. Esto es lo que nos define y nos hace diferentes,
                            a la vez que más fuertes. Entre las dos sumamos para llegar a ti y conocerte. Nos une la pasión
                            por la moda, la necesidad de vernos y sentirnos bien, de que nuestra imagen se corresponda con
                            nuestra identidad.</p>
                        <p>Queremos llegar a ti, porque tú eres única.</p>
                    </div>
                    <div class="col-sm-12 texto-sn-qs mt-lg-4">
                        <div class="contenedor-persona d-flex position-relative">
                            <div class="texto-persona w-100">
                                <div class="mx-2 px-2">
                                    <h1 class="nombre">Lidia</h1>
                                    <div class="img-persona-mvl">
                                            <img src="img/IMG_6009.jpg" class="img-fluid" alt="">
                                        </div>
                                    <p class="mx-4 mt-5">"Me encanta aplicar las tendencias, siempre que las pueda integrar en ti. Jugar, probar,
                                        experimentar... Atrévete, sal de tu zona de confort, yo te ayudo."</p>
                                </div>
                                <div class="mx-2 px-2">
                                    <ul class="lista-persona mt-4">
                                        <li>
                                            <p>- Coach en búsqueda de tu estilo</p>
                                        </li>
                                        <li>
                                            <p>- Conocedora de tendencias</p>
                                        </li>
                                        <li>
                                            <p>- Visión creativa</p>
                                        </li>
                                        <li>
                                            <p>- Armonía arriesgada</p>
                                        </li>
                                        <li>
                                            <p>- La psicología del color</p>
                                        </li>
                                        <li>
                                            <p>- Insipiración mediterraneamente arriesgada</p>
                                        </li>
                                    </ul>
                                </div>
                                
                            </div>
                            <div class="img-persona">
                                <img src="img/IMG_6009.jpg" class="img-fluid" alt="">
                            </div>
                        </div>
                        <div class="contenedor-persona d-flex position-relative mt-5">
                                <div class="img-persona">
                                        <img src="img/IMG_6028.jpg" class="img-fluid" alt="">
                                    </div>
                                <div class="texto-persona w-100">
                                    <div class="mx-2 px-2">
                                        <h1 class="nombre">Mónica</h1>
                                        <div class="img-persona-mvl">
                                                <img src="img/IMG_6028.jpg" class="img-fluid" alt="">
                                            </div>
                                        <p class="mx-4 mt-5">"Para mí, la clave es tener una buena base, un fondo de armario versátil con prendas atemporales que potencie con piezas de tendencia. Resolutiva, natural y práctica."</p>
                                    </div>
                                    <div class="mx-2 px-2">
                                        <ul class="lista-persona mt-4">
                                            <li>
                                                <p>- Coach de tu estilo</p>
                                            </li>
                                            <li>
                                                <p>- Armonía en el look</p>
                                            </li>
                                            <li>
                                                <p>- Visión creativa</p>
                                            </li>
                                            <li>
                                                <p>- Combinaciones versátiles</p>
                                            </li>
                                            <li>
                                                <p>- Colores en equilibrio</p>
                                            </li>
                                            <li>
                                                <p>- Inspiración terral</p>
                                            </li>
                                        </ul>
                                    </div>
                                    
                                </div>
                                
                            </div>
                    </div>
                    <div class="col-lg-10 offset-lg-1 mt-5 mb-5">
                            <h2 class="tu-ps text-center mt-3">Tu Personal Shopper</h2>
                            <a href="">
                                <button class="btn-sesnines-empezamos btn rounded-0 px-5 text-center ml-auto mr-auto mt-4">¿Empezamos?</button>
                            </a>
                        </div>
                        <?php include_once('inc/footer.inc.php'); ?>
                </div>
            </div>
        </div>
    </div>
</body>

</html>