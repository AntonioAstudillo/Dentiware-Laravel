   import {ruta} from '../config.js';


   window.onload = main;

   function main()
   {
      mostrarUsers();
      mostrarPagos();
      mostrarPagosCita();

      let btnRegister = document.getElementById('btnRegistrar');

      btnRegister.addEventListener('click' , registrarUsuario);
   }

   function mostrarPagosCita(){
      const tabla = $('#tablaPagosCita').DataTable( {
                  "ajax":{
                     "url": ruta + 'administrador/administrador/?bandera=7',
                     "dataSrc":""
                  },
                  'searching':false,
                  "responsive":true,
                  'language':{
                     'emptyTable':'No hay usuarios registrados',
                     'info': '',
                     'infoEmpty':'Mostrando 0 de 0 usuarios registrados',
                     'search':'',
                     'zeroRecords':'Sin resultados',
                     'paginate':{
                        'first':'Primero',
                        'last':'Último',
                        'next':'<button class="btn btn-outline-dark ms-2">Siguiente </button>',
                        'previous':'<button class="btn btn-outline-dark">Anterior </button>'
                     },
                     'lengthMenu':''
                  },
                  'pagingType': 'simple',
                  'lengthMenu': [[5,10,15,20,-1] , [5,10,15,20,'Todos']]
         });
   }

   function mostrarUsers()
   {
      const tabla = $('#tablaUsuarios').DataTable( {
                  "ajax":{
                     "url": ruta + 'administrador/administrador?bandera=1',
                     "dataSrc":""
                  },
                  'searching':false,
                  "responsive":true,
                  "columnDefs": [ {
                     "targets": 5 ,
                     "defaultContent": "<button class='mostrar btn btn-primary btn-sm' data-bs-toggle='modal' data-bs-target='#show'><i class='far fa-eye'></i></button> <button class='editar btn btn-warning btn-sm' data-bs-toggle='modal' data-bs-target='#edit'><i class='fas fa-pencil-alt fa-sm'></i></button> <button class='eliminar btn btn-danger btn-sm' data-bs-toggle='modal' data-bs-target='#delete'><i class='fas fa-trash-alt'></i></i></button>",
                  }],
                  'language':{
                     'emptyTable':'No hay usuarios registrados',
                     'info': '',
                     'infoEmpty':'Mostrando 0 de 0 usuarios registrados',
                     'search':'',
                     'zeroRecords':'Sin resultados',
                     'paginate':{
                        'first':'Primero',
                        'last':'Último',
                        'next':'<button class="btn btn-outline-dark ms-2">Siguiente </button>',
                        'previous':'<button class="btn btn-outline-dark">Anterior </button>'
                     },
                     'lengthMenu':''
                  },
                  'pagingType': 'simple',
                  'lengthMenu': [[5,10,15,20,-1] , [5,10,15,20,'Todos']]
         });


         const obtener_data_editar = function(tbody , tabla) {
            $(tbody).on('click' , 'tr' , function(e)
            {
               let data = tabla.row($(this)).data();

               if(e.target.classList.contains('mostrar') || e.target.classList.contains('fa-eye')  )
               {
                  getDataModalView(data , 1);

               }
               else if(e.target.classList.contains('editar') || e.target.classList.contains('fa-pencil-alt'))
               {
                  getDataModalView(data , 2);
               }else{
                  confirmDelete(data.idPersona);
               }
         });
      }

      obtener_data_editar('#tablaUsuarios' , tabla);

   }


   function mostrarPagos(){
      const tabla = $('#tablaPagos').DataTable( {
                  "ajax":{
                     "url": ruta + 'administrador/administrador/?bandera=6',
                     "dataSrc":""
                  },
                  'searching':false,
                  "responsive":true,
                  'language':{
                     'emptyTable':'No hay usuarios registrados',
                     'info': '',
                     'infoEmpty':'Mostrando 0 de 0 usuarios registrados',
                     'search':'',
                     'zeroRecords':'Sin resultados',
                     'paginate':{
                        'first':'Primero',
                        'last':'Último',
                        'next':'<button class="btn btn-outline-dark ms-2">Siguiente </button>',
                        'previous':'<button class="btn btn-outline-dark">Anterior </button>'
                     },
                     'lengthMenu':''
                  },
                  'pagingType': 'simple',
                  'lengthMenu': [[5,10,15,20,-1] , [5,10,15,20,'Todos']]
         });
   }



   function deleteUser(id)
   {
      let req = new XMLHttpRequest();
      let data = new FormData();

      data.append('idPersona' , id);

      req.open('POST', ruta + 'administrador/administrador/?bandera=5');

      req.onreadystatechange = function()
      {
         if(req.readyState == 4 && req.status == 200)
         {
            console.log(req.responseText);

            if(req.responseText == 'good')
            {
               Swal.fire(
                     'Buen trabajo!',
                     'Los datos del usuario se eliminaron correctamente!',
                     'success'
                  ).then(function(){
                     location.reload();
                  });
            }
            else
            {
               Swal.fire(
                     'Ups!',
                     'El proceso no se pudo concretar!',
                     'error'
                  );
            }
         }
      }

      req.send(data);
   }

   function confirmDelete(id)
   {
      Swal.fire({
         title: '¿Está seguro de eliminar de forma permanente a este usuario?',
         showDenyButton: true,
         showCancelButton: true,
         confirmButtonText: 'Si',
          denyButtonText: `No`,
      }).then((result) => {

         if (result.isConfirmed) {
            deleteUser(id);
         }else if (result.isDenied) {
            Swal.fire('El usuario no se eliminó', '', 'info')
         }
      });


   }


   function getDataModalView(data1 , bandera)
   {
      $.ajax({
         'url': ruta + 'administrador/administrador/?bandera=3',
         'type':'POST',
         'data': {
            id:data1.idPersona
         },
         'success': function(data2){

            if(data2)
            {
               switch(bandera)
               {
                  case 1:
                     llenarModalVista(data1 , data2);
                  break;
                  case 2:
                     llenarModalEditar(data1,data2);
                  break;
               }

            }
            else
            {
               alert('Houston tenemos un problema');
            }
         }
      });
   }


   function llenarModalEditar(data1 , data2){

      document.getElementById('nombreModal').value = data1.nombre;
      document.getElementById('passwordModal').disabled  = true;
      document.getElementById('apellidosModal').value = data1.apellidos;
      document.getElementById('telefonoModal').value = data1.telefono;
      document.getElementById('nicknameModal').value = data2.user;
      document.getElementById('correoModal').value = data1.correo;

      //Evento para actualizar los datos del usuario
      document.getElementById('btnGuardar').addEventListener('click' , function(){
         updateData(data1.idPersona);
      });

      //Evento para activar el input del password
      document.getElementById('btnPassword').addEventListener('click' , function(){
         document.getElementById('passwordModal').disabled  = false;
         localStorage.setItem('password', document.getElementById('passwordModal').value);
      });

      //Evento para activar el boton de guardar cambios
      document.getElementById('datosPaciente').addEventListener('change' , function(){
         document.getElementById('btnGuardar').disabled  = false;
      });

      document.getElementById('btnClose').addEventListener('click' , function(){
         data1 = null;
         data2 = null;
      })



   }

   function updateData(idPersona)
   {
      let req = new XMLHttpRequest();
      let data = new FormData();



      data.append('nombre' , document.getElementById('nombreModal').value);
      data.append('apellido' , document.getElementById('apellidosModal').value);
      data.append('telefono' , document.getElementById('telefonoModal').value);
      data.append('correo' , document.getElementById('correoModal').value);
      data.append('nickname' , document.getElementById('nicknameModal').value);
      data.append('idPersona' , idPersona);

      if(localStorage.getItem('password') != null)
      {
         data.append('password' , document.getElementById('passwordModal').value);
      }

      req.open('POST', ruta + 'administrador/administrador/?bandera=4');

      req.onreadystatechange = function()
      {
         if(req.readyState == 4 && req.status == 200)
         {
            console.log(req.responseText);

            if(req.responseText == 'good')
            {
               Swal.fire(
                     'Buen trabajo!',
                     'Los datos del usuario se modificaron correctamente!',
                     'success'
                  ).then(function(){
                     localStorage.clear();
                     location.reload();
                  });
            }
            else
            {
               Swal.fire(
                     'Ups!',
                     'El proceso no se pudo concretar!',
                     'error'
                  );
            }
         }
      }

      req.send(data);
   }

   function llenarModalVista(data1 , data2)
   {

      document.getElementById('perfilUser').src = `${ruta}images/dentistas/${data2.foto}`;
      document.getElementById('nombre').textContent = data1.nombre;
      document.getElementById('tipo').textContent = (data2.tipo == '1')  ? 'Administrador' : 'General';
      document.getElementById('nickname').textContent = data2.user;
      document.getElementById('correo').textContent = data1.correo;
      document.getElementById('telefono').textContent = data1.telefono;

   }
   //Mediante esta funcion voy a mandarle al controlador todos los datos que tenga el formulario via una peticion HTTPrequest
   function registrarUsuario(e)
   {
         let req = new XMLHttpRequest();
         let data = new FormData(document.getElementById('formUsuario'));

         req.open('POST', ruta + 'administrador/administrador/?bandera=2');

         req.onreadystatechange = function()
         {
            if(req.readyState == 4 && req.status == 200)
            {
               console.log(req.responseText);

               if(req.responseText == 'true')
               {
                  Swal.fire(
                        'Buen trabajo!',
                        'El usuario fue dado de alta correctamente!',
                        'success'
                     ).then(function(){
                        location.reload();
                     });
               }
               else
               {
                  Swal.fire(
                        'Ups!',
                        'El proceso no se pudo concretar!',
                        'error'
                     );
               }
            }
         }

         req.send(data);
         e.preventDefault();
      }
