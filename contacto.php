<?php
include_once('config/config.inc.php'); //cargando archivo de configuracion

$uM = load_model('usuario'); //uM userModel
$fM = load_model('form');

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
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-9 offset-lg-3 col-xl-10 offset-xl-2 px-0 margen-personalizado">
                    <div class="row mt-5">
                        <div class="col-md-12 col-lg-4 col-xl-6">
                            <p class="ml-4"><strong>¡Hola!</strong> ¿Tienes algún comentario o duda que resolver? Estaremos encantadas de hablar contigo, cuéntanos y enseguida te contestamos, ¿Hablamos?</p>
                        </div>
                        <div class="col-md-12 col-lg-6 col-xl-6">
                            <form id="form-contact" class="mb-5" action="">
                                <h3 class="bb-1 pl-3 pb-1">contacto</h3>
                                <?php echo $fM->get_input_text('contacto_nombre','','',null,'input-sn','Nombre'); ?>
                                <?php echo $fM->get_input_text('contacto_email','','',null,'input-sn','Email'); ?>
                                <?php echo $fM->get_input_textarea('contacto_mensaje','','',null,'input-sn','Mensaje'); ?>
                                <?php echo $fM->get_input_checkbox_text('contacto_terminos','Acepto los terminos, condiciones y política de privacidad','',null,'input-checkbox'); ?>
                                <?php echo $fM->get_input_submit('contacto_submit','','Enviar',null,'input-sn'); ?>
                            </form>
                        </div>
                    </div>
                    <div class="mt-auto">
                        <?php include_once('inc/footer.inc.php'); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>