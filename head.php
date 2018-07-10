<!doctype html>
<html class="html">
<head>
  <script type="text/javascript">
      var name_get = "";
  </script>
  <meta charset="UTF-8">
  <?  
  $dj_name_get = $input->urlSegment(1);
  $meta_title = "Agency - el bedroom";
  $meta_image ="http://www.elbedroom.mx/thumbs/home_thumb.png";
  $meta_description = "Agencia de DJs de el bedroom";
  $meta_locale ="es_ES";
  $meta_type ="website";
  $meta_url ="http://www.elbedroom.mx/agency";
  $meta_site_name ="Agency - el bedroom";

  if ($is_admin) { 
    $meta_title = "Agency Admin";
  } 

  if (strlen($dj_name_get) >= 4 && $is_admin != true) { 
    $dj = $pages->get("name%=$dj_name_get");
    $meta_title = $dj->dj_name.": ".$meta_title;
    $meta_image = $dj->profile_image->last()->url;
    $meta_description = $dj->bio;
    $meta_url = $meta_url."/".$dj_name_get;
    ?>
    <script type="text/javascript">
      var name_get = <?=$dj->id?>;
    </script>
    <?
  } 

  ?>
<title><?=$meta_title?></title>
<meta property="og:image" content="<?=$meta_image?>">
<meta property="og:title" content="<?=$meta_title?>">
<meta property="og:description" content="<?=$meta_description?>">
<meta property="og:locale" content="<?=$meta_locale?>">
<meta property="og:type" content="<?=$meta_type?>">
<meta property="og:url" content="<?=$meta_url?>">
<meta property="og:site_name" content="<?=$meta_site_name?>">
  <!-- <link href="/img/icons/favicon.ico" rel="shortcut icon"> -->
<!--   <link href="/img/icons/touch.png" rel="apple-touch-icon-precomposed"> -->
  <meta http-equiv="content-type" content="text/html; charset=utf-8" />
  <meta name="description" content="Área de administración de agencia">
  <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
  <?if ('LOCALHOST' ===  DEV_ENVIROMENT):echo '
  <script src="/agency/site/templates/js/jquery.js"></script>
  <link rel="stylesheet" type="text/css" href="/agency/site/templates/css/font-awesome.min.css">
  <script type="text/javascript">
    console.log("debug_env");
  </script>
  ';endif?>
  <?if ('BETA' ===  DEV_ENVIROMENT):echo '
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script type="text/javascript">
    console.log("beta_env");
  </script>
  ';endif?>
  <?if ('LIVE' ===  DEV_ENVIROMENT):echo '
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script type="text/javascript">
  </script>
  ';endif?>
  <link rel="stylesheet" type="text/css" href="<?=cacher('/agency/site/templates/css/general.css')?>">
  <script src="<?=cacher('/agency/site/templates/js/general.js')?>"></script>
  <!-- <script src="//widget.mixcloud.com/media/js/widgetApi.js" type="text/javascript"></script> -->
  </head>