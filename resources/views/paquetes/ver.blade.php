<div class="row">
	<div class="col-xs-12">
		<div class="box">
			<div class="box-header">
				<div class="box-name">					
					<span>
						<strong>Paquete:</strong> {{$paquete->nombre}}
					</span>
				</div>
			</div>
			<div class="box-content">
				<div class="row">
					<div class="col-sm-6">
						<strong>Precio:</strong> {{$paquete->precio}}
					</div>
					<div class="col-sm-6">
						<strong>Porcentaje:</strong> {{$paquete->porcentaje}}
					</div>
				</div>			
					
				@if(count($servicios) > 0)
					<div class="row">
						<div class="col-sm-12" style="padding: 5px 0 5px 15px; margin: 5px 0; background: #f5f5f5;">
							<strong>Servicios seleccionados</strong>
						</div>
						@foreach($servicios as $servicio)
							<div class="col-sm-12">
							 {{$servicio->nombre}}
							</div>
						@endforeach

					</div>
				@endif
				
				@if(count($laboratorios) > 0)
					<div class="row">
						<div class="col-sm-12" style="padding: 5px 0 5px 15px; margin: 5px 0; background: #f5f5f5;">
							<strong>Laboratorios seleccionados</strong>
						</div>
						@foreach($laboratorios as $laboratorio)
							<div class="col-sm-12">
							{{$laboratorio->nombre}}
							</div>
						@endforeach

					</div>
				@endif

					@if(count($consultas) > 0)
					<div class="row">
						<div class="col-sm-12" style="padding: 5px 0 5px 15px; margin: 5px 0; background: #f5f5f5;">
							<strong>Cantidad de Consultas</strong>
						</div>
								@foreach($consultas as $cn)

							<div class="col-sm-12">
								{{$cn->cantidad}}
							</div>

							@endforeach

					</div>
				@endif

					@if(count($controles) > 0)
					<div class="row">
						<div class="col-sm-12" style="padding: 5px 0 5px 15px; margin: 5px 0; background: #f5f5f5;">
							<strong>Cantidad de Controles</strong>
						</div>
								@foreach($controles as $cn)

							<div class="col-sm-12">
								{{$cn->cantidad}}
							</div>

							@endforeach

					</div>
				@endif

			</div>
		</div>
	</div>
</div>
