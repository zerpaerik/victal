<div class="row">
                  <div class="col-md-12">
                  <label>Seleccionar Profesional</label>
                  <select class="form-control"  data-placeholder="Seleccione" style="width: 100%;" name="origen_usuario">
                   @foreach($profesionales as $a)
                   <option value="{{$a->id}}">{{$a->lastname}} {{$a->name}}</option>
                    @endforeach
                  </select>
                  </div>
                  
                 
                  </div> 