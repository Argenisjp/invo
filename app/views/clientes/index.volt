

{{ content() }}

<div align="right">
    {{ link_to("clientes/new", "Agregar Cliente", "class": "btn btn-primary") }}
</div>
<div align="left">
    {{ link_to("clientes/transferencia", "Transferirencia ", "class": "btn btn-info") }}
</div>

{% if clientes is defined %}
<table class="table table-bordered table-hover ">
    <thead>
      <tr>
        <th scope="col">Id</th>
        <th scope="col">Nombre</th>
        <th scope="col">Apellido</th>
        <th scope="col">Celular</th>
        <th scope="col">Tipo de documento</th>
        <th scope="col">Documento</th>
        <th scope="col">Correo</th>
        <th scope="col">Saldo</th>
        <th scope="col">Status</th>
        <th scope="col">Recargar</th>
        <th scope="col">Editar</th>
        <th scope="col">Inactivar</th>
        
      </tr>
    </thead>
    <tbody>
        {% for item in clientes %}
        <tr>
            <th scope="row">{{item.id}}</th>
            <td>{{item.nombre}}</td>
            <td>{{item.apellido}}</td>
            <td>{{item.celular}}</td>
            <td>{{item.tipodocumento}}</td>
            <td>{{item.documento}}</td>
            <td>{{item.correo}}</td>
            <td>{{item.saldo}}</td>
            <td>{% if item.status == 1 %} ACTIVO {% else %} INACTIVO {% endif %}</td>

         
            <td width="7%">{{ link_to("clientes/recarga/" ~ item.id, '<i class=" glyphicon glyphicon-open"></i> Recarga', "class": "btn btn-success") }}</td>
            <td width="7%">{{ link_to("clientes/edit/" ~ item.id, '<i class=" glyphicon glyphicon-edit"></i> Editar', "class": "btn btn-info") }}</td>
            <td width="7%">{{ link_to("clientes/delete/" ~ item.id, '<i class=" glyphicon glyphicon-eye-close"></i> Inactivar', "class": "btn btn-danger") }}</td>
        </tr>
        {% endfor %}
    </tbody>
  </table>




  {% else %}
    No se encontraron registros de clientes
{% endif %}





