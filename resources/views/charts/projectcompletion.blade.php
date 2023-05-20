<script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Projects', 'Completed', 'Pending', 'Ongoing'],
          @for($i=0; $i<$count; $i++)
          ['{{ $projectname[$i] }}', {{ $completed[$i] }},  {{ $pending[$i] }}, {{ $ongoing[$i] }}], 
          @endfor
        ]);

        var options = {
          chart: {
            title: 'Project Completion Stages',
            subtitle: 'Project Completion by Status by (Pending, Ongoing and Completed)',
          }
        };

        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
      }
    </script>