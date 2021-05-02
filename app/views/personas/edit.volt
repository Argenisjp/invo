{{ content() }}

<div class="col-md-12">
    <hr>
</div>

<ul class="pager">
    <li class="previous pull-left">
        {{ link_to("personas", "&larr; Regresar") }}
    </li>

</ul>

{% if datapersonas is defined %}

<div  class="col-md-12">
    <form action="{{url('personas/save')}}" method="POST">        
        <input type="hidden" name="personasid" value="{{datapersonas.personasid}}">
        <div class="col-md-8">

            <label for="">Nombres:</label>
            <input type="text" name="nombre" value="{{datapersonas.nombres}}" required class="form-control">
        </div>

        <div class="col-md-8">
            <label for="">Apellidos:</label>
            <input type="text" name="apellido" value="{{datapersonas.apellidos}}" required class="form-control">            
        </div>   
        
        <div class="col-md-8">
            <label for="">Fecha de nacimiento:</label>
            <input type="date" name="fechanacimiento" value="{{datapersonas.fechanacimiento}}" required class="form-control">            
        </div>   


        <div class="col-md-8">
            <label for="">Edad:</label>
            <input type="number" name="edad" value="{{datapersonas.edad}}" required class="form-control">            
        </div> 

        <div class="col-md-8">
            <label for="">salario:</label>
            <input type="number" name="salario" id="salario" required class="form-control">            
        </div> 
        
        </div>
        <div class="col-md-8">            
            <label for="">Status:</label>                      
            <select name="status" required id="status" class="form-control">    
                <option value="">Seleccione...</option>                                 
                <option value="1">Activo</option>                                 
                <option value="2">Inactivo</option>                                 
            </select>
        </div>
        
        <div class="col-md-8">
           <br>
           <button class="btn btn-success form-control "><i class=" glyphicon glyphicon-refresh "> Actualizar</i></button>
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

 
{% if datapersonas is defined %}
<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.1.min.js"></script>
	<script>
    /*     var tipodocumento = '{{dataproveedores.tipodocumentoid}}';        
		$('#tipodocumento').val(tipodocumento); */
     
       /*  var tipocontrato = '{{dataproveedores.tipocontratoid}}';        
		$('#tipocontrato').val(tipocontrato); */
      
        var status = '{{datapersonas.status}}';        
		$('#status').val(status);
       
       //funcion para redondiar un numero decimal con la funcion Math.round()
        var salario = '{{datapersonas.salario}}';        
		$('#salario').val(Math.round(salario));




	</script>
{% endif %}

