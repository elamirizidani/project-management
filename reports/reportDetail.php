<?php
$userId = $_GET['user'];
$from = $_GET['from'];
$to = $_GET['to'];
?>

<style>
.section {
    max-width: 21% !important;
    min-width: 21% !important;
    font-weight: 700;
    font-size: 16px
}

.dates {
    width: 16%;
    font-weight: 700;
    font-size: 16px
}

.projects,
.updates,
.tasks {
    width: 71%
}

.d-row {
    display: flex;
    /* justify-content: space-around; */
}

.d-colums {
    display: flex;
    flex-direction: column
}

.section-project {
    width: 26.5%;

    width: -moz-fit-content;
    block-size: fit-content;
    text-align: left;
    padding: 10px
}

.tasks {
    width: 73.5%;
}

.section-tasks {
    width: 36%;

    width: -moz-fit-content;
    block-size: fit-content;
    text-align: left;
    padding: 10px
}

.updates {
    width: 64%;
}

.section-desc {
    width: 62%;
    display: flex;
    flex-direction: column;
    width: -moz-fit-content;
    block-size: fit-content;
    text-align: left;
    padding: 10px
}

.update {
    display: flex;
    flex-direction: column;
    width: -moz-fit-content;
    block-size: fit-content;
    text-align: left;
    padding: 10px
}
</style>

<div>
    <div>
        <div>
            <div class="d-row">
                <span class="section">User Names</span>
                <span class="section">Project Name</span>
                <span class="section">Tasks On Project</span>
                <span class="section">Description</span>
                <span class="dates">Last Update</span>
            </div>
            <?php
                if(isset($userId))
                    $users = $con->singleTable('users','uId',$userId);
                else
                    $users = $con->listOfUsers();
                if(!empty($users))
                {
                    foreach ($users as $user) {?>

            <div class="d-row">
                <div class="names section">
                    <span><?=$user['names']?></span>
                </div>
                <div class="d-colums projects">
                    <?php
                    if($user['role'] == "developer")
                    $projects = $con->singleTable("project","assigned",$user['uId']);
                    else
                    $projects = $con->singleTable("project","designer",$user['uId']);
                    if(!empty($projects)){
                        foreach ($projects as $project) {?>
                    <div class="d-row">
                        <div class="section-project" style="text-align:left"><?=$project['name']?></div>
                        <div class="d-colums tasks">
                            <?php $tasks = $con->singleTable("tasks","pId",$project['pId']);
if(!empty($tasks)){
    foreach ($tasks as $task) {?>
                            <div class="d-row">
                                <div class="section-tasks" style="text-align:left">
                                    <span><?=$task['name']?></span>
                                </div>
                                <div class="d-colums updates" style="text-align:left">
                                    <?php
                        $updates = $con->singleTable("updates","tId",$task['tId']);
                        if(!empty($updates)){
                            foreach ($updates as $update) {
                                if(($update['lastUpdate'] >= $from) && ($update['lastUpdate'] <= $to))
                                {
                                ?>
                                    <div class="d-row">
                                        <div class="desc section-desc" style="text-align:left">
                                            <span><?=$update['uDescription']?></span>
                                        </div>
                                        <div class="update" style="text-align:left">
                                            <span><?=$update['lastUpdate']?></span>
                                        </div>
                                    </div>
                                    <hr>
                                    <?php }}
                        }
                        ?>

                                </div>
                            </div>
                            <hr>
                            <?php 
    }
}
?>
                        </div>

                    </div>
                    <hr>
                    <?php
                        }
                    }
                    ?>
                </div>
            </div>
            <hr>
            <?php
                    }
                }
            ?>

        </div>
    </div>
</div>