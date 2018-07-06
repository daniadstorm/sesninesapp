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

    function get_combo_array($id, $arr, $class='', $selected=false, $onChange=false) {
        $o  = '';
        $o .= '<select id="'.$id.'" name="'.$id.'" class="'.$class.'" ';
        (!$onChange) ? $o .= '>' : $o .= 'onchange="this.form.submit()">';
        foreach ($arr as $key => $val) $o .= '<option '.(($selected == $key) ? ' selected="selected" ' : '').' value="'.$key.'">'.$val.'</option>';
        $o .= '</select>';
        return $o;
    }
    
    function get_input_hidden($id, $val) {
        $val = $this->safe_show($val);
        
        $o  = '<input type="hidden" id="'.$id.'" name="'.$id.'" value="'.$val.'" />';
        
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
}
