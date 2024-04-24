
<?php
/*******w******** 
    
    Name: Tanner Agar
    Date: 2024-02-28
    Description: New post

****************/
require('connect.php');
require('authenticate.php');

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    // pattern/sanitizing:filter_input;key;full_spec_char
    $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $content = filter_input(INPUT_POST, 'content', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    //req. format
    $date_created = date('Y-m-d H:i:s');
    //assign query var to SQL insert.statement/val.placeholder
    $query = 'INSERT INTO posts (title, date_created, content) VALUES (:title, :date_created, :content)';
    //query>prep var process via prepare statement db instance (PDO)/cache exec plan/templating
    $statement = $db->prepare($query);
    $statement->bindValue(':title', $title);
    $statement->bindValue(':date_created', $date_created);
    $statement->bindValue(':content', $content);

    if ($statement->execute())
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
    <title>New Post</title>
</head>
<body>

<div class="index-container">
    <div class="top-bar">
        <p class="sort"><a href="content.php">Table of Contents</a></p>
        <p class="sort"><a href="index.php">Index</a></p>
    </div>
<fieldset class="edit-new-content">
    <legend class="edit-new-header">Create new content</legend>
    <!--  set encoding type to allow image upload -->
    <form method="post" enctype="multipart/form-data">

            <label for="title">Add a Title:</label><br>
            <input type="text" id="title" name="title" class="title-input" size="50"><br><br>
        <div class="controls">
            <label for="image">Select image to upload:</label>
            <input type="file" name="image" id="image">
        </div>
        <label for="content">''</label><br>
        <textarea id="content" name="content" class="cms-post" rows="10" cols="50"></textarea><br><br>
        
        <input type="submit" value="Submit" class="submit-button">
    </form>

</fieldset>
</div>

    
</body>
</html>