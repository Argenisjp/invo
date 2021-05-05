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
    <form action="{{url('clientes/saveTransferencia')}}" method="POST">      
        
        <input type="hidden" name="clienteid" value="{{dataclientes.clienteid}}">

        <div class="col-md-8">            
            <label for="">Cliente de la Transferencia:</label>                      
            <select name="clienteTranferencia" required id="clienteTranferencia" class="form-control">    
                <option  disabled selected  value="">Seleccione...</option>                                 
                {% for item in dataclientes %}
                    <option value="{{item.id}}">{{item.cliente}}</option>
                {% endfor %}                
            </select>
        </div>
        <div class="col-md-8">
            <label for="">Valor a transferir:</label>
            <input type="number" name="saldo" required class="form-control">            
        </div>          

        <div class="col-md-8">            
            <label for="">Cliente a Transferir:</label>                      
            <select name="clienteTranferir" required id="clienteTranferir" class="form-control">    
                <option  disabled selected  value="">Seleccione...</option>                                 
                {% for item in dataclientes %}
                    <option value="{{item.id}}">{{item.cliente}}</option>
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
{% if dataclientes is defined %}
	<script>

$("#clienteTranferencia").on("change",function(){
        var valor = $(this).val();
        console.log(valor)
        $("#clienteTranferir").find("option[value='"+valor+"']").prop("disabled",true);
    });
        
	</script>
{% endif %}




