<div class="popup book">
	<h1>Book DJs</h1>
<form id="book_djs" data-funcion="book_djs">
	<separador><span>DJs seleccionados</span></separador>
	<?
	$djs = $pages->find("template=dj_profile,parent=djs");
	foreach ($djs as $key => $dj) {
		$profile_img_thumb = $dj->profile_image->last()->width(220)->url;
		?>
		<input type="checkbox" name="reviewed[]" id="reviewed_<?=$dj->id?>" value="<?=$dj->id?>" hidden>
		<div class="dj_review" id="review_<?=$dj->id?>">
			<label class="remove_cart" for="selected_<?=$dj->id?>"></label>
			<div class="dj_review_thumb" style="background-image: url('<?=$profile_img_thumb?>');">
			</div>
			<span><?=$dj->dj_name?></span>
			<span><?=$dj->nombre?> <?=$dj->apellido?></span>
			<span><small>[<?=$dj->edad?> años]</small></span>
			<br>
			<span>Venue: <?=$dj->venue?></span>
			<span>Género: <?=$dj->genero?></span>
			<span>Lineup: <?=$dj->lineup?></span>
		</div>
		<?
	}
	?>
	<input type="text" class="nullify" id="cont_temp_id" name="temp_id" value="null" hidden/>
	<input type="text" class="nullify" name="editing_id" value="null" hidden/>
	<separador><span>Datos personales</span></separador>
	<span class="input_cont">
		<input type="text" name="nombre" required>
		<sticker>Nombre</sticker>
	</span>
	<span class="input_cont">
		<input type="text" name="apellido" required>
		<sticker>Apellido</sticker>
	</span>
	<span class="input_cont">
		<input type="email" name="email" required>
		<sticker>Email</sticker>
	</span>
	<span class="input_cont">
		<input type="text" name="telefono">
		<sticker>Teléfono</sticker>
	</span>
	<separador><span>Información de evento</span></separador>
	<span class="input_cont">
		<input type="text" name="evento">
		<sticker>Nombre del evento</sticker>
	</span>
	<span class="input_cont">
		<input type="text" name="fecha">
		<sticker>Fecha del evento</sticker>
	</span>
	<span class="input_cont">
		<input type="text" name="lugar">
		<sticker>Lugar del evento</sticker>
	</span>
	<span class="input_cont" style="margin-bottom: 35px;">
		<textarea name="mensaje"></textarea>
		<sticker>Mensaje</sticker>
	</span>
	<br>
	<span><b>Al bookear nos contactaremos contigo para confirmar precios y disponibilidad de los DJs seleccionados</b></span>
	<div class="form_footer">
		<button class="none" type="submit">Bookear DJs</button> 
	</div>
</form>
</div>