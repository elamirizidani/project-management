<div class="home-contents">
    <div class="">
        <div class="row">
            <div class="priorities" id="priorities">
                <div class="priorities-header">
                    <h1>My Priorities</h1>
                    <div class="priorities-nav">
                        <ul id="taskNav">
                            <a class="navs act-nav" id="upcoming">
                                <li>Upcoming</li>
                            </a>
                            <a class="navs" id="overdue">
                                <li>Overdue</li>
                            </a>
                            <a class="navs" id="complete">
                                <li>Completed</li>
                            </a>
                        </ul>
                    </div>
                </div>
                <div class="priorities-list" id="priorities-list">
                    <div class="priority">
                        <i class="fa-solid fa-circle-check"></i>
                        <p></p>
                        <form action="" id="formPriorities">
                            <div class="tasks">
                                <input type="text" id="priority" class="taskInput" required
                                    placeholder="Add Priority...">
                                <input type="date" class="taskInput" name="" id="priode" requiered="required"
                                    pattern="([a-zA-Z]+\s){0,}([a-zA-Z]+){4,25}">
                                <input type="hidden" id="uId" class="taskInput" required
                                    value="<?php echo $login_id ?>">
                                <input type="submit" value="ADD" name="addPriority" id="addPriority"
                                    onclick="return empty()">
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
                            <form method="post" action="index.php?completeTask"
                                id="priority<?=$priority['priorityId']?>">
                                <input type="hidden" value="<?=$priority['priorityId']?>" name="idPriority">
                            </form>
                            <i class="bx bx-check" id="completePriority" data-id="<?=$priority['priorityId']?>"></i>
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
                    
                    $priorities = $con->singleTable('priorities','uId',$login_id);
                    if(!empty($priorities))
                    { 
                    foreach ($priorities as $priority) {
                        if($priority['priorityStatus'] == "complete")
                            continue;
                            if($priority['priode'] < date("Y-m-d"))
                            {
                        ?>
                    <div class="priority">
                        <div>
                            <i class="bx bx-check stil-progress"></i>
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
                    
                    $prioritiesCompleted = $con->priorities($login_id,"complete");
                    if(!empty($prioritiesCompleted))
                    {
                    foreach ($prioritiesCompleted as $priorityCompleted) {?>
                    <div class="priority">
                        <div>
                            <i class="bx bx-check complete"></i>
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
            <div class="priorities row">
                <div class="todoList">
                    <div class="priorities-header taskes">
                        <h1>To Do List </h1>
                        <span id="add-task" onclick="onShow()"><i class="bx bx-plus" style="font-size: 30px"></i></span>
                    </div>
                    <div class="priorities-list">
                        <?php
                                $tasks = $con->tasks();
                                if(!empty($tasks))
                                {
                                foreach ($tasks as $task)
                                {
                                    if($login_role == "developer")
                                    {
                                        if($task['assigned'] != $login_id)
                                            continue;
                                    }
                                    elseif($login_role == "designer")
                                    {
                                        if($task['designer'] != $login_id)
                                            continue;
                                    }
                                    else
                                        continue;
                                    ?>
                        <div class="priority">
                            <div class="tasks-todo">
                                <?php if ($task['status'] == 'completed')
                                            echo '<i class="bx bx-check complete"></i>';
                                            elseif($task['status'] == 'inprogress')
                                            echo '<i class="bx bx-check stil-progress"></i>';
                                            else
                                            echo '<i class="bx bx-check"></i>';
                                        ?>
                                <span><?php echo $task['task']?></span>
                                <div class="task-pro"><?php echo $task['project']?></div>
                            </div>
                        </div>
                        <?php }}
                                ?>
                    </div>
                </div>
                <div class="todoList" id="calend">

                </div>
            </div>
            <div id="confirmation" class="model-container">
                <div class="model">
                    <section>
                        <section class="model-header">
                            <span id="close">&times;</span>
                            <h2>Add Task</h2>
                        </section>
                        <section class="model-content" id="display">
                            <form method="POST" action="index.php?create">
                                <input type="text" name="task">
                                <select name="project" id="">
                                    <?php
                                        if($login_role == "developer")
                                            $projects = $con->singleTable("project","assigned",$login_id);
                                        elseif($login_role == "designer")
                                            $projects = $con->singleTable("project","designer",$login_id);
                                        else
                                            $projects = "";
                                            if(!empty($projects))
                                            {
                                                foreach($projects as $project)
                                                {?>
                                    <option value="<?php echo $project['pId'];?>"><?php echo $project['name'];?>
                                    </option>
                                    <?php } 
                                        }?>
                                </select>
                                <input type="submit" name="addTask" value="ADD">
                            </form>
                        </section>
                    </section>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="../assets/js/jquery.min.js"></script>
<script src="../assets/js/script.js"></script>

<script>
$(document).ready(function() {

    $('#calend').load("../calender.html");

    $("#priorities-list-over-due").hide();
    $("#priorities-list-complete").hide();
    $("#upcoming").click(function() {
        $("#priorities-list").show();
        $("#priorities-list-over-due").hide();
        $("#priorities-list-complete").hide();
    });
    $("#overdue").click(function() {
        $("#priorities-list").hide();
        $("#priorities-list-over-due").show();
        $("#priorities-list-complete").hide();
    });
    $("#complete").click(function() {
        $("#priorities-list").hide();
        $("#priorities-list-over-due").hide();
        $("#priorities-list-complete").show();
    });
});

$(function() {

    $("#formPriorities").bind('submit', function(e) {
        var formData = {
            priority: $("#priority").val(),
            uId: $("#uId").val(),
            priode: $("#priode").val(),
        };
        var name = $("#priority").val();
        var priode = $("#priode").val();
        this.reset();
        $.post('../back_files/getData.php', formData, function(data) {

            $("#priorities-list").append('<div class="priority">\
                        <div>\
                            <i class="fa fa-check"></i>\
                            <span>' + name + '</span>\
                        </div>\
                        <div class="taskPriode">' + priode + '</div>\
                    </div>');
        });
        return false;
    });
    e.preventDefault();
});

$(document).ready(function($) {
    $("#completePriority").click(function() {
        var id = $(this).data('id');
        $("#priority" + id).submit();
    });
});

function onShow() {
    $(document).ready(function($) {
        $('body').on('click', '#add-task', function() {
            let confirmation = document.getElementById("confirmation");
            if (!confirmation.classList.contains("model-open")) {
                confirmation.classList.add("model-open");
            }
        });
    });
}
$(document).ready(function($) {
    $('body').on('click', '#close', function() {
        let confirmation = document.getElementById("confirmation");
        confirmation.classList.remove("model-open");

    });
});

document.addEventListener("DOMContentLoaded", () => {
    document.getElementById("confirmation").addEventListener("click", '#close');
    document.querySelector(".model").addEventListener("click", (e) => e.stopPropagation());
});

var header = document.getElementById("taskNav");
var btns = header.getElementsByClassName("navs");
for (var i = 0; i < btns.length; i++) {
    btns[i].addEventListener("click", function() {
        var current = document.getElementsByClassName("act-nav");
        current[0].className = current[0].className.replace(" act-nav", "");
        this.className += " act-nav";
    });
}
</script>