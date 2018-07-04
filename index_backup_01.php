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

//CONTROL_______________________________________________________________________
if (isset($_SESSION['id_tipo_usuario'])) { //si hay login
    switch ($_SESSION['id_tipo_usuario']) {
        default:
        case USER:
            //header('Location: '.$ruta_inicio.'inicio.php');
            //exit();
        break;
        case ADMIN:
           // header('Location: '.$ruta_inicio.'inicio-administrador.php');
            
           // exit();
        break;
    }
}
//CONTROL_______________________________________________________________________

include_once('inc/cabecera.inc.php'); //cargando cabecera
?>
<script type="text/javascript">
    
</script>
<body>
    <div id="main_container">
        <?php include_once('inc/franja_top.inc.php'); ?>
        <?php include_once('inc/main_menu.inc.php'); ?>
        <section class="section_top">
            <div class="slider">
                <?php echo $hM->get_slider($ruta_inicio); ?>
            </div>
        </section>
        <!--<section class="sep_section"></section>-->
        <section class="middle_section">

        </section>
        <section class="middle_section">
            <div class="cta_asifunciona">
                <p>ASÍ FUNCIONA SESNIENES SHOPPER</p>  
                <img src="https://png.icons8.com/ios/64/ffffff/play-button-circled.png"/>
            </div>
        </section>
        <section class="middle_section">
            <div class="responsive_seccion">
                <div class="blq_asifunciona">
                    <div id="blq_asifunciona_info">
                        <h1>1</h1>
                        <div class="blq_contenido">
                            <h2>AYÚDANOS A CONOCERTE</h2>
                            <p>Crea tu perfil, rellena un formulario con información sobre tu estilo y dinos qué necesitas. Puedes escoger entre un look o un fondo de armario.</p>
                        </div>
                    </div>
                    <div id="blq_asifunciona_info">
                        <h1>2</h1>
                        <div class="blq_contenido bloq_contenido_fijo">
                            <h2>RECIBE TU LOOK PERSONALIZADO</h2>
                            <p>Pruébate en casa las prendas que hemos seleccionado para tí según tu perfil.</p>
                        </div>
                    </div>
                    <div id="blq_asifunciona_info">
                        <h1>3</h1>
                        <div class="blq_contenido bloq_contenido_fijo">
                            <h2>DECIDE LO QUE TE QUEDAS</h2>
                            <p>Tendrás 5 días para decidirte.</p>
                        </div>
                    </div>
                    <div id="blq_asifunciona_info">
                        <h1>&nbsp;</h1>
                        <div class="blq_contenido bloq_contenido_fijo">
                            <h2>DEVOLUCIÓN GRATUITA</h2>
                            <p>Si hay algo que no te encanta, lo podrás devolver gratuitamente. Pagas sólo lo que te quedes.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="sep_section"></section>

        <section class="middle_section">
            <div class="blq_imagenes">
                <div class="img-info">
                    <img src="https://png.icons8.com/ios/64/9BE6D9/hanger.png" alt="">
                    <p>Texto prueba</p>
                </div>
                <div class="img-info">
                    <img src="https://png.icons8.com/windows/64/9BE6D9/circled.png" alt="">
                    <p>Texto prueba</p>
                </div>
                <div class="img-info">
                    <img src="https://png.icons8.com/windows/64/9BE6D9/circled.png" alt="">
                    <p>Texto prueba</p>
                </div>
                <div class="img-info">
                    <img src="https://png.icons8.com/windows/64/9BE6D9/circled.png" alt="">
                    <p>Texto prueba</p>
                </div>
                <div class="img-info">
                    <img src="https://png.icons8.com/windows/64/9BE6D9/circled.png" alt="">
                    <p>Texto prueba</p>
                </div>
            </div>
        </section>

        <section class="middle_section">
            <div class="blq_articulos_ps">
                <p>PERSONAL SHOPPER</p>
                <div class="linea"></div>
                <div class="contenido">
                    <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in.</p>
                </div>
                <img id="imgArticulos" src="https://i.imgur.com/6HzhNlv.png">
                <div>PANTALÓN <strong>DESIRES</strong> 39,90€</div>
                <div>SUDADERA <strong>CKS</strong> 99€</div>
                <div>TOP <strong>TOPSIDE</strong> 18,90€</div>
                <div>CAZADORA <strong>SOO</strong> 54,90€</div>
                <div>MOCHILA <strong>KEVIM PARÍS</strong> 84€</div>
            </div>
        </section>

        <section class="middle_section">
            <div class="blq_pedir_ps">
                <p>PERSONAL SHOPPER</p>
                <div class="linea_pedir_ps"></div>
                <img id="imgModelo" src="https://i.imgur.com/5cHqVc2.png" alt="">
                <div class="blq_ayuda">
                    <div class="blq_centrado">
                        <div class="blq_img">
                            <img src="https://i.imgur.com/3GWgIJA.png">
                        </div>
                        <div class="blq_texto">
                            <h3>Nosotras te ayudamos</h3>
                            <p>Déjate asesorar y recibirás en exclusiva prendas y looks seleccionados para ti.</p>
                        </div>
                    </div>
                </div>
                <div class="blq_btn_pidetups">
                    <div class="blq_btn">
                        <a href="#pide_tu_ps">PIDE TU PERSONAL SHOPPER</a>
                    </div>
                </div>
                <div class="blq_container_newsletter">
                    <div class="bolas1">
                        <div class="blq_contenedor_bola1"><div class="blq_bola"></div></div>
                        <div class="blq_contenedor_bola1"><div class="blq_bola"></div></div>
                        <div class="blq_contenedor_bola1"><div class="blq_bola"></div></div>
                        <div class="blq_contenedor_bola1"><div class="blq_bola"></div></div>
                        <div class="blq_contenedor_bola1"><div class="blq_bola"></div></div>
                        <div class="blq_contenedor_bola1"><div class="blq_bola"></div></div>
                        <div class="blq_contenedor_bola1"><div class="blq_bola"></div></div>
                    </div>
                    <div class="bolas2">
                        <div class="blq_contenedor_bola2"><div class="blq_bola"></div></div>
                        <div class="blq_contenedor_bola2"><div class="blq_bola"></div></div>
                        <div class="blq_contenedor_bola2"><div class="blq_bola"></div></div>
                        <div class="blq_contenedor_bola2"><div class="blq_bola"></div></div>
                        <div class="blq_contenedor_bola2"><div class="blq_bola"></div></div>
                        <div class="blq_contenedor_bola2"><div class="blq_bola"></div></div>
                    </div>
                    <div class="blq_newsletter">
                        <div name="texto">Newsletter<br>Infórmate de todas las novedades, sigue las nuevas tendencias</div>
                        <div name="btnNewsletter">
                            <input type="text" name="correo" placeholder="Tú dirección de correo electronico">
                            <img src="https://png.icons8.com/ios/64/ffffff/chevron-right.png" alt="">
                        </div>
                    </div>
                    
                </div>
            </div>
        </section>

        <section class="middle_section">
            <div class="blq_teencantara">
                <p>TE ENCANTARÁ</p>
                <div class="linea"></div>
                <div class="blq_articulos">
                    <div class="blq_articulo">
                        <div class="blq_img">
                            <img src="https://i.imgur.com/5cHqVc2.png" alt="">
                        </div>
                        <div class="blq_info">
                            <div class="titulo">
                                <p>¿Has encontrado tu estilo 9?</p>
                            </div>
                            <div class="fecha">
                                <p>May 14, 2018 | cat2</p>
                            </div>
                            <div class="descripcion">
                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptate esse consequuntur facilis ipsum, rem ad, eligendi sunt minima explicabo nihil temporibus obcaecati tempora maxime dolorum inventore ab vero asperiores. Consequatur?</p>
                            </div>
                            <div class="vermas">
                                <p>leer más</p>
                            </div>
                        </div>
                    </div>
                    <div class="blq_articulo">
                        <div class="blq_img">
                            <img src="https://i.imgur.com/5cHqVc2.png" alt="">
                        </div>
                        <div class="blq_info">
                            <div class="titulo">
                                <p>¿Has encontrado tu estilo 9?</p>
                            </div>
                            <div class="fecha">
                                <p>May 14, 2018 | cat2</p>
                            </div>
                            <div class="descripcion">
                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptate esse consequuntur facilis ipsum, rem ad, eligendi sunt minima explicabo nihil temporibus obcaecati tempora maxime dolorum inventore ab vero asperiores. Consequatur?</p>
                            </div>
                            <div class="vermas">
                                <p>leer más</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="blq_btn_wordpress">
                    <div class="btn_blog_wordpress">
                        <p>BLOG WORDPRESS</p>
                    </div>
                </div>
            </div>
        </section>

        <section class="middle_section">
            <div class="blq_regala_ps">
                <p>UN REGALO ORIGINAL</p>
                <div class="linea"></div>
                <div class="blq_img">
                    <img src="https://i.imgur.com/5cHqVc2.png">
                </div>
                <div class="blq_info_ps">
                    <img src="https://png.icons8.com/ios/64/000000/wedding-gift.png">
                    <div class="info">
                        <p class="titulo">Regala Personal Shopper</p>
                        <p class="descripcion">Déjate asesorar y recibirás en exclusiva prendas y looks seleccionados sólo para ti.</p>
                    </div>
                </div>
                <div class="blq_btn_regala_ps">
                    <div class="btn_regala_ps">REGALA PERSONAL SHOPPER</div>
                </div>
            </div>
        </section>

        <section class="middle_section">
            <div class="blq_descubre_rrss">
                <p>DESCUBRE NUESTRAS REDES</p>
                <div class="linea"></div>
                <div class="blq_imagenes_redes">
                    <div class="blq_imagen">
                        <img src="https://i.imgur.com/5cHqVc2.png">
                    </div>
                    <div class="blq_imagen">
                        <img src="https://i.imgur.com/lZCTQcp.png">
                    </div>
                    <div class="blq_imagen">
                        <img src="https://i.imgur.com/5cHqVc2.png">
                    </div>
                    <div class="blq_imagen">
                        <img src="https://i.imgur.com/lZCTQcp.png">
                    </div>
                    <div class="blq_imagen">
                        <img src="https://i.imgur.com/5cHqVc2.png">
                    </div>
                    <div class="blq_imagen">
                        <img src="https://i.imgur.com/lZCTQcp.png">
                    </div>
                </div>
                <div class="blq_siguenos_redes">
                    <p>SÍGUENOS EN LAS REDES</p>
                    <div class="imagenes">
                        <div class="img_redes">
                            <a href="#"><img src="https://png.icons8.com/ios/64/000000/facebook-circled-filled.png"></a>
                        </div>
                        <div class="img_redes">
                            <a href="#"><img src="https://png.icons8.com/ios/64/000000/instagram-new.png"></a>
                        </div>
                        <div class="img_redes">
                            <a href="#"><img src="https://png.icons8.com/ios/64/000000/twitter-circled-filled.png"></a>
                        </div>
                        <div class="img_redes">
                            <a href="#"><img src="https://png.icons8.com/ios/64/000000/pinterest-filled.png"></a>
                        </div>
                    </div>
                </div>
                <div class="blq_botones">
                    <div class="btn"><a href="#">PERSONAL SHOPPER</a></div>
                    <div class="btn"><a href="#">BLOG WORDPRESS</a></div>
                    <div class="btn"><a href="#">SOBRE SESNÏNES</a></div>
                    <div class="btn"><a href="#">ECOMMERCE</a></div>
                    <div class="btn"><a href="#">CONTACTO</a></div>
                    <div class="btn"><a href="#">REGALA PERSONAL SHOPPER</a></div>
                </div>
                <div class="blq_politicas">
                    <div class="logo">
                        <img src="<?php echo $ruta_inicio.'img/sesnines.jpg'?>">
                    </div>
                    <div class="lista">
                        <div>
                            <ul>
                                <li><a href="#">Terminos y condiciones de compra</a></li>
                                <li><a href="#">Politica de privacidad</a></li>
                                <li><a href="#">Politica de cookies</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section>
        
        </section>

        <!--<div class="responsive_seccion" style="margin-top: 5px;">
            <a style="float:left; display:inline; border:5px solid red;" href="shopping.php">Shopping</a>
        </div>-->

    </div>
    <?php //include_once('inc/footer.inc.php'); ?>
</body>

</html>