   import {ruta} from '../config.js';

      $(document).ready(function() {

         const tabla = $('#tablaPacientes').DataTable( {
                  "ajax":{
                     "url": ruta + 'administrador/getDentistas',
                     "dataSrc":""
                  },
                  "responsive":true,
                  'language':{
                     'emptyTable':'No hay dentistas registrados',
                     'info': '',
                     'infoEmpty':'Mostrando 0 de 0 dentistas registrados',
                     'search':'Buscar:',
                     'zeroRecords':'Sin resultados',
                     'paginate':{
                        'first':'Primero',
                        'last':'Último',
                        'next':'<button class="btn btn-outline-dark ms-2">Siguiente </button>',
                        'previous':'<button class="btn btn-outline-dark">Anterior </button>'
                     },
                     'lengthMenu':'_MENU_'
                  },
                  'pagingType': 'simple',
                  'lengthMenu': [[5,10,15,20,-1] , [5,10,15,20,'Todos']]
         });
      });
