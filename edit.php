

<?php
/*******w******** 
    
    Name: Tanner Agar
    Date: 2024-04-24
    Description: Editing content

****************/
require('connect.php');
require('authenticate.php');
// fetch post details get param
if(isset($_GET['id']) && filter_var($_GET['id'], FILTER_VALIDATE_INT))
{
    // sanitize / validate post id
    $post_id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
    if (!$post_id) {
        exit('Error: Invalid post ID');
    }

    // prepare sql query to fetch post
    $query = "SELECT * FROM posts WHERE post_id = :post_id";
    $statement = $db->prepare($query);
    $statement->bindValue(':post_id', $post_id);
    $statement->execute();
    $post = $statement->fetch(PDO::FETCH_ASSOC);
    // post exist
    if ($post) {
        $title = $post['title'];
        $content = $post['content'];
    } else {
        exit('Error: Post not found');
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') 
{
    if (!empty($_POST['title']) && !empty($_POST['content'])) 
    {
        $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $content = filter_input(INPUT_POST, 'content', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        $update_query = "UPDATE posts SET title = :title, content = :content, updated_at = CURRENT_TIMESTAMP WHERE post_id = :post_id";
        $update_statement = $db->prepare($update_query);
        $update_statement->bindValue(':title', $title);
        $update_statement->bindValue(':content', $content);
        $update_statement->bindValue(':post_id', $post_id);


        if ($update_statement->execute())
        {
            //get last id of last insert, for processing
            $post_id = $db->lastInsertId();

            //check if image is set
            if (isset($_FILES["image"]) && $_FILES["image"]["error"] == UPLOAD_ERR_OK) {
                //pull image information for image-ness
                $img_info = getimagesize($_FILES["image"]["tmp_name"]);
                //check if image-ness is true or not
                if ($img_info !== FALSE)
                {
                    //pass check? set up upload directory for processing
                    $upload_dir = 'images/';
                    //assign target file to upload directory, concatenate with image path
                    $target_file = $upload_dir . basename($_FILES["image"]["name"]);
                    //debug
                    echo $target_file;
                    //initiate the moving of the uploaded file. param from -> to
                    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file))
                    {
                        //filename var incl. path
                        $filename = basename($_FILES["image"]["name"]);
                        //prep query for insertion to image table, incl. placeholder values
                        $query = 'INSERT INTO images (post_id, filename) VALUES (:post_id, :filename)';
                        //prepare the query for encoding, return statement
                        $statement = $db->prepare($query);
                        //params, placeholder values, actual values
                        $statement->bindValue(':post_id', $post_id);
                        $statement->bindValue(':filename', $filename);
                        $statement->execute();
                        echo "Success, post created with image";
                        header("Location: index.php");
                        exit();
                    } else {
                        //moving failed
                        echo "Error with moving file to images.";
                    }
                } else {
                    //image-ness fail
                    echo "Invalid file not an image.";
                }
            } else {
                //allow posts to be created without image
                echo "Post created without image.";
                header("Location: index.php");
                exit();
            }
        } else {
            // other error
            echo "Error in the creation of the post.";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="main.css">
    <title>Edit Post - <?php echo htmlspecialchars($post['title']); ?></title>
</head>
<body>
<div class="index-container">
    <div class="top-bar">
        <div class="search-form">
            <form action="search.php" method="GET">
                <label for="keyword">Search by keyword: </label>
                <input type="text" name="keyword" placeholder="e.g. health">
                <input type="submit" value="Search">
            </form>
            <p class="new-post"><a href="new.php">Create New Post</a>
            <p class="new-post"><a href="content.php">Table of Contents</a></p>
            <p class="new-post"><a href="index.php">Index</a></p>
        </div>
    </div>
<fieldset class="edit-new-content">
    <legend class="edit-new-header">Edit Content</legend>
    <form action="" method="post" enctype="multipart/form-data">
        <?php if (isset($error_message)) : ?>
            <p><?php echo $error_message; ?></p>
        <?php endif; ?>

        <label for="title">Change Title:</label><br>
        <input type="text" id="title" name="title" value="<?php echo $post['title']; ?>" class="title-input" size="50"><br><br>
        <div class="controls">
            <label for="image" class="upload-btn">
                <img src="upload.svg" alt="Upload">
            </label>
            <input type="file" src="upload.svg" name="image" id="image">
        </div>
        <label for="content">Content:</label><br>
        <textarea id="content" name="content" class="content-input" rows="10" cols="50"><?php echo htmlspecialchars($post['content']); ?></textarea><br><br>

        <input type="submit" value="Update" class="submit-button">
    </form>

    <form action="delete_post.php" method="post">
        <input type="hidden" name="post_id" value="<?php echo $post_id; ?>">
        <input type="submit" value="Delete">
    </form>
</fieldset>
    <hr class="divider">
</div>
    

</body>
</html>