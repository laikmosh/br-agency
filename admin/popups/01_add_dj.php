<div class="popup add_dj">
	<h1>Agregar DJ</h1>
	<div>
		<separador><span>Presskit</span></separador>
	   <!-- tag para multi: multiple="multiple" agregar [] en name-->
	   <form id="images_profile">
	    	<input type="text" name="function" value="ajx_upload" hidden/>
	    	<input type="text" name="temp_id" value="null" hidden/>
		    <div class="foto_label input_cont" id="profile_image_uploader">
		    	<input class="input_image input_image_single" type="file" name="profile_image" id="profile_image" accept="image/jpg,image/jpeg,image/gif,image/png"/>
		    	<sticker>Foto de perfil</sticker>
		        <div class="foto_descr">
		            <div class="foto_descr_icono"><i class="fa fa-upload" aria-hidden="true"></i></div>
		            <div class="foto_descr_texto">Arrastra una foto de perfil aquí, o haz click para seleccionar un archivo.</div>
		        </div>
		        <img src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw=="/>
		        <div class="img_progress"></div>
		    </div>
		    <div class="foto_label gallery_label input_cont" id="gallery_image_uploader">
		    	<input class="input_image input_image_multi" type="file" name="gallery[]" id="gallery" accept="image/jpg,image/jpeg,image/gif,image/png" multiple="multiple" />
		    	<sticker>Presskit</sticker>
		        <div class="foto_descr foto_thumb">
		            <div class="foto_descr_icono"><i class="fa fa-upload" aria-hidden="true"></i></div>
		            <div class="foto_descr_texto">Arrastra una fotos del presskit, o haz click para seleccionar los archivos.</div>
		        </div>
		        <img src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw=="/>
		        <div class="img_progress"></div>
		    </div>
		</form>
	</div>
<form id="add_new_dj" data-funcion="add_new_dj">
	<input type="text" id="cont_temp_id" name="temp_id" value="null" hidden/>
	<separador><span>Datos personales</span></separador>
	<span class="input_cont input_cont_headline">
		<input type="text" name="dj_name" required>
		<sticker>DJ Name</sticker>
	</span>
	<span class="input_cont">
		<input type="text" name="nombre" required>
		<sticker>Nombre</sticker>
	</span>
	<span class="input_cont">
		<input type="text" name="apellido" required>
		<sticker>Apellido</sticker>
	</span>
	<span class="input_cont">
		<input type="text" name="edad">
		<sticker>Edad</sticker>
	</span>
	<span class="input_cont">
		<input type="email" name="email" required>
		<sticker>Email</sticker>
	</span>
	<span class="input_cont">
		<input type="text" name="telefono">
		<sticker>Teléfono</sticker>
	</span>
	<separador><span>Información de estilo</span></separador>
	<span class="tit_label">Venue</span>
	<div class="radios" id="cont_venue">
		<input type="radio" name="venue" value="empty" checked>
		<div class="radio">
			<input type="radio" name="venue" value="underground" id="tipo_underground">
		    <label for="tipo_underground">Underground</label>
	    </div>
	    <div class="radio">
		    <input type="radio" name="venue" value="festival" id="tipo_festival">
		    <label for="tipo_festival">Festival</label>
		</div>
	</div>
	<span class="tit_label">Género</span>
	<div class="radios" id="cont_genero">
		<input type="radio" name="genero" value="empty" checked>
		<div class="radio">
			<input class="generos generos_underground" type="radio" name="genero" value="techno" id="tipo_techno">
		    <label for="tipo_techno">Techno</label>
	    </div>
	    <div class="radio">
			<input class="generos generos_underground" type="radio" name="genero" value="house" id="tipo_house">
		    <label for="tipo_house">House</label>
	    </div>
	    <div class="radio">
			<input class="generos generos_underground" type="radio" name="genero" value="trance" id="tipo_trance">
		    <label for="tipo_trance">Trance</label>
	    </div>
	    <div class="radio">
			<input class="generos generos_underground" type="radio" name="genero" value="psy-trance" id="tipo_psy-trance">
		    <label for="tipo_psy-trance">Psy-trance</label>
	    </div>
	    <div class="radio">
			<input class="generos generos_underground" type="radio" name="genero" value="experimental" id="tipo_experimental">
		    <label for="tipo_experimental">Experimental</label>
	    </div>
	    <div class="radio">
			<input class="generos generos_festival" type="radio" name="genero" value="edm" id="tipo_edm">
		    <label for="tipo_edm">Edm</label>
	    </div>
	    <div class="radio">
			<input class="generos generos_festival" type="radio" name="genero" value="trap" id="tipo_trap">
		    <label for="tipo_trap">Trap</label>
	    </div>
	    <div class="radio">
			<input class="generos generos_festival" type="radio" name="genero" value="hardstyle" id="tipo_hardstyle">
		    <label for="tipo_hardstyle">Hardstyle</label>
	    </div>
	    <div class="radio">
			<input class="generos generos_festival" type="radio" name="genero" value="moombahton" id="tipo_moombahton">
		    <label for="tipo_moombahton">Moombahton</label>
	    </div>
	</div>
	<span class="tit_label">Lineup</span>
	<div class="radios" id="cont_lineup">
		<input type="radio" name="lineup" value="empty" checked>
		<div class="radio">
			<input type="radio" name="lineup" value="warmup" id="potencia_warmup">
		    <label for="potencia_warmup">Warmup</label>
	    </div>
	    <div class="radio">
		    <input type="radio" name="lineup" value="headliner" id="potencia_headliner">
		    <label for="potencia_headliner">Headliner</label>
		</div>
	</div>
	<div class="form_footer">
		<button class="none" type="submit">Agregar DJ</button> 
	</div>
</form>
</div>