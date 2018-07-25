<?php

class existenciasModel extends Model {
    
    function __construct() {
        //
    }
    
    function add_existencia($id_articulo, $color_existencia, $talla_existencia, $cantidad_existencia) {
        $q  = ' INSERT INTO '.$this->pre.'articulo_existencias (id_articulo, color_existencia, talla_existencia, cantidad_existencia) VALUES ';
        $q .= ' ('.$id_articulo.', "'.$color_existencia.'", "'.$talla_existencia.'", '.$cantidad_existencia.') ';
        return $this->execute_query($q);
    }
    
    function get_existencia($id_existencia) {
        $q  = ' SELECT aex.* FROM '.$this->pre.'articulo_existencias aex ';
        $q .= ' WHERE aex.id_existencia = '.$id_existencia.' ';
        return $this->execute_query($q);
    }
    
    function update_existencia($id_existencia, $id_articulo, $color_existencia, $talla_existencia, $cantidad_existencia) {
        $q  = ' UPDATE '.$this->pre.'articulo_existencias SET ';
        $q .=   ' id_articulo = '.$id_articulo.', ';
        $q .=   ' color_existencia = "'.$color_existencia.'", ';
        $q .=   ' color_existencia = "'.$color_existencia.'", ';
        $q .=   ' cantidad_existencia = '.$cantidad_existencia.' ';
        $q .= ' WHERE id_existencia = '.$id_existencia.' ';
        return $this->execute_query($q);
    }
    
    function get_existencias_by_articulo($id_articulo) {
        $q  = ' SELECT aex.* FROM ' . $this->pre . 'articulo_existencias aex ';
        $q .= ' WHERE aex.id_articulo = '.$id_articulo.'';
        return $this->execute_query($q);
    }
    
    function delete_existencia($id_existencia) {
        $q  = ' DELETE FROM '.$this->pre.'articulo_existencias ';
        $q .= ' WHERE id_existencia = '.$id_existencia.' ';
        return $this->execute_query($q);
    }
    
    function get_select_tallas($id, $val, $class=false, $lbl=false, $onChange=false) {
        $iM = load_model('inputs');
        $uM = load_model('usuario');
        
        $arr_opt = array_merge($uM->arr_talla_superior, $uM->arr_talla_pecho);
        
        return $iM->get_select($id, $val, $arr_opt, $class, $lbl, $onChange);
    }
}
?>