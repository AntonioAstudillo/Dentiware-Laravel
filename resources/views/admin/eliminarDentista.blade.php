@extends('admin.layouts.app')


@section('contenido')
    <div class="content-wrapper">
   <div class="content-header text-left text-dark h5">Eliminar Dentistas</div>
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
                     <th>Genero</th>
                     <th>Eliminar</th>
                  </tr>
               </thead>
               <tbody class="text-center"></tbody>
            </table>
         </div>
      </div>
   </div>
</div>


      <!-- MODAL -->
      <div id="deleteUser" class="modal" tabindex="-1">
        <div class="modal-dialog modal-sm">
          <div class="modal-content">
            <div class="modal-body">
               <p class="text-dark">¿Está seguro de que desea eliminar a este dentista de forma permanente?</p>
            </div>
            <div class="modal-footer mt-2">
               <input type="hidden" id="idDentista" name="" value="">
               <button id="btnEliminar" type="button" class="btn btn-primary btn-sm">Si</button>
               <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal">No</button>
            </div>
          </div>
        </div>
      </div>

@endsection



@section('scriptPagina')
  <script src="{{asset('js/admin/eliminarDentistas.js')}}" charset="utf-8" type="module"></script>
@endsection
