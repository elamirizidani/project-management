<?php
  include 'admin/function/function.php';  
  $con = new Databases;
 ?>
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
                    <div class="priority">
                        <i class="fa-solid fa-circle-check"></i>
                        <p></p>
                        <form action="">
                            <div class="tasks">
                                <input type="text" id="priority" class="taskInput" required placeholder="Add Priority...">
                                <input type="date" class="taskInput" name="" id="priode" requiered ="required" pattern="([a-zA-Z]+\s){0,}([a-zA-Z]+){4,25}">
                                <input type="hidden" id="uId" class="taskInput" required value="<?php echo $login_id ?>">
                                <input type="submit" value="ADD" id="addPriority" onclick="return empty()">
                            </div>
                        </form>
                    </div>
                    

                    <?php
                    
                    $priorities = $con->priorities($login_id,"new");
                    if(!empty($priorities))
                    {
                    foreach ($priorities as $priority) {?>
                        <div class="priority">
                            <div>
                                <i class="fa fa-check"></i>
                                <span><?php echo $priority['priority']?></span>
                            </div>
                            
                            <div class="taskPriode">
                              
                            <?php echo date('l', strtotime($priority['priode']));?>
                            </div>
                        </div>
                    <?php }
                    
                    }
                    ?>
                </div>
                <div class="priorities-list" id="priorities-list-over-due">
                <?php
                    
                    $priorities = $con->priorities($login_id,"progress");
                    if(!empty($priorities))
                    {
                    foreach ($priorities as $priority) {?>
                        <div class="priority">
                            <div>
                                <i class="fa fa-check stil-progress"></i>
                                <span><?php echo $priority['priority']?></span>
                            </div>
                            
                            <div class="taskPriode">
                            <?php echo $priority['priode']?>
                            </div>
                        </div>
                    <?php }
                    
                    }
                    ?>
                </div>

                <div class="priorities-list" id="priorities-list-complete">
                <?php
                    
                    $prioritiesCompleted = $con->priorities($login_id,"complete");
                    if(!empty($prioritiesCompleted))
                    {
                    foreach ($prioritiesCompleted as $priorityCompleted) {?>
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
                                $tasks = $con->tasks($login_id);
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
                <div class="todoList">
                    <div id="calendar"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    
.home-content {
    width: 100%;
}

.row {
    display: flex;
}

.priorities {
    width: 50%;
    border-radius: 10px;
    border: .4px solid var(--border-color);
    color: var(--text-color);
    min-height: 18rem;
    max-height: 18rem;
}

.priorities:nth-child(1) {
    background-color: var(--priorities-background-color);
    box-shadow: 4px 4px 6px var(--box-shadow-color);
}

.priorities:nth-child(2) {
    margin-left: 22px;
    border: 0;
    display: flex;
    justify-content: space-between;
}

.todoList {
    width: 50%;
    border-radius: 10px;
    border: .4px solid var(--border-color) !important;
    background-color: var(--priorities-background-color);
    box-shadow: 4px 4px 6px var(--box-shadow-color);
}

.todoList:not(:first-child) {
    margin-left: 10px;
}

.priorities-header {
    height: 5rem;
    display: flex;
    flex-direction: column;
    justify-content: stretch;
    border-bottom: .4px solid var(--border-color);
    text-align: center;
}

.priorities-nav ul {
    list-style-type: none;
    display: flex;
}

.priorities-nav ul a {
    font-size: 16px;
    color: #666666;
    margin-left: 10px;
    cursor: pointer;
}

.priorities-nav ul a:active {
    border-bottom: 2px solid var(--border-color);
}

.active {
    border-bottom: 3px solid var(--border-color);
}

.priorities-list {
    width: 100%;
    height: 70%;
    display: flex;
    flex-direction: column;
    padding: 20px;
    overflow-y: auto;
    scrollbar-color: var(--scroll-color) var(--scroll-background-color);
    scrollbar-width: thin;
}

.st_viewport::-webkit-scrollbar,
.priorities-list::-webkit-scrollbar {
    width: 11px;
}

.st_viewport::-webkit-scrollbar-track,
.priorities-list::-webkit-scrollbar-track {
    background: var(--scroll-background-color);
}

.st_viewport::-webkit-scrollbar-thumb,
.priorities-list::-webkit-scrollbar-thumb {
    background-color: var(--scroll-color);
    border-radius: 6px;
    border: 3px solid var(--scroll-background-color);
}

.priority {
    display: flex;
    width: 100%;
    border-bottom: .4px solid var(--border-color);
    justify-content: space-between;
}

.priority .tasks {
    display: flex;
}

.taskInput {
    background-color: transparent !important;
    border: none;
    color: var(--text-color);
    margin-right: 100px;
}

.taskPriode {
    font-size: small;
}

.pro-status {
    width: 100%;
    margin-bottom: 20px
}

.pro {
    flex: 1;
    background-color: var(--priorities-background-color);
    box-shadow: 4px 4px 6px var(--border-color);
    text-align: center;
    border-radius: 10px;
    color: var(--text-color);
}

.pro p {
    color: var(--text-color-subtitle);
    font-size: small
}

.pro:not(:first-child) {
    margin-left: 15px;
}

.priority span {
    font-size: 75%
}

.task-pro {
    width: 100%;
    text-align: right;
    font-size: 55%;
    color: var(--text-color-subtitle);
}

.tasks-todo {
    width: 100%;
}

.new {
    color: white;
}

.stil-progress {
    color: yellow;
}

.complete {
    color: green;
}


</style>
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

$(function() {
    
    $("form").bind('submit',function(e) {
      var formData = {
        priority: $("#priority").val(),
        uId: $("#uId").val(),
        priode: $("#priode").val(),
      };
      var name = $("#priority").val();
      var priode = $("#priode").val();
      this.reset();
      $.post('back_files/getData.php',formData, function(data){
        
        $("#priorities-list").append('<div class="priority">\
                              <div>\
                                  <i class="fa fa-check"></i>\
                                  <span>'+name+'</span>\
                              </div>\
                              <div class="taskPriode">'+priode+'</div>\
                          </div>');
      });
      return false;
    });
    e.preventDefault();
  });

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