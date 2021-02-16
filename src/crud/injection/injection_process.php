<?php include("../../inc_header.php"); ?>

<h1>SQL Injection example output</h1>

<?php
if (isset($_POST['find']) && isset($_POST['StudentId'])) {
     include("../inc_db_params_crud.php");

     $SQLstring = "SELECT * FROM Students WHERE StudentId = '" . $_POST['StudentId'] . "'";

     if ($using_mysql) {
     /* change db to world db */
          mysqli_select_db($conn, $db_name);

          if ($conn !== FALSE) {
               echo "<h1 style='font-size: large;'>";
               echo "SQL: <mark>$SQLstring </mark>";
               echo "</h1>";

               if ($QueryResult = @mysqli_query($conn, $SQLstring)) {
                    echo "<table width='100%' class='table table-striped'>\n";
                    echo "<tr><th>Student ID</th>".
                         "<th>First Name</th>".
                         "<th>Last Name</th>".
                         "<th>School</th>\n";
                    while ($Row = mysqli_fetch_array($QueryResult, MYSQLI_NUM)) {
                         echo "<tr><td>{$Row[0]}</td>";
                         echo "<td>{$Row[1]}</td>";
                         echo "<td>{$Row[2]}</td>";
                         echo "<td>{$Row[3]}</td>";
                         echo "</tr>\n";
                    };
                    echo "</table>\n";
               
                    echo "<p>Your query returned the above "
                         . mysqli_num_rows($QueryResult)
                         . " rows and ". mysqli_num_fields($QueryResult)
                         . " columns.</p>";
               
                    mysqli_free_result($QueryResult);
               }
          }
     
          mysqli_close($conn);
     } else {
          echo "<h1 style='font-size: large;'>";
          echo "SQL: <mark>$SQLstring </mark>";
          echo "</h1>";
     
          if ($res = $db->query($SQLstring)) {
               echo "<table width='100%' class='table table-striped'>\n";
               echo "<tr><th>Student ID</th>".
                    "<th>First Name</th>".
                    "<th>Last Name</th>".
                    "<th>School</th>\n";
               
               $numRows = 0;
     
               while ($row = $res->fetchArray(SQLITE3_NUM)) {
                    $numRows++;
                    echo "<tr><td>{$row[0]}</td>";
                    echo "<td>{$row[1]}</td>";
                    echo "<td>{$row[2]}</td>";
                    echo "<td>{$row[3]}</td>";
                    echo "</tr>\n";
               }
     
               echo "</table>\n";
          
               echo "<p>Your query returned the above "
                    . $numRows
                    . " rows and ". $res->numColumns()
                    . " columns.</p>";
          }
     }
}
?>

<br />
<?php include("../../inc_footer.php"); ?>