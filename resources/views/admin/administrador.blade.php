@extends('admin.layouts.app')



@section('contenido')
    <!-- Contenido -->
<div class="content-wrapper">
   <div class="container mt-1 border p-4">
      <div class="container-fluid mt-3 border p-5">
         <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-usuarios" role="tabpanel" aria-labelledby="pills-home-tab">
               <div class=" d-flex justify-content-start mb-3">
                  <button data-bs-toggle="modal" data-bs-target="#registro" type="button" class="btn btn-success" name="button"><i class="fas fa-user-plus"></i></button>
               </div>
               <table id="tablaUsuarios" class="table table-bordered text-center">
                  <thead>
                     <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Correo</th>
                        <th scope="col">Fecha</th>
                        <th scope="col">Opciones</th>
                     </tr>
                  </thead>
                  <tbody></tbody>
               </table>
            </div>
      </div>
   </div>



<!-- MODALS -->


<!--MODAL REGISTRO USUARIO -->
<div class="modal fade" id="registro" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Registro usuario</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="container">
            <form id="formUsuario" class="" action="" method="post">
            <div class="row">
               <div class="col-md-12 col-sm-12 mt-1">
                 <div class="input-group mb-3">
                     <span class="input-group-text"><i class="fas fa-sort-alpha-down"></i></span>
                     <input type="text" class="form-control" id="nombreUsuario" name="nombreUsuario" value="" placeholder="Nombre del usuario">
                 </div>
               </div>
            </div>
            <div class="row">
               <div class="col-md-12 col-sm-12 mt-3">
                 <div class="input-group mb-3">
                     <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                     <input type="email" name="correoUsuario" id="correoUsuario" value="" placeholder="Email del usuario" class="form-control">
                 </div>
               </div>
            </div>
            <div class="row">
               <div class="col-md-12 col-sm-12 mt-3">
                 <div class="input-group mb-3">
                     <span class="input-group-text"><i class="fas fa-lock"></i></span>
                     <input type="password" name="password" id="password" value="" placeholder="Password" class="form-control">
                 </div>
               </div>
            </div>
         </form>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        <button id="btnRegistrar" type="button" class="btn btn-primary">Registrar Usuario</button>
      </div>
    </div>
  </div>
</div>
<!-- AQUI TERMINA MODAL REGISTRO USUARIO -->

<!-- MODAL VISTA USUARIO -->
<div class="modal fade" id="show" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
         <section class="h-100 gradient-custom-2">
            <div class="container py-5 h-100">
          <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col col-lg-9 col-xl-7">
              <div class="card">
                <div class="rounded-top text-white d-flex flex-row" style="background-color: #000; height:200px;">
                  <div class="ms-4 mt-5 d-flex flex-column" style="width: 150px;">
                    <img id="perfilUser"
                      alt="Generic placeholder image" class="img-fluid img-thumbnail mt-4 mb-2"
                      style="width: 150px; z-index: 1">
                  </div>
                  <div class="ms-3" style="margin-top: 130px;">
                    <h5 id="nombre" ></h5>
                    <p id="tipo"></p>
                  </div>
                </div>
                <div class="p-4 text-black" style="background-color: #f8f9fa;">
                  <div class="d-flex justify-content-end text-center py-1">

                  </div>
                </div>
                <div class="card-body p-4 text-black">
                     <div class="mb-5">
                       <p class="lead fw-normal mb-1">Información</p>
                       <div class="p-4" style="background-color: #f8f9fa;">
                         <p  id="correo" class="font-italic mb-1">correo@gmail.com</p>
                         <p id="nickname" class="font-italic mb-1">sabroso88</p>
                         <p id="telefono" class="font-italic mb-0">3329283921</p>
                       </div>
                     </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
         </section>
      </div>
    </div>
  </div>
</div>
<!-- AQUI TERMINA MODAL VISTA USUARIO  -->

<!-- MODAL EDITAR USUARIO  -->
<div id="edit" class="modal" tabindex="-1">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h6 class="modal-title">Datos del usuario </h5>
        <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
      </div>
      <div class="modal-body">
         <div class="container">
            <fieldset id = "datosPaciente">
               <div class="row">
                  <div class="col-12 col-md-12">
                     <label class="form-label" for="nombreModal">Nombre</label>
                     <input type="text" class="form-control" id="nombreModal">
                  </div>
               </div>
               <div class="row mt-3">
                  <div class="col-12 col-md-12">
                     <label class="form-label" for="correoModal">Email</label>
                     <input type="email" class="form-control" id="correoModal">
                  </div>

               </div>

               <div class="row mt-3">
                  <div class="col-12 col-md-10">
                     <label class="form-label" for="passwordModal">Contraseña</label>
                     <input type="password" disabled  class="form-control" id="passwordModal">
                  </div>
                  <div class="col-12 col-md-2">
                    <button class="btn btn-success mt-4" id="btnPassword">  Cambiar</button>
                  </div>
               </div>
         </fieldset>
         </div>
      </div>
      <div class="modal-footer mt-2">
        <button type="button" class="btn btn-danger" id="btnClose" data-bs-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" id="btnGuardar" disabled >Guardar Cambios</button>
      </div>
    </div>
  </div>
</div>


</div>
@endsection

@section('scriptPagina')
<script src="{{asset('js/admin/administrador.js')}}" charset="utf-8" type="module"></script>
@endsection
