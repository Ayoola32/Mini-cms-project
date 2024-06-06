<table class="table table-bordered hovered table-hover">
    <thead>
        <tr>
            <th>Id</th>
            <th>Username</th>
            <th>Password</th>
            <th>Firstname</th>
            <th>Lastname</th>
            <th>Email</th>
            <th>Role</th>
            <th>Image</th>
            <th>Update</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>
        
        <?php
            $query = "SELECT * FROM users ORDER BY user_id DESC";
            $query_result = mysqli_query($connection, $query);
            if (!$connection) {
                die("Query Failed" . mysqli_error($connection));
            }

            while ($row = mysqli_fetch_assoc($query_result)) {
                $user_id = $row['user_id'];
                $username = $row['username'];
                $password = $row['password'];
                $user_firstname = $row['user_firstname'];
                $user_lastname = $row['user_lastname'];
                $user_email = $row['user_email'];
                $user_image = $row['user_image'];
                $user_role = $row['user_role'];

                echo "<tr>";
                echo "<td>{$user_id}</td>";
                echo "<td>{$username}</td>";
                echo "<td>{$password}</td>";
                echo "<td>{$user_firstname}</td>";
                echo "<td>{$user_lastname}</td>";
                echo "<td>{$user_email}</td>";
                echo "<td>{$user_role}</td>";
                echo "<td><img class= '' width= '50' src='../images/$user_image' alt='image'></td>";
                echo "<td><a href=''>Edit</a></td>";
                echo "<td><a onClick=\"javascript: return confirm('Are you sure you want to delete this Users Account?')\" href='users.php?source=user_delete={$user_id}'>Delete</a></td>";
                echo "</td>";
            } 
        
        ?>
        
    </tbody>
</table>