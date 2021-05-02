{{ content() }}

<div class="col-md-12">
    <hr>
</div>

<ul class="pager">
    <li class="previous pull-left">
        {{ link_to("clientes", "&larr; Regresar") }}
    </li>

</ul>

{% if dataclientes is defined %}

<div  class="col-md-12">
    <form action="{{url('clientes/save')}}" method="POST">        
        <input type="hidden" name="clienteid" value="{{dataclientes.clienteid}}">
        <div class="col-md-8">
            <label for="">Nombres:</label>
            <input type="text" name="nombre" value="{{dataclientes.nombre}}" required class="form-control">
        </div>

        <div class="col-md-8">
            <label for="">Apellidos:</label>
            <input type="text" name="apellido" value="{{dataclientes.apellido}}" required class="form-control">            
        </div>   

        <div class="col-md-8">
            <label for="">Celular:</label>
            <input type="number" name="celular"  value="{{dataclientes.celular}}"  required  class="form-control">            
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
            <input type="number" name="documento" value="{{dataclientes.documento}}" required class="form-control">            
        </div>  

        <div class="col-md-8">
            <label for="">Correo:</label>
            <input type="imail" name="correo" value="{{dataclientes.correo}}"  required class="form-control">            
        </div> 
      
        <div class="col-md-8">
            <label for="">Saldo:</label>
            <input type="number" name="saldo" id="saldo"  required class="form-control">            
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

<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.1.min.js"></script>
{% if dataclientes is defined %}
	<script>

         //funcion para redondiar un numero decimal con la funcion Math.round()
         var saldo = '{{dataclientes.saldo}}';        
		$('#saldo').val(Math.round(saldo));


        var tipodocumento = '{{dataclientes.tipodocumentoid}}';        
		$('#tipodocumento').val(tipodocumento);
	</script>
{% endif %}

