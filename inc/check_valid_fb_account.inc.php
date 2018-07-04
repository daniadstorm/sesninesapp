<?php
include_once('../config/config.inc.php'); //cargando archivo de configuracion

$uM = load_model('usuario');

$first_name = '';
$last_name = '';
$email = '';

if(isset($_POST["first_name"]) && isset($_POST["last_name"]) && isset($_POST["email"])){
    $_SESSION["first_name"] = $_POST["first_name"];
    $_SESSION["last_name"] = $_POST["last_name"];
    $_SESSION["email"] = $_POST["email"];
}else if(isset($_SESSION["first_name"]) && isset($_SESSION["last_name"]) && isset($_SESSION["email"])){
    $first_name=$_SESSION["first_name"];
    $last_name=$_SESSION["last_name"];
    $email=$_SESSION["email"];
    if(strpos($email,"@")){
        $rgube = $uM->get_user_by_email($email);
        $r = $rgube->fetch_assoc();
        //($r["total"]) ? $verif=true : $verif=false;
        if($r["total"]){
            //existe cuenta, inicio.php
            $result_login = $uM->login_usuario_facebook($email);
            if (strlen($result_login) > 1) {
                $str_errores = $result_login;
            }
            header('Location: ../inicio.php');
        }else{
            //no existe cuenta new-account-fb.php
            header('Location: '.$ruta_inicio.'new-account-fb.php?first_name='.$first_name.'&last_name='.$last_name.'&email='.$email);
        }
    }else{
        //Se envia new-account.php mostrando error numero telefono
        header('Location: new-account.php');
    }
}



/*
if(isset($_GET["first_name"]) && isset($_GET["last_name"]) && isset($_GET["email"])){
    $first_name = $_GET["first_name"];
    $last_name = $_GET["last_name"];
    $email=$_GET["email"];
    if(strpos($email,"@")){
        $rgube = $uM->get_user_by_email($email);
        $r = $rgube->fetch_assoc();
        //($r["total"]) ? $verif=true : $verif=false;
        if($r["total"]){
            //existe cuenta, inicio.php
        }else{
            //no existe cuenta new-account-fb.php
            header('Location: '.$ruta_inicio.'new-account-fb.php?first_name='.$first_name.'&last_name='.$last_name.'&email='.$email);
        }
    }else{
        //Se envia new-account.php mostrando error numero telefono
        echo 'No contiene @';
    }
}else{
    echo 'Falta get';
}*/
?>