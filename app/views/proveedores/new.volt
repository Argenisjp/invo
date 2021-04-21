{{ content() }}

<div class="col-md-12">
    <hr>
</div>

<div style="margin-left: 20%;" class="col-md-12">
    <form action="{{url('proveedores/create')}}" method="POST">        
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
            <select name="tipodocumento" required id="establecimiento" class="form-control chosen">    
                <option value="">Seleccione...</option>                                 
                {% for item in tipodocumento %}
                    <option value="{{item.id}}">{{item.nombre}}</option>
                {% endfor %}                
            </select>
        </div>       
      
        <div class="col-md-8">
            <label for="">Documento:</label>
            <input type="number" name="documento" required class="form-control">            
        </div>  
        <div class="col-md-8">
            <label for="">Fecha de afiliación:</label>
            <input type="date" name="fechaafiliacion" required class="form-control">            
        </div> 
        <div class="col-md-8">            
            <label for="">Tipo de contrato:</label>                      
            <select name="tipocontrato" required id="establecimiento" class="form-control chosen">    
                <option value="">Seleccione...</option>                                 
                {% for item in tipocontrato %}
                    <option value="{{item.id}}">{{item.nombre}}</option>
                {% endfor %}                
            </select>
        </div>   

        <div class="col-md-8">            
            <label for="">Status:</label>                      
            <select name="tipodocumento" required id="establecimiento" class="form-control chosen">    
                <option value="">Seleccione...</option>                                 
                {% for item in tipocontrato %}
                    <option value="{{item.id}}">{{item.nombre}}</option>
                {% endfor %}                
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