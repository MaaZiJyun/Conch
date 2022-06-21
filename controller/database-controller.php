<?php
// DATABASE CONNECTION
require "1-model.php";
$DB = new DB();

// SEARCH FOR USERS
$results = $DB->select(
  "SELECT * FROM `users` WHERE `name` LIKE ?",
  ["%{$_POST["search"]}%"]
);

// OUTPUT RESULTS
echo json_encode(count($results)==0 ? null : $results);