<?php

class proveedoresModel extends Model {
    
    function __construct() {
        //
    }
    
    function add_proveedor($nombre_proveedor, $referencia_proveedor) {
        $q  = ' INSERT INTO '.$this->pre.'proveedores (nombre_proveedor, referencia_proveedor) VALUES ';
        $q .= ' ("'.$nombre_proveedor.'", "'.$referencia_proveedor.'") ';
        return $this->execute_query($q);
    }
    
    function get_proveedor($id_proveedor) {
        $q  = ' SELECT e.* FROM '.$this->pre.'proveedores e ';
        $q .= ' WHERE e.id_proveedor = '.$id_proveedor.' ';
        return $this->execute_query($q);
    }
    
    function update_proveedor($id_proveedor, $nombre_proveedor, $referencia_proveedor) {
        $q  = ' UPDATE '.$this->pre.'proveedores SET ';
        $q .=   ' nombre_proveedor = "'.$nombre_proveedor.'", ';
        $q .=   ' referencia_proveedor = "'.$referencia_proveedor.'" ';
        $q .= ' WHERE id_proveedor = '.$id_proveedor.' ';
        return $this->execute_query($q);
    }

    function get_total_proveedores(){
        $q  = ' SELECT e.* FROM '.$this->pre.'proveedores e ';
        return $this->execute_query($q);
    }
    
    function get_proveedores($pag, $regs_x_pag, $order_by=true) {
        $q  = ' SELECT e.* FROM '.$this->pre.'proveedores e ';
        if ($order_by) $q .= ' ORDER BY e.nombre_proveedor ASC ';
        $q .= ' LIMIT '.$pag*$regs_x_pag.','.$regs_x_pag.' ';
        return $this->execute_query($q);
    }
    
    function get_proveedores_total_regs() {
        $q  = ' SELECT e.* FROM '.$this->pre.'proveedores e ';
        $r = $this->execute_query($q);
        if ($r) return $r->num_rows;
            else return false;
    }
    
    function get_proveedores_by_articulo($id_articulo) {
        $q  = ' SELECT ae.*, e.nombre_proveedor FROM ' . $this->pre . 'articulo_proveedores ae ';
        $q .= ' LEFT JOIN ' . $this->pre . 'proveedores e ON e.id_proveedor = ae.id_proveedor ';
        $q .= ' WHERE ae.id_articulo = ' . $id_articulo . '';
        return $this->execute_query($q);
    }
    
    function is_safe_deleting($id_proveedor) {
        //adst_sesnines_articulo_proveedores
        $q  = ' SELECT ae.id_articulo FROM '.$this->pre.'articulo_proveedores ae ';
        $q .= ' WHERE ae.id_proveedor = '.$id_proveedor.' ';
        $r = $this->execute_query($q);
        if ($r) {
            if ($r->num_rows == 0) return true;
                else return false;
        } else return false;
    }
    
    
    function get_select_proveedores($id, $val, $class=false, $lbl=false, $onChange=false) {
        $iM = load_model('inputs');
        
        $arr_opt = array();
        
        $q = 'SELECT e.* FROM ' . $this->pre . 'proveedores e';
        $r = $this->execute_query($q);
        if ($r) {
            while ($f = $r->fetch_assoc()) {
                $arr_opt[$f['id_proveedor']] = $f['nombre_proveedor'];
            }
        } else return false;

        return $iM->get_select($id, $val, $arr_opt, $class, $lbl, $onChange, false);
    }
    
    function delete_proveedor($id_proveedor) {
        $q  = ' DELETE FROM '.$this->pre.'proveedores ';
        $q .= ' WHERE id_proveedor = '.$id_proveedor.' ';
        return $this->execute_query($q);
    }
}
?>