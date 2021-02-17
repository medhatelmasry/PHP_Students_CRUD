<?php include("../../inc_header.php"); ?>

<h1>Students Chart</h1>

<?php
include("../../inc_db_params.php");
mysqli_select_db($conn, $db_name);

$science = 0;
$mining = 0;
$nursing = 0;
$computing = 0;

if ($conn !== FALSE) {
    $SQLstring = "select * from Students";
    if ($QueryResult = @mysqli_query($conn, $SQLstring)) {
        while ($Row = mysqli_fetch_array($QueryResult, MYSQLI_NUM)) {
             if ($Row[3] == "Mining") {
                  $mining += 1;
             } else if ($Row[3] == "Science") {
                  $science += 1;
             } else if ($Row[3] == "Computing") {
                  $computing += 1;
             } else if ($Row[3] == "Nursing") {
                  $nursing += 1;
             }
        };
        mysqli_free_result($QueryResult);

        $dataPoints = array( 
          array("label"=>"Science", "y"=>$science),
          array("label"=>"Mining", "y"=>$mining),
          array("label"=>"Nursing", "y"=>$nursing),
          array("label"=>"Computing", "y"=>$computing),
          );
   }

   mysqli_close($conn);
}
?>

<script>
window.onload = function() {
 
 
var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,
	title: {
		text: "Number of students in each Department"
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