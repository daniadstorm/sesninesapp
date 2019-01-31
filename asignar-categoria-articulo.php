<?php
include_once('config/config.inc.php'); //cargando archivo de configuracion
$uM = load_model('usuario');
$uM->control_sesion($ruta_inicio, ADMIN);

$hM = load_model('html');
$iM = load_model('inputs');
$aM = load_model('articulos');
$eM = load_model('etiquetas');
$cM = load_model('categorias');

$ttl = 'Asignar categoría artículo';
$categorias = array();
$subcategorias = array();
//campos formulario
$id_articulo = 0;
$asignar_etiqueta = 0;

$ogecat = '';
$ogesub = '';
$verif = true;

//GET___________________________________________________________________________

//GET___________________________________________________________________________

//POST__________________________________________________________________________
if(isset($_POST['eliminarCatArt'])){
    $rdca = $aM->delete_categorias_articulo($_POST['id_articulo'], $_POST['id_categoria'], $_POST['subcategoria']);
    if($rdca){
        $str_info = $hM->get_alert_success('Categoria eliminada del artículo');
    } else $str_errores = $hM->get_alert_danger('Error al eliminar categorias del artículo');
}
if(isset($_POST['addCategoria']) && isset($_POST['categorias'])){
    $raca = $cM->add_categoria_articulo($_GET['id_articulo'], $_POST['categorias'], 0);
    if($raca){
        $str_info = $hM->get_alert_success('Categoria asignada');
    } else $str_errores = $hM->get_alert_danger('Error al asignar');
}
if(isset($_POST['addSubcategoria']) && isset($_POST['subcategorias'])){
    $raca = $cM->add_categoria_articulo($_GET['id_articulo'], $_POST['subcategorias'], 1);
    if($raca){
        $str_info = $hM->get_alert_success('Categoria asignada');
    } else $str_errores = $hM->get_alert_danger('Error al asignar');
}


//POST__________________________________________________________________________

//LISTADO_______________________________________________________________________
if(isset($_GET['id_articulo'])){
    $rgca = $aM->get_categorias_articulo($_GET['id_articulo']);
    if($rgca){
        while($fgca = $rgca->fetch_assoc()){
            $ogecat .= '<tr>';
            $ogecat .= '<td>'.$fgca['nombre_categoria'].'</td>';
            $ogecat .= '<td>';
            $ogecat .= '<form method="post"><input name="id_categoria" value="'.$fgca['id_categoria'].'" hidden><input name="id_articulo" value="'.$fgca['id_articulo'].'" hidden><input name="subcategoria" value="0" hidden>';
            $ogecat .= '<button type="submit" name="eliminarCatArt" class="btn btn-outline-danger">Eliminar</button>';
            $ogecat .= '</form>';
            $ogecat .= '</td>';
            $ogecat .= '</tr>';
        }
    } else $str_errores = $hM->get_alert_danger('Error cargando categorias');
}

if(isset($_GET['id_articulo'])){
    $rgca = $aM->get_subcategorias_articulo($_GET['id_articulo']);
    if($rgca){
        while($fgca = $rgca->fetch_assoc()){
            $ogesub .= '<tr>';
            $ogesub .= '<td>'.$fgca['nombre_subcategoria'].'</td>';
            $ogesub .= '<td>';
            $ogesub .= '<form method="post"><input name="id_categoria" value="'.$fgca['id_subcategoria'].'" hidden><input name="id_articulo" value="'.$fgca['id_articulo'].'" hidden><input name="subcategoria" value="1" hidden>';
            $ogesub .= '<button type="submit" name="eliminarCatArt" class="btn btn-outline-danger">Eliminar</button>';
            $ogesub .= '</form>';
            $ogesub .= '</td>';
            $ogesub .= '</tr>';
        }
    } else $str_errores = $hM->get_alert_danger('Error cargando categorias');
}
$rgac = $cM->get_all_categorias();
if($rgac){
    while($frgac = $rgac->fetch_assoc()){
        $categorias[$frgac['id_categoria']] = $frgac['nombre_categoria'];
    }
}
$rgasc = $cM->get_all_subcategorias();
if($rgasc){
    while($frgasc = $rgasc->fetch_assoc()){
        $subcategorias[$frgasc['id_subcategoria']] = $frgasc['nombre_subcategoria'];
    }
}
//LISTADO_______________________________________________________________________

//COMBOS________________________________________________________________________

//COMBOS________________________________________________________________________

include_once('inc/cabecera.inc.php'); //cargando cabecera 
?>
<script type="text/javascript">
    
</script>
<body>
    <?php include_once('inc/franja_top.inc.php'); ?>
    <?php include_once('inc/main_menu.inc.php'); ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="content mt-1">
                    <div class="layout">
                        <div class="layout-table">
                            <div id="alertas">
                                <?php if (isset($str_info)) echo $str_info; ?>
                                <?php if (isset($str_errores)) echo $str_errores; ?>
                            </div>
                            <div class="layout-table-item">
                                <div class="layout-table-header">
                                    <h4><?php echo $ttl; ?></h4>
                                </div>
                                <div class="layout-table-content">
                                    <div class="table-responsive-sm">
                                        <h5>Asignar categoría</h5>
                                        <form method="post">
                                            <?php echo $iM->get_select("categorias","", $categorias,"form-control"); ?>
                                            <button type="submit" name="addCategoria" class="btn btn-outline-info">Asignar categoria</button>
                                        </form>
                                    </div>
                                </div>
                                <div class="layout-table-content">
                                    <div class="table-responsive-sm">
                                        <h5>Categorías asignadas</h5>
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>Categoría</th>
                                                    <th>Eliminar asignación</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    echo $ogecat;
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="layout-table-content">
                                    <div class="table-responsive-sm">
                                        <h5>Asignar subcategoría</h5>
                                        <form method="post">
                                            <?php echo $iM->get_select("subcategorias","", $subcategorias,"form-control"); ?>
                                            <button type="submit" name="addSubcategoria" class="btn btn-outline-info">Asignar subcategoria</button>
                                        </form>
                                    </div>
                                </div>
                                <div class="layout-table-content">
                                    <div class="table-responsive-sm">
                                        <h5>Subcategorías asignadas</h5>
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>Subategoría</th>
                                                    <th>Eliminar asignación</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    echo $ogesub;
                                                ?>
                                            </tbody>
                                        </table>
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
</html>