<div class="row">
	<div class="col-xs-12">
		<div class="box">
			<div class="box-header">
				<div class="box-name">					
					<span>
                    <center> <strong>REGISTRO DE REEVALUACIÓN</strong></center><br>
					</span>
				</div>
			</div>

            <form method="post" action="historia/reevaluar">					
              {{ csrf_field() }}                
                    <div class="card-body">

                    <div class="row">
                     <div class="col-md">
                    <label for="exampleInputEmail1">Observaciones</label>
                    <textarea class="form-control" onkeyup="javascript:this.value=this.value.toUpperCase();" rows="3"  name="observacion" placeholder="Observaciones" required></textarea>
                  </div>
                    </div>
                 
                 
                 
                </div>

                <input type="hidden" name="id" value="{{$id}}">


                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Procesar</button>
                </div>
              </form>
				

               
               				
		</div>
	</div>
</div>