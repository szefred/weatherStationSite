<?php

if(!empty($_GET['temperature'])){
    echo 'test';
    $driver = 'mysql';
    $database = "dbname=stacja_pogody";
    $dsn = "$driver:host=localhost;$database";

    $username = 'stacja_pogody2';
    $password = 'arduino!';

    try {
        $conn = new PDO($dsn, $username, $password);
    }catch(PDOException $e){
        echo "<h1>" . $e->getMessage() . "</h1>";
    }

    $statement = $conn->prepare("INSERT INTO temperatura(temperature) VALUES(:temperature)");
    $statement->execute(array(
        "temperature" => $_GET['temperature']
    ));
} else {
    $driver = 'mysql';
    $database = "dbname=stacja_pogody";
    $dsn = "$driver:host=localhost;$database";

    $username = 'stacja_pogody2';
    $password = 'arduino!';

    try {
        $conn = new PDO($dsn, $username, $password);
    }catch(PDOException $e){
        echo "<h1>" . $e->getMessage() . "</h1>";
    }

    $statement = $conn->prepare("INSERT INTO temperatura(temperature) VALUES(:temperature)");
    $statement->execute(array(
        "temperature" => "250"
    ));

}