<table class="table table-bordered hovered table-hover">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Category</th>
                            <th>Title</th>
                            <th>Author</th>
                            <th>Date</th>
                            <th>Image</th>
                            <th>Conetent</th>
                            <th>Tags</th>
                            <th>Status</th>
                            <th>Comment Count</th>
                            <th>Users</th>
                            <th>View Post</th>
                            <th>Update</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Dynamic Display Post from database -->
                        <?php
                        $query = "SELECT * FROM posts ORDER BY post_id DESC";
                        $query_post_result = mysqli_query($connection, $query);
                        if (!$query_post_result) {
                            die("Query Failed" . mysqli_error($connection));
                        }
                        while ($row = mysqli_fetch_assoc($query_post_result)) {
                            $post_id = $row['post_id'];
                            $post_category_id = $row['post_category_id'];
                            $post_title = $row['post_title'];
                            $post_author = $row['post_author'];
                            $post_date = $row['post_date'];
                            $post_image = $row['post_image'];
                            $post_content = $row['post_content'];
                            $post_tags = $row['post_tags'];
                            $post_status = $row['post_status'];
                            $post_comment_count = $row['post_comment_count'];
                            $post_users = $row['post_users'];

                            echo "<tr>";
                            echo "<td>$post_id</td>";

                            // Display Post category title instead of post category id
                            $query = "SELECT * FROM category_header WHERE cat_id = {$post_category_id}";
                            $query_result = mysqli_query($connection, $query);
                            if (!$query_result) {
                                die("Query Failed " . mysqli_error($connection));
                            }
                            while ($row = mysqli_fetch_assoc($query_result)) {
                                $cat_id = $row['cat_id'];
                                $cat_title = $row['cat_title'];
                                echo "<td>$cat_title</td>";
                            }

                            echo "<td>$post_title</td>";
                            echo "<td>$post_author</td>";
                            echo "<td>$post_date</td>";
                            echo "<td><img class= '' width= '150' src='../images/$post_image' alt='image'></td>";
                            echo "<td>$post_content</td>";
                            echo "<td>$post_tags</td>";
                            echo "<td>$post_status</td>";
                            echo "<td>$post_comment_count</td>";
                            echo "<td>$post_users</td>";
                            echo "<td><a href=''>View Post</a></td>";
                            echo "<td><a href='./posts.php?source=post_update&p_id={$post_id}'>Edit</a></td>";
                            echo "<td><a onClick=\"javascript: return confirm('Are you sure you want to delete this Post')\" href='./posts.php?source=post_delete&p_id={$post_id}'>Delete</a></td>";
                        }
                        
                        
                        ?>
                        <tr>
                            <td>1</td>
                            <td>Php</td>
                            <td>Fundamental</td>
                            <td>Abusidiq</td>
                            <td>11 May</td>
                            <td>image.img</td>
                            <td>Content Lorem ipsum dolor sit, amet consectetur adipisicing elit. Molestias eum vero repudiandae neque fuga iure!</td>
                            <td>php, fundamental</td>
                            <td>Draft
                                <?php
                                // if (isset($_POST['status'])) {
                                //    echo $_POST['status'];
                                // }
                                
                                ?>
                                <!-- <form action="" method="post">
                                    <select name="status" id="">
                                        <option value="1">Draft</option>
                                        <option value="2">Published</option>
                                    </select>
                                </form> -->
                            </td>
                            <td>1</td>
                            <td>user</td>
                            <td>view post</td>
                            <td>editt</td>
                            <td>delete</td>
                        </tr>
                    </tbody>
                </table>