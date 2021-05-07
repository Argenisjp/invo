{{ content() }}

<div class="col-md-12">
    <hr>
</div>

<ul class="pager">
    <li class="previous pull-left">
        {{ link_to("proveedores", "&larr; Regresar") }}
    </li>

</ul>

{% if dataproveedores is defined %}

<div  class="col-md-12">
    <form action="{{url('proveedores/save')}}" method="POST">        
        <input type="hidden" name="proveedorid" value="{{dataproveedores.proveedorid}}">
        <div class="col-md-8">

            <label for="">Nombres:</label>
            <input type="text" name="nombre" value="{{dataproveedores.nombre}}" required class="form-control">
        </div>

        <div class="col-md-8">
            <label for="">Apellidos:</label>
            <input type="text" name="apellido" value="{{dataproveedores.apellido}}" required class="form-control">            
        </div>   

        <div class="col-md-8">            
            <label for="">Tipo de documento:</label>                      
            <select name="tipodocumento" required id="tipodocumento" class="form-control">    
                <option value="">Seleccione...</option>                                 
                {% for item in tipodocumento %}
                    <option value="{{item.id}}">{{item.nombre}}</option>
                {% endfor %}                
            </select>
        </div>

        <div class="col-md-8">
            <label for="">Documento:</label>
            <input type="number" name="documento" value="{{dataproveedores.documento}}" required class="form-control" min="1">            
        </div> 

         

        <div class="col-md-8">            
            <label for="">Tipo de contrato:</label>                      
            <select name="tipocontrato" required id="tipocontrato" class="form-control">    
                <option disabled selected value="">Seleccione...</option>                                 
                {% for item in tipocontrato %}
                    <option value="{{item.id}}">{{item.nombre}}</option>
                {% endfor %}                
            </select>
        </div>
        <div class="col-md-8">            
            <label for="">Status:</label>                      
            <select name="status" required id="status" class="form-control">    
                <option disabled selected value="">Seleccione...</option>                                 
                <option value="1">Activo</option>                                 
                <option value="2">Inactivo</option>                                 
            </select>
        </div>

        
        
        <div class="col-md-8">
           <br>
           <button class="btn btn-success form-control "><i class=" glyphicon glyphicon-refresh "> </i>  ACTUALIZAR</button>
        </div>
    </form>    
</div>
{% else %}
<div  class="col-md-12">
    <label for=""> la data no existe </label>
</div>
{% endif %}
<div class="col-md-12">
    <hr>
</div>

 
{% if dataproveedores is defined %}
<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.1.min.js"></script>
	<script>
        var tipodocumento = '{{dataproveedores.tipodocumentoid}}';        
		$('#tipodocumento').val(tipodocumento);
     
        var tipocontrato = '{{dataproveedores.tipocontratoid}}';        
		$('#tipocontrato').val(tipocontrato);
      
        var status = '{{dataproveedores.status}}';        
		$('#status').val(status);
	</script>
{% endif %}

