<?php

class inputsModel extends Model {
    
    /*
    https://stackoverflow.com/questions/10281962/is-there-a-minlength-validation-attribute-in-html5

    You can use the pattern attribute. The required attribute is also needed, otherwise an input field with an empty value will be excluded from constraint validation.

    <input pattern=".{3,}"   required title="3 characters minimum">
    <input pattern=".{5,10}" required title="5 to 10 characters">
    
    If you want to create the option to use the pattern for "empty, or minimum length", you could do the following:
    <input pattern=".{0}|.{5,10}" required title="Either 0 OR (5 to 10 chars)">
    <input pattern=".{0}|.{8,}"   required title="Either 0 OR (8 chars minimum)">
    */
    function get_input_text($id, $val, $class='', $lbl='', $placeholder='', $err_desc='', $min_length=false, $max_length=false, $allow_empty=false) {
        $val = $this->safe_show($val);
        
        $aux_required = 'required';
        
        $aux_pattern = '';
        if ($allow_empty != false) {
            $aux_pattern .= '.{0}|';
            $aux_required = '';
        }
        $aux_pattern.= '.{';
        if ($min_length != false) $aux_pattern .= $min_length;
        $aux_pattern .= ',';
        if ($max_length != false) $aux_pattern .= $max_length;
        $aux_pattern .= '}';
        
        $o  = '<div class="form-group">';
        if (strlen($lbl) > 0) $o .= '<label>'.$lbl.'</label>';
        $o .=   '<input type="text" '.$aux_required.' id="'.$id.'" name="'.$id.'" value="'.$val.'" class="'.$class.'" placeholder="'.$placeholder.'" pattern="'.$aux_pattern.'" title="'.$err_desc.'">';
        $o .= '</div>';
            
        return $o;
    }

    function get_input_textarea($id, $val, $class='', $lbl='', $placeholder='', $err_desc='', $min_length=false, $max_length=false, $allow_empty=false, $rows=3) {
        $val = $this->safe_show($val);
        
        $aux_required = 'required';
        $aux_min_length = '';
        $aux_max_lenght = '';
        
        if ($allow_empty != false) $aux_required = '';
        if ($min_length != false) $aux_min_length = 'minlength="'.$min_length.'"';
        if ($max_length != false) $aux_max_lenght = 'maxlength="'.$max_length.'"';
        
        $o  = '<div class="form-group">';
        if (strlen($lbl) > 0) $o .= '<label>'.$lbl.'</label>';
        $o .=   '<textarea '.$aux_required.' id="'.$id.'" name="'.$id.'" class="'.$class.'" placeholder="'.$placeholder.'" '.$aux_min_length.' '.$aux_max_lenght.' title="'.$err_desc.'" rows="'.$rows.'">';
        $o .=       $val;
        $o .=   '</textarea>';
        $o .= '</div>';
            
        return $o;
    }
    
    function get_input_number($id, $val, $class='', $lbl='', $placeholder='', $err_desc='', $min_length=false, $max_length=false, $step='int', $allow_empty=false) {
        $val = $this->safe_show($val);
        
        $aux_required = 'required';
        $aux_min_length = '';
        $aux_max_lenght = '';
        
        switch ($step) {
            default:
            case 'int':
                $aux_step = 'step="1"';
            break;
            case 'decimal':
                $aux_step = 'step=".1"';
            break;
            case 'price':
            case 'centesimal':
                $aux_step = 'step=".01"';
            break;
        }
        
        if ($allow_empty != false) $aux_required = '';
        if ($min_length != false) $aux_min_length = 'min="'.$min_length.'"';
        if ($max_length != false) $aux_max_lenght = 'max="'.$max_length.'"';
        
        $o  = '<div class="form-group">';
        if (strlen($lbl) > 0) $o .= '<label>'.$lbl.'</label>';
        $o .=   '<input type="number" '.$aux_required.' id="'.$id.'" name="'.$id.'" value="'.$val.'" class="'.$class.'" placeholder="'.$placeholder.'" '.
                    $aux_min_length.' '.$aux_max_lenght.' title="'.$err_desc.'" '.$aux_step.'>';
        $o .= '</div>';
            
        return $o;
    }
    
    function get_input_hidden($id, $val) {
        $val = $this->safe_show($val);
        
        $o  = '<input type="hidden" id="'.$id.'" name="'.$id.'" value="'.$val.'" />';
        
        return $o;
    }
    
    function get_input_radio($id, $val, $arr_opt, $class='', $lbl='', $allow_empty=false) {
        $val = $this->safe_show($val);
        
        $aux_required = ($allow_empty == false) ? 'required' : '';
        
        $o  = '<div class="form-group">';
        if (strlen($lbl) > 0) $o .= '<div><label>'.$lbl.'</label></div>';
        $o .=   '<div class="btn-group btn-group-toggle '.$class.'" data-toggle="buttons">';
        
        foreach ($arr_opt as $k => $v) {
            
            $aux_active = '';
            $aux_checked = '';
            
            if ($val == $k) {
                $aux_active = 'active';
                $aux_checked = 'checked';
            }
            
            $o .=       '<label class="btn btn-secondary '.$aux_active.'">';
            $o .=           '<input type="radio" name="'.$id.'" id="'.$id.$k.'" value="'.$k.'" autocomplete="off" '.$aux_checked.' '.$aux_required.'> '.$v;
            $o .=       '</label>';
        }
        
        $o .=   '</div>';
        $o .= '</div>';
        
        return $o;
    }
    
    function get_input_date($id, $val, $class='', $lbl='', $placeholder='', $err_desc='', $allow_empty=false) {
        $o = '<div class="form-group">
        <label>'.$lbl_campo.'</label>
        <input type="date" id="'.$id_campo.'" name="'.$id_campo.'" value="'.htmlspecialchars(stripslashes($value)).'" class="form-control" required>
        </div>';

        /* $o  = '<div class="'.$class.'">'; //output
        $o .=   $lbl_campo;
        $o .=   (isset($arr_err[$id_campo])) ? $arr_err[$id_campo] : '';
        $o .=   '<input type="text" '.$disabled.' id="'.$id_campo.'" name="'.$id_campo.'" value="'.htmlspecialchars(stripslashes($value)).'" />';
        $o .= '</div>'; */
        
        //$o .= 'dateFormat: \'dd-mm-yy\',';
        //$o .= 'changeYear: true';
        //$o .= '}+-7'
        //        . '.30'
        //        . ');</script>';
        /* $o .= '<script>';
        $o .= '$(\'#'.$id_campo.'\').datepicker(';
        $o .= ');';
        $o .= '</script>'; */
        return $o;
    }
    
    /*
    http://plugins.krajee.com/file-basic-usage-demo
    */
    function get_input_img($id, $val, $ruta_archivos, $class='', $lbl='') {
        
        if (strlen($val) > 0) {
            $aux_imagen_categoria_required = '';
            $aux_js_editar = 'initialPreview: [\''.$ruta_archivos.$val.'\'],initialPreviewAsData: true,';
        } else {
            $aux_imagen_categoria_required = 'required';
            $aux_js_editar = '';
        }
        
        $o  = '<div class="form-group">';
        $o .=   '<label>'.$lbl.'</label>';
        $o .=   '<div class="file-loading">';
        $o .=       '<input '.$aux_imagen_categoria_required.' id="'.$id.'" name="'.$id.'[]" type="file" multiple>';
        $o .=   '</div>';
        $o .= '</div>';
        
        $o .= '<script>';
        $o .=   '$(\'#'.$id.'\').fileinput({';
        $o .=       'theme: \'fa\',';
        $o .=       'language: \'es\',';
        $o .=       'showUpload: false,';
        $o .=       $aux_js_editar;
        $o .=       'allowedFileExtensions: [\'jpg\', \'png\', \'gif\']';
        $o .=   '});';
        $o .= '</script>';
        
        return $o;
    }
    
    function get_combo_array($id, $arr, $class='', $selected=false, $onChange=false) {
        $o  = '';
        $o .= '<select id="'.$id.'" name="'.$id.'" class="'.$class.'" ';
        (!$onChange) ? $o .= '>' : $o .= 'onchange="this.form.submit()">';
        foreach ($arr as $key => $val) $o .= '<option '.(($selected == $key) ? ' selected="selected" ' : '').' value="'.$key.'">'.$val.'</option>';
        $o .= '</select>';
        return $o;
    }
}
