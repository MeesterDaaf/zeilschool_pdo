<?php
$user = 'root';
$pass = '';
$db_conn = new PDO('mysql:host=localhost;dbname=zeilschool_pdo', $user, $pass);

//set constants for use in application
define('ROOT_PATH', dirname(__DIR__));
// echo ROOT_PATH . "<br>";
define("PROJECT_PATH", ROOT_PATH . "/");
// echo PROJECT_PATH. "<br>";
define("BASE_URL", "");  //TODO: remove /projects/
// echo BASE_URL. "<br>";
