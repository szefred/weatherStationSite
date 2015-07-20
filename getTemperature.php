<?php
include 'config.php';

try {
    $conn = new PDO($dsn, $username, $password);
}catch(PDOException $e){
    echo "<h1>" . $e->getMessage() . "</h1>";
}

$statement = $conn->prepare("SELECT temperature_value, date FROM temperature_collection WHERE sensor_name = :sensorName");
$statement->execute(
    array(
        "sensorName" => $_GET["sensorName"]
    )
);
$result = array();


while($row = $statement->fetch(PDO::FETCH_ASSOC)){
    $result[] = array(strtotime($row['date']) * 1000, floatval($row['temperature_value']));
}

echo json_encode($result);