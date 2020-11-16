@extends('layouts.app')

@section('titulo','Empleados')



@section('alert')
<div class="container">
	@if (session('datos'))
	<div class="alert alert-success alert-dismissible fade show" role="alert" align="center">
		{{session('datos')}}
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		</button>
	</div>
	@endif
@endsection


@section('content')


@if ($errors->any())
<div class="alert alert-danger">
<center><h5>Hay errores en el buscador</H2></center>
<ul>
  @foreach ($errors->all() as $error)
    <li>{{ $error }}</li>
  @endforeach
</ul>
</div>
@endif
<div class="container">
<!-- html agregado-->
<!-- <form> -->
<div class="input-group-prepend">
      <div class="col-sm-8">
        <input class="form-control mr-sm-2" name="textoempleado" id="textoempleado" type="text" placeholder="Buscar empleados" aria-label="Search">
      </div>
      <div class="col-sm-4">
        <select class="custom-select" name='opcBuscadorE' id="opcBuscadorE" autocomplete="off">
          <option value="1"selected>Todos</option>
          <option value="2">Bodega</option>
          <option value="3">Ventas</option>
          <option value="4">Compras</option>
          <option value="5">Secretaria</option>
          <option value="6">Gerente</option>
        </select>
      </div>
    </div>
    <br>
<!-- fin del html agregado-->
  <table class="table table-hover" >
        <thead>
          <tr>
            <th scope="col">ID</th>
            <th scope="col">Nombre</th>
            <th scope="col">Apellido</th>
            <th scope="col">Edad</th>
            <th scope="col">DUI</th>
            <th scope="col">Correo Electrónico</th>
            <th scope="col">Teléfono</th>
            <th scope="col">Acciones</th>
          </tr>
        </thead>
        <tbody id="ok4">
        @foreach ($empleados as $empleado)
            <tr>
                <td>{{$empleado->cod_empleado}}</td>
                <td>{{$empleado->nombre}}</td>
                <td>{{$empleado->apellido}}</td>
                <td>{{$empleado->edad}}</td>
                <td>{{$empleado->dui}}</td>

                @foreach (App\User::where('cod_empleado_fk', $empleado->cod_empleado)->cursor() as $usuario)
                    <td>{{$usuario->email}}</td>
                    <td>{{$empleado->telefono}}</td>

                    @if ($usuario->tieneRol()->first() == "ventas")
                        
                        <td><a href="{{route('Empleados.edit', $empleado->cod_empleado)}}"><button type="button" class="btn btn-success">Editar</button></a></td>
                    @endif
                @endforeach
            </tr>
        @endforeach
      </tbody>
  </table>            
</div>
<div class="row">
    <div class="mx-auto">
        {{$empleados}}
    </div>
</div>
@endsection