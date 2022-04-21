<?php
if (isset($_POST['update'])) {
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
    if($progresses == "nextweek")
    {
        $update = mysqli_query($con, "UPDATE `tasks` SET `status` ='$progresses' WHERE `tId` = '$task'");
    }
    
    else{
        if($progresses == "completed")
        $description = "Done";
        $update = mysqli_query($con, "UPDATE `tasks` SET `status` ='$progresses' WHERE `tId` = '$task'");
        if($update){
            $progress = mysqli_query($con, "INSERT INTO `updates` (`tId`, `uDescription`, `updateDate`,`lastUpdate`) VALUES 
            ('$task','$description','$date','$lastUpdate')");
            if($progress)
            {
                echo "this project have been reported";
            }  
        }
    }
    
}