<?php

class analyticsModel extends Model{

    function get_avg_ps_tallasuperior(){
        $q = ' SELECT * FROM '.$this->pre.'usuarios WHERE MONTH(fecha_registro)="'.$mes.'" ';
        return $this->execute_query($q);
    }

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

    function get_chart($id, $tipo, $titulo, $data, $bgcolor, $barPercentage=1){
        $qtt = 0;
        $label = '';
        $xdata = '';
        $strbg = '';
        foreach ($data as $value => $key) {
            $label .= '"'.$value.'"';
            $xdata .= '"'.$key.'"';
            if($qtt < count($data)-1){
                $label .= ',';
                $xdata .= ',';
            }
            if(is_array($bgcolor)){
                if($qtt < count($data)-1){
                    $strbg .= '"'.$bgcolor[rand(0,count($bgcolor)-1)].'",';
                }else{
                    $strbg .= '"'.$bgcolor[rand(0,count($bgcolor)-1)].'"';
                }
            }else{
                $strbg = '"'.$bgcolor.'"';
            }
            $qtt++;
        }
        
        $q = 'new Chart(document.getElementById("'.$id.'"), {
            type: \''.$tipo.'\',
            data: {
                labels: [';
        $q .= $label;
        $q .='],
                datasets: [
                    {
                        showLine: true,
                        data: [';
        $q .= $xdata;
        $q .= '],
                        backgroundColor: ['.$strbg.']
                    }
                ]
            },
            options: {
                legend: { display: false },
                title: {
                    display: true,
                    text: \''.$titulo.'\'
                },
                xAxes: [{
                    barPercentage: '.$barPercentage.'
                }]
            }
        });';

        return $q;
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