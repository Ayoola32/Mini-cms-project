    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">Home</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">

                    <?php
                    $query = "SELECT * FROM category_header LIMIT 3";
                    $query_result = mysqli_query($connection, $query);
                    if (!$query_result) {
                        die("Query Failed" . mysqli_error($connection));
                    }
                    while ($row = mysqli_fetch_assoc($query_result)) {
                        $cat_title = $row['cat_title'];
                        echo "<li><a href='#'>{$cat_title}</a></li>";
                    }

                    ?>

                    <li>
                        <a href="./contact.php">Contact</a>
                    </li>

                </ul>

                <!-- Dont display admin if not logged in -->
                <?php if (isset($_SESSION['user_role'])): ?>
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="admin">Admin</a></li>
                    </ul>
                    <?php else: ?>
                        <ul class="nav navbar-nav navbar-right">
                            <li><a href="./login.php">Signin</a></li>
                            <li><a href="./registration.php">Signup</a></li>
                        </ul>
                    <?php endif; ?>

            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>