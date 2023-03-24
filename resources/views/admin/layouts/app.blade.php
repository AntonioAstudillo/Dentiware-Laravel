<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>DentiWare</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"/>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <!-- Theme style -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
  <link rel="stylesheet" href="//cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.2.0/css/adminlte.min.css" integrity="sha512-IuO+tczf4J43RzbCMEFggCWW5JuX78IrCJRFFBoQEXNvGI6gkUw4OjuwMidiS4Lm9Q2lILzpJwZuMWuSEeT9UQ==" crossorigin="anonymous" referrerpolicy="no-referrer"/>
  <link rel="stylesheet" href="{{asset('css/admin/estilos.css')}}">

  <style>
    .errorDiv{
        display: none;
    }
  </style>


</head>

<body>
    <div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-dark">
      <ul class="navbar-nav">
         <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
         </li>
      </ul>

      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link" data-widget="fullscreen" href="#" role="button">
            <i class="fas fa-expand-arrows-alt"></i>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-slide="true" href="{{route('logout')}}" role="button">
            <i class="fas fa-sign-out-alt"></i>
          </a>
        </li>
      </ul>

  </nav>
  <!-- CIERRA Navbar -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a  href="{{route('admin.index')}}" class="brand-link text-center">
       <span class="brand-text font-weight-dark text-center">Dentiware</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
       <!-- Sidebar user panel (optional) -->
       <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
             <img src="{{asset('images/perfil/AdminLTELogo.png')}}" class="img-circle elevation-2" alt="User Image">
          </div>
          <div class="info">
             <a href="#" class="d-block">{{auth()->user()->name}}</a>
          </div>
       </div>

       <!-- Sidebar Menu -->
       <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
             <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="fas fa-user-plus"></i>
                  <p>Registrar
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{route('admin.index')}}" class="nav-link">
                      <i class="fas fa-user"></i>
                      <p>Pacientes</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{route('admin.registraDentista')}}" class="nav-link">
                      <i class="fas fa-user-md"></i>
                      <p>Dentistas</p>
                    </a>
                  </li>
                </ul>
             </li>

             <li class="nav-item">
                <a href="" class="nav-link">
                  <i class="fas fa-user-edit"></i>
                  <p>
                    Editar
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{route('admin.editarPaciente')}}" class="nav-link">
                      <i class="fas fa-user"></i>
                      <p>Pacientes</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{route('admin.editarDentista')}}" class="nav-link">
                      <i class="fas fa-user-md"></i>
                      <p>Dentistas</p>
                    </a>
                  </li>
                </ul>
             </li>

             <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="fas fa-trash-alt"></i>
                  <p>
                    Eliminar
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{route('admin.eliminarPaciente')}}" class="nav-link">
                      <i class="fas fa-user"></i>
                      <p>Pacientes</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{route('admin.eliminarDentista')}}" class="nav-link">
                      <i class="fas fa-user-md"></i>
                      <p>Dentistas</p>
                    </a>
                  </li>
                </ul>
             </li>


             <li class="nav-item">
                 <a href="#" class="nav-link">
                   <i class="fas fa-search"></i>
                   <p>
                     Buscar
                     <i class="right fas fa-angle-left"></i>
                   </p>
                 </a>
                 <ul class="nav nav-treeview">
                   <li class="nav-item">
                     <a href="{{route('admin.buscarPaciente')}}" class="nav-link">
                       <i class="fas fa-user"></i>
                       <p>Pacientes</p>
                     </a>
                   </li>
                   <li class="nav-item">
                     <a href="{{route('admin.buscarDentista')}}" class="nav-link">
                       <i class="fas fa-user-md"></i>
                       <p>Dentistas</p>
                     </a>
                   </li>
                 </ul>
             </li>

             <li class="nav-item">
                 <a href="#" class="nav-link">
                   <i class="fas fa-cash-register"></i>
                   <p>
                     Finanzas
                     <i class="right fas fa-angle-left"></i>
                   </p>
                 </a>
                 <ul class="nav nav-treeview">
                   <li class="nav-item">
                     <a href="{{route('admin.nomina')}}" class="nav-link">
                       <i class="fas fa-wallet"></i>
                       <p>Nómina</p>
                     </a>
                   </li>
                   <li class="nav-item">
                     <a href="{{route('admin.pagoCita')}}" class="nav-link">
                       <i class="fas fa-money-bill"></i>
                       <p>Citas</p>
                     </a>
                   </li>
                 </ul>
             </li>

             <li class="nav-item">
                <a href="#" class="nav-link">
                   <i class="fas fa-hospital"></i>
                   <p>
                     Citas
                     <i class="right fas fa-angle-left"></i>
                   </p>
                </a>
                <ul class="nav nav-treeview">
                 <li class="nav-item">
                    <a href="{{route('admin.createCita')}}" class="nav-link">
                      <i class="fas fa-plus"></i>
                      <p>Crear</p>
                    </a>
                 </li>
                 <li class="nav-item">
                    <a href="{{route('admin.editarCita')}}" class="nav-link">
                     <i class="fas fa-edit"></i>
                      <p>Editar</p>
                    </a>
                 </li>
                </ul>
             </li>

             <li class="nav-item">
                <a href="{{route('admin.estadisticas')}}" class="nav-link">
                   <i class="fas fa-chart-area"></i>
                   <p>
                     Estadísticas
                   </p>
                </a>
             </li>

            <li class="nav-item">
                <a href="{{route('admin.administrador')}}" class="nav-link">
                    <i class="fas fa-user-shield"></i>
                    <p>
                       Administrador
                    </p>
                </a>
            </li>

          </ul>
       </nav>
       <!-- /.sidebar-menu -->
    </div>

    </aside>
    <!-- /.sidebar -->

    @yield('contenido')

    <!-- Main Footer -->
    <footer class="main-footer">
        <div class="text-center">
            <strong>Copyright &copy; {{now()->year}} DentiWare - </strong> Todos los derechos reservados.
        </div>
    </footer>

    @include('admin.layouts.scripts')
    @yield('scriptPagina')
</div>
</body>
