<?php
    include("./connect.php");
    include("./functions.php");
    session_start();
    $rola_user = role_check($conn);
    if ($rola_user != "admin") {
        header("Location: index.php");
        exit();
    }
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['del'])) {
        $query = "DELETE FROM users WHERE id = ".$_POST["del"].";"; 
        if(mysqli_query($conn, $query)) {
            $success = "Vymazanie sa podarilo";
        }
        else {
            echo "Nieco sa posralo";
        }
    } 
?>
<!DOCTYPE html>
<html data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="icon" type="image/x-icon" href="./favicon.ico">
    <title>Senzory | Životné prostredie</title>
</head>
<body>
    <header><?php include_once("./header.php")?></header>
    <div class="container-xxl column-gap-3">
        <div class="row mt-2">
            <h1>Užívatelia</h1>
            <div class="col-7">
                <?php if (isset($success)): ?>
                    <div class="alert alert-success"><?php echo $success; ?></div>
                <?php endif; ?>
                <form method="post">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Meno</th>
                                <th scope="col">Email</th>
                                <th scope="col">Rola</th>
                                <th scope="col">Heslo</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $query = "SELECT * FROM users WHERE id_rola != ".role_id_get($conn,"admin")."";
                                $result = mysqli_query($conn, $query);

                                if (mysqli_num_rows($result) > 0) 
                                { 
                                    while($row = mysqli_fetch_assoc($result)) 
                                    {   
                                        echo "
                                        <tr>
                                            <td>".$row["id"]."</td>
                                            <td>".$row["meno"]."</td>
                                            <td>".$row["email"]."</td>
                                            <td>".$row["heslo"]."</td>
                                            <td>".role_get($conn,$row["id_rola"])."</td>
                                            <td><button type=\"submit\" formaction=\"".htmlspecialchars($_SERVER["PHP_SELF"])."\" class=\"btn btn-primary\" style=\"--bs-btn-padding-y: .2rem; --bs-btn-padding-x: .45rem; --bs-btn-font-size: .7rem;\" name=\"del\" value=\"".$row["id"]."\">Vymazať</button></td>
                                        </tr>"; 
                                    } 
                                } 
                            ?>
                        </tbody>
                    </table>
                </form>
            </div>
            <div class="col-5">
                <h2>Vytvoriť nového užívateľa</h2>
                <form><button type=submit formaction="./register.php" class="btn btn-primary">Vytvoriť</button></form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>