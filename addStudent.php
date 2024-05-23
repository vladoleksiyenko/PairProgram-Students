<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pair Program Student</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<?php

//turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

//get config for individual servers
$path = $_SERVER['DOCUMENT_ROOT'] . '/../config.php';
require_once $path;

try {
    //create object of pdo credentials
    $dbh = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
    echo "Connected successfully";
} catch (PDOException $e) {
    echo $e->getMessage();
}

//PDO
$sql = 'INSERT INTO student (sid, last, first, birthdate, gpa, advisor) 
                VALUES (:sid, :last, :first, :bday, :gpa, :advisor)';

//prepare statement
$statement = $dbh->prepare($sql);

//bind params
$sid = $_POST['sid'];
$last = $_POST['last'];
$first = $_POST['first'];
$bday = $_POST['bday'];
$gpa = $_POST['gpa'];
$adv = $_POST['adv'];
$statement->bindParam(':sid', $sid);
$statement->bindParam(':last', $last);
$statement->bindParam(':first', $first);
$statement->bindParam(':bday', $bday);
$statement->bindParam(':gpa', $gpa);
$statement->bindParam(':advisor', $adv);


//execute
if ($statement->execute()) {
    echo "<div class='alert alert-success'>Student added successfully</div>";
} else {
    echo "<div class='alert alert-danger'>Error adding student</div>";
}
?>

<h1> Add New Student </h1>
<form action="#" method="post" name="addStudent">
    <label for="sid">SID (111-11-1111)</label>
    <input type="text" id="sid" name="sid">

    <label for="last">Last</label>
    <input type="text" id="last" name="last">

    <label for="first">First</label>
    <input type="text" id="first" name="first">

    <label for="bday">Birthdate</label>
    <input type="text" id="bday" name="bday">

    <label for="gpa">GPA</label>
    <input type="text" id="gpa" name="gpa">

    <label for="adv">Advisor</label>
    <input type="text" id="adv" name="adv">

    <button type="submit" class="btn btn-primary">Submit</button>
</form>