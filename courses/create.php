<?php
require '../database.php';

if (isset($_POST['submit'])) { //als de knop geklikt is voer de onderstaande code uit
    $name = $_POST['name']; // vul een variabele die bij name is ingevuld
    $price = $_POST['price']; // vul een variabele die bij price is ingevuld


    //ZET WAARDE IN DATABASE
    $sql = "INSERT INTO table (<column>) VALUES (:placeholder)";
    $stmt = $db_conn->prepare($sql); //stuur naar mysql.
    $stmt->bindParam(":placeholder", $placeholder_variabele);
    $stmt->execute();

    //ZET WAARDE IN DATABASE
    $sql = "INSERT INTO courses (`name`, price) VALUES (:ph_name, :ph_price)";
    $stmt = $db_conn->prepare($sql); //stuur naar mysql.
    $stmt->bindParam(":ph_name", $name);
    $stmt->bindParam(":ph_price", $price);
    var_dump($stmt->execute());

    header('location: index.php');
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <title>Zeilschool PDO - Maak een Cursus</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Zeilschool Windmee</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
                <a href="index.php" class="nav-item nav-link">Alle Cursussen</a>
                <a href="../users/index.php" class="nav-item nav-link">Alle deelnemers</a>
                <a href="create.php" class="nav-item nav-link">Nieuwe Cursus</a>
                <a href="../logout.php" class="nav-item nav-link text-danger">Uitloggen</a>
            </div>
        </div>
    </nav>
    <div class="container">
        <div class="col">
            <h1>Cursus maken</h1>
            <form method="post" action="">
                <div class="form-group">
                    <label for="name">Naam Cursus</label>
                    <input type="text" class="form-control" id="name" aria-describedby="nameHelp" name="name">
                    <small id="namelHelp" class="form-text text-muted">Vul een naam hier in</small>
                </div>
                <div class="form-group">
                    <label for="price">Prijs</label>
                    <input type="number" class="form-control" id="price" name="price">
                </div>
                <button type="submit" class="btn btn-success" name="submit">Maak!</button>
            </form>
        </div>
    </div>
</body>

</html>