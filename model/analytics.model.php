<?php

class analyticsModel extends Model{

    function get_registro_month($mes){
        $q = ' SELECT * FROM '.$this->pre.'usuarios WHERE MONTH(fecha_registro)="'.$mes.'" ';
        $r = $this->execute_query($q);
        if ($r) return $r->num_rows;
            else return false;
    }

    function get_pedidos_month($mes){
        $q = ' SELECT * FROM '.$this->pre.'usuario_pedidos WHERE MONTH(fecha_pedido)="'.$mes.'" ';
        $r = $this->execute_query($q);
        if ($r) return $r->num_rows;
            else return false;
    }

    /* function add_articulo_pedido($id_pedido, $id_articulo, $existencia){
        //PROCEDURE restarStock
        $q = ' INSERT INTO '.$this->pre.'pedido_articulos ( ';
        $q .= 'id_pedido, id_articulo, existencia) ';
        $q .= ' VALUES ("'.$id_pedido.'","'.$id_articulo.'", "'.$existencia.'")';
        echo $q;
        return $this->execute_query($q);
    } */

    /* function update_fecha_recogida_pedido($id_pedido, $fecha_pedido){
        $q = ' UPDATE '.$this->pre.'usuario_pedidos ';
        $q .= ' SET fecha_recogida_pedido='.$fecha_pedido.' ';
        $q .= ' WHERE id_pedido='.$id_pedido;
        return $this->execute_query($q);
    } */

}

?>