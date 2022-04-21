<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if(!isset($con))
{
    include "../function/function.php";
    $con = new Databases;
}
if(isset($_POST['priority']))
{
    $priorities = array(
        'priority' => mysqli_real_escape_string($con->con,$_POST['priority']),
        'priorityStatus' => "new",
        'uId' => mysqli_real_escape_string($con->con,$_POST['uId']),
        'priode' => mysqli_real_escape_string($con->con,$_POST['priode'])
    );
    if($con->insert('priorities',$priorities))
    {
        echo "data inserted successfully.";
    }
} 

/*
if (isset($_POST["input_name"]) && is_array($_POST["input_name"])){ 
    $id = $_POST['id'];
    $input_name = $_POST["input_name"]; 
    foreach($input_name as $field_value){

        $tasks = array(
            'pId' => $_POST['id'],
            'name' => $field_value,
            'status' => 'new',
        );
    }
    if($con->insert("tasks", $tasks))
        {
            header("location: ../dashboard.php?new&id=$id");
        }
}
*/

//progress on task 
elseif(isset($_POST['updateProgress']))
{
    $task = $_POST['name'];
    $progresses = $_POST['progress'];
    $description = trim($_POST['description']);
    $date = trim($_POST['date']);
    $lastUpdate = date('Y-m-d');
    if (empty($date))
    {
        $date = date('Y-m-d');
    }
    $id = $_POST['id'];

    $taskdata = array(
        'status' => $progresses
    );
    $taskcondition = array(
        'tId' =>$_POST['name']
    );
    if($progresses == "nextweek")
    {
        if($con->update('tasks',$taskdata,$taskcondition))
        {
            header("location: ../index.php");
        }
    }
    else{
            $progress = array(
                'tId' => $task,
                'uDescription' => $description,
                'updateDate' => $date,
                'lastUpdate' => $lastUpdate,
            );
        
        if($con->update('tasks',$taskdata,$taskcondition))
        {
            if($con->insert("updates", $progress))
                {
                    header("location: ../index.php");
                }
        }
        
       
    }
}


//add task

elseif(isset($_POST['addTask']))
{
    $addTask = array(
        'pId'=>$_POST['project'],
        'name'=>$_POST['task'],
        'status'=>'new'
    );
    if($con->insert("tasks", $addTask))
    {
        include "priorities.php";
    }
}


//assign the project to the developer

if (isset($_POST['assign']))
{
    $assign = array(
        'assigned' => $_POST['assigned'],
        'designer' => $_POST['designer'],
        'addedBy' => $login_id,
        'start_date' => $_POST['startDate'],
        'due_date' => $_POST['dueDate'],
        'mokeup' => "",
        'name' => $_POST['name'],
        'description' => addslashes($_POST['description']),
        'status' => 'new'
    );
    if($con->insert("project", $assign))
    {
        include "../admin/projects.php";
    }
}

//assign by marketier

if (isset($_POST['assignMarketing']))
{
    $assign = array(
        'assigned' => 0,
        'designer' => 0,
        'addedBy' => $login_id,
        'start_date' => $_POST['startDate'],
        'due_date' => $_POST['dueDate'],
        'mokeup' => '',
        'name' => $_POST['name'],
        'description' => addslashes($_POST['description']),
        'status' => 'new'
    );
    if($con->insert("project", $assign))
    {
        include "../admin/projects.php";
    }
}

//add user to team



//update 

if(isset($_POST['assignUpdate']))
{
    if((empty($_POST['assigned'])) && (!empty($_POST['designer'])))
    {
        $updateData = array(
            'designer' => $_POST['designer']
        );
    }
    elseif((!empty($_POST['assigned'])) && (empty($_POST['designer'])))
    {
        $updateData = array(
            'assigned' => $_POST['assigned'],
        );
    }
    elseif((!empty($_POST['assigned'])) && (!empty($_POST['designer'])))
        {
            $updateData = array(
            'assigned' => $_POST['assigned'],
            'designer' => $_POST['designer']
        );
    }
    $condition = array(
        'pId' => $_POST['id']
    );
    if($con->update('project',$updateData,$condition))
        include "../admin/projects.php";
    else
        echo "something went wrong";
}

if (isset($_POST['start']))
{
    $data = array(
        'status' => 'progress',
        'last_update' => date('Y-m-d')
    );
    $condition = array(
        'pId' => $_POST['id']
    );
    if($con->update('project',$data,$condition))
        include "../admin/projects.php";
    else
        echo "something went wrong";
}

if(isset($_POST['addMokeup']))
{
    $data = array(
        'mokeup' => $_POST['mokeup']
    );
    $condition = array(
        'pId' => $_POST['id']
    );
    if($con->update('project',$data,$condition))
        include "../admin/projects.php";
    else
        echo "something went wrong";
}

if(isset($_POST['startMokeup']))
{
    $mokeup = array(
        'pId' => $_POST['id'],
        'status' => 'inprogress',
        'mokeupDesc'=> 'Just started'
    );
    $newTask = array(
        'pId' => $_POST['id'],
        'name' => 'Mockup',
        'status' => 'new',
    );
    if($con->insert("mokeup", $mokeup))
    {
        if($con->insert("tasks",$newTask))
            include "../admin/projects.php";
    }
}

if(isset($_GET['completeTask']))
{
    if(!empty($_POST['idPriority']))
    {
        $data = array(
            'priorityStatus'=>'complete'
        );
        $condition = array(
            'priorityId'=>$_POST['idPriority']
        );
        if($con->update('priorities',$data,$condition))
            {
                include "priorities.php";
                unset($_GET['completeTask']);
            }
    }
    else
        include "priorities.php";
    
}