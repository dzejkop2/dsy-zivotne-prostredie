<?php
    include("./connect.php");
    include("./functions.php");
    session_start();
    $rola_user = role_check($conn);
    $query = "SELECT * FROM users WHERE id = ".$_SESSION["user_id"]."";
    $result = mysqli_query($conn,$query);
    if(mysqli_num_rows($result)> 0) {
        while($row = mysqli_fetch_assoc($result)) 
        {   
            $meno = $row["meno"];
            $email = $row["email"];
        } 
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['del'])) {
        $query = "DELETE FROM users WHERE id = ".$_POST["del"].";"; 
        if(mysqli_query($conn, $query)) {
            header("Location: logout.php");
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
    <title>Profil | Životné prostredie</title>
</head>
<body>
    <header><?php include_once("./header.php")?></header>
    <div class="container-xxl column-gap-3">
        <div class="row mt-2">
            <h1><?php echo $meno;?></h1>
            <div class="col-8">
                <h2>Email: <?php echo $email;?></h2>
                <h2>Rola: <?php echo $rola_user;?></h2>
            </div>
            <div class="col-4">
                <div class="row mb-2">
                    <h2>Vymazať profil</h2>
                    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                        <?php echo "<button type=\"submit\" class=\"btn btn-primary\" name=\"del\" value=\"".$_SESSION["user_id"]."\">Vymazať</button>"; ?>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>