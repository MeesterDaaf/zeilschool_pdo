<?php
require '../database.php';

$sql = "SELECT * FROM courses";
$statement = $db_conn->prepare($sql);
$statement->execute();
$courses = $statement->fetchAll(PDO::FETCH_ASSOC);

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
                <a href="create.php" class="nav-item nav-link">Nieuwe Cursus</a>
            </div>
        </div>
    </nav>
    <table class="table">
        <thead>
            <th>id</th>
            <th>name</th>
            <th>price</th>
            <th>&nbsp;</th>
        </thead>
        <tbody>
            <?php foreach ($courses as $course) : ?>
                <tr>
                    <td><?php echo $course['id'] ?></td>
                    <td><?php echo $course['name'] ?></td>
                    <td><?php echo $course['price'] ?></td>
                    <td>
                        <a href="edit.php?id=<?php echo $course['id'] ?>" class="btn btn-warning">Wijzig</a>
                        <a href="delete.php?id=<?php echo $course['id'] ?>" class="btn btn-danger">Verwijder</a>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</body>

</html>