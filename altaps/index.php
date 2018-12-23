<?php
include_once('../config/config.inc.php'); //cargando archivo de configuracion

$uM = load_model('usuario'); //uM userModel
$hM = load_model('html');

include_once('../inc/cabecera.inc.php'); //cargando cabecera

/* echo '<pre>';
print_r($_POST);
echo '</pre>'; */
    

?>

<body class="top">
    <div class="container">
        <ul class="nav justify-content-center">
            <li class="logo">
                <img src="../img/logo.svg" class="img-fluid" width="192px" alt="">
            </li>
        </ul>
        <div class="progress" style="height: 3px;">
            <div id="pbsn" class="progress-bar sesnines" role="progressbar" style="width: 0%;" aria-valuenow="25"
                aria-valuemin="0" aria-valuemax="100"></div>
        </div>
    </div>
    <form action="" method="POST" class="my-3">
        <div id="p1" class="container pregunta-ns">
            <div class="pregunta">
                <h1 class="mb-0">¿Cómo te gusta vestir en tu día a día?</h1>
                <p>(Puedes escoger más de uno)</p>
            </div>
            <div class="row justify-content-center flex-wrap">
                <div class="respuesta-sn col-xs-12 col-sm-4 col-md-2">
                    <label>
                        <img src="http://sesnineshopper.com/adstorm/img/casualstreet.jpg" class="img-thumbnail img-check">
                        <input type="checkbox" name="check[]" value="img1" id="item" hidden>
                        <p class="text-center">CASUAL DEPORTIVA</p>
                    </label>
                </div>
                <div class="respuesta-sn col-xs-12 col-sm-4 col-md-2">
                    <label>
                        <img src="http://sesnineshopper.com/adstorm/img/casualstreet.jpg" class="img-thumbnail img-check">
                        <input type="checkbox" name="check[]" value="img2" id="item" hidden>
                        <p class="text-center">CASUAL STREET</p>
                    </label>
                </div>
                <div class="respuesta-sn col-xs-12 col-sm-4 col-md-2">
                    <label>
                        <img src="http://sesnineshopper.com/adstorm/img/casualstreet.jpg" class="img-thumbnail img-check">
                        <input type="checkbox" name="check[]" value="img3" id="item" hidden>
                        <p class="text-center">CLASICA</p>
                    </label>
                </div>
                <div class="respuesta-sn col-xs-12 col-sm-4 col-md-2">
                    <label>
                        <img src="http://sesnineshopper.com/adstorm/img/casualstreet.jpg" class="img-thumbnail img-check">
                        <input type="checkbox" name="check[]" value="img4" id="item" hidden>
                        <p class="text-center">ACTUAL</p>
                    </label>
                </div>
                <div class="respuesta-sn col-xs-12 col-sm-4 col-md-2">
                    <label>
                        <img src="http://sesnineshopper.com/adstorm/img/casualstreet.jpg" class="img-thumbnail img-check">
                        <input type="checkbox" name="check[]" value="img5" id="item" hidden>
                        <p class="text-center">OFFICE</p>
                    </label>
                </div>
                <div class="respuesta-sn col-xs-12 col-sm-4 col-md-2">
                    <label>
                        <img src="http://sesnineshopper.com/adstorm/img/casualstreet.jpg" class="img-thumbnail img-check">
                        <input type="checkbox" name="check[]" value="img5" id="item" hidden>
                        <p class="text-center">SOFISTICADA</p>
                    </label>
                </div>
                <div class="respuesta-sn col-xs-12 col-sm-4 col-md-2">
                    <label>
                        <img src="http://sesnineshopper.com/adstorm/img/casualstreet.jpg" class="img-thumbnail img-check">
                        <input type="checkbox" name="check[]" value="img5" id="item" hidden>
                        <p class="text-center">EXTREMADA</p>
                    </label>
                </div>
            </div>
            <div class="pregunta">
                <h1 class="mb-0">¿Cómo sueles vestir?</h1>
            </div>
            <div class="d-flex justify-content-around my-3">
                <label class="d-flex justify-content-center align-items-center">
                    <div class="redonda red1 check"></div>
                    <input checked type="radio" name="vestir" value="holgada" id="item" hidden>
                    <p class="text-center m-0 ml-2">Holgada</p>
                </label>
                <label class="d-flex justify-content-center align-items-center">
                    <div class="redonda red1"></div>
                    <input type="radio" name="vestir" value="recta" id="item" hidden>
                    <p class="text-center m-0 ml-2">Recta</p>
                </label>
                <label class="d-flex justify-content-center align-items-center">
                    <div class="redonda red1"></div>
                    <input type="radio" name="vestir" value="entallada" id="item" hidden>
                    <p class="text-center m-0 ml-2">Entallada</p>
                </label>
            </div>
            <div class="pregunta">
                <h1 class="mb-0">¿Qué colores predominan en tu armario?</h1>
            </div>
            <div class="d-flex justify-content-around my-3">
                <textarea id="colorArmario" placeholder="Escribe aquí.."></textarea>
                <!-- <input id="colorArmario" type="text"> -->
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
                <textarea id="personaConocida" placeholder="Escribe aquí.."></textarea>
                <!-- <input id="colorArmario" type="text"> -->
            </div>

            <div class="d-flex justify-content-around flex-wrap">
                <input id="btncancelar" class="btnFormps" type="button" value="Cancelar">
                <input id="btnp1" class="btnFormps" type="button" value="Siguiente">
            </div>
        </div>
        <div id="p2" class="container pregunta-ns">
            <div class="pregunta">
                <h1 class="mb-0">Cuentanos tus actividades de ocio</h1>
            </div>
            <div class="d-flex justify-content-around my-3">
                <textarea id="actividadOcio" class="textareasn" placeholder="Escribe aquí.."></textarea>
                <!-- <input id="colorArmario" type="text"> -->
            </div>
            <div class="pregunta">
                <h1 class="mb-0">¿A qué te dedicas?</h1>
            </div>
            <div class="d-flex justify-content-around my-3">
                <textarea id="profesion" class="textareasn" placeholder="Escribe aquí.."></textarea>
                <!-- <input id="colorArmario" type="text"> -->
            </div>
            <div class="pregunta">
                <h1 class="mb-0">¿Tienes hijos?</h1>
            </div>
            <div class="d-flex justify-content-center my-3">
                <label class="d-flex justify-content-center align-items-center mx-5">
                    <div class="redonda red2 check"></div>
                    <input checked type="radio" name="hijos" value="si" id="item" hidden>
                    <p class="text-center m-0 ml-2">Si</p>
                </label>
                <label class="d-flex justify-content-center align-items-center mx-5">
                    <div class="redonda red2"></div>
                    <input type="radio" name="hijos" value="no" id="item" hidden>
                    <p class="text-center m-0 ml-2">No</p>
                </label>
            </div>
            <div class="pregunta bloque my-4">
                <h1 class="mb-2">Datos personales</h1>
                <div class="borde">
                    <div class="inputs">
                        <input type="text" class="inp" placeholder="Nombre" required>
                        <input type="text" class="inp" placeholder="Apellidos" required>
                        <input type="date" class="inp" placeholder="Fecha de nacimiento" required>
                        <input type="email" class="inp" placeholder="Correo electronico" required>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-around flex-wrap">
                <input id="btncancelar" class="btnFormps" type="button" value="Cancelar">
                <input id="btnp2" class="btnFormps" type="button" value="Siguiente">
            </div>
        </div>
        <div id="p3" class="container pregunta-ns show">
            <div class="pregunta">
                <h1 class="mb-3">Mi silueta es...</h1>
            </div>
            <div class="row justify-content-center flex-wrap">
                <div class="silueta-sn col-xs-12 col-sm-4 col-md-2">
                    <label>
                        <img src="http://sesnineshopper.com/adstorm/img/silueta1.png" class="img-thumbnail img-check-silueta">
                        <input type="radio" name="silueta[]" value="triangulo" id="item" hidden>
                        <p class="text-center">TRIANGULO</p>
                    </label>
                </div>
                <div class="silueta-sn col-xs-12 col-sm-4 col-md-2">
                    <label>
                        <img src="http://sesnineshopper.com/adstorm/img/silueta2.png" class="img-thumbnail img-check-silueta">
                        <input type="radio" name="silueta[]" value="trianguloinvertido" id="item" hidden>
                        <p class="text-center">TRIANGULO INVERTIDO</p>
                    </label>
                </div>
                <div class="silueta-sn col-xs-12 col-sm-4 col-md-2">
                    <label>
                        <img src="http://sesnineshopper.com/adstorm/img/silueta3.png" class="img-thumbnail img-check-silueta">
                        <input type="radio" name="silueta[]" value="relojarena" id="item" hidden>
                        <p class="text-center">RELOJ ARENA</p>
                    </label>
                </div>
                <div class="silueta-sn col-xs-12 col-sm-4 col-md-2">
                    <label>
                        <img src="http://sesnineshopper.com/adstorm/img/silueta4.png" class="img-thumbnail img-check-silueta">
                        <input type="radio" name="silueta[]" value="rectangulo" id="item" hidden>
                        <p class="text-center">RECTANGULAR</p>
                    </label>
                </div>
                <div class="silueta-sn col-xs-12 col-sm-4 col-md-2">
                    <label>
                        <img src="http://sesnineshopper.com/adstorm/img/silueta5.png" class="img-thumbnail img-check-silueta">
                        <input type="radio" name="silueta[]" value="redonda" id="item" hidden>
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
                <input id="tallapecho" class="sliderrange" type="range" min="80" max="115" step="1" value="80">
            </div>
            <div class="pregunta">
                <h1 class="mb-3">Mi altura es..</h1>
            </div>
            <div class="d-flex justify-content-center align-items-center flex-column">
                <label id="valaltura" class="valuerange">1.5 m</label>
                <input id="altura" class="sliderrange" type="range" min="1.50" max="2" value="1.50" step="0.01">
            </div>
            <div class="pregunta">
                <h1 class="mb-0">¿Qué parte de tu cuerpo te gusta más (realzar)?</h1>
            </div>
            <div class="d-flex justify-content-around my-3">
                <textarea id="cuerporealzar" name="cuerporealzar" class="textareasn" placeholder="Escribe aquí.."></textarea>
                <!-- <input id="colorArmario" type="text"> -->
            </div>
            <div class="pregunta">
                <h1 class="mb-0">¿Qué parte de tu cuerpo te gusta menos (disimular)?</h1>
            </div>
            <div class="d-flex justify-content-around my-3">
                <textarea id="cuerporealzar" name="cuerpodisimular" class="textareasn" placeholder="Escribe aquí.."></textarea>
                <!-- <input id="colorArmario" type="text"> -->
            </div>
            <div class="pregunta">
                <h1 class="mb-0">Tono de piel</h1>
            </div>
            <div class="d-flex justify-content-center my-3">
                <label class="d-flex justify-content-center align-items-center mx-5">
                    <div class="redonda rosada red5 check"></div>
                    <input checked type="radio" name="tonopiel" value="rosada" id="item" hidden>
                    <p class="text-center m-0 ml-2">Rosada</p>
                </label>
                <label class="d-flex justify-content-center align-items-center mx-5">
                    <div class="redonda beige red5"></div>
                    <input type="radio" name="tonopiel" value="beige" id="item" hidden>
                    <p class="text-center m-0 ml-2">Beige</p>
                </label>
                <label class="d-flex justify-content-center align-items-center mx-5">
                    <div class="redonda dorada red5"></div>
                    <input type="radio" name="tonopiel" value="dorada" id="item" hidden>
                    <p class="text-center m-0 ml-2">Dorada</p>
                </label>
                <label class="d-flex justify-content-center align-items-center mx-5">
                    <div class="redonda mulata red5"></div>
                    <input type="radio" name="tonopiel" value="mulata" id="item" hidden>
                    <p class="text-center m-0 ml-2">Mulata</p>
                </label>
                <label class="d-flex justify-content-center align-items-center mx-5">
                    <div class="redonda negra red5"></div>
                    <input type="radio" name="tonopiel" value="negra" id="item" hidden>
                    <p class="text-center m-0 ml-2">Negra</p>
                </label>
            </div>
            <div class="pregunta">
                <h1 class="mb-0">Ojos</h1>
            </div>
            <div class="d-flex justify-content-center my-3">
                <label class="d-flex justify-content-center align-items-center mx-5">
                    <div class="redonda rosada red5 check"></div>
                    <input checked type="radio" name="ojos" value="rosada" id="item" hidden>
                    <p class="text-center m-0 ml-2">Rosada</p>
                </label>
                <label class="d-flex justify-content-center align-items-center mx-5">
                    <div class="redonda beige red5"></div>
                    <input type="radio" name="ojos" value="beige" id="item" hidden>
                    <p class="text-center m-0 ml-2">Beige</p>
                </label>
                <label class="d-flex justify-content-center align-items-center mx-5">
                    <div class="redonda dorada red5"></div>
                    <input type="radio" name="ojos" value="dorada" id="item" hidden>
                    <p class="text-center m-0 ml-2">Dorada</p>
                </label>
                <label class="d-flex justify-content-center align-items-center mx-5">
                    <div class="redonda mulata red5"></div>
                    <input type="radio" name="ojos" value="mulata" id="item" hidden>
                    <p class="text-center m-0 ml-2">Mulata</p>
                </label>
                <label class="d-flex justify-content-center align-items-center mx-5">
                    <div class="redonda negra red5"></div>
                    <input type="radio" name="ojos" value="negra" id="item" hidden>
                    <p class="text-center m-0 ml-2">Negra</p>
                </label>
            </div>

        </div>

    </form>
    <script>
        $(document).ready(function (e) {
            /* $(".redonda").click(function () {
                $(".redonda").removeClass("check");
                $(this).addClass("check");
            }); */
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
            $(".red1").click(function () {
                $(".red1").removeClass("check");
                $(this).addClass("check");
            });
            $(".red2").click(function () {
                $(".red2").removeClass("check");
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
            $(".img-check-silueta").click(function () {
                $(".img-check-silueta").removeClass("check");
                $(this).toggleClass("check");
            });
            $(".img-check").click(function () {
                $(this).toggleClass("check");
            });
            $("#btnp1").click(function () {
                $("#p1").toggleClass('show');
                $("#pbsn").css("width", "20%");
                setTimeout(function () {
                    $("#p2").toggleClass('show');
                }, 500);
            });
            $("#btnp2").click(function () {
                $("#p2").toggleClass('show');
                $("#pbsn").css("width", "40%");
                setTimeout(function () {
                    $("#p3").toggleClass('show');
                }, 500);
            });
        });
    </script>
</body>

</html>