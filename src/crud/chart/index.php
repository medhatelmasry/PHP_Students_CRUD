<?php include("../../inc_header.php"); ?>

<h1>Students Chart</h1>

<?php
include("../../inc_db_params.php");
mysqli_select_db($conn, $db_name);
$dataPoints = [];

if ($conn !== FALSE) {
     $SQLstring = "SELECT school, COUNT(*) as count FROM Students GROUP BY School";
     if ($QueryResult = @mysqli_query($conn, $SQLstring)) {
          while ($Row = mysqli_fetch_array($QueryResult, MYSQLI_NUM)) {
               $arrayItem = array("label" => $Row[0], "y" => $Row[1]);
               array_push($dataPoints, $arrayItem);
          };
          mysqli_free_result($QueryResult);
     }
     //error_log(print_r($dataPoints, true));
     mysqli_close($conn);
}
?>

<script>
     window.onload = function() {

          var chart = new CanvasJS.Chart("chartContainer", {
               animationEnabled: true,
               title: {
                    text: "Students by school"
               },
               data: [{
                    type: "pie",
                    yValueFormatString: "#,##0.00\"\"",
                    indexLabel: "{label} ({y})",
                    dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
               }]
          });
          chart.render();

     }
</script>
<div id="chartContainer" style="height: 370px; width: 100%;"></div>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
<a href="/" class="btn btn-small btn-primary">&lt;&lt; BACK</a>

<?php include("../../inc_footer.php"); ?>