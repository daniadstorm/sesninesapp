<?php

class articulosModel extends Model {
    
    public $dir = 'imgart/';
    public $max_imagenes_articulo = 5;
    
    function add_articulo($nombre_articulo,$referencia_articulo,$referencia_proveedor_articulo,$descripcion_articulo,$activado_articulo, $visible_en_tienda_articulo,
        $precio_coste_articulo,$coste_externo_portes_articulo,$PVP_final_articulo,$margen_articulo,$inicio_descuento_articulo,$fin_descuento_articulo,
        $descuento_porcentaje_articulo,$descuento_euros_articulo,$cantidad_articulo, $almacen_articulo) {
        
        $q  = ' INSERT INTO '.$this->pre.'articulos (nombre_articulo, referencia_articulo, referencia_proveedor_articulo, descripcion_articulo, activado_articulo, ';
        $q .=   ' visible_en_tienda_articulo, precio_coste_articulo, coste_externo_portes_articulo, PVP_final_articulo, margen_articulo, cantidad_articulo, ';
        $q .=   ' inicio_descuento_articulo, fin_descuento_articulo, descuento_porcentaje_articulo, descuento_euros_articulo, almacen_articulo ) VALUES ';
        $q .= ' ("' . $nombre_articulo . '", "' . $referencia_articulo . '", "' . $referencia_proveedor_articulo . '", "' . $descripcion_articulo . '", ';
        $q .= ' "' . $activado_articulo . '", "' . $visible_en_tienda_articulo . '", "' .$precio_coste_articulo . '", "' . $coste_externo_portes_articulo . '", ';
        $q .= ' "' . $PVP_final_articulo . '", "' . $margen_articulo . '","' . $cantidad_articulo . '", "' .$inicio_descuento_articulo. '", "' .$fin_descuento_articulo. '", ';
        $q .= ' "' .$descuento_porcentaje_articulo. '", "'.$descuento_euros_articulo.'","' . $almacen_articulo . '")';
        return $this->execute_query($q);
    }

    function add_articulo_etiquetas($id_articulo, $id_etiqueta) {
        $q  = ' INSERT INTO '.$this->pre.'articulo_etiquetas (id_articulo, id_etiqueta) VALUES ';
        $q .= ' (' . $id_articulo . ', ' . $id_etiqueta . ')';
        return $this->execute_query($q);
    }

    function get_all_articulos(){
        $q = ' SELECT * FROM '.$this->pre.'articulos ';
        return $this->execute_query($q);
    }

    function get_existencias_articulos($id_articulo){
        $q  = ' SELECT ae.id_existencia, a.id_articulo, ae.color_existencia, ae.talla_existencia, ae.cantidad_existencia FROM '.$this->pre.'articulos as a ';
        $q .= ' INNER JOIN adst_sesnines_articulo_existencias as ae ';
        $q .= ' on a.id_articulo=ae.id_articulo ';
        $q .= ' WHERE a.id_articulo='.$id_articulo.' and ae.cantidad_existencia!=0 ';
        return $this->execute_query($q);
    }

    function delete_articulo($id_articulo){
        $q  = ' DELETE FROM '.$this->pre.'articulos';
        $q .= ' WHERE id_articulo = '.$id_articulo.' ';
        return $this->execute_query($q);
    }

    function asignar_categoria_articulo($id_articulo, $id_categoria, $subcategoria=0){
        $q  = ' INSERT INTO '.$this->pre.'categorias_articulos (id_articulo, id_categoria, subcategoria) VALUES ';
        $q .= ' (' . $id_articulo . ', ' . $id_categoria . ', ' . $subcategoria . ')';
    }

    function get_categorias_articulo($id_articulo){
        $q = ' SELECT * FROM '.$this->pre.'categorias_articulos as ca ';
        $q .= ' INNER JOIN '.$this->pre.'categorias as c ';
        $q .= ' INNER JOIN '.$this->pre.'articulos as a ';
        $q .= ' ON ca.id_articulo=a.id_articulo ';
        $q .= ' and ca.id_categoria=c.id_categoria ';
        $q .= ' WHERE ca.id_articulo='.$id_articulo.' ';
        $q .= ' and ca.subcategoria=0 ';
        return $this->execute_query($q);
    }

    function get_subcategorias_articulo($id_articulo){
        $q = ' SELECT * FROM '.$this->pre.'categorias_articulos as ca ';
        $q .= ' INNER JOIN '.$this->pre.'subcategorias as sc ';
        $q .= ' INNER JOIN '.$this->pre.'articulos as a ';
        $q .= ' ON ca.id_articulo=a.id_articulo ';
        $q .= ' and ca.id_categoria=sc.id_subcategoria ';
        $q .= ' WHERE ca.id_articulo='.$id_articulo.' ';
        $q .= ' and ca.subcategoria=1 ';
        return $this->execute_query($q);
    }

    function delete_categorias_articulo($id_articulo, $id_categoria, $subcategoria){
        $q  = ' DELETE FROM '.$this->pre.'categorias_articulos ';
        $q .= ' WHERE id_articulo = '.$id_articulo.' ';
        $q .= ' and id_categoria = '.$id_categoria.' ';
        $q .= ' and subcategoria = '.$subcategoria.' ';
        return $this->execute_query($q);
    }

    function delete_articulo_all_etiquetas($id_articulo) {
        $q  = ' DELETE FROM '.$this->pre.'articulo_etiquetas';
        $q .= ' WHERE id_articulo = ' . $id_articulo . ' ';
        return $this->execute_query($q);
    }

    function delete_articulo_etiquetas($id_articulo, $id_etiqueta) {
        $q  = ' DELETE FROM '.$this->pre.'articulo_etiquetas';
        $q .= ' WHERE id_articulo = ' . $id_articulo . ' AND id_etiqueta = ' . $id_etiqueta . ' ';
        return $this->execute_query($q);
    }

    function get_articulos($pag, $regs_x_pag) {
        $q  = ' SELECT a.* FROM '.$this->pre.'articulos a ';
        $q .= ' WHERE a.deleted_articulo = 0 ';
        $q .= ' LIMIT ' . ($pag * $regs_x_pag) . ', ' . $regs_x_pag . ' ';
        return $this->execute_query($q);
    }

    function get_articulos_total_regs() {
        $q = ' SELECT a.* FROM '.$this->pre.'articulos a ';
        $q .= ' WHERE a.deleted_articulo = 0 ';
        $r = $this->execute_query($q);
        if ($r) return $r->num_rows;
            else return false;
    }

    function get_articulo($id_articulo) {
        $q  = ' SELECT a.* FROM '.$this->pre.'articulos a ';
        $q .= ' WHERE a.id_articulo = ' . $id_articulo . ' ';
        $q .=   ' AND a.deleted_articulo = 0';
        return $this->execute_query($q);
    }
    
    function add_articulo_img($id_articulo, $ruta_imagen_articulo) {
        $q  = ' INSERT INTO '.$this->pre.'articulo_imagenes (id_articulo, ruta_imagen) VALUES ';
        $q .= ' ('.$id_articulo.', "'.$ruta_imagen_articulo.'") ';
        return $this->execute_query($q);
    }
    
    function get_imagenes_by_articulo($id_articulo) {
        $q  = ' SELECT ai.* FROM '.$this->pre.'articulo_imagenes ai ';
        $q .= ' WHERE ai.id_articulo = '.$id_articulo.' ';
        return $this->execute_query($q);
    }
    
    function get_total_imagenes_articulo($id_articulo) {
        $q  = ' SELECT ai.* FROM '.$this->pre.'articulo_imagenes ai ';
        $q .= ' WHERE ai.id_articulo = '.$id_articulo.' ';
        $r = $this->execute_query($q);
        if ($r) {
            return $r->num_rows;
        } else return false;
    }
    
    function delete_articulo_imagen($id_articulo, $id_imagen) {
        $q  = ' DELETE FROM '.$this->pre.'articulo_imagenes ';
        $q .= ' WHERE id_articulo = '.$id_articulo.' ';
        $q .=   ' AND id_imagen = '.$id_imagen.' ';
        return $this->execute_query($q);
    }
    
    function clear_articulo_img($id_articulo) {
        $q  = ' DELETE FROM '.$this->pre.'articulo_imagenes ';
        $q .= ' WHERE id_articulo = '.$id_articulo.' ';
        return $this->execute_query($q);
    }
    
    function clean_dir_imgart($document_root) {
        //todos los archivos que no estén en la tabla se eliminan
        
        $arr_bbdd = array();
        $arr_dir = array();
        
        $q  = ' SELECT ai.* FROM '.$this->pre.'articulo_imagenes ai ';
        
        $r = $this->execute_query($q);
        if ($r) {
            while ($f = $r->fetch_assoc()) {
                //array con nombres de archivo de tabla sql
                $arr_bbdd []= substr($f['ruta_imagen'], (strpos($f['ruta_imagen'], '/')+1), strlen($f['ruta_imagen'])); //desde la barra hasta el final
            }
        } else return false;
        
        //array con nombres de archivo existentes en directorio
        $arr_dir = scandir($this->dir);
        
        foreach ($arr_dir as $k => $v) {
            if ($v != '.' && $v != '..') {
                if (!in_array($v, $arr_bbdd)) {
                    unlink($document_root.$this->dir.$v);
                }
            }
        }
    }
    
    function update_articulo($id_articulo, $nombre_articulo, $referencia_articulo,$referencia_proveedor_articulo,$descripcion_articulo,
        $visible_en_tienda_articulo,$precio_coste_articulo,$coste_externo_portes_articulo,$PVP_final_articulo,$margen_articulo,$inicio_descuento_articulo,
        $fin_descuento_articulo,$descuento_porcentaje_articulo,$descuento_euros_articulo, $almacen_articulo){
        
        $q  = ' UPDATE ' . $this->pre . 'articulos SET ';
        $q .=   ' nombre_articulo = "' . $nombre_articulo . '", ';
        $q .=   ' referencia_articulo = "' . $referencia_articulo . '", ';
        $q .=   ' referencia_proveedor_articulo = "' . $referencia_proveedor_articulo . '", ';
        $q .=   ' descripcion_articulo = "' . $descripcion_articulo . '", ';
        /* $q .=   ' activado_articulo = "' . $activado_articulo . '", '; */
        $q .=   ' visible_en_tienda_articulo = "' . $visible_en_tienda_articulo . '", ';
        $q .=   ' precio_coste_articulo = "' . $precio_coste_articulo . '", ';
        $q .=   ' coste_externo_portes_articulo = "' . $coste_externo_portes_articulo . '", ';
        $q .=   ' PVP_final_articulo = "' . $PVP_final_articulo . '", ';
        $q .=   ' margen_articulo = "' . $margen_articulo . '", ';
        $q .=   ' inicio_descuento_articulo = "' . $inicio_descuento_articulo. '", ';
        $q .=   ' fin_descuento_articulo = "' . $fin_descuento_articulo. '", ';
        $q .=   ' descuento_porcentaje_articulo = ' . $descuento_porcentaje_articulo . ', ';
        $q .=   ' descuento_euros_articulo = "' . $descuento_euros_articulo . '", ';
        $q .=   ' almacen_articulo = ' . $almacen_articulo . ' ';
        $q .= ' WHERE id_articulo = ' . $id_articulo . ';';
        return $this->execute_query($q);
    }
    
    function get_combo_almacenes($id, $val, $class=false, $lbl=false, $onChange=false, $multiple=false) {
        $iM = load_model('inputs');
        $arr_almacenes = array(
            1 => 'Almacén general',
            2 => 'Almacén secundario',
        );
        return $iM->get_select($id, $val, $arr_almacenes, $class, $lbl, $onChange, $multiple);
    }
    
    function html_ficha_producto_mini($ad) {
        
        $aux_ruta_this_img = isset($ad['img'][1]) ? $ad['img'][1] : 'vestido-maxi-negro.jpg';
        
        $op = '';
        $op .= '<div class="sesnines_shopping_articulo">';
        
        //GESTION IMG__________________________________________________________
        /*
        foreach ($ad['img'] as $key => $val) {
            //montar slider?
            //$op .=  '<div><img src="csv/vestido-maxi-negro.jpg" alt=""></div>';
            //$op .=  '<div><img src="csv/'.$val.'" alt=""></div>';
        }
        */
        
        $op .=  '<div class= "sesnines_shopping_articulo_img">';
        $op .=      '<img src="csv/'.$aux_ruta_this_img.'" alt="">';
        $op .=  '</div>';
        
        //GESTION IMG__________________________________________________________
        
        $op .=  '<div class= "sesnines_shopping_articulo_nombre">'.strtoupper($ad['nombre_articulo']).'</div>';
        $op .=  '<div class= "sesnines_shopping_articulo_descripcion">'.strtoupper($ad['descripcion_articulo']).'</div>';
        
        
        $op .=  '<div class= "sesnines_shopping_articulo_porcentaje">';
        
    if($ad['descuento_porcentaje_articulo'] && $ad['PVP_final_articulo']) {
        
        $op .=      '<div class="sesnines_shopping_articulo_precio" style="float:left">';
        $op .=          '<b>'.$ad['PVP_final_articulo'].' € </b>';
        $op .=      '</div>';

        $op .=      '<div class="sesnines_shopping_articulo_descuento" style="float:right; color:salmon;" > ';      
        $op .=          $ad['descuento_porcentaje_articulo'].'%';
        $op .=      '</div>';
    } else {
        $op .=      '<div class="sesnines_shopping_articulo_precio">';
        $op .=          '<b>'.$ad['PVP_final_articulo'].' € </b>';
        $op .=      '</div>';                             
    }
        $op .=      '<div style="clear:both"></div>';
        $op .=  '</div>';
       
        $op .=  '</div>';
        
        
        return $op;
    }
    
    /* DEPRECATED */
    /*
    function add_imagen_art($id_articulo, $nombre_img, $num_img){
        $q = '';
        switch($num_img){
            case 0:
            $q  = ' INSERT INTO '.$this->pre.'img_articulos (id_articulo, ruta0) VALUES ';
                break;
            case 1:
            //$q  = ' INSERT INTO '.$this->pre.'img_articulos (id_articulo, ruta2) VALUES ';
            $q  = ' INSERT INTO '.$this->pre.'img_articulos (id_articulo, ruta1) VALUES ';
                break;
            case 2:
            $q  = ' INSERT INTO '.$this->pre.'img_articulos (id_articulo, ruta2) VALUES ';
                break;
            case 3:
            $q  = ' INSERT INTO '.$this->pre.'img_articulos (id_articulo, ruta3) VALUES ';
                break;
            case 4:
            $q  = ' INSERT INTO '.$this->pre.'img_articulos (id_articulo, ruta4) VALUES ';
                break;
        }
        //$q  = ' INSERT INTO '.$this->pre.'img_articulos (id_articulo, ruta) VALUES ';
        $q .= ' ("'.$id_articulo.'", "'.$nombre_img.'")';
        //echo $q;
        return $this->execute_query($q);
    }
    */
    
    /* DEPRECATED */
    /*
    function update_imagen_art($id_articulo, $nombre_img, $num_img){
        $q = '';
        switch($num_img){
            case 0:
            $q  = ' UPDATE '.$this->pre.'img_articulos SET ruta0="'.$nombre_img.'" WHERE id_articulo='.$id_articulo;
                break;
            case 1:
            //$q  = ' INSERT INTO '.$this->pre.'img_articulos (id_articulo, ruta2) VALUES ';
            $q  = ' UPDATE '.$this->pre.'img_articulos SET ruta1="'.$nombre_img.'" WHERE id_articulo='.$id_articulo;
                break;
            case 2:
            $q  = ' UPDATE '.$this->pre.'img_articulos SET ruta2="'.$nombre_img.'" WHERE id_articulo='.$id_articulo;
                break;
            case 3:
            $q  = ' UPDATE '.$this->pre.'img_articulos SET ruta3="'.$nombre_img.'" WHERE id_articulo='.$id_articulo;
                break;
            case 4:
            $q  = ' UPDATE '.$this->pre.'img_articulos SET ruta4="'.$nombre_img.'" WHERE id_articulo='.$id_articulo;
                break;
        }
        //$q  = ' INSERT INTO '.$this->pre.'img_articulos (id_articulo, ruta) VALUES ';
        //$q .= ' ("'.$id_articulo.'", "'.$nombre_img.'")';
        //echo $q;
        return $this->execute_query($q);
    }
    */
}

?>