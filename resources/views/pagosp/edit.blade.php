<div class="row">
	<div class="col-xs-12">
		<div class="box">
			<div class="box-header">
				<div class="box-name">					
					<span>
                    <center> <strong>EDICIÓN DE PAGO</strong></center><br>
                    <center>PERSONAL: {{$pagosp->lastname}} {{$pagosp->name}}</center>
					</span>
				</div>
			</div>

            <form method="post" action="pagosp/editar">					
              {{ csrf_field() }}                
                    <div class="card-body">
                    <div class="row">
                   
                  <div class="col-md-6">
                    <label for="exampleInputEmail1">Monto Actual</label>
                    <input type="text" disabled class="form-control"  value="{{$pagosp->monto}}" placeholder="cantidad">
                  </div>
                    <div class="col-md-6">
                    <label for="exampleInputEmail1">Monto a Actualizar</label>
                    <input type="number" class="form-control"  name="monto" placeholder="Monto a Actualizar">
                  </div>
                
                  </div>
                  <br>
                </div>

                <input type="hidden" name="id" value="{{$pagosp->id}}">


                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Procesar</button>
                </div>
              </form>
				

               
               				
		</div>
	</div>
</div>