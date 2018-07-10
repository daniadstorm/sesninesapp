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
    
    function get_etiquetas_by_articulo($id_articulo) {
        $q  = ' SELECT ae.*, e.nombre_etiqueta FROM ' . $this->pre . 'articulo_etiquetas ae ';
        $q .= ' LEFT JOIN ' . $this->pre . 'etiquetas e ON e.id_etiqueta = ae.id_etiqueta ';
        $q .= ' WHERE ae.id_articulo = ' . $id_articulo . '';
        return $this->execute_query($q);
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
    
    
    function get_select_etiquetas($id, $val, $class=false, $lbl=false, $onChange=false) {
        $iM = load_model('inputs');
        
        $arr_opt = array();
        
        $q = 'SELECT e.* FROM ' . $this->pre . 'etiquetas e';
        $r = $this->execute_query($q);
        if ($r) {
            while ($f = $r->fetch_assoc()) {
                $arr_opt[$f['id_etiqueta']] = $f['nombre_etiqueta'];
            }
        } else return false;

        return $iM->get_select($id, $val, $arr_opt, $class, $lbl, $onChange, false);
    }
    
    function delete_etiqueta($id_etiqueta) {
        $q  = ' DELETE FROM '.$this->pre.'etiquetas ';
        $q .= ' WHERE id_etiqueta = '.$id_etiqueta.' ';
        return $this->execute_query($q);
    }
}
?>