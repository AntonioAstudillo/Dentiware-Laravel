   import {ruta} from '../config.js';

   $(document).ready(function() {

      const tabla = $('#tablaPacientes').DataTable( {
               "ajax":{
                  "url":ruta + 'administrador/getAllPacientes',
                  "dataSrc":""
               },
               "responsive":true,
               "columnDefs": [ {
                  "targets": 8 ,
                  "defaultContent": "<button class='editar btn btn-warning btn-sm'><i class='fas fa-pencil-alt fa-sm'></i></button>",
               }],
               'language':{
                  'emptyTable':'No hay pacientes registrados',
                  'info': '',
                  'infoEmpty':'Mostrando 0 de 0 pacientes registrados',
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


      const obtener_data_editar = function(tbody , tabla)
      {
         $(tbody).on('click' , 'tr' ,

            function()
            {
               let data = tabla.row($(this)).data();

               //mostramos modal
               $('#editUser').modal('show');

               llenarFormulario(data);


            });
         }

      //Es una función con la cual obtengo los datos del registro asociados al boton editar que se presiono dentro del datatable.
      obtener_data_editar('#tablaPacientes' , tabla);


      document.getElementById('btnCerrar').addEventListener('click' , function(){
         $('#editUser').modal('hide');
      });

      //Le agregamos al boton de guardar el evento de click
      document.getElementById('btnGuardar').addEventListener('click' , function(){
         actualizarDatos();
      });

   });


   //Funciones
   function actualizarDatos(){

      $.ajax({
         'url': ruta + 'administrador/actualizarDatosPaciente',
         'type':'POST',
         'data': {
            nombre:document.getElementById('nombre').value,
            apellidos:document.getElementById('apellidos').value,
            edad:document.getElementById('edad').value,
            telefono:document.getElementById('telefono').value,
            correo:document.getElementById('correo').value,
            direccion:document.getElementById('direccion').value,
            genero:document.getElementById('genero').value,
            id:document.getElementById('idUsuario').value
         },
         'success': function(data){
            if(data>0)
            {
               $('#editUser').modal('hide');
               const table = $('#tablaPacientes').DataTable();
               table.ajax.reload();

               Swal.fire(
                     'Buen trabajo!',
                     'Los datos del paciente se modificaron correctamente!',
                     'success'
                  );
            }
         }
      });
   }

   function llenarFormulario(data)
   {
      document.getElementById('nombre').value = data['nombre'];
      document.getElementById('apellidos').value = data['apellidos'];
      document.getElementById('edad').value = data['edad'];
      document.getElementById('telefono').value = data['telefono'];
      document.getElementById('correo').value = data['correo'];
      document.getElementById('direccion').value = data['direccion'];
      document.getElementById('idUsuario').value = data['idPersona'];

      if(data['genero'] == "M"){
         document.getElementById('genero').innerHTML = `<option class="form-control" value="M" selected>Masculino</option>
         <option class="form-control" value="F">Femenino</option>`;
      }else{
         document.getElementById('genero').innerHTML = `<option class="form-control" value="M">Masculino</option>
         <option class="form-control" value="F" selected>Femenino</option>`;
      }
   }
