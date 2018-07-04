<?php
include_once('config/config.inc.php'); //cargando archivo de configuracion

$uM = load_model('usuario');
$uM->control_sesion($ruta_inicio, USER);

/*
//ASISTENTE COMPLETAR ARBOL DE CATEGORIAS
echo '<br><br><br><br>';
$j = 2858;
$q = ' INSERT INTO adst_piguillemreporte_relacion_categorias (id_categoria_parent, id_categoria_child) VALUES <br>';
$par = 0;
for ($i=2861;$i<=2869;$i++) {
    
    $q .= '('.$j.', '.$i.'),<br>';
    
    //$j++;
    //if ($par == 4) $j += 2;
    if ($par == 2) $j ++;
    $par = $par == 2 ? 0 : $par + 1;
}
echo $q.'<br>';
*/

include_once('inc/cabecera.inc.php'); //cargando cabecera 
?>
<script type="text/javascript">
    
</script>
<body>
<div id="main_container">
    <div id="responsive_back_content">
        <?php include_once('inc/franja_top.inc.php'); ?>
        <?php include_once('inc/main_menu.inc.php'); ?>
        <div id="responsive_seccion_back">
            <div id="ttl_seccion_back">
                <h2>Inicio</h2>
                <div style="clear:both;"></div>
            </div>
        </div>
    </div>
</div>
</body>
</html>