<div class="row">
	<div class="col-xs-12">
		<div class="box">
			<div class="box-header">
				<div class="box-name">					
					<span>
                    <center> <strong>DATOS DE PERSONAL</strong></center><br>
					</span>
				</div>
			</div>

              {{ csrf_field() }}                
                    <div class="card-body">
                    <div class="row">
                   
                  <div class="col-md-4">
                    <label for="exampleInputEmail1">Nombres</label>
                    <input type="text" disabled class="form-control"  value="{{$users->name}}" placeholder="cantidad">
                  </div>
                    <div class="col-md-4">
                    <label for="exampleInputEmail1">Apellidos</label>
                    <input type="text" class="form-control" disabled  name="cant" value="{{$users->lastname}}">
                  </div>
                  <div class="col-md-4">
                    <label for="exampleInputEmail1">DNi</label>
                    <input type="text" class="form-control" disabled  name="fecha" value="{{$users->dni}}">
                  </div>
                
                  </div>
                  <div class="row">
                  <div class="col-md-4">
                    <label for="exampleInputEmail1">Direccion</label>
                    <input type="text" class="form-control" disabled  name="fecha" value="{{$users->direccion}}">
                  </div>
                   
                   <div class="col-md-4">
                     <label for="exampleInputEmail1">Telf</label>
                     <input type="text" disabled class="form-control" disabled  value="{{$users->telefono}}" placeholder="cantidad">
                   </div>
                     <div class="col-md-4">
                     <label for="exampleInputEmail1">Email</label>
                     <input type="text" class="form-control" disabled  name="cant" value="{{$users->email}}">
                   </div>
                 
                   </div>
                   <div class="row">
                   <div class="col-md-4">
                     <label for="exampleInputEmail1">Cargo.</label>
                     <input type="text" class="form-control" disabled  name="fecha" value="{{$users->cargo}}">
                   </div>
    
                  
                   </div>
                  
                  <br>
                </div>

			
		</div>
	</div>
</div>