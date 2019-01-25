<?php
include_once('config/config.inc.php'); //cargando archivo de configuracion

$uM = load_model('usuario'); //uM userModel
$uM->control_sesion($ruta_inicio, USER);
$hM = load_model('html');
$pM = load_model('pedido');

$id_usuario = (isset($_SESSION['id_usuario'])) ? $_SESSION['id_usuario'] : 0;
$id_pedido = '';
$outps = '';
$ps_completo = '';
$tipo_suscripcion = '';
$outPedido = '';
$outFPedido = '';
$siPedido = false;
$suscripciones = array(
    "puntual" => "Puntual",
    "mensual" => "Mensual",
    "bimensual" => "Bimensual",
    "3meses" => "3 Meses",
    "6meses" => "6 Meses",
);
$errorUpdate = false;
$nombreDE = '';
$direccionDE = '';
$cpDE = '';
$localidadDE = '';
$telefonoDE = '';
$outPedido1 = '';
//GET___________________________________________________________________________

//GET___________________________________________________________________________

//POST__________________________________________________________________________
/* echo '<pre>';
print_r($_POST);
echo '</pre>'; */
if(isset($_POST['btnPedido'])){
    if(isset($_POST['selectPedido'])){
        for($i=0;$i<count($_POST['selectPedido']);$i++){
            $uap = $pM->update_art_pedido($_POST['btnPedido'], $_POST['selectPedido'][$i], 1);
            if(!$uap) $errorUpdate = true;
        }
    }
    if(!$errorUpdate){
        $ueps = $pM->update_estado_pedido_seleccionado($_POST['btnPedido'], 1);
    }
}
if(isset($_POST['updateemail'])){
    $rue = $uM->update_email($_SESSION['id_usuario'], $_POST['updateemail']);
    if($rue){
        $str_info = 'Email actualizado correctamente';
    }else{
        $str_error = 'Error al actualizar el email';
    }
}
if(isset($_POST['updatepassword'])){
    $rue = $uM->update_password($_SESSION['id_usuario'], $_POST['updatepassword']);
    if($rue){
        $str_info = 'Password actualizado correctamente';
    }else{
        $str_error = 'Error al actualizar el Password';
    }
}
if(isset($_POST['paqueteRecibido'])){
    $ruep = $pM->update_estado_pedido($_POST['paqueteRecibido'],2);
}
if(isset($_POST['btndatosenvio'])){
    if($uM->get_existe_datosenvio($id_usuario)>0){
        //update
        $rud = $uM->update_datosenvio($id_usuario, $_POST['nombre'], $_POST['direccion'], $_POST['cp'], $_POST['localidad'], $_POST['telefono']);
        if($rud){
            $str_info =  'Actualizado con éxito';
        }else{
            $str_error =  'Error al actualizar';
        }
    }else{
        //insert
        $rad = $uM->add_datosenvio($id_usuario, $_POST['nombre'], $_POST['direccion'], $_POST['cp'], $_POST['localidad'], $_POST['telefono']);
        if($rad){
            $str_info =  'Insertado con éxito';
        }else{
            $str_error =  'Error al insertar';
        }
    }
}

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
        <input checked type="radio" name="tipo_suscripcion" value="'.$key.'" hidden>
        </label>';
    }
}

$req1 = '';
$req2 = '';
$contReq = 0;
$rgp = $uM->get_usuario_pedidos($id_usuario);
if($rgp){
    while($frgp = $rgp->fetch_assoc()){
        $rgdp = $uM->get_datos_pedido($frgp['id_pedido']);
        if($rgdp){
            $req1 .= '<a class="list-group-item list-group-item-action ';
            if($contReq==0) $req1 .= 'active';
            $req1 .= '" id="list'.$contReq.'-list" data-toggle="list" href="#list'.$contReq.'" role="tab" aria-controls="home">Pedido #4</a>';
            $req2 .= '<div class="tab-pane fade show ';
            if($contReq==0) $req2 .= 'active';
            $req2 .= '" id="list'.$contReq.'" role="tabpanel" aria-labelledby="list'.$contReq.'-list"><ul class="list-group" style="max-width: 400px;">';
            while($frgdp = $rgdp->fetch_assoc()){
                $req2 .= '<li class="list-group-item">'.$frgdp['nombre_articulo'].'</li>';
            }
            $req2 .= '</ul></div>';
        }
    }
}

$rgd = $uM->get_datosenvio($id_usuario);
if($rgd){
    while($frgd = $rgd->fetch_assoc()){
        $nombreDE = $frgd['nombre'];
        $direccionDE = $frgd['direccion'];
        $cpDE = $frgd['cp'];
        $localidadDE = $frgd['localidad'];
        $telefonoDE = $frgd['telefono'];
    }
}

if(isset($_POST['frm_ps'])){
    if(!$uM->get_ps($id_usuario)){
        $ramp = $uM->add_mi_ps($id_usuario, $_POST['tipo_suscripcion'], $_POST['fechaps'], $_POST['mensajeps']);
    }else{
        $rump = $uM->update_mi_ps($id_usuario, $_POST['tipo_suscripcion'], $_POST['fechaps'], $_POST['mensajeps']);
    }
}

$rgpc = $uM->get_pedido_completo($id_usuario);
if($rgpc){
    while($frgpc = $rgpc->fetch_assoc()){
        /* echo '<pre>';
        print_r($frgpc);
        echo '</pre>'; */
        
        $siPedido=true;
        $outPedido .= '<li class="list-group-item p-0">
        <div class="input-group"><div class="input-group-prepend">
        <div class="input-group-text bordertrans"><input type="checkbox" class="selectPed" desc="';
        if($frgpc['descuento_euros_articulo']!=0){
            $outPedido .= $frgpc['descuento_euros_articulo'];
        }else{
            $outPedido .= '0';
        }
        $outPedido .= '" pvp="'.$frgpc['PVP_final_articulo'].'" name="selectPedido[]" value="'.$frgpc['id_articulo'].'"></div></div>
        <div class="form-control bordertrans d-flex justify-content-between align-items-center">
        <h5 class="ml-1 mb-0">'.$frgpc['nombre_articulo'].'</h5><h5 class="ml-1 mb-0">'.$frgpc['PVP_final_articulo'].'€</h5>';
        //if($frgpc['inicio_descuento_articulo']>=date('Y/m/d') && date('Y/m/d')<=$frgpc['fin_descuento_articulo']){
            if($frgpc['descuento_euros_articulo']!=0){
                $outPedido .= '<h5>-'.$frgpc['descuento_euros_articulo'].'€</h5>';
            }else if($frgpc['descuento_porcentaje_articulo']!=0){
                $outPedido .= '<h5>-'.$frgpc['descuento_porcentaje_articulo'].'%</h5>';
            }else{
                $outPedido .= '<h5>0€</h5>';
            }
        //}
        $outPedido .= '</div></div></li>';
        $id_pedido = $frgpc['id_pedido'];
    }
    $outFPedido .= '<div class="accordion mt-3" id="accordionExample">
        <div class="card">
        <div class="card-header" id="headingOne"><h2 class="mb-0">
        <button class="btn btn-block text-left btn-link color-text" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne"> Pedido #'.$id_pedido.'</button></h2></div>
        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample"><div class="card-body">
        <form method="post" class="mb-0" action="">
        <ul class="list-group">'.$outPedido.'
        <li class="list-group-item d-flex justify-content-between mb-0">
        <h5>TOTAL:</h5>
        <h5><span id="boxtotal">0</span>€</h5>
        <h5 id="boxdesc">0</h5>
        </li>
        <li class="list-group-item d-flex justify-content-between mb-0"><input name="descuento" placeholder="COD DESCUENTO" class="form-control"></li>
        <li class="list-group-item">
        <button type="submit" name="btnPedido" value="'.$id_pedido.'" class="btn btn-outline-info btn-lg btn-block">¡Pedir!</button></li>
        </ul></form></div></div></div></div>';
}
//CONTROL_______________________________________________________________________

include_once('inc/cabecera.inc.php'); //cargando cabecera
?>
<script type="text/javascript">
$(document).ready(function(e){
    $(".selectPed").on('change', function(){
        if(this.checked){
            var precio = parseInt($(this).attr("pvp"));
            var total = parseInt($("#boxtotal").html());
            $("#boxtotal").html(total+precio);
        }else{
            var precio = parseInt($(this).attr("pvp"));
            var total = parseInt($("#boxtotal").html());
            $("#boxtotal").html(total-precio);
        }
        var qtt=0;
        for(i=0;i<$(".selectPed").length;i++){
            if($(".selectPed")[i].checked){
                qtt++;
            }
        }
        switch(qtt){
            default:
                $("#boxdesc").html("0%");
                break;
            case 4:
                $("#boxdesc").html("10%");
                break;
            case 5:
                $("#boxdesc").html("20%");
                break;
            case 6:
                $("#boxdesc").html("25%");
                break;
        }
    })
});
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
                        <li class="nav-item">
                            <a class="nav-link" id="historial-tab" data-toggle="tab" href="#historial" role="tab"
                                aria-controls="historial" aria-selected="false">Historial y Evolución</a>
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
                            <div class="tab-pane fade" id="home" role="tabpanel" aria-labelledby="home-tab">
                                <div class="row">
                                    <form method="POST" class="col-xl-12">
                                        <?php
                                            if($pM->get_pedidos_personalshopper_rows($id_usuario, 1)){
                                                echo '<form method="post"><button type="submit" class="btn btn-primary" name="paqueteRecibido" value="'.$id_pedido.'">Ya he recibido mi paquete</button></form>';
                                            }else if($pM->get_pedidos_personalshopper_rows($id_usuario, 2)){
                                                if($siPedido){
                                                    echo $outFPedido;
                                                }
                                            }else if($uM->get_ps($id_usuario)>0){
                                                echo '<h1>Ya hay un pedido en curso</h1>';
                                            }else{
                                        ?>
                                        <div>
                                            <label class="title-menuuser"><strong>Pide tu Personal Shopper</strong></label>
                                            <div id="ps-menu-p" class="d-flex justify-content-center align-items-center my-1 flex-wrap">
                                                <?php echo $outps; ?>
                                            </div>
                                            <div class="d-flex my-3 flex-wrap">
                                                <div class="d-flex flex-column ml-3 my-3">
                                                    <label class="mb-2">¿Cuándo quieres que te llegue?</label>
                                                    <div id="pedidofecha"></div>
                                                    <input hidden type="date" name="fechaps" id="fechaps">
                                                </div>
                                                <div class="d-flex flex-column ml-3 my-3">
                                                    <label class="mb-2">Deja un mensaje</label>
                                                    <textarea placeholder="Ej: Normalmente visto de azul, gris o negro y siempre voy con camisetas y vaqueros. Me gustaría descubrir otros colores y estilos"
                                                        name="mensajeps" id="mensajeps" cols="40" rows="9"></textarea>
                                                </div>
                                            </div>
                                            <div class="btnenviar">
                                                <button type="submit" name="frm_ps" class="btn btn-lg btn-block p-3 btnsn">Pedir mi Personal Shopper</button>
                                            </div>
                                        </div>
                                            <?php } ?>
                                    </form>
                                    <!-- <div class="col-xl-4">
                                        <?php
                                            if($siPedido){
                                                echo $outFPedido;
                                            }
                                        ?>
                                    </div> -->
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
                                                        <button class="btn btn-block btn-link btnsnac" type="button"
                                                            data-toggle="collapse" data-target="#miemail" aria-expanded="true"
                                                            aria-controls="miemail">
                                                            Mi email
                                                        </button>
                                                    </h2>
                                                </div>
                                                <form id="miemail" method="post" name="frmemail" class="collapse show"
                                                    aria-labelledby="headingOne" data-parent="#accordionExample">
                                                    <div class="card-body">
                                                        <input type="email" name="updateemail" class="form-control frm p-3">
                                                        <button class="btn btn-lg btn-block mt-3 btnsn">Guardar email</button>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="card">
                                                <i class="fa fa-sort-down sortsn"></i>
                                                <div class="card-header p-0" id="headingdos">
                                                    <h2 class="mb-0">
                                                        <button class="btn btn-block btn-link btnsnac" type="button"
                                                            data-toggle="collapse" data-target="#mipassord"
                                                            aria-expanded="true" aria-controls="mipassord">
                                                            Mi contraseña
                                                        </button>
                                                    </h2>
                                                </div>
                                                <form id="mipassord" method="post" name="frmpassword" class="collapse show"
                                                    aria-labelledby="headingdos" data-parent="#accordionExample">
                                                    <div class="card-body">
                                                        <input type="password" name="updatepassword" class="form-control frm p-3">
                                                        <button class="btn btn-lg btn-block mt-3 btnsn">Cambiar
                                                            contraseña</button>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="card">
                                                <i class="fa fa-sort-down sortsn"></i>
                                                <div class="card-header p-0" id="headingdos">
                                                    <h2 class="mb-0">
                                                        <form method="post" class="m-0 p-0" action="<?php echo $ruta_inicio; ?>altaps/">
                                                            <button class="btn btn-block btn-link btnsnac" type="submit"
                                                                data-toggle="collapse" data-target="#mips"
                                                                aria-expanded="true" aria-controls="mips">
                                                                Mi Personal Shopper
                                                            </button>
                                                        </form>
                                                    </h2>
                                                </div>
                                            </div>
                                            <div class="card">
                                                <i class="fa fa-sort-down sortsn"></i>
                                                <div class="card-header p-0" id="headingdos">
                                                    <h2 class="mb-0">
                                                        <button class="btn btn-block btn-link btnsnac" type="button"
                                                            data-toggle="collapse" data-target="#datosenvio"
                                                            aria-expanded="true" aria-controls="datosenvio">
                                                            Datos de envío
                                                        </button>
                                                    </h2>
                                                </div>
                                                <form id="datosenvio" method="post" name="datosenvio" class="collapse"
                                                    aria-labelledby="headingdos" data-parent="#accordionExample">
                                                    <div class="card-body">
                                                        <input type="text" value="<?php echo ($nombreDE!='') ? $nombreDE : ''; ?>" placeholder="Nombre" name="nombre" class="form-control mb-2 frm p-3">
                                                        <input type="text" value="<?php echo ($direccionDE!='') ? $direccionDE : ''; ?>" placeholder="Direccion" name="direccion" class="form-control my-2 frm p-3">
                                                        <input type="text" value="<?php echo ($cpDE!='') ? $cpDE : ''; ?>" placeholder="Código postal" name="cp" class="form-control my-2 frm p-3">
                                                        <input type="text" value="<?php echo ($localidadDE!='') ? $localidadDE : ''; ?>" placeholder="Localidad" name="localidad" class="form-control my-2 frm p-3">
                                                        <input type="tel" value="<?php echo ($telefonoDE!='') ? $telefonoDE : ''; ?>" placeholder="Telefono" name="telefono" class="form-control my-2 frm p-3">
                                                        <button name="btndatosenvio" class="btn btn-lg btn-block mt-3 btnsn">Actualizar datos de envío</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade show active" id="historial" role="tabpanel" aria-labelledby="historial-tab">
                                <div class="row">
                                    <div class="d-flex flex-column w-100">
                                        <h1>Mis pedidos</h1>
                                        <div class="row">
                                            <div class="col-2">
                                              <div class="list-group" id="list-tab" role="tablist">
                                                <!-- <a class="list-group-item list-group-item-action active" id="list-home-list" data-toggle="list" href="#list-home" role="tab" aria-controls="home">Pedido #4</a> -->
                                                <!--  -->
                                                <?php echo $req1; ?>
                                              </div>
                                            </div>
                                            <div class="col-10">
                                              <div class="tab-content" id="nav-tabContent">
                                                <!-- <div class="tab-pane fade show active" id="list-home" role="tabpanel" aria-labelledby="list-home-list">
                                                    <ul class="list-group" style="max-width: 400px;"></ul>
                                                </div> -->
                                                <?php echo $req2; ?>
                                                
                                              </div>
                                            </div>
                                          </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script>
    $(document).ready(function (e) {
        var arrayDiasDesactivados = [];
        $("#pedidofecha").on('change', function () {
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

        arrayDiasDesactivados.push("15/01/2019");
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
            yearSuffix: '',
            beforeShowDay: function (date) {
                /* var string = jQuery.datepicker.formatDate('dd/mm/yy', date);
                return [arrayDiasDesactivados.indexOf(string) == -1] */
                var finDeSemana = jQuery.datepicker.noWeekends(date);
                return finDeSemana[0] ? diasFestivos(date) : finDeSemana;
            }
        };
        $.datepicker.setDefaults($.datepicker.regional['es']);
        $("#pedidofecha").datepicker();


    });
    var dte = new Date();
    var diasDesactivados = [dte.getDate(),dte.setDate(dte.getDate() +5)];
    function diasFestivos(date) {
        var m = date.getMonth(), d = date.getDate(), y = date.getFullYear();
        for (i = 0; i < diasDesactivados.length; i++) {
            if ($.inArray((m + 1) + '-' + d + '-' + y, diasDesactivados) != -1 || new Date() > date) {
                return [false];
            }
        }
        return [true];
    }
</script>

</html>