<?php
$id = $_GET['id'];
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>

<div class="container">
<section class="post">
    <?php 
    $projectSelectors = $con->project($id);
    foreach($projectSelectors as $project)
    {?>
        <div class="process-header">
            <h2><?php echo $project['name']?></h2>
        </div>
        <div class="project-body">
            <?php
            if($project['mokeup'] != "")
            {
            ?>
            <h5>Mockup: <a href="<?php echo $project['mokeup']?>" target="_blank">here</a></h5>
            <?php
            }
            ?>
            <p>
                this project should start from <span class="highlights"><?php echo $project['start_date']?> </span> to <span class="highlights"><?php echo $project['due_date']?></span>
            </p>
            
        </div>
        <div class="project-desc">
            <p>
                <?php echo $project['description']?>
            </p>
        </div>
        <?php 
        if($login_role == 'developer')
        {
        if( $project['status'] == "new")
        {?>
        <form action="index.php?start" method="POST">
            <input type="hidden" name="id" value="<?php echo $id?>">
            <input type="submit" name="start" value="START NOW">
        </form>
        <?php
        }
        else{
            ?>
                <form action="dashboard.php?start" method="POST">
                    <input type="hidden" name="id" value="<?php echo $id?>">
                    <input type="submit" name="complete" value="COMPLETED">
                    
                </form>
                <a href="index.php?projectProgress&id=<?php echo $id?>">REPORT TASK(s)</a>
            


                <?php
        }
        ?>
        
        <?php
}elseif($login_role == "admin")
{
   
    ?>
<form action="index.php?assignUpdate" method="POST">
<input type="hidden" name="id" value="<?php echo $id?>">
<?php
 if($project['assigned'] == '0')
 {?>
    <select name="assigned" id="assign">
        <option value="">--Developer--</option>
        <?php
            $users = $con->oneTable('users');
            if(!empty($users))
            {
                foreach($users as $user)
                    {
                        if($user['role'] != 'developer')
                            continue;
        ?>
                        <option value="<?=$user['uId'];?>"><?=$user['names'];?></option>
        <?php
                    }
            }
        ?>
    </select>
    <?php
 }
 if($project['designer'] == '0')
 {?>
    <select name="designer" id="designer">
        <option value="">--Designer--</option>
        <?php
            $users = $con->oneTable('users');
            if(!empty($users))
            {
                foreach($users as $user)
                    {
                        if($user['role'] != 'designer')
                            continue;
        ?>
                        <option value="<?=$user['uId'];?>"><?=$user['names'];?></option>
        <?php
                    }
            }
        ?>
    </select>
    <?php
 }
 if(($project['assigned'] == '0') || ($project['designer'] == '0'))
 {?>
    <input type="submit" name="assignUpdate" value="Submit">
    <?php }?>
    </form>
<?php }
elseif($login_role == "designer")
{
    $checks = $con->singleTable('mokeup','pId',$id);
    if(!empty($checks))
    {
        if(($project['mokeup'] == '') || (empty($project['mokeup'])))
            {
                ?>
                <form action="index.php?assignUpdate" method="POST">
                    <input type="hidden" name="id" value="<?php echo $id?>">
                    <input type="text" name="mokeup" placeholder="Mokeup">
                    <input type="submit" name="addMokeup" value="COMPLETE MOCKUP">
                </form>
                <?php
            }
    }
            else
            {
                ?>
                <form action="index.php?assignUpdate" method="POST">
                    <input type="hidden" name="id" value="<?php echo $id?>">
                    <input type="submit" name="startMokeup" value="START MOCKEUP">
                </form>
                <?php
            }
    
}
}
if($login_role == "admin" || $login_role == "developer")
{
?>
        <div class="workiing-on-projects">
            <div class="st_viewport">
                <div class="st_wrap_table" data-table_id="1">
                    <div class="st_table_header">
                        <div class="st_row">
                            <div class="st_column _name">Task Name</div>
                            <div class="st_column _year">Status</div>
                        </div>
                    </div>
                    <div class="st_table">
                        <?php 
                            $tasks = $con->taskOnProject($id);
                            if(!empty($tasks))
                            {
                            foreach($tasks as $task)
                            {
                            ?>
                            <div class="st_row">
                                <div class="st_column"><?php echo $task['name']?></div>
                                <div class="st_column"><?php echo $task['status']?></div>
                            </div>
                        <?php }}?>
                    </div>
                </div>
            </div>
        </div>
<?php }?>
</div>
</section>
</div>

<style>
    .project-desc{
        width: 100%;
        box-shadow: 2px 3px 6px 4px #ccc;
        padding: 12px;
        margin: 20px 0;
        
    }
    .project-body p{
        font-size: 70%
    }
</style>