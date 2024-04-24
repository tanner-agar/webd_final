<?php

require('connect.php');

// if key word exists, not null
if(isset($_GET['keyword'])) {
    // prevent sql injection, sanitize using htmlspecialchars()
    // convert special characters to html entities
    $keyword = htmlspecialchars($_GET['keyword']);

    // sql query
    $query = "SELECT * FROM posts WHERE title LIKE :keyword OR content LIKE :keyword";

    // prepare sql query
    $statement = $db->prepare($query);

    // bind keyword param
    $keywordParam = "%$keyword%";
    $statement->bindParam(':keyword', $keywordParam, PDO::PARAM_STR);

    // exec
    $statement->execute();

    // fetch the subsequent search results
    $searchResults = $statement->fetchAll(PDO::FETCH_ASSOC);
}
