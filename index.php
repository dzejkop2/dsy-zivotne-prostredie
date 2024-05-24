<?php
    include("./connect.php");
    include("./functions.php");
    session_start();
    
?>
<!DOCTYPE html>
<html data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Životné prostredie</title>
</head>
<body>
    <header><?php include_once("./header.php")?></header>
    <div class="container-xxl column-gap-3">
        <div class="row mt-2">
            <div class="col-8">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Hodnota</th>
                            <th scope="col">Kategoria</th>
                            <th scope="col">Senzor</th>
                            <th scope="col">Datum</th>
                            <?php if(isset($_SESSION["user_id"]) != "" && role_check($conn) == "vedec") {
                                echo "<th scope=\"col\">#</th>";
                            } ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            if(isset($_GET["kategoria"])) {
                                $query = "
                                SELECT data.id, kategoria.nazov AS kategoria_nazov, data.hodnota, senzor.lokacia AS senzor_lokacia,senzor.vybavenie AS senzor_vybavenie, data.datum, data.senzor_id
                                FROM data
                                JOIN kategoria ON data.kategoria_id = kategoria.id
                                JOIN senzor ON data.senzor_id = senzor.id
                                WHERE kategoria.nazov = \"".$_GET["kategoria"]."\"
                                ORDER BY datum DESC;
                                "; 
                            }
                            else {
                                $query = "
                                SELECT data.id, kategoria.nazov AS kategoria_nazov, data.hodnota, senzor.lokacia AS senzor_lokacia,senzor.vybavenie AS senzor_vybavenie, data.datum, data.senzor_id
                                FROM data
                                JOIN kategoria ON data.kategoria_id = kategoria.id
                                JOIN senzor ON data.senzor_id = senzor.id
                                ORDER BY datum DESC;
                                "; 
                            }
                            
                            $result = mysqli_query($conn, $query);

                            if (mysqli_num_rows($result) > 0) 
                            { 
                                while($row = mysqli_fetch_assoc($result)) 
                                { 
                                    if(isset($_SESSION["user_id"]) != "" && role_check($conn) == "vedec") {
                                        echo "
                                            <tr>
                                                <th scope=\"row\">".$row["hodnota"]."".jednotka($row["kategoria_nazov"])."</th>
                                                <td>".$row["kategoria_nazov"]."</td>
                                                <td>Senzor ".$row["senzor_id"].", ".$row["senzor_lokacia"]."</td>
                                                <td>".$row["datum"]."</td>
                                                <td><form method=\"post\" action=\"./delete.php\"><button type=\"submit\" class=\"btn btn-primary\" style=\"--bs-btn-padding-y: .2rem; --bs-btn-padding-x: .45rem; --bs-btn-font-size: .7rem;\" name=\"data_id\" value=\"".$row["id"]."\">Vymazať</button></form></td> 
                                            </tr>"; 
                                    }
                                    else {
                                        echo "
                                        <tr>
                                            <th scope=\"row\">".$row["hodnota"]."".jednotka($row["kategoria_nazov"])."</th>
                                            <td>".$row["kategoria_nazov"]."</td>
                                            <td>Senzor ".$row["senzor_id"].", ".$row["senzor_lokacia"]."</td>
                                            <td>".$row["datum"]."</td>
                                        </tr>"; 
                                    }
                                    
                                } 
                            } 
                        ?>
                    </tbody>
                </table>
            </div>
            <div class="col-4">
                <div class="row mb-2">
                    <h2>Kategória dát:</h2>
                    <?php include("./dropdown_kategoria.php");?>
                </div>
                <div class="row mb-2">
                    <h2>Miesta:</h2>
                    <div class="list-group">
                        <?php
                            $query = "
                            SELECT *
                            FROM senzor
                            GROUP BY lokacia    
                            "; 
                            $result = mysqli_query($conn, $query);
                            
                            if (mysqli_num_rows($result) > 0) 
                            { 
                                while($row = mysqli_fetch_assoc($result)) 
                                { 
                                    echo "<a href=\"./lokalita_info.php?lokalita=".$row["lokacia"]."\" class=\"list-group-item list-group-item-action\">".$row["lokacia"]."</a>";
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