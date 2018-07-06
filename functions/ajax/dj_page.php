<?
	$conexion = true;
	$id = $datos["id"];
	$dj = $pages->get($id);
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
			default:
			   $location = "N/A";
			   break;
		}
	}

	ob_start();
	?>
	<div class="profile_container">
		<div class="profile_img">
			<div class="profile_img_data">
				<?=$dj_name?>
				<br>
				Bedroom DJ
			</div>
			<img src="<?=$profile_img?>">
		</div>
		<div class="profile_info">
			<div class="info_elem">
				<h1><?=$dj_name?></h1>
			</div>
			<div class="info_elem">
				<h2>Bio.</h2>
				<?=$bio?>
			</div>
			<div class="info_elem">
				<h2>Mix.</h2>
				<?=$mixcloud?>
			</div>
			<div class="info_elem">
				<label>Ubicación</label><span><?=$location?></span><br>
				<label>Edad</label><span><?=$edad?></span><br>
				<label>Venue</label><span><?=$venue?></span><br>
				<label>Género</label><span><?=$genero?></span><br>
				<label>Line-up</label><span><?=$lineup?></span><br>
			</div>
			<div class="info_gallery">
			<?
			foreach ($dj->gallery as $key => $image) {
				?>
				<div class="gallery_thumb btn_popup" 
					data-target="lightbox"
					data-gallery="<?=$dj->id?>"
					data-key="<?=$key?>"
					>
						<img src="<?=$image->height(120)->url?>">
					</div>
				<?
			}
			?>
			</div>
		</div>
	</div>
<?
$respuesta["dj_page"] = ob_get_clean();
