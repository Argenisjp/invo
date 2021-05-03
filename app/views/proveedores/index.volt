

{{ content() }}

<div align="right">
    {{ link_to("proveedores/new", "Agregar proveedor", "class": "btn btn-primary") }}
</div>

{% if proveedores is defined %}
<table class="table table-bordered table-hover">
    <thead>
      <tr>
        <th scope="col">Id</th>
        <th scope="col">Nombre</th>
        <th scope="col">Apellido</th>
        <th scope="col">Tipo de documento</th>
        <th scope="col">Documento</th>
        <th scope="col">Fecha de afiliación</th>
        <th scope="col">Tipo de contrato</th>
        <th scope="col">Status</th>
        <th scope="col">Editar</th>
        <th scope="col">Inactivar</th>
      </tr>
    </thead>
    <tbody>
        {% for item in proveedores %}
        <tr>
            <th scope="row">{{item.id}}</th>
            <td>{{item.nombre}}</td>
            <td>{{item.apellido}}</td>
            <td>{{item.tipodocumento}}</td>
            <td>{{item.documento}}</td>
            <td>{{item.fechaafiliacion}}</td>
            <td>{{item.tipocontratoid}}</td>
            <td>{% if item.status == 1 %} ACTIVO {% else %} INACTIVO {% endif %}</td>
           
            <td width="7%">{{ link_to("proveedores/edit/" ~ item.id, '<i class=" glyphicon glyphicon-edit"></i> Editar', "class": "btn btn-info") }}</td>
            <td width="7%">{{ link_to("proveedores/delete/" ~ item.id, '<i class=" glyphicon glyphicon-eye-close"></i> Inactivar', "class": "btn btn-danger") }}</td>
        </tr>
        {% endfor %}
    </tbody>
  </table>

  {% else %}
    No se encontraron registros de Proveedores
{% endif %}
