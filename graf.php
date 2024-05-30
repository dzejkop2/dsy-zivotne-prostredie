<?php
include("./connect.php");
include("./functions.php");
include("./querry.php");

session_start();
$rola_user = role_check($conn);

if (!isset($_GET["lokalita"]) || !isset($_GET["kategoria"])) {
    $lokalita = '';
    $kategoria = '';

    $query = "SELECT lokacia FROM senzor GROUP BY lokacia LIMIT 1";
    $query2 = "SELECT nazov FROM kategoria LIMIT 1";

    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) > 0) { 
        while ($row = mysqli_fetch_assoc($result)) { 
            $lokalita = $row["lokacia"];
        } 
    } 

    $result2 = mysqli_query($conn, $query2);
    if (mysqli_num_rows($result2) > 0) { 
        while ($row = mysqli_fetch_assoc($result2)) { 
            $kategoria = $row["nazov"];
        } 
    } 

    header("Location: ".htmlspecialchars($_SERVER["PHP_SELF"])."?kategoria=".$kategoria."&lokalita=".$lokalita);
} 
?>
<!DOCTYPE html>
<html data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Grafy | Životné prostredie</title>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(draw_chart);
        function draw_chart() {
            var json_data = <?php
            if (isset($_GET["kategoria"]) && isset($_GET["lokalita"])) {
                $kategoria = $_GET["kategoria"];
                $lokalita = $_GET["lokalita"];
                
                $query = get_querry("1", $rola_user);
                $data = [];

                $result = mysqli_query($conn, $query);
                if (mysqli_num_rows($result) > 0) { 
                    while ($row = mysqli_fetch_assoc($result)) { 
                        $data[] = [$row['datum'], (float)$row['hodnota']];
                    } 
                } 
                echo json_encode($data);
            } else {
                echo json_encode([]);
            }
            ?>;
            
            if (json_data.length === 0) {
                document.getElementById('chart_div').innerHTML = "<p>Nedostatok dát</p>";
                return;
            }

            var data = new google.visualization.DataTable();
            data.addColumn('datetime', 'Date');
            data.addColumn('number', 'Value');
        
            json_data.forEach(function(row) {
                data.addRow([new Date(row[0]), row[1]]);
            });

            var options = {
                title: 'Graf',
                hAxis: { title: 'Dátum' },
                vAxis: { title: 'Hodnota' }
            };

            var chart = new google.visualization.LineChart(document.getElementById('chart_div'));
            chart.draw(data, options);
        } 
    </script>
</head>
<body>
    <header><?php include_once("./header.php"); ?></header>
    <div class="container-xxl column-gap-3">
        <div class="row mt-2">
            <div class="col-9">
                <div id="chart_div" style="height:500px;"></div>
            </div>
            <div class="col-3">
                <div class="row mb-2">
                    <h2>Kategória dát:</h2>
                    <?php include("./dropdown_kategoria_special.php"); ?>
                </div>
                <div class="row mb-2">
                    <h2>Lokalita dát:</h2>
                    <?php include("./dropdown_lokalita.php"); ?>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
