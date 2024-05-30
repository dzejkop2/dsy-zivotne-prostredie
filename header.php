<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand" href="./">Životné prostredie</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        
        <?php
            $rola_user = role_check($conn);
            if(isset($_SESSION["user_id"]) == "") {
                    echo "
                    <div class=\"collapse navbar-collapse\" id=\"navbar_left\">
                        <ul class=\"navbar-nav\">
                            <li class=\"nav-item\">
                                <a class=\"nav-link\" href=\"./graf.php\">Grafy</a>
                            </li>
                        </ul>
                    </div>
                    <ul class=\"navbar-nav\">
                        <li class=\"nav-item\">
                            <a class=\"nav-link\" href=\"./login.php\">Login</a>
                        </li>
                        <li class=\"nav-item\">
                            <a class=\"nav-link\" href=\"./register.php\">Register</a>
                        </li>
                    </ul>
                ";
            }
            else if($rola_user == "uradnik" || $rola_user == "vedec") {
                echo "
                <div class=\"collapse navbar-collapse\" id=\"navbar_left\">
                    <ul class=\"navbar-nav\">
                        <li class=\"nav-item\">
                            <a class=\"nav-link\" href=\"./senzor_info.php\">Senzory</a>
                        </li>
                        <li class=\"nav-item\">
                            <a class=\"nav-link\" href=\"./graf.php\">Graf</a>
                        </li>
                    </ul>
                </div>
                <div class=\"collapse navbar-collapse justify-content-end\" id=\"navbarNav\">
                    <ul class=\"navbar-nav\">
                        <li class=\"nav-item\">
                            <a class=\"nav-link\" href=\"./user_info.php\">".get_name($_SESSION["user_id"],$conn)."</a>
                        </li>
                        <li class=\"nav-item\">
                            <a class=\"nav-link\" href=\"./logout.php\">Logout</a>
                        </li>
                    </ul>
                </div>
                ";
            }
            else {
                echo "
                <div class=\"collapse navbar-collapse\" id=\"navbar_left\">
                    <ul class=\"navbar-nav\">
                        <li class=\"nav-item\">
                            <a class=\"nav-link\" href=\"./senzor_info.php\">Senzory</a>
                        </li>
                        <li class=\"nav-item\">
                            <a class=\"nav-link\" href=\"./graf.php\">Graf</a>
                        </li>
                    </ul>
                </div>
                <div class=\"collapse navbar-collapse justify-content-end\" id=\"navbarNav\">
                    <ul class=\"navbar-nav\">
                            <li class=\"nav-item\">
                            <a class=\"nav-link\" href=\"./user_info.php\">".get_name($_SESSION["user_id"],$conn)."</a>
                        </li>
                        <li class=\"nav-item\">
                            <a class=\"nav-link\" href=\"./logout.php\">Logout</a>
                        </li>
                    </ul>
                </div>
                ";
            }
        ?>
        
    </div>
</nav>