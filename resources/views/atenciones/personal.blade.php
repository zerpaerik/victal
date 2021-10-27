<div class="row">
                  <div class="col-md-12">
                  <label>Seleccionar Personal</label>
                  <select class="form-control"  data-placeholder="Seleccione" style="width: 100%;" name="origen_usuario">
                   @foreach($personal as $a)
                   <option value="{{$a->id}}">{{$a->lastname}} {{$a->name}}</option>
                    @endforeach
                  </select>
                  </div>
                  
                 
                  </div> 