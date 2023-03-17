@extends('admin.layouts.app')

@section('contenido')
<!-- Contenido -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header text-left text-dark h5">Buscar Dentista</div>
  <div class="container">
     <div class="row">
        <div class="col-md-12">
           <table id="tablaPacientes" class="table table-bordered  nowrap"  style = 'width:100%'>
              <thead  class="">
                <tr class="text-center">
                    <th>Id</th>
                    <th>Nombre</th>
                    <th>Apellidos</th>
                    <th>Edad</th>
                    <th>Teléfono</th>
                    <th>Correo</th>
                    <th>Dirección</th>
                    <th>Género</th>
                 </tr>
              </thead>
              <tbody class="text-center"></tbody>
           </table>
        </div>
     </div>
  </div>

  <!-- /.content-header -->
</div>
@endsection


@section('scriptPagina')
    <script src="{{asset('js/admin/buscarDentistas.js')}}" charset="utf-8" type="module"></script>
@endsection



