<?php

include 'bookapi.php';

$api = new BookAPI();

$results =  $api->getLists([
    "list-name" => "hardcover-fiction",
    "published-date" => "2018-01-17"
]);

if (!$results){
    echo 'No results found';
    die();
}

$i=1;
foreach ($results as $result){
    echo "#$i, ";
    echo "List Name:" . $result->book_details[0]->title .", ";
    echo "Author:" . $result->book_details[0]->author . ", ";
    echo "Rank:" . $result->rank . ", ";
    echo "Weeks on List:" . $result->weeks_on_list;
    echo "\n";
    if ($i == 10) break;
    $i++;
}

echo "done";