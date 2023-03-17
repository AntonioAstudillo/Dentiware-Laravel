@extends('admin.layouts.app')



@section('contenido')
   <div class="content-wrapper">
   <div class="content-header text-left text-dark h5">Buscar Pacientes</div>
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
                     <th>Correo</th>
                     <th>Teléfono</th>
                     <th>Dirección</th>
                     <th>Genero</th>
                  </tr>
               </thead>
               <tbody class="text-center"></tbody>
            </table>
         </div>
      </div>
   </div>
</div>
@endsection



@section('scriptPagina')
 <script src="{{asset('js/admin/buscarPacientes.js')}}" charset="utf-8" type="module"></script>
@endsection
