<?php 
function get_querry($choice, $rola_user) {
    if($choice == 1) {
        if($rola_user == "uradnik" || $rola_user == "vedec" || $rola_user == "admin") {
            if(isset($_GET["cas"])) {
                if(isset($_GET["senzor"])) {
                    $query = "
                    SELECT data.id, kategoria.nazov AS kategoria_nazov, data.hodnota, senzor.lokacia AS senzor_lokacia,senzor.vybavenie AS senzor_vybavenie, data.datum, data.senzor_id
                    FROM data
                    JOIN kategoria ON data.kategoria_id = kategoria.id
                    JOIN senzor ON data.senzor_id = senzor.id
                    WHERE senzor.lokacia = \"".$_GET["lokalita"]."\" AND senzor.id = ".$_GET["senzor"]." AND datum >= NOW() - INTERVAL ".$_GET["cas"]." DAY
                    ORDER BY datum DESC;
                    "; 
                } 
                else if(isset($_GET["kategoria"])) {
                    $query = "
                    SELECT data.id, kategoria.nazov AS kategoria_nazov, data.hodnota, senzor.lokacia AS senzor_lokacia,senzor.vybavenie AS senzor_vybavenie, data.datum, data.senzor_id
                    FROM data
                    JOIN kategoria ON data.kategoria_id = kategoria.id
                    JOIN senzor ON data.senzor_id = senzor.id
                    WHERE senzor.lokacia = \"".$_GET["lokalita"]."\" AND kategoria.nazov = \"".$_GET["kategoria"]."\" AND datum >= NOW() - INTERVAL ".$_GET["cas"]." DAY
                    ORDER BY datum DESC;
                    "; 
                }
                else {
                    $query = "
                    SELECT data.id, kategoria.nazov AS kategoria_nazov, data.hodnota, senzor.lokacia AS senzor_lokacia,senzor.vybavenie AS senzor_vybavenie, data.datum, data.senzor_id
                    FROM data
                    JOIN kategoria ON data.kategoria_id = kategoria.id
                    JOIN senzor ON data.senzor_id = senzor.id
                    WHERE senzor.lokacia = \"".$_GET["lokalita"]."\" AND datum >= NOW() - INTERVAL ".$_GET["cas"]." DAY
                    ORDER BY datum DESC;
                    "; 
                }
            }
            else {
                if(isset($_GET["senzor"])) {
                    $query = "
                    SELECT data.id, kategoria.nazov AS kategoria_nazov, data.hodnota, senzor.lokacia AS senzor_lokacia,senzor.vybavenie AS senzor_vybavenie, data.datum, data.senzor_id
                    FROM data
                    JOIN kategoria ON data.kategoria_id = kategoria.id
                    JOIN senzor ON data.senzor_id = senzor.id
                    WHERE senzor.lokacia = \"".$_GET["lokalita"]."\" AND senzor.id = ".$_GET["senzor"]."
                    ORDER BY datum DESC;
                    "; 
                } 
                else if(isset($_GET["kategoria"])) {
                    $query = "
                    SELECT data.id, kategoria.nazov AS kategoria_nazov, data.hodnota, senzor.lokacia AS senzor_lokacia,senzor.vybavenie AS senzor_vybavenie, data.datum, data.senzor_id
                    FROM data
                    JOIN kategoria ON data.kategoria_id = kategoria.id
                    JOIN senzor ON data.senzor_id = senzor.id
                    WHERE senzor.lokacia = \"".$_GET["lokalita"]."\" AND kategoria.nazov = \"".$_GET["kategoria"]."\"
                    ORDER BY datum DESC;
                    "; 
                }
                else {
                    $query = "
                    SELECT data.id, kategoria.nazov AS kategoria_nazov, data.hodnota, senzor.lokacia AS senzor_lokacia,senzor.vybavenie AS senzor_vybavenie, data.datum, data.senzor_id
                    FROM data
                    JOIN kategoria ON data.kategoria_id = kategoria.id
                    JOIN senzor ON data.senzor_id = senzor.id
                    WHERE senzor.lokacia = \"".$_GET["lokalita"]."\"
                    ORDER BY datum DESC;
                    "; 
                }
            }
        }
        else {
            if(isset($_GET["cas"])) {
                if(isset($_GET["senzor"])) {
                    $query = "
                    SELECT data.id, kategoria.nazov AS kategoria_nazov, data.hodnota, senzor.lokacia AS senzor_lokacia,senzor.vybavenie AS senzor_vybavenie, data.datum, data.senzor_id
                    FROM data
                    JOIN kategoria ON data.kategoria_id = kategoria.id
                    JOIN senzor ON data.senzor_id = senzor.id
                    WHERE senzor.lokacia = \"".$_GET["lokalita"]."\" AND senzor.id = ".$_GET["senzor"]." AND datum >= NOW() - INTERVAL ".$_GET["cas"]." DAY
                    ORDER BY datum DESC;
                    "; 
                } 
                else if(isset($_GET["kategoria"])) {
                    $query = "
                    SELECT data.id, kategoria.nazov AS kategoria_nazov, data.hodnota, senzor.lokacia AS senzor_lokacia,senzor.vybavenie AS senzor_vybavenie, data.datum, data.senzor_id
                    FROM data
                    JOIN kategoria ON data.kategoria_id = kategoria.id
                    JOIN senzor ON data.senzor_id = senzor.id
                    WHERE senzor.lokacia = \"".$_GET["lokalita"]."\" AND kategoria.nazov = \"".$_GET["kategoria"]."\" AND datum >= NOW() - INTERVAL ".$_GET["cas"]." DAY
                    ORDER BY datum DESC;
                    "; 
                }
                else {
                    $query = "
                    SELECT data.id, kategoria.nazov AS kategoria_nazov, data.hodnota, senzor.lokacia AS senzor_lokacia,senzor.vybavenie AS senzor_vybavenie, data.datum, data.senzor_id
                    FROM data
                    JOIN kategoria ON data.kategoria_id = kategoria.id
                    JOIN senzor ON data.senzor_id = senzor.id
                    WHERE senzor.lokacia = \"".$_GET["lokalita"]."\" AND datum >= NOW() - INTERVAL ".$_GET["cas"]." DAY
                    ORDER BY datum DESC;
                    "; 
                }
            }
            else {
                if(isset($_GET["senzor"])) {
                    $query = "
                    SELECT data.id, kategoria.nazov AS kategoria_nazov, data.hodnota, senzor.lokacia AS senzor_lokacia,senzor.vybavenie AS senzor_vybavenie, data.datum, data.senzor_id
                    FROM data
                    JOIN kategoria ON data.kategoria_id = kategoria.id
                    JOIN senzor ON data.senzor_id = senzor.id
                    WHERE senzor.lokacia = \"".$_GET["lokalita"]."\" AND senzor.id = ".$_GET["senzor"]." AND datum >= NOW() - INTERVAL 30 DAY
                    ORDER BY datum DESC;
                    "; 
                } 
                else if(isset($_GET["kategoria"])) {
                    $query = "
                    SELECT data.id, kategoria.nazov AS kategoria_nazov, data.hodnota, senzor.lokacia AS senzor_lokacia,senzor.vybavenie AS senzor_vybavenie, data.datum, data.senzor_id
                    FROM data
                    JOIN kategoria ON data.kategoria_id = kategoria.id
                    JOIN senzor ON data.senzor_id = senzor.id
                    WHERE senzor.lokacia = \"".$_GET["lokalita"]."\" AND kategoria.nazov = \"".$_GET["kategoria"]."\" AND datum >= NOW() - INTERVAL 30 DAY
                    ORDER BY datum DESC;
                    "; 
                }
                else {
                    $query = "
                    SELECT data.id, kategoria.nazov AS kategoria_nazov, data.hodnota, senzor.lokacia AS senzor_lokacia,senzor.vybavenie AS senzor_vybavenie, data.datum, data.senzor_id
                    FROM data
                    JOIN kategoria ON data.kategoria_id = kategoria.id
                    JOIN senzor ON data.senzor_id = senzor.id
                    WHERE senzor.lokacia = \"".$_GET["lokalita"]."\" AND datum >= NOW() - INTERVAL 30 DAY
                    ORDER BY datum DESC;
                    "; 
                }
            }
        }
    }
    else if($choice == 2) {
        if($rola_user == "uradnik" || $rola_user == "vedec" || $rola_user == "admin") {
            if(isset($_GET["cas"])) {
                if(isset($_GET["kategoria"])) {
                    $query = "
                    SELECT data.id, kategoria.nazov AS kategoria_nazov, data.hodnota, senzor.lokacia AS senzor_lokacia,senzor.vybavenie AS senzor_vybavenie, data.datum, data.senzor_id
                    FROM data
                    JOIN kategoria ON data.kategoria_id = kategoria.id
                    JOIN senzor ON data.senzor_id = senzor.id
                    WHERE kategoria.nazov = \"".$_GET["kategoria"]."\" AND datum >= NOW() - INTERVAL ".$_GET["cas"]." DAY
                    ORDER BY datum DESC;
                    "; 
                }
                else {
                    $query = "
                    SELECT data.id, kategoria.nazov AS kategoria_nazov, data.hodnota, senzor.lokacia AS senzor_lokacia,senzor.vybavenie AS senzor_vybavenie, data.datum, data.senzor_id
                    FROM data
                    JOIN kategoria ON data.kategoria_id = kategoria.id
                    JOIN senzor ON data.senzor_id = senzor.id
                    WHERE datum >= NOW() - INTERVAL ".$_GET["cas"]." DAY
                    ORDER BY datum DESC;
                    "; 
                }
            }
            else {
                if(isset($_GET["kategoria"])) {
                    $query = "
                    SELECT data.id, kategoria.nazov AS kategoria_nazov, data.hodnota, senzor.lokacia AS senzor_lokacia,senzor.vybavenie AS senzor_vybavenie, data.datum, data.senzor_id
                    FROM data
                    JOIN kategoria ON data.kategoria_id = kategoria.id
                    JOIN senzor ON data.senzor_id = senzor.id
                    WHERE kategoria.nazov = \"".$_GET["kategoria"]."\"
                    ORDER BY datum DESC;
                    "; 
                }
                else {
                    $query = "
                    SELECT data.id, kategoria.nazov AS kategoria_nazov, data.hodnota, senzor.lokacia AS senzor_lokacia,senzor.vybavenie AS senzor_vybavenie, data.datum, data.senzor_id
                    FROM data
                    JOIN kategoria ON data.kategoria_id = kategoria.id
                    JOIN senzor ON data.senzor_id = senzor.id
                    ORDER BY datum DESC;
                    "; 
                }
            }
            
        }
        else {
            if(isset($_GET["cas"])) {
                if(isset($_GET["kategoria"])) {
                    $query = "
                    SELECT data.id, kategoria.nazov AS kategoria_nazov, data.hodnota, senzor.lokacia AS senzor_lokacia,senzor.vybavenie AS senzor_vybavenie, data.datum, data.senzor_id
                    FROM data
                    JOIN kategoria ON data.kategoria_id = kategoria.id
                    JOIN senzor ON data.senzor_id = senzor.id
                    WHERE kategoria.nazov = \"".$_GET["kategoria"]."\" AND datum >= NOW() - INTERVAL ".$_GET["cas"]." DAY
                    ORDER BY datum DESC;
                    "; 
                }
                else {
                    $query = "
                    SELECT data.id, kategoria.nazov AS kategoria_nazov, data.hodnota, senzor.lokacia AS senzor_lokacia,senzor.vybavenie AS senzor_vybavenie, data.datum, data.senzor_id
                    FROM data
                    JOIN kategoria ON data.kategoria_id = kategoria.id
                    JOIN senzor ON data.senzor_id = senzor.id
                    WHERE datum >= NOW() - INTERVAL ".$_GET["cas"]." DAY
                    ORDER BY datum DESC;
                    "; 
                }
            }
            else {
                if(isset($_GET["kategoria"])) {
                    $query = "
                    SELECT data.id, kategoria.nazov AS kategoria_nazov, data.hodnota, senzor.lokacia AS senzor_lokacia,senzor.vybavenie AS senzor_vybavenie, data.datum, data.senzor_id
                    FROM data
                    JOIN kategoria ON data.kategoria_id = kategoria.id
                    JOIN senzor ON data.senzor_id = senzor.id
                    WHERE kategoria.nazov = \"".$_GET["kategoria"]."\" AND datum >= NOW() - INTERVAL 30 DAY
                    ORDER BY datum DESC;
                    "; 
                }
                else {
                    $query = "
                    SELECT data.id, kategoria.nazov AS kategoria_nazov, data.hodnota, senzor.lokacia AS senzor_lokacia,senzor.vybavenie AS senzor_vybavenie, data.datum, data.senzor_id
                    FROM data
                    JOIN kategoria ON data.kategoria_id = kategoria.id
                    JOIN senzor ON data.senzor_id = senzor.id
                    WHERE datum >= NOW() - INTERVAL 30 DAY
                    ORDER BY datum DESC;
                    "; 
                }
            }
        }
    }
    else if($choice == 3) {
        if($rola_user == "uradnik" || $rola_user == "vedec" || $rola_user == "admin") {
            if(isset($_GET["cas"])) {
                if(isset($_GET["senzor"])) {
                    $query = "
                    SELECT data.id, kategoria.nazov AS kategoria_nazov, data.hodnota, senzor.lokacia AS senzor_lokacia,senzor.vybavenie AS senzor_vybavenie, data.datum, data.senzor_id
                    FROM data
                    JOIN kategoria ON data.kategoria_id = kategoria.id
                    JOIN senzor ON data.senzor_id = senzor.id
                    WHERE senzor.lokacia = \"".$_GET["lokalita"]."\" AND senzor.id = ".$_GET["senzor"]." AND datum >= NOW() - INTERVAL ".$_GET["cas"]." DAY
                    GROUP BY kategoria.nazov;
                    "; 
                } 
                else if(isset($_GET["kategoria"])) {
                    $query = "
                    SELECT data.id, kategoria.nazov AS kategoria_nazov, data.hodnota, senzor.lokacia AS senzor_lokacia,senzor.vybavenie AS senzor_vybavenie, data.datum, data.senzor_id
                    FROM data
                    JOIN kategoria ON data.kategoria_id = kategoria.id
                    JOIN senzor ON data.senzor_id = senzor.id
                    WHERE senzor.lokacia = \"".$_GET["lokalita"]."\" AND kategoria.nazov = \"".$_GET["kategoria"]."\" AND datum >= NOW() - INTERVAL ".$_GET["cas"]." DAY
                    GROUP BY kategoria.nazov;
                    "; 
                }
                else {
                    $query = "
                    SELECT data.id, kategoria.nazov AS kategoria_nazov, data.hodnota, senzor.lokacia AS senzor_lokacia,senzor.vybavenie AS senzor_vybavenie, data.datum, data.senzor_id
                    FROM data
                    JOIN kategoria ON data.kategoria_id = kategoria.id
                    JOIN senzor ON data.senzor_id = senzor.id
                    WHERE senzor.lokacia = \"".$_GET["lokalita"]."\" AND datum >= NOW() - INTERVAL ".$_GET["cas"]." DAY
                    GROUP BY kategoria.nazov;
                    "; 
                }
            }
            else {
                if(isset($_GET["senzor"])) {
                    $query = "
                    SELECT data.id, kategoria.nazov AS kategoria_nazov, data.hodnota, senzor.lokacia AS senzor_lokacia,senzor.vybavenie AS senzor_vybavenie, data.datum, data.senzor_id
                    FROM data
                    JOIN kategoria ON data.kategoria_id = kategoria.id
                    JOIN senzor ON data.senzor_id = senzor.id
                    WHERE senzor.lokacia = \"".$_GET["lokalita"]."\" AND senzor.id = ".$_GET["senzor"]."
                    GROUP BY kategoria.nazov;
                    "; 
                } 
                else if(isset($_GET["kategoria"])) {
                    $query = "
                    SELECT data.id, kategoria.nazov AS kategoria_nazov, data.hodnota, senzor.lokacia AS senzor_lokacia,senzor.vybavenie AS senzor_vybavenie, data.datum, data.senzor_id
                    FROM data
                    JOIN kategoria ON data.kategoria_id = kategoria.id
                    JOIN senzor ON data.senzor_id = senzor.id
                    WHERE senzor.lokacia = \"".$_GET["lokalita"]."\" AND kategoria.nazov = \"".$_GET["kategoria"]."\"
                    GROUP BY kategoria.nazov;
                    "; 
                }
                else {
                    $query = "
                    SELECT data.id, kategoria.nazov AS kategoria_nazov, data.hodnota, senzor.lokacia AS senzor_lokacia,senzor.vybavenie AS senzor_vybavenie, data.datum, data.senzor_id
                    FROM data
                    JOIN kategoria ON data.kategoria_id = kategoria.id
                    JOIN senzor ON data.senzor_id = senzor.id
                    WHERE senzor.lokacia = \"".$_GET["lokalita"]."\"
                    GROUP BY kategoria.nazov;
                    "; 
                }
            }
        }
        else {
            if(isset($_GET["cas"])) {
                if(isset($_GET["senzor"])) {
                    $query = "
                    SELECT data.id, kategoria.nazov AS kategoria_nazov, data.hodnota, senzor.lokacia AS senzor_lokacia,senzor.vybavenie AS senzor_vybavenie, data.datum, data.senzor_id
                    FROM data
                    JOIN kategoria ON data.kategoria_id = kategoria.id
                    JOIN senzor ON data.senzor_id = senzor.id
                    WHERE senzor.lokacia = \"".$_GET["lokalita"]."\" AND senzor.id = ".$_GET["senzor"]." AND datum >= NOW() - INTERVAL ".$_GET["cas"]." DAY
                    GROUP BY kategoria.nazov;
                    "; 
                } 
                else if(isset($_GET["kategoria"])) {
                    $query = "
                    SELECT data.id, kategoria.nazov AS kategoria_nazov, data.hodnota, senzor.lokacia AS senzor_lokacia,senzor.vybavenie AS senzor_vybavenie, data.datum, data.senzor_id
                    FROM data
                    JOIN kategoria ON data.kategoria_id = kategoria.id
                    JOIN senzor ON data.senzor_id = senzor.id
                    WHERE senzor.lokacia = \"".$_GET["lokalita"]."\" AND kategoria.nazov = \"".$_GET["kategoria"]."\" AND datum >= NOW() - INTERVAL ".$_GET["cas"]." DAY
                    GROUP BY kategoria.nazov;
                    "; 
                }
                else {
                    $query = "
                    SELECT data.id, kategoria.nazov AS kategoria_nazov, data.hodnota, senzor.lokacia AS senzor_lokacia,senzor.vybavenie AS senzor_vybavenie, data.datum, data.senzor_id
                    FROM data
                    JOIN kategoria ON data.kategoria_id = kategoria.id
                    JOIN senzor ON data.senzor_id = senzor.id
                    WHERE senzor.lokacia = \"".$_GET["lokalita"]."\" AND datum >= NOW() - INTERVAL ".$_GET["cas"]." DAY
                    GROUP BY kategoria.nazov;
                    "; 
                }
            }
            else {
                if(isset($_GET["senzor"])) {
                    $query = "
                    SELECT data.id, kategoria.nazov AS kategoria_nazov, data.hodnota, senzor.lokacia AS senzor_lokacia,senzor.vybavenie AS senzor_vybavenie, data.datum, data.senzor_id
                    FROM data
                    JOIN kategoria ON data.kategoria_id = kategoria.id
                    JOIN senzor ON data.senzor_id = senzor.id
                    WHERE senzor.lokacia = \"".$_GET["lokalita"]."\" AND senzor.id = ".$_GET["senzor"]." AND datum >= NOW() - INTERVAL 30 DAY
                    GROUP BY kategoria.nazov;
                    "; 
                } 
                else if(isset($_GET["kategoria"])) {
                    $query = "
                    SELECT data.id, kategoria.nazov AS kategoria_nazov, data.hodnota, senzor.lokacia AS senzor_lokacia,senzor.vybavenie AS senzor_vybavenie, data.datum, data.senzor_id
                    FROM data
                    JOIN kategoria ON data.kategoria_id = kategoria.id
                    JOIN senzor ON data.senzor_id = senzor.id
                    WHERE senzor.lokacia = \"".$_GET["lokalita"]."\" AND kategoria.nazov = \"".$_GET["kategoria"]."\" AND datum >= NOW() - INTERVAL 30 DAY
                    GROUP BY kategoria.nazov;
                    "; 
                }
                else {
                    $query = "
                    SELECT data.id, kategoria.nazov AS kategoria_nazov, data.hodnota, senzor.lokacia AS senzor_lokacia,senzor.vybavenie AS senzor_vybavenie, data.datum, data.senzor_id
                    FROM data
                    JOIN kategoria ON data.kategoria_id = kategoria.id
                    JOIN senzor ON data.senzor_id = senzor.id
                    WHERE senzor.lokacia = \"".$_GET["lokalita"]."\" AND datum >= NOW() - INTERVAL 30 DAY
                    GROUP BY kategoria.nazov;
                    "; 
                }
            }
        }
    }
    return $query;
}
