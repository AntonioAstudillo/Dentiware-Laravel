@extends('layouts.app')

@section('contenido')
   <nav id="breadcrumbs" class="breadcrumbs">
   <div class="container page-wrapper">
   </div>
</nav>

<div class="w3l-services-block py-5" id="classes">
   <div class="container py-lg-5 py-md-5">
      <section class="features-4">
         <main id="main" class="main-page">
          <!-- ======= Speaker Details Sectionn ======= -->

         @if(count($data) <=0 )
            <section id="speakers-details">
              <div class="container">
                 <div class="section-header">
                    <h2>Sin resultados</h2>
                    <p>El mejor equipo para tu cuidado.</p>
                 </div>

                 <div class="row">
                    <div class="col-md-12">
                       <img src="{{ asset('images/tratamientos/not-found.jpg') }}" alt="Speaker 1" class="img-fluid">
                    </div>
                 </div>

                 <div class="row">
                    <div class="col-md-12">
                       <div class="details">
                          <h2 class="mt-2">$<span>0</span></h2>
                          <div class="social disabled-link ">
                             <a href=""><i class="bi bi-emoji-smile-fill"></i></a>
                             <a href=""><i class="bi bi-shield-fill-check"></i></a>
                             <a href=""><i class="bi bi-star-fill"></i></a>
                             <a href=""><i class="bi bi-check-square-fill"></i></a>
                          </div>
                          <div class="container border-0">
                             <p class="descripcion ">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                          </div>
                       </div>
                    </div>
                 </div>

              </div>
            </section>
         @else
            @foreach ($data as $servicio ) @endforeach
            <section id="speakers-details">
              <div class="container">
                 <div class="section-header">
                    <h2>{{ $servicio->nombre }} </h2>
                    <p>El mejor equipo para tu cuidado.</p>
                 </div>

                 <div class="row">
                    <div class="col-md-12">
                       <img src="{{ asset('images/tratamientos/' . $servicio->imagen . '') }}" alt="Speaker 1" class="img-fluid">
                    </div>
                 </div>

                 <div class="row">
                    <div class="col-md-12">
                       <div class="details">
                          <h2 class="mt-2">$<span>{{ $servicio->precio }}  </span></h2>
                          <div class="social disabled-link ">
                             <a href=""><i class="bi bi-emoji-smile-fill"></i></a>
                             <a href=""><i class="bi bi-shield-fill-check"></i></a>
                             <a href=""><i class="bi bi-star-fill"></i></a>
                             <a href=""><i class="bi bi-check-square-fill"></i></a>
                          </div>
                          <div class="container border-0">
                             <p class="descripcion ">{{ $servicio->descripcion }} </p>
                          </div>
                       </div>
                    </div>
                 </div>

              </div>
            </section>
         @endif



         </main><!-- End #main -->
      </section>
   </div>
</div>
@endsection

@include('layouts/scripts')
