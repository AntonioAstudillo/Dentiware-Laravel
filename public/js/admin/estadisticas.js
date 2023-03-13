   import {ruta} from '../config.js';

   window.onload = main;

   function main()
   {
      peticion(1);
      peticion(2);
      //lineChart();
      //comboChart();
   }

   function comboChart(datos)
   {
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawVisualization);

      function drawVisualization()
      {

         const data = new google.visualization.DataTable();

         data.addColumn('string', 'Year');
         data.addColumn('number', 'Score');

         datos.forEach((registro)=>{
            data.addRow([registro.fecha , parseInt(registro.cantidad)]);
         });


         const options = {
            title : 'Citas',
            vAxis: {title: 'Tazas'},
            hAxis: {title: 'Meses'},
            seriesType: 'bars',
            series: {5: {type: 'line'}}
         };

         const chart = new google.visualization.ComboChart(document.getElementById('chart_div'));
         chart.draw(data, options);
      }
    }

   function pieChart(datos)
   {

      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);



      function drawChart()
      {

         const data = new google.visualization.DataTable();

         data.addColumn('string', 'Tratamiento');
         data.addColumn('number', 'Pacientes');


         datos.forEach(dato => {
            data.addRow([ dato[0] , dato[1] ]);
         });


         const options = {
            title: 'Tratamientos',
            'width' : 1200 ,
            'height':800
         };

         const chart = new google.visualization.PieChart(document.getElementById('piechart'));

         chart.draw(data, options);
      }
   }


   function lineChart(){
      google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
         const data = google.visualization.arrayToDataTable([
            ['Meses', 'Ganancias'],
            ['2004',  1000],
            ['2005',  1170],
            ['2006',  660],
            ['2007',  1030]
         ]);

         const options = {
            title: 'Ganancias de la clínica',
            curveType: 'function',
            legend: { position: 'bottom' }
         };

         const chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

         chart.draw(data, options);
        }
   }


   function peticion(bandera)
   {
      const req = new XMLHttpRequest();

      switch (bandera) {
         //Case hecho para constuir el pie chart
         case 1:
            req.open('GET', ruta + "administrador/estadisticas/?bandera="+bandera);

            req.onreadystatechange = function () {

               if (req.readyState == 4 && req.status == 200 )
               {
                  let data = JSON.parse(req.responseText);
                  pieChart(data);
               }
            };
         break;
         case 2:
         //case hecho para constuir el combo chart
            req.open('GET', ruta + "administrador/estadisticas/?bandera="+bandera);

            req.onreadystatechange = function () {

               if (req.readyState == 4 && req.status == 200 )
               {
                  let data = JSON.parse(req.responseText);
                  comboChart(data);
               }
            };
         break;

      }


      req.send(null);

   }
