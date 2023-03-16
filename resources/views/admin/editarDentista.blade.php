@extends('admin.layouts.app')

@section('contenido')
<!-- Contenido -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header text-left text-dark h5">Editar Dentistas</div>
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
                    <th>Cargo</th>
                    <th>Turno</th>
                    <th>FechaIngreso</th>
                    <th>Sueldo</th>
                    <th>NSS</th>
                    <th>RFC</th>
                    <th>Cédula</th>
                    <th>Clabe</th>
                    <th>Bank</th>
                    <th>Editar</th>
                 </tr>
              </thead>
              <tbody class="text-center"></tbody>
           </table>
        </div>
     </div>

      <!-- MODAL -->
      <div id="editUser" class="modal" tabindex="-1">
        <div class="modal-dialog modal-xl">
          <div class="modal-content">
            <div class="modal-header">
              <h6 class="modal-title">Datos del Dentista </h5>
              <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
            </div>
            <div class="modal-body">
               <div class="container">
                  <fieldset id = "datosPaciente">
                     <div class="row">
                        <div class="col-12 col-md-4">
                           <label class="form-label" for="nombre">Nombre</label>
                           <input type="text" class="form-control" id="nombre">
                           <input type="hidden" name="" id="idDentista" value="">
                        </div>
                        <div class="col-12 col-md-4">
                           <label class="form-label" for="apellidos">Apellidos</label>
                           <input type="text" class="form-control" id="apellidos">
                        </div>
                        <div class="col-12 col-md-2">
                           <label class="form-label" for="edad">Edad</label>
                           <input type="number" class="form-control" id="edad">
                        </div>
                        <div class="col-12 col-md-2">
                           <label class="form-label" for="genero">Género</label>
                           <select class="form-control" id="genero"></select>
                        </div>
                     </div>
                     <div class="row mt-3">
                        <div class="col-12 col-md-4">
                           <label class="form-label" for="telefono">Teléfono</label>
                           <input type="number" class="form-control" id="telefono">
                        </div>
                        <div class="col-12 col-md-4">
                           <label class="form-label" for="direccion">Dirección</label>
                           <input type="email" class="form-control" id="direccion">
                        </div>
                        <div class="col-12 col-md-4">
                           <label class="form-label" for="correo">Email</label>
                           <input type="email" class="form-control" id="correo">
                        </div>

                     </div>
                     <div class="row mt-3">
                        <div class="col-12 col-md-4">
                           <label class="form-label" for="especialidad">Especialidad</label>
                           <select class="form-control" name="especialidad" id="especialidad">

                           </select>
                        </div>
                        <div class="col-12 col-md-4">
                           <label class="form-label" for="turno">Turno</label>
                           <select class="form-control" id="turno"></select>
                        </div>
                        <div class="col-12 col-md-4">
                           <label class="form-label" for="fechaIngreso">Fecha Ingreso</label>
                           <input type="text" class="form-control" id="fechaIngreso">
                        </div>
                     </div>
                     <div class="row mt-3">
                        <div class="col-12 col-md-4">
                           <label class="form-label" for="nss">NSS</label>
                           <input type="text" class="form-control" id="nss">
                        </div>
                        <div class="col-12 col-md-4">
                           <label class="form-label" for="rfc">RFC</label>
                           <input type="text" class="form-control" id="rfc">
                        </div>
                        <div class="col-12 col-md-4">
                           <label class="form-label" for="cedula">Cédula Profesional</label>
                           <input type="text" class="form-control" id="cedula">
                        </div>
                     </div>
                     <div class="row mt-3">
                        <div class="col-12 col-md-4">
                           <label class="form-label" for="sueldo">Sueldo</label>
                           <input type="text" class="form-control" id="sueldo">
                        </div>
                        <div class="col-12 col-md-4">
                           <label class="form-label" for="clabe">Clabe</label>
                           <input type="text" class="form-control" id="clabe">
                        </div>
                        <div class="col-12 col-md-4">
                           <label class="form-label" for="bank">Cuenta Bancaria</label>
                           <input type="text" class="form-control" id="bank">
                        </div>
                     </div>
               </fieldset>
               </div>
            </div>
            <div class="modal-footer mt-2">
              <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
              <button type="button" class="btn btn-primary" id="btnGuardar"  >Guardar Cambios</button>
            </div>
          </div>
        </div>
      </div>


  </div>

  <!-- /.content-header -->
</div>
@endsection


@section('scriptPagina')
    <script src="{{asset('js/admin/editarDentista.js')}}" charset="utf-8" type="module"></script>
@endsection



