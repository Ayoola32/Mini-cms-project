<table class="table table-bordered hovered table-hover">
    <thead>
        <tr>
            <th>Id</th>
            <!-- <th>Comment Id</th> -->
            <th>Author</th>
            <th>Email</th>
            <th>Comment</th>
            <th>Status</th>
            <th>In Response to</th>
            <th>Date</th>
            <th>Approve</th>
            <th>Unapprove</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>
        
        <?php
            $query = "SELECT * FROM comments ORDER BY comment_id DESC";
            $query_result = mysqli_query($connection, $query);
            if (!$connection) {
                die("Query Failed" . mysqli_error($connection));
            }

            while ($row = mysqli_fetch_assoc($query_result)) {
                $comment_id = $row['comment_id'];
                $comment_post_id = $row['comment_post_id'];
                $comment_author = $row['comment_author'];
                $comment_email = $row['comment_email'];
                $comment_content = $row['comment_content'];
                $comment_status = $row['comment_status'];
                $comment_date = $row['comment_date'];

                echo "<tr>";
                echo "<td>{$comment_id}</td>";
                echo "<td>{$comment_author}</td>";
                echo "<td>{$comment_email}</td>";
                echo "<td>{$comment_content}</td>";
                echo "<td>{$comment_status}</td>";

                $query = "SELECT * FROM posts WHERE post_id = $comment_post_id";
                $select_post_id_result = mysqli_query($connection, $query);
                while ($row = mysqli_fetch_assoc($select_post_id_result)) {
                    $post_id = $row['post_id'];
                    $post_title = $row['post_title'];

                    echo "<td><a href='../post_comment.php?p_id={$post_id}'>$post_title</a></td>";
                }
                echo "<td>{$comment_date}</td>";
                echo "<td><a href='comments.php?approve={$comment_id}'>Approve</a></td>";
                echo "<td><a href='comments.php?unapprove={$comment_id}'>Unapprove</a></td>";
                echo "<td><a href='comments.php?delete={$comment_id}'>Delete</a></td>";
                echo "</td>";
            } 
        



            // APPROVE BUTTON
            if (isset($_GET['approve'])) {
                    $approve_comment_id = $_GET['approve'];

                    $query = "UPDATE comments SET comment_status = 'Approved' WHERE comment_id = $approve_comment_id";
                    $comment_approve_result = mysqli_query($connection, $query);
                    header("Location: comments.php");
            }

            // UNAPPROVE BUTTON
            if (isset($_GET['unapprove'])) {
                    $approve_comment_id = $_GET['unapprove'];

                    $query = "UPDATE comments SET comment_status = 'Unapproved' WHERE comment_id = $approve_comment_id";
                    $comment_unapprove_result = mysqli_query($connection, $query);
                    header("Location: comments.php");
            }



        ?>
        
    </tbody>
</table>