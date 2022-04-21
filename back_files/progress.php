<?php
if (isset($_POST['update'])) {
    /*$completed = trim($_POST['complete']);
    $inprogress = trim($_POST['inprogress']);
    $nextAction = trim($_POST['nextAction']);
    $dueDate = trim($_POST['dueDate']);
    $nextWeek = trim($_POST['nextWeek']);
    $longTerm = trim($_POST['longTerm']);
    $issues = trim($_POST['issues']);
    $id = $_POST['id'];

    $progress = mysqli_query($con, "UPDATE `progress` SET `completed` = '$completed', 
    `inprogress` = '$inprogress', `nextActivities` = '$nextAction', `dueDate` = '$dueDate', 
    `nextWeek` = '$nextWeek', `longTerm` = '$longTerm', `issue` = '$issues' WHERE `progress`.`pId` = '$id'");
    if($progress)
    {
        echo "this project have been reported";
    }
    */


    $completed = trim($_POST['complete']);
    $nextAction = trim($_POST['nextAction']);
    $date = trim($_POST['date']);
    $nextWeek = trim($_POST['nextWeek']);
    $issues = trim($_POST['issues']);
    $id = $_POST['id'];

    $progress = mysqli_query($con, "INSERT INTO `inprogress` (`completed`, `pId`, `day`, `issues`, `nextActivities`, `nextWeek`) VALUES 
    ('$completed','$id','$date','$issues','$nextAction','$nextWeek')");
    if($progress)
    {
        echo "this project have been reported";
    }
}