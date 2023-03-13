@extends('admin.layouts.app')

@section('contenido')
    <!-- Contenido -->
<div class="content-wrapper">

  <!-- Content Header (Page header) -->
  <div class="content-header text-left text-dark h5">Registro Pacientes</div>

    <div class="container d-flex justify-content-center">
        <div id="cajaError" class="row errorDiv">
            <div class="col-12">
                <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
                    <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                    </symbol>
                    <symbol id="info-fill" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
                    </symbol>
                    <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                    </symbol>
                </svg>

                <div class="alert alert-danger d-flex align-items-center" role="alert">
                    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
                    <div id="mensajeError">
                        Mensaje de error
                    </div>
                </div>
            </div>
        </div>
    </div>


  <!-- /.content-header -->

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <form  id="formPaciente" method="post">
         <div class="row">
            <div class="col-md-6 col-sm-12 mt-1">
               <div class="input-group mb-3">
                  <span class="input-group-text"><i class="fas fa-sort-alpha-down"></i></span>
                  <input type="text" class="form-control" id="nombrePaciente" name="nombrePaciente" value="" placeholder="Nombre del paciente">
               </div>
            </div>

            <div class="col-md-6 col-sm-12 mt-1">
               <div class="input-group mb-3">
                  <span class="input-group-text" ><i class="fas fa-sort-alpha-down"></i></span>
                  <input type="text" class="form-control" id="apellidoPaciente" name="apellidoPaciente" value="" placeholder="Apellidos del paciente">
               </div>
            </div>
         </div>



         <div class="row mt-2">
            <div class="col-md-6 col-sm-12 mt-1">
               <div class="input-group mb-3">
                  <span class="input-group-text"><i class="fas fa-sort-numeric-up"></i></span>
                  <input type="number" name="edadPaciente" id="edadPaciente" value="" class="form-control" placeholder="Edad del paciente">
               </div>

            </div>
            <div class="col-md-6 col-sm-12 mt-1">
               <div class="input-group mb-3">
                  <span class="input-group-text"><i class="fas fa-phone-square"></i></span>
                  <input type="text" name="telefonoPaciente" id="telefonoPaciente" value="" class="form-control" placeholder="Teléfono del paciente">
               </div>
            </div>
         </div>

         <div class="row mt-2">
            <div class="col-md-6 col-sm-12 mt-1">
               <div class="input-group mb-3">
                  <span class="input-group-text"><i class="fas fa-venus-mars"></i></span>
                  <select class="form-select" id="generoPaciente" name="generoPaciente">
                     <option value="N" selected disabled>Género</option>
                     <option value="M">Masculino</option>
                     <option value="F">Femenino</option>
                  </select>
               </div>
            </div>

            <div class="col-md-6 col-sm-12 mt-1">
               <div class="input-group mb-3">
                  <span class="input-group-text"><i class="fas fa-house-user"></i></span>
                  <input type="text" name="domicilioPaciente" id="domicilioPaciente" value="" placeholder="Domicilio del paciente" class="form-control">
               </div>
            </div>
         </div>

         <div class="row">
            <div class="col-md-6 col-sm-12 mt-3">
               <div class="input-group mb-3">
                  <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                  <input type="email" name="correoPaciente" id="correoPaciente" value="" placeholder="Email del paciente" class="form-control">
               </div>
            </div>

            <div class="col-md-6 col-sm-12 mt-3">
               <div class="input-group mb-3">
                  <span class="input-group-text"><i class="fas fa-tooth"></i></span>
                  <select class="form-select" id="tratamientoPaciente" name="tratamientoPaciente">
                  </select>
               </div>
            </div>
         </div>

         <div class="row">
            <div class="col-md-5 col-sm-12 mt-3">
               <div class="input-group mb-3">
                  <span class="input-group-text"><i class="fas fa-user-md"></i></span>
                  <select class="form-select" id="dentistaPaciente" name="dentistaPaciente"></select>
               </div>
            </div>

            <div class="col-md-4 col-sm-12 mt-3">
               <div class="input-group mb-3">
                  <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                  <input type="date" class="form-control" id="fechaCita" name="fechaCita" value="" class="form-control">
               </div>
            </div>

            <div class="col-md-3 col-sm-12 mt-3">
               <div class="input-group mb-3">
                  <span class="input-group-text"><i class="fas fa-clock"></i></span>
                  <input type="time" class="form-control" id="horaCita" name="horaCita" value="" class="form-control">
               </div>
            </div>
         </div>

         <div class="row">
            <div class="col-md-12 col-sm-12 mt-1">
               <div class="input-group">
                  <span class="input-group-text">Descripción</span>
                  <textarea id="comentariosPaciente" name="comentariosPaciente" class="form-control" style="resize:none;" aria-label="With textarea" placeholder="Ejemplo: El paciente cuenta con seguro facultativo."></textarea>
               </div>
            </div>
         </div>

         <div class="row mt-2 mb-3">
            <div class="col text-right">
               <input type="submit" id="btnPaciente" value="Registrar" class="btn btn-primary font-weight-bold">
            </div>
         </div>
      </form>
    </div><!--/. container -->
  </section><!-- /.content -->
</div>

<!-- Fin del contenido -->

<!-- CDN PARA TRABAJAR CON LA LIBRERIA MOMENTS.JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.3/moment.min.js"></script>

<script src="{{asset('js/admin/registroPaciente.js')}}"></script>
@endsection

