<?php
// for USER ROLE update
if (isset($_POST['role']) && isset($_POST['user_id'])) {
    $role = $_POST['role'];
    $user_id = $_POST['user_id'];

    $query = "UPDATE users SET user_role = '{$role}' WHERE user_id = {$user_id}";
    $query_result = mysqli_query($connection, $query);
    if (!$query_result) {
        die("Query Failed: " . mysqli_error($connection));
    }
}
?>



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

                echo "<tr>";
                echo "<td>{$row['user_id']}</td>";
                echo "<td>{$row['username']}</td>";
                echo "<td>{$row['password']}</td>";
                echo "<td>{$row['user_firstname']}</td>";
                echo "<td>{$row['user_lastname']}</td>";
                echo "<td>{$row['user_email']}</td>";

            ?>  
            <td>
                <form action="" method="post">
                    <select name="role" onchange="this.form.submit()">
                        <option value='<?php echo $row['user_role']; ?>'><?php echo ucwords($row['user_role']); ?></option>
                        <?php
                        if ($row['user_role'] == 'admin') {
                            echo "<option value='subscriber'>Subscriber</option>";
                        } else {
                            echo "<option value='admin'>Admin</option>";
                        }
                        ?>
                    </select>
                    <input type="hidden" name="user_id" value="<?php echo $row['user_id']; ?>">
                </form>
            </td>

            <?php
                echo "<td><img class='' width='50' src='../images/{$row['user_image']}' alt='image'></td>";
                echo "<td><a href='./users.php?source=user_update&user_id={$row['user_id']}'>Edit</a></td>";
                echo "<td><a onClick=\"javascript: return confirm('Are you sure you want to delete this Users Account?')\" href='users.php?source=user_delete&user_id={$row['user_id']}'>Delete</a></td>";
                echo "</td>";
            } 
        
        ?>
        
    </tbody>
</table>