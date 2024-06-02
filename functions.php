<?php
function jednotka($kategoria) {
    if($kategoria == "vlhkost")
    {
        return "%"; 
    }
    elseif($kategoria == "teplota")
    {
        return "°C";
    }
    else 
    {
        return "";
    }
}

function avg_hodnota($kategoria,$conn,$miesto) {
    $query1= "SELECT id FROM kategoria WHERE nazov = \"".$kategoria."\"";
    $result1 = mysqli_query($conn, $query1);
    $kategoria_id = "";
    while($row = mysqli_fetch_assoc($result1)) 
    {   
        $kategoria_id = $row["id"];
    }

    $query2 = "SELECT data.hodnota, senzor.lokacia AS senzor_lokacia
        FROM data
        JOIN senzor ON data.senzor_id = senzor.id
        WHERE senzor.lokacia = \"".$miesto."\" AND kategoria_id = ".$kategoria_id.";
    ";
    $result2 = mysqli_query($conn, $query2);
    $sum = 0;
    if (mysqli_num_rows($result2) > 0) 
    { 
        while($row = mysqli_fetch_assoc($result2)) 
        {   
            $sum += floatval($row["hodnota"]);    
        } 
        $avg = "".round($sum / mysqli_num_rows($result2),2)."".jednotka($kategoria)."";
        return $avg;
    }
    else
    {
        return "Nie je dostatok informácií";
    }
}

function role_check($conn) {
    if(isset($_SESSION["user_id"]) != "") {
        $role_id = $_SESSION["role_id"];
        $query = "SELECT * FROM role WHERE id = ".$role_id."";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) > 0) 
        { 
            while($row = mysqli_fetch_assoc($result)) 
            { 
                $rola_user = $row["nazov"];
                return $rola_user;
            } 
        } 
    }
}

function role_get($conn, $role_id) {
    $query = "SELECT * FROM role WHERE id = ".$role_id."";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) 
    { 
        while($row = mysqli_fetch_assoc($result)) 
        { 
            $rola_user = $row["nazov"];
            return $rola_user;
        } 
    } 
}

function role_id_get($conn, $role) {
    $query = "SELECT * FROM role WHERE nazov = \"".$role."\"";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) 
    { 
        while($row = mysqli_fetch_assoc($result)) 
        { 
            $rola_user = $row["id"];
            return $rola_user;
        } 
    } 
}
/*
function kategoria_checker($senzor_id,$conn) {
    $query = "SELECT * FROM senzor WHERE id = ".$senzor_id."";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            if($row["vybavenie"] == "teplomer")
            {
                $kategoria = "teplota"; 
            }
            elseif($row["vybavenie"] == "vlhkomer")
            {
                $kategoria = "vlhkost";
            }
        }
    }
    $query2 = "SELECT * FROM kategoria WHERE nazov = \"".$kategoria."\"";
    $result2 = mysqli_query($conn, $query2);
    if (mysqli_num_rows($result2) > 0) {
        while($row = mysqli_fetch_assoc($result2)) {
            return $row["id"];
        }
    }
}

function kategoria_id($kategoria,$conn) {
    $query = "SELECT * FROM kategoria WHERE nazov = \"".$kategoria."\"";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            return $row["id"];
        }
    }
}
*/

function get_name($user_id,$conn) {
    $query = "SELECT * FROM users WHERE id = ".$user_id."";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            return $row["meno"];
        }
    }
}