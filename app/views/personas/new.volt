{{ content() }}

<div class="col-md-12">
    <hr>
</div>

<ul class="pager">
    <li class="previous pull-left">
        {{ link_to("personas", "&larr; Regresar") }}
    </li>
  <!--   <li class="pull-right">
        {{ submit_button("Guardar", "class": "btn btn-success") }}
    </li> -->
</ul>

<div  class="col-md-12">
    <form action="{{url('personas/create')}}" method="POST">        
        <div class="col-md-8">
            <input type="hidden" name="proveedorid" required class="form-control">
        </div>
        <div class="col-md-8">
            <label for="">Nombres:</label>
            <input type="text" name="nombre" required class="form-control">
        </div>

        <div class="col-md-8">
            <label for="">Apellidos:</label>
            <input type="text" name="apellido" required class="form-control">            
        </div>  

        <div class="col-md-8">
            <label for="">Fecha de nacimiento:</label>
            <input type="date" name="fechanacimiento" required class="form-control">            
        </div>  
      
        <div class="col-md-8">
            <label for="">Edad:</label>
            <input type="number" name="edad" required class="form-control">            
        </div>  
       
        <div class="col-md-8">
            <label for="">Salario:</label>
            <input type="number" name="salario" required class="form-control">            
        </div>  

        <div class="col-md-8">            
            <label for="">Status:</label>                      
            <select name="status" required id="status" class="form-control chosen">    
                <option value="">Seleccione...</option>                                 
                
                    <option value="1">Activo</option>
                    <option value="2">Inactivo</option>
                                
            </select>
        </div>   
        
        <div class="col-md-8">
           <br>
            <button class="btn btn-success form-control ">Guardar</button>
        </div>
    </form>    
</div>

<div class="col-md-12">
    <hr>
</div>