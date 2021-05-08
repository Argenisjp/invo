{{ content() }}

<div class="col-md-12">
    <hr>
</div>

<ul class="pager">
    <li class="previous pull-left">
        {{ link_to("proveedores", "&larr; Regresar") }}
    </li>
  <!--   <li class="pull-right">
        {{ submit_button("Guardar", "class": "btn btn-success") }}
    </li> -->
</ul>

<div  class="col-md-12">
    <form action="{{url('proveedores/create')}}" method="POST">        
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
            <label for="">Tipo de documento:</label>                      
            <select name="tipodocumentoid" required id="establecimiento" class="form-control chosen">    
                <option value="">Seleccione...</option>                                 
                {% for item in tipodocumento %}
                    <option value="{{item.id}}">{{item.nombre}}</option>
                {% endfor %}                
            </select>
        </div>       
      
        <div class="col-md-8">
            <label for="">Documento:</label>
            <input type="number" name="documento" required class="form-control" min="1">            
        </div>  
 
        <div class="col-md-8">            
            <label for="">Tipo de contrato:</label>                      
            <select name="tipocontratoid" required id="tipocontrato" class="form-control chosen">    
                <option value="">Seleccione...</option>                                 
                {% for item in tipocontrato %}
                    <option value="{{item.id}}">{{item.nombre}}</option>
                {% endfor %}                
            </select>
        </div> 
        
        <div class="col-md-8">
            <label for="">Saldo:</label>
            <input type="number" name="saldo" required class="form-control" min="1">            
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