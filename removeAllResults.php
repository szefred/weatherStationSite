<?php
include 'config.php';

try {
    $conn = new PDO($dsn, $username, $password);
    echo "<h2>Entries</h2>";
}catch(PDOException $e){
    echo "<h1>" . $e->getMessage() . "</h1>";
}
$sql = 'DELETE FROM temperature_collection';
$stmt = $conn->prepare($sql);
$stmt->execute();

http_redirect($url . "/index.php");