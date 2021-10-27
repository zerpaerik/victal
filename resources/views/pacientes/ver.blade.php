<div class="row">
	<div class="col-xs-12">
		<div class="box">
			<div class="box-header">
				<div class="box-name">					
					<span>
                    <center> <strong>DATOS DE PACIENTE</strong></center><br>
					</span>
				</div>
			</div>

              {{ csrf_field() }}                
                    <div class="card-body">
                    <div class="row">
                   
                  <div class="col-md-4">
                    <label for="exampleInputEmail1">Nombres</label>
                    <input type="text" disabled class="form-control"  value="{{$pacientes->nombres}}" placeholder="cantidad">
                  </div>
                    <div class="col-md-4">
                    <label for="exampleInputEmail1">Apellidos</label>
                    <input type="text" class="form-control" disabled  name="cant" value="{{$pacientes->apellidos}}">
                  </div>
                  <div class="col-md-4">
                    <label for="exampleInputEmail1">TipoDoc</label>
                    <input type="text" class="form-control" disabled  name="fecha" value="{{$pacientes->tipo_doc}}">
                  </div>
                
                  </div>
                  <div class="row">
                  <div class="col-md-4">
                    <label for="exampleInputEmail1">NumDoc</label>
                    <input type="text" class="form-control" disabled  name="fecha" value="{{$pacientes->dni}}">
                  </div>
                   
                   <div class="col-md-4">
                     <label for="exampleInputEmail1">Telf</label>
                     <input type="text" disabled class="form-control" disabled  value="{{$pacientes->telefono}}" placeholder="cantidad">
                   </div>
                     <div class="col-md-4">
                     <label for="exampleInputEmail1">Email</label>
                     <input type="text" class="form-control" disabled  name="cant" value="{{$pacientes->email}}">
                   </div>
                 
                   </div>
                   <div class="row">
                   <div class="col-md-4">
                     <label for="exampleInputEmail1">Ocupac.</label>
                     <input type="text" class="form-control" disabled  name="fecha" value="{{$pacientes->ocupacion}}">
                   </div>
                   <div class="col-md-4">
                     <label for="exampleInputEmail1">Sexo</label>
                     <input type="text" class="form-control" disabled  name="fecha" value="{{$pacientes->sexo}}">
                   </div>
                   
                   <div class="col-md-4">
                     <label for="exampleInputEmail1">Nac.</label>
                     <input type="text" disabled class="form-control" disabled value="{{$pacientes->fechanac}}" placeholder="cantidad">
                   </div>
                   
                  
                   </div>
                   <div class="row">
                  
                     <div class="col-md-4">
                     <label for="exampleInputEmail1">Edad</label>
                     <input type="text" class="form-control"  disabled name="cant" value="{{$edad}}">
                   </div>
                  
                   </div>
                  <br>
                </div>

			
		</div>
	</div>
</div>