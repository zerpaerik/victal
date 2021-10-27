<div class="row">
	<div class="col-xs-12">
		<div class="box">
			<div class="box-header">
				<div class="box-name">					
					<span>
                    <center> <strong>COBRO DE DEUDA</strong></center><br>
					</span>
				</div>
			</div>

            <form method="post" action="cobrar/procesar">					
              {{ csrf_field() }}                
                    <div class="card-body">
                    <div class="row">
                    <div class="col-md-3">
                    <label for="exampleInputEmail1">Total</label>
                    <input type="text" disabled class="form-control"  value="{{$cobrar->monto}}" name="cantidad" placeholder="cantidad">
                  </div>
                  <div class="col-md-3">
                    <label for="exampleInputEmail1">Restante</label>
                    <input type="text" disabled class="form-control"  value="{{$cobrar->resta}}" placeholder="cantidad">
                  </div>
                    <div class="col-md-3">
                    <label for="exampleInputEmail1">Pagar</label>
                    <input type="number" class="form-control"  name="pagar" placeholder="Pagar">
                  </div>
                  <div class="col-md-3">
                  <label>TipoPago</label>
                        <select class="form-control" name="tipopago">
                            <option value="EF">Efectivo</option>
                            <option value="TJ">Tarjeta</option>
                            <option value="DP">Depósito</option>
                            <option value="YP">Yape</option>
                        </select>
                  </div>
                  </div>
                  <br>
                </div>

                <input type="hidden" name="id" value="{{$cobrar->id}}">

                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Procesar</button>
                </div>
              </form>
				

               
               				
		</div>
	</div>
</div>