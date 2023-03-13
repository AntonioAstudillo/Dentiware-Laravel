@extends('layouts.app')


@section('contenido')
   <section class="w3l-contact-main">
   <div class="contant11-top-bg py-5">
      <div class="container py-md-5">
         <div class="row contact-info-left text-center">
            <div class="col-lg-4 col-md-6 contact-info">
               <div class="contact-gd">
                  <span class="fa fa-location-arrow" aria-hidden="true"></span>
                  <h4>Ubicación</h4>
                  <p>Calle Mesa Central 620, Guadalajara, Jal.</p>
               </div>
            </div>
            <div class="col-lg-4 col-md-6 contact-info">
               <div class="contact-gd">
                  <span class="fa fa-phone" aria-hidden="true"></span>
                  <h4>Teléfono</h4>
                  <p><a href="tel:+52 7834 857829">+52 3332800827</a></p>
                  <p><a href="tel:+52 987 654 321">+52 3336516724</a></p>
               </div>
            </div>
            <div class="col-lg-4 col-md-6 contact-info">
               <div class="contact-gd">
                  <span class="fa fa-envelope-open-o" aria-hidden="true"></span>
                  <h4>Correo</h4>
                  <p><a href="mailto:contacto@dentiware.com" class="email">contacto@dentiware.com</a></p>
                  <p><a href="mailto:servicios@dentiware.com" class="email">servicios@dentiware.com</a></p>
               </div>
            </div>
         </div>
      </div>
</section>

<section class="w3l-contact-main">
   <div class="contact-infhny py-5">
      <div class="container py-lg-5">
         <div class="title-content text-left mb-lg-5 mt-4">
            <h6 class="sub-title">Nuestra ubicación</h6>
         </div>
         <div class="row align-form-map">
            <div class="map col-lg-12 pl-lg-12">
               <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3732.1985423382157!2d-103.31798888559804!3d20.702160804224523!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8428b1a6489e8631%3A0x44c429e0098e6b3d!2sC.%20Mesa%20Central%20620%2C%20San%20Vicente%2C%2044320%20Guadalajara%2C%20Jal.!5e0!3m2!1ses!2smx!4v1646244054335!5m2!1ses!2smx" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
            </div>
         </div>
      </div>
</section>


@include('layouts.scripts')
@endsection
