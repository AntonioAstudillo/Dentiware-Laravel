
   import {ruta} from '../config.js';



   $(document).ready(function() {

      const tabla = $('#tablaPacientes').DataTable( {
               "ajax":{
                  "url": ruta + 'administrador/getAllDentistas',
                  "dataSrc":""
               },
               "responsive":true,
               "columnDefs": [ {
                  "targets": 17 ,
                  "data": null,
                  "defaultContent": "<button class='editar btn btn-warning btn-sm' data-bs-toggle='modal' data-bs-target='#editUser'><i class='fas fa-pencil-alt fa-sm'></i></button>",
               }],
               "columns":[
                  {data :'idPersona'},
                  {data:'nombre'},
                  {data:'apellidos'},
                  {data:'edad'},
                  {data:'telefono'},
                  {data:'correo'},
                  {data:'direccion'},
                  {data:'genero'},
                  {data:'cargo'},
                  {data:'turno'},
                  {data:'fechaIngreso'},
                  {
                     data:'sueldo',
                     render: DataTable.render.number( ',' , ',' , '2' , '$ ' )
                  },
                  {data:'numSocial'},
                  {data:'rfc'},
                  {data:'cedula'},
                  {data:'clabe'},
                  {data:'cuentaBancaria'},
                  {"defaultContent": "<button class='editar btn btn-warning btn-sm'><i class='fas fa-pencil-alt fa-sm'></i></button>"}
               ],
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

      const obtener_data_editar = function(tbody , tabla)
      {
         $(tbody).on('click' , 'button' , function()
         {
            let data = tabla.row($(this)).data();
            llenarFormulario(data);

               $('#editUser').modal('show');

         });
      }


      //Le agregamos al boton de guardar el evento de click
      document.getElementById('btnGuardar').addEventListener('click' , function(){
         actualizarDatos();
      });

      //Es una función con la cual obtengo los datos del registro asociados al boton editar que se presiono dentro del datatable.
      obtener_data_editar('#tablaPacientes' , tabla);

   });


   //Funciones
   function actualizarDatos(){
      $.ajax({
         'async':false,
         'url': ruta + 'administrador/actualizarDatosDentista',
         'type':'POST',
         'data': {
            nombre:document.getElementById('nombre').value,
            apellidos:document.getElementById('apellidos').value,
            edad:document.getElementById('edad').value,
            telefono:document.getElementById('telefono').value,
            correo:document.getElementById('correo').value,
            direccion:document.getElementById('direccion').value,
            genero:document.getElementById('genero').value,
            id:document.getElementById('idDentista').value,
            especialidad: document.getElementById('especialidad').value,
            clabe: document.getElementById('clabe').value,
            numCuenta:document.getElementById('bank').value,
            sueldo:document.getElementById('sueldo').value,
            fechaIngreso:document.getElementById('fechaIngreso').value,
            rfc:document.getElementById('rfc').value,
            cedula:document.getElementById('cedula').value,
            nss:document.getElementById('nss').value,
            turno:document.getElementById('turno').value,
         },
         'success': function(data){
            if(data)
            {
               console.log(data);
               $('#editUser').modal('hide');

               const table = $('#tablaPacientes').DataTable();

               table.ajax.reload();

               Swal.fire(
                     'Buen trabajo!',
                     'Los datos del dentista se modificaron correctamente!',
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
      document.getElementById('especialidad').value = data['cargo'];
      document.getElementById('clabe').value = data['clabe'];
      document.getElementById('bank').value = data['cuentaBancaria'];
      document.getElementById('sueldo').value = data['sueldo'];
      document.getElementById('fechaIngreso').value = data['fechaIngreso'];
      document.getElementById('rfc').value = data['rfc'];
      document.getElementById('cedula').value = data['cedula'];
      document.getElementById('nss').value = data['numSocial'];
      document.getElementById('idDentista').value = data['idPersona'];

      if(data['genero'] === "M"){
         document.getElementById('genero').innerHTML = `<option class="form-control" value="M" selected>Masculino</option>
         <option class="form-control" value="F">Femenino</option>`;
      }else{
         document.getElementById('genero').innerHTML = `<option class="form-control" value="M">Masculino</option>
         <option class="form-control" value="F" selected>Femenino</option>`;
      }

      if(data['turno'] === "Vespertino"){
         document.getElementById('turno').innerHTML = `<option class="form-control" value="Vespertino" selected>Vespertino</option>
         <option class="form-control" value="Diurno">Diurno</option>`;
      }else{
         document.getElementById('turno').innerHTML = `<option class="form-control" value="Diurno" selected>Diurno</option>
         <option class="form-control" value="Vespertino">Vespertino</option>`;
      }

      document.getElementById('especialidad').innerHTML = `<option value="${data['cargo']}" disabled selected>${data['cargo']}</option>
      <option value="1">Odontopediatra</option>
      <option value="2">Peridoncista</option>
      <option value="3">Cirujano Maxilofacial</option>
      <option value="3">Cirujano Dentista</option>
      <option value="4">Dentista general</option>
      <option value="5">Odontologo</option>`;
   }
