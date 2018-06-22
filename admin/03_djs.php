<?
$djs = $pages->find("template=dj_profile,parent=djs");
?>
<div class="cont_djs">
		<div class="cont_new_dj">
		<div class="boton btn_popup" data-target="add_dj"><i class="fa fa-user-plus" aria-hidden="true"></i> Agregar DJ</div>
	</div>
	<separador><span>DJs</span></separador>
	<div class="grid_container grid_container_djs">
		<?
			$dj_name_get = $input->urlSegment(1);
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