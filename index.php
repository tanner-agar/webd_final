

<?php

/*******w******** 

    Name: Tanner Agar
    Date: 2024-02-28
    Description: index for blog

****************/
require('connect.php');

$sort_by = isset($_GET['sort']) ? $_GET['sort'] : 'date_created';

$allowed_sort = ['title', 'date_created', 'updated_at'];
if (!in_array($sort_by, $allowed_sort)) {
    $sort_by = 'date_created';
}
// form query
$query = "SELECT * FROM posts ORDER BY $sort_by DESC LIMIT 10";
// populate pdo with results
$result = $db->query($query);

// error check
if (!$result) 
{
    // fetched extended error handling, db->errorinfo()[2] for 2 string
    print "Failed!" . $db->errorInfo()[2];
    exit();
}

// finally, posts var will fetch all records associated with the PDO
$posts = $result->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="main.css">
    <title>Welcome to my Blog!</title>
</head>
<body>
<!-- search bar/form -->
    <div class="search-form">
        <form action="search.php" method="GET">
            <input type="text" name="keyword" placeholder="Search...">
            <input type="submit" value="Search">
        </form>
    </div>

<div class="container">

    <div class="header">
        <h1>Charitify!</h1>
        <p>Explore the latest charities, rate, and other insights.</p>
    </div>

    <div><a href="content.php">Table of Contents</a></div>

    <div class="cms-container-container">

        <p class="new-post"><a href="new.php">New Post</p></a>
            <p>
                Sort by:
                <a href="?sort=title">Title</a>
                <a href="?sort=time">Time</a>
                <a href="?sort=updated">Last Updated</a>
            </p>
        <!-- implementing cards -->
<?php foreach ($posts as $post): ?>
    <div class="cms-post">
        <div class="cms-card">
            <!-- Display: title, Timestamp, and content. -->
            <h1 class="cms-head"><?php echo $post['title']; ?></h1>
            <p class="date-created"><?php echo $post['date_created'];?></p>

            <?php if ($post['updated_at']): ?>
                <p class="updated-at">Last Updated:<?php echo $post['updated_at'];?></p>
            <?php endif;?>


        <div class="card-content">
            <!--truncate for 500 characters. card consistency.-->
            <?php
                $content = $post['content'];
                $truncated = false;
                if (strlen($content) > 500)
                {
                    $content = substr ($content, 0, 200) . '...';
                    $truncated = true;
                }
            ?>
            </div>

            <p class="trunc-card"><?php echo $content; ?><p>

            <?php if ($truncated): ?>
            <p class="read-more"><a href="post.php?id=<?php echo htmlspecialchars($post['post_id']); ?>">Continue Reading</a></p>
            <?php endif; ?>

            <p class="edit-post"><a href="edit.php?id=<?php echo  htmlspecialchars($post['post_id']); ?>">Edit</a></p>

            </div>
<?php endforeach ?>
    </div>
</div>


</body>
</html>