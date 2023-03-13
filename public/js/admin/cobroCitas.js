   import {ruta} from '../config.js';

   window.onload = main;

   function main()
   {
      cargarCitas();
   }

   function cargarCitas()
   {
      const tabla = $('#tablaPagoCitas').DataTable( {
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
                     "defaultContent": "<button class='editar btn btn-primary btn-sm' data-bs-toggle='modal' data-bs-target='#showDentist'><i class='fas fa-eye'></i></button> <button class='editar btn btn-success btn-sm' data-bs-toggle='modal' data-bs-target='#payConsult'><i class='fas fa-money-bill'></i></button>",

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
               obtenerDatosDentista(data[0] , data[1]);
               llenarModalPago(data);
         });


         btnPago.addEventListener('click' , function(e){

            let cantidadServicio = parseFloat(document.getElementById('cantidadServicio').value);
            let dineroIngresado = parseFloat(document.getElementById('abonoServicio').value);

            if(cantidadServicio>dineroIngresado){
               Swal.fire({
                  position: 'top-center',
                  icon: 'error',
                  title: 'Cantidad incorrecta',
                  showConfirmButton: false,
                  timer: 1500
               })
            }else{
               //Le añado al objeto un atributo más el cual corresponde a la referencia del recibo

               data.reciboServicio = document.getElementById('reciboServicio').textContent;
               data.cantidadServicio = cantidadServicio;
               data.dineroIngresado = dineroIngresado;
               data.cambioServicio =  dineroIngresado - cantidadServicio;
               generarPago(data);
            }

         });
      }



   obtener_data_editar('#tablaPagoCitas' , tabla);

}//cierra funcion cargaCitas

function llenarModalDentista(data){
   document.getElementById('idPersona').value = data[0]['idPersona'];
   document.getElementById('nombre').value = data[0]['nombre'];
   document.getElementById('edad').value = data[0]['edad'];
   document.getElementById('cargo').value = data[0]['cargo'];
   document.getElementById('turno').value = data[0]['turno'];
   document.getElementById('correo').value = data[0]['correo'];
}

function obtenerDatosDentista(idCita , idPersona){

   $.ajax({
      'url': ruta + 'administrador/getDataDentista',
      'type':'POST',
      'data': {
         'idCita':idCita,
         'idPersona':idPersona
      },
      'success': function(data){
         if(data !== 'false')
         {
            llenarModalDentista(data)
         }else{
            alert('no entra');
         }
      }
   });
}

function llenarModalPago(data)
{
   let fecha = new Date();
   let btnPago = document.getElementById('btnPago');
   let abono = document.getElementById('abonoServicio');
   let cambio = document.getElementById('cambioServicio');
   let fechaPago = moment().format('DD MMMM YY, h:mm:ss a');
   let reciboServicio = getRandom() + getCharacter();


   //Llenamos los datos del modal.
   document.getElementById('cantidadServicio').value = data[6];
   document.getElementById('fechaPago').textContent = fechaPago;
   document.getElementById('reciboServicio').textContent = reciboServicio;
   document.getElementById('servicioPago').textContent = data[7];
   document.getElementById('precioServicio').textContent = data[6];
   document.getElementById('totalServicio').textContent = '$' + data[6];


   //Definimos los eventos tanto para el cambio como para el boton de generar pago
   abono.addEventListener('change' , function(e){
      //Lo que hago aqui, es generar el cambio
      let valor = parseFloat(e.target.value);

      valor = valor - parseFloat(data[6]) ;

      cambio.value = valor;
   })


}//cierra funcion llenarModalPago


function generarPago(data)
{

   const req = new XMLHttpRequest();
   const formData = new FormData();

   //Agregamos los datos al objeto formData
   formData.append('cantidad' , data.cantidadServicio);
   formData.append('hora' , data.hora);
   formData.append('fecha' , data.fecha);
   formData.append('folio' , data.reciboServicio);
   formData.append('idCita' , data[0]);
   formData.append('idPaciente' , data[1]);

   req.open('POST', ruta + 'administrador/generarPagoCita');

   req.onreadystatechange = function()
   {
      if(req.readyState == 4 && req.status == 200)
      {
         console.log(req.responseText);
         if(req.responseText){
            Swal.fire(
                  'Buen trabajo!',
                  'El pago se efectuó correctamente!',
                  'success'
               ).then(function(){
                  //Aqui debemos generar el pdf
                  getSaldo(data);
               });
         }else{
            Swal.fire(
                  'Ups!',
                  'Tuvimos problemas al procesar el pago!',
                  'error'
               ).then(function(){
                  // window.location.reload();
               });
         }


      }
   }

   req.send(formData);
}

function getSaldo(data){
   const req = new XMLHttpRequest();
   const formData = new FormData();

   //Agregamos los datos al objeto formData

   formData.append('idPaciente' , data[1]);

   req.open('POST', ruta + 'administrador/getSaldo');

   req.onreadystatechange = function()
   {
      if(req.readyState == 4 && req.status == 200)
      {
         console.log(req.responseText);

         if(req.responseText)
         {
            const doc = new jsPDF('p', 'mm', [150, 150]);

            doc.text(20, 20, 'FOLIO: '+data.reciboServicio);
            doc.text(20, 30, 'FECHA DE PAGO: '+moment().format('DD MMMM YY, h:mm:ss a'));
            doc.text(20, 40, 'PACIENTE: '+data[4]);
            doc.text(20, 50, 'TRATAMIENTO: '+data[7]);
            doc.text(20, 60, 'CANTIDAD: '+data.cantidadServicio);
            doc.text(20, 70, 'Recibido: '+data.dineroIngresado);
            doc.text(20, 80, 'CAMBIO: '+data.cambioServicio);
            doc.text(20, 90, 'SALDO: 0');
            doc.text(20, 100, 'AGRADECEMOS SU PREFERENCIA');
            doc.save(data.reciboServicio);
            window.location.reload();
         }
         else{
            Swal.fire(
                  'Ups!',
                  'Tuvimos problemas al procesar el pago !',
                  'error'
               ).then(function(){
                  // window.location.reload();
               });
         }


      }
   }

   req.send(formData);
}



function getRandom(){
   return Math.round(Math.random() * 999999999 - 100 + 100);
}

function getCharacter(){
   const letras = ['q','e','w','r','t','y','u','i','o','p','a','s','d','f','g','h','j','k','l','ñ','z','x','c','v','b','n','n','m'];

   let valor = Math.round(Math.random() * ((letras.length-1) - 1) + 1);

   return letras[valor];


}
