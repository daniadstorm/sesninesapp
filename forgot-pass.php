<?php
include_once('config/config.inc.php'); //cargando archivo de configuracion

$forgot_pass_username = '';

if (isset($_POST['forgot_pass_username'])) { //si viene de submit de login
    $uM = load_model('usuario'); //uM userModel
    
    $forgot_pass_username = $_POST['forgot_pass_username'];
    
    $rrp = $uM->get_user_by_username($forgot_pass_username);
    $found = false;
    if ($rrp) { 
        while ($frp = $rrp->fetch_assoc()){
            $found = true;
            $id_usuario = $frp['id_usuario'];
            $nombrecompleto_usuario = $frp['nombrecompleto_usuario'];
        }
        
        if ($found) {
            $userpass = generate_password(6); //generar password aleatorio
            $randomkey = generate_password(12);
            
            $rru = $uM->reset_user($id_usuario, $userpass, $randomkey);
            if ($rru) {
                if ($uM->user_forgotpass_mail($nombrecompleto_usuario, $forgot_pass_username, $userpass, $randomkey, $ruta_archivos)) { //enviar correo
                    header('Location: '.$ruta_inicio.'index.php?userreset=true'); //enviar a la pantalla de inicio para que informe de success
                    exit();
                } else { $str_errores = '<div class="error_alert">Error enviando email de validación</div>'; } //else "por favor intentelo de nuevo"//enviar correo (if)
            } else $str_errores = '<div class="error_alert">'.BD_ERR_MSG.'</div>';
        } else $str_errores = '<div class="error_alert">Usuario no encontrado</div>';
    } else $str_errores = '<div class="error_alert">'.BD_ERR_MSG.'</div>';
}

include_once('inc/cabecera.inc.php'); //cargando cabecera
?>
    <script type="text/javascript">

    </script>

    <body>
        <div id="main_container">
            <?php include_once('inc/franja_top.inc.php'); ?>
            <?php //include_once('inc/main_menu.inc.php'); ?>
            <section class="section_top">
                <div class="menu_top">
                    <h1 class="form-title-page">RECUPERAR CONTRASEÑA</h1>
                    <div style="clear:both;"></div>
                </div>
            </section>

            <section class="sep_section"></section>
            <section class="middle_section">
                <div class="responsive_seccion">
                    <div id="filtros_seccion">
                        <?php if (isset($str_info)) echo $str_info; ?>
                        <?php if (isset($str_errores)) echo $str_errores; ?>
                    </div>
                    <div class="form">
                        <form action="forgot-pass.php" method="post" id="form_login" name="form_login">
                            <?php if (isset($str_errores)) echo $str_errores; ?>
                            <div class="campo">
                                <?php if (isset($arr_err['username'])) echo $arr_err['username']; ?>
                                <input placeholder="Correo electronico" type="text" id="forgot_pass_username" name="forgot_pass_username" value="<?php echo htmlspecialchars($forgot_pass_username); ?>" />
                            </div>
                            <div class="campo">
                                <div style="float:right;">
                                    <input type="submit" class="btn_aceptar bg_salmon tipogr_blanca" value="ACEPTAR" />
                                </div>
                                <div style="clear:both;"></div>
                            </div>
                        </form>
                    </div>
                </div>
            </section>
        </div>
        <?php //include_once('inc/footer.inc.php'); ?>
    </body>

    </html>