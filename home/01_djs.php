<?
$djs = $pages->find("template=dj_profile,parent=djs");
?>
<div class="cont_djs">
	<div class="filters_cont">
		<div class="filter_type">
			<span class="filter_tit">Ubicación</span>
			<line></line>
			<div class="filter_opts">
				<input type="radio" name="ubicacion" value="all" id="ubi_1" checked="true">			<label for="ubi_1">All</label>
				<input type="radio" name="ubicacion" value="cdmx" id="ubi_2">			<label for="ubi_2">Ciudad de México</label>
				<input type="radio" name="ubicacion" value="gdl" id="ubi_3">				<label for="ubi_3">Guadalajara</label>
				<input type="radio" name="ubicacion" value="cholula" id="ubi_4">					<label for="ubi_4">Cholula</label>
				<input type="radio" name="ubicacion" value="qro" id="ubi_5">					<label for="ubi_5">Querétaro</label>
			</div>
		</div>
		<div class="filter_type">
			<span class="filter_tit">Tipo de venue</span>
			<line></line>
			<div class="filter_opts">
				<input type="radio" name="venue" value="all" id="ven_1" checked="true">		<label for="ven_1">All</label>
				<input type="radio" name="venue" value="underground" id="ven_2">			<label for="ven_2">Underground</label>
				<input type="radio" name="venue" value="festival" id="ven_3">				<label for="ven_3">Festival</label>
			</div>
		</div>		
		<div class="filter_type">
			<span class="filter_tit">Género</span>
			<line></line>
			<div class="filter_opts">
				<input type="radio" name="genero" value="all" id="gen_1" checked="true">	<label for="gen_1">All</label>
				<input type="radio" name="genero" value="techno" id="gen_2">				<label class="fil_fil fil_ven fil_ven_underground" for="gen_2">Techno</label>
				<input type="radio" name="genero" value="house" id="gen_3">					<label class="fil_fil fil_ven fil_ven_underground" for="gen_3">House</label>
				<input type="radio" name="genero" value="experimental" id="gen_6">			<label class="fil_fil fil_ven fil_ven_underground" for="gen_6">Experimental/IDM</label>
				<input type="radio" name="genero" value="trance" id="gen_4">				<label class="fil_fil fil_ven fil_ven_festival" for="gen_4">Trance</label>
				<input type="radio" name="genero" value="psy-trance" id="gen_5">			<label class="fil_fil fil_ven fil_ven_festival" for="gen_5">Psy-trance</label>
				<input type="radio" name="genero" value="edm" id="gen_7">					<label class="fil_fil fil_ven fil_ven_festival" for="gen_7">Edm</label>
				<input type="radio" name="genero" value="trap" id="gen_8">					<label class="fil_fil fil_ven fil_ven_festival" for="gen_8">Trap</label>
				<input type="radio" name="genero" value="hardstyle" id="gen_9">				<label class="fil_fil fil_ven fil_ven_festival" for="gen_9">Hardstyle</label>
				<input type="radio" name="genero" value="moombahton" id="gen_10">			<label class="fil_fil fil_ven fil_ven_festival" for="gen_10">Moombahton</label>
				<input type="radio" name="genero" value="dubstep" id="gen_11">			<label class="fil_fil fil_ven fil_ven_festival" for="gen_11">Dubstep</label>
				<input type="radio" name="genero" value="reggaeton" id="gen_12">			<label class="fil_fil fil_ven fil_ven_festival" for="gen_12">Reggaeton</label>
				<input type="radio" name="genero" value="bass" id="gen_12">			<label class="fil_fil fil_ven fil_ven_festival" for="gen_12">Bass</label>
			</div>
		</div>
		<div class="filter_type">
			<span class="filter_tit">Lineup</span>
			<line></line>
			<div class="filter_opts">
				<input type="radio" value="all" name="lineup" id="lin_1" checked="true">	<label for="lin_1">All</label>
				<input type="radio" value="warmup" name="lineup" id="lin_2">				<label for="lin_2">Warmup</label>
				<input type="radio" value="headliner" name="lineup" id="lin_3">				<label for="lin_3">Headliner</label>
			</div>
		</div>	
	</div>
	<div class="grid_container grid_container_djs">
		<?
		foreach ($djs as $key => $dj) {
			$grid_elem = grid_elem($dj,$is_admin,$dj_name_get);
			echo $grid_elem;
		}
		?>
		<strech-elem></strech-elem>
		<strech-elem></strech-elem>
		<strech-elem></strech-elem>
		<strech-elem></strech-elem>
		<strech-elem></strech-elem>
	</div grid_container>
</div cont_djs>








