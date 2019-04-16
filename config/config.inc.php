<?php
/* RUTAS */
//-------------------------------------------------------------------------------------

$host  = $_SERVER['HTTP_HOST'];
$uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
$base = "http://" . $host . $uri . "/";
$ruta_inicio = 'http://localhost/sesninesapp/';
$ruta_archivos = 'http://localhost/sesninesapp/';
/* $ruta_inicio = 'http://192.168.1.2/sesninesapp/';
$ruta_archivos = 'http://192.168.1.2/sesninesapp/'; */
//$ruta_inicio = 'https://steampunkseo.es/sesninesapp/';
//$ruta_archivos = 'https://steampunkseo.es/sesninesapp/';
$document_root = $_SERVER['DOCUMENT_ROOT'].'/sesninesapp/';
//====================================================================================

//------------------------------------------------------------------------------
define('DS_VERSION', 'HMAC_SHA256_V1');
define('DS_MERCHANT_TERMINAL', '1');
define('DS_AUTORIZACION', '0');
define('DS_DEVOLUCION_AUTOMATICA', '3');
define('DS_MERCHANT_NAME', 'Sesnines');

define('DS_EURO', '978');
define('DS_DOLAR', '840');
define('DS_LIBRA', '826');
define('DS_MERCHANT_URL', $ruta_inicio.'validation.php');
define('ADSTORMLOG_URL', $document_root.'adstormlog/adstormlog.txt');
//PRUEBAS-----------------------------------------------------------------------
define('URL_PASARELA', 'https://sis-t.redsys.es:25443/sis/realizarPago'); //PRUEBAS
define('DS_MERCHANT_CODE', '336503693'); //PRUEBAS
define('DS_MERCHANT_KEY', 'sq7HjrUOBfKmC576ILgskD5srU870gJ7'); //PRUEBAS
//PRUEBAS-----------------------------------------------------------------------
//REAL--------------------------------------------------------------------------
//define('URL_PASARELA', 'https://sis.redsys.es/sis/realizarPago'); //REAL
//define('DS_MERCHANT_CODE', 'zvyy1IOfES3fVkE2FWL'); //REAL
//define('DS_MERCHANT_KEY', '5+7jlNmNeTOBpdTZaIGgg8Ni9r/UHyi1'); //REAL
//REAL--------------------------------------------------------------------------

/* CONSTANTES */
//-------------------------------------------------------------------------------------
define('DOCUMENT_ROOT', $document_root);
define('ADMIN', 1);
define('USER', 10);
define('REQ_FIELD', 'campo_requerido');
define('EMPTY_DATE', '1970-01-01');
//-------------------------------------------------------------------------------------

/* LIBRERIA DE FUNCIONES */
//-------------------------------------------------------------------------------------
include_once(DOCUMENT_ROOT.'func/func.inc.php');
//====================================================================================

/* LIBRERIA DE BD */
//-------------------------------------------------------------------------------------
include_once(DOCUMENT_ROOT.'model/model.class.php');
$rootM = new Model(); //rootModel; supervariable raiz de modelo
//====================================================================================

/* INICIO DE SESION */
//-------------------------------------------------------------------------------------
if(!isset($_SESSION)) session_start();
//====================================================================================

/* CONFIGURANDO LENGUAJE */
//-------------------------------------------------------------------------------------
//castellano asignado por defecto doblemente
//lang = el nombre del lenguaje
//lng = array de textos
if (isset($_POST['idioma_seleccionado'])) $_SESSION['lang'] = $_POST['idioma_seleccionado'];
$lang = isset($_SESSION['lang']) ? $_SESSION['lang'] : 'cast';
switch ($lang) {
    default:
    case 'cast':        include_once(DOCUMENT_ROOT.'lang/lang.cast.php');   break; //por defecto cast
    case 'eng':         include_once(DOCUMENT_ROOT.'lang/lang.eng.php');    break; 
    case 'cat':         include_once(DOCUMENT_ROOT.'lang/lang.cat.php');    break;
    case 'fra':         include_once(DOCUMENT_ROOT.'lang/lang.fra.php');    break;
}
//====================================================================================
?>