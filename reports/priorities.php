<?php
function prioritiesReport($user,$startDay,$endDay) {
    include '../function/function.php';
    $con = New Databases;
   ?>
<div class="pro-status">
    <div class="row">
        <div class="pro">
        <?php
        
            $assigned = $con->assignedProject($user);
            foreach ($assigned as $assign)
            {
            ?>
            <h1><?php echo $assign['assigned']?></h1>
            <?php  }?>
            <p>Assigned Project</h1>
        </div>

        <div class="pro">
            <?php
            $completed = $con->projects($user,"completed");
            foreach ($completed as $complete)
            {
            ?>
            <h1><?php echo $complete['progress']?></h1>
            <?php  }?>
            <p>Completed Project</h1>
        </div>

        <div class="pro">
        <?php
            $inprogress = $con->projects($user,"progress");
            foreach ($inprogress as $progress)
            {
            ?>
            <h1><?php echo $progress['progress']?></h1>
            <?php  }?>
            <p>Inprogress Project</h1>
        </div>

        <div class="pro">
        <?php
            $news = $con->projects($user,"new");
            foreach ($news as $new)
            {
            ?>
            <h1><?php echo $new['progress']?></h1>
            <?php  }?>
            <p>Not Yet Started Project</h1>
        </div>
    </div>
</div>
<div class="home-content">
    <div class="">
        <div class="row">
            <div class="priorities" id="priorities">
                <div class="priorities-header">
                    <h1>My Priorities</h1>
                    <div class="priorities-nav">
                        <ul id="taskNav">
                            <a class="navs active" id="upcoming"><li>Upcoming</li></a>
                            <a class="navs" id="overdue"><li>Overdue</li></a>
                            <a class="navs" id="complete"><li>Completed</li></a>
                        </ul>
                    </div>
                </div>
                <div class="priorities-list" id="priorities-list">
                    
                    <?php
                    
                    $priorities = $con->priorities($user,"new");
                    if(!empty($priorities))
                    {
                    foreach ($priorities as $priority) {
                        if(($priority['priode'] >= $startDay ) && ($priority['priode'] <= $endDay))
                        {
                        ?>
                        <div class="priority">
                            <div>
                                <i class="fa fa-check"></i>
                                <span><?php echo $priority['priority']?></span>
                            </div>
                            
                            <div class="taskPriode">
                            <?php echo $priority['priode']?>
                            </div>
                        </div>
                    <?php }}
                    
                    }
                    ?>
                </div>
                <div class="priorities-list" id="priorities-list-over-due">
                <?php
                    
                    $priorities = $con->priorities($user,"progress");
                    if(!empty($priorities))
                    {
                    foreach ($priorities as $priority) {
                        if(($priority['priode'] >= $startDay ) && ($priority['priode'] <= $endDay))
                        {
                        ?>
                        <div class="priority">
                            <div>
                                <i class="fa fa-check stil-progress"></i>
                                <span><?php echo $priority['priority']?></span>
                            </div>
                            
                            <div class="taskPriode">
                            <?php echo $priority['priode']?>
                            </div>
                        </div>
                    <?php }}
                    
                    }
                    ?>
                </div>

                <div class="priorities-list" id="priorities-list-complete">
                <?php
                    
                    $prioritiesCompleted = $con->priorities($user,"complete");
                    if(!empty($prioritiesCompleted))
                    {
                    foreach ($prioritiesCompleted as $priorityCompleted) {
                        if(($priority['priode'] >= $startDay ) && ($priority['priode'] <= $endDay))
                        {?>
                        <div class="priority">
                            <div>
                                <i class="fa fa-check complete"></i>
                                <span><?php echo $priorityCompleted['priority']?></span>
                            </div>
                            
                            <div class="taskPriode">
                            <?php echo $priorityCompleted['priode']?>
                            </div>
                        </div>
                    <?php }
                    }
                    }
                    ?>
                </div>
            </div>
            <div class="priorities">
                <div class="todoList">
                    <div class="priorities-header">
                        <h1>To Do List</h1>
                        
                    </div>
                    <div class="priorities-list">
                        
                            <?php
                                $tasks = $con->tasks($user);
                                if(!empty($tasks))
                                {
                                foreach ($tasks as $task)
                                {?>
                                <div class="priority">
                                    <div class="tasks-todo">
                                        <?php if ($task['status'] == 'completed')
                                            echo '<i class="fa fa-check complete"></i>';
                                            elseif($task['status'] == 'inprogress')
                                            echo '<i class="fa fa-check stil-progress"></i>';
                                            else
                                            echo '<i class="fa fa-check"></i>';
                                        ?>
                                        
                                        <span><?php echo $task['task']?></span>
                                        <div class="task-pro"><?php echo $task['project']?></div>
                                    </div>
                                    </div>
                                <?php }}
                                ?>
                </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>

<?php }
    ?>


<script>
// Add active class to the current button (highlight it)
var header = document.getElementById("taskNav");
var btns = header.getElementsByClassName("navs");
for (var i = 0; i < btns.length; i++) {
  btns[i].addEventListener("click", function() {
  var current = document.getElementsByClassName("active");
  current[0].className = current[0].className.replace(" active", "");
  this.className += " active";
  });
}


$(document).ready(function(){
  
  $("#priorities-list-over-due").hide();
        $("#priorities-list-complete").hide();
    $("#upcoming").click(function(){
        $("#priorities-list").show();
        $("#priorities-list-over-due").hide();
        $("#priorities-list-complete").hide();
    });
    $("#overdue").click(function(){
      $("#priorities-list").hide();
        $("#priorities-list-over-due").show();
        $("#priorities-list-complete").hide();
    });
    $("#complete").click(function(){
      $("#priorities-list").hide();
        $("#priorities-list-over-due").hide();
        $("#priorities-list-complete").show();
    });
});


</script>