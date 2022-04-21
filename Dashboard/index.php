<?php
include "../session.php";
include "../function/function.php";

$con = new Databases;
?>
<!DOCTYPE html>
<!-- Designined by CodingLab | www.youtube.com/codinglabyt -->
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <title> Reporting System</title>
    
    <link rel="stylesheet" href="../assets/css/css.css?v=16">
    <link rel="stylesheet" href="../assets/css/style.css?v=22">
    <link rel="stylesheet" href="../assets/css/calender.css">
    <!-- Boxicons CDN Link -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <div class="sidebar">
        <?php include '../sidebar.php';?>
    </div>
    <section class="home-section">
        <nav>
            <div class="sidebar-button">
                <i class='bx bx-menu sidebarBtn'></i>
                <span class="dashboard">Dashboard</span>
            </div>
            <div class="search-box">
                <input type="text" placeholder="Search...">
                <i class='bx bx-search'></i>
            </div>
            <div class="profile-details">
                <?php 
                $users = $con->singleTable('users','uId',$login_id);
                    foreach($users as $user)
                    {?>
                        <img src="../assets/images/profile/<?=$user['profile']?>" alt="">
                        <span class="admin_name"><?=$user['names']?></span>
                        <!--<i class='bx bx-chevron-down'></i>-->
                <?php }?>
            </div>
            <i class='bx bx-sun' id="theme"></i>
        </nav>

        <div class="home-content">
            <?php
            if(isset($_GET['report']))
                include '../reports/report.php';
            elseif(isset($_GET['addUser']))
                include '../admin/user.php';
            elseif(isset($_GET['project']))
                include '../admin/projects.php';
            elseif(isset($_GET['addProject']))
                include "../admin/assign.php";
            elseif(isset($_GET['assignProgress']))
                include "../back_files/getData.php";
            elseif(isset($_GET['newProjects']))
                include "../dev/newProject.php";
            elseif(isset($_GET['fromMarketing']))
                include "../admin/fromMarketing.php";
            elseif(isset($_GET['assignUpdate']))
                include "../back_files/getData.php";
            elseif(isset($_GET['start']))
                include "../back_files/getData.php";
            else
            if($login_role == "marketing")
                include "../admin/projects.php";
            else
            {
            ?>
            <div class="overview-boxes" id="statustic">
            </div>
            
            <?php
            if(isset($_GET['projectProgress']))
            {
                $id = $_GET['id'];
                include "../dev/update.php";
            }
            elseif(isset($_GET['updateProgresses']))
                include "../back_files/getData.php";
            elseif(isset($_GET['create']))
                require "../back_files/getData.php";
            elseif(isset($_GET['completeTask']))
                include "../back_files/getData.php";
            else
            include "priorities.php";?>

            <div class="sales-boxes">
                <div class="recent-sales box" id="project">
                
                </div>
                <div class="top-sales box">
                    <div class="title">
                        Team Mambers 
                        
                        <?php
                        if($login_role == 'admin')
                        { ?>
                            <input type="text" class="form-control" name="live_search" id="live_search" autocomplete="off"
                                placeholder="Add New Member...">
                            <div id="search_result"></div>
                        <?php }
                        ?>
                    <div id="member">
                        <?php
                        if (isset($_GET['toteam']))
                        {
                            $addToTeam = array(
                                'team' => 1,
                                'member' => $_POST['userid'],
                                'status' => 'active',
                            );
                            $check = $con->singleTable("team","member",$_POST['userid']);
                            if(!empty($check))
                            {}
                            else{
                                if($con->insert("team", $addToTeam))
                            {
                                include "../Dashboard/index.php?project";
                            }
                            }
                            
                        }
                        ?>
                    </div>
                </div>
            </div>
            <?php }?>
        </div>
    </section>

    <script>
        let sidebar = document.querySelector(".sidebar");
        let sidebarBtn = document.querySelector(".sidebarBtn");
        sidebarBtn.onclick = function() {
            sidebar.classList.toggle("active");
            if (sidebar.classList.contains("active")) {
                sidebarBtn.classList.replace("bx-menu", "bx-menu-alt-right");
            } else
                sidebarBtn.classList.replace("bx-menu-alt-right", "bx-menu");
        }
        
    </script>

    <!--live search-->
    <script type="text/javascript">
        $(document).ready(function () {
            $("#live_search").keyup(function () {
                var query = $(this).val();
                if (query != "") {
                    $.ajax({
                        url: '../back_files/livesearch.php',
                        method: 'POST',
                        data: {
                            query: query
                        },
                        success: function (data) {
                            $('#search_result').html(data);
                            $('#search_result').css('display', 'block');
                            $('#search_result').css('margin', '30px');
                            $("#live_search").focusout(function () {
                                $('#search_result').css('display', 'block');
                                $('#search_result').css('margin', '30px');
                            });
                            $("#live_search").focusin(function () {
                                $('#search_result').css('display', 'block');
                                $('#search_result').css('margin', '30px');
                            });
                        }
                    });
                } else {
                    $('#search_result').css('display', 'none');
                }
            });
        });
    </script>

</body>

</html>
<script src="../assets/js/jquery.min.js"></script>
<script src="../assets/js/script.js"></script>
<script>
    $(document).ready(function() {
        $("#project").load("../table.php");
        $("#member").load("../team.php");
        $('#statustic').load("../statistic.php");
    });
    

    const toggle = document.getElementById("theme");
const theme = window.localStorage.getItem("theme");

if (theme === "dark")
    document.body.classList.toggle('dark-theme');
else
    document.body.classList.toggle('light-theme');

toggle.addEventListener("click", () => {
    document.body.classList.toggle("dark-theme");
    if (theme === "dark") {
        window.localStorage.setItem("theme", "light");
    } else window.localStorage.setItem("theme", "dark");
    console.log(theme);
});
</script>