<?php

class categoriasModel extends Model {
    
    public $dir = 'imgcategorias/';
    
    function __construct() {
        //
    }
    
    function add_categoria($nombre_categoria) {
        $q  = ' INSERT INTO '.$this->pre.'categorias (nombre_categoria) VALUES ';
        $q .= ' ("'.$nombre_categoria.'") ';
        return $this->execute_query($q);
    }

    function get_subcategoria($id_categoria) {
        $q  = ' SELECT c.* FROM '.$this->pre.'subcategorias c ';
        $q .= ' WHERE c.id_categoria = '.$id_categoria.' ';
        return $this->execute_query($q);
    }

    function add_subcategoria($nombre_subcategoria, $id_categoria_padre) {
        $q  = ' INSERT INTO '.$this->pre.'subcategorias (nombre_subcategoria, id_categoria) VALUES ';
        $q .= ' ("'.$nombre_subcategoria.'", "'.$id_categoria_padre.'") ';
        return $this->execute_query($q);
    }
    
    function get_categoria($id_categoria) {
        $q  = ' SELECT c.* FROM '.$this->pre.'categorias c ';
        $q .= ' WHERE c.id_categoria = '.$id_categoria.' ';
        return $this->execute_query($q);
    }

    function get_subcategorias($id_categoria) {
        $q  = ' SELECT c.* FROM '.$this->pre.'subcategorias c ';
        $q .= ' WHERE c.id_subcategoria = '.$id_categoria.' ';
        return $this->execute_query($q);
    }

    function get_last_id_categoria() {
        $q  = ' SELECT max(id_categoria) as cat FROM '.$this->pre.'categorias c ';
        /* $q .= ' WHERE c.id_categoria = '.$id_categoria.' '; */
        return $this->execute_query($q);
    }
    
    function update_estado_categoria($id_categoria, $visible) {
        $q  = ' UPDATE '.$this->pre.'categorias SET ';
        $q .=   ' visible = "'.$visible.'" ';
        $q .= ' WHERE id_categoria = '.$id_categoria.' ';
        return $this->execute_query($q);
    }

    function update_estado_subcategoria($id_categoria, $visible) {
        $q  = ' UPDATE '.$this->pre.'subcategorias SET ';
        $q .=   ' visible = "'.$visible.'" ';
        $q .= ' WHERE id_subcategoria = '.$id_categoria.' ';
        return $this->execute_query($q);
    }

    function update_categoria($id_categoria, $nombre_categoria) {
        $q  = ' UPDATE '.$this->pre.'categorias SET ';
        $q .=   ' nombre_categoria = "'.$nombre_categoria.'" ';
        $q .= ' WHERE id_categoria = '.$id_categoria.' ';
        return $this->execute_query($q);
    }

    function update_subcategoria($id_categoria, $nombre_categoria) {
        $q  = ' UPDATE '.$this->pre.'subcategorias SET ';
        $q .=   ' nombre_subcategoria = "'.$nombre_categoria.'" ';
        $q .= ' WHERE id_subcategoria = '.$id_categoria.' ';
        return $this->execute_query($q);
    }
    
    function update_nombre_categoria($id_categoria, $nombre_categoria) {
        $q  = ' UPDATE '.$this->pre.'categorias SET ';
        $q .=   ' nombre_categoria = "'.$nombre_categoria.'" ';
        $q .= ' WHERE id_categoria = '.$id_categoria.' ';
        return $this->execute_query($q);
    }
    
    function get_categorias($pag, $regs_x_pag, $order_by=true) {
        $q  = ' SELECT c.* FROM '.$this->pre.'categorias c ';
        $q .= ' WHERE c.deleted = 0 ';
        if ($order_by) $q .= ' ORDER BY c.nombre_categoria ASC ';
        $q .= ' LIMIT '.$pag*$regs_x_pag.','.$regs_x_pag.' ';
        return $this->execute_query($q);
    }

    function get_all_categorias($order_by=true) {
        $q  = ' SELECT c.* FROM '.$this->pre.'categorias c ';
        $q .= ' WHERE c.deleted = 0 ';
        if ($order_by) $q .= ' ORDER BY c.nombre_categoria ASC ';
        return $this->execute_query($q);
    }

    function get_all_subcategorias($order_by=true) {
        $q  = ' SELECT c.* FROM '.$this->pre.'subcategorias c ';
        $q .= ' WHERE c.deleted = 0 ';
        if ($order_by) $q .= ' ORDER BY c.nombre_subcategoria ASC ';
        return $this->execute_query($q);
    }

    function add_categoria_articulo($id_articulo, $id_categoria, $subcategoria=0) {
        $q  = ' INSERT INTO '.$this->pre.'categorias_articulos (id_articulo, id_categoria, subcategoria) VALUES ';
        $q .= ' ("'.$id_articulo.'", "'.$id_categoria.'", "'.$subcategoria.'") ';
        return $this->execute_query($q);
    }
    
    function get_categorias_total_regs() {
        $q  = ' SELECT c.* FROM '.$this->pre.'categorias c ';
        $q .= ' WHERE c.deleted = 0 ';
        $r = $this->execute_query($q);
        if ($r) return $r->num_rows;
            else return false;
    }
    
    function is_safe_deleting($id_categoria) {
        //adst_sesnines_articulo_categorias
        $q  = ' SELECT uc.id_usuario FROM '.$this->pre.'usuario_categorias uc ';
        $q .= ' WHERE uc.id_categoria = '.$id_categoria.' ';
        $r = $this->execute_query($q);
        if ($r) {
            if ($r->num_rows == 0) return true;
                else return false;
        } else return false;
    }
    
    function clean_dir_imgcategorias($document_root) {
        //todos los archivos que no estén en la tabla se eliminan
        
        $arr_bbdd = array();
        $arr_dir = array();
        
        $q  = ' SELECT c.* FROM '.$this->pre.'categorias c ';
        $q .= ' WHERE c.deleted = 0 ';
        $r = $this->execute_query($q);
        if ($r) {
            while ($f = $r->fetch_assoc()) {
                //array con nombres de archivo de tabla sql
                $arr_bbdd []= substr($f['imagen_categoria'], (strpos($f['imagen_categoria'], '/')+1), strlen($f['imagen_categoria'])); //desde la barra hasta el final
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
    
    function delete_categoria($id_categoria) {
        $q  = ' DELETE FROM '.$this->pre.'categorias ';
        $q .= ' WHERE id_categoria = '.$id_categoria.' ';
        return $this->execute_query($q);
    }

    function delete_subcategoria($id_categoria) {
        $q  = ' DELETE FROM '.$this->pre.'subcategorias ';
        $q .= ' WHERE id_subcategoria = '.$id_categoria.' ';
        return $this->execute_query($q);
    }
}
?>