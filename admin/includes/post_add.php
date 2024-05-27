<form action="" method="post" enctype="multipart/form-data">
    <h2>Add New Post</h2>
    <div class="form-group">

        <label for="">Categories</label><br>
        <select name="post_category_id" id="post_category" class>
            <option value="">Select Category</option>
            <option value="">Category 1</option>
            <option value="">Category 2</option>
            <option value="">Category 3</option>
        </select>
        </div>

    <div class="form-group">
        <label for="post_title">Post Title</label>
        <input type="text" class="form-control" name="post_title">
    </div>

    <div class="form-group">
        <label for="post_author">Post Author</label>
        <input type="text" class="form-control" name="post_users">
    </div>

    <div class="form-group">
        <label for="post_image">Post Image</label>
        <input type="file" name="post_image">
    </div>

    <div class="form-group">
        <label for="summernote">Post Content</label>
        <textarea class ="form-control" name="post_content" id="summernote" cols="30" rows="10"></textarea>
    </div>

    <div class="form-group">
        <label for="post_tags">Post Tags</label>
        <input type="text" class="form-control" name="post_tags">
    </div>

    <div class="form-group">
        <label for="post_status">Post Status</label><br>
        <select name="post_status" id="" class="control">
            <option value="draft">Draft</option>
            <option value="published">Published</option>
        </select>
    </div>

    <div class="form-group">
        <label for="post_users">Post User</label>
        <input type="text" class="form-control" name="post_users">
    </div>

    <div class="form-group">
        <input class= "btn btn-primary" type="submit" class="form-control" name="submit" value="Add Post">
    </div>
</form>