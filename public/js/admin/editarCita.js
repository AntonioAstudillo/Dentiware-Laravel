   import {ruta} from '../config.js';

   window.onload = main;

   function main()
   {
      cargarCitas();
   }

   function cargarCitas()
   {
      const tabla = $('#tablaEditarCita').DataTable( {
               "ajax":{
                  "url": ruta + 'administrador/getPagoCitas',
                  "dataSrc":""
               },
               "responsive":true,
               "columnDefs": [
                  {
                     'targets':1,
                     'visible':false,
                     'searchable':false,
                  },
                  {
                     "targets": 8 ,
                     "defaultContent": "<button class='editar btn btn-warning btn-sm' data-bs-toggle='modal' data-bs-target='#editCita'><i class='fas fa-book-medical'></i></button>",

                  }
               ],
               'language':{
                  'emptyTable':'No hay citas registradas',
                  'info': '',
                  'infoEmpty':'Mostrando 0 de 0 citas registradas',
                  'search':'Buscar:',
                  'zeroRecords':'Sin resultados',
                  'paginate':{
                     'first':'Primero',
                     'last':'Último',
                     'next':'<button class="btn btn-outline-dark ms-2">Siguiente </button>',
                     'previous':'<button class="btn btn-outline-dark">Anterior </button> '

                  },
                  "infoFiltered": "",
                  "infoPostFix": "",
                  'lengthMenu':'_MENU_'
               },
               'pagingType': 'simple',
               'lengthMenu': [[5,10,15,20,-1] , [5,10,15,20,'Todos']]
      });

      const obtener_data_editar = function(tbody , tabla)
      {
         let data;
         $(tbody).on('click' , 'tr' , function()
         {
            data = tabla.row($(this)).data();
            let fechaCita = document.getElementById('fechaCita');
            let horaCita = document.getElementById('horaCita');

            //Llenamos elementos dentro del modal
            llenarSelectTratamiento();
            llenarNombrePaciente(data);

            //Validamos el dia y la hora de la cita.
            fechaCita.addEventListener('change' , validarFecha);
            horaCita.addEventListener('change',validarHora);

            //Generamos eventos
            document.getElementById('tratamientoPaciente').addEventListener('change',llenarSelectDentista);

          });

          document.getElementById('btnGuardar').addEventListener('click',function(){
             updateCita(data);
          });
      }

   obtener_data_editar('#tablaEditarCita' , tabla);

}//cierra funcion cargaCitas


//Con este metodo lleno dentro del modal el nombre del paciente
function llenarNombrePaciente(data){
   document.getElementById('nombrePaciente').value = data['nombre'];
}

/*En esta función, voy a llenar el select de tratamiento por medio de una peticion a la BD*/
function llenarSelectTratamiento(){
   //Instanciamos la clase XMLHttpRequest()
   let req = new XMLHttpRequest();
   let cadena = "<option selected disabled value = 'e'>Elige un tratamiento</option>";

   req.open('POST', ruta + 'administrador/getTratamientos');

   req.onreadystatechange = function(){

      if(req.status == 200 && req.readyState == 4)
      {
         let valor = JSON.parse(req.responseText);

         for (let i = 0; i < valor.length; i++) {
            cadena += `<option value = "${i}">${valor[i]['nombre']}</option>`;
         }

         document.getElementById('tratamientoPaciente').innerHTML = cadena;
      }

   }

   req.send(null);

}//cierra funcion llenarSelectTratamiento


function validarHora(e){

   const valor = e.target.value;
   const aux = valor.split(':');

   if(aux[0] < 9 || aux[0] > 21)
   {
      if(document.getElementById('horaCita').classList.contains('is-valid'))
      {
         document.getElementById('horaCita').classList.remove('is-valid');
      }

      document.getElementById('horaCita').classList.add('is-invalid');

   }
   else
   {
      if(document.getElementById('horaCita').classList.contains('is-invalid'))
      {
         document.getElementById('horaCita').classList.remove('is-invalid');
      }

      document.getElementById('horaCita').classList.add('is-valid');
   }

}


function validarFecha(){
   let valor = document.getElementById('fechaCita').value;


   if(moment(valor).isBefore(moment().format('YYYY-MM-D')))
   {

      if(document.getElementById('fechaCita').classList.contains('is-valid'))
      {
         document.getElementById('fechaCita').classList.remove('is-valid');
      }

      document.getElementById('fechaCita').classList.add('is-invalid');

   }
   else
   {
      if(document.getElementById('fechaCita').classList.contains('is-invalid'))
      {
         document.getElementById('fechaCita').classList.remove('is-invalid');
      }

      document.getElementById('fechaCita').classList.add('is-valid');
   }

}

function llenarSelectDentista()
{
   // Instanciamos la clase XMLHttpRequest()
   let req = new XMLHttpRequest();
   let cadena = "<option selected disabled>Elige un dentista</option>";
   let cargo = document.getElementById('tratamientoPaciente').value;

   req.open('GET', ruta +'administrador/llenarSelectDentista/?cargo='+cargo);

   req.onreadystatechange = function(){

      if(req.status == 200 && req.readyState == 4)
      {
         let valor = JSON.parse(req.responseText);

         for (let i = 0; i < valor.length; i++) {
            cadena += `<option value = "${valor[i]['idPersona']}">${valor[i]['nombre']} ${valor[i]['apellidos']}</option>`;
         }

         document.getElementById('dentistaPaciente').innerHTML = cadena;
      }

   }

   req.send();
}

function updateCita(data)
{

   const req = new XMLHttpRequest();
   const formData = new FormData();



   //Agregamos los datos al objeto formData
   formData.append('dentistaPaciente' ,document.getElementById('dentistaPaciente').value );
   formData.append('tratamientoPaciente' ,document.getElementById('tratamientoPaciente').value );
   formData.append('fechaCita' ,document.getElementById('fechaCita').value );
   formData.append('horaCita' ,document.getElementById('horaCita').value );
   formData.append('comentario',document.getElementById('comentariosPaciente').value)
   formData.append('idPaciente' ,data[0]);

   req.open('POST', ruta + 'administrador/updateCita');

   req.onreadystatechange = function()
   {
      if(req.readyState == 4 && req.status == 200)
      {
         console.log(req.responseText);

         if(req.responseText === 'good'){
            mensajeRegistroGood('La cita se modificó con éxito!')
         }else if(req.responseText === 'cita'){
            mensajeError('Fecha y hora ocupadas');
         }else{
            mensajeError('Houston tenemos problemas ');
         }


      }
   }

   req.send(formData);
}

function mensajeError(mensaje){
   Swal.fire({
      position: 'top-end',
      icon: 'error',
      title: mensaje,
      showConfirmButton: false,
      timer: 1500
   });
}

function mensajeRegistroGood(mensaje){

   Swal.fire(
         'Buen trabajo!',
         mensaje,
         'success'
      ).then(function(){
         window.location.reload();
      });
}
