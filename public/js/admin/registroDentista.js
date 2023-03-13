   import {ruta} from '../config.js';


   window.onload = main;

   function main()
   {
      let boton = document.getElementById('btnTomar');
      let btnDentista = document.getElementById('btnDentista');
      let nombreDentista = document.getElementById('nombreDentista');
      let apellidoDentista = document.getElementById('apellidoDentista');
      let edadDentista = document.getElementById('edadDentista');
      let telefonoDentista = document.getElementById('telefonoDentista');
      let generoDentista = document.getElementById('generoDentista');
      let domicilioDentista = document.getElementById('domicilioDentista');
      let correoDentista = document.getElementById('correoDentista');
      let especialidadDentista = document.getElementById('especialidadDentista');
      let ssDentista = document.getElementById('ssDentista');
      let rfcDentista = document.getElementById('rfcDentista');
      let cedulaDentista = document.getElementById('cedulaDentista');
      let horarioDentista = document.getElementById('horarioDentista');
      let fechaIngreso = document.getElementById('fechaIngreso');
      let sueldoDentista = document.getElementById('sueldoDentista');
      let clabeDentista = document.getElementById('clabeDentista');
      let numCuentaBanco = document.getElementById('numCuentaBanco');

      nombreDentista.addEventListener('change' , validarNombre);
      apellidoDentista.addEventListener('change', validarNombre);
      edadDentista.addEventListener('change' , validarEdad);
      telefonoDentista.addEventListener('change',validarTelefono);
      generoDentista.addEventListener('change',validarGenero);
      domicilioDentista.addEventListener('change',validarDomicilio);
      correoDentista.addEventListener('change',validarCorreo);
      especialidadDentista.addEventListener('change',validarEspecialidad);
      ssDentista.addEventListener('change',validarNSS);
      rfcDentista.addEventListener('change',validarRFC);
      cedulaDentista.addEventListener('change',validarDatosBancarios);
      sueldoDentista.addEventListener('change',validarDatosBancarios);
      clabeDentista.addEventListener('change',validarDatosBancarios);
      numCuentaBanco.addEventListener('change',validarDatosBancarios);
      // boton.addEventListener('click' , tomarFoto);
      btnDentista.addEventListener('click' , registrarDentista);
   }

   //Con esta funcion voy a validar el sueldo, clabe bancaria , numero de cuenta y la cedula profesional
   function validarDatosBancarios(e)
   {
      let expresion = /^[0-9]+$/g;
      let valor = e.target.value;

      if(expresion.test(valor))
      {
         if(!e.target.classList.contains('is-valid'))
         {
            if(e.target.classList.contains('is-invalid'))
            {
               e.target.classList.remove('is-invalid');
            }

            e.target.classList.add('is-valid');
         }

      }
      else
      {
         if(!e.target.classList.contains('is-invalid'))
         {
            if(e.target.classList.contains('is-valid'))
            {
               e.target.classList.remove('is-valid');
            }

            e.target.classList.add('is-invalid');
         }
      }

   }

   function validarRFC(e){
      let expresion = /^[a-zA-Z0-9]+$/g;
      let valor = e.target.value;

      if(expresion.test(valor))
      {
         if(!e.target.classList.contains('is-valid'))
         {
            if(e.target.classList.contains('is-invalid'))
            {
               e.target.classList.remove('is-invalid');
            }

            e.target.classList.add('is-valid');
         }

      }
      else
      {
         if(!e.target.classList.contains('is-invalid'))
         {
            if(e.target.classList.contains('is-valid'))
            {
               e.target.classList.remove('is-valid');
            }

            e.target.classList.add('is-invalid');
         }
      }

   }

   function validarEspecialidad(e){
      let valor = e.target.value;

      if(valor == 0 )
      {
         if(!e.target.classList.contains('is-invalid'))
         {
            if(e.target.classList.contains('is-valid'))
            {
               e.target.classList.remove('is-valid');
            }

            e.target.classList.add('is-invalid');
         }
      }
      else
      {
         if(!e.target.classList.contains('is-valid'))
         {
            if(e.target.classList.contains('is-invalid'))
            {
               e.target.classList.remove('is-invalid');
            }

            e.target.classList.add('is-valid');
         }
      }
   }

   /*Bloque de funciones para validar datos*/
   function validarNombre(e)
   {
      let expresion = /^([a-zA-Z]+)(\s)?([a-zA-Z]+)?$/g;
      let valor = e.target.value;


      if(expresion.test(valor))
      {
         if(!e.target.classList.contains('is-valid'))
         {
            if(e.target.classList.contains('is-invalid'))
            {
               e.target.classList.remove('is-invalid');
            }

            e.target.classList.add('is-valid');
         }

      }
      else
      {
         if(!e.target.classList.contains('is-invalid'))
         {
            if(e.target.classList.contains('is-valid'))
            {
               e.target.classList.remove('is-valid');
            }

            e.target.classList.add('is-invalid');
         }
      }

   }

   function validarEdad(e)
   {
      let expresion = /^([0-99]+)$/g;

      let valor = e.target.value;


      if(expresion.test(valor))
      {
         if(!e.target.classList.contains('is-valid'))
         {
            if(e.target.classList.contains('is-invalid'))
            {
               e.target.classList.remove('is-invalid');
            }

            e.target.classList.add('is-valid');
         }

      }
      else
      {
         if(!e.target.classList.contains('is-invalid'))
         {
            if(e.target.classList.contains('is-valid'))
            {
               e.target.classList.remove('is-valid');
            }

            e.target.classList.add('is-invalid');
         }
      }
   }

   function validarNSS(e)
   {
      let expresion = /^[0-9]{11}$/g;

      let valor = e.target.value;

      if(expresion.test(valor))
      {
         if(!e.target.classList.contains('is-valid'))
         {
            if(e.target.classList.contains('is-invalid'))
            {
               e.target.classList.remove('is-invalid');
            }

            e.target.classList.add('is-valid');
         }

      }
      else
      {
         if(!e.target.classList.contains('is-invalid'))
         {
            if(e.target.classList.contains('is-valid'))
            {
               e.target.classList.remove('is-valid');
            }

            e.target.classList.add('is-invalid');
         }
      }
   }

   function validarTelefono(e)
   {
      let expresion = /^[0-9]{10}$/g;

      let valor = e.target.value;


      if(expresion.test(valor))
      {
         if(!e.target.classList.contains('is-valid'))
         {
            if(e.target.classList.contains('is-invalid'))
            {
               e.target.classList.remove('is-invalid');
            }

            e.target.classList.add('is-valid');
         }

      }
      else
      {
         if(!e.target.classList.contains('is-invalid'))
         {
            if(e.target.classList.contains('is-valid'))
            {
               e.target.classList.remove('is-valid');
            }

            e.target.classList.add('is-invalid');
         }
      }
   }


   function validarDomicilio(e){
      let expresion = /^([a-zA-Z0-9#,]\s?)+$/g;

      let valor = e.target.value;


      if(expresion.test(valor))
      {
         if(!e.target.classList.contains('is-valid'))
         {
            if(e.target.classList.contains('is-invalid'))
            {
               e.target.classList.remove('is-invalid');
            }

            e.target.classList.add('is-valid');
         }

      }
      else
      {
         if(!e.target.classList.contains('is-invalid'))
         {
            if(e.target.classList.contains('is-valid'))
            {
               e.target.classList.remove('is-valid');
            }

            e.target.classList.add('is-invalid');
         }
      }
   }

   function validarGenero()
   {
      let valor = document.getElementById('generoDentista');

      if(valor.value == 'N')
      {
         if(!valor.classList.contains('is-valid'))
         {
            valor.classList.add('is-invalid');
         }else{
            valor.classList.remove('is-valid');
         }

         valor.classList.add('is-invalid');

      }
      else
      {
         if(valor.classList.contains('is-invalid'))
         {
            valor.classList.remove('is-invalid');
         }

         valor.classList.add('is-valid');
      }
   }


   function validarCorreo(e)
   {
      let expresion = /^(([^<>()[\]\.,&%$#!=?¡¿;:\s@\"]+(\.[^<>()[\]\.,&%$#!=?¡¿;:\s@\"]+)*)|(\".+\")){2,63}@(hotmail.com|gmail.com|uteg.edu.mx|dentiware.com)$/i
      let valor = e.target.value;
      let req = new XMLHttpRequest();
      let formData = new FormData();

      formData.append('correo' , valor);

      req.open('POST', ruta + 'administrador/validarCorreoDentista');

      req.onreadystatechange = function()
      {
         if(req.readyState == 4 && req.status == 200)
         {
            if(req.responseText == 1)
            {
               e.target.classList.add('is-invalid');

               Swal.fire({
                  position: 'top-end',
                  icon: 'error',
                  title: 'Ese correo ya está registrado',
                  showConfirmButton: false,
                  timer: 1500
               });
            }
            else
            {
               if(expresion.test(valor))
               {
                  if(!e.target.classList.contains('is-valid'))
                  {
                     if(e.target.classList.contains('is-invalid'))
                     {
                        e.target.classList.remove('is-invalid');
                     }

                     e.target.classList.add('is-valid');
                  }

               }
               else
               {
                  if(!e.target.classList.contains('is-invalid'))
                  {
                     if(e.target.classList.contains('is-valid'))
                     {
                        e.target.classList.remove('is-valid');
                     }

                     e.target.classList.add('is-invalid');
                  }
               }
            }
         }
      }

      req.send(formData);
      e.preventDefault();
   }
   /*Fin de bloque de instruciones para validar datos*/

   //Mediante esta funcion voy a mandarle al controlador todos los datos que tenga el formulario via una peticion HTTPrequest
   function registrarDentista(e){
      let req = new XMLHttpRequest();
      let data = new FormData(document.getElementById('formDentista'));

      req.open('POST', ruta + 'administrador/registroDentista');

      req.onreadystatechange = function()
      {
         if(req.readyState == 4 && req.status == 200)
         {
            console.log(req.responseText);

            if(req.responseText == 'good')
            {
               Swal.fire(
                     'Buen trabajo!',
                     'El dentista fue dado de alta correctamente!',
                     'success'
                  ).then(function(){
                     document.getElementById('formDentista').reset();
                     limpiarEstilos();
                  });
            }else if(req.responseText == 'false1'){
               Swal.fire({
                  position: 'top-end',
                  icon: 'error',
                  title: 'Debe seleccionar una imagen',
                  showConfirmButton: false,
                  timer: 1500
                })
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


   function limpiarEstilos(){

      let nombreDentista = document.getElementById('nombreDentista');
      let apellidoDentista = document.getElementById('apellidoDentista');
      let edadDentista = document.getElementById('edadDentista');
      let telefonoDentista = document.getElementById('telefonoDentista');
      let generoDentista = document.getElementById('generoDentista');
      let domicilioDentista = document.getElementById('domicilioDentista');
      let correoDentista = document.getElementById('correoDentista');
      let especialidadDentista = document.getElementById('especialidadDentista');
      let ssDentista = document.getElementById('ssDentista');
      let rfcDentista = document.getElementById('rfcDentista');
      let cedulaDentista = document.getElementById('cedulaDentista');
      let horarioDentista = document.getElementById('horarioDentista');
      let sueldoDentista = document.getElementById('sueldoDentista');
      let clabeDentista = document.getElementById('clabeDentista');
      let numCuentaBanco = document.getElementById('numCuentaBanco');

      nombreDentista.classList.contains('is-valid') ? nombreDentista.classList.remove('is-valid') : '';
      apellidoDentista.classList.contains('is-valid') ? apellidoDentista.classList.remove('is-valid') : '';
      edadDentista.classList.contains('is-valid') ? edadDentista.classList.remove('is-valid') : '';
      telefonoDentista.classList.contains('is-valid') ? telefonoDentista.classList.remove('is-valid') : '';
      generoDentista.classList.contains('is-valid') ? generoDentista.classList.remove('is-valid') : '';
      domicilioDentista.classList.contains('is-valid') ? domicilioDentista.classList.remove('is-valid') : '';
      correoDentista.classList.contains('is-valid') ? correoDentista.classList.remove('is-valid') : '';
      especialidadDentista.classList.contains('is-valid') ? especialidadDentista.classList.remove('is-valid') : '';
      ssDentista.classList.contains('is-valid') ? ssDentista.classList.remove('is-valid') : '';
      rfcDentista.classList.contains('is-valid') ? rfcDentista.classList.remove('is-valid') : '';
      cedulaDentista.classList.contains('is-valid') ? cedulaDentista.classList.remove('is-valid') : '';
      horarioDentista.classList.contains('is-valid') ? horarioDentista.classList.remove('is-valid') : '';
      sueldoDentista.classList.contains('is-valid') ? sueldoDentista.classList.remove('is-valid') : '';
      clabeDentista.classList.contains('is-valid') ? clabeDentista.classList.remove('is-valid') : '';
      numCuentaBanco.classList.contains('is-valid') ? numCuentaBanco.classList.remove('is-valid') : '';
   }
