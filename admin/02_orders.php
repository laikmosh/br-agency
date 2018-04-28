<div class="cont_orders">
	<separador><span>Bookings</span></separador>
	<div class="orders_list table_container">
		<div class="list_header">
			<div class="column cliente">Cliente</div>
			<div class="column evento">Evento</div>
			<div class="column lineup">Lineup</div>
			<div class="column mensaje">Mensaje</div>
		</div>
		<div class="list_container">
			<? 
			$orders = $pages->find("template=clientes,parent=clientes");
			foreach ($orders as $key => $order) {
			?>
			<div class="list_element row">
				<div class="column cliente">
					<div>Nombre: <?=$order->nombre?> <?=$order->apellido?></div>
					<div>Email: <?=$order->email?></div>
					<div>Teléfono: <?=$order->telefono?></div>
					<div>Orden enviada el: <?=date("F j, Y", $order->created);?></div>
				</div>
				<div class="column evento">
					<div>Nombre del evento: <?=$order->evento?></div>
					<div>Fecha del evento: <?=$order->fecha?></div>
					<div>Lugar del evento: <?=$order->lugar?></div>
				</div>
				<div class="column lineup">
					<?
					$ids = explode(":", $order->djs);
					foreach ($ids as $key => $id) {
						$dj = $pages->get($id);
						?>
						<div><?=$dj->dj_name?></div>
						<?
					}
					?>
				</div>
				<div class="column mensaje">
					<div><?=$order->mensaje?></div>
				</div>
			</div>
			<? }; ?>
		</div>
	</div>
</div>