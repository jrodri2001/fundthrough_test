<?php

include 'bookapi.php';

$line_ending = "</br>";
$separator = "</br></br>";
$api = new BookAPI();

$results =  $api->getLists([
    "list-name" => "hardcover-fiction",
    "published-date" => "2018-01-17"
]);

if (!$results){
    echo 'No results found';
    die();
}

if (php_sapi_name() === 'cli'){
    $line_ending = ", ";
    $separator = "\n";
}

$i=1;
foreach ($results as $result){
    echo "#$i ";
    echo "List Name:" . $result->book_details[0]->title . $line_ending;
    echo "Author:" . $result->book_details[0]->author . $line_ending;
    echo "Rank:" . $result->rank . $line_ending;
    echo "Weeks on List:" . $result->weeks_on_list;
    echo $separator;
    if ($i == 10) break;
    $i++;
}