{{ content() }}

<div class="col-md-12">
    <hr>
</div>

<div style="margin-left: 20%;" class="col-md-12">
    <form action="{{url('clientes/create')}}" method="POST">        
        <div class="col-md-8">
            <label for="">Nombres:</label>
            <input type="text" name="nombre" required class="form-control">
        </div>
        <div class="col-md-8">
            <label for="">Apellidos:</label>
            <input type="text" name="apellido" required class="form-control">            
        </div>         
        <div class="col-md-8">
            <label for="">Celular:</label>
            <input type="number" name="celular" required  class="form-control">            
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
            <label for="">Correo:</label>
            <input type="imail" name="correo" required class="form-control">            
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