<?php

class categoriasModel extends Model {
    
    function __construct() {
        //
    }
    
    function add_etiqueta($nombre_etiqueta) {
        /*
        $q  = ' INSERT INTO '.$this->pre.'categorias (nombre_categoria, imagen_categoria) VALUES ';
        $q .= ' ("'.$nombre_categoria.'", "'.$imagen_categoria.'") ';
        return $this->execute_query($q);
         */
    }
    
    function get_etiqueta($id_etiqueta) {
        /*
        $q  = ' SELECT c.* FROM '.$this->pre.'categorias c ';
        $q .= ' WHERE c.id_categoria = '.$id_categoria.' ';
        return $this->execute_query($q);
        */
    }
    
    function update_etiqueta($id_categoria, $nombre_categoria, $imagen_categoria) {
        /*
        $q  = ' UPDATE '.$this->pre.'categorias SET ';
        $q .=   ' nombre_categoria = "'.$nombre_categoria.'", ';
        $q .=   ' imagen_categoria = "'.$imagen_categoria.'" ';
        $q .= ' WHERE id_categoria = '.$id_categoria.' ';
        return $this->execute_query($q);
        */
    }
    
    function get_etiquetas($pag, $regs_x_pag, $order_by=true) {
        /*
        $q  = ' SELECT c.* FROM '.$this->pre.'categorias c ';
        $q .= ' WHERE c.deleted = 0 ';
        if ($order_by) $q .= ' ORDER BY c.nombre_categoria ASC ';
        $q .= ' LIMIT '.$pag.','.$regs_x_pag.' ';
        return $this->execute_query($q);
        */
    }
    
    function get_etiquetas_total_regs() {
        /*
        $q  = ' SELECT c.* FROM '.$this->pre.'categorias c ';
        $q .= ' WHERE c.deleted = 0 ';
        $r = $this->execute_query($q);
        if ($r) return $r->num_rows;
            else return false;
        */
    }
    
    function is_safe_deleting($id_etiqueta) {
        //adst_sesnines_articulo_categorias
        /*
        $q  = ' SELECT uc.id_usuario FROM '.$this->pre.'usuario_categorias uc ';
        $q .= ' WHERE uc.id_categoria = '.$id_categoria.' ';
        $r = $this->execute_query($q);
        if ($r) {
            if ($r->num_rows == 0) return true;
                else return false;
        } else return false;
        */
    }
    
    function delete_etiqueta($id_etiqueta) {
        /*
        $q  = ' DELETE FROM '.$this->pre.'categorias ';
        $q .= ' WHERE id_categoria = '.$id_categoria.' ';
        return $this->execute_query($q);
        */
    }
}
?>