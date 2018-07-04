<?php

$html_mmnu = '';
$arr_mmnu = array(
    1 => array('txt'=>'Personal Shopper', 'url'=>'#'),
    2 => array('txt'=>'Insp&iacute;rate', 'url'=>'#'),
    3 => array('txt'=>'Regala Personal Shopper', 'url'=>'#'),
    4 => array('txt'=>'Shopping', 'url'=>'#')
);

foreach ($arr_mmnu as $k => $v) {
    //<li class="nav-item active">
      //<a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
    //</li>
    
    //<li class="nav-item">
      //<a class="nav-link" href="#">Link</a>
    //</li>
    
    $html_mmnu .= '<li class="nav-item">';
    $html_mmnu .=   '<a class="nav-link" href="'.$v['url'].'">'.$v['txt'].'</a>';
    $html_mmnu .= '</li>';
}

//POST__________________________________________________________________________
//POST__________________________________________________________________________

//ACCIONES______________________________________________________________________
if (isset($_SESSION['id_tipo_usuario']) && $_SESSION['id_tipo_usuario'] <= USER) { //seguridad;
    
} else {
    
}
//ACCIONES______________________________________________________________________

?>


<header>
    <div class="row">
        <div class="navbar navbar-dark bg-dark fixed-top text-center">
            <div class="col-12">
                <small class="text-light">
                    Suscríbete y tendrás un <b>10% de descuento</b>
                </small>
                <small class="text-light">
                    <a href="#" title="">
                        Cerrar
                    </a>
                </small>
                
            </div>
        </div>
    </div>
    
    <div class="navbar navbar-light bg-light sticky-top">
    
        <a class="navbar-brand" href="<?php echo $ruta_inicio; ?>">
            Ses Nïnes
        </a>
        
        <div>
            <?php
            if(!isset($_SESSION['id_tipo_usuario'])){?>
            <button class="navbar-toggler" type="button">
              <a href="login.php" title="">
                <img src="<?php echo $ruta_archivos; ?>img/mnu-usuario.png" width="24" height="30" />
              </a>
            </button>
            <?php } ?>
            <!-- <button class="navbar-toggler" type="button">
              <a href="login.php" title="">
                <img src="<?php echo $ruta_archivos; ?>img/mnu-usuario.png" width="24" height="30" />
              </a>
            </button> -->

            <button class="navbar-toggler" type="button">
              <a href="#" title="">
                <img src="<?php echo $ruta_archivos; ?>img/mnu-carrito.png" width="24" height="30" />
              </a>
            </button>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
              <img src="<?php echo $ruta_archivos; ?>img/mnu-principal.png" width="24" height="30" />
            </button>    
        </div>
        
        <div class="navbar-collapse collapse" id="navbarCollapse">
            <ul class="navbar-nav mr-auto">
                <?php echo $html_mmnu; ?>
            </ul>
        </div>
        
    </div>

    
    
</header>

