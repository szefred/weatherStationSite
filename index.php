<?php
include 'config.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>weather station</title>
    <script language="javascript" type="text/javascript" src="js/jquery.js"></script>
    <script language="javascript" type="text/javascript" src="js/jquery.flot.js"></script>
    <script language="javascript" type="text/javascript" src="js/jquery.flot.time.js"></script>
    <script type="text/javascript">

        $(function() {

            function update() {
                function onDataReceived1(data) {
                    $.plot("#placeholder1", [data], {
                        xaxis: { mode: "time" }
                    });
                }

                var xmlRequest = $.ajax({
                    url: "http://<?php echo $url ?>/getTemperature.php?sensorName=<?php echo $firstSensorName ?>",
                    method: "GET",
                    dataType: "json"
                });

                xmlRequest.done(function( data ) {
                    onDataReceived1(data);
                });

                xmlRequest.fail(function( jqXHR, textStatus ) {
                    alert( "Request failed: " + textStatus );
                });

                function onDataReceived2(data) {
                    $.plot("#placeholder2", [data], {
                        xaxis: { mode: "time" }
                    });
                }

                var xmlRequest2 = $.ajax({
                    url: "http://<?php echo $url ?>/getTemperature.php?sensorName=<?php echo $secondSensorName ?>",
                    method: "GET",
                    dataType: "json"
                });

                xmlRequest2.done(function( data ) {
                    onDataReceived2(data);
                });

                xmlRequest2.fail(function( jqXHR, textStatus ) {
                    alert( "Request failed: " + textStatus );
                });
                setTimeout(update, 1000);
            }

            update();

        });

    </script>

</head>
<body>

<div id="placeholder1" style="width:600px;height:300px"></div>
<div id="placeholder2" style="width:600px;height:300px"></div>

<?php

try {
    $conn = new PDO($dsn, $username, $password);
    echo "<h2>Entries</h2>";
}catch(PDOException $e){
    echo "<h1>" . $e->getMessage() . "</h1>";
}
$sql = 'SELECT date, sensor_name, temperature_value FROM temperature_collection';
$stmt = $conn->prepare($sql);
$stmt->execute();



echo "<table>";
echo "<tr>
        <th>Date</th>
        <th>Sensor name</th>
        <th>Temperature</th>
    </tr>";
while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
    echo "<tr>";
    echo sprintf("<td>%s</td>", $row['date']);
    echo sprintf("<td>%s</td>", $row['sensor_name']);
    echo sprintf("<td>%s</td>", $row['temperature_value']);
    echo "</tr>";
}
echo "</table>";
?>

</body>
</html>


