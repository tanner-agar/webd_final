<?php

//pull db context
require('connect.php');

// if key word exists, not null
if(isset($_GET['keyword'])) {
    // prevent sql injection, sanitize using htmlspecialchars()
    // convert special characters to html entities
    $keyword = htmlspecialchars($_GET['keyword']);

    // sql query, using where keyword placeholder is either in the title or as part of content
    $query = "SELECT * FROM posts WHERE title LIKE :keyword OR content LIKE :keyword";

    // prepare sql query
    $statement = $db->prepare($query);

    // bind keyword param, assign actual value
    $keywordParam = "%$keyword%";
    $statement->bindParam(':keyword', $keywordParam, PDO::PARAM_STR);

    // exec
    $statement->execute();

    // fetch the subsequent search results
    $searchResults = $statement->fetchAll(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="main.css">
    <title>Search Results: <?php echo  htmlspecialchars($_GET['keyword']) ?></title>
</head>
<body>
<div class="search-container">
    <div class="search-header">
        <h1>Search Results</h1>
    </div>

    <div class="search-form">
        <form action="search.php" method="GET">
            <!-- sanitize keyword when set else return empty - ternary operator; (condition keyword is set) -?true?-> return sanitized keyword, -:else:-> return empty -->
            <input type="text" name="keyword" placeholder="Search..." value="<?php echo isset($_GET['keyword']) ? htmlspecialchars($_GET['keyword']) : ''; ?>">
            <input type="submit" value="Search">
        </form>

    </div>
        <!-- check if search results exist, and count of elements is greater than 0 -->
        <?php if(isset($searchResults) && count($searchResults) > 0): ?>
                <div class="cms-post">

                    <?php foreach($searchResults as $result): ?>
                    <div class="cms-card">
                            <h1 class="cms-head"><?php echo $result ['title']; ?></h1>
                                <h4 class="created-header">Created on: </h4>
                                <p class="date_created"><?php echo $result['date_created']; ?></p>
                                <div class="card-cms">
                                    <p class="trunc-card"><?php echo $result['content']; ?></p>

                                </div>
                        <p class="edit-post"><a href="edit.php?id=<?php echo htmlspecialchars($result['post_id']); ?>">Edit</a></p>
                </div>
                    <?php endforeach; ?>
                </div>
        <!-- account for no results -->
        <?php elseif(isset($_GET['keyword'])): ?>
            <p>No results found for '<?php echo htmlspecialchars($_GET['keyword']); ?>'</p>
        <?php endif; ?>
    </div>
</div>
</body>
</html>
