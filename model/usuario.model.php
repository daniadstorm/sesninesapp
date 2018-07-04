<?php

class usuarioModel extends Model {
    
    private $tipo_usuario = USER;
    private $tipo_admin = ADMIN;
    
    public $lbl_tipos_usuario = array();
    
    function __construct() {
    }
    
    function add_usuario($nombre_usuario, $fecha_nacimiento, $nombrecompleto_usuario, $email_usuario, $contrasenya_usuario, $telf_usuario, $nie_usuario, 
        $id_tipo_usuario) {
        
        $q  = ' INSERT INTO '.$this->pre.'usuarios ( '.
            'nombre_usuario, fecha_nacimiento, nombrecompleto_usuario, email_usuario, contrasenya_usuario, telf_usuario, nie_usuario, id_tipo_usuario, estado_usuario) VALUES ';
        $q .= ' ("'.$nombre_usuario.'", "'.$fecha_nacimiento.'", "'.$nombrecompleto_usuario.'", "'.$email_usuario.'", "'.$contrasenya_usuario.'", "'.$telf_usuario.'", "'.$nie_usuario.'", '.
            $id_tipo_usuario.', 0) ';
        return $this->execute_query($q);
    }

    function add_usuario_fb($nombre_usuario, $nombrecompleto_usuario, $email_usuario, $id_tipo_usuario) {
        
        $q  = ' INSERT INTO '.$this->pre.'usuarios ( '.
            'nombre_usuario, nombrecompleto_usuario, email_usuario, id_tipo_usuario, estado_usuario) VALUES ';
        $q .= ' ("'.$nombre_usuario.'", "'.$nombrecompleto_usuario.'", "'.$email_usuario.'", '.
            $id_tipo_usuario.', 0) ';
        return $this->execute_query($q);
    }

    function add_miarmario_usuario($id_usuario, $tipo_prenda, $prenda_renovar) {
        
        $q  = ' INSERT INTO '.$this->pre.'usuario_miarmario ( '.
            'id_usuario, tipo_prenda, prenda_renovar) VALUES ';
        $q .= ' ("'.$id_usuario.'", "'.$tipo_prenda.'", "'.$prenda_renovar.'")';
        return $this->execute_query($q);
    }

    function add_asesorame_usuario($id_usuario, $look_asesoria, $razon_ps, $comentario) {
        
        $q  = ' INSERT INTO '.$this->pre.'usuario_asesorame ( '.
            'id_usuario, look_asesoria, razon_ps, comentario) VALUES ';
        $q .= ' ("'.$id_usuario.'", "'.$look_asesoria.'", "'.$razon_ps.'", "'.$comentario.'")';
        return $this->execute_query($q);
    }

    function add_destino_usuario($id_usuario, $nombre, $direccion, $cp, $poblacion, $provincia, $fecha_hora_inicio, $fecha_hora_fin) {
        $q  = ' INSERT INTO '.$this->pre.'usuario_destinos (id_usuario, nombre, direccion, cp, poblacion, provincia, fecha_hora_inicio, fecha_hora_fin) VALUES ';
        $q .= ' ("'.$id_usuario.'", "'.$nombre.'", "'.$direccion.'", "'.$cp.'", "'.$poblacion.'", "'.$provincia.'", "'.$fecha_hora_inicio.'", "'.$fecha_hora_fin.'")';
        return $this->execute_query($q);
    }

    function add_imagen_articulo($id_articulo, $nombre_img, $num_img){
        $q = '';
        switch($num_img){
            case 0:
            $q  = ' INSERT INTO '.$this->pre.'img_articulos (id_articulo, ruta) VALUES ';
                break;
            case 1:
            //$q  = ' INSERT INTO '.$this->pre.'img_articulos (id_articulo, ruta2) VALUES ';
            $q  = ' INSERT INTO '.$this->pre.'img_articulos (id_articulo, ruta2) VALUES ';
                break;
            case 2:
            $q  = ' INSERT INTO '.$this->pre.'img_articulos (id_articulo, ruta3) VALUES ';
                break;
            case 3:
            $q  = ' INSERT INTO '.$this->pre.'img_articulos (id_articulo, ruta4) VALUES ';
                break;
            case 4:
            $q  = ' INSERT INTO '.$this->pre.'img_articulos (id_articulo, ruta5) VALUES ';
                break;
        }
        //$q  = ' INSERT INTO '.$this->pre.'img_articulos (id_articulo, ruta) VALUES ';
        $q .= ' ("'.$id_articulo.'", "'.$nombre_img.'")';
        //echo $q;
        return $this->execute_query($q);
    }
    

    function update_imagen_articulo($id_articulo, $nombre_img, $num_img){
        $q = '';
        switch($num_img){
            case 0:
            $q  = ' UPDATE '.$this->pre.'img_articulos SET ruta="'.$nombre_img.'" WHERE id_articulo='.$id_articulo;
                break;
            case 1:
            //$q  = ' INSERT INTO '.$this->pre.'img_articulos (id_articulo, ruta2) VALUES ';
            $q  = ' UPDATE '.$this->pre.'img_articulos SET ruta2="'.$nombre_img.'" WHERE id_articulo='.$id_articulo;
                break;
            case 2:
            $q  = ' UPDATE '.$this->pre.'img_articulos SET ruta3="'.$nombre_img.'" WHERE id_articulo='.$id_articulo;
                break;
            case 3:
            $q  = ' UPDATE '.$this->pre.'img_articulos SET ruta4="'.$nombre_img.'" WHERE id_articulo='.$id_articulo;
                break;
            case 4:
            $q  = ' UPDATE '.$this->pre.'img_articulos SET ruta5="'.$nombre_img.'" WHERE id_articulo='.$id_articulo;
                break;
        }
        //$q  = ' INSERT INTO '.$this->pre.'img_articulos (id_articulo, ruta) VALUES ';
        //$q .= ' ("'.$id_articulo.'", "'.$nombre_img.'")';
        //echo $q;
        return $this->execute_query($q);
    }

    function add_categoria_usuario($id_usuario, $arr_id_categoria){
        //$arr_id_categoria es un array
        $o = '';
        for ($i=0;$i<count($arr_id_categoria); $i++) { 
            $q = ' INSERT INTO '.$this->pre.'usuario_categorias ( ';
            $q .= ' id_usuario, id_categoria) ';
            $q .= ' VALUES ("'.$id_usuario.'","'.$arr_id_categoria[$i].'")';
            $o .= $this->execute_query($q);
        }
        return $o;
    }

    function add_slider($titulo, $nombre_imagen, $t){
        $o = '';
        $q = ' INSERT INTO '.$this->pre.'usuario_imgs ( ';
        $q .= ' titulo_slider, nombre_imagen) ';//
        $q .= ' VALUES ("'.$id_usuario.'","'.$nombre_imagen.'")';
        $o .= $this->execute_query($q);
        return $o;
    }

    function add_imagen_usuario($id_usuario, $nombre_imagen){
        $o = '';
        $q = ' INSERT INTO '.$this->pre.'usuario_imgs ( ';
        $q .= ' id_usuario, nombre_imagen) ';
        $q .= ' VALUES ("'.$id_usuario.'","'.$nombre_imagen.'")';
        $o .= $this->execute_query($q);
        return $o;
    }

    function add_estilo_usuario($id_usuario, $tipo_estilo, $color_estilo, $textura_estilo, $referente_estilo){
        $q = ' INSERT INTO '.$this->pre.'estilos ( ';
        $q .= 'id_usuario, tipo_estilo, color_estilo, textura_estilo, referente_estilo) VALUES (';
        $q .= '"'.$id_usuario.'","'.$tipo_estilo.'","'.$color_estilo.'","'.$textura_estilo.'","'.$referente_estilo.'")';
        return $this->execute_query($q);
    }

    function add_sobremi_usuario($id_usuario, $actividad_estilo, $profesion_estilo, $tienes_hijos){
        $q = ' INSERT INTO '.$this->pre.'usuario_sobremi ( ';
        $q .= 'id_usuario, actividad_estilo, profesion_estilo, tienes_hijos) VALUES (';
        $q .= '"'.$id_usuario.'","'.$actividad_estilo.'","'.$profesion_estilo.'","'.$tienes_hijos.'")';
        return $this->execute_query($q);
    }
    
    function add_tallas_usuario($id_usuario, $talla_superior, $talla_inferior, $talla_pecho, $altura, $parte_preferida_cuerpo, $parte_menos_preferida_cuerpo, $tono_piel, $color_ojos, $color_pelo, $tipologia){
        $q = ' INSERT INTO '.$this->pre.'tallas ( ';
        $q .= 'id_usuario, talla_superior, talla_inferior, talla_pecho, altura, parte_preferida_cuerpo, parte_menos_preferida_cuerpo, tono_piel, color_ojos, color_pelo, tipologia) VALUES (';
        $q .= '"'.$id_usuario.'","'.$talla_superior.'","'.$talla_inferior.'","'.$talla_pecho.'","'.$altura.'","'.$parte_preferida_cuerpo.'","'.$parte_menos_preferida_cuerpo.'","'.$tono_piel.'","'.$color_ojos.'","'.$color_pelo.'","'.$tipologia.'")';
        //return $q;
        return $this->execute_query($q);
    }

    function add_looks_usuario($id_usuario, $looks_comentario, $id_libre, $id_trabajo){
        $q = ' INSERT INTO '.$this->pre.'usuario_looks (id_usuario, id_look, comentario) VALUES ("'.$id_usuario.'","'.$id_libre.'",""), ("'.$id_usuario.'","'.$id_trabajo.'",""), ("'.$id_usuario.'","9","'.$looks_comentario.'")';
        return $this->execute_query($q);
    }

    function get_usuarios($pag, $regs_x_pag, $arr_filtro_ps=false) {
        $q  = ' SELECT u.* FROM '.$this->pre.'usuarios u ';
        $q .= ' WHERE u.deleted = 0 and u.id_tipo_usuario=10 ';
        if($arr_filtro_ps=="si"){
            $q .= ' and ps_completo=1 ';
        }else if($arr_filtro_ps=="no"){
            $q .= ' and ps_completo=0 ';
        }
        $q .= ' LIMIT '.$pag.','.$regs_x_pag.' ';
        return $this->execute_query($q);
    }

    function get_usuarios_total_regs($arr_filtro_ps=false) {
        $q  = ' SELECT u.* FROM '.$this->pre.'usuarios u ';
        $q .= ' WHERE u.deleted = 0 and u.id_tipo_usuario=10 ';
        if($arr_filtro_ps=="si"){
            $q .= ' and ps_completo=1 ';
        }else if($arr_filtro_ps=="no"){
            $q .= ' and ps_completo=0 ';
        }
        $r = $this->execute_query($q);
        if ($r) return $r->num_rows;
            else return false;
    }

    function get_proximo_paquete($id_usuario){
        ////SELECT * FROM adst_sesnines_usuario_pedidos WHERE id_usuario=40 AND estado_pedido=2 AND fecha_lastmod_pedido<NOW() ORDER BY fecha_lastmod_pedido DESC LIMIT 1,1
        $q  = ' SELECT * FROM '.$this->pre.'usuario_pedidos up ';
        $q .= ' WHERE id_usuario= "'.$id_usuario.'" AND ';
        $q .= ' estado_pedido=2 AND fecha_lastmod_pedido<NOW() ';
        $q .= ' ORDER BY fecha_lastmod_pedido DESC LIMIT 0,1 ';
        return $this->execute_query($q);
    }

    function get_user_by_username($username) {
        $q  = ' SELECT u.* FROM '.$this->pre.'usuarios u ';
        $q .= ' WHERE u.nombre_usuario = "'.$username.'" AND u.deleted = 0 ';
        return $this->execute_query($q);
    }
    
    function get_destino_usuario($id_usuario) {
        $q  = ' SELECT * FROM '.$this->pre.'usuario_destinos d ';
        $q .= ' WHERE id_usuario='.$id_usuario;
        return $this->execute_query($q);
    }

    function get_user($id_usuario) {
        $q  = ' SELECT u.* FROM '.$this->pre.'usuarios u ';
        $q .= ' WHERE u.id_usuario = '.$id_usuario.' ';
        $q .= ' AND u.deleted = 0';
        return $this->execute_query($q);
    }

    function get_user_by_email($email) {
        $q  = ' SELECT count(*) AS total FROM '.$this->pre.'usuarios u ';
        $q .= ' WHERE u.email_usuario="'.$email.'"';
        $q .= ' AND u.deleted = 0';
        return $this->execute_query($q);
    }

    function get_user_login_facebook($nombre_usuario) {
        $q  = ' SELECT u.* FROM '.$this->pre.'usuarios u ';
        $q .= ' WHERE u.nombre_usuario = "'.$nombre_usuario.'" ';
        $q .= ' AND u.deleted = 0 ';
        return $this->execute_query($q);
    }
    
    function get_user_login($nombre_usuario, $contrasenya_usuario) {
        $q  = ' SELECT u.* FROM '.$this->pre.'usuarios u ';
        $q .= ' WHERE u.nombre_usuario = "'.$nombre_usuario.'" ';
        $q .= ' AND u.contrasenya_usuario = "'.$contrasenya_usuario.'" ';
        $q .= ' AND u.deleted = 0 ';
        return $this->execute_query($q);
    }
    
    function get_comision_total_vendido($id_usuario) {
        $q  = ' SELECT u.comision_total_vendido FROM '.$this->pre.'usuarios u ';
        $q .= ' WHERE u.id_usuario = '.$id_usuario.' ';
        
        $r = $this->execute_query($q);
        
        if ($r) {
            while ($f = $r->fetch_assoc()) {
                return $f['comision_total_vendido'];
            }
        } else return false;
    }

    function get_input_array($arr,$id, $selected=false, $class=false, $onChange=false) {
        $o  = '';
        $o .= '<div>';
        foreach ($arr as $key => $val) $o .= '<input type="radio" '.(($selected == $key) ? ' checked="checked" ' : '').' value="'.$key.'" name="'.$id.'[]">'.$val.'</option>';
        $o .= '</div>';
        return $o;
    }

    function get_existe_articulo($id_articulo) {
        $q  = ' SELECT * FROM '.$this->pre.'img_articulos';
        $q .= ' WHERE id_articulo = '.$id_articulo;
        $r = $this->execute_query($q);
        if ($r) return $r->num_rows;
            else return false;
    }

    function get_combo_array($arr, $id, $selected=false, $class=false, $onChange=false) {
        $o  = '';
        $o .= '<select id="'.$id.'" name="'.$id.'" class="form-control" ';
        if ($class) $o .= ' class ="'.$class.'" ';
        (!$onChange) ? $o .= '>' : $o .= 'onchange="this.form.submit()">';
        //$o .= '>';
        foreach ($arr as $key => $val) $o .= '<option '.(($selected == $key) ? ' selected="selected" ' : '').' value="'.$key.'">'.$val.'</option>';
        $o .= '</select>';
        return $o;
    }
    
    function get_combo_tipo_estilo($id, $selected=false, $class=false, $default=false) {
        $arr_estilos = array(
            'Holgada' => 'Holgada',
            'Recta' => 'Recta',
            'Entallada' => 'Entallada'
        );
        return $this->get_combo_array($arr_estilos, $id, $selected, $class, $default);
    }

    function get_combo_hijos($id, $selected=false, $class=false, $default=false){
        $arr_pregunta = array(
            'Si' => 'Si',
            'No' => 'No'
        );
        return $this->get_combo_array($arr_pregunta, $id, $selected, $class, $default);
    }

    function get_combo_textura_estilo($id, $selected=false, $class=false, $default=false) {
        $arr_estilos = array(
            'Estampados' => 'Estampados',
            'Colores lisos' => 'Colores lisos'
        );
        return $this->get_combo_array($arr_estilos, $id, $selected, $class, $default);
    }

    
    function get_combo_usuarios($id, $selected=false, $class=false, $onChange=false, $default=false, $filtro_tiendavf=false) {
        $o = ''; //output
        $q  = ' SELECT u.*, tvf.nombre_tiendavf FROM '.$this->pre.'usuarios u ';
        $q .= ' LEFT JOIN '.$this->pre.'tiendasvf tvf ON u.id_tiendavf = tvf.id_tiendavf ';
        $q .= ' WHERE u.id_tipo_usuario = '.$this->tipo_usuario.' ';
        if ($filtro_tiendavf > 0) $q .= ' AND u.id_tiendavf = '.$filtro_tiendavf.' ';
        $q .= ' AND u.deleted = 0 ';
        $q .= ' ORDER BY u.nombrecompleto_usuario ASC ';
        $r = $this->execute_query($q);
        if ($r) {
            $o .= '<select id="'.$id.'" name="'.$id.'" ';
            if ($class) $o .= ' class ="'.$class.'" ';
            if ($onChange) $o .= ' onchange="'.$onChange.'" ';
            $o .= '>';
            if ($default) $o .= '<option value="-1">-- Todos los usuarios --</option>';
            while($f = $r->fetch_assoc()) {
                $o .= '<option '.(($selected == $f['id_usuario']) ? ' selected="selected" ' : '').' value="'.$f['id_usuario'].'">'.
                    $f['nombrecompleto_usuario'].' ('.$f['nombre_tiendavf'].')'.
                    '</option>';
            }
            $o .= '</select>';
        } else return 'ERROR: '.$q;
        return $o;
    }

    function get_categorias(){
        $q = ' SELECT c.* FROM '.$this->pre.'categorias c';
        return $this->execute_query($q);
    }

    function get_sobremi_usuario($id_usuario){
        $q = ' SELECT us.* FROM '.$this->pre.'usuario_sobremi us WHERE id_usuario='.$id_usuario;
        return $this->execute_query($q);
    }

    function get_usuario_categorias($id_usuario){
        $q = ' SELECT uc.id_usuario, c.id_categoria, c.nombre_categoria, c.imagen_categoria FROM '.$this->pre.'usuario_categorias as uc ';
        $q .= 'RIGHT JOIN '.$this->pre.'categorias as c ';
        $q .= 'on uc.id_categoria=c.id_categoria WHERE uc.id_usuario is null or uc.id_usuario='.$id_usuario;
        return $this->execute_query($q);
    }

    function get_looks_usuario($tipo_look){//todo
        $q = ' SELECT sl.*,ul.id_usuario,ul.comentario FROM '.$this->pre.'looks as sl ';
        $q .= 'LEFT JOIN '.$this->pre.'usuario_looks as ul';
        $q .= ' on ul.id_look=sl.id_look WHERE tipo_look="'.$tipo_look.'" ORDER BY sl.id_look';
        return $this->execute_query($q);
    }

    function get_miarmario_usuario($id_usuario){
        $q = ' SELECT * FROM '.$this->pre.'usuario_miarmario WHERE id_usuario='.$id_usuario;
        return $this->execute_query($q);
    }

    function get_asesorame_usuario($id_usuario){
        $q = ' SELECT * FROM '.$this->pre.'usuario_asesorame WHERE id_usuario='.$id_usuario;
        return $this->execute_query($q);
    }

    function get_tallas_usuario($id_usuario){
        $q = ' SELECT * FROM '.$this->pre.'tallas WHERE id_usuario='.$id_usuario;
        return $this->execute_query($q);
    }
    
    function get_estilos_usuario($id_usuario){
        $q = ' SELECT * FROM '.$this->pre.'estilos WHERE id_usuario='.$id_usuario;
        return $this->execute_query($q);
    }
    
    function get_combo_tipos_usuario($id, $selected=false, $class=false, $onChange=false) {
        
        $o = ''; //output

        $arr_i = array($this->tipo_usuario => 'Comercial', $this->tipo_teamleader => 'Team Leader');
        
        $o .= '<select id="'.$id.'" name="'.$id.'" ';
        if ($class) $o .= ' class ="'.$class.'" ';
        if ($onChange) $o .= ' onchange="'.$onChange.'" ';
        $o .= '>';
        foreach ($arr_i as $key => $val) $o .= '<option '.(($selected == $key) ? ' selected="selected" ' : '').' value="'.$key.'">'.$val.'</option>';
        $o .= '</select>';

        return $o;
    }
    
    function get_lbl_tipo_usuario_by_id($id_tipo_usuario) {
        if (isset($this->lbl_tipos_usuario[$id_tipo_usuario])) return $this->lbl_tipos_usuario[$id_tipo_usuario];
            else return false;
    }

    function reset_user($id_usuario, $userpass, $randomkey){
        $q  = ' UPDATE '.$this->pre.'usuarios SET ';
        $q .=   ' contrasenya_usuario="'.$userpass.'", ';
        $q .=   ' randomkey="'.$randomkey.'" ';
        $q .= ' WHERE id_usuario="'.$id_usuario.'" ';
        return $this->execute_query($q);
    }

    function update_pscompleto($id_usuario, $valor){
        $q  = ' UPDATE '.$this->pre.'usuarios SET ';
        $q .=   ' ps_completo="'.$valor.'"';
        $q .= ' WHERE id_usuario="'.$id_usuario.'" ';
        return $this->execute_query($q);
    }
    
    function update_usuario($id_usuario, $nombre_usuario, $fecha_nacimiento, $nombrecompleto_usuario, $email_usuario, $contrasenya_usuario, $telf_usuario, $nie_usuario) {
        
        $q  = ' UPDATE '.$this->pre.'usuarios SET ';
        $q .=   ' nombre_usuario = "'.$nombre_usuario.'", ';
        $q .=   ' nombrecompleto_usuario = "'.$nombrecompleto_usuario.'", ';
        $q .=   ' fecha_nacimiento = "'.$fecha_nacimiento.'", ';
        $q .=   ' email_usuario = "'.$email_usuario.'", ';
        $q .=   ' contrasenya_usuario = "'.$contrasenya_usuario.'", ';
        $q .=   ' telf_usuario = "'.$telf_usuario.'", ';
        $q .=   ' nie_usuario = "'.$nie_usuario.'"';
        $q .= ' WHERE id_usuario='.$id_usuario.' ';
        return $this->execute_query($q);
    }

    //TODO
    function update_suscripcion($id_usuario, $tipo_suscripcion){
        $q  = ' UPDATE '.$this->pre.'usuarios SET ';
        $q .=   ' tipo_suscripcion = "'.$tipo_suscripcion.'"';
        $q .= ' WHERE id_usuario='.$id_usuario.' ';
        return $this->execute_query($q);
        //return $q;
    }
    
    function delete_usuario($id_usuario) {
        $q  = ' UPDATE '.$this->pre.'usuarios SET ';
        $q .=   ' deleted = 1 ';
        $q .= ' WHERE id_usuario='.$id_usuario.' ';
        return $this->execute_query($q);
    }

    function clear_categorias_usuario($id_usuario){
        $q  = ' DELETE FROM '.$this->pre.'usuario_categorias ';
        $q .= ' WHERE id_usuario='.$id_usuario.' ';
        return $this->execute_query($q);
    }

    function clear_categorias_miarmario($id_usuario){
        $q  = ' DELETE FROM '.$this->pre.'usuario_miarmario ';
        $q .= ' WHERE id_usuario='.$id_usuario.' ';
        return $this->execute_query($q);
    }

    function clear_destino_usuario($id_usuario){
        $q  = ' DELETE FROM '.$this->pre.'usuario_destinos ';
        $q .= ' WHERE id_usuario='.$id_usuario;
        return $this->execute_query($q);
    }

    function clear_looks_usuario($id_usuario){
        $q  = ' DELETE FROM '.$this->pre.'usuario_looks ';
        $q .= ' WHERE id_usuario='.$id_usuario.' ';
        return $this->execute_query($q);
    }

    function clear_tallas_usuario($id_usuario){
        $q  = ' DELETE FROM '.$this->pre.'tallas ';
        $q .= ' WHERE id_usuario='.$id_usuario.' ';
        return $this->execute_query($q);
    }

    function clear_imgs_articulo($id_articulo){
        $q  = ' DELETE FROM '.$this->pre.'img_articulos ';
        $q .= ' WHERE id_articulo='.$id_articulo.' ';
        return $this->execute_query($q);
    }

    function clear_imgs_usuario($id_usuario){
        $q  = ' DELETE FROM '.$this->pre.'usuario_imgs ';
        $q .= ' WHERE id_usuario='.$id_usuario.' ';
        return $this->execute_query($q);
    }

    function clear_estilos_usuario($id_usuario){
        $q  = ' DELETE FROM '.$this->pre.'estilos ';
        $q .= ' WHERE id_usuario='.$id_usuario.' ';
        return $this->execute_query($q);
    }

    function clear_sobremi_usuario($id_usuario){
        $q  = ' DELETE FROM '.$this->pre.'usuario_sobremi ';
        $q .= ' WHERE id_usuario='.$id_usuario.' ';
        return $this->execute_query($q);
    }

    function login_usuario_facebook($nombre_usuario) {
        $return = true;
        
        $r = $this->get_user_login_facebook($nombre_usuario); //verificar que el usuario existe en BD
        if ($r) { 
            $found = false;
            while ($f = $r->fetch_assoc()) {
                $found = true;
                $_SESSION['id_usuario'] = $f['id_usuario'];
                $_SESSION['nombre_usuario'] = $f['nombre_usuario'];
                $_SESSION['id_tipo_usuario'] = $f['id_tipo_usuario'];
                $_SESSION['nombrecompleto_usuario'] = $f['nombrecompleto_usuario'];
            }
            if (!$found) $return = '<div class="error_alert">Usuario no encontrado</div>';
        } else $return = '<div class="error_alert">Usuario no encontrado</div>';
        
        return $return;
    }
    
    function login_usuario($nombre_usuario, $contrasenya_usuario) {
        $return = true;
        
        $r = $this->get_user_login($nombre_usuario, $contrasenya_usuario); //verificar que el usuario existe en BD
        if ($r) { 
            $found = false;
            while ($f = $r->fetch_assoc()) {
                $found = true;
                $_SESSION['id_usuario'] = $f['id_usuario'];
                $_SESSION['nombre_usuario'] = $f['nombre_usuario'];
                $_SESSION['id_tipo_usuario'] = $f['id_tipo_usuario'];
                $_SESSION['nombrecompleto_usuario'] = $f['nombrecompleto_usuario'];
            }
            if (!$found) $return = '<div class="error_alert">Usuario no encontrado</div>';
        } else $return = '<div class="error_alert">Usuario no encontrado</div>';
        
        return $return;
    }
    
    function unlogin_usuario() {
        unset($_SESSION['id_usuario']);
        unset($_SESSION['nombre_usuario']);
        unset($_SESSION['id_tipo_usuario']);
        unset($_SESSION['nombrecompleto_usuario']);
    }
    
    //solo sirve para redirigir
    function control_sesion($ruta_inicio, $nivel, $redirect=true) {
        //si existe session, y el nivel de id_tipo_usuario menor o igual a nivel
        if (isset($_SESSION['id_tipo_usuario']) && $_SESSION['id_tipo_usuario'] <= $nivel) {
            // de momento no se da el caso
            return true;
        } else {
            if ($redirect == true) {
                header('Location: '.$ruta_inicio.'index.php');
                exit();
            }
            return false;
        }
    }

    function user_forgotpass_mail($fullname, $email, $userpass, $randomkey, $ruta_archivos) {
        $op = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml">
    <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    </head>
    <body>
    <div>
        <div>
            <h3>SESNINES</h3>
        </div>
        <div>Datos de acceso actualizados :</div>
        <div>Nombre completo: '.stripslashes($fullname).'</div>
        <div>Usuario: '.$email.'</div>
        <div>Password: '.$userpass.'</div>
        <div>Url de acceso: <a target="_blank" href="'.$ruta_archivos.'">'.$ruta_archivos.'</a></div>
    </div>
    </body>
    </html>';

        $asunto = 'SESNINES - Recuperar password';
        $mail_admin = 'sergio.vegas@adstormcommunication.com';

        $headers   = array();
        $headers[] = "MIME-Version: 1.0";
        $headers[] = "Content-type: text/html; charset=utf-8";
        //TODO
        $headers[] = "From: <no.reply@come-ink.com> SESNINES ";
        $headers[] = "Reply-To: <no.reply@come-ink.com> SESNINES ";
        $headers[] = "X-Mailer: PHP/" . phpversion();

        $cabeceras = implode("\r\n", $headers);

        $result_mail_send = TRUE;
        $result_mail_send = mail($email, $asunto, $op, $cabeceras); //produccion
        //$result_mail_send = getbagservice_mail($email, $asunto, $op, $headers);

        return $result_mail_send;
    }

}
?>