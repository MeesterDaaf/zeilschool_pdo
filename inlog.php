<?php
require 'database.php';

if (isset($_POST['submit']) && $_POST['email'] != '') {
    //check inloggevens
    // echo 'check';
    $email = $_POST['email'];

    $sql = "SELECT * FROM users WHERE email = :ph_email";
    $statement = $db_conn->prepare($sql);
    $statement->bindParam(":ph_email", $email);
    $statement->execute();
    $database_gegevens = $statement->fetch(PDO::FETCH_ASSOC);

    // var_dump($database_gegevens);
    if ($database_gegevens['email'] == $email) {
        echo 'deze gebruiker is bij ons bekend!!! yeah!!';

        session_start();
        $_SESSION['role'] = $database_gegevens['role'];

        header('location: courses/index.php');
    } else {
        echo 'Deze gebruiker is niet bekend! Wegwezen aub!';
    }
}


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <title>Document</title>
</head>

<body>
    <form action="" method="post">
        <label for="email">Email</label>
        <input type="text" name="email" id="">
        <label for="password">Password</label>
        <input type="text" name="password" id="">
        <input type="submit" name="submit" value="Inloggen">
    </form>
</body>

</html>