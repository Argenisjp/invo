

{{ content() }}

<div align="right">
    {{ link_to("clientes/new", "Agregar Cliente", "class": "btn btn-primary") }}
</div>



{% for clientes in page.items %}
{% if loop.first %}
<table class="table table-bordered table-striped" align="center">
    <thead>
        <tr>
            <th>Id</th>
            <th>Nombres</th>
            <th>Apellidos</th>
         <!--    <th>Fecha de registro</th> -->
            <th>Celular</th>
            <th>Tipo de documento</th>
            <th>Documento</th>
            <th>Correo</th>
            <th>Editar</th>
            <th>Eliminar</th>
        </tr>
    </thead>
{% endif %}
    <tbody>
        <tr>
            <td>{{ clientes.clienteid }}</td>
            <td>{{ clientes.nombre }}</td>
            <td>{{ clientes.apellido }}</td>
            <td>{{ clientes.celular }}</td>
            <td>{% if clientes.tipodocumento == 1 %} CC 
                {% elseif clientes.tipodocumento == 2 %}  NIT {% else %} PAS {% endif %}</td>
            <td>{{ clientes.documento }}</td>
            <td>{{ clientes.correo }}</td>
           
            <td width="7%">{{ link_to("clientes/edit/" ~ clientes.clienteid, '<i class=" glyphicon glyphicon-edit"></i> Editar', "class": "btn btn-info") }}</td>
            <td width="7%">{{ link_to("clientes/delete/" ~ clientes.clienteid, '<i class=" glyphicon glyphicon-remove"></i> Eliminar', "class": "btn btn-danger") }}</td>
        </tr>
    </tbody>
{% if loop.last %}
    <tbody>
        <tr>
            <td colspan="12" align="right">
                <div class="btn-group">
                    {{ link_to("clientes/search", '<i class="icon-fast-backward"></i> First', "class": "btn btn-default") }}
                    {{ link_to("clientes/search?page=" ~ page.before, '<i class="icon-step-backward"></i> Previous', "class": "btn btn-default") }}
                    {{ link_to("clientes/search?page=" ~ page.next, '<i class="icon-step-forward"></i> Next', "class": "btn btn-default") }}
                    {{ link_to("clientes/search?page=" ~ page.last, '<i class="icon-fast-forward"></i> Last', "class": "btn btn-default") }}
                    <span class="help-inline">{{ page.current }}/{{ page.total_pages }}</span>
                </div>
            </td>
        </tr>
    <tbody>
</table>
{% endif %}
{% else %}
    No se encontraron registros de clientes
{% endfor %}



