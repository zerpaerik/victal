<div class="row">
	<div class="col-xs-12">
		<div class="box">
			<div class="box-header">
				<div class="box-name">					
					<span>
						<strong>Servicio:</strong> {{$servicio->nombre}}
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
                      <th>Subtitulo</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($templates_detalle as $hist)
                    <tr>
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
