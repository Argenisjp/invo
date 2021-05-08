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
    <form action="{{url('proveedores/saveTransferencia')}}" method="POST">      
        
        <input type="hidden" name="proveedorid" value="{{dataproveedores.proveedorid}}">

        <div class="col-md-8">            
            <label for="">Proveedor de la Transferencia:</label>                      
            <select name="proveedorTranferencia" required id="proveedorTranferencia" class="form-control">    
                <option  disabled selected  value="">Seleccione...</option>                                 
                {% for item in dataproveedores %}
                    <option value="{{item.id}}">{{item.proveedores}}</option>
                {% endfor %}                
            </select>
        </div>
        <div class="col-md-8">
            <label for="">Valor a transferir:</label>
            <input type="number" name="saldo" required class="form-control">            
        </div>          

        <div class="col-md-8">            
            <label for="">Proveedor a Transferir:</label>                      
            <select name="proveedorTranferir" required id="proveedorTranferir" class="form-control">    
                <option  disabled selected  value="">Seleccione...</option>                                 
                {% for item in dataproveedores %}
                    <option value="{{item.id}}">{{item.proveedores}}</option>
                {% endfor %}                
            </select>
        </div>
    
        
        <div class="col-md-8">
           <br>
           <button class="btn btn-success form-control "><i class="glyphicon glyphicon-usd "></i> TRANSFERIR</button>
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
{% if dataproveedores is defined %}
	<script>

$("#proveedorTranferencia").on("change",function(){
        var valor = $(this).val();
        console.log(valor)
        $("#proveedorTranferir").find("option[value='"+valor+"']").prop("disabled",true);
    });
        
	</script>
{% endif %}




