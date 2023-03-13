<footer class="w3l-footer-66">
   <!-- footer -->
   <div class="footer-66-info">
      <div class="container">
         <div class="row footer-top">
            <div class="col-lg-4 footer-grid_section_w3layouts pr-lg-5">
               <h2 class="logo-2 mb-lg-4 mb-3">
                  <a class="navbar-brand" href="index.html"><span>Denti</span>Ware</a>
               </h2>
               <p>Clinica Dental Dr. Armando Torres Torres México S.A. de C.V. <br>Calle MESA CENTRAL, número ext. 620, Colonia BELISARIO DOMINGUEZ. Jalisco, México . C.P. 44320. Localidad Guadalajara.</p>
               <h4 class="sub-con-fo ad-info my-4">Nuestras redes sociales</h4>
               <ul class="w3layouts_social_list list-unstyled">
                  <li>
                     <a target="_blank" href="https://www.facebook.com/Dentfer-Cl%C3%ADnica-Dental-112671450142247" class="w3pvt_facebook">
                        <span class="fa fa-facebook-f"></span>
                     </a>
                  </li>
                  <li>
                     <a target="_blank" href="https://twitter.com/cdental4" class="w3pvt_twitter">
                        <span class="fa fa-twitter"></span>
                     </a>
                  </li>
                  <li>
                     <a target="_blank" href="https://www.youtube.com/channel/UCCgofm_2h-2hyOsyg8H2eIw" class="w3pvt_google">
                        <span class="fa fa-youtube-play"></span>
                     </a>
                  </li>
               </ul>
            </div>
            <div class="col-lg-8 footer-right">
               <div class="w3layouts-news-letter">
                  <h3 class="footer-title mb-0">Informes</h3>

                  <p class="mb-3">Al suscribirse a nuestra lista de correo, siempre recibirá nuestras últimas noticias y actualizaciones.
                  </p>
                  <form action="#" method="post" class="w3layouts-newsletter">
                     <input type="email" id="correoNoticias"placeholder="Ingresa tu correo..." required="">
                     <button id="btnNoticias" class="btn1">Suscribirse</button>
                  </form>
               </div>
               <div class="bottom-w3layouts-sec-nav">
                  <div class="row sub-content-botom mx-0">
                     <div class="col-md-4 footer-grid_section_w3layouts pl-lg-0">
                        <h3 class="footer-title">Información</h3>
                        <ul class="footer list-unstyled">
                           <li>
                              <a href="{{route('home')}}">Inicio</a>
                           </li>
                           <li>
                              <a href="{{route('about')}}">Sobre Nosotros</a>
                           </li>
                           <li>
                              <a href="{{route('services')}}">Servicios</a>
                           </li>
                           <li>
                              <a href="{{route('contacto')}}">Contacto</a>
                           </li>
                        </ul>
                     </div>
                     <div class="col-md-4 footer-grid_section_w3layouts">
                        <!-- social icons -->

                        <h3 class="footer-title">Tratamientos</h3>
                        <ul class="footer list-unstyled">

                           <li>
                              <a href="{{route('service' , ['id' => 'Odontología-Preventiva' ]  )}}">Odontología Preventiva</a>
                           </li>
                           <li>
                              <a href="{{route('service' , ['id' =>  'Odontología-Pediatrica' ]  )}}">Odontología Infantil</a>
                           </li>
                           <li>
                              <a href="{{route('service' , ['id' => 'Limpieza-Dental']  )}}">Limpieza Bucal</a>
                           </li>
                           <li>
                              <a href="{{route('service' , ['id' => 'Extracciones']  )}}">Extracción de Dientes</a>
                           </li>
                           <li>
                              <a href="{{route('service' , ['id' => 'Implantes-Dentales']  )}}">Implantes Dentales</a>
                           </li>
                           <li>
                              <a href="{{route('service' , ['id' => 'Amalgamas']  )}}">Amalgamas</a>
                           </li>

                        </ul>

                        <!-- social icons -->
                     </div>
                     <div class="col-md-4 footer-grid_section_w3layouts ">
                        <h3 class="footer-title">Horario</h3>
                        <ul class="wrk-schedule-block">
                           <li>Lunes<span class="schedule-time">09:00 – 21:00</span></li>
                           <li>Martes<span class="schedule-time">09:00 – 21:00</span></li>
                           <li>Miercoles<span class="schedule-time">09:00 – 21:00</span></li>
                           <li>Jueves<span class="schedule-time">09:00 – 21:00</span></li>
                           <li>Viernes<span class="schedule-time">09:00 – 21:00</span></li>
                           <li>Sabados<span class="schedule-time">09:00 - 14:00</span></li>
                           <li>Domingos<span class="schedule-time">09:00 - 14:00</span></li>
                        </ul>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="cpy-right py-3">
      <p class="text-center">© {{ now()->year }} Dentiware Todos los derechos reservados</p>
   </div>
   <!-- move top -->
   <button id="movetop" title="Go to top">
      <span class="fa fa-level-up"></span>
   </button>
   <!-- /move top -->
</footer>
