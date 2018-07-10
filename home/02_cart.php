<div class="cart_cont">
<?
$djs = $pages->find("template=dj_profile,parent=djs");
	foreach ($djs as $key => $dj) {
		$profile_img_thumb = $dj->profile_image->last()->width(70)->url;
		?>
		<input type="checkbox" name="selected" id="selected_<?=$dj->id?>" value="<?=$dj->id?>">
		<div class="selected_dj" style="background-image: url('<?=$profile_img_thumb?>');">
			<label class="remove_cart" for="selected_<?=$dj->id?>"></label>
		</div>
		<?
	}
?>
<div class="book_button btn_popup" data-target="book">Continuar ></div>
</div>