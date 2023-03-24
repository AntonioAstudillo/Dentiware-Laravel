@extends('admin.layouts.app')


@section('contenido')


<div class="content-wrapper">

    <div class="container">
        <div class="content-header text-left text-dark h5 lead ">Estadisticas </div>
        <div class="container">
            <div  id="piechart"></div>
        </div>
    </div>

</div>

@endsection




@section('scriptPagina')
    <!-- SCRIPT PARA GOOGLE CHARTS -->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
   <script src="{{asset('js/admin/estadisticas.js')}}" charset="utf-8" type="module"></script>
@endsection
