<div class="dropdown">
    <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
        <?php 
            $rola_user = role_check($conn);    
            if(isset($_GET["cas"]) && $_GET["cas"] != "1") {
                echo $_GET["cas"];
                echo " dní";
            } 
            else if(isset($_GET["cas"]) && $_GET["cas"] == "1"){
                echo "Dnes";
            }
            else {
                if($rola_user != "obyvatel" && isset($_SESSION["user_id"]) != "") {
                    echo "Všetko";
                }
                else { 
                    echo "Vybrať";
                }
            }
        ?>
    </button>
    <ul class="dropdown-menu">
        <?php 
            
            if(isset($_GET["cas"]) && $_GET["cas"] != "1" || !isset($_GET["cas"])) {
                if(isset($_GET["lokalita"]) && isset($_GET["kategoria"])) {
                    echo "<li><a class=\"dropdown-item\" href=\"".htmlspecialchars($_SERVER["PHP_SELF"])."?cas=1&lokalita=".$_GET["lokalita"]."&kategoria=".$_GET["kategoria"]."\">Dnes</a></li>";
                } 
                else if(isset($_GET["kategoria"])) {
                    echo "<li><a class=\"dropdown-item\" href=\"".htmlspecialchars($_SERVER["PHP_SELF"])."?cas=1&kategoria=".$_GET["kategoria"]."\">Dnes</a></li>";
                } 
                else if(isset($_GET["lokalita"])) {
                    echo "<li><a class=\"dropdown-item\" href=\"".htmlspecialchars($_SERVER["PHP_SELF"])."?cas=1&lokalita=".$_GET["lokalita"]."\">Dnes</a></li>";
                }
                else {
                    echo "<li><a class=\"dropdown-item\" href=\"".htmlspecialchars($_SERVER["PHP_SELF"])."?cas=1\">Dnes</a></li>";
                }
            }
            $i = 15;
            while($i <= 30) {
                if(isset($_GET["cas"]) && $_GET["cas"] == $i)
                {
                    $i += 15;
                    continue;
                } 
                else {
                    if(isset($_GET["lokalita"]) && isset($_GET["kategoria"])) {
                        echo "<li><a class=\"dropdown-item\" href=\"".htmlspecialchars($_SERVER["PHP_SELF"])."?cas=".$i."&lokalita=".$_GET["lokalita"]."&kategoria=".$_GET["kategoria"]."\">".$i." dní</a></li>";
                    } 
                    else if(isset($_GET["kategoria"])) {
                        echo "<li><a class=\"dropdown-item\" href=\"".htmlspecialchars($_SERVER["PHP_SELF"])."?cas=".$i."&kategoria=".$_GET["kategoria"]."\">".$i." dní</a></li>";
                    } 
                    else if(isset($_GET["lokalita"])) {
                        echo "<li><a class=\"dropdown-item\" href=\"".htmlspecialchars($_SERVER["PHP_SELF"])."?cas=".$i."&lokalita=".$_GET["lokalita"]."\">".$i." dní</a></li>";
                    }
                    else {
                        echo "<li><a class=\"dropdown-item\" href=\"".htmlspecialchars($_SERVER["PHP_SELF"])."?cas=".$i."\">".$i." dní</a></li>";
                    }
                    $i += 15;
                }
                                
            }    
            if(isset($_GET["cas"])) {
                if($rola_user != "obyvatel" && isset($_SESSION["user_id"]) != "") {
                    if(isset($_GET["lokalita"]) && isset($_GET["kategoria"])) {
                        echo "<li><a class=\"dropdown-item\" href=\"".htmlspecialchars($_SERVER["PHP_SELF"])."?lokalita=".$_GET["lokalita"]."&kategoria=".$_GET["kategoria"]."\">Všetko</a></li>";
                    } 
                    else if(isset($_GET["kategoria"])) {
                        echo "<li><a class=\"dropdown-item\" href=\"".htmlspecialchars($_SERVER["PHP_SELF"])."?kategoria=".$_GET["kategoria"]."\">Všetko</a></li>";
                    } 
                    else if(isset($_GET["lokalita"])) {
                        echo "<li><a class=\"dropdown-item\" href=\"".htmlspecialchars($_SERVER["PHP_SELF"])."?lokalita=".$_GET["lokalita"]."\">Všetko</a></li>";
                    }
                    else {
                        echo "<li><a class=\"dropdown-item\" href=\"".htmlspecialchars($_SERVER["PHP_SELF"])."\">Všetko</a></li>";
                    }
                }
            }
        ?>
    </ul>
</div>