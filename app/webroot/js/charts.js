
google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
	  google.setOnLoadCallback(piechart);
	  google.setOnLoadCallback(barchart);
	  google.setOnLoadCallback(areachart);
	  google.setOnLoadCallback(donutchart);
	  
	  //bar chart
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Marks', 'Students', { role: 'style' }],
          ['0-5',  6,'#f79646'],
          ['6-10',  5,'#f79646'],
          ['11-15',  3,'#f79646'],
          ['16-20',  4,'#f79646'],
		  ['21-25',  3,'#f79646'],
          ['26-30',  6,'#f79646'],
          ['31-35',  5,'#f79646'],
		  ['36-40',  3,'#f79646'],
          ['41-45',  9,'#f79646'],
          ['46-50',  6,'#f79646']
        ]);
        var options = {};
        var chart = new google.visualization.ColumnChart(document.getElementById('chart_div'));
        chart.draw(data, {
          hAxis: {title: 'Marks Interval'},
		  vAxis: {title: 'Frequency (Number of students)', titleTextStyle: {color: '#666666'}},
		  colors: ['#ee6d05']
        });
      }	
		
	//pie chart
      function piechart() {
        var data = google.visualization.arrayToDataTable([
          ['Classes', 'Students', { role: 'style' }],
          ['0-10 Classes', 60,'#ee6d05'],
          ['10-20 Classes',25,'#f78928'],
          ['20-30 Classes', 10,'#f79f57'],
          ['30-40 Classes', 5,'#f9b785']
        ]);
        var options = {};
        var chart1 = new google.visualization.PieChart(document.getElementById('piechart'));
       chart1.draw(data, {
		  height: 400,
		  colors: ['#ee6d05', '#f78928', '#f79f57', '#f9b785'],
		  
		});
      }


	//bar chart
      function barchart() {
         var data = google.visualization.arrayToDataTable([
		['Answer', 'Reply'],
        ['Answer 1', 30],
		['Answer 2', 50],
		['Answer 3', 10],
		['Answer 4', 10]
      ]);
        var options = {};
        var chart2 = new google.visualization.BarChart(document.getElementById('chart_div2'));
        chart2.draw(data, {
		  colors: ['#ee6d05', '#f78928', '#f79f57', '#f9b785'],
		  is3D: true
		});
      }

	//area chart
	function areachart() {
        var data = google.visualization.arrayToDataTable([
          ['', 'max:60'],
          ['1',  50],
          ['2',  20],
          ['3',  35],
          ['4',  60],
          ['5',  45],
          ['6',  30],
          ['7',  10]
        ]);

        var options = {
          title: 'Graph',
          vAxis: {minValue: 0},
		  colors:['#f79646']
        };

        var chart3 = new google.visualization.AreaChart(document.getElementById('area_div'));
        chart3.draw(data, options);
      }
	  
	  //donut chart
	  function donutchart() {
        var data = google.visualization.arrayToDataTable([
          ['', '', { role: 'style' }],
          ['Attended',     70,'#f67b02'],
          ['Missed',      30,'#a0a0a0']
        ]);

        var options = {
          title: '',
          pieHole: 0.5,
		  colors: ['#ee6d05','#a0a0a0'],
		  height:400
        };

        var chart4 = new google.visualization.PieChart(document.getElementById('donutchart'));
        chart4.draw(data, options);
      }