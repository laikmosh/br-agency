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
			for ($i=0; $i < 5; $i++) { ?>
			<div class="list_element row">
				<div class="column cliente">
					<div>Nombre <?=$i?></div>
					<div>Email <?=$i?></div>
					<div>Teléfono <?=$i?></div>
					<div>Orden enviada el: <?=$i?></div>
				</div>
				<div class="column evento">
					<div>Nombre del evento <?=$i?></div>
					<div>Fecha del evento <?=$i?></div>
					<div>Lugar del evento <?=$i?></div>
				</div>
				<div class="column lineup">
					<div>DJ1 <?=$i?></div>
					<div>DJ2 <?=$i?></div>
					<div>DJ3 <?=$i?></div>
				</div>
				<div class="column mensaje">
					<div>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</div>
				</div>
			</div>
			<? }; ?>
		</div>
	</div>
</div>