<?php
if(!empty($_POST['user']) && !empty($_POST['startDate']) && !empty($_POST['endDate']))
{
    $startDay = $_POST['startDate'];
    $endDay = $_POST['endDate'];
    $user = $_POST['user'];
    if($user == 'all-users')
        {
            require_once('all.php');
                echo allUsers($startDay,$endDay);
        }
    else{
        require_once('weekly.php');
            echo weeklyReport($user,$startDay,$endDay);
    }
    
}
elseif (!empty($_POST['userPrio']) && !empty($_POST['startDatePrio']) && !empty($_POST['endDatePrio']))
{
    $userPrio = $_POST['userPrio'];
    $startDatePrio = $_POST['startDatePrio'];
    $endDatePrio = $_POST['endDatePrio'];

    require_once('priorities.php');
            echo prioritiesReport($userPrio,$startDatePrio,$endDatePrio);
}
?>

    