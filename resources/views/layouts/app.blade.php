<!doctype html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<title>Dentiware</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="Clinica Dental del Doctor Armando Torres Torres Soluciones en un solo lugar para todos los problemas dentales">
	<meta name="keywords" content="Clinica Dental, Guadalajara, Limpieza Bucal, Cuida tus dientes , Ortodoncía , Implantes Dentales"/>
	<meta name="author" content="Antonio Astudillo"/>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">

    <link rel="stylesheet" href="{{asset('css/all.css')}}">
	<link href="//fonts.googleapis.com/css?family=Poppins:300,400,400i,500,600,700&display=swap" rel="stylesheet">
</head>
<body>
   <section class="w3l-top-header-content">
      <div class="hny-top-menu">
         <div class="container">
            <div class="row">
               <div class="top-left col-lg-6">
                  <ul class="accounts">
                     <li class="top_li">
                        <span class="fa fa-map-o"></span>
                        <a href="#">Mesa Central No. 620</a>
                     </li>
                     <li class="top_li mr-lg-0"><span class="fa fa-envelope-o"></span>
                        <a href="mailto:mail@company.com" class="mail">contacto@dentiware.com</a>
                     </li>
                  </ul>
               </div>
               <div class="social-top col-lg-6 mt-lg-0 mt-sm-3">
                  <div class="top-bar-text"><a class="bk-button" href="{{route('login')  }}">Ingresa</a></div>
               </div>

            </div>
         </div>
      </div>
   </section>


   <header class="w3l-header-nav">
      <!--/nav-->
      <nav class="navbar navbar-expand-lg navbar-light px-lg-0 py-0 px-3 stroke">
         <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}"><span>Denti</span>ware</a>
            <button class="navbar-toggler collapsed" type="button" data-toggle="collapse"
               data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
               aria-label="Toggle navigation">
               <span class="fa icon-expand fa-bars"></span>
               <span class="fa icon-close fa-times"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
               <ul class="navbar-nav mx-lg-auto">
                  <li class="nav-item active">
                     <a class="nav-link" href="{{ route('home') }}">Inicio</a>
                  </li>
                  <li class="nav-item">
                     <a class="nav-link" href="{{ route('about') }}">Sobre Nosotros</a>
                  </li>
                  <li class="nav-item">
                     <a class="nav-link" href="{{ route('services') }}">Servicios</a>
                  </li>

                  <li class="nav-item">
                     <a class="nav-link" href="{{ route('contacto') }}">Contacto</a>
                  </li>
               </ul>
               <div class="call-support">
                  <p>Llámanos para una cita</p>
                  <h5>33-36-51-67-24</h5>
               </div>
            </div>
         </div>
      </nav>
      <!--//nav-->
   </header>

   @yield('contenido')

   @include('layouts.footer')

   @yield('scripts')

</body>
