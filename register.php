<?php
    include("./connect.php");
    include("./functions.php");
    session_start();
    $rola_user = role_check($conn);


    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['register'])) {
        $name = $_POST['krstne_meno'];
        $surname = $_POST['priezvisko'];
        $full_name = "".$name." ".$surname."";
        $email = $_POST['email'];
        $password = $_POST['heslo'];
        if(isset($_POST["role_select"])) {
            $role = $_POST["role_select"];
        }
        else {
            $query = "
            SELECT *
            FROM role WHERE nazov = \"obyvatel\"
            "; 
            $result = mysqli_query($conn, $query);
            if (mysqli_num_rows($result) > 0) { 
                while($row = mysqli_fetch_assoc($result)) { 
                    $role = $row["id"];
                } 
            }
            
        }
        
        $query = "SELECT * FROM users WHERE email = \"".$email."\";"; 
        $result = mysqli_query($conn, $query);
        if (mysqli_num_rows($result) == 0) { 
            $sql = "INSERT INTO `users` (`meno`, `email`, `heslo`, `id_rola`) VALUES (\"$full_name\", \"$email\", \"$password\", \"$role\")";
            if(mysqli_query($conn, $sql)) {
                if($rola_user == "admin"){
                    header("Location: admin.php");
                }
                $register_success = "Registracia uspešna! Teraz sa možeš prihlasiť.";
            } 
            else {
                $error = "Niečo sa pokazilo! Skús ešte raz!";
            }
        
        } 
        else {
            $error = "Konto na tento email už existuje!";
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
    <title><?php if($rola_user == "admin") {
        echo "Pridanie užívateľa";
    } else {
        echo "Register";
    }?> | Životné prostredie</title>
</head>
<body>
    <header><?php include_once("./header.php")?></header>
    <div class="container-sm mt-3" style="max-width:500px;">
        <h2 class="text-center mb-4"><?php if($rola_user == "admin") {
        echo "Pridanie užívateľa";
        } else {
            echo "Register";
        }?>
        </h2>
        <?php if (isset($register_success)): ?>
            <div class="alert alert-success"><?php echo $register_success; ?></div>
        <?php endif; ?>
        <?php if (isset($error)): ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php endif; ?>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="mb-3">
                <label for="krstne_meno" class="form-label">Meno</label>
                <input type="text" class="form-control" id="krstne_meno" name="krstne_meno" required>
            </div>
            <div class="mb-3">
                <label for="priezvisko" class="form-label">Priezvisko</label>
                <input type="text" class="form-control" id="priezvisko" name="priezvisko" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" required>
            </div>
            <div class="mb-3">
                <label for="heslo" class="form-label">Heslo</label>
                <input type="password" class="form-control" id="heslo" name="heslo" required>
            </div>
            <?php if($rola_user == "admin") {?>
            <div class="mb-3">
                <label for="role_select" class="form-label">Rola</label>
                <select class="form-select" id="role_select" name="role_select" aria-label="select">
                    <?php 
                        $query = "
                        SELECT *
                        FROM role WHERE nazov != \"admin\"
                        "; 
                        $result = mysqli_query($conn, $query);
                        if (mysqli_num_rows($result) > 0) { 
                            while($row = mysqli_fetch_assoc($result)) { 
                                if($row["nazov"] == "obyvatel") {
                                    echo "<option value=\"".$row["id"]."\"selected>".$row["nazov"]."</option>";
                                } 
                                else {
                                    echo "<option value=\"".$row["id"]."\">".$row["nazov"]."</option>";
                                }
                            } 
                        }
                    ?>
                </select>
            </div>
            <?php };?>
            <button type="submit" class="btn btn-primary" name="register">Register</button>
        </form>
    </div>
</body>
</html>