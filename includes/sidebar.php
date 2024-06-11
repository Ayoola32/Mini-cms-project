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

<div class="well">
    <?php if (isset($_SESSION['user_role'])): ?>
        <h3>Logged in as <?php echo $_SESSION['username'];?> </h3>
        <a href="./includes/logout.php" class="btn btn-primary">Logout</a>
    <?php else: ?>

        <h4>Login</h4>
        <form action="./includes/login.php" method ="post">
            <div class="form-group">
                <input type="text" name="username"class="form-control" placeholder="Enterr Username">
            </div>
            
            <div class="input-group">
                <input type="password" name="password"class="form-control" placeholder="Enter Password">
                <span class="input-group-btn">
                    <button name = "submit" class="btn btn-primary" type="submit">
                        Submit
                    </button>
                </span>
            </div>
            
            <div class="form-group">
                <a href="">Forgot Password</a>
            </div>
            
        </form> <!--Login form -->

    <?php endif; ?>
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