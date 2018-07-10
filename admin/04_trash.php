<?
$end = strtotime("tomorrow -1second");
$start = $end - 60 * 60 * 24 * 20 + 1;
$pagesInTrash = $pages->get('/trash/')->find("template=dj_profile,include=all, modified>".$start); 
$dj_fields = $templates_fields["dj_profile"];
?>
<div class="cont_orders">
	<separador><span>Eliminados en los últimos 20 días</span></separador>
	<div class="table_container">
		<div class="list_header">
			<?
			foreach ($dj_fields as $campo => $fieldtype) {
				if (
					$campo == "nombre" || 
					$campo == "apellido" || 
					$campo == "edad" || 
					$campo == "telefono" || 
					$campo == "location" || 
					$campo == "mixcloud" || 
					$campo == "venue"|| 
					$campo == "genero" || 
					$campo == "lineup" ||
					$campo == "profile_image" ||
					$campo == "gallery"
				) {
					continue;
				}
				if ($campo == "dj_name") {
					$campo = "DJ";
				}
				?>
					<div class="column dj_<?=$campo?>"><?=$campo?></div>
				<?
			}
			?>
			<div class="column dj_acciones">Acciones</div>
		</div>
		<div class="list_container trash_cont">
			<? 
			foreach ($pagesInTrash as $key => $dj) {
				?>
				<div class="list_element row" id="trash_<?=$dj->id?>">
				<?
				foreach ($dj_fields as $campo => $fieldtype) {
					if ($campo == "dj_name") {
						$campo = "DJ";
						?>
						<div class="column dj_<?=$campo?>">
							<div>
								<big><b><?=$dj->dj_name?></b></big>
								<br>[<?=$dj->nombre?> <?=$dj->apellido?>]</div>
						</div>
						<?
						continue;
					}
					if (
					$campo == "nombre" || 
					$campo == "apellido" || 
					$campo == "edad" || 
					$campo == "telefono" || 
					$campo == "location" || 
					$campo == "mixcloud" || 
					$campo == "venue"|| 
					$campo == "genero" || 
					$campo == "lineup" ||
					$campo == "profile_image" ||
					$campo == "gallery"
				) {
						continue;
					}
					?>
					<div class="column dj_<?=$campo?>">
						<div><?=$dj->$campo?></div>
					</div>
					<?
				}
				?>
				<div class="column dj_acciones">
							<div><button class="restaurar" data-id="<?=$dj->id?>">Restaurar</button><br><button class="perma_delete" data-id="<?=$dj->id?>">Eliminar permanentemente</button></div>
						</div>			
				</div>
				<?
			}
			?>
		</div>
	</div>
</div>