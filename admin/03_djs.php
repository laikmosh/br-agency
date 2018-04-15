<?
$djs = $pages->find("template=dj_profile,parent=djs");
?>
<div class="cont_djs">
	<separador><span>DJs</span></separador>
	<div class="grid_container">
		<?
			foreach ($djs as $key => $dj) {
				$grid_elem = grid_elem($dj,$is_admin);
				echo $grid_elem;
			}
		?>
		<strech-elem/>
	</div grid_container>
</div cont_djs>
<?


function grid_elem($dj,$is_admin) {
	$profile_img = $dj->profile_image->url.$dj->profile_image;
	$dj_name = $dj->dj_name;
	$nombre = $dj->nombre;
	$apellido = $dj->apellido;
	$location = $dj->location;
	$edad = $dj->edad;
	$bio = $dj->bio;
	$venue = $dj->venue;
	$genero = $dj->genero;
	$lineup = $dj->lineup;

	ob_start();
	?>
	<div class="grid_elem_info">
		<div class="grid_elem_info_fixed">
			<div class="elem_info_img" style="background-image: url(<?=$profile_img?>);"></div>
			<div class="bio">
				<h1><?=$nombre?> <?=$apellido?></h1>
				<h2>Bio.</h2>
				<p><?=$bio?></p>
			</div>
			<div class="barra_lateral">
				<?
				if ($location) {
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
					<?
				} else {
					?>
					<div class="cat_button"><button data-id="<?=$dj->id?>">Agregar a mi lista</button></div>
					<?
				}
				?>
			</div>
		</div>
	</div>
	<?
	$elem = ob_get_clean();
	ob_start();
	?>
		<div class="grid_elem">
			<?
			echo $elem;
			echo $elem;
			?>
			<div class="grid_elem_thumb" style="background-image: url(<?=$profile_img?>);">
				<div class="grid_elem_hover"></div>
				<div class="grid_elem_title">
					<span class="dj_thumb_tit"><?=$nombre?> <?=$apellido?></span>
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