<div class="dropdown">
    <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
        <?php 
            if(isset($_GET["lokalita"])) {
                echo $_GET["lokalita"];
            } else {
                echo "nieco sa pokazilo";
            }
        ?>
    </button>
    <ul class="dropdown-menu">
        <?php 
            if(isset($_GET["lokalita"])) {
                $query = "
                SELECT *
                FROM senzor 
                WHERE lokacia != \"".$_GET["lokalita"]."\"    
                GROUP BY lokacia
                ";
            }
            else {
                $query = "
                SELECT *
                FROM senzor GROUP BY lokacia   
                ";
            }
            $result = mysqli_query($conn, $query);
            if (mysqli_num_rows($result) > 0) { 
                while($row = mysqli_fetch_assoc($result)) { 
                    echo "<li><a class=\"dropdown-item\" href=\"".htmlspecialchars($_SERVER["PHP_SELF"])."?lokalita=".$row["lokacia"]."&kategoria=".$_GET["kategoria"]."\">".$row["lokacia"]."</a></li>";
                } 
            } 
        ?>
    </ul>
</div>