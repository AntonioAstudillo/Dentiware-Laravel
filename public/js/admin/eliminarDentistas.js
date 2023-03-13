   import {ruta} from '../config.js';


   $(document).ready(function() {

      const tabla = $('#tablaPacientes').DataTable( {
               "ajax":{
                  "url":ruta + 'administrador/getAllDentistas',
                  "dataSrc":""
               },
               "responsive":true,
               "columnDefs": [ {
                  "targets": 8 ,
                  "data": null,
                  "defaultContent": "<button class='eliminar btn btn-danger btn-sm' data-bs-toggle='modal' data-bs-target='#deleteUser'><i class='fas fa-trash-alt'></i></button>",
               }],
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

      const obtener_data_editar = function(tbody , tabla) {
         $(tbody).on('click' , 'tr' , function(){

            let data = tabla.row($(this)).data();
            document.getElementById('idDentista').value = data['idPersona'];

      });


      document.getElementById('btnEliminar').addEventListener('click' , function(){
         eliminarPaciente();
      });
   }

   //Esta funcion es importante, ya que con ella yo puedo acceder al evento de eliminar Paciente
   obtener_data_editar('#tablaPacientes' , tabla);

   });


   function eliminarPaciente(idPaciente){


      //obtenemos el id del dentista
      //
      const idDentista = document.getElementById('idDentista').value;

      $.ajax({
         'url': ruta + 'administrador/eliminarDentista',
         'type':'POST',
         'data': {
            id:idDentista
         },
         'success': function(data){

            if(data === 'true'){
               Swal.fire(
                     'Buen trabajo!',
                     'Los datos del dentista se eliminaron correctamente!',
                     'success'
                  ).then(function(){
                     window.location.reload();
                  });
            }else{
               Swal.fire(
                     'Ups!',
                     'Los datos del dentista no se pudieron eliminar!',
                     'error'
                  ).then(function(){
                     window.location.reload();
                  });
            }
         }
      });
   }
