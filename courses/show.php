<?php
require '../database.php';
session_start();

$id = $_GET['id'];

//selecteer de cursus uit de db
$sql = "SELECT * FROM courses WHERE id = :id";
$statement = $db_conn->prepare($sql);
$statement->bindParam(":id", $id);
$statement->execute();
$course = $statement->fetch(PDO::FETCH_ASSOC);

$_SESSION['course'] = $course;

//selecteer alle inschrijvingen
$sql = "SELECT * FROM users 
                    JOIN inschrijvingen 
                        ON inschrijvingen.user_id = users.id
                    JOIN courses
                        ON courses.id = inschrijvingen.course_id    
                    WHERE inschrijvingen.course_id = :id";
$statement = $db_conn->prepare($sql);
$statement->bindParam(":id", $id);
$statement->execute();
$inschrijvingen = $statement->fetchAll(PDO::FETCH_ASSOC);

$_SESSION['inschrijvingen'] = $inschrijvingen;


// var_dump($inschrijvingen);

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
    <title>Zeilschool PDO - Cursussen</title>
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
        <div class="row">
            <div class="col">
                <h4>Deelnemers van cursus: <?php echo $course['name']  ?></h4>
                <h6><a href="pdf.php">Create PDF</a></h6>
                <table class="table">
                    <thead>

                        <tr>
                            <th>id</th>
                            <th>voornaam</th>
                            <th>Email</th>
                            <th>prijs</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($inschrijvingen as $inschrijving) : ?>
                            <tr>
                                <td><?php echo $inschrijving['id'] ?></td>
                                <td><?php echo $inschrijving['fName'] ?></td>
                                <td><?php echo $inschrijving['email'] ?></td>
                                <td><?php echo $inschrijving['price'] ?></td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>