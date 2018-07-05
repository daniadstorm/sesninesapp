<?php
$title = 'SESNINES';
$meta_lang = $lang; //hacer switch con traduccion si necesario (o array)
$meta_desc = '';
$meta_kw = '';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html class="ag-toolbar" xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="Content-Language" content="<?php echo $meta_lang; ?>" />
<meta http-equiv="Cache-control" content="no-cache" />
<meta http-equiv="X-UA-Compatible" content="ie=edge">
    
<meta name="description" content="<?php echo $meta_desc; ?>" />
<meta name="keywords" content="<?php echo $meta_kw; ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
<link rel="shortcut icon" href="<?php echo $ruta_archivos; ?>img/favicon/favicon.ico" />

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous"/>

<link type="text/css" href="<?php echo $ruta_archivos; ?>css/fileinput.min.css" media="all" rel="stylesheet" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" media="all" rel="stylesheet" type="text/css"/>
<!--<link type="text/css" href="<?php echo $ruta_archivos; ?>scss/themes/fileinput.scss" media="all" rel="stylesheet" />-->
<link href="<?php echo $ruta_archivos; ?>themes/explorer-fa/theme.css" media="all" rel="stylesheet" type="text/css"/>

<!--<script src="<?php echo $ruta_archivos; ?>js/jquery.js"></script>-->
<!--<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>-->
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="<?php echo $ruta_archivos; ?>js/jquery-ui.min.js"></script>

<script type="text/javascript" src="<?php echo $ruta_archivos; ?>js/sesnines.js"></script>
<link type="text/css" href="<?php echo $ruta_archivos; ?>css/sesnines.css" rel="Stylesheet" />

<script src="<?php echo $ruta_archivos; ?>js/plugins/sortable.js" type="text/javascript"></script>
<script src="<?php echo $ruta_archivos; ?>js/fileinput.min.js" type="text/javascript"></script>
<script src="<?php echo $ruta_archivos; ?>js/locales/fr.js" type="text/javascript"></script>
<script src="<?php echo $ruta_archivos; ?>js/locales/es.js" type="text/javascript"></script>
<script src="<?php echo $ruta_archivos; ?>themes/explorer-fa/theme.js" type="text/javascript"></script>

<script src="<?php echo $ruta_archivos; ?>themes/fa/theme.js" type="text/javascript"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>

<title><?php echo $title; ?></title>

<script type="text/javascript">
  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "https://connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));
</script>

<script src="<?php echo $ruta_archivos; ?>js/facebook.js"></script>

</head>