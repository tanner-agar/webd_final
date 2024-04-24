

<?php
/*******w******** 
    
    Name: Tanner Agar
    Date: 2024-04-19
    Description: Edit

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
            // redirect after exec
            header("Location: post.php?id={$post_id}");
            exit;
        }   
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

<fieldset>
    <legend>Edit Post</legend>
    <form action="" method="post">
        <?php if (isset($error_message)) : ?>
            <p><?php echo $error_message; ?></p>
        <?php endif; ?>

        <label for="title">Title:</label><br>
        <input type="text" id="title" name="title" value="<?php echo $post['title']; ?>" class="title-input" size="50"><br><br>

        <label for="content">Content:</label><br>
        <textarea id="content" name="content" class="content-input" rows="10" cols="50"><?php echo htmlspecialchars($post['content']); ?></textarea><br><br>

        <input type="submit" value="Update" class="submit-button">
    </form>

    <form action="delete_post.php" method="post">
        <input type="hidden" name="post_id" value="<?php echo $post_id; ?>">
        <input type="submit" value="Delete">
    </form>
</fieldset>
    

</body>
</html>