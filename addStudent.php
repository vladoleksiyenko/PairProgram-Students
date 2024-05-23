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

<body>
<h1> Add New Student </h1>
<form action="#" method="post" name="addStudent">
    <label for="sid">SID (enter 9 digits)</label>
    <input type="text" id="sid" name="sid">
    <br>

    <label for="last">Last</label>
    <input type="text" id="last" name="last">
    <br>

    <label for="first">First</label>
    <input type="text" id="first" name="first">
    <br>

    <label for="bday">Birthdate (9999/99/99)</label>
    <input type="text" id="bday" name="bday">
    <br>

    <label for="gpa">GPA</label>
    <input type="text" id="gpa" name="gpa">
    <br>

    <label for="adv">Advisor</label>
    <input type="text" id="adv" name="adv">
    <br>

    <label for="submit">Submit</label>
    <input type="submit" id="submit" name="submit">
    <br>
</form>
<a type="button" href="index.php"> home </a>

<?php
if (isset($_POST['submit'])) {

    //turn on error reporting
    ini_set('display_errors', 1);
    error_reporting(E_ALL);

    //get config for individual servers
    $path = $_SERVER['DOCUMENT_ROOT'] . '/../config.php';
    require_once $path;

    try {
        //create object of pdo credentials
        $dbh = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }

    //PDO
    $sql = 'INSERT INTO student (sid, last, first, birthdate, gpa, advisor) VALUES (:sid, :last, :first, :bday, :gpa, :adv)';

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
    $statement->bindParam(':adv', $adv);

    //execute
    if($statement->execute()){
        echo "<p>Successful addition</p>";
    }
    else{
        echo "<p>Unsuccessful addition</p>";
    }
}
?>
</body>
</html>
