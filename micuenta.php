<?php
include_once('config/config.inc.php'); //cargando archivo de configuracion

$uM = load_model('usuario'); //uM userModel
$hM = load_model('html');

$id_usuario = (isset($_SESSION['id_usuario'])) ? $_SESSION['id_usuario'] : 0;

$outps = '';
$ps_completo = '';
$tipo_suscripcion = '';
$suscripciones = array(
    "puntual" => "Puntual",
    "mensual" => "Mensual",
    "bimensual" => "Bimensual",
    "3meses" => "3 Meses",
    "6meses" => "6 Meses",
);
//GET___________________________________________________________________________

//GET___________________________________________________________________________

//POST__________________________________________________________________________

//POST__________________________________________________________________________

//CONTROL_______________________________________________________________________

$rgu = $uM->get_user($id_usuario);
if($rgu){
    while($fgu = $rgu->fetch_assoc()){
        $ps_completo=$fgu["ps_completo"];
        $tipo_suscripcion=$fgu["tipo_suscripcion"];
    }
    foreach ($suscripciones as $key => $value) {
        $outps .= '<label class="d-flex justify-content-center align-items-center m-0">
        <div class="ps-menu';
        $outps .= ($key==$tipo_suscripcion) ? ' check' : '';
        $outps .= '">
            <p class="text-center m-0 ml-2">'.$value.'</p>
        </div>
        <input checked type="radio" name="tipo_suscripcion" value="'.$key.'" id="item" hidden>
        </label>';
    }
}

if(isset($_POST['frm_ps'])){
    echo '<pre>';
    print_r($_POST);
    echo '</pre>';
    if(!$uM->get_ps($id_usuario)){
        $ramp = $uM->add_mi_ps($id_usuario, $_POST['tipo_suscripcion'], $_POST['fechaps'], $_POST['mensajeps']);
    }else{
        $rump = $uM->update_mi_ps($id_usuario, $_POST['tipo_suscripcion'], $_POST['fechaps'], $_POST['mensajeps']);
    }
}

//CONTROL_______________________________________________________________________

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
                        <button id="btn-sesnines-menu" class="navbar-toggler" type="button" data-toggle="collapse"
                            data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                            aria-label="Toggle navigation">
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
                <div id="menuuser" class="container-fluid mt-2">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab"
                                aria-controls="home" aria-selected="true">Inicio</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab"
                                aria-controls="profile" aria-selected="false">Mi cuenta</a>
                        </li>
                        <!-- <li class="nav-item">
                            <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab"
                                aria-controls="contact" aria-selected="false">Contact</a>
                        </li> -->
                    </ul>
                </div>
                <div class="container-fluid">
                    <div class="my-3">
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                <div class="row">
                                    <form method="POST" class="col-xl-8">
                                        <label class="title-menuuser"><strong>Pide tu Personal Shopper</strong></label>
                                        <div id="ps-menu-p" class="d-inline-flex my-1">
                                            <?php echo $outps; ?>
                                        </div>
                                        <div class="d-flex my-3">
                                            <div class="d-flex flex-column ml-3">
                                                <label class="mb-2">¿Cuándo quieres que te llegue?</label>
                                                <div id="pedidofecha"></div>
                                                <input hidden type="date" name="fechaps" id="fechaps">
                                            </div>
                                            <div class="d-flex flex-column ml-3">
                                                <label class="mb-2">Deja un mensaje</label>
                                                <textarea placeholder="Ej: Normalmente visto de azul, gris o negro y siempre voy con camisetas y vaqueros. Me gustaría descubrir otros colores y estilos"
                                                    name="mensajeps" id="mensajeps" cols="40" rows="9"></textarea>
                                            </div>
                                        </div>
                                        <div class="btnenviar">
                                            <button type="submit" name="frm_ps" class="btn btn-lg btn-block p-3 btnsn">Pedir mi Personal Shopper</button>
                                        </div>
                                    </form>
                                    <div class="col-xl-4">
                                        <div class="accordion" id="accordionExample">
                                            <div class="card">
                                                <div class="card-header" id="headingOne">
                                                    <h2 class="mb-0">
                                                        <button class="btn btn-link" type="button" data-toggle="collapse"
                                                            data-target="#collapseOne" aria-expanded="true"
                                                            aria-controls="collapseOne">
                                                            Pedido #1
                                                        </button>
                                                    </h2>
                                                </div>
                                                <div id="collapseOne" class="collapse" aria-labelledby="headingOne"
                                                    data-parent="#accordionExample">
                                                    <div class="card-body">
                                                        uno
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                <div id="micuenta" class="row">
                                    <div class="col-6">
                                        <label class="title-menuuser"><strong>Mi cuenta</strong></label>
                                        <div class="accordion" id="accordionExample">
                                            <div class="card">
                                                <i class="fa fa-sort-down sortsn"></i>
                                                <div class="card-header p-0" id="headingOne">
                                                    <h2 class="mb-0">
                                                        <button class="btn btn-block btn-link btnsnac" type="button" data-toggle="collapse"
                                                            data-target="#miemail" aria-expanded="true"
                                                            aria-controls="miemail">
                                                            Mi email
                                                        </button>
                                                      </h2>
                                                </div>
                                                <form id="miemail" name="frmemail" class="collapse show" aria-labelledby="headingOne"
                                                    data-parent="#accordionExample">
                                                    <div class="card-body">
                                                        <input type="email" name="email" class="form-control frm p-3">
                                                        <button class="btn btn-lg btn-block mt-3 btnsn">Guardar email</button>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="card">
                                                    <i class="fa fa-sort-down sortsn"></i>
                                                    <div class="card-header p-0" id="headingdos">
                                                        <h2 class="mb-0">
                                                            <button class="btn btn-block btn-link btnsnac" type="button" data-toggle="collapse"
                                                                data-target="#mipassord" aria-expanded="true"
                                                                aria-controls="mipassord">
                                                                Mi contraseña
                                                            </button>
                                                          </h2>
                                                    </div>
                                                    <form id="mipassord" name="frmpassword" class="collapse show" aria-labelledby="headingdos"
                                                        data-parent="#accordionExample">
                                                        <div class="card-body">
                                                            <input type="password" class="form-control frm p-3">
                                                            <button class="btn btn-lg btn-block mt-3 btnsn">Cambiar contraseña</button>
                                                        </div>
                                                    </form>
                                                </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">...</div> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script>
    $(document).ready(function (e) {
        $("#pedidofecha").on('change', function () {
            console.log();
            var f = $("#pedidofecha").val().split('/');
            var dia = f[0];
            var mes = f[1];
            var ano = f[2];
            var fecha_final = ano + '-' + mes + '-' + dia;
            $("#fechaps").val(fecha_final);
        });
        $(".ps-menu").click(function () {
            $(".ps-menu").removeClass("check");
            $(this).addClass("check");
        });
        $.datepicker.regional['es'] = {
            closeText: 'Cerrar',
            prevText: '<i class="fa fa-arrow-left"></i>',
            nextText: '<i class="fa fa-arrow-right"></i>',
            currentText: 'Hoy',
            monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
            monthNamesShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
            dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
            dayNamesShort: ['Dom', 'Lun', 'Mar', 'Mié', 'Juv', 'Vie', 'Sáb'],
            dayNamesMin: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sá'],
            weekHeader: 'Sm',
            dateFormat: 'dd/mm/yy',
            firstDay: 1,
            isRTL: false,
            showMonthAfterYear: false,
            yearSuffix: ''
        };
        $.datepicker.setDefaults($.datepicker.regional['es']);
        $("#pedidofecha").datepicker();
    });
</script>

</html>