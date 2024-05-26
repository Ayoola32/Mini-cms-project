<?php



// // // // // // // // // // // // // // // // // // // // 
                     //CATEGORIES CRUD//
// // // // // // // // // // // // // // // // // // // // 

// CREATE CATEGORIES
function insert_categories(){
    global $connection;
    if (isset($_POST["submit"])) {
        $cat_title = $_POST["cat_title"];
        if ($cat_title == "" || empty($cat_title)) {
            echo "<h4>This field should not be empty</h4>";
        }else{
            $query = "INSERT INTO category_header(cat_title) VALUE('{$cat_title}')";
            $create_cat_result = mysqli_query($connection, $query);
            if (!$create_cat_result) {
                die("Query Failed" . mysqli_error($connection));
            }  
        }
    }
}


// READ ALL DATA
function readAllCategories(){
    global $connection;
    $query = "SELECT * FROM category_header";
    $add_cat_result = mysqli_query($connection, $query);
    if (!$add_cat_result) {
        die("Query Failed" . mysqli_error($connection));
    }   
    while ($row = mysqli_fetch_assoc($add_cat_result)) {
        $admin_cat_id= $row["cat_id"];
        $admin_cat_title= $row["cat_title"];
        echo "<tr>";
        echo "<td>{$admin_cat_id}</td>";
        echo "<td>{$admin_cat_title}</td>";
        echo "<td><a href='categories.php?edit={$admin_cat_id}'>Edit</a></td>";
        echo "<td><a href='categories.php?delete={$admin_cat_id}'>Delete</a></td>";
        echo "</tr>";
    }
}


// UPDATE CATEGORIES
function update_categories(){
    global $connection;
    if (isset($_GET['edit'])) {
        include "includes/categories_update.php";
   }
}




// DELETE CATEGORIES
function delete_categories(){
    global $connection;
    if (isset($_GET['delete'])) {
        $del_cat_id = $_GET['delete'];

        $query = "DELETE FROM category_header WHERE cat_id = '{$del_cat_id}'";
        $del_query_result = mysqli_query($connection, $query);
        if (!$del_query_result) {
            die("Query Failed" . mysqli_error($connection));
        }
        header("Location: categories.php");
    }

}

