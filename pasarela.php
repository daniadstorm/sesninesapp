<?php
include_once('config/config.inc.php'); //cargando archivo de configuracion

$sumaTotal = $_REQUEST['sumaTotal'];
$id_pedido = $_REQUEST['id_pedido'];
$cargar = false;
if($sumaTotal>=0){
    $id_pedido = $rootM->zerofill($id_pedido, 8);
    include_once('lib/redsysHMAC256_API_PHP_5.2.0/apiRedsys.php');
    
    $apiRedsys = new RedsysAPI;
    $Ds_Merchant_MerchantCode = DS_MERCHANT_CODE;
    $Ds_Merchant_Terminal = DS_MERCHANT_TERMINAL;
    $Ds_Merchant_TransactionType = DS_AUTORIZACION;
    $Ds_Merchant_Amount = (float)$sumaTotal;
    $DS_Merchant_Currency = DS_EURO;
    $Ds_Merchant_Order = $id_pedido; //$id_pedido;
    $Ds_Merchant_MerchantURL = DS_MERCHANT_URL;
    $Ds_Merchant_MerchantURLOK = DS_MERCHANT_URL.'?factura='.$id_pedido.'&result=ok';
    $Ds_Merchant_MerchantURLKO = DS_MERCHANT_URL.'?factura='.$id_pedido.'&result=ko';
    $Ds_Merchant_MerchantName = DS_MERCHANT_NAME;
    
    $apiRedsys->setParameter('DS_MERCHANT_AMOUNT', $Ds_Merchant_Amount);
    $apiRedsys->setParameter('DS_MERCHANT_ORDER', strval($Ds_Merchant_Order));
    $apiRedsys->setParameter('DS_MERCHANT_MERCHANTCODE', $Ds_Merchant_MerchantCode);
    $apiRedsys->setParameter('DS_MERCHANT_CURRENCY', $DS_Merchant_Currency);
    $apiRedsys->setParameter('DS_MERCHANT_TRANSACTIONTYPE', $Ds_Merchant_TransactionType);
    $apiRedsys->setParameter('DS_MERCHANT_TERMINAL', $Ds_Merchant_Terminal);
    $apiRedsys->setParameter('DS_MERCHANT_MERCHANTURL', $Ds_Merchant_MerchantURL);
    $apiRedsys->setParameter('DS_MERCHANT_URLOK', $Ds_Merchant_MerchantURLOK);
    $apiRedsys->setParameter('DS_MERCHANT_URLKO', $Ds_Merchant_MerchantURLKO);
    $apiRedsys->setParameter('DS_MERCHANT_MERCHANTNAME', $Ds_Merchant_MerchantName);
    
    $Ds_version = DS_VERSION;
    $Ds_KEY = DS_MERCHANT_KEY;
    
    $Ds_params = $apiRedsys->createMerchantParameters();
    $Ds_signature = $apiRedsys->createMerchantSignature($Ds_KEY);
    $cargar = true;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <?php if($cargar){ ?>
        <form action="<?php echo URL_PASARELA; ?>" method="post" id="form_gateway" name="form_gateway">
            <input type="hidden" name="Ds_SignatureVersion" value="<?php echo $Ds_version; ?>" />
            <input type="hidden" name="Ds_MerchantParameters" value="<?php echo $Ds_params; ?>" />
            <input type="hidden" name="Ds_Signature" value="<?php echo $Ds_signature; ?>" />
            <input type="submit" class="btn_aceptar" value="Aceptar" />
        </form>
    <?php } ?>
</body>
</html>