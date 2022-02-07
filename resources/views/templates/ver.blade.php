<div class="row">
	<div class="col-xs-12">
		<div class="box">
			<div class="box-header">
				<div class="box-name">					
					<span>
						<strong>Laboratorio:</strong> {{$analisis->nombre}}
					</span>
				</div>
			</div>
			<div class="box-content">

            </div>

              {{ csrf_field() }}                
                    <div class="card-body">
                    <div class="row">

                    <table class="table">
                  <thead>
                    <tr>
                      <th>Nombre</th>
                      <th>Medida</th>
                      <th>Referencia</th>
                      <th>Subtitulo</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($templates_detalle as $hist)
                    <tr>
                      <td>{{$hist->nombre}}</td>
                      <td>{{$hist->medida}}</td>
                      <td>{{$hist->referencia}}</td>
                      <td>{{$hist->subtitulo}}</td>

                    </tr>
                  @endforeach
                   
                  </tbody>
                </table>
                   
                 
                  
                  </div>
                  <br>
                </div>

			
			
				
			
			</div>
		</div>
	</div>
</div>
