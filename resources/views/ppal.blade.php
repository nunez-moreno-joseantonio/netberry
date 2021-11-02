@extends('layouts.template')

@section('title', 'Netberry | Gestor Tareas')
    
@section('content')
    <h1>Gestor de Tareas</h1>
    <div class="m-2">
        <form id="form" action="GuardarCurso()">
            @csrf
            
            
        </form>
        <table class="table table-bordered" id="tabla2">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Tarea</th>
                    <th scope="col">Categorías</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody id="tbody_tareas"></tbody>
        </table>
    </div>
@endsection 

@section('scripts')
<script>
    $(document).ready(function(){
        
        
        PintarTabla();
        PintarFormulario();
        
    });

    function PintarTabla()
    {
        $.ajax({
            url: "{{url('tareas/list')}}",
            method: 'GET',
            data:{}
        }).done(function(res){
            //alert(res);
            var tareas = JSON.parse(res);
            if (tareas.error)
            {
                alert(tareas.error);
            }
            else{
            
                if (tareas.length <= 0)
                {
                    var linea = "<tr><td>No hay tareas</td><td>&nbsp;</td><td>&nbsp;</td></tr>"
                    $('#tbody_tareas').append(linea);
                }else
                {
                    
                    for (var i=0; i<tareas.length; i++)
                    {
                        
                        var lista = "";
                        ;
                        for (var j=0; j<tareas[i].categorias.length;j++)
                        {
                            lista += "<button type='button' class='btn btn-outline-info btn-sm mx-2'  disabled>"+tareas[i].categorias[j].nombre+"</button>"
                        } 
                        var linea = "<tr>";
                        linea += "<td class='text-left'>"+tareas[i].nombre+"</td>";
                        linea += "<td class='text-center'>"+lista+"</td>";
                        linea += "<td class='text-right'><a href='#' class='btn btn-danger' title='Borrar Tarea' value="+tareas[i].id+" onclick='BorrarTarea("+tareas[i].id+")'><i class='fa fa-trash-o' aria-hidden='true'></i></a></td>";
                        linea += "</tr>";
                    
                        $('#tbody_tareas').append(linea);
                    }
                    
                }
            }
            
        });
    }


    function PintarFormulario()
    {
        var formulario = "<table class='table table-borderless'><tbody>";
        formulario += "<tr><td colspan='2'><input name='tarea' id='tarea' style='width: 90%' placeholder='Inserta una tarea'></td>";
        var categorias = [];

        $.ajax({
            url: "{{url('/categorias/list')}}",
            method: 'GET',
            data:{}
        }).done(function(res){
            var consulta = JSON.parse(res);
            //alert (categorias);
            if(consulta.error)
            {
                alert("Error "+categorias.error);
            }else{
                
                categorias = consulta;
        
                for ( var i=0; i < categorias.length; i++) 
                {
                    formulario += "<td class='text-right'>";
                    formulario += "<input type='checkbox' class='form-check-input' value="+categorias[i].categoria_id+">";
                    formulario += "<label class='form-check-label' for='"+categorias[i].nombre+"'>"+categorias[i].nombre+"</label>";      
                    formulario += "</td>"
                }  
                            
                formulario += "<td class='text-right'>";
                formulario += "<a href='#' class='btn btn-primary btn-sm' onclick=Guardar()> Guardar </a>";
                formulario += "</td>";
                formulario += "</tr>";
                formulario += "</tbody></table>"
                $('#form').append(formulario);
            }
           
        });
        
    }

    
    function LimpiarTabla()
    {
        $('#tbody_tareas').html("");
    }

    function LimpiarFormulario()
    {
        $('#tarea').val("");
        $("input:checkbox").each(function() {
            $(this).prop('checked',false);
        });
        
    }

    function Guardar()
    {
        var token = $('input[name="_token"]').val();
        var nombre = $('#tarea').val();
        var categorias = "";
        var error = "";
        $('input:checkbox:checked').each(function() {
            if(categorias != "")
            {
                categorias += "|";
            }
            categorias += $(this).val();
        });
        
        if(nombre.trim() == "")
        {
            error += "El campo Tarea es obligatorio. ";
        } 

        if (categorias == "")
        {
            error += "Debe seleccionar categoría/s. ";
        }

        if(error != "")
        {
            alert(error);
        }else
        {
            $.ajax
            LimpiarFormulario();
            $.ajax({
                url: "{{url('/tareas/create')}}",
                method: 'POST',
                data:{
                    nombre: nombre,
                    categorias: categorias,
                    _token: token
                }
            }).done(function(res){
                respuesta = JSON.parse(res);
                if(respuesta.error){
                    alert(respuesta.error);
                }
                else{
                    alert(respuesta.mensaje);
                    LimpiarFormulario();
                    LimpiarTabla();
                    PintarTabla();
                }
            });
        }
        
    }

    function BorrarTarea(id) 
    {
        var token = $('input[name="_token"]').val();
        $.ajax
            LimpiarFormulario();
            $.ajax({
                url: "{{url('/tareas/delete')}}",
                method: 'POST',
                data:{
                    id: id,
                    _token: token
                }
            }).done(function(res){
                respuesta = JSON.parse(res);
                if(respuesta.error){
                    alert(respuesta.error);
                }
                else{
                    alert(respuesta.mensaje);
                    LimpiarFormulario();
                    LimpiarTabla();
                    PintarTabla();
                }
            });
    }
</script>
    
@endsection


