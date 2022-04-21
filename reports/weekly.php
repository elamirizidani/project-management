<?php

function weeklyReport($user,$startDay,$endDay) {
    
    if(!isset($con))
{
    include "../function/function.php";
    $con = new Databases;
}?>
<section class="post">
    <div class="container">
    <div class="profile">
        <div class="main-profile">
            <?php
            $startDay = $_POST['startDate'];
            $endDay = $_POST['endDate'];
            $user = $_POST['user'];
                $persons = $con->singleTable('users','uId',$user);
                if(!empty($persons))
                    foreach ($persons as $person) 
                
                
            ?>
            <div class="profile-pic">
                <img src="../assets/images/profile/avatar7.png" alt="">
            </div>
            <div class="profile-desc">
                <h1><?php echo $person['names']?></h1>
                <h4><?php echo $person['role']?></h4>
                <div class="profile-contact">
                    <p>E-mail: <a href="mailto:<?php echo $person['email']?>"><?php echo $person['email']?></a></p>
                    <p>Phone: <a href="tel:<?php echo $person['phone']?>"><?php echo $person['phone']?></a></p>
                </div>
                
            </div>
            
            </div>
            
            <div class="statistics-profile">
                <div class="projects">
                    <?php
                    $assigned = $con->assignedProject($user);
                            foreach ($assigned as $assign)
                            {
                        ?>
                        <h1><?=$assign['assigned']?></h1>
                        <?php }?>
                    
                    <span>
                        Assigned Project
                    </span>
                </div>
                
                <div class="projects">
                    <?php
                            $completed = $con->projects($user,"completed");
                            foreach ($completed as $complete)
                            {?>
                        <h1><?php echo $complete['progress']?></h1>
                        <?php }?>
                    
                    <span>
                        Completed Project
                    </span>
                </div>
                <div class="projects">
                <?php
                            $inprogress = $con->projects($user,"progress");
                            foreach ($inprogress as $progress)
                            {
                            ?>
                        <h1><?php echo $progress['progress']?></h1>
                        <?php }?>
                    <span>
                        InProgress Project
                    </span>
                </div>
                <div class="projects">
                    <?php
                            $news = $con->projects($user,"new");
                            foreach ($news as $new)
                            {
                            ?>
                        <h1><?php echo $new['progress']?></h1>
                        <?php }?>
                    
                    <span>
                        Not yet started Project
                    </span>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>

    <div class="container">
        <section class="post" id="toBePrinted">
            <div class="week-rep">
                <h1>REPORT STATUS</h1>

                <div class="rep-header">
                    <div class="rep-head">
                        <p>From: <?php echo $startDay;?></p>
                    </div>
                    <div class="rep-head">
                        <p>To: <?php echo $endDay;?></p>
                    </div>
                </div>
                <div class="rep-activities">
                    <div class="activity">
                        <div class="activity-head">
                            ACTIVITIES COMPLETED THIS WEEK
                        </div>
                        <?php 
                        /*$startDay = date("Y-m-d", strtotime("Monday this week"));
                        for ($i=0; $i<7;$i++){
                            $endDay = date("Y-m-d", strtotime($startDay . " + $i day"));
                        }*/
                            $usersProjects = $con->singleTable('project','assigned',$user);
                            if(!empty($usersProjects))
                            {
                                foreach($usersProjects as $usersProject)
                                {?>

                            <div class="activity-body">
                            <h4>
                                <?php echo $usersProject['name']; $projectId = $usersProject['pId'];?>:
                            </h4>
                            <h4>Completed Deliverable:</h4>
                            <ul list-style-type="georgian">
                                <?php
                                $weeklies = $con->developerWeekly($user,$projectId,$startDay,$endDay,'completed');
                                if(!empty($weeklies))
                                {
                                    foreach($weeklies as $weekly)
                                    {
                                        if($weekly['task'] >0)
                                        {?>
                                        <li>
                                            <?php echo $weekly['task']?> Task(s)
                                        </li>
                                    <?php }
                                    else{?>
                                    <li style="color:red">
                                        Nothing Completed in this week
                                    </li>
                                <?php } 
                                    }
                                }
                                ?>
                                
                            </ul>
                        </div>

                            <?php }}
                        ?>
                    </div>

                    <div class="activity">
                        <div class="activity-head row">
                            <div class="sub-head">
                                ACTIVITIES IN PROCESS
                            </div>
                            <div class="sub-head">
                                DUE DATE
                            </div>
                        </div>
                        
                            <?php

                            $usersProjects = $con->singleTable('project','assigned',$user);
                            if(!empty($usersProjects))
                            {
                                foreach($usersProjects as $usersProject)
                                {
?>
                        <div class="activity-body row">
                            <div class="sub-body">
                                <h4><?php echo $usersProject['name']; $projectId = $usersProject['pId'];?>:</h4>
                                <ul list-style-type="georgian">
                                <?php
                                $weeklies = $con->developerWeekly($user,$projectId,$startDay,$endDay,'inprogress');
                                if(!empty($weeklies))
                                {
                                    foreach($weeklies as $weekly)
                                    {?>
                                        <li>
                                            <?php echo $weekly['task']?> Task(s)
                                        </li>
                                    <?php }
                                }
                                else{?>
                                    <li style="color:red">
                                        Nothing Inprogress For this Project
                                    </li>
                                <?php } 
                             ?>
                            </ul>

                                
                            </div>
                        </div>
                        <?php
                    }?>
                    </div>




                    <div class="activity">
                        <div class="activity-head">
                            ACTIVITIES TO BE STARTED NEXT WEEK
                        </div>
                        <?php 
                            $usersProjects = $con->singleTable('project','assigned',$user);
                            if(!empty($usersProjects))
                            {
                                foreach($usersProjects as $usersProject)
                                {?>

                            <div class="activity-body">
                            <h4>
                                <?php echo $usersProject['name']; $projectId = $usersProject['pId'];?>:
                            </h4>
                            <ul list-style-type="georgian">
                                <?php
                                $weeklies = $con->developerWeekly($user,$projectId,$startDay,$endDay,'nextweek');
                                if(!empty($weeklies))
                                {
                                    foreach($weeklies as $weekly)
                                    {?>
                                        <li>
                                            <?php echo $weekly['task']?> Task(s)
                                        </li>
                                    <?php }
                                }
                             ?>
                            </ul>
                        </div>

                            <?php }}
                        ?>

                    </div>
                    <!--<div class="activity">
                        <div class="activity-head">
                            LONG TERM PROJECTS
                        </div>
                        <div class="activity-body">
                            <ul list-style-type="georgian">
                                <li>Home page</li>
                                <li>About us page</li>
                            </ul>
                        </div>
                    </div>-->
                    <div class="activity">
                        <div class="activity-head">
                            ISSUES FOR IMMIDEDIATE ATTENTION
                        </div>
                        <?php 
                            $usersProjects = $con->singleTable('project','assigned',$user);
                            if(!empty($usersProjects))
                            {
                                foreach($usersProjects as $usersProject)
                                {?>

                            <div class="activity-body">
                            <h4>
                                <?php echo $usersProject['name']; $projectId = $usersProject['pId'];?>:
                            </h4>
                            <ul list-style-type="georgian">
                                <?php
                                $weeklies = $con->developerWeekly($user,$projectId,$startDay,$endDay,'issue');
                                if(!empty($weeklies))
                                {
                                    foreach($weeklies as $weekly)
                                    {?>
                                        <li>
                                            <?php echo $weekly['task']?> Task(s)
                                        </li>
                                    <?php }
                                }
                             ?>
                            </ul>
                        </div>

                            <?php }}
                        ?>
                    </div>
                </div>
            </div>
        </section>
        <button class="btn add-btn" onclick="printReport()">Print</button>
    </div>
    
    </section>
    <script>
        function printReport() {
            const printContents = document.getElementById('toBePrinted').innerHTML;
            const originalContents = document.body.innerHTML;
            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;
        }
    </script>

<?php
}} ?>