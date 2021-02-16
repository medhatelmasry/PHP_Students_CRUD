<?php include("../inc_header.php"); ?>

<h1>Global Search</h1>

<div class="row">
    <div class="col-md-4">
        <form action="process_global_search.php" method="post">
            <div class="form-group">
                <label for="SearchTerm" class="control-label">Search Term</label>
                <input for="SearchTerm" class="form-control" name="SearchTerm" id="SearchTerm" />
            </div>

            <div class="form-group">
                <a href="../" class="btn btn-small btn-primary">&lt;&lt; BACK</a>
                &nbsp;&nbsp;&nbsp;
                <input type="submit" value="Find" name="find" class="btn btn-success" />
            </div>
        </form>
    </div>
</div>

<?php include("../inc_footer.php"); ?>