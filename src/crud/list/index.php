<?php include("../../inc_header.php"); ?>

<h1>List of Students</h1>

<p>
<a href="../../crud/create/create.php" class="btn btn-small btn-success">Create New</a>
</p>

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
        echo "<table width='100%' class='table table-striped'>\n";
        echo "<tr><th>Student ID</th>".
             "<th>First Name</th>".
             "<th>Last Name</th>".
             "<th>School</th>\n";
             "<th>&nbsp;</th></tr>\n";
        while ($Row = mysqli_fetch_array($QueryResult, MYSQLI_NUM)) {
             echo "<tr><td>{$Row[0]}</td>";
             echo "<td>{$Row[1]}</td>";
             echo "<td>{$Row[2]}</td>";
             echo "<td>{$Row[3]}</td>";
             echo "<td>";
             echo "<a class='btn btn-small btn-primary' href='../../crud/display/display.php?id={$Row[0]}'>disp</a>";
             echo "&nbsp;";
             echo "<a class='btn btn-small btn-danger' href='../../crud/delete/delete.php?id={$Row[0]}'>del</a>";
             echo "&nbsp;";
             echo "<a class='btn btn-small btn-warning' href='../../crud/update/update.php?id={$Row[0]}'>upd</a>";
             echo "</td></tr>\n";

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
        echo "</table>\n";

        echo "<p>Your query returned the above "
             . mysqli_num_rows($QueryResult)
             . " rows and ". mysqli_num_fields($QueryResult)
             . " columns.</p>";

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
?>
<!DOCTYPE HTML>
<html>
<head>
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
</head>
<body>
<div id="chartContainer" style="height: 370px; width: 100%;"></div>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
</body>
</html>      
<a href="/" class="btn btn-small btn-primary">&lt;&lt; BACK</a>

<?php include("../../inc_footer.php"); ?>