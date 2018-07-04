<?php
include_once('config/config.inc.php'); //cargando archivo de configuracion

$uM = load_model('usuario');
$fM = load_model('form');
$uM->control_sesion($ruta_inicio, USER);

//define('MAX_FILE_IMG',2097152);

$ff = load_model('file');

$aM = load_model('articulos');


$id_articulo = 0;
$nombre_articulo = '';
$referencia_articulo = '';
$referencia_proveedor = '';
$descripcion_articulo = '';
$etiquetas_articulo = '';
$activado = '';
$visible_en_tienda = '';
$precio_coste = 0;
$coste_externo_portes = 0;
$PVP_final = 0;
$margen = 0;
$cantidad = 0;
$id_etiqueta = null;
$img1 = '';

$arr_err = array();
$verif = true;






//GET___________________________________________________________________________
if (isset($_GET['id_articulo'])) {

    //echo 'HOLA1 <br>';
    $id_articulo = $_GET['id_articulo'];
    
    //eliminar etiqueta
    // id_articulo viene de la lista
    // id etiqueta viene de un href
    // solo entrará aquí después del select
    if (isset($_REQUEST['id_etiqueta'])) {
        $id_etiqueta = $_REQUEST['id_etiqueta'];
        $aM->delete_articulo_etiquetas_etiqueta($id_articulo, $id_etiqueta);
    }
// recoger todos los valores y meterlos en variables;
    $etiquetas = '';
    $rw = '';
    $re = '';
    $cf = 1;
    $rgu = $aM->get_articulo($id_articulo);
    if ($rgu) {
        while ($fgu = $rgu->fetch_assoc()) {
            $id_articulo = $fgu['id_articulo'];
            $nombre_articulo = $fgu['nombre_articulo'];
            $referencia_articulo = $fgu['referencia_articulo'];
            $referencia_proveedor = $fgu['referencia_proveedor_articulo'];
            $descripcion_articulo = $fgu['descripcion_articulo'];
            $activado = $fgu['activado_articulo'];
            $visible_en_tienda = $fgu['visible_en_tienda_articulo'];
            $precio_coste_articulo = $fgu['precio_coste_articulo'];
            $coste_externo_portes = $fgu['coste_externo_portes_articulo'];
            $PVP_final = $fgu['PVP_final_articulo'];
            $margen = $fgu['margen_articulo'];
            $cantidad = $fgu['cantidad_articulo'];
            $almacen_aux = $fgu['almacen_articulo'];
            
        }
        $almacen_articulo == ($almacen_articulo == 1)?$almacen_articulo="Almacén general":$almacen_articulo="Almacén X";
 
    }
     

    //coge todas las imagenes con el id artículo indicado. 
    $rgai = $aM->get_articulo_img($id_articulo);

    if ($rgai) {
        
        $cont = 0;
        while ($row = $rgai->fetch_assoc()) {

            $rw .= '<div id="filtros_seccion" >';

            $rw .= '<div class="table_tr row_' . $cf . '" >';
            $rw .= '<div class="left_td table_td" style="  width:100px;min-width:1px;text-align:center;"><img src="csv/' . $row['ruta'] . '" alt="" height="100px" width="100px">' . $row['ruta'] . '</div>';
            $rw .= '<div style="clear:both;"></div>';
            $rw .= '</div>';
            $rw .= '</div>';

            $cf = ($cf == 1) ? 2 : 1;
        }
    }
} else
    $str_errores = $str_errores = '<div class="error_alert">Error cargando artículo</div>';

//GET___________________________________________________________________________

//POST___________________________________________________________________________
//etiquetas_articulos es el id del select que es el id de la etiqueta
if (isset($_POST['etiquetas_articulo'])) {
//echo 'HOLA2<br>';
    //seleccionado
    echo $_POST['etiquetas_articulo'].'<br>';
       
    $id_etiqueta = $_POST['etiquetas_articulo'];
    
    
  //recoger todas las etiquetas que tiene un artículo
    $rgebi = $aM->get_etiquetas_by_articulo($id_articulo);

    // Sacar todas las etiquetas por id_artículo.
    $i = 0;
    $aux_encontrado=false;
    
    while ($row = $rgebi->fetch_assoc()) {
      // echo '<br>HOLA3<br>';
     //  echo $row['id_etiqueta'] . '==' . $id_etiqueta . '?<br>';
      //si etiqueta seleccionada es igual a alguna de las etiquetas
        if ($row['id_etiqueta'] == $id_etiqueta) {
          //  echo 'SI<br>';
            $aux_encontrado=true;
            break;
            
        } else {
          //  echo 'NO<br>';
        }
        $i++;
        
    }
    if($aux_encontrado==false) $aM->add_articulo_etiquetas($id_articulo, $id_etiqueta);
       else $str_errores = '<div class="error_alert">La etiqueta ya se encuentra enlazada</div>';
}     


    
       
    
         

//POST___________________________________________________________________________


//LISTADO_______________________________________________________________________

//recoger todas las etiquetas y meterlas en un desplegable
    $rgeba = $aM->get_etiquetas_by_articulo($id_articulo);
    $i = 0;
    // Sacar todas las etiquetas por id_artículo.
    while ($row = $rgeba->fetch_assoc()) {
        //echo '<BR>ETIQUETAS INICIO<BR>';
        //echo 'ETIQUETAS '.$row['id_etiqueta'].'; NOMBRE ETIQUETA = '.$row['nombre_etiqueta'].' <BR>';
        $re .= '<div id="filtros_seccion" >';
        $re .= '<div class="table_tr row_1" >';
        $re .= '<div class="left_td table_td" style="  width:100px;min-width:1px;text-align:left;">'.$row['nombre_etiqueta'] . '</div>'; 
        //con un href le envia el número del artículo y el número de la etiqueta
        $re .= '<a href="vista_articulo.php?id_articulo=' . $id_articulo . '&id_etiqueta=' . $row['id_etiqueta'] . '">Eliminar</a>';
        $re .= '<div style="clear:both;"></div>';
        $re .= '</div>';
        $re .= '</div>';
        
       // echo 'ETIQUETAS FIN<BR>';
        
        $i++;
    }

    // Si hay menos que el número de etiquetas, aparece el botón añadir.     
    if ($i < $aM->get_total_etiquetas()) {
        $re .= '<form name="form" method="post" action="vista_articulo.php?id_articulo='.$id_articulo.'">';
        //le paso id de la etiqueta que haya selecionado última, es decir después del post.
        $re .= $aM->get_combo_etiquetas('etiquetas_articulo', $id_etiqueta, false, false, false);
        $re .= '<input type="submit" style="float:none;" class="btn_aceptar" value="Añadir" />';
        $re .= '</form>';

        //echo $aM->get_combo_etiquetas('etiquetas_articulo',$etiquetas_articulo, false, false, false);
    }
    
    //mostrar almacén
    /*$m .= '<form name="form" method="post" action="vista_articulo.php?id_articulo='.$id_articulo.'">';
        //le paso id de la etiqueta que haya selecionado última, es decir después del post.
        $m .= $aM->get_combo_tipo_estilo_arti('almacen_articulo');
        $m .= '<input type="submit" style="float:none;" class="btn_aceptar" value="Cambiar" />';
        $m .= '</form>';*/
//LISTADO_______________________________________________________________________




include_once('inc/cabecera.inc.php'); //cargando cabecera 
?>

<script type="text/javascript">

</script>
<body>
    <div id="main_container">
        <div id="responsive_back_content">
<?php include_once('inc/franja_top.inc.php'); ?>
            <?php include_once('inc/main_menu.inc.php'); ?>


            <div id="ttl_seccion_back" style="margin-top: 100px;">
                <h2>Artículo: <?php echo $nombre_articulo ?></h2>
                <div style="clear:both;"></div>
                <br> 
           
             <div id="filtros_seccion">   
             <?php if (isset($str_errores)) echo $str_errores; ?>
             </div>
                
                <div class="table_list">
                    <!--GRIS -->
                    <div class="table_th">
                        <div class="left_td" style="min-width:1px;line-height:10px;font-weight: bold; color:white;">Referencia</div><br>
                        <div class="responsive_list_sep"></div>
                        <div style="clear:both;"></div>

                        <!--BLANCO -->
                        <div class="table_tr row_1">
                            <div class="left_td" style="width:40%;min-width:1px;line-height:10px;">
                                <div> <?php echo $referencia_articulo ?></div>
                            </div>
                            <div style="clear:both;"></div>       
                        </div>

                        <!--GRIS -->
                        <div class="table_th">
                            <div class="left_td" style="min-width:1px;line-height:10px;font-weight: bold; color:white;">Referencia proveedor</div><br>
                            <div class="responsive_list_sep"></div>
                            <div style="clear:both;"></div>
                        </div>
                        <!--BLANCO -->
                        <div class="table_tr row_1">
                            <div class="left_td" style="width:40%;min-width:1px;line-height:10px;">
                                <div> <?php echo $referencia_proveedor ?></div>
                            </div>
                            <div style="clear:both;"></div>       
                        </div>

                        <!--GRIS -->
                        <div class="table_th">
                            <div class="left_td" style="min-width:1px;line-height:10px;font-weight: bold; color:white;">Descripción</div><br>
                            <div class="responsive_list_sep"></div>
                            <div style="clear:both;"></div>
                        </div>
                        <!--BLANCO -->
                        <div class="table_tr row_1">
                            <div class="left_td" style="width:40%;min-width:1px;line-height:10px;">
                                <div> <?php echo $descripcion_articulo ?></div>
                            </div>
                            <div style="clear:both;"></div>       
                        </div>
                        <!--GRIS -->

                        <div class="table_th">
                            <div class="left_td" style="min-width:1px;line-height:10px;font-weight: bold; color:white;">Activado</div><br>
                            <div class="responsive_list_sep"></div>
                            <div style="clear:both;"></div>
                        </div>
                        <!--BLANCO -->
                        <div class="table_tr row_1">
                            <div class="left_td" style="width:40%;min-width:1px;line-height:10px;">
                                <div><?php echo $activado ?></div>
                            </div>
                            <div style="clear:both;"></div>       
                        </div> 
                        <!--GRIS-->
                        <div class="table_th">
                            <div class="left_td" style="min-width:1px;line-height:10px;font-weight: bold; color:white;">Visble</div><br>
                            <div class="responsive_list_sep"></div>
                            <div style="clear:both;"></div>
                        </div>
                        <!--BLANCO -->
                        <div class="table_tr row_1">
                            <div class="left_td" style="width:40%;min-width:1px;line-height:10px;">
                                <div> <?php echo $visible_en_tienda ?></div>
                            </div>
                            <div style="clear:both;"></div>       
                        </div>

                        <!--GRIS -->
                        <div class="table_th">
                            <div class="left_td" style="min-width:1px;line-height:10px;font-weight: bold; color:white;">Precio</div><br>
                            <div class="responsive_list_sep"></div>
                            <div style="clear:both;"></div>
                        </div>
                        <!--BLANCO -->
                        <div class="table_tr row_1">
                            <div class="left_td" style="width:40%;min-width:1px;line-height:10px;">
                                <div class="table_tr row_1" style="width:30;min-width:1px;margin-left:5%;">P_coste_artículo:
                                    <div style="float:right;"> <?php echo $precio_coste_articulo ?></div>
                                </div><br>

                                <div class="table_tr row_1" style="width:30;min-width:1px;margin-left:5%;">PVP:
                                    <div style="float:right;"> <?php echo $PVP_final ?></div>
                                </div><br>
                                <div class="table_tr row_1" style="width:30;min-width:1px;margin-left:5%;">Mar:
                                    <div style="float:right;"> <?php echo $margen ?></div>
                                </div><br>
                                <div class="table_tr row_1" style="width:30;min-width:1px;margin-left:5%;">Portes:
                                    <div style="float:right;"> <?php echo $coste_externo_portes ?></div>
                                </div><br>
                            </div>
                            <div style="clear:both;"></div>
                        </div>
                        <!--GRIS -->


                        <div class="table_th">
                            <div class="left_td" style="min-width:1px;line-height:10px;font-weight: bold; color:white;">SEO/SEM</div><br>

                            <div class="responsive_list_sep"></div>
                            <div style="clear:both;"></div>
                        </div> 
                        <!--BLANCO -->
                        <div class="table_tr row_1">
                            <div class="left_td" style="width:40%;min-width:1px;line-height:10px;">
                                <?php
                                $min = str_replace(' ', '-', $nombre_articulo);
                                echo strtolower($min);
                                ?>
                            </div>
                            <div style="clear:both;"></div>
                        </div>

                        <!--GRIS -->
                        <div class="table_th">
                            <div class="left_td" style="min-width:1px;line-height:10px;font-weight: bold; color:white;">Etiquetas</div><br>

                            <div class="responsive_list_sep"></div>
                            <div style="clear:both;"></div>
                        </div>
                        <!--BLANCO -->
                        <div class="table_tr row_1">
                            <div class="left_td" style="width:40%;min-width:1px;line-height:10px;">
                                <?php
                                echo $re;
                                ?>
                            </div>
                            <div style="clear:both;"></div>
                        </div>
                        <!--GRIS -->
                          <div class="table_th">
                            <div class="left_td" style="min-width:1px;line-height:10px;font-weight: bold; color:white;">Almacén</div><br>

                            <div class="responsive_list_sep"></div>
                            <div style="clear:both;"></div>
                        </div>
                        <!--BLANCO -->
                        <div class="table_tr row_1">
                            <div class="left_td" style="width:40%;min-width:1px;line-height:10px;">
                                <?php
                                echo $almacen_articulo.'</br>';
                                echo '</br>';
                                
                                ?>
                            </div>
                            <div style="clear:both;"></div>
                        </div>
                        
                        
                        <div class="table_th">
                            <div class="left_td" style="min-width:1px;line-height:10px;font-weight: bold; color:white;">Cantidad</div><br>


                            <div class="responsive_list_sep"></div>
                            <div style="clear:both;"></div>
                        </div>
                        <!--BLANCO -->
                        <div class="table_tr row_1">
                            <div class="left_td" style="width:40%;min-width:1px;line-height:10px;">
                                <div> <?php echo $cantidad ?></div>
                            </div>
                            <div style="clear:both;"></div>
                        </div>
                        <!--GRIS -->

                        <div class="table_th">
                            <div class="left_td" style="min-width:1px;line-height:10px;font-weight: bold; color:white;">Imagen/ CB</div><br>
                            <div class="responsive_list_sep"></div>
                            <div style="clear:both;"></div>
                        </div>
                        <!--BLANCO -->
                        <div class="table_tr row_1"  >

                            <?php
                            echo (isset($arr_err['archivo_csv'])) ? $arr_err['archivo_csv'] : '';

                            echo $rw;
                            ?>
                            <div style="clear:both;"></div>
                        </div>

                    </div>
                </div>
            </div>
        </div>


    </div>
</div>
</div>


<div style="clear:both;"></div>



</body>
</html>