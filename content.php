<?php

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
    <title>Table of Contents</title>
</head>
<body>
    <h1>Table of Contents</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
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
</body>
</html>
