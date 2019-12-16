<?php
require '../database.php';

$id = $_GET['id'];

//VERWIJDER EEN WAARDE UIT EEN DATABASE TABEL
$sql = "DELETE FROM courses WHERE id = :id";
$stmt = $db_conn->prepare($sql); //stuur naar mysql.
$stmt->bindParam(":id", $id);
$stmt->execute();

//als het succesvol is... dan sturen we de gebruiker terug naar de index.php

header('location: index.php');
