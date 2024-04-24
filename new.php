
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
        //get last id of last insert
        $post_id = $db->lastInsertId();

            if (isset($_FILES["image"]) && $_FILES["image"]["error"] == UPLOAD_ERR_OK) {
                $img_info = getimagesize($_FILES["image"]["tmp_name"]);
                if ($img_info !== FALSE)
                {
                    $upload_dir = 'images/';
                    $target_file = $upload_dir . basename($_FILES["image"]["name"]);
                    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file))
                    {
                        $filename = basename($_FILES["image"]["name"]);
                        $query = 'INSERT INTO images (post_id, filename) VALUES (:post_id, :filename)';
                        $statement = $db->prepare($query);
                        $statement->bindValue(':post_id', $post_id);
                        $statement->bindValue(':filename', $filename);
                        $statement->execute();
                        echo "Success, post created with image";
                        header("Location: index.php");
                        exit();
                    } else {
                        echo "Error with moving file to images.";
                    }
                } else {
                    echo "Invalid file not an image.";
                }
            } else {
                echo "Post created without image.";
                header("Location: index.php");
                exit();
            }
        } else {
        echo "Error in the creation of the post.";
        }
}

/* if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    if (isset($_FILES["image"]) && $_FILES["image"]["error"] == UPLOAD_ERR_OK)
    {
        $img_info = getimagesize($_FILES["image"]["tmp_name"]);
        if ($img_info !== FALSE)
        {
            $uploads_dir = 'images/';
            $target_file = $uploads_dir . basename($_FILES["image"]["name"]);
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file))
            {
                $filename = basename($_FILES["image"]["name"]);

                $query = "INSERT INTO images (filename) VALUES (:filename)";
                $statement = $db->prepare($query);
                $statement->bindValue(':filename', $filename);

                if ($statement->execute())
                    {
                        echo "Upload successful.";
                    } else {
                        echo "Error moving file to images folder.";
                    }
            } else {
                echo "Invalid file.";
            }
        }
    }
}

*/
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

<fieldset>
    <legend>New Post</legend>
    <form method="post" enctype="multipart/form-data">
        <label for="title">Title:</label><br>
        <input type="text" id="title" name="title" class="title-input" size="50"><br><br>
        <label for="image">Select image to upload:</label>
        <input type="file" name="image" id="image">
        <label for="content">''</label><br>
        <textarea id="content" name="content" class="content-input" rows="10" cols="50"></textarea><br><br> 
        
        <input type="submit" value="Submit" class="submit-button">
    </form>

</fieldset>


    
</body>
</html>