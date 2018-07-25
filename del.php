<?php
    $json = json_encode("{status: success, data: null}");
    session_start();
    /* echo '<pre>';
    print_r($_SESSION);
    echo '</pre>'; */
    if(isset($_GET['del']) && isset($_GET['nombre_array'])){
        $fichero = $_GET['del'];
        $nombre_array = $_GET['nombre_array'];
        $ruta_fichero = 'imgaltaps/'.$fichero;
        if(file_exists($ruta_fichero)){
            for($i=0;$i<count($_SESSION[$nombre_array]);$i++){
                if($ruta_fichero==$_SESSION[$nombre_array][$i]){
                    unset($_SESSION[$nombre_array][$i]);
                    unlink($ruta_fichero);
                    echo $json;
                }
            }
        }
    }
?>