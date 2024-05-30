<div class="dropdown">
    <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
        <?php 
            if(isset($_GET["kategoria"])) {
                echo $_GET["kategoria"];
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
                    echo "<li><a class=\"dropdown-item\" href=\"".htmlspecialchars($_SERVER["PHP_SELF"])."?kategoria=".$row["nazov"]."&lokalita=".$_GET["lokalita"]."\">".$row["nazov"]."</a></li>";
                } 
            } 
        ?>
    </ul>
</div>