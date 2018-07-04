<?php

$uM = load_model('usuario');
$aux_control_sesion = $uM->control_sesion($ruta_inicio, USER, false);

function build_menu_opt($opt) {
    /* $op = '';
    $op .= '<div class="'.$opt['class'].'">';
    $op .=   '<a href="'.$opt['dest'].'" style="border-top:none;">';
    $op .=       '<div style="float:left;"><img src="'.$opt['img'].'" class="opt_menu_icon" /></div>';
    $op .=       '<div style="float:left;margin-top:4px;">'.$opt['ttl'].'</div>';
    $op .=       '<div style="clear:both;"></div>';
    $op .=   '</a>';
    $op .= '</div>'; */
    $op = '';
    /* $op .= '<li class="nav-item">';
    $op .=   '<a class="nav-link" href="'.$opt['dest'].'">'.$opt['ttl'].'</a>';
    $op .= '</li>'; */
    $op .=  '<li class="nav-item">';
    $op .=  '<a class="nav-link mt-2 mr-2 bg-secondary text-light" href="'.$opt['dest'].'">'.$opt['ttl'].'</a>';
    $op .=  '</li>';
    return $op;
}

$ruta = $_SERVER['PHP_SELF'];
$seccion = basename($ruta);

if ($aux_control_sesion == true) {

    switch ($_SESSION['id_tipo_usuario']) {
        case ADMIN:
            $arrMnu = array(
                0=>array('ttl'=>'Inicio Administrador', 'dest'=>$ruta_inicio.'inicio-administrador.php', 'img'=>$ruta_inicio.'img/inicio.png', 'class'=>'opt_menu'),
                1=>array('ttl'=>'Pedidos', 'dest'=>$ruta_inicio.'pedidos.php', 'img'=>$ruta_inicio.'img/pedido.png', 'class'=>'opt_menu'),
                //2=>array('ttl'=>'Grupos Puntos', 'dest'=>$ruta_inicio.'grupos-puntos.php', 'img'=>$ruta_inicio.'img/categorias.png', 'class'=>'opt_menu'),
               // 3=>array('ttl'=>'Comisiones', 'dest'=>$ruta_inicio.'comisiones.php', 'img'=>$ruta_inicio.'img/comision.png', 'class'=>'opt_menu'),
               // 4=>array('ttl'=>'Objetivos', 'dest'=>$ruta_inicio.'objetivos.php', 'img'=>$ruta_inicio.'img/objetivos.png', 'class'=>'opt_menu'),
               // 5=>array('ttl'=>'P\'S / Consecución', 'dest'=>$ruta_inicio.'informe-objetivos.php', 'img'=>$ruta_inicio.'img/favorito.png', 'class'=>'opt_menu'),
                6=>array('ttl'=>'Usuarios', 'dest'=>$ruta_inicio.'clientes.php', 'img'=>$ruta_inicio.'img/usuarios.png', 'class'=>'opt_menu'),
               // 7=>array('ttl'=>'Tiendas VF', 'dest'=>$ruta_inicio.'tiendasvf.php', 'img'=>$ruta_inicio.'img/header-logo-vf.png', 'class'=>'opt_menu'),
               // 8=>array('ttl'=>'Reportes', 'dest'=>$ruta_inicio.'ver-reportes.php', 'img'=>$ruta_inicio.'img/reportes.png', 'class'=>'opt_menu'),
                9=>array('ttl'=>'Art&iacute;culos', 'dest'=>$ruta_inicio.'articulos.php', 'img'=>$ruta_inicio.'img/articulos.png', 'class'=>'opt_menu'),
                10=>array('ttl'=>'Categorías', 'dest'=>'categorias.php', 'img'=>'img/categorias.png', 'class'=>'opt_menu'),
                11=>array('ttl'=>'Cerrar sesión', 'dest'=>$ruta_inicio.'login.php?unlogin=true', 'img'=>$ruta_inicio.'img/cerrar.png', 'class'=>'opt_menu'),
            );
        break;
        case USER:
            $arrMnu = array(
                0=>array('ttl'=>'Inicio '.$_SESSION['nombrecompleto_usuario'], 'dest'=>$ruta_inicio.'inicio.php', 'img'=>$ruta_inicio.'img/inicio.png', 'class'=>'opt_menu'),
                1=>array('ttl'=>'Mi Personal Shopper', 'dest'=>$ruta_inicio.'mi-personal-shopper.php', 'img'=>$ruta_inicio.'img/shopper.png', 'class'=>'opt_menu'),
                2=>array('ttl'=>'Ver perfil', 'dest'=>$ruta_inicio.'ver-perfil.php', 'img'=>$ruta_inicio.'img/usuarios.png', 'class'=>'opt_menu'),
                3=>array('ttl'=>'Sobre Mi', 'dest'=>$ruta_inicio.'alta-ps/1.php', 'img'=>$ruta_inicio.'img/aboutme.png', 'class'=>'opt_menu'),
                4=>array('ttl'=>'Datos de envio', 'dest'=>$ruta_inicio.'datos-envio.php', 'img'=>$ruta_inicio.'img/camion.png', 'class'=>'opt_menu'),
                5=>array('ttl'=>'Cerrar sesión', 'dest'=>$ruta_inicio.'login.php?unlogin=true', 'img'=>$ruta_inicio.'img/cerrar.png', 'class'=>'opt_menu')
            );
        break;
    }

    $mnuOp = '';
    switch ($_SESSION['id_tipo_usuario']) {
        case ADMIN:
            foreach ($arrMnu as $opt) {
                switch ($seccion) {
                    case 'inicio-administrador.php':if ($opt['dest'] == 'inicio-administrador.php') $opt['class'] = 'opt_menu_selected';break;
                    case 'articulos.php': if ($opt['dest'] == 'articulos.php') $opt['class'] = 'opt_menu_selected'; break;

                    case 'categorias.php':if ($opt['dest'] == 'categorias.php') $opt['class'] = 'opt_menu_selected';break;
                    case 'grupos-categorias.php':
                    case 'categorias-grupo.php':
                    case 'nuevo-grupo-categorias.php':if ($opt['dest'] == 'grupos-categorias.php') $opt['class'] = 'opt_menu_selected';break;
                    case 'clientes.php':
                    case 'nuevo-cliente.php':if ($opt['dest'] == 'clientes.php') $opt['class'] = 'opt_menu_selected';break;
                    case 'ver-reportes.php':if ($opt['dest'] == 'ver-reportes.php') $opt['class'] = 'opt_menu_selected';break;
                    case 'objetivos.php':if ($opt['dest'] == 'objetivos.php') $opt['class'] = 'opt_menu_selected';break;
                    case 'valores-puntos.php':if ($opt['dest'] == 'valores-puntos.php') $opt['class'] = 'opt_menu_selected';break;
                    case 'grupos-puntos.php':
                    case 'categorias-puntos.php':
                    case 'nuevo-grupo-puntos.php':if ($opt['dest'] == 'grupos-puntos.php') $opt['class'] = 'opt_menu_selected';break;
                    case 'informe-objetivos.php':if ($opt['dest'] == 'informe-objetivos.php') $opt['class'] = 'opt_menu_selected';break;
                    case 'comisiones.php':if ($opt['dest'] == 'comisiones.php') $opt['class'] = 'opt_menu_selected';break;
                    case 'tiendasvf.php':
                    case 'tiendavf-valores.php':if ($opt['dest'] == 'tiendasvf.php') $opt['class'] = 'opt_menu_selected';break;
                }
                $mnuOp .= build_menu_opt($opt);
            }
        break;
        case USER:
            foreach ($arrMnu as $opt) {
                switch ($seccion) {
                    case 'inicio.php':if ($opt['dest'] == 'inicio.php') $opt['class'] = 'opt_menu_selected'; break;
                    case 'reportes.php':if ($opt['dest'] == 'reportes.php') $opt['class'] = 'opt_menu_selected'; break;
                    case 'nuevo-reporte.php':if ($opt['dest'] == 'nuevo-reporte.php') $opt['class'] = 'opt_menu_selected'; break;
                    case 'informe-objetivos-usuario.php':if ($opt['dest'] == 'informe-objetivos-usuario.php') $opt['class'] = 'opt_menu_selected';break;
                }
                $mnuOp .= build_menu_opt($opt);
            }
        break;
    }

?>
<ul class="nav nav-pills justify-content-center">
    <?php echo $mnuOp; ?>
</ul>


<!-- <div class="navbar-collapse collapse" id="navbarCollapse">
    <ul class="navbar-nav mr-auto">
        <?php echo $mnuOp; ?>
    </ul>
</div> -->
<?php
} else{
?>
<div id="responsive_main_menu"  class="responsive_main_menu_hidden">
    <?php //echo "Debe hacer loggin"; ?>
</div>
<?php
} 
?>
