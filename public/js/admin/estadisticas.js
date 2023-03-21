window.onload = main;

function main() {
    peticion(1);
}

function pieChart(datos) {
    google.charts.load("current", { packages: ["corechart"] });
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
        const data = new google.visualization.DataTable();

        data.addColumn("string", "Tratamiento");
        data.addColumn("number", "Pacientes");

        datos.forEach((dato) => {
            data.addRow([dato.nombre, dato.total]);
        });

        const options = {
            title: "Tratamientos",
            width: 1200,
            height: 800,
        };

        const chart = new google.visualization.PieChart(
            document.getElementById("piechart")
        );

        chart.draw(data, options);
    }
}

function peticion(bandera) {
    const req = new XMLHttpRequest();

    switch (bandera) {
        //Case hecho para constuir el pie chart
        case 1:
            req.open("GET", "/administrador/getData");

            req.onreadystatechange = function () {
                if (req.readyState == 4 && req.status == 200) {
                    let response = JSON.parse(req.responseText);
                    pieChart(response.data);
                }
            };
            break;
    }

    req.send(null);
}
