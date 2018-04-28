<?
$site = "agency";
// agregar 2 lineas a config.php
// $config->sessionExpireSeconds = 864000;
// $config->sessionFingerprint = false;
ob_start()
?>
<!-- <link rel="stylesheet" type="text/css" href="<?=$config->urls->root?>login/login.css"> -->
<!-- <link rel="stylesheet" type="text/css" href="/login/login_custom.css"> -->
<link rel="stylesheet" type="text/css" href="<?=cacher('/agency/site/templates/login/login.css')?>">
<script src="<?=cacher('/agency/site/templates/login/login.js')?>"></script>
<div class="login_page">
   <form class="login_form" id="login_form" data-funcion="login">
      <span class="input_cont">
         <input type="text" name="email">
         <sticker>Email</sticker>
      </span>
      <span class="input_cont">
         <input type="password" name="password">
         <sticker>Contraseña</sticker>
      </span>
      <div class="form_footer_login">
         <button id="submit_login" class="none" type="submit">Login</button> 
      </div>
   </form>
</div>
<?
$GLOBALS["login"] = ob_get_clean();

function login_check($user) {
   if (!($user->isLoggedin())) {
      $respuesta->message = 'HTTP/1.1 500 No ha iniciado sesión o no tiene permisos';
      $respuesta->code = 0;
      $ajax = wire("config")->ajax;
      if ($ajax == true) {
         $respuesta->login_check = "unlogged";
         header('HTTP/1.1 500 No ha iniciado sesión o no tiene permisos');
         header('Content-Type: application/json; charset=UTF-8');
         die(json_encode($respuesta));
         exit();
      } else {
         echo $GLOBALS["login"];
         exit();
      }
   } else {
      // if ($user->tmp_pass != "0") {
      //    require_once("./change_pass.php");
      //    exit();
      // }
   }
}
?>