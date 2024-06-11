<!-- Blog Search Well -->
<div class="well">
    <h4>Blog Search</h4>
    <form action="search.php" method ="post">
    <div class="input-group">
        <input type="text" name="search"class="form-control">
        <span class="input-group-btn">
        <button name = "submit" class="btn btn-default" type="submit">
            <span class="glyphicon glyphicon-search"></span>
        </button>
        </span>
    </div>
    </form> <!--search form -->
    <!-- /.input-group -->
</div>


<!-- Blog Categories Well -->
<div class="well">
<h4>Blog Categories</h4>
<div class="row">
    <div class="col-lg-6">
        <ul class="list-unstyled">
        <?php
            $query = "SELECT * FROM category_header";
            $query_category_result = mysqli_query($connection, $query);
            if (!$query_category_result) {
                die("Query Failed " . mysqli_error($connection));
            }

            while ($row=mysqli_fetch_assoc($query_category_result)) {
                $cat_id    = $row['cat_id'];
                $cat_title = $row['cat_title'];

                echo "<li><a href='#'>$cat_title</a></li>";
            }
        ?>
        </ul>
    </div>
</div>
<!-- /.row -->
</div>

<!-- Side Widget Well -->
<?php include "includes/widget.php";?>