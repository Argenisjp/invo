

{{ content() }}

<div align="right">
    {{ link_to("personas/new", "Agregar Persona", "class": "btn btn-primary") }}
</div>



{% for persona in page.items %}
{% if loop.first %}
<table class="table table-bordered table-striped" align="center">
    <thead>
        <tr>
            <th>Id</th>
            <th>Nombres</th>
            <th>Apellidos</th>
            <th>Fecha Nacimiento</th>
            <th>Edad</th>
            <th>Fecha Registro</th>
            <th>Salario</th>
            <th>Status</th>
            <th>Editar</th>
            <th>Inactivar</th>
        </tr>
    </thead>
{% endif %}
    <tbody>
        <tr>
            <td>{{ persona.personasid }}</td>
            <td>{{ persona.nombres }}</td>
            <td>{{ persona.apellidos }}</td>
            <td>{{ persona.fechanacimiento }}</td>
            <td>{{ persona.edad }}</td>
            <td>{{ persona.fecharegistro }}</td>
            <td>{{ persona.salario }}</td>
            <td>{% if persona.status == 1 %} ACTIVO {% else %} INACTIVO {% endif %}</td>
            <td width="7%">{{ link_to("personas/edit/" ~ persona.personasid, '<i class=" glyphicon glyphicon-edit"></i> Editar', "class": "btn btn-info") }}</td>
            <td width="7%">{{ link_to("personas/delete/" ~ persona.personasid, '<i class=" glyphicon glyphicon-off"></i> Inactivar', "class": "btn btn-danger") }}</td>
        </tr>
    </tbody>
{% if loop.last %}
    <tbody>
        <tr>
            <td colspan="12" align="right">
                <div class="btn-group">
                    {{ link_to("personas/search", '<i class="icon-fast-backward"></i> First', "class": "btn btn-default") }}
                    {{ link_to("personas/search?page=" ~ page.before, '<i class="icon-step-backward"></i> Previous', "class": "btn btn-default") }}
                    {{ link_to("personas/search?page=" ~ page.next, '<i class="icon-step-forward"></i> Next', "class": "btn btn-default") }}
                    {{ link_to("personas/search?page=" ~ page.last, '<i class="icon-fast-forward"></i> Last', "class": "btn btn-default") }}
                    <span class="help-inline">{{ page.current }}/{{ page.total_pages }}</span>
                </div>
            </td>
        </tr>
    <tbody>
</table>
{% endif %}
{% else %}
    No personas are recorded
{% endfor %}



