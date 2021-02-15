<?php include("../../inc_header.php"); ?>

<h1>Create New</h1>

<div class="row">
    <div class="col-md-4">
        <form action="process_create.php" method="post">
            <div class="form-group">
                <label for="StudentId" class="control-label">Student ID</label>
                <input for="StudentId" class="form-control" name="StudentId" id="StudentId" />
            </div>

            <div class="form-group">
                <label for="FirstName" class="control-label">First Name</label>
                <input for="FirstName" class="form-control" name="FirstName" id="FirstName" />
            </div>

            <div class="form-group">
                <label for="LastName" class="control-label">Last Name</label>
                <input for="LastName" class="form-control" name="LastName" id="LastName" />
            </div>

            <div class="form-group">
                <label for="School" class="control-label">School</label>
                <input for="School" class="form-control" name="School" id="School" />
            </div>

            <div class="form-group">
                <a href="../list" class="btn btn-small btn-primary">&lt;&lt; BACK</a>
                &nbsp;&nbsp;&nbsp;
                <input type="submit" value="Create" name="create" class="btn btn-success" />
            </div>
        </form>
    </div>
</div>

<br />


<?php include("../../inc_footer.php"); ?>