<?
$conexion = true;
$campos = $templates_fields["dj_profile"];
$id = $datos["id"];
$p = $pages->get($id);
$pages->trash($p);
$respuesta->status = $id." eliminado";
$dj = $p;
$dj_fields = $templates_fields["dj_profile"];
ob_start();
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
$resultado = ob_get_clean();
$respuesta->removed = $resultado;