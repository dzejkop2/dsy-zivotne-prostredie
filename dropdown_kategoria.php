<div class="dropdown">
    <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
        <?php 
            if(isset($_GET["kategoria"])) {
                echo $_GET["kategoria"];
            } 
            else {
                echo "Všetko";
            }
        ?>
    </button>
    <ul class="dropdown-menu">
        <?php 
            if(isset($_GET["kategoria"])) {
                $query = "
                SELECT *
                FROM kategoria
                WHERE nazov != \"".$_GET["kategoria"]."\"    
                "; 
                if(isset($_GET["lokalita"]) && isset($_GET["cas"])) {
                    echo "<li><a class=\"dropdown-item\" href=\"".htmlspecialchars($_SERVER["PHP_SELF"])."?lokalita=".$_GET["lokalita"]."&cas=".$_GET["cas"]."\">Všetko</a></li>";
                }
                else if(isset($_GET["lokalita"])) {
                    echo "<li><a class=\"dropdown-item\" href=\"".htmlspecialchars($_SERVER["PHP_SELF"])."?lokalita=".$_GET["lokalita"]."\">Všetko</a></li>";
                }
                else if(isset($_GET["cas"])) {
                    echo "<li><a class=\"dropdown-item\" href=\"".htmlspecialchars($_SERVER["PHP_SELF"])."?cas=".$_GET["cas"]."\">Všetko</a></li>";
                }
                else {
                    echo "<li><a class=\"dropdown-item\" href=\"".htmlspecialchars($_SERVER["PHP_SELF"])."\">Všetko</a></li>";
                }
            }
            else {
                $query = "
                SELECT *
                FROM kategoria    
                "; 
            }
            $result = mysqli_query($conn, $query);
            if (mysqli_num_rows($result) > 0) { 
                while($row = mysqli_fetch_assoc($result)) { 
                    if(isset($_GET["lokalita"]) && isset($_GET["cas"])) {
                        echo "<li><a class=\"dropdown-item\" href=\"".htmlspecialchars($_SERVER["PHP_SELF"])."?kategoria=".$row["nazov"]."&lokalita=".$_GET["lokalita"]."&cas=".$_GET["cas"]."\">".$row["nazov"]."</a></li>";
                    } 
                    else if(isset($_GET["cas"])) {
                        echo "<li><a class=\"dropdown-item\" href=\"".htmlspecialchars($_SERVER["PHP_SELF"])."?kategoria=".$row["nazov"]."&cas=".$_GET["cas"]."\">".$row["nazov"]."</a></li>";
                    } 
                    else if(isset($_GET["lokalita"])) {
                        echo "<li><a class=\"dropdown-item\" href=\"".htmlspecialchars($_SERVER["PHP_SELF"])."?kategoria=".$row["nazov"]."&lokalita=".$_GET["lokalita"]."\">".$row["nazov"]."</a></li>";
                    }
                    else {
                        echo "<li><a class=\"dropdown-item\" href=\"".htmlspecialchars($_SERVER["PHP_SELF"])."?kategoria=".$row["nazov"]."\">".$row["nazov"]."</a></li>";
                    }
                } 
            } 
        ?>
    </ul>
</div>