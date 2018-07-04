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
	ob_start();
	?>
	<div class="grid_elem_info">
		<div class="grid_elem_info_fixed">
			<div class="elem_info_img" style="background-image: url(<?=$profile_img?>);">
			<div class="gallery_thumbs_cont">
				<?
				foreach ($dj->gallery as $key => $image) {
					?>
					<div style="background-image: url('<?=$image->width(70)->url?>')" class="gallery_thumb btn_popup" 
						data-target="lightbox"
						data-gallery="<?=$dj->id?>"
						data-key="<?=$key?>"
						></div>
					<?
				}
				?>
			</div>
			</div>
			<div class="bio">
				<h1><?=$dj_name?></h1>
				<h3>[<?=$nombre?> <?=$apellido?>]</h3>
				<h2>Bio.</h2>
				<p><?=$bio?></p>
				<?
				if ($presskit) {
					?>
						<br>
						Presskit:<br>
						<a href="<?=$dj->presskit->url?>" target="_blank"><i class="presskit_display fa fa-file-pdf-o" aria-hidden="true">&nbsp;<?=$presskit?></i></a>
					<?
				}
				?>
			</div>
			<div class="barra_lateral">
				<?
				if ($location) {
					switch ($location) {
						case 'cdmx':
							$location = "Ciudad de México";
							break;
						case 'qro':
							$location = "Querétaro";
							break;
						case 'cholula':
							$location = "Cholula";
							break;
						case 'gdl':
							$location = "Guadalajara";
							break;
					}
					?>
					<div><span class="cat">Ubicación:</span><span class="cat_val"><?=$location?></span></div>
					<?
				}
				?>
				<?
				if ($edad) {
					?>
					<div><span class="cat">Edad:</span><span class="cat_val"><?=$edad?></span></div>
					<?
				}
				?>
				<div><span class="cat">Venue:</span><span class="cat_val"><?=$venue?></span></div>
				<div><span class="cat">Género:</span><span class="cat_val"><?=$genero?></span></div>
				<div><span class="cat">Lineup:</span><span class="cat_val"><?=$lineup?></span></div>
				<?
				if ($is_admin == true) {
					?>
					<div class="cat_button"><button class="edit_dj" data-id="<?=$dj->id?>">Editar</button></div>
					<div class="cat_button"><button class="remove_dj" data-id="<?=$dj->id?>">Eliminar</button></div>
					<?
				} else {
					?>
					<div class="cat_button"><label for="selected_<?=$dj->id?>">Agregar a mi lista</label></div>
					<?
				}
				?>
			</div>
			<div class="mixcloud"><?=$mixcloud?></div>
		</div>
	</div>
	<?
	$sel;
	$elem = ob_get_clean();
	ob_start();
	?>
		<div class="<?if (slugify($dj_name_get) == slugify($dj_name)) { echo "selected";}?> grid_elem fil_ubi fil_ubi_<?=$location?> fil_ven fil_ven_<?=$venue?> fil_gen fil_gen_<?=$genero?> fil_lin <?
		foreach ($lineup_array as $key => $value) {
			echo " fil_lin_".$value;
		}
		?>
		?>" id="dj_<?=$dj->id?>" data-dj_name="<?=slugify($dj->dj_name)?>"> 
			<?
			echo $elem;
			echo $elem;
			?>
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
