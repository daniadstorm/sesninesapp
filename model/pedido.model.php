<?php

class pedidoModel extends Model{

    const PENDIENTE = 0;

    function add_pedido_personalshopper($id_usuario, $comentario){
        $o = '';
        $q = ' INSERT INTO '.$this->pre.'usuario_pedidos ( ';
        $q .= ' id_usuario, estado_pedido, observaciones_pedido) ';
        $q .= ' VALUES ("'.$id_usuario.'",0,"'.$comentario.'")';
        $o .= $this->execute_query($q);
        return $o;
    }

    function add_articulo_pedido($id_pedido, $id_articulo, $existencia){
        //PROCEDURE restarStock
        $q = ' INSERT INTO '.$this->pre.'pedido_articulos ( ';
        $q .= 'id_pedido, id_articulo, existencia) ';
        $q .= ' VALUES ("'.$id_pedido.'","'.$id_articulo.'", "'.$existencia.'")';
        return $this->execute_query($q);
    }

    function get_pedidos_usuario($id_usuario){
        $q  = ' SELECT * FROM '.$this->pre.'usuario_pedidos as up ';
        $q .= ' WHERE up.id_usuario='.$id_usuario.' AND up.estado_pedido>=4';
        return $this->execute_query($q);
    }

    function get_pedido($id_pedido) {
        //SELECT * FROM '.$this->pre.'pedido_articulos as pa INNER JOIN '.$this->pre.'articulos as a on pa.id_articulo=a.id_articulo WHERE pa.id_pedido=1
        $q  = ' SELECT * FROM '.$this->pre.'pedido_articulos as pa ';
        $q .= ' INNER JOIN '.$this->pre.'articulos as a ';
        $q .= ' on pa.id_articulo=a.id_articulo ';
        $q .= ' WHERE pa.id_pedido='.$id_pedido;
        $r = $this->execute_query($q);
        return $this->execute_query($q);
    }

    function delete_articulo_pedido($id_pedido, $id_articulo) {
        //PROCEDURE recuperarStock
        $q = ' DELETE FROM ' . $this->pre . 'pedido_articulos ';
        $q .= ' WHERE id_pedido='.$id_pedido.' ';
        $q .= ' AND id_articulo='.$id_articulo.' ';
        return $this->execute_query($q);
    }

    function clear_articulos_pedido($id_pedido){
        $q = ' DELETE FROM '.$this->pre.'pedido_articulos ';
        $q .= ' WHERE id_pedido='.$id_pedido;
        return $this->execute_query($q);
    }

    
    function get_total_articulos_pedido($id_pedido){
        $q = ' SELECT * FROM '.$this->pre.'pedido_articulos as pa ';
        $q .= ' INNER JOIN '.$this->pre.'articulos as a ';
        $q .= ' INNER JOIN '.$this->pre.'img_articulos as ia ';
        $q .= ' on pa.id_articulo=a.id_articulo  and pa.id_articulo=ia.id_articulo ';
        $q .= ' WHERE pa.id_pedido='.$id_pedido;
        return $this->execute_query($q);
    }

    function get_total_pedidos_user($id_pedido) {
        $q  = ' SELECT * FROM '.$this->pre.'pedido_articulos as pa ';
        $q .= ' WHERE pa.id_pedido='.$id_pedido;
        $r = $this->execute_query($q);
        if ($r) return $r->num_rows;
            else return false;
    }

    function get_pedidos_personalshopper_total_regs($arr_filtro_ps=0) {
        //SELECT * FROM '.$this->pre.'usuario_pedidos as p INNER JOIN '.$this->pre.'usuarios as u on p.id_usuario=u.id_usuario WHERE p.estado_pedido=0
        $q  = ' SELECT * FROM '.$this->pre.'usuario_pedidos as p ';
        $q .= ' INNER JOIN '.$this->pre.'usuarios as u ';
        $q .= ' on p.id_usuario=u.id_usuario ';
        $q .= ' WHERE p.estado_pedido='.$arr_filtro_ps;
        $r = $this->execute_query($q);
        if ($r) return $r->num_rows;
            else return false;
    }

    function get_pedidos($pag, $regs_x_pag, $arr_filtro_ps=0) {
        $q  = ' SELECT * FROM '.$this->pre.'usuario_pedidos p ';
        $q .= ' INNER JOIN '.$this->pre.'usuarios as u ';
        $q .= ' INNER JOIN '.$this->pre.'ps as ps ';//
        $q .= ' on p.id_usuario=u.id_usuario ';
        $q .= ' AND p.id_usuario=ps.id_usuario ';//
        $q .= ' WHERE p.estado_pedido='.$arr_filtro_ps;
        $q .= ' ORDER BY p.fecha_pedido,u.fiable DESC ';
        $q .= ' LIMIT '.$pag*$regs_x_pag.','.$regs_x_pag.' ';
        echo $q;
        return $this->execute_query($q);
    }
    
    function update_art_pedido($id_pedido, $id_articulo, $seleccionado=1){
        $q = ' UPDATE '.$this->pre.'pedido_articulos ';
        $q .= ' SET seleccionado='.$seleccionado.' ';
        $q .= ' WHERE id_pedido='.$id_pedido.' ';
        $q .= ' AND id_articulo='.$id_articulo.' ';
        return $this->execute_query($q);
    }

    function get_pedidos_personalshopper($id_usuario, $estado_pedido){
        $q = ' SELECT * FROM '.$this->pre.'usuario_pedidos ';
        $q .= ' WHERE estado_pedido ='.$estado_pedido.' ';
        $q .= ' AND id_usuario = '.$id_usuario.' ';
        return $this->execute_query($q);
    }

    function get_pedidos_personalshopper_rows($id_usuario, $estado_pedido){
        $q = ' SELECT * FROM '.$this->pre.'usuario_pedidos ';
        $q .= ' WHERE estado_pedido ='.$estado_pedido.' ';
        $q .= ' AND id_usuario = '.$id_usuario.' ';
        $r = $this->execute_query($q);
        if ($r) return $r->num_rows;
            else return false;
    }

    function get_id_usuario_pedido($id_pedido){
        $q = ' SELECT u.* FROM '.$this->pre.'usuario_pedidos up ';
        $q .= ' INNER JOIN '.$this->pre.'usuarios u ';
        $q .= ' INNER JOIN '.$this->pre.'ps ps ';
        $q .= ' on u.id_usuario=ps.id_usuario ';
        $q .= ' WHERE up.id_pedido='.$id_pedido.' ';
        return $this->execute_query($q);
    }

    function update_estado_pedido($id_pedido, $estado_pedido){
        $q = ' UPDATE '.$this->pre.'usuario_pedidos ';
        $q .= ' SET estado_pedido='.$estado_pedido.' ';
        //$q .= ' fecha_lastmod_pedido=NOW()';
        $q .= ' WHERE id_pedido='.$id_pedido;
        //fecha_lastmod_pedido
        return $this->execute_query($q);
    }

    function update_estado_pedido_seleccionado($id_pedido, $prendas_seleccionadas){
        $q = ' UPDATE '.$this->pre.'usuario_pedidos ';
        $q .= ' SET prendas_seleccionadas='.$prendas_seleccionadas.' ';
        $q .= ' WHERE id_pedido='.$id_pedido;
        return $this->execute_query($q);
    }

    function update_estado_pedido_actual($id_pedido, $estado_pedido, $estado_pedido_actual){
        $q = ' UPDATE '.$this->pre.'usuario_pedidos ';
        $q .= ' SET estado_pedido='.$estado_pedido.', ';
        $q .= ' fecha_lastmod_pedido=NOW() ';
        $q .= ' WHERE id_pedido='.$id_pedido.' ';
        $q .= ' AND estado_pedido='.$estado_pedido_actual.' ';
        //fecha_lastmod_pedido
        return $this->execute_query($q);
    }

    function update_fecha_recogida_pedido($id_pedido, $fecha_pedido){
        $q = ' UPDATE '.$this->pre.'usuario_pedidos ';
        $q .= ' SET fecha_recogida_pedido='.$fecha_pedido.' ';
        $q .= ' WHERE id_pedido='.$id_pedido;
        return $this->execute_query($q);
    }

}

?>