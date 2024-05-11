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
        $avg = "".$sum / mysqli_num_rows($result2)."".jednotka($kategoria)."";
        return $avg;
    }
    else
    {
        return "Nie je dostatok informácií";
    }
}