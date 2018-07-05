<?php

class inputsModel {
    
    function safe_show($v) {
        return htmlspecialchars(stripslashes($v));
    }
    
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
        
        $aux_pattern = '';
        if ($allow_empty != false) $aux_pattern .= '.{0}|';
        $aux_pattern.= '.{';
        if ($min_length != false) $aux_pattern .= $min_length;
        $aux_pattern .= ',';
        if ($max_length != false) $aux_pattern .= $max_length;
        $aux_pattern .= '}';
        
        $o  = '<div class="form-group">';
        if (strlen($lbl) > 0) $o .= '<label>'.$lbl.'</label>';
        $o .=   '<input type="text" required id="'.$id.'" name="'.$id.'" value="'.$val.'" class="'.$class.'" placeholder="'.$placeholder.'" pattern="'.$aux_pattern.'" title="'.$err_desc.'">';
        $o .= '</div>';
            
        return $o;
    }
    
    function get_input_hidden($id, $val) {
        $val = $this->safe_show($val);
        
        $o  = '<input type="hidden" id="'.$id.'" name="'.$id.'" value="'.$val.'" />';
        
        return $o;
    }
    
}
