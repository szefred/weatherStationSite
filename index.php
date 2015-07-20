<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>weather station</title>
    <script language="javascript" type="text/javascript" src="js/flot/jquery.js"></script>
    <script language="javascript" type="text/javascript" src="js/flot/jquery.flot.js"></script>
    <script language="javascript" type="text/javascript" src="js/flot/jquery.flot.time.js"></script>
    <script type="text/javascript">

        $(function() {
            function onDataReceived1(data) {
                $.plot("#placeholder1", [data], {
                    xaxis: { mode: "time" }
                });
            }

            var xmlRequest = $.ajax({
                url: "http://localhost/getTemperature.php?sensorName=first",
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
                url: "http://localhost/getTemperature.php?sensorName=second",
                method: "GET",
                dataType: "json"
            });

            xmlRequest2.done(function( data ) {
                onDataReceived2(data);
            });

            xmlRequest2.fail(function( jqXHR, textStatus ) {
                alert( "Request failed: " + textStatus );
            });

        });

    </script>

</head>
<body>

<div id="placeholder1" style="width:600px;height:300px"></div>
<div id="placeholder2" style="width:600px;height:300px"></div>

<?php
include 'config.php';

try {
    $conn = new PDO($dsn, $username, $password);
    echo "<h2>Zapis temperatury</h2>";
}catch(PDOException $e){
    echo "<h1>" . $e->getMessage() . "</h1>";
}
$sql = 'SELECT * FROM temperature_collection';
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
?>

</body>
</html>


