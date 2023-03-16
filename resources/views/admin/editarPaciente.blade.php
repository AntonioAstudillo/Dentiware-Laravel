@extends('admin.layouts.app')

@section('contenido')

<!-- Contenido -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header text-left text-dark h5">Editar Pacientes</div>
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
                    <th>Editar</th>
                 </tr>
              </thead>
              <tbody class="text-center"></tbody>
           </table>
        </div>
     </div>

      <!-- MODAL -->
      <div id="editUser" class="modal" tabindex="-1" role='dialog'>
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Datos del Paciente </h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
               <!-- <div class="container"> -->
                  <fieldset id = "datosPaciente">
                     <div class="row">
                        <div class="col-12 col-md-6">
                           <label class="form-label" for="nombre">Nombre:</label>
                           <input type="text" class="form-control" id="nombre">
                           <input type="hidden" id="idUsuario" value="">
                        </div>
                        <div class="col-12 col-md-6">
                           <label class="form-label" for="apellidos">Apellidos:</label>
                           <input type="text" class="form-control" id="apellidos">
                        </div>
                     </div>
                     <div class="row mt-3">
                        <div class="col-12 col-md-6">
                           <label class="form-label" for="edad">Edad:</label>
                           <input type="number" class="form-control" id="edad">
                        </div>
                        <div class="col-12 col-md-6">
                           <label class="form-label" for="telefono">Teléfono:</label>
                           <input type="number" class="form-control" id="telefono">
                        </div>
                     </div>

                     <div class="row mt-3">
                        <div class="col-12 col-md-12">
                           <label class="form-label" for="direccion">Dirección:</label>
                           <input type="email" class="form-control" id="direccion">
                        </div>
                     </div>

                     <div class="row mt-3">
                        <div class="col-12 col-md-8">
                           <label class="form-label" for="correo">Email:</label>
                           <input type="email" class="form-control" id="correo">
                        </div>
                        <div class="col-12 col-md-4">
                           <label class="form-label" for="genero">Género:</label>
                           <select class="form-control" id="genero"></select>
                        </div>
                     </div>
               </fieldset>
               <!-- </div> -->
            </div>
            <div class="modal-footer mt-2">
              <button id="btnCerrar" type="button" class="btn btn-danger">Cerrar</button>
              <button type="button" class="btn btn-primary" id="btnGuardar" >Guardar Cambios</button>
            </div>
          </div>
        </div>
      </div>


  </div>

  <!-- /.content-header -->
</div>
@endsection



