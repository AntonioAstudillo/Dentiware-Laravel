@extends('admin.layouts.app')


@section('contenido')
<div class="content-wrapper">
   <div class="content-header text-left text-dark h5 lead">Editar Cita </div>
   <div class="container">
      <div class="row">
         <div class="col-md-12">
            <table id="tablaEditarCita" class="table table-bordered  nowrap"  style = 'width:100%'>
               <thead  class="">
                  <tr class="text-center">
                     <th>Id</th>
                     <th>Fecha</th>
                     <th>Hora</th>
                     <th>Nombre</th>
                     <th>Correo</th>
                     <th>Pago</th>
                     <th>Tratamiento</th>
                     <th>Opciones</th>
                  </tr>
               </thead>
               <tbody class="text-center"></tbody>
            </table>
         </div>
      </div>
   </div>

   <!-- MODAL -->
   <div id="editCita" class="modal" tabindex="-1">
     <div class="modal-dialog">
       <div class="modal-content">
         <div class="modal-header">
           <h5 class="modal-title">Editar Cita </h5>
           <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
         </div>
         <div class="modal-body">
            <div class="row">
               <div class="col-md-12 col-sm-12 mt-1">
                  <div class="input-group mb-3">
                     <span class="input-group-text" ><i class="fas fa-hospital-user"></i></span>
                     <input disabled type="text" class="form-control" id="nombrePaciente" name="nombrePaciente">
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-md-12 col-sm-12 mt-3">
                  <div class="input-group mb-3">
                     <span class="input-group-text"><i class="fas fa-tooth"></i></span>
                     <select class="form-control" id="tratamientoPaciente" name="tratamientoPaciente">
                     </select>
                  </div>
               </div>
            </div>

            <div class="row">
               <div class="col-md-12 col-sm-12 mt-3">
                  <div class="input-group mb-3">
                     <span class="input-group-text"><i class="fas fa-user-md"></i></span>
                     <select class="form-control" id="dentistaPaciente" name="dentistaPaciente">
                        <option value="">Elige un dentista</option>
                     </select>
                  </div>
               </div>
            </div>

            <div class="row">
               <div class="col-md-6 col-sm-12 mt-3">
                  <div class="input-group mb-3">
                     <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                     <input type="date" class="form-control" id="fechaCita" name="fechaCita" value="" class="form-control">
                  </div>
               </div>

               <div class="col-md-6 col-sm-12 mt-3">
                  <div class="input-group mb-3">
                     <span class="input-group-text"><i class="fas fa-clock"></i></span>
                     <input type="time" class="form-control" id="horaCita" name="horaCita" value="" class="form-control">
                  </div>
               </div>
            </div>

            <div class="row">
               <div class="col-md-12 col-sm-12 mt-1">
                  <div class="input-group">
                     <span class="input-group-text">Comentarios</span>
                     <textarea id="comentariosPaciente" name="comentariosPaciente" class="form-control" style="resize:none;" aria-label="With textarea" placeholder="Ejemplo: El paciente es alérgico a la penicilina."></textarea>
                  </div>
               </div>
            </div>

         </div>
         <div class="modal-footer mt-2">
           <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
           <button type="button" class="btn btn-primary" id="btnGuardar" disable >Guardar Cambios</button>
         </div>
       </div>
     </div>
   </div>
</div>
@endsection



@section('scriptPagina')
<!-- CDN PARA TRABAJAR CON LA LIBRERIA MOMENTS.JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.3/moment.min.js"></script>
<!-- MAIN -->
<script src="{{asset('js/admin/editarCita.js')}}" charset="utf-8" type="module"></script>
@endsection
