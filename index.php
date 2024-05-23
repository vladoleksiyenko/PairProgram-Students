<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);
$path = $_SERVER['DOCUMENT_ROOT'].'/../config.php';
require $path;

try {
    // Instantiate our PDO database object
    $dbh = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
} catch (PDOException $e) {
    die ($e->getMessage());
}

// SELECT Query: multiple rows
// Define the query
$sql = "Select * FROM student";

// Prepare the statement
$statement = $dbh->prepare($sql);

// Execute the statement
$statement -> execute();

// Process the result
$result = $statement->fetchAll(PDO::FETCH_ASSOC);

echo "<h1>Student List</h1>";
echo "<ol>";  // Start the ordered list
foreach ($result as $row) {
    echo "<li>".($row['first']).", ".($row['last'])."</li>";
}
echo "</ol>";  // End the ordered list

echo '<a href="addStudent.php">Add a student</a>';

