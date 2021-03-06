<?php
include_once('../config/config.inc.php'); //cargando archivo de configuracion

$uM = load_model('usuario'); //uM userModel
$hM = load_model('html');
$iM = load_model('inputs');

include_once('../inc/cabecera.inc.php'); //cargando cabecera

$id_usuario = isset($_SESSION['id_usuario']) ? $_SESSION['id_usuario'] : 0;
$enviarfoto = null;


(isset($_POST['opcion']) ? $_SESSION['opcion']=$_POST['opcion'][0] : '');

if(isset($_POST['vestirdiadia'])){
   
    //$rootM->arrayToString()
    $_SESSION['vestirdiadia'] = (isset($_POST['vestirdiadia']) ? $rootM->arrayToString($_POST['vestirdiadia']) : '');
    $_SESSION['vestirsuperior'] = (isset($_POST['vestirsuperior']) ? $_POST['vestirsuperior'] : '');
    $_SESSION['vestirinferior'] = (isset($_POST['vestirinferior']) ? $_POST['vestirinferior'] : '');
    $_SESSION['colorarmario'] = (isset($_POST['colorarmario']) ? $_POST['colorarmario'] : '');
    $_SESSION['colorfav'] = (isset($_POST['colorfav']) ? $_POST['colorfav'] : '');
    $_SESSION['personaConocida'] = (isset($_POST['personaConocida']) ? $_POST['personaConocida'] : '');
    $_SESSION['actividadOcio'] = (isset($_POST['actividadOcio']) ? $_POST['actividadOcio'] : '');
    $_SESSION['profesion'] = (isset($_POST['profesion']) ? $_POST['profesion'] : '');
    $_SESSION['hijos'] = (isset($_POST['hijos']) ? $_POST['hijos'] : '');
    $_SESSION['frmdatosnombre'] = (isset($_POST['frmdatosnombre']) ? $_POST['frmdatosnombre'] : '');
    $_SESSION['frmdatosapellidos'] = (isset($_POST['frmdatosapellidos']) ? $_POST['frmdatosapellidos'] : '');
    $_SESSION['frmdatosfechanacimiento'] = (isset($_POST['frmdatosfechanacimiento']) ? $_POST['frmdatosfechanacimiento'] : '');
    $_SESSION['frmdatosemail'] = (isset($_POST['frmdatosemail']) ? $_POST['frmdatosemail'] : '');
    $_SESSION['silueta'] = (isset($_POST['silueta']) ? $rootM->arrayToString($_POST['silueta']) : ''); //array
    $_SESSION['tallasuperior'] = (isset($_POST['tallasuperior']) ? $_POST['tallasuperior'] : '');
    $_SESSION['tallainferior'] = (isset($_POST['tallainferior']) ? $_POST['tallainferior'] : '');
    $_SESSION['tallapecho'] = (isset($_POST['tallapecho']) ? $_POST['tallapecho'] : '');
    $_SESSION['altura'] = (isset($_POST['altura']) ? $_POST['altura'] : '');
    $_SESSION['cuerporealzar'] = (isset($_POST['cuerporealzar']) ? $_POST['cuerporealzar'] : '');
    $_SESSION['cuerpodisimular'] = (isset($_POST['cuerpodisimular']) ? $_POST['cuerpodisimular'] : '');
    $_SESSION['tonopiel'] = (isset($_POST['tonopiel']) ? $_POST['tonopiel'] : '');
    $_SESSION['ojos'] = (isset($_POST['ojos']) ? $_POST['ojos'] : '');
    $_SESSION['colorcabello'] = (isset($_POST['colorcabello']) ? $_POST['colorcabello'] : '');
    $_SESSION['enviarfoto'] = (isset($_POST['enviarfoto']) && count($_POST['enviarfoto'])>0 ? $rootM->arrayToString($_POST['enviarfoto']) : ''); //foto
    $_SESSION['listadoprendas'] = (isset($_POST['listadoprendas']) ? $rootM->arrayToString($_POST['listadoprendas']) : '');
    $_SESSION['renovar'] = (isset($_POST['renovar']) ? $rootM->arrayToString($_POST['renovar']) : '');
    $_SESSION['looksasesoria'] = (isset($_POST['looksasesoria']) ? $rootM->arrayToString($_POST['looksasesoria']) : ''); //array
    $_SESSION['otroasesoria'] = (isset($_POST['otroasesoria']) ? $_POST['otroasesoria'] : '');
    $_SESSION['pedirps'] = (isset($_POST['pedirps']) ? $rootM->arrayToString($_POST['pedirps']) : ''); //array
    $_SESSION['pedirpsotros'] = (isset($_POST['pedirpsotros']) ? $_POST['pedirpsotros'] : '');
    $_SESSION['pedirpsfuera'] = (isset($_POST['pedirpsfuera']) ? $rootM->arrayToString($_POST['pedirpsfuera']) : ''); //array
    $_SESSION['pedirpsfueraotros'] = (isset($_POST['pedirpsfueraotros']) ? $_POST['pedirpsfueraotros'] : '');
    $_SESSION['tendencias'] = (isset($_POST['tendencias']) ? $_POST['tendencias'] : '');

    if($id_usuario>0){
        if($uM->existe_ps($id_usuario)>0){
            $rdp = $uM->delete_ps($id_usuario);
            if($rdp){
                $raps = $uM->add_ps_reg($_SESSION['id_usuario'], $_SESSION['opcion'], $_SESSION['vestirdiadia'], $_SESSION['vestirsuperior'], $_SESSION['vestirinferior'], $_SESSION['colorarmario'], $_SESSION['colorfav'], $_SESSION['personaConocida'], $_SESSION['actividadOcio'], $_SESSION['profesion'], $_SESSION['hijos'], $_SESSION['frmdatosnombre'], $_SESSION['frmdatosapellidos'], $_SESSION['frmdatosfechanacimiento'], $_SESSION['frmdatosemail'], $_SESSION['silueta'], $_SESSION['tallasuperior'], $_SESSION['tallainferior'], $_SESSION['tallapecho'], $_SESSION['altura'], $_SESSION['cuerporealzar'], $_SESSION['cuerpodisimular'], $_SESSION['tonopiel'], $_SESSION['ojos'], $_SESSION['colorcabello'], $_SESSION['enviarfoto'], $_SESSION['listadoprendas'], $_SESSION['renovar'], $_SESSION['looksasesoria'], $_SESSION['otroasesoria'], $_SESSION['pedirps'], $_SESSION['pedirpsotros'], $_SESSION['pedirpsfuera'], $_SESSION['pedirpsfueraotros'], $_SESSION['tendencias']);
                if($raps){
                    echo '1- Añadido con éxito';
                    $uM->update_pscompleto($_SESSION['id_usuario'],1);
                }else{
                    echo '1- Fallo al añadir<hr>';
                    $uM->update_pscompleto($_SESSION['id_usuario'],0);
                }
            }
        }else{
            $raps = $uM->add_ps_reg($_SESSION['id_usuario'], $_SESSION['opcion'], $_SESSION['vestirdiadia'], $_SESSION['vestirsuperior'], $_SESSION['vestirinferior'], $_SESSION['colorarmario'], $_SESSION['colorfav'], $_SESSION['personaConocida'], $_SESSION['actividadOcio'], $_SESSION['profesion'], $_SESSION['hijos'], $_SESSION['frmdatosnombre'], $_SESSION['frmdatosapellidos'], $_SESSION['frmdatosfechanacimiento'], $_SESSION['frmdatosemail'], $_SESSION['silueta'], $_SESSION['tallasuperior'], $_SESSION['tallainferior'], $_SESSION['tallapecho'], $_SESSION['altura'], $_SESSION['cuerporealzar'], $_SESSION['cuerpodisimular'], $_SESSION['tonopiel'], $_SESSION['ojos'], $_SESSION['colorcabello'], $_SESSION['enviarfoto'], $_SESSION['listadoprendas'], $_SESSION['renovar'], $_SESSION['looksasesoria'], $_SESSION['otroasesoria'], $_SESSION['pedirps'], $_SESSION['pedirpsotros'], $_SESSION['pedirpsfuera'], $_SESSION['pedirpsfueraotros'], $_SESSION['tendencias']);
            if($raps){
                echo '2- Añadido con éxito';
                $uM->update_pscompleto($_SESSION['id_usuario'],1);
                header('Location: '.$ruta_inicio.'micuenta.php');
            }else{
                echo '2- Fallo al añadir<hr>';
                $uM->update_pscompleto($_SESSION['id_usuario'],0);
            }
        }
    }else{
        //envia a formulario de registro
        header('Location: '.$ruta_inicio.'registro.php');
        exit();
    }
}
    

?>

<body class="top">
    <div class="container">
        <ul class="nav justify-content-center">
            <li class="logo">
                <img src="../img/logo.svg" class="img-fluid" width="192px" alt="">
            </li>
        </ul>
        <div class="progress" style="height: 3px;">
            <div id="pbsn" class="progress-bar sesnines" role="progressbar" style="width: 20%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
        </div>
    </div>
    <?php if(!isset($_REQUEST['opcion'])){ ?>
    <form id="frmpsopcion" action="" method="POST" class="my-3">
        <div id="p0" class="container pregunta-ns <?php echo (!isset($_REQUEST['opcion'])) ? 'show' : ''; ?>">
            <div class="row mt-5">
                <div class="col-md-6 text-center">
                    <label>
                        <img src="http://sesnineshopper.com/adstorm/img/personalshopper.jpg" class="img-ps-select" alt="">
                        <input type="checkbox" name="opcion[]" value="personalshopper" id="item" hidden>
                        <h2 class="mt-3">Personal Shopper</h2>
                    </label>
                </div>
                <div class="col-md-6 text-center">
                    <label>
                        <img src="http://sesnineshopper.com/adstorm/img/fondoarmario.jpg" class="img-ps-select" alt="">
                        <input type="checkbox" name="opcion[]" value="fondoarmario" id="item" hidden>
                        <h2 class="mt-3">Fondo de armario</h2>
                    </label>
                </div>
            </div>
        </div>
    </form>
    <?php }else{ ?>
    <form id="frmps" method="POST" class="my-3">
        <div id="p1" class="container pregunta-ns show">
            <div class="pregunta">
                <h1 class="titulo-sn">Estilo <?php echo $_SESSION['opcion']; ?></h1>
                <h1 class="mb-0">¿Cómo te gusta vestir en tu día a día?</h1>
                <p>(Puedes escoger más de uno)</p>
            </div>
            <div class="row justify-content-center flex-wrap">
                <div class="respuesta-sn col-xs-12 col-sm-4 col-md-2">
                    <label>
                        <img src="<?php echo $ruta_inicio; ?>imgps/DEPORTIVA.jpg" class="img-thumbnail img-check">
                        <input type="checkbox" name="vestirdiadia[]" value="CASUAL DEPORTIVA" id="item" hidden>
                        <p class="text-center">CASUAL DEPORTIVA</p>
                    </label>
                </div>
                <div class="respuesta-sn col-xs-12 col-sm-4 col-md-2">
                    <label>
                        <img src="<?php echo $ruta_inicio; ?>imgps/" class="img-thumbnail img-check">
                        <input type="checkbox" name="vestirdiadia[]" value="CASUAL STREET" id="item" hidden>
                        <p class="text-center">CASUAL STREET</p>
                    </label>
                </div>
                <div class="respuesta-sn col-xs-12 col-sm-4 col-md-2">
                    <label>
                        <img src="<?php echo $ruta_inicio; ?>imgps/CLASICA.jpg" class="img-thumbnail img-check">
                        <input type="checkbox" name="vestirdiadia[]" value="CLASICA" id="item" hidden>
                        <p class="text-center">CLASICA</p>
                    </label>
                </div>
                <div class="respuesta-sn col-xs-12 col-sm-4 col-md-2">
                    <label>
                        <img src="<?php echo $ruta_inicio; ?>imgps/ACTUAL.jpg" class="img-thumbnail img-check">
                        <input type="checkbox" name="vestirdiadia[]" value="ACTUAL" id="item" hidden>
                        <p class="text-center">ACTUAL</p>
                    </label>
                </div>
                <div class="respuesta-sn col-xs-12 col-sm-4 col-md-2">
                    <label>
                        <img src="<?php echo $ruta_inicio; ?>imgps/OFFICE.jpg" class="img-thumbnail img-check">
                        <input type="checkbox" name="vestirdiadia[]" value="OFFICE" id="item" hidden>
                        <p class="text-center">OFFICE</p>
                    </label>
                </div>
                <div class="respuesta-sn col-xs-12 col-sm-4 col-md-2">
                    <label>
                        <img src="<?php echo $ruta_inicio; ?>imgps/SOFISTICADA.jpg" class="img-thumbnail img-check">
                        <input type="checkbox" name="vestirdiadia[]" value="SOFISTICADA" id="item" hidden>
                        <p class="text-center">SOFISTICADA</p>
                    </label>
                </div>
                <div class="respuesta-sn col-xs-12 col-sm-4 col-md-2">
                    <label>
                        <img src="<?php echo $ruta_inicio; ?>imgps/EXTREMADA.jpg" class="img-thumbnail img-check">
                        <input type="checkbox" name="vestirdiadia[]" value="EXTREMADA" id="item" hidden>
                        <p class="text-center">EXTREMADA</p>
                    </label>
                </div>
            </div>
            <div class="pregunta">
                <h1 class="mb-0">¿Cómo sueles vestir?</h1>
            </div>
            <div class="pregunta">
                <h1 class="mb-0">Parte superior</h1>
            </div>
            <div class="d-flex justify-content-around my-3">
                <label class="d-flex justify-content-center align-items-center">
                    <div class="redonda red1 check"></div>
                    <input checked type="radio" name="vestirsuperior" value="holgada" id="item" hidden>
                    <p class="text-center m-0 ml-2">Holgada</p>
                </label>
                <label class="d-flex justify-content-center align-items-center">
                    <div class="redonda red1"></div>
                    <input type="radio" name="vestirsuperior" value="recta" id="item" hidden>
                    <p class="text-center m-0 ml-2">Recta</p>
                </label>
                <label class="d-flex justify-content-center align-items-center">
                    <div class="redonda red1"></div>
                    <input type="radio" name="vestirsuperior" value="entallada" id="item" hidden>
                    <p class="text-center m-0 ml-2">Entallada</p>
                </label>
            </div>
            <div class="pregunta">
                <h1 class="mb-0">Parte inferior</h1>
            </div>
            <div class="d-flex justify-content-around my-3">
                <label class="d-flex justify-content-center align-items-center">
                    <div class="redonda red12 check"></div>
                    <input checked type="radio" name="vestirinferior" value="holgada" id="item" hidden>
                    <p class="text-center m-0 ml-2">Holgada</p>
                </label>
                <label class="d-flex justify-content-center align-items-center">
                    <div class="redonda red12"></div>
                    <input type="radio" name="vestirinferior" value="recta" id="item" hidden>
                    <p class="text-center m-0 ml-2">Recta</p>
                </label>
                <label class="d-flex justify-content-center align-items-center">
                    <div class="redonda red12"></div>
                    <input type="radio" name="vestirinferior" value="entallada" id="item" hidden>
                    <p class="text-center m-0 ml-2">Entallada</p>
                </label>
            </div>
            <div class="pregunta">
                <h1 class="mb-0">¿Qué colores predominan en tu armario?</h1>
            </div>
            <div class="d-flex justify-content-around my-3">
                <textarea id="colorArmario" name="colorarmario" placeholder="Escribe aquí.."></textarea>
            </div>
            <div class="pregunta">
                <h1 class="mb-0">¿Te gustan más lo estampados o eres más de colores lisos?</h1>
            </div>
            <div class="d-flex justify-content-around my-3">
                <label class="d-flex justify-content-center align-items-center">
                    <div class="redonda red2 check"></div>
                    <input checked type="radio" name="colorfav" value="Estampados" id="item" hidden>
                    <p class="text-center m-0 ml-2">Estampados</p>
                </label>
                <label class="d-flex justify-content-center align-items-center">
                    <div class="redonda red2"></div>
                    <input type="radio" name="colorfav" value="coloreslisos" id="item" hidden>
                    <p class="text-center m-0 ml-2">Colores Lisos</p>
                </label>
                <label class="d-flex justify-content-center align-items-center">
                    <div class="redonda red2"></div>
                    <input type="radio" name="colorfav" value="combinados" id="item" hidden>
                    <p class="text-center m-0 ml-2">Combinados</p>
                </label>
            </div>
            <div class="pregunta">
                <h1 class="mb-0">¿Te identificas o te gusta el estilo de una persona conocida?</h1>
            </div>
            <div class="d-flex justify-content-around my-3">
                <textarea id="personaConocida" name="personaConocida" placeholder="Escribe aquí.."></textarea>
            </div>
            <div class="d-flex justify-content-around flex-wrap">
                <input id="btnp1" class="btnFormps" type="button" value="Seguimos conociéndote">
            </div>
        </div>
        <div id="p2" class="container pregunta-ns">
            <div class="pregunta">
                <h1 class="titulo-sn">Sobre mí</h1>
                <h1 class="mb-0">Cuentanos tus actividades de ocio</h1>
            </div>
            <div class="d-flex justify-content-around my-3">
                <textarea id="actividadOcio" name="actividadOcio" class="textareasn" placeholder="Escribe aquí.."></textarea>
            </div>
            <div class="pregunta">
                <h1 class="mb-0">¿A qué te dedicas?</h1>
            </div>
            <div class="d-flex justify-content-around my-3">
                <textarea id="profesion" name="profesion" class="textareasn" placeholder="Escribe aquí.."></textarea>
            </div>
            <div class="pregunta">
                <h1 class="mb-0">¿Tienes hijos?</h1>
            </div>
            <div class="d-flex justify-content-center my-3">
                <label class="d-flex justify-content-center align-items-center mx-5">
                    <div class="redonda redhijos check"></div>
                    <input checked type="radio" name="hijos" value="Si" id="item" hidden>
                    <p class="text-center m-0 ml-2">Si</p>
                </label>
                <label class="d-flex justify-content-center align-items-center mx-5">
                    <div class="redonda redhijos"></div>
                    <input type="radio" name="hijos" value="No" id="item" hidden>
                    <p class="text-center m-0 ml-2">No</p>
                </label>
            </div>
            <div class="pregunta bloque my-4">
                <h1 class="mb-2">Datos personales</h1>
                <div class="borde">
                    <div class="inputs">
                        <input type="text" name="frmdatosnombre" class="inp" placeholder="Nombre">
                        <input type="text" name="frmdatosapellidos" class="inp" placeholder="Apellidos">
                        <input type="date" name="frmdatosfechanacimiento" class="inp" placeholder="Fecha de nacimiento">
                        <input type="email" name="frmdatosemail" class="inp" placeholder="Correo electronico">
                        <label><input type="checkbox" name="politicaprivacidad" id="politicaprivacidad" required> Acepto la <a href="">política de privacidad</a></label>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-around flex-wrap">
                <input id="volverp1" class="btnFormps" type="button" value="Atrás">
                <input id="btnp2" class="btnFormps" type="button" value="¡Vamos!">
            </div>
        </div>
        <div id="p3" class="container pregunta-ns">
            <div class="pregunta">
                <h1 class="titulo-sn">Mi tipología</h1>
                <h1 class="mb-3">Mi silueta es...</h1>
            </div>
            <div class="row justify-content-center flex-wrap">
                <div class="silueta-sn col-xs-12 col-sm-4 col-md-2">
                    <label>
                        <img src="http://sesnineshopper.com/adstorm/img/silueta1.png" class="img-thumbnail img-check-silueta">
                        <input type="radio" name="silueta[]" value="TRIANGULO" id="item" hidden>
                        <p class="text-center">TRIANGULO</p>
                    </label>
                </div>
                <div class="silueta-sn col-xs-12 col-sm-4 col-md-2">
                    <label>
                        <img src="http://sesnineshopper.com/adstorm/img/silueta2.png" class="img-thumbnail img-check-silueta">
                        <input type="radio" name="silueta[]" value="TRIANGULO INVERTIDO" id="item" hidden>
                        <p class="text-center">TRIANGULO INVERTIDO</p>
                    </label>
                </div>
                <div class="silueta-sn col-xs-12 col-sm-4 col-md-2">
                    <label>
                        <img src="http://sesnineshopper.com/adstorm/img/silueta3.png" class="img-thumbnail img-check-silueta">
                        <input type="radio" name="silueta[]" value="RELOJ ARENA" id="item" hidden>
                        <p class="text-center">RELOJ ARENA</p>
                    </label>
                </div>
                <div class="silueta-sn col-xs-12 col-sm-4 col-md-2">
                    <label>
                        <img src="http://sesnineshopper.com/adstorm/img/silueta4.png" class="img-thumbnail img-check-silueta">
                        <input type="radio" name="silueta[]" value="RECTANGULAR" id="item" hidden>
                        <p class="text-center">RECTANGULAR</p>
                    </label>
                </div>
                <div class="silueta-sn col-xs-12 col-sm-4 col-md-2">
                    <label>
                        <img src="http://sesnineshopper.com/adstorm/img/silueta5.png" class="img-thumbnail img-check-silueta">
                        <input type="radio" name="silueta[]" value="REDONDA" id="item" hidden>
                        <p class="text-center">REDONDA</p>
                    </label>
                </div>
            </div>
            <div class="pregunta">
                <h1 class="mb-3">Talla superior</h1>
            </div>
            <div class="d-flex justify-content-center my-3">
                <label class="d-flex justify-content-center align-items-center mx-5">
                    <div class="redonda red3 check"></div>
                    <input checked type="radio" name="tallasuperior" value="34xs" id="item" hidden>
                    <p class="text-center m-0 ml-2">34 / XS</p>
                </label>
                <label class="d-flex justify-content-center align-items-center mx-5">
                    <div class="redonda red3"></div>
                    <input type="radio" name="tallasuperior" value="36s" id="item" hidden>
                    <p class="text-center m-0 ml-2">36 / S</p>
                </label>
                <label class="d-flex justify-content-center align-items-center mx-5">
                    <div class="redonda red3"></div>
                    <input type="radio" name="tallasuperior" value="38m" id="item" hidden>
                    <p class="text-center m-0 ml-2">38 / M</p>
                </label>
                <label class="d-flex justify-content-center align-items-center mx-5">
                    <div class="redonda red3"></div>
                    <input type="radio" name="tallasuperior" value="40l" id="item" hidden>
                    <p class="text-center m-0 ml-2">40 / L</p>
                </label>
                <label class="d-flex justify-content-center align-items-center mx-5">
                    <div class="redonda red3"></div>
                    <input type="radio" name="tallasuperior" value="42xl" id="item" hidden>
                    <p class="text-center m-0 ml-2">42 / XL</p>
                </label>
            </div>
            <div class="pregunta">
                <h1 class="mb-3">Talla inferior</h1>
            </div>
            <div class="d-flex justify-content-center my-3">
                <label class="d-flex justify-content-center align-items-center mx-5">
                    <div class="redonda red4 check"></div>
                    <input checked type="radio" name="tallainferior" value="34xs" id="item" hidden>
                    <p class="text-center m-0 ml-2">34 / XS</p>
                </label>
                <label class="d-flex justify-content-center align-items-center mx-5">
                    <div class="redonda red4"></div>
                    <input type="radio" name="tallainferior" value="36s" id="item" hidden>
                    <p class="text-center m-0 ml-2">36 / S</p>
                </label>
                <label class="d-flex justify-content-center align-items-center mx-5">
                    <div class="redonda red4"></div>
                    <input type="radio" name="tallainferior" value="38m" id="item" hidden>
                    <p class="text-center m-0 ml-2">38 / M</p>
                </label>
                <label class="d-flex justify-content-center align-items-center mx-5">
                    <div class="redonda red4"></div>
                    <input type="radio" name="tallainferior" value="40l" id="item" hidden>
                    <p class="text-center m-0 ml-2">40 / L</p>
                </label>
                <label class="d-flex justify-content-center align-items-center mx-5">
                    <div class="redonda red4"></div>
                    <input type="radio" name="tallainferior" value="42xl" id="item" hidden>
                    <p class="text-center m-0 ml-2">42 / XL</p>
                </label>
            </div>
            <div class="pregunta">
                <h1 class="mb-3">Talla de pecho</h1>
            </div>
            <div class="d-flex justify-content-center align-items-center flex-column">
                <label id="valpecho" class="valuerange">80</label>
                <input id="tallapecho" name="tallapecho" class="sliderrange" type="range" min="80" max="115" step="1" value="80">
            </div>
            <div class="pregunta">
                <h1 class="mb-3">Mi altura es..</h1>
            </div>
            <div class="d-flex justify-content-center align-items-center flex-column">
                <label id="valaltura" class="valuerange">1.5 m</label>
                <input id="altura" name="altura" class="sliderrange" type="range" min="1.50" max="2" value="1.50" step="0.01">
            </div>
            <div class="pregunta">
                <h1 class="mb-0">¿Qué parte de tu cuerpo te gusta más (realzar)?</h1>
            </div>
            <div class="d-flex justify-content-around my-3">
                <textarea id="cuerporealzar" name="cuerporealzar" class="textareasn" placeholder="Escribe aquí.."></textarea>
            </div>
            <div class="pregunta">
                <h1 class="mb-0">¿Qué parte de tu cuerpo te gusta menos (disimular)?</h1>
            </div>
            <div class="d-flex justify-content-around my-3">
                <textarea id="cuerpodisimular" name="cuerpodisimular" class="textareasn" placeholder="Escribe aquí.."></textarea>
            </div>
            <div class="pregunta">
                <h1 class="mb-0">Tono de piel</h1>
            </div>
            <div class="d-flex justify-content-center my-3">
                <label class="d-flex justify-content-center align-items-center mx-5">
                    <div class="redonda-completa redonda rosada red5 check"></div>
                    <input checked type="radio" name="tonopiel" value="rosada" id="item" hidden>
                    <p class="text-center m-0 ml-2">Rosada</p>
                </label>
                <label class="d-flex justify-content-center align-items-center mx-5">
                    <div class="redonda-completa redonda beige red5"></div>
                    <input type="radio" name="tonopiel" value="beige" id="item" hidden>
                    <p class="text-center m-0 ml-2">Beige</p>
                </label>
                <label class="d-flex justify-content-center align-items-center mx-5">
                    <div class="redonda-completa redonda dorada red5"></div>
                    <input type="radio" name="tonopiel" value="dorada" id="item" hidden>
                    <p class="text-center m-0 ml-2">Dorada</p>
                </label>
                <label class="d-flex justify-content-center align-items-center mx-5">
                    <div class="redonda-completa redonda mulata red5"></div>
                    <input type="radio" name="tonopiel" value="mulata" id="item" hidden>
                    <p class="text-center m-0 ml-2">Mulata</p>
                </label>
                <label class="d-flex justify-content-center align-items-center mx-5">
                    <div class="redonda-completa redonda negra red5"></div>
                    <input type="radio" name="tonopiel" value="negra" id="item" hidden>
                    <p class="text-center m-0 ml-2">Negra</p>
                </label>
            </div>
            <div class="pregunta">
                <h1 class="mb-0">Ojos</h1>
            </div>
            <div class="d-flex justify-content-center my-3">
                <label class="d-flex flex-column justify-content-center align-items-center mx-5">
                    <img src="https://lookiero.es/vue-app/src/assets/images/onboarding/eyes/eyes--5.jpg" class="cuadr-ojos azul red6 check">
                    <input checked type="radio" name="ojos" value="azul" id="item" hidden>
                    <p class="text-center m-0 ml-2">Azul</p>
                </label>
                <label class="d-flex flex-column justify-content-center align-items-center mx-5">
                    <img src="https://lookiero.es/vue-app/src/assets/images/onboarding/eyes/eyes--4.jpg" class="cuadr-ojos verde red6">
                    <input type="radio" name="ojos" value="verde" id="item" hidden>
                    <p class="text-center m-0 ml-2">Verde</p>
                </label>
                <label class="d-flex flex-column justify-content-center align-items-center mx-5">
                    <img src="https://lookiero.es/vue-app/src/assets/images/onboarding/eyes/eyes--6.jpg" class="cuadr-ojos gris red6">
                    <input type="radio" name="ojos" value="gris" id="item" hidden>
                    <p class="text-center m-0 ml-2">Gris</p>
                </label>
                <label class="d-flex flex-column justify-content-center align-items-center mx-5">
                    <img src="https://lookiero.es/vue-app/src/assets/images/onboarding/eyes/eyes--2.jpg" class="cuadr-ojos miel red6">
                    <input type="radio" name="ojos" value="miel" id="item" hidden>
                    <p class="text-center m-0 ml-2">Miel</p>
                </label>
                <label class="d-flex flex-column justify-content-center align-items-center mx-5">
                    <img src="https://lookiero.es/vue-app/src/assets/images/onboarding/eyes/eyes--1.jpg" class="cuadr-ojos marron red6">
                    <input type="radio" name="ojos" value="marron" id="item" hidden>
                    <p class="text-center m-0 ml-2">Marron</p>
                </label>
                <label class="d-flex flex-column justify-content-center align-items-center mx-5">
                    <img src="https://lookiero.es/vue-app/src/assets/images/onboarding/eyes/eyes--3.jpg" class="cuadr-ojos negro red6">
                    <input type="radio" name="ojos" value="negro" id="item" hidden>
                    <p class="text-center m-0 ml-2">Negro</p>
                </label>
            </div>
            <div class="pregunta">
                <h1 class="mb-0">Color del cabello</h1>
            </div>
            <div class="d-flex justify-content-around my-3">
                <textarea id="cuerporealzar" name="colorcabello" class="textareasn" placeholder="Escribe aquí.."></textarea>
            </div>
            <div class="pregunta">
                <h1 class="mb-0 ph">Si lo prefieres, puedes enviarnos una foto (max. 2MB) en la que podamos ver la
                    forma de tu silueta. Preferiblemente en leggins y camiseta entallada. <strong color="#color">No te
                        preocupes, toda la información de tu cuenta es totalmente privada.</strong></h1>
            </div>
            <?php echo $iM->get_input_img('enviarfoto', $enviarfoto, $ruta_inicio, '', '', '', true, 5); ?>
            <div class="d-flex justify-content-around flex-wrap">
                <input id="volverp2" class="btnFormps" type="button" value="Atrás">
                <input id="btnp3" class="btnFormps" type="button" value="Un poco más de ti">
            </div>
        </div>
        <div id="p4" class="container pregunta-ns">
            <div class="pregunta">
                <h1 class="titulo-sn">Mi armario</h1>
                <h1 class="mb-3">Listado de prendas que te sueles poner</h1>
            </div>
            <div class="d-flex flex-wrap justify-content-center my-3">
                <label class="d-flex justify-content-center align-items-center mx-5">
                    <div class="cuadrado red7"></div>
                    <input checked type="checkbox" name="listadoprendas[]" value="chaquetasamericanas" id="item" hidden>
                    <p class="text-center m-0 ml-2">Chaquetas / Americanas</p>
                </label>
                <label class="d-flex justify-content-center align-items-center mx-5">
                    <div class="cuadrado red7"></div>
                    <input type="checkbox" name="listadoprendas[]" value="camisas" id="item" hidden>
                    <p class="text-center m-0 ml-2">Camisas</p>
                </label>
                <label class="d-flex justify-content-center align-items-center mx-5">
                    <div class="cuadrado red7"></div>
                    <input type="checkbox" name="listadoprendas[]" value="camisetas" id="item" hidden>
                    <p class="text-center m-0 ml-2">Camisetas</p>
                </label>
                <label class="d-flex justify-content-center align-items-center mx-5">
                    <div class="cuadrado red7"></div>
                    <input type="checkbox" name="listadoprendas[]" value="jerseys" id="item" hidden>
                    <p class="text-center m-0 ml-2">Jerseys</p>
                </label>
                <label class="d-flex justify-content-center align-items-center mx-5">
                    <div class="cuadrado red7"></div>
                    <input type="checkbox" name="listadoprendas[]" value="faldas" id="item" hidden>
                    <p class="text-center m-0 ml-2">Faldas</p>
                </label>
                <label class="d-flex justify-content-center align-items-center mx-5">
                    <div class="cuadrado red7"></div>
                    <input type="checkbox" name="listadoprendas[]" value="pantalones" id="item" hidden>
                    <p class="text-center m-0 ml-2">Pantalones</p>
                </label>
                <label class="d-flex justify-content-center align-items-center mx-5">
                    <div class="cuadrado red7"></div>
                    <input type="checkbox" name="listadoprendas[]" value="tejanos" id="item" hidden>
                    <p class="text-center m-0 ml-2">Tejanos</p>
                </label>
                <label class="d-flex justify-content-center align-items-center mx-5">
                    <div class="cuadrado red7"></div>
                    <input type="checkbox" name="listadoprendas[]" value="vestidos" id="item" hidden>
                    <p class="text-center m-0 ml-2">Vestidos</p>
                </label>
                <label class="d-flex justify-content-center align-items-center mx-5">
                    <div class="cuadrado red7"></div>
                    <input type="checkbox" name="listadoprendas[]" value="monos" id="item" hidden>
                    <p class="text-center m-0 ml-2">Monos</p>
                </label>
                <label class="d-flex justify-content-center align-items-center mx-5">
                    <div class="cuadrado red7"></div>
                    <input type="checkbox" name="listadoprendas[]" value="accesorios" id="item" hidden>
                    <p class="text-center m-0 ml-2">Accesorios</p>
                </label>
            </div>
            <div class="pregunta">
                <h1 class="mb-3">¿Qué necesitarías renovar?</h1>
            </div>
            <div class="d-flex flex-wrap justify-content-center my-3">
                <label class="d-flex justify-content-center align-items-center mx-5">
                    <div class="cuadrado red8"></div>
                    <input checked type="checkbox" name="renovar[]" value="vestido" id="item" hidden>
                    <p class="text-center m-0 ml-2">Vestido</p>
                </label>
                <label class="d-flex justify-content-center align-items-center mx-5">
                    <div class="cuadrado red8"></div>
                    <input type="checkbox" name="renovar[]" value="camisa" id="item" hidden>
                    <p class="text-center m-0 ml-2">Camisa</p>
                </label>
                <label class="d-flex justify-content-center align-items-center mx-5">
                    <div class="cuadrado red8"></div>
                    <input type="checkbox" name="renovar[]" value="tejana" id="item" hidden>
                    <p class="text-center m-0 ml-2">Cazaora cuero / Tejana</p>
                </label>
                <label class="d-flex justify-content-center align-items-center mx-5">
                    <div class="cuadrado red8"></div>
                    <input type="checkbox" name="renovar[]" value="pantalones" id="item" hidden>
                    <p class="text-center m-0 ml-2">Pantalones</p>
                </label>
                <label class="d-flex justify-content-center align-items-center mx-5">
                    <div class="cuadrado red8"></div>
                    <input type="checkbox" name="renovar[]" value="jeans" id="item" hidden>
                    <p class="text-center m-0 ml-2">Jeans</p>
                </label>
                <label class="d-flex justify-content-center align-items-center mx-5">
                    <div class="cuadrado red8"></div>
                    <input type="checkbox" name="renovar[]" value="jerseypunto" id="item" hidden>
                    <p class="text-center m-0 ml-2">Jersey punto</p>
                </label>
                <label class="d-flex justify-content-center align-items-center mx-5">
                    <div class="cuadrado red8"></div>
                    <input type="checkbox" name="renovar[]" value="abrigotrench" id="item" hidden>
                    <p class="text-center m-0 ml-2">Abrigo o Trench</p>
                </label>
            </div>
             <div class="d-flex justify-content-around flex-wrap">
                <input id="volverp3" class="btnFormps" type="button" value="Atrás">
                <input id="btnp4" class="btnFormps" type="button" value="Te queda poco">
            </div>
        </div>
        <div id="p5" class="container pregunta-ns">
            <div class="pregunta">
                <h1 class="titulo-sn">Asesórame</h1>
                <h1 class="mb-3">¿Para qué looks necesitas asesoría?</h1>
            </div>
            <div class="d-flex flex-wrap justify-content-center my-3">
                <label class="d-flex justify-content-center align-items-center mx-5">
                    <div class="cuadrado red9"></div>
                    <input type="checkbox" name="looksasesoria[]" value="trabajo" id="item" hidden>
                    <p class="text-center m-0 ml-2">Para mi trabajo</p>
                </label>
                <label class="d-flex justify-content-center align-items-center mx-5">
                    <div class="cuadrado red9"></div>
                    <input type="checkbox" name="looksasesoria[]" value="tiempolibre" id="item" hidden>
                    <p class="text-center m-0 ml-2">Para mi tiempo libre</p>
                </label>
                <label class="d-flex justify-content-center align-items-center mx-5">
                    <div class="cuadrado red9"></div>
                    <input id="inptOtros" type="checkbox" name="looksasesoria[]" value="otros" id="item" hidden>
                    <p class="text-center m-0 ml-2">Otros</p>
                </label>
            </div>
            <div class="d-flex justify-content-center">
                <textarea id="otroasesoria" name="otroasesoria" class="textareasn my-3 esconderotros" placeholder="Escribe aquí.."></textarea>
            </div>
            <div class="pregunta">
                <h1 class="mb-3">Me apetece pedir mi Personal Shopper porque:</h1>
            </div>
            <div class="d-flex flex-wrap justify-content-center my-3">
                <label class="d-flex justify-content-center align-items-center mx-5">
                    <div class="cuadrado red10"></div>
                    <input type="checkbox" name="pedirps[]" value="estilo" id="item" hidden>
                    <p class="text-center m-0 ml-2">Quiero cambiar mi estilo</p>
                </label>
                <label class="d-flex justify-content-center align-items-center mx-5">
                    <div class="cuadrado red10"></div>
                    <input type="checkbox" name="pedirps[]" value="imagen" id="item" hidden>
                    <p class="text-center m-0 ml-2">Quiero mejorar mi imagen</p>
                </label>
                <label class="d-flex justify-content-center align-items-center mx-5">
                    <div class="cuadrado red10"></div>
                    <input type="checkbox" name="pedirps[]" value="prendasnuevas" id="item" hidden>
                    <p class="text-center m-0 ml-2">Me gustaría arriesgarme y probar prendas nuevas</p>
                </label>
                <label class="d-flex justify-content-center align-items-center mx-5">
                    <div class="cuadrado red10"></div>
                    <input type="checkbox" name="pedirps[]" value="addprendas" id="item" hidden>
                    <p class="text-center m-0 ml-2">Añadir prendas a mi armario y renovarlo</p>
                </label>
                <label class="d-flex justify-content-center align-items-center mx-5">
                    <div class="cuadrado red10"></div>
                    <input type="checkbox" name="pedirps[]" value="nuevoslooks" id="item" hidden>
                    <p class="text-center m-0 ml-2">Conseguir nuevos looks</p>
                </label>
                <label class="d-flex justify-content-center align-items-center mx-5">
                    <div class="cuadrado red10"></div>
                    <input id="inptpsOtros" type="checkbox" name="pedirps[]" value="otros" id="item" hidden>
                    <p class="text-center m-0 ml-2">Otros</p>
                </label>
            </div>
            <div class="d-flex justify-content-center">
                <textarea id="pedirpsotros" name="pedirpsotros" class="textareasn my-3 esconderotros" placeholder="Escribe aquí.."></textarea>
            </div>
            <div class="pregunta">
                <h1 class="mb-3">Me gustaría que mi Personal Shopper fuera:</h1>
            </div>
            <div class="d-flex flex-wrap justify-content-center my-3">
                <label class="d-flex justify-content-center align-items-center mx-5">
                    <div class="redonda red11"></div>
                    <input type="radio" name="pedirpsfuera[]" value="Lidia" id="item" hidden>
                    <p class="text-center m-0 ml-2">Lídia: Sal de tu zona de confort</p>
                </label>
                <label class="d-flex justify-content-center align-items-center mx-5">
                    <div class="redonda red11"></div>
                    <input type="radio" name="pedirpsfuera[]" value="Monica" id="item" hidden>
                    <p class="text-center m-0 ml-2">Mónica: Buen fondo de armario dentro de tu estilo</p>
                </label>
                <label class="d-flex justify-content-center align-items-center mx-5">
                    <div class="redonda red11"></div>
                    <input type="radio" name="pedirpsfuera[]" value="Lidia/Monica" id="item" hidden>
                    <p class="text-center m-0 ml-2">Trabajar conjuntamente</p>
                </label>
            </div>
            <div class="d-flex justify-content-center">
                <textarea id="pedirpsfueraotros" name="pedirpsfueraotros" class="textareasn my-3" placeholder="Escribe aquí.."></textarea>
            </div>
            <div class="pregunta">
                <h1 class="mb-3">Ayudanos a conocerte mejor (sigues las tendencias, tu día a día, algua petición especial...)</h1>
            </div>
            <div class="d-flex justify-content-center">
                <textarea class="textareasn my-3" name="tendencias" placeholder="Escribe aquí.."></textarea>
            </div>
             <div class="d-flex justify-content-around flex-wrap">
                <input id="volverp4" class="btnFormps" type="button" value="Atrás">
                <input id="btnp5" class="btnFormps" type="button" value="Y el último paso">
            </div>
        </div>
    </form>
    <?php } ?>
    <script>
        $(document).ready(function (e) {
            $("input[name='opcion[]']").on('change', function(){
                $("#frmpsopcion").submit();
            });
            $("#btnp1").click(function () {
                $("#p1").toggleClass('show');
                $("#pbsn").css("width", "40%");
                setTimeout(function () {
                    $("#p2").toggleClass('show');
                }, 500);
            });
            $("#volverp1").click(function () {
                $("#p2").toggleClass('show');
                $("#pbsn").css("width", "20%");
                setTimeout(function () {
                    $("#p1").toggleClass('show');
                }, 500);
            });
            $("#btnp2").click(function () {
                $("#p2").toggleClass('show');
                $("#pbsn").css("width", "60%");
                setTimeout(function () {
                    $("#p3").toggleClass('show');
                }, 500);
            });
            $("#volverp2").click(function () {
                $("#p3").toggleClass('show');
                $("#pbsn").css("width", "40%");
                setTimeout(function () {
                    $("#p2").toggleClass('show');
                }, 500);
            });
            $("#btnp3").click(function () {
                $("#p3").toggleClass('show');
                $("#pbsn").css("width", "80%");
                setTimeout(function () {
                    $("#p4").toggleClass('show');
                }, 500);
            });
            $("#volverp3").click(function () {
                $("#p4").toggleClass('show');
                $("#pbsn").css("width", "60%");
                setTimeout(function () {
                    $("#p3").toggleClass('show');
                }, 500);
            });
            $("#btnp4").click(function () {
                $("#p4").toggleClass('show');
                $("#pbsn").css("width", "100%");
                setTimeout(function () {
                    $("#p5").toggleClass('show');
                }, 500);
            });
            $("#volverp4").click(function () {
                $("#p5").toggleClass('show');
                $("#pbsn").css("width", "80%");
                setTimeout(function () {
                    $("#p4").toggleClass('show');
                }, 500);
            });
            $("#btnp5").click(function () {
                $("#frmps").submit();
            });

            $(".red9").click(function () {
                $(this).toggleClass("check");
            });
            $("#inptpsOtros").on('change', function () {
                if ($("#inptpsOtros").prop("checked")) {
                    $("#pedirpsotros").removeClass("esconderotros");
                } else {
                    $("#pedirpsotros").addClass("esconderotros");
                }
            });
            $("#inptOtros").on('change', function () {
                if ($("#inptOtros").prop("checked")) {
                    $("#otroasesoria").removeClass("esconderotros");
                } else {
                    $("#otroasesoria").addClass("esconderotros");
                }
            });
            $("#altura").on('mousemove', function () {
                $("#valaltura").html($(this).val() + " m");
            });
            $("#altura").on('mousedown', function () {
                $("#valaltura").html($(this).val() + " m");
            });
            $("#altura").on('change', function () {
                $("#valaltura").html($(this).val() + " m");
            });

            $("#tallapecho").on('mousemove', function () {
                $("#valpecho").html($(this).val());
            });
            $("#tallapecho").on('mousedown', function () {
                $("#valpecho").html($(this).val());
            });
            $("#tallapecho").on('change', function () {
                $("#valpecho").html($(this).val());
            });
            $(".red10").click(function () {
                $(this).toggleClass("check");
            });
            $(".red11").click(function () {
                $(".red11").removeClass("check");
                $(this).addClass("check");
            });
            $(".red12").click(function () {
                $(".red12").removeClass("check");
                $(this).addClass("check");
            });
            $(".red1").click(function () {
                $(".red1").removeClass("check");
                $(this).addClass("check");
            });
            $(".red2").click(function () {
                $(".red2").removeClass("check");
                $(this).addClass("check");
            });
            $(".redhijos").click(function () {
                $(".redhijos").removeClass("check");
                $(this).addClass("check");
            });
            $(".red3").click(function () {
                $(".red3").removeClass("check");
                $(this).addClass("check");
            });
            $(".red4").click(function () {
                $(".red4").removeClass("check");
                $(this).addClass("check");
            });
            $(".red5").click(function () {
                $(".red5").removeClass("check");
                $(this).addClass("check");
            });
            $(".red6").click(function () {
                $(".red6").removeClass("check");
                $(this).addClass("check");
            });
            $(".red7").click(function () {
                $(this).toggleClass("check");
            });
            $(".red8").click(function () {
                $(this).toggleClass("check");
            });

            $(".img-check-silueta").click(function () {
                $(".img-check-silueta").removeClass("check");
                $(this).toggleClass("check");
            });
            $(".img-check").click(function () {
                $(this).toggleClass("check");
            });
        });
    </script>
</body>

</html>