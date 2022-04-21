
        <div class="logo-details">
            <i class='bx bxl-c-plus-plus'></i>
            <span class="logo_name">Reports</span>
        </div>
        <ul class="nav-links" id="side-menu">
            <li>
                <a href="index.php" class="side-menu-item <?php ?>">
                    <i class='bx bx-grid-alt'></i>
                    <span class="links_name">Dashboard</span>
                </a>
            </li>
            <li>
                <a href="index.php?project" class="side-menu-item <?php echo isset($_GET['project'])? "active":"" ?>">
                    <i class='bx bx-box'></i>
                    <span class="links_name">Projects</span>
                </a>
            </li>
            <?php
            if($login_role != "marketing")
            {?>
            <li>
                <a href="index.php?report" class="side-menu-item <?php echo isset($_GET['report'])? "active":"" ?>">
                    <i class='bx bx-list-ul'></i>
                    <span class="links_name">Overview</span>
                </a>
            </li>
            <?php
            }
            if($login_role == "admin")
                {?>
            <li>
                <a href="index.php?fromMarketing" class="side-menu-item">
                    <i class='bx bx-pie-chart-alt-2'></i>
                    <span class="links_name">From Marketing</span>
                </a>
            </li>
            <li>
                <a href="#" class="side-menu-item">
                    <i class='bx bx-pie-chart-alt-2'></i>
                    <span class="links_name">Analytics</span>
                </a>
            </li>
            <li>
                <a href="#" class="side-menu-item">
                    <i class='bx bx-book-alt'></i>
                    <span class="links_name">Total order</span>
                </a>
            </li>
            
            <li>
                <a href="index.php?addUser" class="side-menu-item <?php echo isset($_GET['addUser'])? "active":"" ?>">
                    <i class='bx bx-user'></i>
                    <span class="links_name">Team</span>
                </a>
            </li>
                <?php }?>
            <li>
                <a href="#" class="side-menu-item">
                    <i class='bx bx-cog'></i>
                    <span class="links_name">Setting</span>
                </a>
            </li>
            <li class="log_out">
                <a href="../logout.php">
                    <i class='bx bx-log-out'></i>
                    <span class="links_name">Log out</span>
                </a>
            </li>
        </ul>


        <script>
            var header = document.getElementById("side-menu");
            var btns = header.getElementsByClassName("side-menu-item");
            for (var i = 0; i < btns.length; i++) {
                btns[i].addEventListener("click", function() {
                    var current = document.getElementsByClassName("active");
                    current[0].className = current[0].className.replace(" active", "");
                    this.className += " active";
                    console.log(current[0].className)
;                });
            }
        </script>