<?php

class etiquetasModel extends Model {
    
    function __construct() {
        //
    }
    
    function add_etiqueta($nombre_etiqueta) {
        $q  = ' INSERT INTO '.$this->pre.'etiquetas (nombre_etiqueta) VALUES ';
        $q .= ' ("'.$nombre_etiqueta.'") ';
        return $this->execute_query($q);
    }
    
    function get_etiqueta($id_etiqueta) {
        $q  = ' SELECT e.* FROM '.$this->pre.'etiquetas e ';
        $q .= ' WHERE e.id_etiqueta = '.$id_etiqueta.' ';
        return $this->execute_query($q);
    }
    
    function update_etiqueta($id_etiqueta, $nombre_etiqueta) {
        $q  = ' UPDATE '.$this->pre.'etiquetas SET ';
        $q .=   ' nombre_etiqueta = "'.$nombre_etiqueta.'" ';
        $q .= ' WHERE id_etiqueta = '.$id_etiqueta.' ';
        return $this->execute_query($q);
    }
    
    function get_etiquetas($pag, $regs_x_pag, $order_by=true) {
        $q  = ' SELECT e.* FROM '.$this->pre.'etiquetas e ';
        if ($order_by) $q .= ' ORDER BY e.nombre_etiqueta ASC ';
        $q .= ' LIMIT '.$pag*$regs_x_pag.','.$regs_x_pag.' ';
        return $this->execute_query($q);
    }
    
    function get_etiquetas_total_regs() {
        $q  = ' SELECT e.* FROM '.$this->pre.'etiquetas e ';
        $r = $this->execute_query($q);
        if ($r) return $r->num_rows;
            else return false;
    }
    
    function is_safe_deleting($id_etiqueta) {
        //adst_sesnines_articulo_etiquetas
        $q  = ' SELECT ae.id_articulo FROM '.$this->pre.'articulo_etiquetas ae ';
        $q .= ' WHERE ae.id_etiqueta = '.$id_etiqueta.' ';
        $r = $this->execute_query($q);
        if ($r) {
            if ($r->num_rows == 0) return true;
                else return false;
        } else return false;
    }
    
    function delete_etiqueta($id_etiqueta) {
        $q  = ' DELETE FROM '.$this->pre.'etiquetas ';
        $q .= ' WHERE id_etiqueta = '.$id_etiqueta.' ';
        return $this->execute_query($q);
    }
}
?>