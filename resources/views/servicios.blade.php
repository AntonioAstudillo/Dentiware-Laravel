@extends('layouts.app')


@section('contenido')
<nav id="breadcrumbs" class="breadcrumbs">
   <div class="container page-wrapper">
      <a href="{{ route('home') }}">Inicio</a> » <span class="breadcrumb_last" aria-current="page">Servicios</span>
   </div>
</nav>

<div class="w3l-services-block py-5" id="classes">
   <div class="container py-lg-5 py-md-5">
      <div class="title-content text-left mb-lg-5 mt-4">
         <h6 class="sub-title">Lo que ofrecemos</h6>
         <h3 class="hny-title">Nuestros servicios</h3>
         <p>Especialistas en sonrisas.</p>
      </div>
      <div class="services-block_grids_bottom">
         <div class="row">
            <div class="col-lg-4 col-md-6 service_grid_btm_left mt-lg-5 mt-4">
               <div class="service_grid_btm_left1">
                  <a href="{{ route('service' , ['id' => 'Odontología-Cosmetica']) }}">
                     <img src="{{ asset('images/g1.jpg') }}" alt=" " class="img-fluid" /></a>
                  <div class="service_grid_btm_left2">
                     <h5>Odontología cosmetica</h5>
                     <p>Solucionamos problemas relacionados con la salud bucal y la armonía estética de la boca en su totalidad.</p>
                     <div class="read">
                        <a class="btn mt-4" href="{{ route('service' , ['id' => 'Odontología-Cosmetica']) }}">Leer más</a>
                     </div>
                  </div>
               </div>
            </div>
            <div class="col-lg-4 col-md-6 service_grid_btm_left mt-lg-5 mt-4">
               <div class="service_grid_btm_left1">
                  <a href="{{ route('service' , ['id' => 'Odontología-Pediatrica']) }}"><img src="{{ asset('images/g2.jpg') }}" alt=" " class="img-fluid" /></a>
                  <div class="service_grid_btm_left2">
                     <h5>Odontología Pediatrica</h5>
                     <p>Nuestros dentistas pediátricos están dedicados a la salud bucal de los niños desde el nacimiento hasta la adolescencia.</p>
                     <div class="read">
                        <a class="btn mt-4" href="{{ route('service' , ['id' => 'Odontología-Pediatrica']) }}">Leer más</a>
                     </div>
                  </div>
               </div>
            </div>
            <div class="col-lg-4 col-md-6 service_grid_btm_left mt-lg-5 mt-4">
               <div class="service_grid_btm_left1">
                  <a href="{{ route('service' , ['id' => 'Implantes-Dentales']) }}"><img src="{{ asset('images/g3.jpg') }}" alt=" " class="img-fluid" /></a>
                  <div class="service_grid_btm_left2">
                        <h5>Implantes dentales</h5>
                     <p>Contamos con los mejores especialistas en Cirugía Maxilofacial, para llevar a cabo cualquier cirugía de implantes, con las más altas normas de bio seguridad.</p>
                     <div class="read">
                        <a class="btn mt-4" href="{{ route('service' , ['id' => 'Implantes-Dentales']) }}">Leer más</a>
                     </div>
                  </div>

               </div>
            </div>
            <div class="col-lg-4 col-md-6 service_grid_btm_left mt-lg-5 mt-4">
               <div class="service_grid_btm_left1">
                  <a href="{{route('service' , ['id' => 'Odontología-Preventiva' ]  )}}"><img src="{{ asset('images/g4.jpg') }}" alt=" " class="img-fluid" /></a>
                  <div class="service_grid_btm_left2">
                     <h5>Odontología preventiva</h5>
                     <p>La odontología preventiva es todo cuidado dental que ayuda a mantener una buena salud oral.</p>
                     <div class="read">
                        <a class="btn mt-4" href="{{route('service' , ['id' => 'Odontología-Preventiva' ]  )}}">Leer más</a>
                     </div>
                  </div>
               </div>
            </div>
            <div class="col-lg-4 col-md-6 service_grid_btm_left mt-lg-5 mt-4">
               <div class="service_grid_btm_left1">
                  <a href="{{ route('service' , ['id' => 'Terapia-Periodontal']) }}"><img src="{{ asset('images/g5.jpg') }}" alt=" " class="img-fluid" /></a>
                  <div class="service_grid_btm_left2">
                     <h5>Terapia periodontal</h5>
                     <p>Contamos con especialistas que cuentan con la experiencia en tratar problemas relacionados a las encias de tus dientes.</p>
                     <div class="read">
                        <a class="btn mt-4" href="{{ route('service' , ['id' => 'Terapia-Periodontal']) }}">Leer más</a>
                     </div>
                  </div>
               </div>
            </div>
            <div class="col-lg-4 col-md-6 service_grid_btm_left mt-lg-5 mt-4">
               <div class="service_grid_btm_left1">
                  <a href="{{ route('service' , ['id' => 'Blanqueamiento-de-dientes']) }}"><img src="{{ asset('images/g6.jpg') }}" alt=" " class="img-fluid" /></a>
                  <div class="service_grid_btm_left2">
                     <h5>Blanqueamiento de dientes</h5>
                     <p>El blanqueamiento hoy día, es uno de los servicios más solicitados en nuestra clínica.</p>
                     <div class="read">
                        <a class="btn mt-4" href="{{ route('service' , ['id' => 'Blanqueamiento-de-dientes']) }}">Leer más</a>
                     </div>
                  </div>

               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<!-- // services block2 -->
<section class="features-4">
   <div class="features4-block py-5">
      <div class="container py-lg-5">
         <div class="title-content text-left mb-lg-5 mt-4">
            <h6 class="sub-title-1">Características</h6>
            <h3 class="hny-title two">Algunas características más</h3>
            <p class="fea-para">¡Sonríele a la vida!, estas son algunas cosas que nos diferencian</p>
         </div>
         <div class="row features4-grids text-left">
            <div class="col-lg-3 col-md-6 features4-grid">
               <div class="features4-grid-inn">
                  <span class="fa fa-pencil-square-o icon-fea4" aria-hidden="true"></span>
                  <h5>Chequeo Gratis</h5>
                  <p>Aprovecha nuestras promociones.</p>

               </div>
            </div>
            <div class="col-lg-3 col-md-6 features4-grid">
               <div class="features4-grid-inn">
                  <span class="fa fa-umbrella icon-fea4" aria-hidden="true"></span>
                  <h5>Siempre abierta</h5>
                  <p>La higiene bucal es importante.</p>

               </div>
            </div>
            <div class="col-lg-3 col-md-6 features4-grid third">
               <div class="features4-grid-inn">
                  <span class="fa fa-cogs icon-fea4" aria-hidden="true"></span>
                  <h5>Servir</h5>
                  <p>Un lugar distintivo para el cuidado dental.</p>

               </div>
            </div>
            <div class="col-lg-3 col-md-6 features4-grid">
               <div class="features4-grid-inn">
                  <span class="fa fa-spinner icon-fea4" aria-hidden="true"></span>
                  <h5>Trabajando</h5>
                  <p>Cuidando de ti y tu sonrisa.</p>
               </div>
            </div>
         </div>
      </div>
   </div>
   </div>
</section>

@include('layouts.citasDiarias')

@include('layouts.scripts')

@endsection
