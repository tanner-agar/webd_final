<?php

require('connect.php');

// if key word is submitted
if(isset($_GET['keyword'])) {
    // prevent sql injection, sanitize
    $keyword = htmlspecialchars($_GET['keyword']);

    // sql query
    $query = "SELECT * FROM posts WHERE title LIKE :keyword OR content LIKE :keyword";

    // prepare sql query
    $statement = $db->prepare($query);
