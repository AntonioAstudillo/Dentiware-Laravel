@extends('admin.layouts.app')


@section('contenido')
<div class="content-wrapper">
   <div class="content-header text-left text-dark h5 lead">Citas </div>
   <div class="container">
      <div class="row">
         <div class="col-md-12">
            <table id="tablaPagoCitas" class="table table-bordered  nowrap"  style = 'width:100%'>
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
               <tbody class="text-center "></tbody>
            </table>
         </div>
      </div>
   </div>

   <!-- MODAL -->
   <div id="showDentist" class="modal" tabindex="-1">
     <div class="modal-dialog">
       <div class="modal-content">
         <div class="modal-header">
           <h5 class="modal-title">Datos del Dentista</h5>
           <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
         </div>
         <div class="modal-body">
            <div class="row">
               <div class="col-md-12">
                  <label for="idPersona" class="label-form">ID</label>
                  <input type="text" name="" value="" class="form-control" id="idPersona" disabled>
               </div>
            </div>
            <div class ='row'>
               <div class="col-md-12">
                  <label for="nombre" class="label-form">Nombre</label>
                  <input type="text" name="" value="" class="form-control" id="nombre" disabled>
               </div>
            </div>
            <div class="row mt-3">
               <div class="col-md-6">
                  <label for="edad" class="label-form">Edad</label>
                  <input type="text" name="" value="" class="form-control" id="edad" disabled>
               </div>
               <div class="col-md-6">
                  <label for="cargo" class="label-form">Cargo</label>
                  <input type="text" name="" value="" class="form-control" id="cargo" disabled>
               </div>
            </div>
            <div class="row mt-3">
               <div class="col-md-5">
                  <label for="turno" class="label-form">Turno</label>
                  <input type="text" name="" value="" class="form-control" id="turno" disabled>
               </div>
               <div class="col-md-7">
                  <label for="correo" class="label-form">Correo</label>
                  <input type="email" name="" value="" class="form-control" id="correo" disabled>
               </div>
            </div>
         </div>
         <div class="modal-footer mt-2">
           <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
         </div>
       </div>
     </div>
   </div>

   <!-- MODAL -->
   <div id="payConsult" class="modal" tabindex="-1">
     <div class="modal-dialog">
       <div class="modal-content">
         <div class="modal-header">
           <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
         </div>
         <div class="modal-body">

            <div class="container">
               <div class="row">
                  <div class="container">
                     <div class="row">
                        <div class="col-xs-6 col-sm-6 col-md-6">
                           <address>
                              <strong>Belisario Dominguez</strong>
                              <br>
                                 Calle Mesa Central 620
                              <br>
                                 Guadalajara,Jalisco
                                 <br>
                                 <abbr title="Phone">P:</abbr> (33) 33-36-51-67-24
                           </address>
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-6 text-right">
                           <p>
                              <em>Fecha: <span id="fechaPago"></span></em>
                           </p>
                           <p>
                              <em>Recibo #: <span id="reciboServicio">34522677W</span></em>
                           </p>
                        </div>
                     </div>
                     <div class="row">
                        <div class="text-center">
                           <h1  class="lead" >Recibo</h1>
                        </div>
                        <table class="table table-hover">
                           <thead>
                              <tr>
                                 <th>Servicio</th>
                                 <th></th>
                                 <th class="text-center"></th>
                                 <th class="text-center">Precio</th>
                              </tr>
                           </thead>
                           <tbody>
                              <tr>
                                  <td class="col-md-9"><em id="servicioPago">Baked Rodopa Sheep Feta</em></h4></td>
                                  <td class="col-md-1" style="text-align: center">  </td>
                                  <td class="col-md-1 text-center" ></td>
                                  <td class="col-md-1 text-center">$<span id="precioServicio"></span></td>
                              </tr>
                              <tr>
                                 <td>   </td>
                                 <td>   </td>
                                 <td class="text-right">
                                    <p>
                                       <strong>Subtotal:</strong>
                                    </p>
                                 </td>
                                 <td class="text-center">
                                    <p>
                                       <strong ><span id="totalServicio"> </span> </strong>
                                    </p>
                                 </td>
                              </tr>
                           </tbody>
                        </table>
                        <div class="row mb-3 border-bottom">
                           <div class="col-md-4">
                              <p class="lead">Total</p>
                              <div class="input-group mb-3">
                                 <span class="input-group-text"><i class="fas fa-money-bill"></i></span>
                                 <input disabled type="text" class="form-control p-0 text-center form-control-sm" id="cantidadServicio">
                              </div>
                           </div>

                           <div class="col-md-4">
                              <p class="lead">Pago</p>
                              <div class="input-group mb-3">
                                 <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
                                 <input  type="text" class="form-control p-0 text-center form-control-sm" value="0" placeholder="0" id="abonoServicio">
                              </div>
                           </div>

                           <div class="col-md-4">
                              <p class="lead">Cambio</p>
                              <div class="input-group mb-3">
                                 <span class="input-group-text"><i class="fas fa-hand-holding-usd"></i></span>
                                 <input disabled type="text" class="form-control p-0 text-center form-control-sm" placeholder="0" id="cambioServicio">
                              </div>
                           </div>
                        </div>
                        <button type="button" class="btn btn-success btn-lg btn-block" id="btnPago">Generar Pago</button>
                     </div>
                  </div>
               </div>
            </div>
         </div>
       </div>
     </div>
   </div>


</div>

@endsection




@section('scriptPagina')
<!-- SCRIPT PARA DATATABLE Y DATATABLE RESPONSIVE  -->
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js" charset="utf-8"></script>
<script src="//cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.js" charset="utf-8"></script>


<!-- SCRIPTS PARA PAYPAL Y MAIN -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.3/moment.min.js"></script>

<!-- LIBRERIA PARA GENERAR PDF   -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.2/jspdf.debug.js"></script>

<!-- Codigo donde genero la logica de generar el pago de la cita -->
<script src="{{asset('js/admin/cobroCitas.js')}}" charset="utf-8" type="module"></script>

@endsection
