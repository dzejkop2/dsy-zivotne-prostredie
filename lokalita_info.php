<?php
    include("./connect.php");
    include("./functions.php");
    include("./querry.php");
    session_start();
    $rola_user = role_check($conn);
?>
<!DOCTYPE html>
<html data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="icon" type="image/x-icon" href="./favicon.ico">
    <title><?php echo $_GET["lokalita"]; ?> | Životné prostredie</title>
</head>
<body>
    <header><?php include_once("./header.php")?></header>
    <div class="container-xxl column-gap-3">
        <div class="row mt-2">
            <h1>Lokalita: <?php echo $_GET["lokalita"]; if(isset($_GET["senzor"])) echo " | Senzor: ".$_GET["senzor"]."";?></h1>
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
                            $query = get_querry(1,$rola_user);
                            $result = mysqli_query($conn, $query);

                            if (mysqli_num_rows($result) > 0) 
                            { 
                                while($row = mysqli_fetch_assoc($result)) 
                                {   
                                    echo "
                                    <tr>
                                        <th scope=\"row\">".$row["hodnota"]."".jednotka($row["kategoria_nazov"])."</th>
                                        <td>".$row["kategoria_nazov"]."</td>
                                        <td>Senzor ".$row["senzor_id"].", ".$row["senzor_lokacia"]."</td>
                                        <td>".$row["datum"]."</td>
                                    </tr>"; 
                                } 
                            } 
                        ?>
                    </tbody>
                </table>
            </div>
            <div class="col-4">
                <?php if(!isset($_GET["senzor"])) { ?>
                    <div class="row mb-2">
                        <div class="col-7">
                            <h2>Kategória dát:</h2>
                            <?php include("./dropdown_kategoria.php");?>
                        </div>
                        <div class="col-5">
                            <h2>Čas dát:</h2>
                            <?php include("./dropdown_cas.php");?>
                        </div>
                    </div>
                <?php }
                    else {
                        $query = "SELECT posledny_update,vybavenie FROM senzor WHERE id = ".$_GET["senzor"]."";
                        $result = mysqli_query($conn, $query);
                        if (mysqli_num_rows($result) > 0) 
                        { 
                            while($row = mysqli_fetch_assoc($result)) 
                            {   
                                $posledny_update = $row["posledny_update"];
                                $vybavenie = $row["vybavenie"];
                            } 
                        } 
                        echo "
                        <div class=\"row mb-2\">
                            <h2>Posledny update:</h2>
                            <h2>".$posledny_update."</h2>  
                        </div>
                        ";  
                        echo "
                        <div class=\"row mb-2\">
                            <h2>Vybavenie senzoru:</h2>
                            <h2>".$vybavenie."</h2>  
                        </div>
                        ";   
                    }
                ?>
                <?php
                    
                    $query = get_querry(3,$rola_user);
                    
                    $result = mysqli_query($conn, $query);

                    if (mysqli_num_rows($result) > 0) 
                    { 
                        while($row = mysqli_fetch_assoc($result)) 
                        {   
                            echo "<div class=\"row mb-2\">
                            <h2>Priemerna ".$row["kategoria_nazov"].":</h2>
                                <h2>".avg_hodnota($row["kategoria_nazov"],$conn,$_GET["lokalita"])."</h2>
                            </div>";
                        } 
                    } 
                ?>
                <?php if(isset($rola_user) && $rola_user != "obyvatel" && !isset($_GET["senzor"])): ?>
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
                                        echo "<a href=\"".htmlspecialchars($_SERVER["PHP_SELF"])."?lokalita=".$_GET["lokalita"]."&senzor=".$row["id"]."\" class=\"list-group-item list-group-item-action\">Senzor ".$row["id"].", ".$row["lokacia"]."</a>";
                                    } 
                                } 
                            ?>
                        </div>
                    </div>
                <?php endif;?>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>