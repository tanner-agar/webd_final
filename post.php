




<?php
/*******w******** 
    
    Name: Tanner Agar
    Date: 2024-02-28
    Description: Full content post page

****************/
require('connect.php');

if(isset($_GET['id']) && filter_var($_GET['id'], FILTER_VALIDATE_INT))
{
// sanitize / validate post id
    $post_id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
    if (!$post_id) {
        exit('Error: Invalid post ID');
    }
    $query = "SELECT * FROM posts WHERE post_id = :post_id";
    $statement = $db->prepare($query);
    $statement->bindValue(':post_id', $post_id);
    $statement->execute();
    $post = $statement->fetch(PDO::FETCH_ASSOC);
    if ($post) {
        $query = 'SELECT filename FROM images WHERE post_id = :post_id';
        $statement = $db->prepare($query);
        $statement->bindValue(':post_id', $post_id);
        $statement->execute();
        $image = $statement->fetchColumn();
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
    <title><?php echo htmlspecialchars($post['title']); ?></title>
    <style>
body {
    font-family: Arial, sans-serif;
}

.post {
    max-width: 800px;
    margin: 0 auto;
    padding: 20px;
    border: 1px solid #ccc;
    margin-bottom: 10px;
    max-width: 700px; 
    overflow: hidden;
    text-overflow: ellipsis; 
    white-space: normal; 
    word-wrap: break-word; 
}

.title {
    font-size: 28px;
    margin-bottom: 10px;
}

.timestamp {
    font-size: 14px;
    color: #666;
    margin-bottom: 10px;
}

.content {
    white-space: pre-line; /* Preserve line breaks */
    margin-bottom: 20px;
}

.edit-link {
    text-align: center;
}

.edit-link a {
    color: blue;
    text-decoration: none;
}

.edit-link a:hover {
    text-decoration: underline;
}
    </style>
</head>
<body>

<div class="post">
    <?php if (isset($post) && !empty($post)):?>
            <h1 class="title"><?php echo htmlspecialchars($post['title']); ?></h1>
            <p class="timestamp"><?php echo date('F j, Y, g:i a', strtotime($post['date_created'])); ?></p>
            <p class="timestamp">Last Updated: <?php echo date('F j, Y, g:i a', strtotime($post['updated_at'])); ?></p>
            <?php if ($image) echo '<img src="images/' . $image . '" alt="Post Image"><br>'; else echo ''?>
            <p class="content"><?php echo htmlspecialchars($post['content']); ?></p>
            <p class="edit-link"><a href="edit.php?id=<?php echo $post['post_id']; ?>">Edit</a></p>
    <?php else: ?>
            <p>Error: Post not found.</p>
    <?php endif; ?>

    </div>

</body>
</html>