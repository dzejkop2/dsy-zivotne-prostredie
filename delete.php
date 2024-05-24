<?php
include("./connect.php");
include("./functions.php");
session_start();



if(isset($_POST['data_id']) && isset($_SESSION["user_id"]) != "" && role_check($conn) == "vedec") {
    $data_id = $_POST['data_id'];
    $sql = "DELETE FROM data WHERE id = ".$data_id.";";
    if(mysqli_query($conn, $sql)) {
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    } else {
        echo "nieco sa pokazilo loliky lol";
    }
} else {
    header("Location: index.php");
}
