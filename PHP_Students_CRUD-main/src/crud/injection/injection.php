<?php include("../../inc_header.php"); ?>

<h1>SQL Injection Example</h1>

<div class="row">
    <div class="col-md-4">
        <form action="injection_process.php" method="post">
            <div class="form-group">
                <label for="StudentId" class="control-label">Student ID</label>
                <input for="StudentId" class="form-control" name="StudentId" id="StudentId" />
            </div>

            <div class="form-group">
                <a href="../list" class="btn btn-small btn-primary">&lt;&lt; BACK</a>
                &nbsp;&nbsp;&nbsp;
                <input type="submit" value="Find" name="find" class="btn btn-success" />
            </div>
        </form>
    </div>
</div>

<p>The average developer would expect the user to enter: A00333333</p>
<p><b>HACK - try this:</b> <br />&apos; or &apos;A&apos;=&apos;A</p>
<p><b>Lesson learned:</b> always use prepared statements</p>


<br />


<?php include("../../inc_footer.php"); ?>