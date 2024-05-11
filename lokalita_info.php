<?php
    include("./connect.php");
    include("./functions.php")
?>
<!DOCTYPE html>
<html data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title><?php echo $_GET["lokalita"]; ?> | Životné prostredie</title>
</head>
<body>
    <header><?php include_once("./header.php")?></header>
    <div class="container-xxl column-gap-3">
        <div class="row mt-2">
            <h1>Lokalita: <?php echo $_GET["lokalita"]; ?></h1>
            <div class="col-8">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Hodnota</th>
                            <th scope="col">Kategoria</th>
                            <th scope="col">Senzor</th>
                            <th scope="col">Datum</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $query = "
                            SELECT data.id, kategoria.nazov AS kategoria_nazov, data.hodnota, senzor.lokacia AS senzor_lokacia,senzor.vybavenie AS senzor_vybavenie, data.datum, data.senzor_id
                            FROM data
                            JOIN kategoria ON data.kategoria_id = kategoria.id
                            JOIN senzor ON data.senzor_id = senzor.id
                            WHERE senzor.lokacia = \"".$_GET["lokalita"]."\"
                            ORDER BY datum DESC;
                            "; 
                            $result = mysqli_query($conn, $query);

                            if (mysqli_num_rows($result) > 0) 
                            { 
                                while($row = mysqli_fetch_assoc($result)) 
                                {   
                                    echo "<tr><th scope=\"row\">".$row["hodnota"]."".jednotka($row["kategoria_nazov"])."</th>
                                        <td>".$row["kategoria_nazov"]."</td>
                                        <td>Senzor ".$row["senzor_id"].", ".$row["senzor_lokacia"]."</td>
                                        <td>".$row["datum"]."</td></tr>"; 
                                } 
                            } 
                        ?>
                    </tbody>
                </table>
            </div>
            <div class="col-4">
                <?php ?>
                <div class="row mb-2">
                    <h2>Priemerna teplota:</h2>
                    <h2><?php 
                        echo avg_hodnota("teplota",$conn,$_GET["lokalita"]);
                    ?></h2>
                </div>
                <div class="row mb-2">
                    <h2>Priemerna vlhkost:</h2>
                    <h2><?php 
                        echo avg_hodnota("vlhkost",$conn,$_GET["lokalita"]);
                    ?></h2>
                </div>
                <div class="row mb-2">
                    <h2>Senzory:</h2>
                    <div class="list-group">
                        <?php

                            $query = "
                            SELECT *
                            FROM senzor 
                            WHERE lokacia = \"".$_GET["lokalita"]."\"
                            "; 
                            $result = mysqli_query($conn, $query);
                            
                            if (mysqli_num_rows($result) > 0) 
                            { 
                                while($row = mysqli_fetch_assoc($result)) 
                                { 
                                    echo "<a href=\"#\" class=\"list-group-item list-group-item-action\">Senzor ".$row["id"].", ".$row["lokacia"]."</a>";
                                } 
                            } 
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>