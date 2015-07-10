<?php

$driver = 'mysql';
$database = "dbname=stacja_pogody";
$dsn = "$driver:host=localhost;$database";

$username = 'stacja_pogody2';
$password = 'arduino!';

try {
    $conn = new PDO($dsn, $username, $password);
    echo "<h2>Zapis temperatury</h2>";
}catch(PDOException $e){
    echo "<h1>" . $e->getMessage() . "</h1>";
}
$sql = 'SELECT  * FROM temperature_collection';
$stmt = $conn->prepare($sql);
$stmt->execute();

echo "<table style='width:100%'>";
while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
    echo "<tr>";
    foreach($row as $value)
    {
        echo sprintf("<td>%s</td>", $value);
    }
    echo "</tr>";
}
echo "</table>";


