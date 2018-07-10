<?php
require_once("functions/functions.php"); 
$is_admin = false;
require_once("head.php");
require_once("home/00_head.php");
?>
<general>
<?
require_once("header.php");
require_once("home/01_djs.php");
require_once("footer.php");
?>
</general>
<div class="shadow hidden" id="shadow">
	<?
	require_once("home/popups/01_book.php");
	require_once("home/popups/02_dj_page.php");
	require_once("home/popups/lightbox.php");
	?>
</div>
<?
require_once("home/02_cart.php");
?>