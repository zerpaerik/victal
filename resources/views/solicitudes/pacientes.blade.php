<div class="box-content" style="background: #D5CBC9;">
<div class="col-md-3">
	<strong>Nombres:</strong>{{$pacientes->nombres}}
</div>
<div class="col-md-3">
	<strong>Apellidos:</strong>{{$pacientes->apellidos}}
</div>
<div class="col-md-2">
	<strong>DNI:</strong>{{$pacientes->dni}}
</div>

<div class="col-md-2">
	<strong>Teléfono:</strong>{{$pacientes->telefono}}
</div>

<div class="col-md-2">
	<input type="hidden" name="id_paciente" value="{{$pacientes->id}}">
</div>
</div>
