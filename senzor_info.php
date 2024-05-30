<?php
    include("./connect.php");
    include("./functions.php");
    session_start();
    $rola_user = role_check($conn);
    if ($rola_user != "uradnik"  && $rola_user != "vedec") {
        header("Location: index.php");
    }
?>
<!DOCTYPE html>
<html data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Senzory | Životné prostredie</title>
</head>
<body>
    <header><?php include_once("./header.php")?></header>
    <div class="container-xxl column-gap-3">
        <div class="row mt-2">
            <h1>Senzory</h1>
            <div class="col-12">
                <form method="post">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Lokalita</th>
                                <th scope="col">Posledný update</th>
                                <th scope="col">Vybavenie</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $query = "SELECT * FROM senzor";
                                
                                $result = mysqli_query($conn, $query);

                                if (mysqli_num_rows($result) > 0) 
                                { 
                                    while($row = mysqli_fetch_assoc($result)) 
                                    {   
                                        echo "
                                        <tr>
                                            <td>".$row["lokacia"]."</td>
                                            <td>".$row["posledny_update"]."</td>
                                            <td>".$row["vybavenie"]."</td>
                                            <td><button type=\"submit\" formaction=\"./lokalita_info.php?lokalita=".$row["lokacia"]."&senzor=".$row["id"]."\" class=\"btn btn-primary\" style=\"--bs-btn-padding-y: .2rem; --bs-btn-padding-x: .45rem; --bs-btn-font-size: .7rem;\">Informácie</button></td>
                                        </tr>"; 
                                    } 
                                } 
                            ?>
                        </tbody>
                    </table>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>