<?php

class categoriasModel extends Model {
    
    function __construct() {
        //
    }
    
    function add_categoria($nombre_categoria, $imagen_categoria) {
        $q  = ' INSERT INTO '.$this->pre.'categorias (nombre_categoria, imagen_categoria) VALUES ';
        $q .= ' ("'.$nombre_categoria.'", "'.$imagen_categoria.'") ';
        return $this->execute_query($q);
    }
    
    function get_categoria($id_categoria) {
        $q  = ' SELECT c.* FROM '.$this->pre.'categorias c ';
        $q .= ' WHERE c.id_categoria = '.$id_categoria.' ';
        return $this->execute_query($q);
    }
    
    function update_categoria($id_categoria, $nombre_categoria, $imagen_categoria) {
        $q  = ' UPDATE '.$this->pre.'categorias SET ';
        $q .=   ' nombre_categoria = "'.$nombre_categoria.'", ';
        $q .=   ' imagen_categoria = "'.$imagen_categoria.'" ';
        $q .= ' WHERE id_categoria = '.$id_categoria.' ';
        return $this->execute_query($q);
    }
    
    function get_categorias($pag, $regs_x_pag) {
        $q  = ' SELECT c.* FROM '.$this->pre.'categorias c ';
        $q .= ' WHERE c.deleted = 0 ';
        $q .= ' LIMIT '.$pag.','.$regs_x_pag.' ';
        return $this->execute_query($q);
    }
    
    function get_categorias_total_regs() {
        $q  = ' SELECT c.* FROM '.$this->pre.'categorias c ';
        $q .= ' WHERE c.deleted = 0 ';
        $r = $this->execute_query($q);
        if ($r) return $r->num_rows;
            else return false;
    }
}
?>