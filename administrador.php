<?php
require_once("functions/functions.php"); 
$is_admin = true;
require_once("head.php");
require_once("admin/00_head.php");
login_check($user);
?>
<general>
<?
require_once("header.php");
require_once("admin/01_new_dj.php");
require_once("admin/03_djs.php");
require_once("admin/02_orders.php");
require_once("admin/04_trash.php");
require_once("footer.php");
?>
</general>
<div class="shadow hidden" id="shadow">
	<?
	require_once("admin/popups/01_add_dj.php");
	require_once("admin/popups/02_dj_page_edit.php");
	require_once("home/popups/lightbox.php");
	?>
</div>
