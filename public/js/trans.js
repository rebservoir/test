
$("#btn_select").click(function(){
	var myYear = document.getElementById('year_select').value;
	var myMonth = document.getElementById('month_select').value;
  var route = "/finanzas/" +  myMonth + '/' + myYear;
    window.location.assign(route);
});

$("#btn_select_admin").click(function(){
  var myYear = document.getElementById('year_select').value;
  var myMonth = document.getElementById('month_select').value;
  var route = "/admin/finanzas/" +  myMonth + '/' + myYear;
    window.location.assign(route);
});

function loadChart(paga,deuda){

	    google.charts.load('current', {'packages':['corechart']});

      // Set a callback to run when the Google Visualization API is loaded.
      google.charts.setOnLoadCallback(drawChart);

      // Callback that creates and populates a data table,
      // instantiates the pie chart, passes in the data and
      // draws it.
      function drawChart(){

        // Create the data table.
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Topping');
        data.addColumn('number', 'Slices');
        data.addRows([
          ['Pagados', paga],
          ['Adeudos', deuda]
        ]);

        // Set chart options
        var options = {
          'title':'Pagos del Mes',
          'width':400,
          'height':400,
          pieHole:0.4,
        };

        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
}