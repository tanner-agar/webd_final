<?php
/*******w********

Name: Tanner Agar
Date: 2024-04-24
Description: table of contents

 ****************/
require('connect.php');

$query = "SELECT post_id, title FROM posts";
$result = $db->query($query);

if (!$result) {
    // Handle error
    die("Database query failed.");
}

// Fetch all content items
$content_items = $result->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="main.css">
    <title>Table of Contents</title>
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
            <p class="sort"><a href="content.php">Table of Contents</a></p>
            <p class="sort"><a href="index.php">Index</a></p>
        </div>
    </div>
    <h1 >Table of Contents</h1>
    <table>
        <thead>
            <tr>
                <th>ID:</th>
                <th>Title:</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($content_items as $item): ?>
                <tr>
                    <td><?php echo $item['post_id']; ?></td>
                    <td><a href="post.php?id=<?php echo $item['post_id']; ?>"><?php echo $item['title']; ?></a></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
</body>
</html>
