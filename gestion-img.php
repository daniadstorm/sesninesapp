<?php
include_once('config/config.inc.php'); //cargando archivo de configuracion
//if (isset($_SESSION['username']) && isset($_SESSION['usertype']) && $_SESSION['usertype'] == ADMIN) { //seguridad;

$uM = load_model('usuario');
$uM->control_sesion($ruta_inicio, ADMIN);


$fM = load_model('file');

$str_errores = '';
$str_estado = '';
$id_archivo = 'archivo_csv';

//GET___________________________________________________________________________
if (isset($_GET['aplicar'])) {
    $rgf = $fM->get_file($_GET['aplicar']);
    if ($rgf) {
        while ($rdf = $rgf->fetch_assoc()) {
            $aux_aplicar_filename = $rdf['nombre_archivo'];
        }
        
        $rcsv = $fM->import_csv('./csv/'.$aux_aplicar_filename);
        $err_found = false;
        
        //control de errores
        switch($rcsv) {
            case 1:
                //aqui entra siempre que la variable tiene valor (confunde 1 con true)
            break;
            case 2:
                $err_found = true;
                $str_errores = '<div class="error_alert" style="margin:4px 0px 0px 0px;">Archivo no encontrado</div>';
            break;
            
            case 3:
                $err_found = true;
                $str_errores = '<div class="error_alert" style="margin:4px 0px 0px 0px;">El archivo seleccinado no coincide</div>';
            break;
            /*case 'cant_delete_previous':
                $err_found = true;
                $str_errores = '<div class="error_alert" style="margin:4px 0px 0px 0px;">No se pudo eliminar anterior Stock</div>';
            break;*/
            default:
                $str_errores = '';
            break;
        }
        
        if ($err_found == false) $str_estado = '<div class="ok_alert">Archivo CSV aplicado correctamente.</div>';
        
    } else $str_errores = '<div class="error_alert" style="margin:4px 0px 0px 0px;">Error aplicando archivo</div>';
}
//------------------------------------------------------------------------------
if (isset($_GET['del_archivo'])) {
    //eliminar archivo
    $rgf = $fM->get_file($_GET['del_archivo']);
    if ($rgf) {
        while ($rdf = $rgf->fetch_assoc()) {
            $aux_del_filename = $rdf['nombre_archivo'];
        }
        
        unlink('csv/'.$aux_del_filename);
        $fM->delete_file($_GET['del_archivo']);
    
        $str_estado = '<div class="ok_alert">Archivo CSV eliminado correctamente.</div>';
    } else $str_errores = '<div class="error_alert" style="margin:4px 0px 0px 0px;">Error eliminando archivo</div>';
}
//GET___________________________________________________________________________

//POST__________________________________________________________________________
if (isset($_FILES[$id_archivo])) { //si viene de submit
    
    //VERIFICAR_____________________________________________________________________
    $verif = true;
    
    //control errores defecto
    //coge el archivo del usuario
    if ($_FILES[$id_archivo]['error'] > 0) {
        $verif = false;
        
        if ($_FILES[$id_archivo]['error'] == 1) $str_errores = '<div class="error_alert" style="margin:4px 0px 0px 0px;">Maximo tama&ntilde;o excedido</div>';
            else $str_errores = '<div class="error_alert" style="margin:4px 0px 0px 0px;">Error subiendo el archivo; por favor, inténtelo de nuevo</div>';
    }
    
    //control de extension
    //aux extensión es todo el nombre del archivo: arxivo_csv/jpeg.
    //$ext= explode($_FILES[$id_archivo]['type']);
    $ext=$_FILES[$id_archivo]['type'];
    echo $ext."<br>";
      
   // list($aux_file_name, $aux_extension) = explode('.', $_FILES[$id_archivo]['type']);
    
    /*if($ext == "image/jpeg"){
        echo "hola"."<br>";
    } */ 
    //$arraytypes= new rray('jpeg',);
    //si es diferente a todas estas extensiones, entonces entra en el if
    if ($ext != "image/jpeg" && $ext != "image/png" && $ext != "image/bmp") {
        $verif = false;
        $str_errores = '<div class="error_alert" style="margin:4px 0px 0px 0px;">El archivo seleccionado no es CSV</div>';
    }
    
    //control archivo con mismo nombre existente
    if ($fM->csv_exists($_FILES[$id_archivo]['name']) == true) {
        $verif = false;
        $str_errores = '<div class="error_alert" style="margin:4px 0px 0px 0px;">Ya hay otro archivo con el mismo nombre</div>';
    }
    
    //VERIFICAR_____________________________________________________________________
    
    //GUARDAR REGISTRO______________________________________________________________
    if ($verif == true) {
        echo 'punto1 <br>;';
        $aux_ruta = 'csv/';
        
        if (move_uploaded_file($_FILES[$id_archivo]['tmp_name'], $aux_ruta.$_FILES[$id_archivo]['name'])) {
            echo 'punto2 <br>;';
            $result_add_file = $fM->add_img(3, $_FILES[$id_archivo]['name']);
            
            if ($result_add_file == true) {
                $str_estado = '<div class="ok_alert">Archivo CSV a&ntilde;adido correctamente.</div>';
            } else $str_errores = '<div class="error_alert">Error a&ntilde;adiendo archivo. Por favor, contacte con el administrador.</div>';
            
        } else $str_errores = '<div class="error_alert">Error moviendo archivo. Por favor, contacte con el administrador.</div>';
        
    }
    //GUARDAR REGISTRO______________________________________________________________   
}
//POST__________________________________________________________________________

//LISTADO_______________________________________________________________________
$rw = '';

$rf = $fM->get_files();
if ($rf) {
    $rw = '';
    $cf = 1;
    $primero = true;
    
    while ($row = $rf->fetch_assoc()) {
        
        $str_fecha = mysql_to_date($row['fecha']);
        
        $rw .= '<div class="table_tr row_'.$cf.'">';
        $rw .=  '<div class="left_td table_td" style="margin-left:10px;"><a href="csv/'.$row['nombre_archivo'].'">Descargar</a></div>';
        $rw .=  '<div class="left_td center_td">'.stripslashes($row['nombre_archivo']).'</div>';
        /*
        if ($primero == true) $rw .= '<div class="right_td center_td">-</div>';
            else $rw .= '<div class="right_td center_td"><a href="gestion-csv.php?del_archivo='.$row['id_archivo'].'">Eliminar</a></div>';
        */
        $rw .= '<div class="right_td center_td"><a href="gestion-csv.php?del_archivo='.$row['id_archivo'].'">Eliminar</a></div>';
        $rw .=  '<div class="right_td center_td" style="width:140px;">'.$str_fecha.'</div>';
        /*
        if ($primero == true) $rw .=  '<div class="right_td center_td" style="width:140px;">SI</div>';
            else $rw .=  '<div class="right_td center_td" style="width:140px;">NO</div>';
        */
        $rw .=  '<div class="right_td center_td" style="width:140px;"><a href="gestion-csv.php?aplicar='.$row['id_archivo'].'">Aplicar</a></div>';
        
        $rw .=  '<div style="clear:both;"></div>';
        $rw .= '</div>';
        
        $cf = ($cf == 1) ? 2 : 1;
        $primero = false;
    }
}

//LISTADO_______________________________________________________________________

include_once('inc/cabecera.inc.php'); //cargando cabecera 
?>
<script type="text/javascript">
    
</script>
<body>
<div id="main_container">
    <?php include_once('inc/main_menu.inc.php'); ?>
    <div id="agcontent">
        <?php include_once('inc/franja_top.inc.php'); ?>
        <div id="seccion_back">
            <div id="ttl_seccion_back">
                <img src="img/csv-file.png" />
                <h2>Gesti&oacute;n CSV</h2>
                <div style="clear:both;"></div>
            </div>
            
            <div style="margin:0 10px 10px 10px;">
                <?php if (isset($str_estado) && strlen($str_estado) > 1) echo $str_estado; ?>
                <?php if (isset($str_errores)) echo $str_errores; ?>
            </div>
            
            <form action="gestion-img.php" method="post" id="form_subir_csv" name="form_subir_csv" enctype="multipart/form-data">
                <div class="login_form" style="margin-right:10px;padding:12px 24px;">
                    
                    <div style="float:left;">
                        <h1 class="form_ttl">Subir archivo CSV</h1>
                    </div>
                    <div style="clear:both;"></div>
                    <div class="campo">Archivo CSssV seleccionado: <input id="archivo_csv" name="archivo_csv" type="file" /></div>
                    <div style="float:right; margin:10px 0px;">
                        <input type="submit" style="float:none;" class="btn_aceptar" value="Aceptar" />
                    </div>
                    <div style="clear:both;"></div>
                    
                </div>
            </form>
            
            <div class="table_list">
                <div class="table_th">
                    
                    <div class="left_td table_td" style="margin-left:10px;"><img src="img/csv-file.png" style="width:20px;height:20px;" /></div>
                    <div class="left_td center_td">Nombre</div>
                    
                    <div class="right_td center_td">Eliminar</div>
                    <div class="right_td center_td" style="width:140px;">Fecha</div>
                    <div class="right_td center_td" style="width:140px;">Aplicar Stock</div>
                    <div style="clear:both;"></div>
                </div>
                <?php echo $rw; ?>
            </div>
            
            
        </div>
    </div>
</div>
</body>
</html>
<?php /*} else { unset($_SESSION['username']);header('Location: '.$ruta_inicio.'index.php'); exit(); }*/ ?>