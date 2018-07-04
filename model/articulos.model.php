<?php

class articulosModel extends Model {
    
    
    
    function add_articulo($nombre_articulo,$referencia_articulo,$referencia_proveedor_articulo,$descripcion_articulo,$activado_articulo, $visible_en_tienda_articulo,
        $precio_coste_articulo,$coste_externo_portes_articulo,$PVP_final_articulo,$margen_articulo,$inicio_descuento_articulo,$fin_descuento_articulo,
        $descuento_porcentaje_articulo,$descuento_euros_articulo,$cantidad_articulo, $almacen_articulo) {
        //si ambos no están vacios
        if (!$inicio_descuento_articulo == 0 && !$fin_descuento_articulo == 0) {
            $inicio = new DateTime($inicio_descuento_articulo);
            $fin = new DateTime($fin_descuento_articulo);

            $inicio_descuento_articulo = $inicio->format('Y-m-d');
            $fin_descuento_articulo =  $fin->format('Y-m-d');
        } else {
            $inicio = null;
            $fin = null;
        }
        
        
        $q  = ' INSERT INTO ' . $this->pre . 'articulos (nombre_articulo, referencia_articulo, referencia_proveedor_articulo, descripcion_articulo, activado_articulo, ';
        $q .=   ' visible_en_tienda_articulo, precio_coste_articulo, coste_externo_portes_articulo, PVP_final_articulo, margen_articulo, cantidad_articulo, ';
        $q .=   ' inicio_descuento_articulo, fin_descuento_articulo, descuento_porcentaje_articulo, descuento_euros_articulo, almacen_articulo ) VALUES ';
        $q .= ' ("' . $nombre_articulo . '", "' . $referencia_articulo . '", "' . $referencia_proveedor_articulo . '", "' . $descripcion_articulo . '", ';
        $q .= ' "' . $activado_articulo . '", "' . $visible_en_tienda_articulo . '", "' .$precio_coste_articulo . '", "' . $coste_externo_portes_articulo . '", ';
        $q .= ' "' . $PVP_final_articulo . '", "' . $margen_articulo . '","' . $cantidad_articulo . '", "' .$inicio_descuento_articulo. '", "' .$fin_descuento_articulo. '", ';
        $q .= ' "' .$descuento_porcentaje_articulo. '", "'.$descuento_euros_articulo.'","' . $almacen_articulo . '")';

        //echo $q ;

        return $this->execute_query($q);
    }

    function add_articulo_etiquetas($id_articulo, $id_etiqueta) {

        $q = ' INSERT INTO ' . $this->pre . 'articulo_etiquetas ( 
                id_articulo, id_etiqueta ) VALUES ';
        $q .= ' (' . $id_articulo . ', ' . $id_etiqueta . ')';

        // echo $q.'<br>' ;

        return $this->execute_query($q);
    }

    function delete_articulo_etiquetas($id_articulo) {
        $q = ' DELETE FROM ' . $this->pre . 'articulo_etiquetas';
        $q .= ' WHERE id_articulo = ' . $id_articulo . ' ';
        return $this->execute_query($q);
    }

    function delete_articulo_etiquetas_etiqueta($id_articulo, $id_etiqueta) {
        $q = ' DELETE FROM ' . $this->pre . 'articulo_etiquetas';
        $q .= ' WHERE id_articulo = ' . $id_articulo . ' AND id_etiqueta = ' . $id_etiqueta . ' ';
        //echo $q;
        return $this->execute_query($q);
    }

    function get_articulos($pag, $regs_x_pag) {
        $q = ' SELECT a.* FROM ' . $this->pre . 'articulos a ';
        //$q .= ' WHERE a.cantidad_articulo>0 ';
        $q .= ' LIMIT ' . ($pag * $regs_x_pag) . ', ' . $regs_x_pag . ' ';
         //echo $q;
        return $this->execute_query($q);
    }

    function get_articulos_total_regs() {
        $q = ' SELECT a.* FROM ' . $this->pre . 'articulos a ';
        //$q .= ' WHERE a.';
        $r = $this->execute_query($q);
        if ($r) return $r->num_rows;
            else return false;
    }

    function get_articulo($id_articulo) {
        $q = ' SELECT u.* FROM ' . $this->pre . 'articulos u ';
        $q .= ' WHERE u.id_articulo = ' . $id_articulo . ' ';
        //$q .= ' AND u.deleted = 0';
        return $this->execute_query($q);
    }

    function get_articulo_img($id_articulo) {
        $q = ' SELECT ia.* FROM ' . $this->pre . 'img_articulos ia ';
        $q .= ' WHERE ia.id_articulo = ' . $id_articulo . '';
        
        //$q .= ' AND ia.deleted = 0';
        //echo $q;
        return $this->execute_query($q);
    }

    function delete_articulo_img($id_articulo, $i) {
        
        //echo 'i: '.$i.'<br>';
        //echo 'ruta: '.$ruta.'<br>';
        //echo 'id_articulo: '.$id_articulo.'<br>';
        
        $q = ' UPDATE ' . $this->pre . 'img_articulos SET ';
         
        $q .= ' ruta'.$i.' = \'\'';
        $q .= ' WHERE id_articulo = ' . $id_articulo . ' ';
        
        //$q .= ' AND ia.deleted = 0';
        echo $q;
        return $this->execute_query($q);
    }

    function get_etiquetas() {
        $q = ' SELECT e.* FROM ' . $this->pre . 'etiquetas e ';
        // $q .= ' WHERE u.deleted = 0';
        return $this->execute_query($q);
    }

    function get_total_etiquetas() {
        $r = $this->get_etiquetas();
        if ($r)
            return $r->num_rows;
        else
            return false;
    }

    //recoge las etiquetas por el id del artículo
    function get_etiquetas_by_articulo($id_articulo) {
        $q = ' SELECT ae.*, e.nombre_etiqueta FROM ' . $this->pre . 'articulo_etiquetas ae ';
        $q .= ' LEFT JOIN ' . $this->pre . 'etiquetas e ON e.id_etiqueta = ae.id_etiqueta ';
        $q .= ' WHERE ae.id_articulo = ' . $id_articulo . '';

        // echo $q;
        return $this->execute_query($q);
    }

    function update_articulo($id_articulo, $nombre_articulo, $referencia_articulo,$referencia_proveedor_articulo,$descripcion_articulo,$activado_articulo,
                $visible_en_tienda_articulo,$precio_coste_articulo,$coste_externo_portes_articulo,$PVP_final_articulo,$margen_articulo,$inicio_descuento_articulo,
                $fin_descuento_articulo,$descuento_porcentaje_articulo,$descuento_euros_articulo,$cantidad_articulo, $almacen_articulo){
        
        /*
        if (!$inicio_descuento_articulo == 0 && !$fin_descuento_articulo == 0) {
            $inicio = new DateTime($inicio_descuento_articulo);
            $fin = new DateTime($fin_descuento_articulo);

            $inicio_descuento_articulo = $inicio->format('Y-m-d');
            $fin_descuento_articulo =  $fin->format('Y-m-d');
        } else {
            $inicio = null;
            $fin = null;
        }
        */

        $q = ' UPDATE ' . $this->pre . 'articulos SET ';
        $q .= ' nombre_articulo = "' . $nombre_articulo . '", ';
        $q .= ' referencia_articulo = "' . $referencia_articulo . '", ';
        $q .= ' referencia_proveedor_articulo = "' . $referencia_proveedor_articulo . '", ';
        $q .= ' descripcion_articulo = "' . $descripcion_articulo . '", ';
        $q .= ' activado_articulo = "' . $activado_articulo . '", ';
        $q .= ' visible_en_tienda_articulo = "' . $visible_en_tienda_articulo . '", ';
        $q .= ' precio_coste_articulo = "' . $precio_coste_articulo . '", ';
        $q .= ' coste_externo_portes_articulo = "' . $coste_externo_portes_articulo . '", ';
        $q .= ' PVP_final_articulo = "' . $PVP_final_articulo . '", ';
        $q .= ' margen_articulo = "' . $margen_articulo . '", ';
        $q .= ' cantidad_articulo = "' . $cantidad_articulo . '", ';
        $q .= ' inicio_descuento_articulo = "' . $inicio_descuento_articulo. '", ';
        $q .= ' fin_descuento_articulo = "' . $fin_descuento_articulo. '", ';
        $q .= ' descuento_porcentaje_articulo = ' . $descuento_porcentaje_articulo . ', ';
        $q .= ' descuento_euros_articulo = ' . $descuento_euros_articulo . ', ';
        $q .= ' almacen_articulo = ' . $almacen_articulo . ' ';

        $q .= ' WHERE id_articulo = ' . $id_articulo . ';';
        //echo $q.'<br>';
        return $this->execute_query($q);
    }

    function get_combo_etiquetas($id, $selected = false, $class = false, $onChange = false, $default = true) {
        $o = ''; //output
        $q = 'SELECT e.* FROM ' . $this->pre . 'etiquetas e';
        // $q .= ' WHERE gc.deleted = 0 ';
        $r = $this->execute_query($q);
        if ($r) {
            $o .= '<select style="font-size:1em; margin:0em 0em 0em 2em;" id="' . $id . '" name="' . $id . '" ';
            if ($class)
                $o .= ' class ="' . $class . '" ';
            if ($onChange)
                $o .= ' onchange="' . $onChange . '" ';
            $o .= '>';
            if ($default)
                $o .= '<option value="-1">-- Todas las etiquetas --</option>';
            while ($f = $r->fetch_assoc()) {
                $o .= '<option ' . (($selected == $f['id_etiqueta']) ? ' selected="selected" ' : '') . ' value="' . $f['id_etiqueta'] . '">' . $f['nombre_etiqueta'] . '</option>';
            }
            $o .= '</select>';
        } else
            return false;


        return $o;
    }
    
      function get_combo_array_articulos($arr, $id, $selected=false, $class=false, $onChange=false) {
        $o  = '';
        $o .= '<select id="'.$id.'" name="'.$id.'" ';
        if ($class) $o .= ' class ="'.$class.'" ';
        (!$onChange) ? $o .= '>' : $o .= 'onchange="this.form.submit()">';
        //$o .= '>';
        foreach ($arr as $key => $val) $o .= '<option '.(($selected == $key) ? ' selected="selected" ' : '').' value="'.$key.'">'.$val.'</option>';
        $o .= '</select>';
        return $o;
    }
    
    function get_combo_tipo_estilo_arti($id, $selected=false, $class=false, $default=false) {
        $arr_estilos = array(
            '01' => 'Almacén general',
            '02' => 'Almacén x',
           
        );
        return $this->get_combo_array_articulos($arr_estilos, $id, $selected, $class, $default);
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
  
}

?>