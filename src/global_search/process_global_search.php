<?php include("../inc_header.php"); ?>

<h1>Global Search Results</h1>

<?php
if (isset($_POST['find']) && isset($_POST['SearchTerm'])) {
     include("../inc_db_params.php");
     include("../utils.php");

     $SearchTerm = sanitize_input($_POST['SearchTerm']);

     if ($using_mysql) {
          $SQLstring = "SHOW COLUMNS FROM Students";

          mysqli_select_db($conn, $db_name);

          if ($conn !== FALSE) {
               $ColumnNames = array();
               $NumOfRows = 0;
               
               $QueryResult = mysqli_query($conn, $SQLstring);

               while ($Row = mysqli_fetch_array($QueryResult)) {
                    array_push($ColumnNames, $Row[0]);
               }

               echo "<table width='100%' class='table table-striped'>\n";
               echo "<tr><th>Student ID</th>".
                    "<th>First Name</th>".
                    "<th>Last Name</th>".
                    "<th>School</th>\n";

               foreach ($ColumnNames as $Column) {
                    $SQLstring = "SELECT * FROM Students WHERE " . $Column . " = ?";

                    $stmt = $conn->prepare($SQLstring);
                    $stmt->bind_param('s', $SearchTerm);
                    $stmt->execute();

                    $QueryResult = $stmt->get_result();

                    while ($Row = mysqli_fetch_array($QueryResult, MYSQLI_NUM)) {
                         echo "<tr><td>{$Row[0]}</td>";
                         echo "<td>{$Row[1]}</td>";
                         echo "<td>{$Row[2]}</td>";
                         echo "<td>{$Row[3]}</td>";
                         echo "</tr>\n";
                    };

                    $NumOfRows += mysqli_num_rows($QueryResult);

                    mysqli_free_result($QueryResult);
                    $stmt->close();
               }

               echo "</table>\n";
               echo "<p>Your query returned the above "
                         . $NumOfRows
                         . " rows and ". count($ColumnNames)
                         . " columns.</p>";
          }
          mysqli_close($conn);
     } else {
          $SQLstring = "PRAGMA table_info('Students')";

          $ColumnNames = array();
          $NumOfRows = 0;
          $QueryResult = $db->query($SQLstring);

          while ($Row = $QueryResult->fetchArray(SQLITE3_ASSOC)) {
               array_push($ColumnNames, $Row['name']);
          } 

          echo "<table width='100%' class='table table-striped'>\n";
          echo "<tr><th>Student ID</th>".
               "<th>First Name</th>".
               "<th>Last Name</th>".
               "<th>School</th>\n";

          foreach ($ColumnNames as $Column) {
               $SQLstring = "SELECT * FROM Students WHERE " . $Column . " = ?";

               $prepared_stmt = $db->prepare($SQLstring);
               $prepared_stmt->bindParam(1, $SearchTerm);
               $QueryResult = $prepared_stmt->execute();

               while ($Row = $QueryResult->fetchArray(SQLITE3_NUM)) {
                    echo "<tr><td>{$Row[0]}</td>";
                    echo "<td>{$Row[1]}</td>";
                    echo "<td>{$Row[2]}</td>";
                    echo "<td>{$Row[3]}</td>";
                    echo "</tr>\n";
               }

               $NumOfRows += $Row['count'];
          }

          echo "</table>\n";
          echo "<p>Your query returned the above "
                    . $NumOfRows
                    . " rows and ". count($ColumnNames)
                    . " columns.</p>";
     }
}
?>

<a href="./global_search.php" class="btn btn-small btn-primary">&lt;&lt; BACK</a>

<br />
<?php include("../inc_footer.php"); ?>