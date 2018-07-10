<?

function grid_elem($dj,$is_admin,$dj_name_get) {
	$profile_img = $dj->profile_image->last()->url;
	$dj_name = $dj->dj_name;
	$nombre = $dj->nombre;
	$apellido = $dj->apellido;
	$location = $dj->location;
	$edad = $dj->edad;
	$bio = $dj->bio;
	$presskit = $dj->presskit;
	$mixcloud = $dj->mixcloud;
	$venue = $dj->venue;
	$genero = $dj->genero;
	$lineup = $dj->lineup;
	$lineup_array = explode(":", $lineup);

	if ($is_admin == false) {
		$dj_page = "dj_page";
		$dj_class = "btn_popup";
	} else {
		$dj_page = "dj_page_edit";
		$dj_class = "edit_dj";
	}
?>
		<div class="<?=$dj_class?> <?if (slugify($dj_name_get) == slugify($dj_name)) { echo "selected";}?> grid_elem fil_ubi fil_ubi_<?=$location?> fil_ven fil_ven_<?=$venue?> fil_gen fil_gen_<?=$genero?> fil_lin <?
		foreach ($lineup_array as $key => $value) {
			echo " fil_lin_".$value;
		}
		?>" id="dj_<?=$dj->id?>" data-dj_name="<?=slugify($dj->dj_name)?>" data-id="<?=$dj->id?>" data-target="<?=$dj_page?>"> 
			<div class="grid_elem_thumb" style="background-image: url(<?=$profile_img?>);">
				<div class="grid_elem_hover"></div>
				<div class="grid_elem_title">
					<span class="dj_thumb_tit"><?=$dj_name?></span>
					<line></line>
					<span><?=$venue?></span>
					<span><?=$genero?></span>
					<span><?=$lineup?></span>
				</div>
			</div>
		</div>
	<?
	return ob_get_clean();
}
?>
