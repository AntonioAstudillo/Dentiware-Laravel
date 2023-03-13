@extends('layouts.app')


@section('contenido')
   <section class="w3l-main-slider" id="home">
		<div class="banner-content">
			<div class="owl-one owl-carousel owl-theme">
				<div class="item">
					<li>
						<div class="slider-info banner-view bg bg2">
							<div class="banner-info">
								<div class="container">
									<div class="banner-info-bg">
										<h6>Cuidado dental de por vida</h6>
										<h5>Experiencia, confianza y éxito comprobado.</h5>
										<a class="btn mt-sm-5 mt-4" href="{{route('services')}}">Mira nuestros servicios</a>
									</div>
								</div>
							</div>
						</div>
					</li>
				</div>
				<div class="item">
					<li>
						<div class="slider-info  banner-view banner-top1 bg bg2">
							<div class="banner-info">
								<div class="container">
									<div class="banner-info-bg">
										<h6>Cuidado dental de por vida</h6>
										<h5>No te compliques, solo sonríe</h5>
										<a class="btn mt-sm-5 mt-4" href="{{route('services')}}">Mira nuestros servicios</a>
									</div>
								</div>
							</div>
						</div>
					</li>
				</div>
				<div class="item">
					<li>
						<div class="slider-info banner-view banner-top2 bg bg2">
							<div class="banner-info">
								<div class="container">
									<div class="banner-info-bg">
										<h6>Cuidado dental de por vida</h6>
										<h5>Sonríe más, paga menos.</h5>
										<a class="btn mt-sm-5 mt-4" href="{{route('services')}}">Mira nuestros servicios</a>
									</div>
								</div>
							</div>
						</div>
					</li>
				</div>
				<div class="item">
					<li>
						<div class="slider-info banner-view banner-top3 bg bg2">
							<div class="banner-info">
								<div class="container">
									<div class="banner-info-bg">
										<h6>Cuida tu sonrisa</h6>
										<h5>Obtén un cuidado esencial</h5>
										<a class="btn mt-sm-5 mt-4" href="{{route('services')}}">Mira nuestros servicios</a>
									</div>
								</div>
							</div>
						</div>
					</li>
				</div>
			</div>
			<ul class="slide-social-icons list-unstyled">
				<li class="share">Redes Sociales: </li>
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
	</section>


   <!-- /main-slider -->
   <section class="w3l-content-6">
      <!-- /content-6-main-->
      <div class="content-6-mian py-5">
         <div class="container py-lg-5">
            <div class="title-content text-left mb-4">
               <h6 class="sub-title">Sobre Nosotros</h6>
               <h3 class="hny-title">Bienvenido a nuestra página</h3>
            </div>
            <div class="content-info-in row">
               <div class="content-gd col-lg-6 pl-lg-4 pl-lg-4">
                  <p>Nuestros especialistas están formados para el uso de la tecnología más avanzada y trabajan conjuntamente y a diario mediante sesión clínica, lo que nos permite ofrecer el mejor diagnóstico y unos tratamientos de calidad a un precio competitivo.</p>
               </div>
               <div class="content-gd col-lg-6 pl-lg-4">
                  <p>Nuestro objetivo es resolver cada problema individual con la mayor atención y experiencia posible, de acuerdo con las últimas tecnologías dentales. Todo dentro del presupuesto que este en tus posibilidades.</p>
               </div>
            </div>
      </div>
   </section>
   <!-- services block3 -->
   <div class="w3l-open-block-services py-5">
      <div class="container py-lg-5 pt-4">
         <div class="row">
            <div class="col-lg-3 col-md-6">
               <div class="card text-center">
                  <div class="icon-holder">
                     <span class="fa fa-signal service-icon" aria-hidden="true"></span>
                  </div>
                  <h4 class="mission">Prótesis Dental</h4>
                  <div class="open-description">
                     <p>Las Prótesis dentales son elementos que se utilizan para sustituir los dientes ausentes o parte de su estructura.</p>
                     <a href="{{ route('service' , ['id' => 'Implantes-Dentales' ]) }}">Leer más</a>
                  </div>
               </div>
            </div>
            <div class="col-lg-3 col-md-6 mt-md-0 mt-5 pt-md-0 pt-3">
               <div class="card text-center">
                  <div class="icon-holder">
                     <span class="fa fa-assistive-listening-systems service-icon" aria-hidden="true"></span>
                  </div>
                  <h4 class="mission">Odontopediatría</h4>
                  <div class="open-description">
                     <p>Cuida la salud bucal de tus hijos para evitar problemas futuros</p>
                     <a href="{{ route('service' , ['id' => 'Odontología-Pediatrica']) }}">Leer más</a>
                  </div>
               </div>
            </div>
            <div class="col-lg-3 col-md-6 mt-lg-0 mt-5 pt-lg-0 pt-3">
               <div class="card text-center">
                  <div class="icon-holder">
                     <span class="fa fa-diamond service-icon" aria-hidden="true"></span>
                  </div>
                  <h4 class="mission">Periodoncia</h4>
                  <div class="open-description">
                     <p>Es la especialidad de la odontología que se encarga del diagnóstico y posterior tratamiento de los tejidos que rodean al diente</p>
                     <a href="{{ route('service' , ['id' => 'Terapia-Periodontal']) }}">Leer más</a>
                  </div>
               </div>
            </div>
            <div class="col-lg-3 col-md-6 mt-lg-0 mt-5 pt-lg-0 pt-3">
               <div class="card text-center">
                  <div class="icon-holder">
                     <span class="fa fa-magic service-icon" aria-hidden="true"></span>
                  </div>
                  <h4 class="mission">Ortodoncia</h4>
                  <div class="open-description">
                     <p>Es la especialidad de la odontología que se ocupa de la corrección de la posición de dientes y de los problemas en la forma de ocluir.</p>
                     <a href="{{ route('service' , ['id' => 'Odontología-Preventiva']) }}">Leer más</a>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>

   <section class="w3l-content-with-photo-4">
      <div class="content-photo-info py-5">
         <div class="container py-lg-5">
            <div class="content-photo-grids row">

               <div class="photo-6-inf-right col-lg-6 text-left pr-lg-5 mb-lg-0 mb-4">
                  <h6 class="sub-title">Cuidamos tu sonrisa</h6>
                  <h3 class="hny-title">Servicios de salud dental</h3>
                  <div class="servehny-1 mt-4">
                     <div class="ser-sub">
                        <a href="" class="ser1"><span class="fa fa-check"></span>Familia y general odontología</a>
                        <a href="" class="ser1"><span class="fa fa-check"></span>Implantes dentales
                        </a>
                        <a href="" class="ser1"><span class="fa fa-check"></span>Odontología cosmetica
                        </a>
                        <a href="" class="ser1"><span class="fa fa-check"></span> Uso de la mejor calidad de instrumentos.</a>
                     </div>
                     <div class="ser-sub">
                        <a href="" class="ser1"><span class="fa fa-check"></span> Servicios dentales de emergencia</a>
                        <a href="" class="ser1"><span class="fa fa-check"></span>Cirugía dental</a>

                        <a href="" class="ser1"><span class="fa fa-check"></span>Blanqueamiento de dientes</a>
                     </div>
                  </div>
                  <div class="read">
                     <a class="btn mt-4" href="{{ route('services') }}">Conoce nuestros servicios</a>
                  </div>
               </div>
               <div class="photo-6-inf-left col-lg-6 pr-lg-4">
                  <a href="{{ route('services') }}"><img src="{{ asset('images/g1.jpg') }}" class="img-fluid" alt=""></a>
               </div>
            </div>
         </div>
      </div>
   </section>


  @include('layouts.citasDiarias')


<section class="w3l-about5">
   <div class="container-fluid px-0">
      <div class="history-info position-relative">
         <div class="heading text-center mx-auto">
            <h3 class="hny-title two">Creando la sonrisa saludable que deseas a través de la ciencia y el arte.</h3>
            <p class="mt-3">Sin olvidar que, además de profesionales con gran potencial, nuestro personal ha sido escogido por sus valores. Buscamos buenas personas que se preocupen por sus pacientes, que quieran superarse y que compartan nuestro código ético.</p>
         </div>

      </div>
   </div>
</section>
<!--/testimonials-->
<section class="w3l-free-consultion">
   <div class="container">
      <div class="consultation-grids">
         <div class="apply-form">
            <h5>OBTENER CONSULTA GRATIS</h5>
            <form id="formConsulta" autocomplete="off">
               <div class="admission-form">
                  <div class="form-group">
                     <input type="text"  maxlength="200" class="form-control" id="nombre" name='nombre' placeholder="Nombre Completo" required>
                  </div>
                  <div class="form-group">
                     <input type="text"  maxlength="15"  class="form-control" id="telefono" name='telefono' placeholder="Número de teléfono" required>
                  </div>
                  <div class="form-group">
                     <input type="email" maxlength="100" class="form-control" id="correo" name='correo' placeholder="Correo electrónico" required>
                  </div>
                  <!-- ESTE SELECT LO VAMOS A LLENAR DE FORMA DINAMICA CON PHP -->
                  <select id="tipoTratamiento" name="tipoTratamiento" class="form-select">
                     <option selected disabled value="">Tratamientos</option>
                     <option value="Odontología Cosmetica">Odontología Cosmética</option>
                     <option value="Odontología Pediatrica">Odontología Pediatrica</option>
                     <option value="Odontología Preventiva">Odontología Preventiva</option>
                     <option value="Implantes Dentales">Implantes Dentales</option>
                     <option value="Terapia Periodontal">Terapia Periodontal</option>
                     <option value="Limpieza Dental">Limpieza Dental</option>
                     <option value="Amalgamas">Amalgamas</option>
                     <option value="Resinas">Resinas</option>
                     <option value="Extracciones">Extracciones</option>
                     <option value="Coronas Dentales">Coronas dentales</option>
                     <option value="Blanqueamiento Dental ">Blanqueamiento dental</option>
                  </select>
               </div>
               <div class="form-group">
                  <textarea id="mensaje" name="Comment" class="form-control" placeholder="Mensaje" required=""></textarea>
               </div>
               <button type="button" id="btnConsultaFree" class="btn btn-primary submit">Obtener</button>
               <div class="d-flex justify-content-center">
                  <div id="spinner" style="display:none;" class="spinner-border text-danger" role="status">
                    <span class="sr-only">Loading...</span>
                  </div>
               </div>
            </form>
         </div>
         <div class="consultation-img">
            <img src="{{asset('images/ab.jpg')}}" class="img-fluid" alt="/">
         </div>
      </div>
   </div>
</section>
<section class="w3l-testimonials" id="testimonials">
   <div class="testimonials py-lg-5 py-4">
      <div class="container py-lg-5">
         <div class="row pb-lg-4 pb-5">
            <div class="col-md-10 mx-auto">
               <div class="owl-two owl-carousel owl-theme">
                  <div class="item">
                     <div class="slider-info mt-lg-4 mt-3">
                        <div class="text-content">
                           <div class="test-left">
                              <div class="img-circle">
                                 <img src="{{asset('images/c1.jpg')}}" class="img-fluid testimonial-img"
                                    alt="client">
                              </div>
                              <div class="name">
                                 <h4>Ernesto Hernandez</h4>
                              </div>
                           </div>
                           <div class="message">
                              <div class="quote-icon">
                                 <span class="fa fa-quote-left" aria-hidden="true"></span>
                              </div>
                              <p>Gracias al tratamiento de ortodoncia que tuve con ellos, hoy puedo sonreír con confianza.</p>

                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="item">
                     <div class="slider-info mt-lg-4 mt-3">
                        <div class="text-content">
                           <div class="test-left">
                              <div class="img-circle">
                                 <img src="{{asset('images/c2.jpg')}}" class="img-fluid testimonial-img"
                                    alt="client">
                              </div>
                              <div class="name">
                                 <h4>Sara De la O</h4>
                              </div>
                           </div>
                           <div class="message">
                              <div class="quote-icon"><span class="fa fa-quote-left"
                                    aria-hidden="true"></span></div>
                              <p>Los precios que manejan son súper accesibles.</p>

                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="item">
                     <div class="slider-info mt-lg-4 mt-3">
                        <div class="text-content">
                           <div class="test-left">
                              <div class="img-circle">
                                 <img src="{{asset('images/c4.jpg')}}" class="img-fluid testimonial-img"
                                    alt="client">
                              </div>
                              <div class="name">
                                 <h4>Gloria Leaño</h4>
                              </div>
                           </div>
                           <div class="message">
                              <div class="quote-icon"><span class="fa fa-quote-left"
                                    aria-hidden="true"></span></div>
                              <p>Mi hija ya no le tiene miedo al dentista y sus dientes están sanos y se ven absolutamente hermosos.</p>

                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</section>
<!--//testimonials-->

@endsection

@include('layouts.scripts')
