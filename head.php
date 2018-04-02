<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Agency admin</title>
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
  </head>