<?php
    include("./connect.php");
    include("./functions.php");
    session_start(); 
    if (isset($_SESSION["user_id"]) != "" && role_check($conn) == "vedec")
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['log'])) {
            $senzor_id = $_POST['senzor'];
            $hodnota = $_POST['hodnota'];
            $kategoria_id = kategoria_checker($senzor_id,$conn);
            $sql = "INSERT INTO `data` (`kategoria_id`, `hodnota`, `senzor_id`) VALUES ($kategoria_id, $hodnota, $senzor_id)";
            $sql2 = "UPDATE senzor SET posledny_update = CURRENT_TIMESTAMP WHERE id = \"".$senzor_id."\";";
            if(mysqli_query($conn, $sql)) {
                mysqli_query($conn,$sql2);
                $success = "Data sa podarilo nahrať";
            } 
            else {
                $error = "Data sa nepodarilo nahrať!";
            }
        }
    }
    else {
        header('Location: index.php'); 
    }
?>

<!DOCTYPE html>
<html data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Pridanie dát | Životné prostredie</title>
</head>
<body>
    <header><?php include_once("./header.php")?></header>
    <div class="container-sm mt-3" style="max-width:500px;">
        <h2 class="text-center mb-4">Data</h2>
        <?php if (isset($success)): ?>
            <div class="alert alert-success"><?php echo $success; ?></div>
        <?php endif; ?>
        <?php if (isset($error)): ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php endif; ?>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="mb-3">
                <label for="hodnota" class="form-label">Hodnota dát</label>
                <input type="number" step=0.01 class="form-control" id="hodnota" name="hodnota" required>
            </div>
            <div class="mb-3">
                <label for="senzor" class="form-label">Senzor</label>
                <select class="form-select" id="senzor" name="senzor" aria-label="select">
                    <?php 
                        $query = "
                        SELECT *
                        FROM senzor
                        "; 
                        $result = mysqli_query($conn, $query);
                        if (mysqli_num_rows($result) > 0) { 
                            while($row = mysqli_fetch_assoc($result)) { 
                                echo "<option value=\"".$row["id"]."\">".$row["lokacia"]." (".$row["vybavenie"].")</option>";
                            } 
                        }
                    ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary" name="log">Pridať</button>
        </form>
    </div>
</body>
</html>