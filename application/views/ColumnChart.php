 <?php
$chartData=array();
$chartData[]=array('Qusetion No.','Time Consumed (in Min.)');
$timetaken=explode(",",$result['time_taken']);
$correct_answer=explode(",",$result['correct_answer']);
foreach($timetaken as $key => $t1)
{
if($correct_answer[$key]=="1")
{
$status="Correct";
}
else
{
$status="InCorrect";
}
$chartData[]=array('Q.'.($key+1).' '.$status, substr($t1/60,0,4)/1 );
}



$jsonData=json_encode($chartData);

?>
<script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
         var data = google.visualization.arrayToDataTable(<?php echo $jsonData;?>);

     
        var options = {
          title: 'Performance Chart | Time Consumed per Question and Status',
          hAxis: {title: 'Question No.', titleTextStyle: {color: 'red'}}
        };

        var chart = new google.visualization.ColumnChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
    </script>
  
  
    <div id="chart_div" style="width: 950px; height: 500px;"></div>

 
    
     
	 <br/>	
	</div>

	
</div>
