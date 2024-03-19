// Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#292b2c';

// Función para generar el gráfico de barras con los datos de ventas
function generarGraficoBarras(ventas) {
  var meses = [];
  var datos = [];

  // Extraer los datos de las ventas
  ventas.forEach(function(venta) {
      meses.push(venta.fecha);
      datos.push(venta.total);
  });

  // Obtener el contexto del gráfico de barras
  var ctx = document.getElementById("myBarChartMes").getContext("2d");

  // Configuración y generación del gráfico de barras
  var myBarChart = new Chart(ctx, {
      type: 'bar',
      data: {
          labels: meses,
          datasets: [{
              label: "Ventas por mes",
              backgroundColor: "rgba(2,117,216,1)",
              borderColor: "rgba(2,117,216,1)",
              data: datos,
          }]
      },
      options: {
          scales: {
              xAxes: [{
                  gridLines: {
                      display: false
                  }
              }],
              yAxes: [{
                  ticks: {
                      beginAtZero: true
                  }
              }]
          },
          legend: {
              display: false
          }
      }
  });
}

$.ajax({
  url: '../functions/query.php',
  method: 'GET',
  success: function(response) {
    try {
      // Intenta analizar la respuesta JSON
      var ventas = JSON.parse(response);
      
      // Llama a la función para generar el gráfico de barras
      generarGraficoBarras(ventas);
    } catch (error) {
      console.error('Error al procesar los datos de ventas:', error);
    }
  },
  error: function(xhr, status, error) {
    console.error('Error al obtener los datos de ventas:', error);
  }
});


// Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#292b2c';

// Bar Chart Example
var ctx = document.getElementById("myBarChartDepartamento");
var myLineChart = new Chart(ctx, {
  type: 'bar',
  data: {
    labels: ["January", "February", "March", "April", "May", "June"],
    datasets: [{
      label: "Revenue",
      backgroundColor: "rgba(2,117,216,1)",
      borderColor: "rgba(2,117,216,1)",
      data: [4215, 5312, 6251, 7841, 9821, 14984],
    }],
  },
  options: {
    scales: {
      xAxes: [{
        time: {
          unit: 'month'
        },
        gridLines: {
          display: false
        },
        ticks: {
          maxTicksLimit: 6
        }
      }],
      yAxes: [{
        ticks: {
          min: 0,
          max: 15000,
          maxTicksLimit: 5
        },
        gridLines: {
          display: true
        }
      }],
    },
    legend: {
      display: false
    }
  }
});

