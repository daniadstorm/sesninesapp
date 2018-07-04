<?php

class carritoModel extends Model {
    
    //5'95€ fijos y pedidos mayores a 75€
    public $precio_transporte = 3.95; 
    public $minimo_envio_gratuito = 49;
    
    private $ck = 'carrito'; //carrito key
    private $aM = false;
    
    //ESTRUCTURA DE DATOS_______________________________________________________
    //id_articulo
        //id_articulo
        //referencia
        //nombre
        //precio
        //canon
        //imagen
        //cantidad
    //ESTRUCTURA DE DATOS_______________________________________________________
    
    function __construct() {
        $this->aM = load_model('articulos');
        //$this->precio_transporte += $this->precio_transporte * IVA_GENERAL;
        //$this->minimo_envio_gratuito += $this->minimo_envio_gratuito * IVA_GENERAL;
    }
    
    function add_articulo($id_articulo, $qtt_articulo=1) {
        if (!isset($_SESSION[$this->ck][$id_articulo])) {
            $ra = $this->aM->get_articulo($id_articulo);
            if ($ra) {
                while ($row = $ra->fetch_assoc()) {
                    $_SESSION[$this->ck][$id_articulo] = array(
                        'id_articulo'=>$row['id_articulo'],
                        'marca'=>$row['marca'],
                        'referencia'=>$row['referencia'], 
                        'nombre'=>$row['nombre'],
                        'precio'=>$row['precio'],
                        'canon'=>$row['canon'],
                        'imagen'=>$row['imagen'],
                        'cantidad'=>$qtt_articulo
                    );
                }
            }
            return true;
        } else { //actualizar cantidad
            $_SESSION[$this->ck][$id_articulo]['cantidad'] = $qtt_articulo;
            return false;
        }
    }
    
    function get_articulo($id_articulo) {
        if (isset($_SESSION[$this->ck][$id_articulo])) {
            return $_SESSION[$this->ck][$id_articulo];
        } else return false;
    }
    
    function get_carrito() {
        if (isset($_SESSION[$this->ck])) {
            return $_SESSION[$this->ck];
        } else return false;
    }
    
    function delete_articulo($id_articulo) {
        if (isset($_SESSION[$this->ck][$id_articulo])) {
            unset($_SESSION[$this->ck][$id_articulo]);
            return true;
        } else return false;
    }
    
    function vaciar_carrito() {
        foreach($_SESSION[$this->ck] as $key => $val) {
            unset($_SESSION[$this->ck][$key]);
        }
        return true;
    }
    
    function get_total_articulos() {
        if (isset($_SESSION[$this->ck])) return count($_SESSION[$this->ck]);
            else return 0;
    }
    
    function get_total_precio() {
        $total = 0;
        foreach($_SESSION[$this->ck] as $key => $val) {
            $aux_precio = $_SESSION[$this->ck][$key]['precio'] + $_SESSION[$this->ck][$key]['canon'];
            //$aux_precio = $aux_precio + $aux_precio * IVA_GENERAL;
            $total = $total + ($aux_precio * $_SESSION[$this->ck][$key]['cantidad']);
        }
        return $total;
    }
    
    function get_total_envio($total_precio) {
        if ($total_precio >= $this->minimo_envio_gratuito) {
            return 0;
        } else {
            return $this->precio_transporte;
        }
    }
    
    function get_total_envio_html($total_precio, $html_obj='div', $class='envio_gratis') {
        if ($total_precio >= $this->minimo_envio_gratuito) {
            return '<'.$html_obj.' class="'.$class.'">GRATIS</'.$html_obj.'>';
        } else {
            return $this->get_formatted_price($this->precio_transporte).'&euro;';
        }
    }
    
    function get_restante_envio_gratuito_html($total_precio) {
        if ($total_precio < $this->minimo_envio_gratuito) {
            return '<div style="font-family:\'montserratlight\';font-style:italic;font-size:13px;margin-top:6px;">Faltan '.
                $this->get_formatted_price($this->minimo_envio_gratuito - $total_precio).'€ para portes GRATIS</div>';
        } else {
            return '';
        }
    }
    
    function get_total_iva() {
        return $this->get_total_precio() * IVA_GENERAL;
    }
    
    function get_formatted_price($precio) {
        return number_format((float)$precio, 2, ',', '');
    }
}
?>