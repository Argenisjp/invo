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
    <form action="{{url('proveedores/saveRecarga')}}" method="POST">      
        
        <input type="hidden" name="proveedorid" value="{{dataproveedores.proveedorid}}">
        <div class="col-md-8">
            <label for="">Intruduce Valor a recargar:</label>
            <input type="number" name="saldo" required class="form-control" min="1">
        </div>

    
        
        <div class="col-md-8">
           <br>
           <button class="btn btn-success form-control "><i class=" glyphicon glyphicon-download-alt"></i> RECARGAR</button>
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

    
        
	</script>
{% endif %}

