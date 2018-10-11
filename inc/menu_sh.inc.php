<?php

echo '<div class="row">
<div class="d-none d-lg-block">
    <div class="col-sm-12 col-md-4 col-lg-3 col-xl-2 position-fixed">
        <header class="">
            <div class="logo-sesnines">
                <img class="img-fluid" src="img/logo.svg" alt="">
            </div>
            <div class="menu-sesnines">
                <ul>
                    ';
                    echo $html_mmnu;
                echo '</ul>
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
                <a href="'.$ruta_inicio.'contacto.php">
                    <p class="mb-0">contacto</p>
                </a>
                <div class="ln"></div>
                <a href="'.$ruta_inicio.'login.php">
                    <p class="mb-0">mi cuenta</p>
                </a>
            </div>
        </nav>
    </div>
</div>
</div>';

?>