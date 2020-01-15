<?php
require '../database.php';
session_start();

$sql = "SELECT * FROM users";
$statement = $db_conn->prepare($sql);
$statement->execute();
$users = $statement->fetchAll(PDO::FETCH_ASSOC);



// if user is gelijk aan 2 of 1 dan mag hij/zij hier zijn!
// als gebruiker 3 of ander getal is dan wegwezen 
if ($_SESSION['role'] != 2 && $_SESSION['role'] != 1) {

    header('location: ../login.php');
    //wegwezen!!!
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
                <a href="../courses/index.php" class="nav-item nav-link">Alle Cursussen</a>
                <a href="index.php" class="nav-item nav-link">Alle deelnemers</a>
                <a href="create.php" class="nav-item nav-link">Nieuwe Gebruiker</a>
                <a href="../logout.php" class="nav-item nav-link text-danger">Uitloggen</a>
            </div>
        </div>
    </nav>
    <table class="table">
        <thead>
            <th>id</th>
            <th>voornaam</th>
            <th>email</th>
            <th>rol</th>
            <th>&nbsp;</th>
        </thead>
        <tbody>
            <?php foreach ($users as $user) : ?>
                <tr>
                    <td><?php echo $user['id'] ?></td>
                    <td><?php echo $user['fName'] ?></td>
                    <td><?php echo $user['email'] ?></td>
                    <td>
                        <?php $roles = ['', 'Admin', 'Manager', 'Klant'];

                        echo $roles[$user['role']]  ?>

                    </td>
                    <td>
                        <?php if ($_SESSION['role'] == 1) : ?>
                            <a href="show.php?id=<?php echo $user['id'] ?>" class="btn btn-success">Show</a>
                            <a href="edit.php?id=<?php echo $user['id'] ?>" class="btn btn-warning">Wijzig</a>
                            <a href="delete.php?id=<?php echo $user['id'] ?>" class="btn btn-danger">Verwijder</a>
                        <?php endif ?>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</body>

</html>