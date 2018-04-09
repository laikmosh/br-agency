<?
$dj_fields = $templates_fields["dj_profile"];
?>
<div class="cont_orders">
	<separador><span>DJs</span></separador>
	<div class="djs_list table_container">
		<div class="list_header">
			<?
			foreach ($dj_fields as $campo => $fieldtype) {
				if ($campo == "nombre" || $campo == "apellido" || $campo == "edad") {
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
		</div>
		<div class="list_container">
			<? 
			foreach ($djs as $key => $dj) {
				?>
				<div class="list_element row">
				<?
				foreach ($dj_fields as $campo => $fieldtype) {
					if ($campo == "dj_name") {
						$campo = "DJ";
						?>
						<div class="column dj_<?=$campo?>">
							<div><?=$dj->dj_name?> [<?=$dj->nombre?> <?=$dj->apellido?>](<?=$dj->edad?> años)</div>
						</div>
						<?
						continue;
					}
					if ($campo == "nombre" || $campo == "apellido" || $campo == "edad") {
						continue;
					}
					?>
					<div class="column dj_<?=$campo?>">
						<div><?=$dj->$campo?></div>
					</div>
					<?
				}
				?>			
				</div>
				<?
			}
			?>
		</div>
	</div>
</div>