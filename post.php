




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
<div class="index-container">
    <div class="top-bar">
        <p class="sort"><a href="content.php">Table of Contents</a></p>
        <p class="sort"><a href="index.php">Index</a></p>
    </div>
        <div class="post-cms">
            <?php if (isset($post) && !empty($post)):?>
                    <h1 class="title-large"><?php echo htmlspecialchars($post['title']); ?></h1>
                    <p class="date-large"><?php echo date('F j, Y, g:i a', strtotime($post['date_created'])); ?></p>
                    <p class="updated-large">Last Updated: <?php echo date('F j, Y, g:i a', strtotime($post['updated_at'])); ?></p>
                <hr class="nav-divider">
                    <?php if ($image) echo '<img src="images/' . $image . '" alt="Post Image"><br>'; else echo ''?>
                    <p class="content-large"><?php echo htmlspecialchars($post['content']); ?></p>
                    <p class="edit-link-large"><a href="edit.php?id=<?php echo $post['post_id']; ?>">Edit</a></p>
            <?php else: ?>
                    <p>Error: Post not found.</p>
            <?php endif; ?>

        </div>
        <hr class="divider">
</div>
</body>
</html>