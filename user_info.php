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
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['new_mail'])) {
        $email = $_POST['email'];
        $user_id = $_POST['new_mail'];
        $query = "SELECT * FROM users WHERE email = \"".$email."\";"; 
        $result = mysqli_query($conn, $query);
        if (mysqli_num_rows($result) == 0) { 
            $sql = "UPDATE users SET email = \"".$email."\" WHERE id = ".$user_id."";
            if(mysqli_query($conn, $sql)) {
                $success = "Email zmenený úspešne";
            } 
            else {
                $error = "Niečo sa pokazilo! Skús ešte raz!";
            }
        
        } 
        else {
            $error = "Tento email sa už používa!";
        }
    }
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['new_password'])) {
        $password = $_POST['heslo'];
        $user_id = $_POST['new_password'];
        $sql = "UPDATE users SET heslo = \"".$password."\" WHERE id = ".$user_id."";
        if(mysqli_query($conn, $sql)) {
            $success = "Heslo zmenené úspešne";
        } 
        else {
            $error = "Niečo sa pokazilo! Skús ešte raz!";
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
    <title>Profil | Životné prostredie</title>
</head>
<body>
    <header><?php include_once("./header.php")?></header>
    <div class="container-xxl column-gap-3">
        <div class="row mt-2 d-flex justify-content-center">
            <h1><?php echo $meno;?></h1>
            <div class="col-5">
                <h2 class="my-2">Email: </h2> <?php echo "<p class=\"fs-4 mb-3\">$email</p>";?>
                <h2 class="">Rola: </h2> <?php echo "<p class=\"fs-4 mb-3\">$rola_user</p>"?>
            </div>
            <div class="col-4">
            <?php if (isset($success)): ?>
                <div class="alert alert-success"><?php echo $success; ?></div>
            <?php endif; ?>
            <?php if (isset($error)): ?>
                <div class="alert alert-danger"><?php echo $error; ?></div>
            <?php endif; ?>
                <div class="row mb-4">
                    <h2>Zmeniť email</h2>
                    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                        <div class="mb-3">
                            <label for="email" class="form-label">Nový email</label>
                            <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" required>
                        </div>
                        <?php echo "<button type=\"submit\" class=\"btn btn-primary\" name=\"new_mail\" value=\"".$_SESSION["user_id"]."\">Zmeniť</button>"; ?>
                    </form>
                </div>
                <div class="row mb-5">
                    <h2>Zmeniť heslo</h2>
                    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                        <div class="mb-3">
                            <label for="heslo" class="form-label">Heslo</label>
                            <input type="password" class="form-control" id="heslo" name="heslo" required>
                        </div>
                        <?php echo "<button type=\"submit\" class=\"btn btn-primary\" name=\"new_password\" value=\"".$_SESSION["user_id"]."\">Zmeniť</button>"; ?>
                    </form>
                </div>
                <div class="row mb-4">
                    <div class="col-10">
                        <h2>Vymazať profil</h2>
                    </div>
                    <div class="col-2">
                        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                            <?php echo "<button type=\"submit\" class=\"btn btn-primary float-end\" name=\"del\" value=\"".$_SESSION["user_id"]."\">Vymazať</button>"; ?>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>