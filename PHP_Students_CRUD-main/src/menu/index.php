<?php include("../inc_header.php"); ?>
<h1>search</h1>
<form action = "/menu/index.php" method = "get">
<p>    Keyword: <input type = "text" name = "name">
    <input type = "submit" value = "Search"></p>
</form>
<br></br>
<?php
    include("../inc_db_params.php"); 
    include("../utils.php");
    mysqli_select_db($conn, $db_name);
    if (isset($_GET['name'])) {
        if ($conn !== FALSE) {
            $s = $_GET['name'];
            $s = sanitize_input($s);
            
            $s = preg_replace("#[^0-9a-z]#i","",$s);
            $SQLstring = "SELECT * FROM Students WHERE StudentId LIKE '$s' 
                                                    OR FirstName LIKE '$s' 
                                                    OR LastName LIKE '$s'
                                                    OR School LIKE '$s' ";
             
            if ($sql = $conn -> query($SQLstring)) {
                echo "<table width='100%' class='table table-striped'>\n";
                echo "<tr>".
                        "<th>Student ID</th>"."\t".
                        "<th>First Name</th>"."\t".
                        "<th>Last Name</th>"."\t".
                        "<th>School</th>"."\t".
                        "<th>&nbsp;</th></tr>\n";
                while ($row = $sql -> fetch_row()) {
                    echo "<tr><td>{$row[0]}</td>"."\t".
                            "<td>{$row[1]}</td>"."\t".
                            "<td>{$row[2]}</td>"."\t".
                            "<td>{$row[3]}</td>"."\t".
                            "</tr>";
                    
                }
                echo "</table>\n";
            }
            }
        else{
            echo"Failed";
        }
        mysqli_free_result($sql);
    }     
    mysqli_close($conn);
?>



<br></br>

<a href="/" class="btn btn-small btn-primary">&lt;&lt; BACK</a>

<?php include("../inc_footer.php"); ?>
